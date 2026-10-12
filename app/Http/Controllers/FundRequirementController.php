<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Course;
use App\Models\Country;
use App\Models\FundRequirement;
use App\Models\FundRequirementDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\FundRequirementPdf;
use App\Services\AuditLogService;

class FundRequirementController extends Controller
{
    /**
     * Display student's fund requirements.
     */
    public function index()
    {
        $user = Auth::user();
        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        $fundRequirements = FundRequirement::with([
            'selectedCountry',
            'selectedCourse',
            'details'
        ])
            ->where('student_id', $student->student_id)
            ->latest('fund_requirement_id')
            ->paginate(10);

        return view(
            'student.fund-requirements.index',
            compact('fundRequirements')
        );
    }

    /**
     * Show fund requirement generation form.
     */
    public function create()
    {
        $student = Auth::user()?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        $applications = Application::with([
            'preferredCountry',
            'preferredCourse',
        ])
            ->where('student_id', $student->student_id)
            ->latest('application_id')
            ->get();

        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        $courses = Course::where('is_active', true)
            ->with('university')
            ->orderBy('course_name')
            ->get();

        return view(
            'student.fund-requirements.create',
            compact(
                'countries',
                'courses',
                'applications'
            )
        );
    }

    /**
     * Generate a fund requirement.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        $validated = $request->validate([
            'selected_country_id' => [
                'nullable',
                'integer',
                'exists:countries,country_id'
            ],
            'selected_course_id' => [
                'nullable',
                'integer',
                'exists:courses,course_id'
            ],
            'application_id' => [
                'nullable',
                'integer',
                Rule::exists('applications', 'application_id')
                    ->where('student_id', $student->student_id),
            ],
            'total_tuition' => [
                'required',
                'numeric',
                'min:0'
            ],
            'total_living_cost' => [
                'required',
                'numeric',
                'min:0'
            ],
            'total_travel_cost' => [
                'required',
                'numeric',
                'min:0'
            ],
            'total_other_cost' => [
                'nullable',
                'numeric',
                'min:0'
            ],
            'scholarship_amount' => [
                'nullable',
                'numeric',
                'min:0'
            ],
            'currency' => [
                'required',
                'string',
                'max:10'
            ],
            'notes' => [
                'nullable',
                'string'
            ],
        ]);

        $validated['student_id'] = $student->student_id;
        $validated['total_other_cost'] =
            $validated['total_other_cost'] ?? 0;
        $validated['scholarship_amount'] =
            $validated['scholarship_amount'] ?? 0;

        $validated['total_required_amount'] =
            $validated['total_tuition']
            + $validated['total_living_cost']
            + $validated['total_travel_cost']
            + $validated['total_other_cost']
            - $validated['scholarship_amount'];

        if ($validated['total_required_amount'] < 0) {
            $validated['total_required_amount'] = 0;
        }

        $validated['generated_by'] = Auth::id();
        $validated['generated_at'] = now();
        $validated['updated_at'] = now();

        $fundRequirement = DB::transaction(function () use (
            $validated
        ) {
            $fundRequirement = FundRequirement::create(
                $validated
            );

            $details = [
                [
                    'expense_category' => 'Tuition',
                    'description' => 'Total tuition cost',
                    'amount' => $validated['total_tuition'],
                    'currency' => $validated['currency'],
                ],
                [
                    'expense_category' => 'Living',
                    'description' => 'Total living cost',
                    'amount' => $validated['total_living_cost'],
                    'currency' => $validated['currency'],
                ],
                [
                    'expense_category' => 'Travel',
                    'description' => 'Total travel cost',
                    'amount' => $validated['total_travel_cost'],
                    'currency' => $validated['currency'],
                ],
                [
                    'expense_category' => 'Other',
                    'description' => 'Other expenses',
                    'amount' => $validated['total_other_cost'],
                    'currency' => $validated['currency'],
                ],
                [
                    'expense_category' => 'Scholarship',
                    'description' => 'Scholarship deduction',
                    'amount' => $validated['scholarship_amount'],
                    'currency' => $validated['currency'],
                ],
            ];

            foreach ($details as $detail) {
                $detail['fund_requirement_id'] =
                    $fundRequirement->fund_requirement_id;

                $detail['created_at'] = now();

                FundRequirementDetail::create($detail);
            }

            return $fundRequirement;
        });


            AuditLogService::log(
                        'Fund Requirement Generated',
                        'fund_requirements',
                        (int) $fundRequirement->fund_requirement_id,
                        null,
                        [
                            'total_required_amount' =>
                                $fundRequirement->total_required_amount,
                            'currency' => $fundRequirement->currency,
                            'student_id' => $student->student_id,
                        ]
                    );


        return redirect()
            ->route(
                'student.fund-requirements.show',
                $fundRequirement
            )
            ->with(
                'success',
                'Fund requirement generated successfully.'
            );
    }

    /**
     * Display a fund requirement.
     */
    public function show(FundRequirement $fundRequirement)
    {
        $user = Auth::user();
        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        if (
            (int) $fundRequirement->student_id !==
            (int) $student->student_id
        ) {
            abort(403);
        }

        $fundRequirement->load([
            'selectedCountry',
            'selectedCourse.university',
            'details'
        ]);

        return view(
            'student.fund-requirements.show',
            compact('fundRequirement')
        );
    }


/**
 * Generate and download a fund requirement PDF.
 */
public function downloadPdf(FundRequirement $fundRequirement)
{
    $student = Auth::user()?->student;

    if (!$student) {
        abort(403, 'Student profile not found.');
    }

    if (
        (int) $fundRequirement->student_id !==
        (int) $student->student_id
    ) {
        abort(403, 'You cannot access this report.');
    }

    $fundRequirement->load([
        'selectedCountry',
        'selectedCourse.university',
        'details',
    ]);

    $fileName = 'fund-requirement-'
        . $fundRequirement->fund_requirement_id
        . '.pdf';

    $filePath = 'fund-requirements/' . $fileName;

    $pdf = Pdf::loadView(
        'student.fund-requirements.pdf',
        compact('fundRequirement')
    )->setPaper('a4', 'portrait');

    Storage::disk('local')->put($filePath, $pdf->output());

    FundRequirementPdf::updateOrCreate(
        [
            'fund_requirement_id' =>
                $fundRequirement->fund_requirement_id,
        ],
        [
            'file_name' => $fileName,
            'file_path' => $filePath,
            'generated_by' => Auth::id(),
            'generated_at' => now(),
        ]
    );

            AuditLogService::log(
            'Fund Requirement PDF Downloaded',
            'fund_requirement_pdf',
            (int) $fundRequirement->fund_requirement_id,
            null,
            [
                'file_name' => $fileName,
                'fund_requirement_id' =>
                    $fundRequirement->fund_requirement_id,
            ]
        );

    return response()->download(
        Storage::disk('local')->path($filePath),
        $fileName
    );
}


    /**
     * Delete a fund requirement.
     */
    public function destroy(
        FundRequirement $fundRequirement
    ) {
        $user = Auth::user();
        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        if (
            (int) $fundRequirement->student_id !==
            (int) $student->student_id
        ) {
            abort(403);
        }

        $fundRequirement->delete();

        return redirect()
            ->route(
                'student.fund-requirements.index'
            )
            ->with(
                'success',
                'Fund requirement deleted successfully.'
            );
    }
}