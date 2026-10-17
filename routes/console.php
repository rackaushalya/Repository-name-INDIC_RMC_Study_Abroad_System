<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('deadlines:notify', function (\App\Services\DeadlineAlerts $alerts) {
    $created = 0;

\App\Models\Student::query()
    ->with('user')
    ->each(function (\App\Models\Student $student) use ($alerts, &$created) {
        $created += $alerts->sync($student);
    });


    $this->info("Created {$created} deadline reminder(s).");
})->purpose('Create reminder notifications for upcoming student deadlines');

// Reminders are also created when a student opens their dashboard, so this
// only matters for students who have not logged in (it needs a scheduler running).
Schedule::command('deadlines:notify')->dailyAt('08:00');
