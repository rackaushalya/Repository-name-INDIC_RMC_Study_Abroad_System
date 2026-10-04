<?php

namespace App\Services;

use App\Models\EnglishRequirement;

/**
 * Converts an English test score into approximate equivalents on the other
 * tests, and counts how many courses in the system the score would satisfy.
 *
 * Conversion is anchored on IELTS bands. The figures are the commonly
 * published concordance values and are only approximate. Universities make
 * the final call.
 */
class EnglishScoreConverter
{
    /**
     * IELTS band => equivalent score on each other test.
     */
    private const TABLE = [
        '5.0' => ['TOEFL' => 35, 'PTE' => 36, 'Duolingo' => 80, 'Cambridge' => 154],
        '5.5' => ['TOEFL' => 46, 'PTE' => 42, 'Duolingo' => 95, 'Cambridge' => 162],
        '6.0' => ['TOEFL' => 60, 'PTE' => 50, 'Duolingo' => 105, 'Cambridge' => 169],
        '6.5' => ['TOEFL' => 79, 'PTE' => 58, 'Duolingo' => 115, 'Cambridge' => 176],
        '7.0' => ['TOEFL' => 94, 'PTE' => 65, 'Duolingo' => 125, 'Cambridge' => 185],
        '7.5' => ['TOEFL' => 102, 'PTE' => 73, 'Duolingo' => 135, 'Cambridge' => 191],
        '8.0' => ['TOEFL' => 110, 'PTE' => 79, 'Duolingo' => 145, 'Cambridge' => 197],
        '8.5' => ['TOEFL' => 115, 'PTE' => 83, 'Duolingo' => 150, 'Cambridge' => 200],
        '9.0' => ['TOEFL' => 120, 'PTE' => 90, 'Duolingo' => 160, 'Cambridge' => 210],
    ];

    public const TESTS = ['IELTS', 'TOEFL', 'PTE', 'Duolingo', 'Cambridge'];

    /**
     * Highest score each test accepts (used for input validation).
     */
    public const MAX_SCORE = [
        'IELTS' => 9,
        'TOEFL' => 120,
        'PTE' => 90,
        'Duolingo' => 160,
        'Cambridge' => 230,
    ];

    /**
     * IELTS band (as a string key of TABLE) a score on $test is worth,
     * or null when it falls below the lowest band we have data for.
     */
    public function toIeltsBand(string $test, float $score): ?string
    {
        if ($test === 'IELTS') {
            $band = floor($score * 2) / 2;

            return $band >= 5.0 ? number_format(min($band, 9.0), 1) : null;
        }

        $matched = null;

        foreach (self::TABLE as $band => $equivalents) {
            if ($score >= $equivalents[$test]) {
                $matched = (string) $band;
            }
        }

        return $matched;
    }

    /**
     * @return array<string, string|int> equivalent score per test, keyed by test name.
     */
    public function equivalents(string $band): array
    {
        return ['IELTS' => $band] + self::TABLE[$band];
    }

    /**
     * How many courses (that publish an English requirement) the score meets.
     *
     * A course counts when the score, converted to the test the course asks
     * for, reaches that test's minimum overall score. If a course accepts
     * several tests, meeting any one of them is enough.
     *
     * @return array{qualifying: int, total: int}
     */
    public function qualifyingCourses(string $band): array
    {
        $equivalents = $this->equivalents($band);

        $requirements = EnglishRequirement::query()
            ->whereHas('course', fn ($query) => $query->where('is_active', true))
            ->whereNotNull('minimum_overall_score')
            ->get(['course_id', 'test_type', 'minimum_overall_score'])
            ->groupBy('course_id');

        $qualifying = $requirements->filter(function ($rows) use ($equivalents) {
            return $rows->contains(function ($row) use ($equivalents) {
                $mine = $equivalents[$row->test_type] ?? null;

                return $mine !== null && (float) $mine >= (float) $row->minimum_overall_score;
            });
        })->count();

        return ['qualifying' => $qualifying, 'total' => $requirements->count()];
    }
}
