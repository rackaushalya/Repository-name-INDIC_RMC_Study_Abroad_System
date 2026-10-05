<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Course;
use App\Models\Student;
use App\Models\TuitionFee;
use Carbon\Carbon;

/**
 * Short, practical hints shown next to the student's own data:
 *  - profile tips: gaps that would weaken an application
 *  - preference tips: live feedback on the study preferences being entered
 *
 * Every tip is ['type' => 'success'|'info'|'warning', 'icon' => bootstrap icon, 'text' => string].
 */
class StudentTips
{
    /**
     * @return array<int, array{type: string, icon: string, text: string}>
     */
    public function profileTips(Student $student): array
    {
        $student->loadMissing('user', 'preferences');

        $tips = [];

        if (!$student->user?->profile_image) {
            $tips[] = $this->tip('info', 'bi-person-bounding-box', 'Add a profile photo from Account Settings so your consultant can recognise you.');
        }

        if (!$student->passport_number) {
            $tips[] = $this->tip('warning', 'bi-passport', 'Add your passport number. Almost every university application and visa needs it.');
        }

        if ($student->date_of_birth) {
            $age = $student->date_of_birth->age;

            if ($age < 18) {
                $tips[] = $this->tip('info', 'bi-person-heart', "You are {$age}. Many universities need a parent or guardian to sign for applicants under 18.");
            }
        } else {
            $tips[] = $this->tip('warning', 'bi-calendar-event', 'Add your date of birth so we can check age-based course eligibility.');
        }

        if (!$student->user?->phone) {
            $tips[] = $this->tip('warning', 'bi-telephone', 'Add a phone number so your consultant can reach you about appointments.');
        }

        if (!$student->englishQualifications()->exists()) {
            $tips[] = $this->tip('info', 'bi-translate', 'You have no English test result yet. Most courses abroad ask for IELTS, TOEFL or PTE.');
        }

        if (!$student->preferences) {
            $tips[] = $this->tip('info', 'bi-sliders', 'Set your study preferences so recommendations match what you actually want.');
        }

        if ($tips === []) {
            $tips[] = $this->tip('success', 'bi-patch-check-fill', 'Your profile looks strong. Nothing is holding it back.');
        }

        return $tips;
    }

    /**
     * @param  array{preferred_country_id?: mixed, preferred_course_level?: mixed, preferred_course_field?: mixed, max_budget?: mixed, preferred_intake?: mixed}  $input
     * @return array<int, array{type: string, icon: string, text: string}>
     */
    public function preferenceTips(Student $student, array $input): array
    {
        $tips = [];

        $countryId = filled($input['preferred_country_id'] ?? null) ? (int) $input['preferred_country_id'] : null;
        $level = $input['preferred_course_level'] ?? null;
        $field = trim((string) ($input['preferred_course_field'] ?? ''));
        $maxBudget = filled($input['max_budget'] ?? null) && is_numeric($input['max_budget'])
            ? (float) $input['max_budget']
            : null;

        // --- Matching courses + budget -------------------------------------------------
        $courses = Course::query()->where('is_active', true);

        if ($countryId) {
            $courses->whereHas('university', fn ($query) => $query->where('country_id', $countryId));
        }
        if ($level) {
            $courses->where('course_level', $level);
        }
        if ($field !== '') {
            $courses->where('field_of_study', 'like', '%' . $field . '%');
        }

        if ($countryId || $level || $field !== '') {
            $courseIds = (clone $courses)->pluck('course_id');
            $countryName = $countryId ? Country::find($countryId)?->country_name : null;
            $where = $countryName ? " in {$countryName}" : '';

            if ($courseIds->isEmpty()) {
                $tips[] = $this->tip('warning', 'bi-search', "No active courses{$where} match these preferences yet. Try a broader field or level.");
            } else {
                $count = $courseIds->count();
                $tips[] = $this->tip('success', 'bi-mortarboard-fill', "{$count} " . ($count === 1 ? 'course' : 'courses') . "{$where} match your preferences.");

                $budgetTip = $this->budgetTip($courseIds->all(), $maxBudget);
                if ($budgetTip) {
                    $tips[] = $budgetTip;
                }
            }
        }

        // --- Intake timing -------------------------------------------------------------
        $intakeTip = $this->intakeTip((string) ($input['preferred_intake'] ?? ''));
        if ($intakeTip) {
            $tips[] = $intakeTip;
        }

        // --- Level vs. qualifications on file ------------------------------------------
        $levelTip = $this->levelTip($student, $level);
        if ($levelTip) {
            $tips[] = $levelTip;
        }

        return $tips;
    }

