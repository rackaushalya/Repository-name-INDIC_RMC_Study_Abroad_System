<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Collection;

/**
 * Finds the courses a student is closest to qualifying for.
 *
 * Every active course is checked against whatever entry requirements it
 * publishes: qualification level, GPA, English score, age, work experience,
 * field of study and tuition against the student's budget. A course only
 * gets a check for a requirement it actually defines.
 */
class EligibilityMatcher
{
    /** Lowest to highest. A student meets a level if they hold that level or a higher one. */
    private const LEVEL_ORDER = [
        'O_Level' => 1,
        'A_Level' => 2,
        'Certificate' => 3,
        'Diploma' => 4,
        'HND' => 5,
        'Bachelor' => 6,
        'Master' => 7,
        'PhD' => 8,
    ];

    public function __construct(private EnglishScoreConverter $converter)
    {
    }

    /**
     * Best matches first.
     *
     * @return Collection<int, array{
     *     course: Course,
     *     checks: array<int, array{label: string, passed: bool, detail: string}>,
     *     passed: int,
     *     total: int,
     *     percent: int,
     *     status: string
     * }>
     */
    public function topMatches(?Student $student, int $limit = 3): Collection
    {
        if (!$student) {
            return collect();
        }

        $student->loadMissing('preferences');
        $profile = $this->profile($student);

        return Course::query()
            ->where('is_active', true)
            ->with(['university.country', 'requirements', 'englishRequirements', 'tuitionFees'])
            ->get()
            ->map(fn (Course $course) => $this->evaluate($course, $profile, $student))
            ->sortBy([
                // Courses with nothing to check against rank below ones we could actually assess.
                fn ($a, $b) => ($b['total'] > 0) <=> ($a['total'] > 0),
                fn ($a, $b) => ($b['status'] === 'eligible') <=> ($a['status'] === 'eligible'),
                fn ($a, $b) => $b['preference_score'] <=> $a['preference_score'],
                fn ($a, $b) => $b['percent'] <=> $a['percent'],
                fn ($a, $b) => $b['total'] <=> $a['total'],
            ])
            ->take($limit)
            ->values();
    }

    /**
     * Check one specific course against the student (used by the admission roadmap).
     * Same rules as topMatches(), so the two can never disagree.
     */
    public function assess(Student $student, Course $course): array
    {
        $student->loadMissing('preferences');
        $course->loadMissing(['university.country', 'requirements', 'englishRequirements', 'tuitionFees']);

        return $this->evaluate($course, $this->profile($student), $student);
    }

    /**
     * What we know about the student, gathered once for all courses.
     */
    private function profile(Student $student): array
    {
        $qualifications = $student->academicQualifications()->get();

        $highestLevel = $qualifications
            ->map(fn ($q) => self::LEVEL_ORDER[$q->qualification_type] ?? 0)
            ->max() ?? 0;

        // GPAs can be saved on a 0-4 scale or as a percentage; treat anything above 4 as a percentage.
        $gpa = $qualifications->pluck('gpa')->filter(fn ($v) => $v !== null)
            ->map(fn ($v) => (float) $v > 4 ? (float) $v / 25 : (float) $v)
            ->max();

        $bestBand = $student->englishQualifications()->get()
            ->map(fn ($e) => in_array($e->test_type, EnglishScoreConverter::TESTS, true) && $e->overall_score !== null
                ? $this->converter->toIeltsBand($e->test_type, (float) $e->overall_score)
                : null)
            ->filter()
            ->max();

        $workMonths = (int) $student->workExperiences()->get()
            ->sum(function ($work) {
                if (!$work->start_date) {
                    return 0;
                }
                $end = $work->is_current || !$work->end_date ? now() : $work->end_date;

                return max(0, (int) floor($work->start_date->diffInMonths($end)));
            });

        return [
            'highest_level' => $highestLevel,
            'fields' => $qualifications->pluck('field_of_study')->filter()->map(fn ($f) => mb_strtolower($f))->all(),
            'gpa' => $gpa,
            'ielts_band' => $bestBand,
            'age' => $student->date_of_birth?->age,
            'work_months' => $workMonths,
            'max_budget' => $student->preferences?->max_budget !== null ? (float) $student->preferences->max_budget : null,
        ];
    }

