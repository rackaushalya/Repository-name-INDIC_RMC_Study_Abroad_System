<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Scholarship;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Everything the student sees about "where is my application and what is due":
 * a status timeline, upcoming deadlines, outstanding requirements and the one
 * thing to do next.
 */
class ApplicationJourney
{
    /** The normal route an application takes, in order. */
    private const PATH = [
        'Submitted',
        'Under Review',
        'Consultant Assigned',
        'Consultation Scheduled',
        'Consultation Completed',
        'Recommendation Provided',
        'Completed',
    ];

    /** Statuses that sit between two steps of the normal path. */
    private const SIDE_STATES = [
        'Follow-up Required' => 'Recommendation Provided',
    ];

    private const TERMINAL_NEGATIVE = ['Rejected', 'Cancelled'];

    /** Deadlines closer than this many days are flagged. */
    public const URGENT_DAYS = 3;
    public const SOON_DAYS = 14;

    public function __construct(private AdmissionRoadmap $roadmap)
    {
    }

    /**
     * One application in full.
     */
    public function forApplication(Application $application, Student $student): array
    {
        $application->loadMissing([
            'preferredCountry',
            'preferredCourse.university',
            'preferredCourse.intakes',
            'preferredIntake',
            'statusHistory',
        ]);

        $roadmap = $application->preferredCourse
            ? $this->roadmap->build($student, $application->preferredCourse)
            : null;

        $outstanding = $roadmap ? $roadmap['missing'] : [];
        $deadlines = $this->applicationDeadlines($application, $student);

        return [
            'application' => $application,
            'timeline' => $this->timeline($application),
            'deadlines' => $deadlines,
            'next_deadline' => $deadlines->first(),
            'outstanding' => $outstanding,
            'roadmap' => $roadmap,
            'next_action' => $this->nextAction($application, $outstanding, $student),
            'is_closed' => $this->isClosed($application),
        ];
    }

    /**
     * All applications plus the numbers and deadlines for the dashboard
     * and the My Applications page.
     */
    public function overview(Student $student): array
    {
        $applications = $student->applications()
            ->with(['preferredCountry', 'preferredCourse.university', 'preferredCourse.intakes', 'preferredIntake', 'statusHistory'])
            ->latest('submitted_at')
            ->get();

        $journeys = $applications->mapWithKeys(
            fn (Application $application) => [$application->application_id => $this->forApplication($application, $student)]
        );

        $open = $journeys->reject(fn ($j) => $j['is_closed']);

        $deadlines = $journeys
            ->flatMap(fn ($j) => $j['is_closed'] ? [] : $j['deadlines'])
            ->merge($this->studentDeadlines($student))
            ->unique('key')
            ->sortBy('date')
            ->values();

        return [
            'journeys' => $journeys,
            'counts' => [
                'total' => $applications->count(),
                'active' => $open->count(),
                'completed' => $applications->where('application_status', 'Completed')->count(),
                'needs_action' => $open->filter(fn ($j) => $j['next_action']['needs_action'])->count(),
                'closed' => $applications->count() - $open->count(),
            ],
            'deadlines' => $deadlines,
            'overdue' => $deadlines->where('urgency', 'overdue')->count(),
            'due_soon' => $deadlines->whereIn('urgency', ['urgent', 'soon'])->count(),
        ];
    }

    public function isClosed(Application $application): bool
    {
        return in_array($application->application_status, array_merge(['Completed'], self::TERMINAL_NEGATIVE), true);
    }

    /**
     * Steps of the normal path with dates from the status history.
     *
     * @return array<int, array{label: string, date: ?Carbon, state: string}>  state: done|current|failed|upcoming
     */
    public function timeline(Application $application): array
    {
        $status = $application->application_status ?? 'Submitted';
        $failed = in_array($status, self::TERMINAL_NEGATIVE, true);
        $history = $application->statusHistory ?? collect();

        // Where on the normal path the application currently is.
        $anchor = self::SIDE_STATES[$status] ?? $status;
        $currentIndex = array_search($anchor, self::PATH, true);

        if ($failed) {
            // Rejected/Cancelled: use the last normal step reached before it.
            $reached = $history
                ->map(fn ($h) => array_search(self::SIDE_STATES[$h->new_status] ?? $h->new_status, self::PATH, true))
                ->filter(fn ($i) => $i !== false)
                ->max();
            $currentIndex = $reached ?? 0;
        }

        $currentIndex = $currentIndex === false ? 0 : $currentIndex;

        $steps = [];

        foreach (self::PATH as $index => $label) {
            $date = $index === 0
                ? $application->submitted_at
                : $history->where('new_status', $label)->sortByDesc('changed_at')->first()?->changed_at;

            $state = match (true) {
                $index < $currentIndex => 'done',
                $index === $currentIndex && $failed => 'done',
                $index === $currentIndex && $status === 'Completed' => 'done',
                $index === $currentIndex => 'current',
                default => 'upcoming',
            };

            $steps[] = ['label' => $label, 'date' => $date, 'state' => $state];
        }

        if ($failed) {
            $steps[] = [
                'label' => $status,
                'date' => $history->where('new_status', $status)->sortByDesc('changed_at')->first()?->changed_at,
                'state' => 'failed',
            ];
        }

        return $steps;
    }

