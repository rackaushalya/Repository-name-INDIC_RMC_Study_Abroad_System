<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Inquiry;
use App\Models\Lead;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * The "Inquiry Management" feature — the step after Lead Management.
 * An Inquiry is a specific question/message tied to either a Lead
 * (someone not yet a student) or a Student (someone already
 * registered). Also a standard CRUD controller, plus one extra
 * method (publicStore) for the public-facing contact form.
 */
class InquiryController extends Controller
{
    /**
     * INDEX = list page. Shows every inquiry, with its related Lead,
     * Student (and that student's User, for their name), and assigned
     * Consultant all loaded up front (eager loading) so the table can
     * display names without extra per-row queries.
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
     * CREATE = show the blank "Add Inquiry" form.
     * Offers every lead, every student, and only active consultants
     * as options, since an inquiry can be linked to a lead OR a
     * student (see the check in store() below).
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
     * STORE = handle the "Add Inquiry" form submission.
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

        // Business rule that the database alone can't enforce:
        // every inquiry must be tied to SOMEONE — either a lead or
        // an already-registered student. If both are empty, reject
        // the form and send the admin back with an explanation,
        // keeping whatever they'd already typed (withInput()).
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
     * SHOW = view a single inquiry's full details.
     */
    public function show(Inquiry $inquiry)
    {
        $inquiry->load([
            'lead',
            'student.user',
            'assignedConsultant.user',
            // Needed so the detail page can show this inquiry's full
            // communication log underneath its main details.
            'communicationHistory.sender'
        ]);

        return view(
            'admin.inquiries.show',
            compact('inquiry')
        );
    }

    /**
     * EDIT = show the pre-filled "Edit Inquiry" form.
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
     * UPDATE = handle the "Edit Inquiry" form submission.
     * Same validation and lead-or-student rule as store() above.
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
     * DESTROY = delete an inquiry permanently.
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
     * Separate from the admin CRUD above — this is the endpoint the
     * PUBLIC website's contact form submits to, so a visitor (not an
     * admin) can raise an inquiry themselves without logging into the
     * admin portal.
     *
     * If the visitor happens to be logged in as a student already, we
     * automatically attach their student_id so the inquiry shows up
     * linked to their account; otherwise it's saved with no student
     * attached, as a plain "New" inquiry for an admin to pick up.
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
            'inquiry_status' => 'New', // always starts as New
        ]);

        return back()->with(
            'success',
            'Your inquiry has been submitted successfully.'
        );
    }
}
