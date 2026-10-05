<?php

namespace App\Http\Controllers;

use App\Models\RequiredDocument;
use App\Models\Student;
use App\Models\StudentDocument;
use App\Models\User;
use App\Services\StudentReadiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentDocumentController extends Controller
{
    private function getStudent(): Student
    {
        $user = Auth::user();

        if (!$user || !$user->student) {
            abort(403);
        }

        return $user->student;
    }

    public function index()
    {
        $student = $this->getStudent();

        $documents = $student->documents()
            ->with('requiredDocument')
            ->latest('uploaded_at')
            ->get();

        $requiredDocuments = StudentReadiness::applicableRequiredDocuments($student);

        $checklist = $this->buildChecklist($requiredDocuments, $documents);

        $expiryAlerts = $documents->filter(fn ($document) => $document->expiryState() !== null);

        return view('student.documents', compact(
            'student',
            'documents',
            'requiredDocuments',
            'checklist',
            'expiryAlerts'
        ));
    }

    /**
     * One row per required document, with its current state:
     * missing, pending, verified, rejected or expired.
     *
     * @return array{rows: \Illuminate\Support\Collection, done: int, total: int, percent: int}
     */
    private function buildChecklist($requiredDocuments, $documents): array
    {
        $rows = $requiredDocuments->map(function ($required) use ($documents) {
            $upload = $documents
                ->where('required_document_id', $required->required_document_id)
                ->sortByDesc('uploaded_at')
                ->first();

            $state = match (true) {
                !$upload => 'missing',
                $upload->expiryState() === 'expired' => 'expired',
                $upload->status === 'rejected' => 'rejected',
                $upload->status === 'verified' => 'verified',
                default => 'pending',
            };

            return [
                'required' => $required,
                'upload' => $upload,
                'state' => $state,
                'expiring' => $upload?->expiryState() === 'expiring',
            ];
        })->values();

        // A mandatory document counts as complete once a valid copy is on file.
        $mandatory = $rows->filter(fn ($row) => $row['required']->is_mandatory);
        $done = $mandatory->filter(fn ($row) => in_array($row['state'], ['pending', 'verified'], true))->count();
        $total = $mandatory->count();

        return [
            'rows' => $rows,
            'done' => $done,
            'total' => $total,
            'percent' => $total > 0 ? (int) round(($done / $total) * 100) : 0,
        ];
    }

    public function store(Request $request)
    {
        $student = $this->getStudent();

        $validated = $request->validate([
            'document_name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[A-Za-z0-9][A-Za-z0-9\s._\-()&]*$/'],
            'required_document_id' => [
                'nullable',
                Rule::exists('required_documents', 'required_document_id')->where('is_active', true),
            ],
            'expiry_date' => ['nullable', 'date', 'after:today', 'before:' . now()->addYears(50)->format('Y-m-d')],
            'file' => ['required', 'file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,doc,docx'],
        ], [
            'expiry_date.after' => 'The expiry date must be in the future. This document has already expired.',
            'document_name.regex' => 'The document name may only contain letters, numbers, spaces and . _ - ( ) &.',
            'required_document_id.exists' => 'Please choose a valid required document.',
            'file.required' => 'Please choose a file to upload.',
            'file.max' => 'The file must not be larger than 5MB.',
            'file.mimes' => 'The file must be a PDF, JPG, PNG, DOC or DOCX.',
        ]);

        $file = $request->file('file');

        $path = $file->store(
            'student_documents/' . $student->student_id,
            'public'
        );

        StudentDocument::create([
            'student_id' => $student->student_id,
            'required_document_id' => $validated['required_document_id'] ?? null,
            'document_name' => $validated['document_name'],
            'expiry_date' => $validated['expiry_date'] ?? null,
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
            'status' => 'pending',
            'uploaded_at' => now(),
        ]);

        return back()->with(
            'success',
            'Document uploaded successfully.'
        );
    }

    public function destroy(StudentDocument $document)
    {
        $student = $this->getStudent();

        if ($document->student_id !== $student->student_id) {
            abort(403);
        }

        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return back()->with(
            'success',
            'Document removed successfully.'
        );
    }
}
