<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Country;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display all leads.
     */
    public function index()
    {
        $leads = Lead::with([
            'interestedCountry',
            'assignedConsultant.user'
        ])
            ->latest('lead_id')
            ->paginate(20);

        return view(
            'admin.leads.index',
            compact('leads')
        );
    }

    /**
     * Show create lead form.
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
     * Store a new lead.
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

        Lead::create($validated);

        return redirect()
            ->route('admin.leads.index')
            ->with(
                'success',
                'Lead created successfully.'
            );
    }

    /**
     * Display a lead.
     */
    public function show(Lead $lead)
    {
        $lead->load([
            'interestedCountry',
            'assignedConsultant.user'
        ]);

        return view(
            'admin.leads.show',
            compact('lead')
        );
    }

    /**
     * Show edit lead form.
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
     * Update a lead.
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
     * Delete a lead.
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