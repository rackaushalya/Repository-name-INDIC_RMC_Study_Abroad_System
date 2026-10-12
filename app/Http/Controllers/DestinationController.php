<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Student;
use App\Services\DestinationExplorer;
use App\Services\EligibilityMatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    private const MAX_COMPARE = 3;

    public function __construct(private DestinationExplorer $explorer)
    {
    }

    private function student(): Student
    {
        $student = Auth::user()?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        return $student;
    }

    /**
     * Interactive map, search, filters and the matching countries.
     */
    public function index(Request $request)
    {
        $student = $this->student();

        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'level' => ['nullable', 'string', 'max:50'],
            'field' => ['nullable', 'string', 'max:100'],
            'budget' => ['nullable', 'numeric', 'min:0'],
        ]);

        $destinations = $this->explorer->summaries($filters);
        $options = $this->explorer->filterOptions();
        $preferredCountryId = $student->preferences?->preferred_country_id;

        return view('student.destinations.index', compact('destinations', 'options', 'filters', 'preferredCountryId'));
    }

    /**
     * One country: universities, courses, costs, scholarships and documents.
     */
    public function show(Country $country, EligibilityMatcher $matcher)
    {
        $student = $this->student();

        abort_unless($country->is_active, 404);

        $detail = $this->explorer->detail($country);

        // How the student stacks up for each course here (uses the shared eligibility rules).
        $fit = $detail['universities']
            ->flatMap->courses
            ->mapWithKeys(fn ($course) => [$course->course_id => $matcher->assess($student, $course)]);

        return view('student.destinations.show', $detail + ['fit' => $fit]);
    }

    /**
     * Side-by-side comparison of up to three countries.
     */
    public function compare(Request $request)
    {
        $this->student();

        $data = $request->validate([
            'ids' => ['nullable', 'array', 'max:' . self::MAX_COMPARE],
            'ids.*' => ['integer', 'exists:countries,country_id'],
        ], [
            'ids.max' => 'You can compare up to ' . self::MAX_COMPARE . ' countries at a time.',
        ]);

        $ids = collect($data['ids'] ?? [])->unique()->values();

        if ($ids->count() < 2) {
            return redirect()
                ->route('student.destinations.index')
                ->with('error', 'Pick at least two countries to compare.');
        }

        $countries = Country::where('is_active', true)
            ->whereIn('country_id', $ids)
            ->get()
            ->sortBy(fn ($country) => $ids->search($country->country_id))
            ->values();

        $columns = $countries->map(fn ($country) => $this->explorer->detail($country));

        return view('student.destinations.compare', compact('columns'));
    }
}
