<?php

namespace App\Http\Controllers;

use App\Models\CommunicationHistory;
use App\Models\Inquiry;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;

/**
 * The "CRM Dashboard" feature — a single overview page that answers,
 * at a glance: how many leads/inquiries do we have, what status are
 * they in, and what's been happening recently. Unlike Leads/Inquiries
 * (which let you create/edit/delete), this page is READ-ONLY — it
 * only runs queries and displays numbers, nothing is ever saved here.
 */
class CrmDashboardController extends Controller
{
    /**
     * There is only one page in this controller (index), because a
     * dashboard isn't a list of records you CRUD — it's one summary
     * screen built from several small queries run one after another.
     */
    public function index()
    {
        // Simple row counts — "how many leads/inquiries/logged
        // communications exist in total".
        $totalLeads = Lead::count();
        $totalInquiries = Inquiry::count();
        $totalCommunications = CommunicationHistory::count();

        // GROUP BY query: counts leads per status value (New,
        // Contacted, Qualified, Converted, Lost) in one single query
        // instead of running 5 separate count() calls.
        // pluck('total', 'lead_status') turns the result into a map
        // like ['New' => 12, 'Converted' => 4, ...] so the view can
        // look values up by status name directly.
        $leadsByStatus = Lead::select(
            'lead_status',
            DB::raw('count(*) as total')
        )
            ->groupBy('lead_status')
            ->pluck('total', 'lead_status');

        // Same idea, but for inquiries.
        $inquiriesByStatus = Inquiry::select(
            'inquiry_status',
            DB::raw('count(*) as total')
        )
            ->groupBy('inquiry_status')
            ->pluck('total', 'inquiry_status');

        // Conversion Rate = (converted leads ÷ total leads) × 100.
        // The "?? 0" means: if there are no Converted leads at all,
        // use 0 instead of crashing on a missing array key.
        // The "$totalLeads > 0 ? ... : 0" avoids a divide-by-zero
        // error on a totally empty database.
        $convertedLeads = $leadsByStatus['Converted'] ?? 0;
        $conversionRate = $totalLeads > 0
            ? round(($convertedLeads / $totalLeads) * 100, 1)
            : 0;

        // The last 8 communication log entries, for the "Recent
        // Activity" panel — with their related Lead/Inquiry/Sender
        // loaded in the same query (eager loading) to keep this fast.
        $recentCommunications = CommunicationHistory::with([
            'lead',
            'inquiry',
            'sender',
        ])
            ->latest('created_at')
            ->take(8)
            ->get();

        $recentLeads = Lead::latest('lead_id')
            ->take(5)
            ->get();

        // Hand every computed value to the Blade view in one go.
        return view('admin.crm-dashboard.index', compact(
            'totalLeads',
            'totalInquiries',
            'totalCommunications',
            'leadsByStatus',
            'inquiriesByStatus',
            'conversionRate',
            'recentCommunications',
            'recentLeads'
        ));
    }
}
