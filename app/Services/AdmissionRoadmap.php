<?php

namespace App\Services;

use App\Models\Course;
use App\Models\RequiredDocument;
use App\Models\Student;

/**
 * Admission roadmap for one student and one course.
 *
 * The entry-requirement checks come from EligibilityMatcher (the single source
 * of truth for eligibility). This class only adds the pieces around it:
 * required documents, the next intake deadline, and where to go to fix each gap.
 */
class AdmissionRoadmap
{
    /** Where each eligibility check is fixed in the student portal. */
    private const CHECK_ROUTES = [
        'Qualification level' => ['student.qualifications', 'academic'],
        'GPA' => ['student.qualifications', 'academic'],
        'Field of study' => ['student.qualifications', 'academic'],
        'English' => ['student.qualifications', 'english'],
        'Work experience' => ['student.qualifications', 'work'],
        'Age' => ['student.profile', null],
        'Budget' => ['student.preferences', null],
    ];

    public function __construct(private EligibilityMatcher $matcher)
    {
    }

    /**
     * @return array{
     *     course: Course,
     *     percent: int,
     *     label: string,
     *     met: int,
     *     total: int,
     *     requirements: array<int, array{group: string, label: string, status: string, detail: string, url: ?string}>,
     *     missing: array<int, array>,
     *     steps: array<int, array{title: string, detail: string, url: ?string, urgent: bool}>,
     *     intake: ?array{name: string, closes: ?\Carbon\Carbon, days: ?int, status: ?string},
     *     other_requirements: ?string,
     *     has_published_requirements: bool
     * }
     */
    public function build(Student $student, Course $course): array
    {
        $course->loadMissing(['university.country', 'requirements', 'intakes']);

        $assessment = $this->matcher->assess($student, $course);

        $requirements = [];

        foreach ($assessment['checks'] as $check) {
            $requirements[] = [
                'group' => 'Entry requirements',
                'label' => $check['label'],
                'status' => $check['passed'] ? 'met' : 'missing',
                'detail' => $check['detail'],
                'url' => $this->checkUrl($check['label']),
            ];
        }

        foreach ($this->documentRequirements($student, $course) as $document) {
            $requirements[] = $document;
        }

        $total = count($requirements);
        $met = collect($requirements)->where('status', 'met')->count();
        $percent = $total > 0 ? (int) round(($met / $total) * 100) : 0;

        $missing = collect($requirements)->where('status', '!=', 'met')->values()->all();
        $intake = $this->nextIntake($course);

        return [
            'course' => $course,
            'percent' => $percent,
            'label' => match (true) {
                $total === 0 => 'No published requirements',
                $percent >= 100 => 'Ready to apply',
                $percent >= 70 => 'Almost ready',
                $percent >= 40 => 'Getting there',
                default => 'Just getting started',
            },
            'met' => $met,
            'total' => $total,
            'requirements' => $requirements,
            'missing' => $missing,
            'steps' => $this->steps($missing, $intake),
            'intake' => $intake,
            'other_requirements' => $course->requirements?->other_requirements,
            'has_published_requirements' => $total > 0,
        ];
    }

    /**
     * Required documents for this course: global ones, ones for its country,
     * and ones set for this exact course.
     *
     * @return array<int, array{group: string, label: string, status: string, detail: string, url: ?string}>
     */
    private function documentRequirements(Student $student, Course $course): array
    {
        $countryId = $course->university?->country_id;

        $required = RequiredDocument::where('is_active', true)
            ->where('is_mandatory', true)
            ->where(fn ($q) => $q->whereNull('country_id')->orWhere('country_id', $countryId))
            ->where(fn ($q) => $q->whereNull('course_id')->orWhere('course_id', $course->course_id))
            ->orderBy('document_name')
            ->get();

        $uploaded = $student->documents()->get();
        $url = route('student.documents');

        return $required->map(function ($document) use ($uploaded, $url) {
            $match = $uploaded->firstWhere('required_document_id', $document->required_document_id);

            [$status, $detail] = match (true) {
                !$match => ['missing', 'Not uploaded yet.'],
                $match->status === 'rejected' => ['missing', 'Rejected. Upload a corrected copy.'],
                $match->expiryState() === 'expired' => ['missing', 'Expired. Upload a valid copy.'],
                $match->status === 'verified' => ['met', 'Uploaded and verified.'],
                $match->expiryState() === 'expiring' => ['met', 'Uploaded, but expires soon. Renew it before you apply.'],
                default => ['met', 'Uploaded, waiting for verification.'],
            };

            return [
                'group' => 'Documents',
                'label' => $document->document_name,
                'status' => $status,
                'detail' => $detail,
                'url' => $status === 'met' ? null : $url,
            ];
        })->all();
    }

    private function checkUrl(string $label): ?string
    {
        [$route, $anchor] = self::CHECK_ROUTES[$label] ?? [null, null];

        if (!$route) {
            return null;
        }

        return route($route) . ($anchor ? '#' . $anchor : '');
    }

    /** The intake the student should aim for: the soonest one that is still open. */
    private function nextIntake(Course $course): ?array
    {
        $intake = $course->intakeList()
            ->filter(fn ($i) => $i->application_close_date === null || $i->application_close_date->endOfDay()->isFuture())
            ->sortBy(fn ($i) => $i->application_close_date?->timestamp ?? PHP_INT_MAX)
            ->first();

        if (!$intake) {
            return null;
        }

        return [
            'name' => $intake->intake_name,
            'closes' => $intake->application_close_date,
            'days' => $intake->application_close_date
                ? (int) now()->startOfDay()->diffInDays($intake->application_close_date->startOfDay(), false)
                : null,
            'status' => $intake->intake_status ?? null,
        ];
    }

    /**
     * Ordered, personalised to-do list.
     *
     * @return array<int, array{title: string, detail: string, url: ?string, urgent: bool}>
     */
    private function steps(array $missing, ?array $intake): array
    {
        $urgent = $intake && $intake['days'] !== null && $intake['days'] <= 30;
        $steps = [];

        foreach ($missing as $item) {
            $steps[] = [
                'title' => $item['group'] === 'Documents' ? 'Upload ' . $item['label'] : 'Fix: ' . $item['label'],
                'detail' => $item['detail'],
                'url' => $item['url'],
                'urgent' => $urgent,
            ];
        }

        if (empty($steps)) {
            $steps[] = [
                'title' => 'Submit your application',
                'detail' => 'You meet every published requirement. Send your application to your consultant.',
                'url' => route('student.applications.create'),
                'urgent' => $urgent,
            ];
        }

        return $steps;
    }
}
