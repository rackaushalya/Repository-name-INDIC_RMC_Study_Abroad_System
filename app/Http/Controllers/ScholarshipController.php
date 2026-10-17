<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Scholarship;
use App\Support\CurrencyCodes;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ScholarshipController extends Controller
{
    private const MESSAGES = [
        'university_id.exists' => 'Please choose a university from the list.',
        'course_id.exists' => 'Please choose a course from the list.',
        'amount.numeric' => 'The award amount must be a number, for example 10000.',
        'currency.required_with' => 'Please choose a currency for the award amount.',
        'currency.in' => 'Please choose a currency from the list.',
        'award_type.required' => 'Please choose an award type.',
        'award_type.in' => 'Please choose an award type from the list.',
        'percentage.max' => 'The tuition coverage cannot be more than 100%.',
        'application_deadline.date' => 'Please enter a valid deadline date.',
    ];

    /**
     * Display all scholarships.
     */
    public function index()
    {
        $scholarships = Scholarship::with([
            'university.country',
            'course',
        ])
            ->orderBy('scholarship_name')
            ->paginate(20);

        return view(
            'admin.scholarships',
            compact('scholarships')
        );
    }

    public function create()
    {
        return redirect()->route('admin.scholarships.index');
    }

    /**
     * Store a new scholarship.
     */
    public function store(Request $request)
    {
        Scholarship::create($this->validatedFields($request));

        return redirect()
            ->route('admin.scholarships.index')
            ->with(
                'success',
                'Scholarship created successfully.'
            );
    }

    public function show(Scholarship $scholarship)
    {
        return redirect()->route('admin.scholarships.index');
    }

    public function edit(Scholarship $scholarship)
    {
        return redirect()->route('admin.scholarships.index');
    }

    /**
     * Update a scholarship.
     */
    public function update(
        Request $request,
        Scholarship $scholarship
    ) {
        $scholarship->update($this->validatedFields($request));

        return redirect()
            ->route('admin.scholarships.index')
            ->with(
                'success',
                'Scholarship updated successfully.'
            );
    }

    /**
     * Delete a scholarship permanently.
     * (To hide one without deleting it, set its Status to Inactive instead.)
     */
    public function destroy(Scholarship $scholarship)
    {
        $name = $scholarship->scholarship_name;

        $scholarship->delete();

        return redirect()
            ->route('admin.scholarships.index')
            ->with(
                'success',
                'Scholarship "' . $name . '" deleted.'
            );
    }

    /**
     * Validate the form and return the fields to save.
     */
    private function validatedFields(Request $request): array
    {
        // Currency in capitals before checking ("lkr" -> "LKR").
        $request->merge([
            'currency' => $request->filled('currency')
                ? strtoupper(trim($request->input('currency')))
                : null,
        ]);

        $validated = $request->validate([
            'university_id' => [
                'nullable',
                'integer',
                'exists:universities,university_id'
            ],
            'course_id' => [
                'nullable',
                'integer',
                'exists:courses,course_id'
            ],
            'scholarship_name' => [
                'required',
                'string',
                'max:255'
            ],
            'award_type' => [
                'required',
                'in:' . implode(',', array_keys(Scholarship::AWARD_TYPES))
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'amount' => [
                'nullable',
                'numeric',
                'min:0',
                'max:9999999999'
            ],
            'currency' => [
                'nullable',
                'required_with:amount',
                'in:' . implode(',', CurrencyCodes::codes())
            ],
            'percentage' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],
            'eligibility' => [
                'nullable',
                'string'
            ],
            'application_deadline' => [
                'nullable',
                'date'
            ],
            'is_active' => [
                'boolean'
            ],
        ], self::MESSAGES);

        // A course always belongs to a university: fill in or check the university.
        if (!empty($validated['course_id'])) {
            $courseUniversity = Course::whereKey($validated['course_id'])->value('university_id');

            if (empty($validated['university_id'])) {
                $validated['university_id'] = $courseUniversity;
            } elseif ((int) $validated['university_id'] !== (int) $courseUniversity) {
                throw ValidationException::withMessages([
                    'course_id' => 'The chosen course does not belong to the chosen university.',
                ]);
            }
        }

        // Currency only makes sense with an amount.
        $validated['currency'] = ($validated['amount'] ?? null) !== null && !empty($validated['currency'])
            ? strtoupper(trim($validated['currency']))
            : null;

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}