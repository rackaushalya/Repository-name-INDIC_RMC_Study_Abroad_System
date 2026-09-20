<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultant extends Model
{
    protected $table = 'consultants';

    protected $primaryKey = 'consultant_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'employee_code',
        'specialization',
        'years_of_experience',
        'max_caseload',
        'bio',
        'consultant_status',
    ];

    protected $casts = [
        'years_of_experience' => 'integer',
        'max_caseload' => 'integer',
    ];

    private const DAYS = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday',
        'Friday', 'Saturday', 'Sunday',
    ];

    /**
     * Shape consumed by the admin consultants page.
     */
    public function toAdminArray(): array
    {
        $this->loadMissing([
            'user',
            'availability',
            'activeAssignments.application.student.user',
            'activeAssignments.application.preferredCourse.university',
            'activeAssignments.application.preferredCountry',
        ]);

        return [
            'id' => $this->consultant_id,
            'code' => $this->employee_code,
            'firstName' => $this->user?->first_name ?? '',
            'lastName' => $this->user?->last_name ?? '',
            'name' => trim(
                ($this->user?->first_name ?? '') . ' ' .
                ($this->user?->last_name ?? '')
            ),
            'email' => $this->user?->email ?? '',
            'phone' => $this->user?->phone ?? '',
            'specialization' => $this->specialization ?? '',
            'experience' => $this->years_of_experience ?? 0,
            'status' => $this->consultant_status ?? 'active',
            'maxCapacity' => $this->max_caseload ?: 15,
            'bio' => $this->bio ?? '',
            'assignedStudents' => $this->activeAssignments
                ->map(function (ConsultantAssignment $assignment) {
                    $application = $assignment->application;
                    $course = $application?->preferredCourse;

                    $target = $course
                        ? trim($course->course_name . ' - ' . ($course->university?->university_name ?? ''), ' -')
                        : ($application?->preferredCountry?->country_name
                            ?? $application?->application_reference
                            ?? '');

                    return [
                        'name' => trim(
                            ($application?->student?->user?->first_name ?? '') . ' ' .
                            ($application?->student?->user?->last_name ?? '')
                        ) ?: 'Unknown student',
                        'app' => $target,
                        'stage' => $application?->application_status ?? '',
                    ];
                })
                ->values()
                ->all(),
            'schedule' => $this->availability
                ->sortBy(fn (ConsultantAvailability $slot) => array_search($slot->day_of_week, self::DAYS))
                ->map(fn (ConsultantAvailability $slot) => [
                    'day' => $slot->day_of_week,
                    'hours' => Carbon::parse($slot->start_time)->format('g:i A')
                        . ' - ' . Carbon::parse($slot->end_time)->format('g:i A'),
                    'available' => (bool) $slot->is_available,
                ])
                ->values()
                ->all(),
        ];
    }

    /**
     * Consultant belongs to a User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Get the consultant's assignments.
     */
    public function assignments()
    {
        return $this->hasMany(
            ConsultantAssignment::class,
            'consultant_id',
            'consultant_id'
        );
    }

    /**
     * Assignments that are currently open.
     */
    public function activeAssignments()
    {
        return $this->assignments()
            ->where('assignment_status', 'Active')
            ->latest('assigned_at');
    }

    /**
     * Weekly consultation hours.
     */
    public function availability()
    {
        return $this->hasMany(
            ConsultantAvailability::class,
            'consultant_id',
            'consultant_id'
        );
    }

    /**
     * Get the consultant's appointments.
     */
    public function appointments()
    {
        return $this->hasMany(
            Appointment::class,
            'consultant_id',
            'consultant_id'
        );
    }

    /**
     * Get the consultant's consultation records.
     */
    public function consultationRecords()
    {
        return $this->hasMany(
            ConsultationRecord::class,
            'consultant_id',
            'consultant_id'
        );
    }

    /**
     * Get the consultant's follow-ups.
     */
    public function followUps()
    {
        return $this->hasMany(
            FollowUp::class,
            'consultant_id',
            'consultant_id'
        );
    }
}