    private function budgetTip(array $courseIds, ?float $maxBudget): ?array
    {
        if ($maxBudget === null) {
            return null;
        }

        $fees = TuitionFees::yearly(
            TuitionFee::query()->whereIn('course_id', $courseIds)->get(['amount', 'currency', 'fee_period'])
        );

        if ($fees->isEmpty()) {
            return null;
        }

        // Budgets carry no currency, so compare against the most common one in the data.
        $currency = $fees->groupBy('currency')->sortByDesc(fn ($group) => $group->count())->keys()->first();
        $amounts = $fees->where('currency', $currency)->pluck('amount');

        $lowest = $amounts->min();
        $average = $amounts->avg();
        $format = fn (float $value) => $currency . ' ' . number_format($value);

        return match (true) {
            $maxBudget < $lowest => $this->tip('warning', 'bi-cash-coin',
                "Your maximum budget is below the cheapest matching course ({$format($lowest)}). Consider raising it or looking at other countries."),
            $maxBudget < $average => $this->tip('info', 'bi-cash-coin',
                "Your maximum budget is below the average tuition for these courses ({$format($average)}), but some options fit."),
            default => $this->tip('success', 'bi-cash-coin',
                "Your maximum budget covers the average tuition for these courses ({$format($average)})."),
        };
    }

    private function intakeTip(string $intake): ?array
    {
        $intake = trim($intake);

        if ($intake === '') {
            return null;
        }

        $timestamp = strtotime('1 ' . $intake);

        if ($timestamp === false) {
            return null;
        }

        $start = Carbon::createFromTimestamp($timestamp)->startOfMonth();
        $months = (int) floor(now()->startOfMonth()->diffInMonths($start, false));

        return match (true) {
            $months < 0 => $this->tip('warning', 'bi-calendar-x', 'That intake has already passed. Pick a future intake.'),
            $months < 3 => $this->tip('warning', 'bi-alarm', "Your intake is only {$months} " . ($months === 1 ? 'month' : 'months') . ' away. Start your documents now. Most applications take 2 to 3 months.'),
            $months < 6 => $this->tip('info', 'bi-calendar-check', "Your intake is {$months} months away. A good time to prepare documents and book a consultation."),
            default => $this->tip('success', 'bi-calendar-check', "Your intake is {$months} months away, so there is plenty of time to prepare."),
        };
    }

    private function levelTip(Student $student, ?string $level): ?array
    {
        if (!in_array($level, ['Master', 'PhD', 'Bachelor'], true)) {
            return null;
        }

        $types = $student->academicQualifications()->pluck('qualification_type');

        if ($types->isEmpty()) {
            return $this->tip('info', 'bi-mortarboard', "Add your academic qualifications so we can check you are eligible for a {$level} course.");
        }

        $entry = match ($level) {
            'PhD' => ['Master'],
            'Master' => ['Bachelor', 'Master'],
            default => ['A_Level', 'Diploma', 'HND', 'Bachelor', 'Master'],
        };

        if ($types->intersect($entry)->isEmpty()) {
            $need = match ($level) {
                'PhD' => 'a Master degree',
                'Master' => 'a Bachelor degree',
                default => 'A Levels, a Diploma or HND',
            };

            return $this->tip('warning', 'bi-exclamation-circle', "A {$level} course normally needs {$need}, and none is on your Qualifications page yet.");
        }

        return null;
    }

    private function tip(string $type, string $icon, string $text): array
    {
        return compact('type', 'icon', 'text');
    }
}