    /**
     * Deadlines tied to one application, soonest first.
     *
     * @return Collection<int, array>
     */
    public function applicationDeadlines(Application $application, Student $student): Collection
    {
        if ($this->isClosed($application)) {
            return collect();
        }

        $items = collect();
        $label = $application->application_reference ?? ('#' . $application->application_id);
        $journeyUrl = route('student.applications.journey', $application);

        $intake = $application->preferredIntake
            ?? $application->preferredCourse?->intakeList()
                ->filter(fn ($i) => $i->application_close_date && $i->application_close_date->endOfDay()->isFuture())
                ->sortBy('application_close_date')
                ->first();

        if ($intake?->application_close_date) {
            $items->push($this->deadline(
                kind: 'intake',
                id: $intake->intake_id,
                title: 'Applications close: ' . $intake->intake_name,
                detail: $application->preferredCourse?->course_name ?? $label,
                date: $intake->application_close_date,
                url: $journeyUrl,
                applicationId: $application->application_id,
            ));
        }

        $course = $application->preferredCourse;

        if ($course) {
            // Only scholarships that can still be applied for; a missed one is not an action item.
            Scholarship::where('is_active', true)
                ->whereDate('application_deadline', '>=', today())
                ->where(function ($q) use ($course) {
                    $q->where('course_id', $course->course_id)
                        ->orWhere(fn ($q2) => $q2->whereNull('course_id')->where('university_id', $course->university_id));
                })
                ->get()
                ->each(function ($scholarship) use ($items, $course, $journeyUrl, $application) {
                    $items->push($this->deadline(
                        kind: 'scholarship',
                        id: $scholarship->scholarship_id,
                        title: 'Scholarship deadline: ' . $scholarship->scholarship_name,
                        detail: $course->course_name,
                        date: $scholarship->application_deadline,
                        url: $journeyUrl,
                        applicationId: $application->application_id,
                    ));
                });
        }

        $application->appointments()
            ->whereIn('appointment_status', ['Requested', 'Confirmed'])
            ->whereDate('appointment_date', '>=', today())
            ->get()
            ->each(function ($appointment) use ($items, $application) {
                $items->push($this->deadline(
                    kind: 'appointment',
                    id: $appointment->appointment_id,
                    title: 'Consultation appointment',
                    detail: $appointment->appointment_type ?? 'Meet your consultant',
                    date: $appointment->appointment_date,
                    url: route('student.appointments'),
                    applicationId: $application->application_id,
                ));
            });

        return $items->sortBy('date')->values();
    }

    /**
     * Deadlines that belong to the student rather than one application:
     * documents that are expired or about to expire.
     *
     * @return Collection<int, array>
     */
    public function studentDeadlines(Student $student): Collection
    {
        return $student->documents()
            ->whereNotNull('expiry_date')
            ->whereDate('expiry_date', '<=', now()->addDays(60))
            ->get()
            ->map(fn ($document) => $this->deadline(
                kind: 'document',
                id: $document->student_document_id,
                title: ($document->expiry_date->isPast() ? 'Expired: ' : 'Expires soon: ') . $document->document_name,
                detail: 'Upload a valid copy',
                date: $document->expiry_date,
                url: route('student.documents'),
                applicationId: null,
            ))
            ->values();
    }

    private function deadline(string $kind, int $id, string $title, string $detail, $date, string $url, ?int $applicationId): array
    {
        $date = Carbon::parse($date)->startOfDay();
        $days = (int) now()->startOfDay()->diffInDays($date, false);

        return [
            'key' => "{$kind}:{$id}",
            'kind' => $kind,
            'title' => $title,
            'detail' => $detail,
            'date' => $date,
            'days' => $days,
            'urgency' => match (true) {
                $days < 0 => 'overdue',
                $days <= self::URGENT_DAYS => 'urgent',
                $days <= self::SOON_DAYS => 'soon',
                default => 'ok',
            },
            'url' => $url,
            'application_id' => $applicationId,
        ];
    }

    /**
     * The single most useful thing to do right now.
     *
     * @return array{label: string, detail: string, url: ?string, needs_action: bool}
     */
    private function nextAction(Application $application, array $outstanding, Student $student): array
    {
        $status = $application->application_status;

        if ($this->isClosed($application)) {
            return $this->action(match ($status) {
                'Completed' => 'Application complete',
                'Rejected' => 'Application was not accepted',
                default => 'Application cancelled',
            }, '', null, false);
        }

        if (!empty($outstanding)) {
            $first = $outstanding[0];
            $count = count($outstanding);

            return $this->action(
                $count === 1 ? 'Fix 1 outstanding requirement' : "Fix {$count} outstanding requirements",
                $first['label'] . ': ' . $first['detail'],
                route('student.applications.journey', $application),
                true
            );
        }

        return match ($status) {
            'Consultant Assigned' => $this->action('Book your consultation', 'Your consultant is ready to meet you.', route('student.appointments'), true),
            'Consultation Scheduled' => $this->action('Attend your consultation', 'Check the date and meeting details.', route('student.appointments'), false),
            'Recommendation Provided' => $this->action('Review your recommendations', 'Your consultant shared course suggestions.', route('student.recommendations.index'), true),
            'Follow-up Required' => $this->action('Respond to your consultant', 'A follow-up is waiting for you.', route('student.applications.show', $application), true),
            default => $this->action('Waiting for your consultant', 'Nothing needed from you right now.', null, false),
        };
    }

    private function action(string $label, string $detail, ?string $url, bool $needsAction): array
    {
        return ['label' => $label, 'detail' => $detail, 'url' => $url, 'needs_action' => $needsAction];
    }
}
