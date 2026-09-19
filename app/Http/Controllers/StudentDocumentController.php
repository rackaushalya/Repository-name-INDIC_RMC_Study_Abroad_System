<?php

namespace App\Http\Controllers;

use App\Models\RequiredDocument;
use App\Models\Student;
use App\Models\StudentDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $requiredDocuments = RequiredDocument::where('is_active', true)
            ->where(function ($query) use ($student) {
                $query->whereNull('country_id')
                    ->orWhere('country_id', $student->preferences?->preferred_country_id);
            })
            ->orderBy('document_name')
            ->get();

        return view('student.documents', compact(
            'student',
            'documents',
            'requiredDocuments'
        ));
    }

    public function store(Request $request)
    {
        $student = $this->getStudent();

        $validated = $request->validate([
            'document_name' => ['required', 'string', 'max:255'],
            'required_document_id' => ['nullable', 'exists:required_documents,required_document_id'],
            'file' => ['required', 'file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,doc,docx'],
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
