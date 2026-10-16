<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;

/**
 * The "Analytics Dashboard" feature — similar idea to the CRM
 * Dashboard, but focused on TRENDS and CHARTS instead of plain
 * numbers. Every value calculated here is handed to Chart.js in the
 * Blade view (resources/views/admin/analytics/index.blade.php) to
 * draw a line chart, a pie chart, and a bar chart.
 * This controller is also 100% read-only — no data is ever saved here.
 */
class CrmAnalyticsController extends Controller
{
    public function index()
    {
        // --- Chart 1: Leads created per day, last 14 days (line chart) ---
        // DATE(created_at) strips the time off the timestamp, so
        // "2026-10-13 14:22:10" becomes just "2026-10-13" — this lets
        // us group multiple leads created on the same day together.
        $leadsOverTime = Lead::select(
            DB::raw('DATE(created_at) as day'),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', now()->subDays(14))
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Chart.js needs two separate lists: the labels along the
        // bottom of the chart (dates) and the matching values (counts).
        $leadsTimelineLabels = $leadsOverTime
            ->pluck('day')
            ->map(fn ($d) => \Illuminate\Support\Carbon::parse($d)->format('d M'));

        $leadsTimelineValues = $leadsOverTime->pluck('total');

        // --- Chart 2: Leads grouped by source (pie/doughnut chart) ---
        // COALESCE(source, 'Unknown') means: if the source column is
        // empty/null for a lead, show it as "Unknown" instead of blank,
        // so every lead still gets counted somewhere.
        $leadsBySource = Lead::select(
            DB::raw("COALESCE(source, 'Unknown') as source"),
            DB::raw('count(*) as total')
        )
            ->groupBy('source')
            ->orderByDesc('total')
            ->get();

        // --- Chart 3: Status funnel (bar chart) ---
        // We fix the order ourselves (New -> Lost) instead of letting
        // the database decide, so the funnel always reads left-to-right
        // in the correct pipeline order on the chart.
        $statusOrder = ['New', 'Contacted', 'Qualified', 'Converted', 'Lost'];
        $leadsByStatus = Lead::select(
            'lead_status',
            DB::raw('count(*) as total')
        )
            ->groupBy('lead_status')
            ->pluck('total', 'lead_status');

        $funnelLabels = $statusOrder;
        // For every status in our fixed order, look up its count —
        // or 0 if that status currently has no leads at all.
        $funnelValues = collect($statusOrder)
            ->map(fn ($status) => $leadsByStatus[$status] ?? 0);

        // --- Panel: Leads handled per consultant (simple list, not a chart) ---
        $leadsPerConsultant = Lead::select(
            'assigned_consultant_id',
            DB::raw('count(*) as total')
        )
            ->whereNotNull('assigned_consultant_id')
            ->groupBy('assigned_consultant_id')
            ->get()
            ->map(function ($row) {
                // For each group, look up that consultant's name.
                // The "?->" (nullsafe operator) means: if the consultant
                // or their linked user was deleted, don't crash — just
                // treat the name as missing.
                $consultant = Consultant::with('user')->find(
                    $row->assigned_consultant_id
                );

                return [
                    'name' => trim(
                        ($consultant?->user?->first_name ?? 'Unassigned') . ' ' .
                        ($consultant?->user?->last_name ?? '')
                    ),
                    'total' => $row->total,
                ];
            });

        // --- Top stat cards ---
        $totalLeads = Lead::count();
        $convertedLeads = $leadsByStatus['Converted'] ?? 0;
        $lostLeads = $leadsByStatus['Lost'] ?? 0;
        $conversionRate = $totalLeads > 0
            ? round(($convertedLeads / $totalLeads) * 100, 1)
            : 0;
        $lossRate = $totalLeads > 0
            ? round(($lostLeads / $totalLeads) * 100, 1)
            : 0;

        return view('admin.analytics.index', compact(
            'leadsTimelineLabels',
            'leadsTimelineValues',
            'leadsBySource',
            'funnelLabels',
            'funnelValues',
            'leadsPerConsultant',
            'totalLeads',
            'conversionRate',
            'lossRate'
        ));
    }
}
