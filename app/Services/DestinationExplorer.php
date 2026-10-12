<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Course;
use App\Models\RequiredDocument;
use App\Models\Scholarship;
use Illuminate\Support\Collection;

/**
 * Data behind the Study Destination Explorer: one summary per country that
 * respects the search/filters, plus the full detail of a single country.
 */
class DestinationExplorer
{
    /**
     * Rough map centre for a country, keyed by lower-case name. The countries
     * table has no coordinates, so the map falls back to this list; countries
     * missing here still appear in the results, just not on the map.
     */
    private const COORDINATES = [
        'uk' => [54.0, -2.5], 'united kingdom' => [54.0, -2.5], 'england' => [52.5, -1.5],
        'usa' => [39.8, -98.6], 'united states' => [39.8, -98.6], 'united states of america' => [39.8, -98.6],
        'canada' => [56.1, -106.3], 'australia' => [-25.3, 133.8], 'new zealand' => [-41.3, 174.8],
        'ireland' => [53.4, -8.2], 'germany' => [51.2, 10.4], 'france' => [46.2, 2.2],
        'netherlands' => [52.1, 5.3], 'sweden' => [60.1, 18.6], 'norway' => [60.5, 8.5],
        'denmark' => [56.3, 9.5], 'finland' => [61.9, 25.7], 'italy' => [41.9, 12.6],
        'spain' => [40.5, -3.7], 'switzerland' => [46.8, 8.2], 'austria' => [47.5, 14.6],
        'belgium' => [50.5, 4.5], 'poland' => [51.9, 19.1], 'hungary' => [47.2, 19.5],
        'malta' => [35.9, 14.4], 'cyprus' => [35.1, 33.4], 'taiwan' => [23.7, 121.0],
        'japan' => [36.2, 138.3], 'south korea' => [35.9, 127.8], 'china' => [35.9, 104.2],
        'singapore' => [1.35, 103.8], 'malaysia' => [4.2, 101.9], 'hong kong' => [22.3, 114.2],
        'india' => [20.6, 78.9], 'sri lanka' => [7.9, 80.8], 'dubai' => [25.2, 55.3],
        'uae' => [23.4, 53.8], 'united arab emirates' => [23.4, 53.8], 'russia' => [61.5, 105.3],
        'turkey' => [38.9, 35.2], 'south africa' => [-30.6, 22.9],
    ];

    /** ISO alpha-2 code by lower-case name, used for flag images. */
    private const ALPHA2 = [
        'uk' => 'gb', 'united kingdom' => 'gb', 'england' => 'gb', 'usa' => 'us', 'united states' => 'us',
        'united states of america' => 'us', 'canada' => 'ca', 'australia' => 'au', 'new zealand' => 'nz',
        'ireland' => 'ie', 'germany' => 'de', 'france' => 'fr', 'netherlands' => 'nl', 'sweden' => 'se',
        'norway' => 'no', 'denmark' => 'dk', 'finland' => 'fi', 'italy' => 'it', 'spain' => 'es',
        'switzerland' => 'ch', 'austria' => 'at', 'belgium' => 'be', 'poland' => 'pl', 'hungary' => 'hu',
        'malta' => 'mt', 'cyprus' => 'cy', 'taiwan' => 'tw', 'japan' => 'jp', 'south korea' => 'kr',
        'china' => 'cn', 'singapore' => 'sg', 'malaysia' => 'my', 'hong kong' => 'hk', 'india' => 'in',
        'sri lanka' => 'lk', 'dubai' => 'ae', 'uae' => 'ae', 'united arab emirates' => 'ae', 'russia' => 'ru',
        'turkey' => 'tr', 'south africa' => 'za',
    ];

    /** One colour per country, so a country looks the same on the map and on its card. */
    private const PALETTE = [
        '#f97316', '#2563eb', '#16a34a', '#9333ea', '#e11d48',
        '#0891b2', '#ca8a04', '#db2777', '#4f46e5', '#059669',
    ];

    /**
     * @param  array{q?: ?string, level?: ?string, field?: ?string, budget?: ?numeric}  $filters
     * @return Collection<int, array>
     */
    public function summaries(array $filters = []): Collection
    {
        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->with(['universities' => fn ($q) => $q->where('is_active', true)])
            ->get();

        $courses = Course::where('is_active', true)
            ->with(['university', 'tuitionFees', 'intakes'])
            ->get()
            ->groupBy(fn ($course) => $course->university?->country_id);

        $scholarships = $this->scholarshipCounts();

        return $countries
            ->map(fn (Country $country) => $this->summarise($country, $courses->get($country->country_id, collect()), $scholarships, $filters))
            ->filter()
            ->values();
    }

    /**
     * Full detail for one country page.
     */
    public function detail(Country $country): array
    {
        $universities = $country->universities()
            ->where('is_active', true)
            ->with(['courses' => fn ($q) => $q->where('is_active', true)->with(['tuitionFees', 'intakes'])])
            ->orderBy('university_name')
            ->get();

        $courses = $universities->flatMap->courses;
        $fees = $this->cheapestFee($courses);

        $scholarships = Scholarship::where('is_active', true)
            ->where(function ($q) use ($universities, $courses) {
                $q->whereIn('university_id', $universities->pluck('university_id'))
                    ->orWhereIn('course_id', $courses->pluck('course_id'));
            })
            ->orderBy('application_deadline')
            ->get();

        $documents = RequiredDocument::where('is_active', true)
            ->where(fn ($q) => $q->whereNull('country_id')->orWhere('country_id', $country->country_id))
            ->orderBy('document_name')
            ->get();

        return [
            'country' => $country,
            'universities' => $universities,
            'course_count' => $courses->count(),
            'levels' => $courses->pluck('course_level')->filter()->unique()->sort()->values(),
            'fields' => $courses->pluck('field_of_study')->filter()->unique()->sort()->values(),
            'cheapest_fee' => $fees,
            'scholarships' => $scholarships,
            'documents' => $documents,
            'next_intake' => $courses->flatMap(fn ($course) => $course->intakeList())
                ->filter(fn ($i) => $i->application_close_date && $i->application_close_date->endOfDay()->isFuture())
                ->sortBy('application_close_date')
                ->first(),
        ];
    }

