<?php

namespace App\Http\Controllers;

use App\Models\CommunicationHistory;
use App\Models\Consultant;
use App\Models\Inquiry;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Handles the "Communication History" feature of the CRM module.
 *
 * This is simply a log of every call, email, message, or note that an
 * admin/consultant records against a Lead or an Inquiry. It reads and
 * writes to the existing "communication_history" table (the migration
 * and model for this table already existed in the project; this
 * controller is what was missing to actually use them from the browser).
 */
class CommunicationHistoryController extends Controller
{
    /**
     * INDEX = show the list page.
     *
     * Pulls every communication history row, newest first, and joins
     * in (eager-loads, via with()) the related Lead, Inquiry, and the
     * User who sent it, so the Blade view can display names instead
     * of just raw IDs without running extra queries per row.
     *
     * Also supports simple filtering: if the admin picks a Lead,
     * Inquiry, or Type from the dropdowns on the page, those come in
     * as query-string parameters (?lead_id=5 etc.) and we narrow the
     * query down with where() before running it.
     */
    public function index(Request $request)
    {
        $query = CommunicationHistory::with([
            'lead',
            'inquiry',
            'sender',
        ])->latest('created_at'); // latest() = ORDER BY created_at DESC

        // $request->filled() checks the field exists AND is not empty,
        // so an untouched filter dropdown is simply ignored.
        if ($request->filled('lead_id')) {
            $query->where('lead_id', $request->lead_id);
        }

        if ($request->filled('inquiry_id')) {
            $query->where('inquiry_id', $request->inquiry_id);
        }

        if ($request->filled('communication_type')) {
            $query->where(
                'communication_type',
                $request->communication_type
            );
        }

        // paginate(20) = only fetch 20 rows per page (keeps the page
        // fast even with thousands of logged communications).
        // withQueryString() keeps the filters active when you click
        // "next page" at the bottom of the table.
        $history = $query->paginate(20)->withQueryString();

        // These two lists feed the filter dropdowns at the top of the page.
        $leads = Lead::orderBy('first_name')->get();
        $inquiries = Inquiry::orderBy('inquiry_id', 'desc')->get();

        return view(
            'admin.communication-history.index',
            compact('history', 'leads', 'inquiries')
        );
    }

    /**
     * CREATE = show the blank "Log Communication" form.
     *
     * If this page was opened from a specific Lead/Inquiry (via a link
     * like ?lead_id=5), we pre-select that option in the form's
     * dropdown so the admin doesn't have to pick it again.
     */
    public function create(Request $request)
    {
        $leads = Lead::orderBy('first_name')->get();
        $inquiries = Inquiry::orderBy('inquiry_id', 'desc')->get();

        // Allow pre-selecting a lead/inquiry via ?lead_id= or ?inquiry_id=
        $selectedLeadId = $request->query('lead_id');
        $selectedInquiryId = $request->query('inquiry_id');

        return view(
            'admin.communication-history.create',
            compact(
                'leads',
                'inquiries',
                'selectedLeadId',
                'selectedInquiryId'
            )
        );
    }

    /**
     * STORE = handle the form submission and actually save the row.
     *
     * validate() checks every field follows the rules below BEFORE
     * anything is saved — if a rule fails, Laravel automatically
     * redirects back to the form with an error message, so we never
     * reach the lines after validate() with bad data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => [
                'nullable',                  // allowed to be empty
                'integer',
                'exists:leads,lead_id',      // must match a real lead
            ],
            'inquiry_id' => [
                'nullable',
                'integer',
                'exists:inquiries,inquiry_id',
            ],
            'communication_type' => [
                'required',
                // only these 4 exact values are accepted, matching
                // the database column's ENUM definition
                'in:Message,Email,Phone,Note',
            ],
            'subject' => [
                'nullable',
                'string',
                'max:255',
            ],
            'message' => [
                'required',
                'string',
            ],
        ]);

        // sender_user_id is never typed by the admin — it's always
        // whoever is currently logged in, taken from the session.
        $validated['sender_user_id'] = Auth::id();

        // create() takes the validated array and inserts one new row.
        CommunicationHistory::create($validated);

        // After saving, send the admin back to the list page with a
        // one-time "flash" success message (shown at the top of the page).
        return redirect()
            ->route('admin.communication-history.index')
            ->with(
                'success',
                'Communication logged successfully.'
            );
    }

    /**
     * DESTROY = delete one communication history entry.
     *
     * Laravel automatically converts the {communication_history} URL
     * segment (e.g. /admin/communication-history/7) into the matching
     * CommunicationHistory model instance for us — this is called
     * "route model binding", so we never have to manually write
     * CommunicationHistory::find($id) ourselves.
     */
    public function destroy(CommunicationHistory $communicationHistory)
    {
        $communicationHistory->delete();

        return redirect()
            ->route('admin.communication-history.index')
            ->with(
                'success',
                'Communication entry deleted.'
            );
    }
}
