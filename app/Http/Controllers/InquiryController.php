<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Inquiry;
use App\Models\Lead;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    /**
     * Display all inquiries.
     */
    public function index()
    {
        $inquiries = Inquiry::with([
            'lead',
            'student.user',
            'assignedConsultant.user'
        ])
            ->latest('inquiry_id')
            ->paginate(20);

        return view(
            'admin.inquiries.index',
            compact('inquiries')
        );
    }

    /**
     * Show create inquiry form.
     */
    public function create()
    {
        $leads = Lead::orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        $students = Student::with('user')
            ->get();

        $consultants = Consultant::with('user')
            ->where('consultant_status', 'active')
            ->get();

        return view(
            'admin.inquiries.create',
            compact(
                'leads',
                'students',
                'consultants'
            )
        );
    }

    /**
     * Store a new inquiry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => [
                'nullable',
                'integer',
                'exists:leads,lead_id'
            ],
            'student_id' => [
                'nullable',
                'integer',
                'exists:students,student_id'
            ],
            'inquiry_subject' => [
                'required',
                'string',
                'max:255'
            ],
            'inquiry_message' => [
                'required',
                'string'
            ],
            'inquiry_status' => [
                'required',
                'in:New,In Progress,Resolved,Closed'
            ],
            'assigned_consultant_id' => [
                'nullable',
                'integer',
                'exists:consultants,consultant_id'
            ],
        ]);

        if (
            empty($validated['lead_id']) &&
            empty($validated['student_id'])
        ) {
            return back()
                ->withErrors([
                    'lead_id' =>
                        'An inquiry must belong to a lead or student.'
                ])
                ->withInput();
        }

        Inquiry::create($validated);

        return redirect()
            ->route('admin.inquiries.index')
            ->with(
                'success',
                'Inquiry created successfully.'
            );
    }

    /**
     * Display an inquiry.
     */
    public function show(Inquiry $inquiry)
    {
        $inquiry->load([
            'lead',
            'student.user',
            'assignedConsultant.user'
        ]);

        return view(
            'admin.inquiries.show',
            compact('inquiry')
        );
    }

    /**
     * Show edit inquiry form.
     */
    public function edit(Inquiry $inquiry)
    {
        $leads = Lead::orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        $students = Student::with('user')
            ->get();

        $consultants = Consultant::with('user')
            ->where('consultant_status', 'active')
            ->get();

        return view(
            'admin.inquiries.edit',
            compact(
                'inquiry',
                'leads',
                'students',
                'consultants'
            )
        );
    }

    /**
     * Update an inquiry.
     */
    public function update(
        Request $request,
        Inquiry $inquiry
    ) {
        $validated = $request->validate([
            'lead_id' => [
                'nullable',
                'integer',
                'exists:leads,lead_id'
            ],
            'student_id' => [
                'nullable',
                'integer',
                'exists:students,student_id'
            ],
            'inquiry_subject' => [
                'required',
                'string',
                'max:255'
            ],
            'inquiry_message' => [
                'required',
                'string'
            ],
            'inquiry_status' => [
                'required',
                'in:New,In Progress,Resolved,Closed'
            ],
            'assigned_consultant_id' => [
                'nullable',
                'integer',
                'exists:consultants,consultant_id'
            ],
        ]);

        if (
            empty($validated['lead_id']) &&
            empty($validated['student_id'])
        ) {
            return back()
                ->withErrors([
                    'lead_id' =>
                        'An inquiry must belong to a lead or student.'
                ])
                ->withInput();
        }

        $inquiry->update($validated);

        return redirect()
            ->route(
                'admin.inquiries.index'
            )
            ->with(
                'success',
                'Inquiry updated successfully.'
            );
    }

    /**
     * Delete an inquiry.
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()
            ->route('admin.inquiries.index')
            ->with(
                'success',
                'Inquiry deleted successfully.'
            );
    }

    /**
     * Create an inquiry from the public contact form.
     */
    public function publicStore(Request $request)
    {
        $validated = $request->validate([
            'inquiry_subject' => [
                'required',
                'string',
                'max:255'
            ],
            'inquiry_message' => [
                'required',
                'string'
            ],
        ]);

        $user = Auth::user();

        $studentId = null;

        if ($user && $user->student) {
            $studentId = $user->student->student_id;
        }

        Inquiry::create([
            'student_id' => $studentId,
            'inquiry_subject' =>
                $validated['inquiry_subject'],
            'inquiry_message' =>
                $validated['inquiry_message'],
            'inquiry_status' => 'New',
        ]);

        return back()->with(
            'success',
            'Your inquiry has been submitted successfully.'
        );
    }
}