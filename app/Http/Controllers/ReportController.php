<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Appointment;
use App\Models\Consultant;
use App\Models\Course;
use App\Models\Country;
use App\Models\Lead;
use App\Models\Report;
use App\Models\Student;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display all reports.
     */
    public function index()
    {
        $reports = Report::latest('report_id')
            ->paginate(20);

        return view(
            'admin.reports.index',
            compact('reports')
        );
    }

    /**
     * Show report creation form.
     */
    public function create()
    {
        return view('admin.reports.create');
    }

    /**
     * Generate and store a report.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_name' => [
                'required',
                'string',
                'max:255'
            ],
            'report_type' => [
                'required',
                'string',
                'max:100'
            ],
        ]);

        $reportData = $this->generateReportData(
            $validated['report_type']
        );

        Report::create([
            'report_name' => $validated['report_name'],
            'report_type' => $validated['report_type'],
            'generated_by' => Auth::id(),
            'report_data' => $reportData,
            'generated_at' => now(),
        ]);

        return redirect()
            ->route('admin.reports.index')
            ->with(
                'success',
                'Report generated successfully.'
            );
    }

    /**
     * Display a report.
     */
    public function show(Report $report)
    {
        return view(
            'admin.reports.show',
            compact('report')
        );
    }

    /**
     * Delete a report.
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()
            ->route('admin.reports.index')
            ->with(
                'success',
                'Report deleted successfully.'
            );
    }

    /**
     * Generate report data based on report type.
     */
    private function generateReportData(
        string $reportType
    ): array {
        switch ($reportType) {
            case 'Students':
                return [
                    'total_students' => Student::count(),
                    'generated_at' => now()->toDateTimeString(),
                ];

            case 'Applications':
                return [
                    'total_applications' =>
                        Application::count(),
                    'submitted' =>
                        Application::where(
                            'application_status',
                            'Submitted'
                        )->count(),
                    'under_review' =>
                        Application::where(
                            'application_status',
                            'Under Review'
                        )->count(),
                    'completed' =>
                        Application::where(
                            'application_status',
                            'Completed'
                        )->count(),
                    'rejected' =>
                        Application::where(
                            'application_status',
                            'Rejected'
                        )->count(),
                    'generated_at' =>
                        now()->toDateTimeString(),
                ];

            case 'Appointments':
                return [
                    'total_appointments' =>
                        Appointment::count(),
                    'requested' =>
                        Appointment::where(
                            'appointment_status',
                            'Requested'
                        )->count(),
                    'confirmed' =>
                        Appointment::where(
                            'appointment_status',
                            'Confirmed'
                        )->count(),
                    'completed' =>
                        Appointment::where(
                            'appointment_status',
                            'Completed'
                        )->count(),
                    'cancelled' =>
                        Appointment::where(
                            'appointment_status',
                            'Cancelled'
                        )->count(),
                    'generated_at' =>
                        now()->toDateTimeString(),
                ];

            case 'Universities':
                return [
                    'total_universities' =>
                        University::count(),
                    'active_universities' =>
                        University::where(
                            'is_active',
                            true
                        )->count(),
                    'generated_at' =>
                        now()->toDateTimeString(),
                ];

            case 'Courses':
                return [
                    'total_courses' =>
                        Course::count(),
                    'active_courses' =>
                        Course::where(
                            'is_active',
                            true
                        )->count(),
                    'generated_at' =>
                        now()->toDateTimeString(),
                ];

            case 'Countries':
                return [
                    'total_countries' =>
                        Country::count(),
                    'active_countries' =>
                        Country::where(
                            'is_active',
                            true
                        )->count(),
                    'generated_at' =>
                        now()->toDateTimeString(),
                ];

            case 'Consultants':
                return [
                    'total_consultants' =>
                        Consultant::count(),
                    'active_consultants' =>
                        Consultant::where(
                            'consultant_status',
                            'active'
                        )->count(),
                    'generated_at' =>
                        now()->toDateTimeString(),
                ];

            case 'Leads':
                return [
                    'total_leads' =>
                        Lead::count(),
                    'new_leads' =>
                        Lead::where(
                            'lead_status',
                            'New'
                        )->count(),
                    'contacted_leads' =>
                        Lead::where(
                            'lead_status',
                            'Contacted'
                        )->count(),
                    'qualified_leads' =>
                        Lead::where(
                            'lead_status',
                            'Qualified'
                        )->count(),
                    'converted_leads' =>
                        Lead::where(
                            'lead_status',
                            'Converted'
                        )->count(),
                    'lost_leads' =>
                        Lead::where(
                            'lead_status',
                            'Lost'
                        )->count(),
                    'generated_at' =>
                        now()->toDateTimeString(),
                ];

            default:
                return [
                    'total_students' => Student::count(),
                    'total_applications' =>
                        Application::count(),
                    'total_appointments' =>
                        Appointment::count(),
                    'total_consultants' =>
                        Consultant::count(),
                    'total_universities' =>
                        University::count(),
                    'total_courses' =>
                        Course::count(),
                    'total_countries' =>
                        Country::count(),
                    'total_leads' =>
                        Lead::count(),
                    'generated_at' =>
                        now()->toDateTimeString(),
                ];
        }
    }
}