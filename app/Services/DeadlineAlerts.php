<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Student;

/**
 * Turns upcoming deadlines into rows in the existing notifications table, so
 * they show up in the dashboard bell, the notifications page and the unread
 * badge with no extra UI.
 *
 * A reminder is created once per deadline per threshold (7, 3 and 1 days
 * before, and on the day). The threshold is stored in notification_type, so
 * running this repeatedly never creates duplicates.
 */
class DeadlineAlerts
{
    /** Days before the deadline at which a reminder is sent. */
    private const THRESHOLDS = [7, 3, 1, 0];

    public const TYPE_PREFIX = 'deadline:';

    public function __construct(private ApplicationJourney $journey)
    {
    }

    /**
     * Create any reminders that are now due for this student.
     *
     * @return int Number of notifications created.
     */
    public function sync(Student $student): int
    {
        $student->loadMissing('user');

        if (!$student->user) {
            return 0;
        }

        $created = 0;
        $deadlines = $this->journey->overview($student)['deadlines'];

        foreach ($deadlines as $deadline) {
            // Appointments already have their own reminders; only warn about things the student must do.
            if ($deadline['kind'] === 'appointment' || $deadline['days'] < 0) {
                continue;
            }

            // The smallest threshold we have crossed is the one that applies.
            $threshold = collect(self::THRESHOLDS)->filter(fn ($t) => $deadline['days'] <= $t)->min();

            if ($threshold === null) {
                continue;
            }

            $type = self::TYPE_PREFIX . $deadline['key'] . ':' . $threshold . ':' . $deadline['date']->format('Ymd');

            $exists = Notification::where('user_id', $student->user->user_id)
                ->where('notification_type', $type)
                ->exists();

            if ($exists) {
                continue;
            }

            Notification::create([
                'user_id' => $student->user->user_id,
                'title' => match (true) {
                    $deadline['days'] === 0 => 'Due today: ' . $deadline['title'],
                    $deadline['days'] === 1 => 'Due tomorrow: ' . $deadline['title'],
                    default => "Due in {$deadline['days']} days: " . $deadline['title'],
                },
                'message' => $deadline['detail'] . ' · ' . $deadline['date']->format('d M Y'),
                'notification_type' => $type,
                'related_application_id' => $deadline['application_id'],
                'is_read' => false,
                'created_at' => now(),
            ]);

            $created++;
        }

        return $created;
    }
}