    private function evaluate(Course $course, array $profile, Student $student): array
    {
        $checks = [];
        $req = $course->requirements;

        if ($req?->required_qualification_level) {
            $needed = self::LEVEL_ORDER[$req->required_qualification_level] ?? 0;
            $label = str_replace('_', ' ', $req->required_qualification_level);
            $checks[] = $this->check(
                'Qualification level',
                $profile['highest_level'] >= $needed,
                $profile['highest_level'] >= $needed
                    ? "You hold {$label} or higher."
                    : "Needs {$label} or higher. Add it on your Qualifications page."
            );
        }

        if ($req?->minimum_gpa !== null) {
            $min = (float) $req->minimum_gpa;
            $has = $profile['gpa'];
            $checks[] = $this->check(
                'GPA',
                $has !== null && $has >= $min,
                $has === null
                    ? "Needs a GPA of {$min}. You have not added one yet."
                    : ($has >= $min ? 'Your GPA of ' . round($has, 2) . " meets the {$min} minimum." : "Needs {$min}, you have " . round($has, 2) . '.')
            );
        }

        if ($course->englishRequirements->isNotEmpty()) {
            $checks[] = $this->englishCheck($course, $profile['ielts_band']);
        }

        if ($req?->minimum_age !== null || $req?->maximum_age !== null) {
            $age = $profile['age'];
            $ok = $age !== null
                && ($req->minimum_age === null || $age >= $req->minimum_age)
                && ($req->maximum_age === null || $age <= $req->maximum_age);
            $range = trim(($req->minimum_age ?? '') . '-' . ($req->maximum_age ?? ''), '-');
            $checks[] = $this->check(
                'Age',
                $ok,
                $age === null ? 'Add your date of birth to check the age rule.' : ($ok ? "Your age ({$age}) is within the allowed range." : "Applicants must be {$range}. You are {$age}.")
            );
        }

        if (($req?->minimum_work_experience_months ?? 0) > 0) {
            $need = (int) $req->minimum_work_experience_months;
            $has = $profile['work_months'];
            $checks[] = $this->check(
                'Work experience',
                $has >= $need,
                $has >= $need ? "You have {$has} months of experience." : "Needs {$need} months of work experience, you have {$has}."
            );
        }

        if ($req?->required_field) {
            $needle = mb_strtolower($req->required_field);
            $ok = collect($profile['fields'])->contains(
                fn ($field) => str_contains($field, $needle) || str_contains($needle, $field)
            );
            $checks[] = $this->check(
                'Field of study',
                $ok,
                $ok ? 'Your background fits.' : "Prefers a background in {$req->required_field}."
            );
        }

        $budgetCheck = $this->budgetCheck($course, $profile['max_budget']);
        if ($budgetCheck) {
            $checks[] = $budgetCheck;
        }

        $passed = collect($checks)->where('passed', true)->count();
        $total = count($checks);

        return [
            'course' => $course,
            'checks' => $checks,
            'passed' => $passed,
            'total' => $total,
            'percent' => $total > 0 ? (int) round(($passed / $total) * 100) : 100,
            'status' => $passed === $total ? 'eligible' : ($passed / $total >= 0.6 ? 'close' : 'far'),
            'preference_score' => $this->preferenceScore($course, $student),
        ];
    }

    private function englishCheck(Course $course, ?string $band): array
    {
        $options = $course->englishRequirements
            ->filter(fn ($r) => in_array($r->test_type, EnglishScoreConverter::TESTS, true) && $r->minimum_overall_score !== null);

        if ($options->isEmpty()) {
            return $this->check('English', true, 'No English score required.');
        }

        $first = $options->first();
        $asked = $first->test_type . ' ' . (float) $first->minimum_overall_score;

        if ($band === null) {
            return $this->check('English', false, "Needs {$asked}. Add an English test result on your Qualifications page.");
        }

        $equivalents = $this->converter->equivalents($band);
        $meets = $options->contains(
            fn ($r) => isset($equivalents[$r->test_type]) && (float) $equivalents[$r->test_type] >= (float) $r->minimum_overall_score
        );

        return $this->check(
            'English',
            $meets,
            $meets ? "Your score is about IELTS {$band}, which meets {$asked}." : "Needs {$asked}. Your score is about IELTS {$band}."
        );
    }

    private function budgetCheck(Course $course, ?float $maxBudget): ?array
    {
        $yearly = TuitionFees::yearly($course->tuitionFees);

        if ($maxBudget === null || $yearly->isEmpty()) {
            return null;
        }

        $cheapestFee = $yearly->sortBy('amount')->first();
        $cheapest = $cheapestFee['amount'];
        $currency = $cheapestFee['currency'];
        $ok = $maxBudget >= $cheapest;

        return $this->check(
            'Budget',
            $ok,
            $ok ? "Tuition from {$currency} " . number_format($cheapest) . ' fits your budget.' : "Tuition starts at {$currency} " . number_format($cheapest) . ', above your budget.'
        );
    }

    /** How well the course lines up with what the student asked for (used for ranking only). */
    private function preferenceScore(Course $course, Student $student): int
    {
        $prefs = $student->preferences;

        if (!$prefs) {
            return 0;
        }

        $score = 0;

        if ($prefs->preferred_country_id && $course->university?->country_id === $prefs->preferred_country_id) {
            $score += 2;
        }
        if ($prefs->preferred_course_level && $course->course_level === $prefs->preferred_course_level) {
            $score += 1;
        }
        if ($prefs->preferred_course_field && $course->field_of_study
            && str_contains(mb_strtolower($course->field_of_study), mb_strtolower($prefs->preferred_course_field))) {
            $score += 1;
        }

        return $score;
    }

    private function check(string $label, bool $passed, string $detail): array
    {
        return compact('label', 'passed', 'detail');
    }
}
