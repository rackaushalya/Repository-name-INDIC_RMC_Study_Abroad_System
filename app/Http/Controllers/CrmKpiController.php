<?php

namespace App\Http\Controllers;

use App\Models\CommunicationHistory;
use App\Models\Consultant;
use App\Models\Inquiry;
use App\Models\Lead;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * The "KPI Reports" feature — Key Performance Indicators, i.e. the
 * headline numbers management actually cares about (conversion rate,
 * how fast leads get a first response, workload per consultant).
 *
 * All the real calculation work happens once, in buildKpiData() below,
 * so that both the on-screen page AND the downloadable PDF always show
 * the exact same numbers — we never calculate the same thing twice.
 */
class CrmKpiController extends Controller
{
    /**
     * Shows the KPI numbers on a normal web page.
     */
    public function index()
    {
        $data = $this->buildKpiData();

        return view('admin.kpi-reports.index', $data);
    }

    /**
     * Same numbers as above, but rendered into a PDF file and sent
     * to the browser as a download instead of a web page. Uses the
     * barryvdh/laravel-dompdf package (already in composer.json) to
     * turn the admin.kpi-reports.pdf Blade view into an actual .pdf file.
     */
    public function exportPdf()
    {
        $data = $this->buildKpiData();

        $pdf = Pdf::loadView('admin.kpi-reports.pdf', $data);

        return $pdf->download(
            'crm-kpi-report-' . now()->format('Y-m-d') . '.pdf'
        );
    }

    /**
     * Does all the actual math. Marked "private" because it's only
     * ever called from inside this controller (index() and exportPdf()
     * above) — it's a helper, not something a route points to directly.
     */
    private function buildKpiData(): array
    {
        $totalLeads = Lead::count();
        $totalInquiries = Inquiry::count();

        $convertedLeads = Lead::where('lead_status', 'Converted')->count();
        $lostLeads = Lead::where('lead_status', 'Lost')->count();

        // Conversion Rate = what % of all leads ended up "Converted".
        $conversionRate = $totalLeads > 0
            ? round(($convertedLeads / $totalLeads) * 100, 1)
            : 0;

        // Loss Rate = what % of all leads ended up "Lost".
        $lossRate = $totalLeads > 0
            ? round(($lostLeads / $totalLeads) * 100, 1)
            : 0;

        // --- Average Response Time ---
        // "How many hours, on average, between a lead being created
        // and someone actually logging their first contact with them?"
        //
        // Step 1: only look at leads that have AT LEAST ONE
        // communication history entry (whereHas = "has a related row").
        // Step 2: load each lead's communication history sorted
        // oldest-first, so entry #1 in the list is always the FIRST
        // contact ever made with that lead.
        $leadsWithFirstContact = Lead::whereHas('communicationHistory')
            ->with(['communicationHistory' => function ($q) {
                $q->orderBy('created_at', 'asc');
            }])
            ->get();

        $responseTimes = $leadsWithFirstContact
            ->map(function ($lead) {
                // ->first() on the already-sorted list = the earliest entry.
                $firstContact = $lead->communicationHistory->first();

                if (! $firstContact || ! $lead->created_at) {
                    return null; // skip anything with missing data
                }

                // diffInHours(..., true) = the gap in hours, allowing
                // decimals (e.g. 2.5 hours), between the lead's
                // creation time and the first contact's timestamp.
                return $lead->created_at->diffInHours(
                    $firstContact->created_at,
                    true
                );
            })
            // Drop any null values before averaging them.
            ->filter(fn ($value) => $value !== null);

        $avgResponseTimeHours = $responseTimes->count() > 0
            ? round($responseTimes->avg(), 1)
            : null; // null = "not enough data yet", shown as "—" on screen

        // --- Leads handled per consultant ---
        // groupBy() here runs in PHP (not SQL) because we already
        // need the full Lead collection — it buckets the leads by
        // their assigned_consultant_id, then we count each bucket
        // and look up that consultant's display name.
        $leadsPerConsultant = Lead::select('assigned_consultant_id')
            ->whereNotNull('assigned_consultant_id')
            ->get()
            ->groupBy('assigned_consultant_id')
            ->map(function ($leads, $consultantId) {
                $consultant = Consultant::with('user')->find($consultantId);

                return [
                    'name' => trim(
                        ($consultant?->user?->first_name ?? 'Unknown') . ' ' .
                        ($consultant?->user?->last_name ?? '')
                    ),
                    'total' => $leads->count(),
                ];
            })
            ->values(); // re-index the list 0,1,2... for the Blade view

        $activeConsultants = Consultant::where(
            'consultant_status',
            'active'
        )->count();

        // Workload balance: total leads spread evenly across active
        // consultants, as a simple average.
        $avgLeadsPerConsultant = $activeConsultants > 0
            ? round($totalLeads / $activeConsultants, 1)
            : 0;

        $totalCommunications = CommunicationHistory::count();

        // Everything returned here becomes a variable available in
        // the Blade view, e.g. 'totalLeads' => $totalLeads becomes
        // {{ $totalLeads }} in the .blade.php file.
        return [
            'totalLeads' => $totalLeads,
            'totalInquiries' => $totalInquiries,
            'convertedLeads' => $convertedLeads,
            'lostLeads' => $lostLeads,
            'conversionRate' => $conversionRate,
            'lossRate' => $lossRate,
            'avgResponseTimeHours' => $avgResponseTimeHours,
            'leadsPerConsultant' => $leadsPerConsultant,
            'activeConsultants' => $activeConsultants,
            'avgLeadsPerConsultant' => $avgLeadsPerConsultant,
            'totalCommunications' => $totalCommunications,
            'generatedAt' => now(),
        ];
    }
}
