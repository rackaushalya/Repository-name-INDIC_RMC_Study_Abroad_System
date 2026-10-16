<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Country;
use App\Models\Lead;
use Illuminate\Http\Request;

/**
 * The "Lead Management" feature — the very first step of the CRM
 * workflow. A Lead is someone who showed interest (via the website,
 * a call, a walk-in, etc.) but hasn't become a full Student/Inquiry
 * yet. This controller is a standard CRUD controller: Create, Read,
 * Update, Delete — the 5 methods below map directly to those actions.
 */
class LeadController extends Controller
{
    /**
     * INDEX = list page. Shows every lead in a table.
     *
     * with(['interestedCountry', 'assignedConsultant.user']) eager
     * loads the related Country and Consultant (and that consultant's
     * User record, for their name) in the SAME query batch, instead of
     * running one extra query per row — this avoids the classic
     * "N+1 query" performance problem.
     */
    public function index()
    {
        $leads = Lead::with([
            'interestedCountry',
            'assignedConsultant.user'
        ])
            ->latest('lead_id') // newest leads first
            ->paginate(20);     // 20 rows per page

        return view(
            'admin.leads.index',
            compact('leads')
        );
    }

    /**
     * CREATE = show the blank "Add Lead" form.
     *
     * Only active consultants and active countries are offered in the
     * dropdowns, so you can't accidentally assign a lead to someone
     * who's no longer working or a country that's been disabled.
     */
    public function create()
    {
        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        $consultants = Consultant::with('user')
            ->where('consultant_status', 'active')
            ->orderBy('consultant_id')
            ->get();

        return view(
            'admin.leads.create',
            compact(
                'countries',
                'consultants'
            )
        );
    }

    /**
     * STORE = handle the "Add Lead" form submission.
     *
     * validate() checks every field against the rules below BEFORE
     * anything is saved. If any rule fails, Laravel automatically
     * sends the admin back to the form with the error messages — the
     * code after validate() only runs once all the data is confirmed
     * clean.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => [
                'required',
                'string',
                'max:100'
            ],
            'last_name' => [
                'required',
                'string',
                'max:100'
            ],
            'email' => [
                'nullable',       // optional
                'email',          // but must be a valid email format if given
                'max:255'
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],
            'source' => [
                'nullable',
                'string',
                'max:100'
            ],
            'interested_country_id' => [
                'nullable',
                'integer',
                'exists:countries,country_id' // must be a real country row
            ],
            'interested_course' => [
                'nullable',
                'string',
                'max:255'
            ],
            'lead_status' => [
                'required',
                // the only 5 allowed values — matches the database's
                // ENUM column definition exactly
                'in:New,Contacted,Qualified,Converted,Lost'
            ],
            'assigned_consultant_id' => [
                'nullable',
                'integer',
                'exists:consultants,consultant_id'
            ],
            'notes' => [
                'nullable',
                'string'
            ],
        ]);

        // $validated only contains the fields above — this is safer
        // than Lead::create($request->all()), which would blindly
        // trust every field the browser sent, including ones we
        // never asked for.
        Lead::create($validated);

        return redirect()
            ->route('admin.leads.index')
            ->with(
                'success',
                'Lead created successfully.'
            );
    }

    /**
     * SHOW = view a single lead's full details.
     *
     * Laravel turns the {lead} segment of the URL (e.g.
     * /admin/leads/7) straight into a Lead model automatically —
     * this is called route model binding, so there's no manual
     * Lead::find($id) needed here.
     */
    public function show(Lead $lead)
    {
        $lead->load([
            'interestedCountry',
            'assignedConsultant.user',
            // Needed so the detail page can show this lead's full
            // communication log underneath its main details.
            'communicationHistory.sender'
        ]);

        return view(
            'admin.leads.show',
            compact('lead')
        );
    }

    /**
     * EDIT = show the pre-filled "Edit Lead" form for one lead.
     */
    public function edit(Lead $lead)
    {
        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        $consultants = Consultant::with('user')
            ->where('consultant_status', 'active')
            ->orderBy('consultant_id')
            ->get();

        return view(
            'admin.leads.edit',
            compact(
                'lead',
                'countries',
                'consultants'
            )
        );
    }

    /**
     * UPDATE = handle the "Edit Lead" form submission.
     * Same validation rules as store() above, but applied to an
     * existing row instead of creating a new one.
     */
    public function update(
        Request $request,
        Lead $lead
    ) {
        $validated = $request->validate([
            'first_name' => [
                'required',
                'string',
                'max:100'
            ],
            'last_name' => [
                'required',
                'string',
                'max:100'
            ],
            'email' => [
                'nullable',
                'email',
                'max:255'
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],
            'source' => [
                'nullable',
                'string',
                'max:100'
            ],
            'interested_country_id' => [
                'nullable',
                'integer',
                'exists:countries,country_id'
            ],
            'interested_course' => [
                'nullable',
                'string',
                'max:255'
            ],
            'lead_status' => [
                'required',
                'in:New,Contacted,Qualified,Converted,Lost'
            ],
            'assigned_consultant_id' => [
                'nullable',
                'integer',
                'exists:consultants,consultant_id'
            ],
            'notes' => [
                'nullable',
                'string'
            ],
        ]);

        $lead->update($validated);

        return redirect()
            ->route('admin.leads.index')
            ->with(
                'success',
                'Lead updated successfully.'
            );
    }

    /**
     * DESTROY = delete a lead permanently.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()
            ->route('admin.leads.index')
            ->with(
                'success',
                'Lead deleted successfully.'
            );
    }
}