    /**
     * Filter choices for the explorer's dropdowns.
     */
    public function filterOptions(): array
    {
        $courses = Course::where('is_active', true)->get(['course_level', 'field_of_study']);

        return [
            'levels' => $courses->pluck('course_level')->filter()->unique()->sort()->values(),
            'fields' => $courses->pluck('field_of_study')->filter()->unique()->sort()->values(),
        ];
    }

    /** [lat, lng] or null when we do not know where the country is. */
    public function coordinates(Country $country): ?array
    {
        return self::COORDINATES[mb_strtolower(trim($country->country_name))] ?? null;
    }

    private function summarise(Country $country, Collection $courses, Collection $scholarships, array $filters): ?array
    {
        $q = mb_strtolower(trim((string) ($filters['q'] ?? '')));
        $level = $filters['level'] ?? null;
        $field = mb_strtolower(trim((string) ($filters['field'] ?? '')));
        $budget = isset($filters['budget']) && $filters['budget'] !== '' ? (float) $filters['budget'] : null;

        $matching = $courses->filter(function (Course $course) use ($level, $field, $budget) {
            if ($level && $course->course_level !== $level) {
                return false;
            }

            if ($field !== '' && !str_contains(mb_strtolower((string) $course->field_of_study), $field)) {
                return false;
            }

            if ($budget !== null) {
                $cheapest = TuitionFees::yearly($course->tuitionFees)->min('amount');

                // Courses with no published fee are kept: we cannot say they are too expensive.
                if ($cheapest !== null && $cheapest > $budget) {
                    return false;
                }
            }

            return true;
        });

        $courseFiltersActive = $level || $field !== '' || $budget !== null;

        if ($courseFiltersActive && $matching->isEmpty()) {
            return null;
        }

        if ($q !== '') {
            $haystack = mb_strtolower($country->country_name . ' ' . $country->description)
                . ' ' . $country->universities->pluck('university_name')->map(fn ($n) => mb_strtolower($n))->implode(' ')
                . ' ' . $matching->pluck('course_name')->map(fn ($n) => mb_strtolower($n))->implode(' ');

            if (!str_contains($haystack, $q)) {
                return null;
            }
        }

        $coords = $this->coordinates($country);

        $nextDeadline = $matching
            ->flatMap(fn ($course) => $course->intakeList())
            ->filter(fn ($i) => $i->application_close_date && $i->application_close_date->endOfDay()->isFuture())
            ->sortBy('application_close_date')
            ->first()?->application_close_date;

        return [
            'country' => $country,
            'color' => self::PALETTE[$country->country_id % count(self::PALETTE)],
            'flag' => $this->flagCode($country),
            'top_universities' => $country->universities->sortBy(fn ($u) => $u->ranking ?? PHP_INT_MAX)->take(3)->pluck('university_name')->all(),
            'fields' => $matching->pluck('field_of_study')->filter()->unique()->take(4)->values()->all(),
            'next_deadline' => $nextDeadline,
            'universities' => $country->universities->count(),
            'courses' => $matching->count(),
            'levels' => $matching->pluck('course_level')->filter()->unique()->sort()->values()->all(),
            'cheapest_fee' => $this->cheapestFee($matching),
            'scholarships' => $scholarships->get($country->country_id, 0),
            'lat' => $coords[0] ?? null,
            'lng' => $coords[1] ?? null,
        ];
    }

    /** Two-letter flag code, or null when we cannot tell which country this is. */
    private function flagCode(Country $country): ?string
    {
        // The name is more reliable than the stored code (the data has "SL" for Sri Lanka, which is Sierra Leone's code).
        $byName = self::ALPHA2[mb_strtolower(trim($country->country_name))] ?? null;

        if ($byName) {
            return $byName;
        }

        $code = mb_strtolower((string) $country->country_code);

        return strlen($code) === 2 ? $code : null;
    }

    /** @return array{amount: float, currency: string}|null */
    private function cheapestFee(Collection $courses): ?array
    {
        return $courses
            ->flatMap(fn ($course) => TuitionFees::yearly($course->tuitionFees))
            ->sortBy('amount')
            ->first();
    }

    /** @return Collection<int, int> country_id => number of active scholarships */
    private function scholarshipCounts(): Collection
    {
        return Scholarship::where('scholarships.is_active', true)
            ->leftJoin('universities', 'universities.university_id', '=', 'scholarships.university_id')
            ->leftJoin('courses', 'courses.course_id', '=', 'scholarships.course_id')
            ->leftJoin('universities as course_unis', 'course_unis.university_id', '=', 'courses.university_id')
            ->selectRaw('COALESCE(universities.country_id, course_unis.country_id) as country_id')
            ->get()
            ->pluck('country_id')
            ->filter()
            ->countBy();
    }
}
