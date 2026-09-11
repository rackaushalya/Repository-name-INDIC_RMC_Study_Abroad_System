<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\TuitionFee;
use Illuminate\Http\Request;

class TuitionFeeController extends Controller
{
    /**
     * Display all tuition fees.
     */
    public function index()
    {
        $tuitionFees = TuitionFee::with('course.university')
            ->latest('tuition_fee_id')
            ->paginate(20);

        return view(
            'admin.tuition-fees.index',
            compact('tuitionFees')
        );
    }

    /**
     * Show create tuition fee form.
     */
    public function create()
    {
        $courses = Course::where('is_active', true)
            ->with('university')
            ->orderBy('course_name')
            ->get();

        return view(
            'admin.tuition-fees.create',
            compact('courses')
        );
    }

    /**
     * Store a new tuition fee.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => [
                'required',
                'integer',
                'exists:courses,course_id'
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0'
            ],
            'currency' => [
                'required',
                'string',
                'max:10'
            ],
            'fee_period' => [
                'required',
                'in:Year,Semester,Course,Other'
            ],
            'effective_from' => [
                'nullable',
                'date'
            ],
            'effective_to' => [
                'nullable',
                'date',
                'after_or_equal:effective_from'
            ],
        ]);

        TuitionFee::create($validated);

        return redirect()
            ->route('admin.tuition-fees.index')
            ->with(
                'success',
                'Tuition fee created successfully.'
            );
    }

    /**
     * Display a tuition fee.
     */
    public function show(TuitionFee $tuitionFee)
    {
        $tuitionFee->load([
            'course.university'
        ]);

        return view(
            'admin.tuition-fees.show',
            compact('tuitionFee')
        );
    }

    /**
     * Show edit tuition fee form.
     */
    public function edit(TuitionFee $tuitionFee)
    {
        $courses = Course::where('is_active', true)
            ->with('university')
            ->orderBy('course_name')
            ->get();

        return view(
            'admin.tuition-fees.edit',
            compact(
                'tuitionFee',
                'courses'
            )
        );
    }

    /**
     * Update a tuition fee.
     */
    public function update(
        Request $request,
        TuitionFee $tuitionFee
    ) {
        $validated = $request->validate([
            'course_id' => [
                'required',
                'integer',
                'exists:courses,course_id'
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0'
            ],
            'currency' => [
                'required',
                'string',
                'max:10'
            ],
            'fee_period' => [
                'required',
                'in:Year,Semester,Course,Other'
            ],
            'effective_from' => [
                'nullable',
                'date'
            ],
            'effective_to' => [
                'nullable',
                'date',
                'after_or_equal:effective_from'
            ],
        ]);

        $tuitionFee->update($validated);

        return redirect()
            ->route('admin.tuition-fees.index')
            ->with(
                'success',
                'Tuition fee updated successfully.'
            );
    }

    /**
     * Delete a tuition fee.
     */
    public function destroy(TuitionFee $tuitionFee)
    {
        $tuitionFee->delete();

        return redirect()
            ->route('admin.tuition-fees.index')
            ->with(
                'success',
                'Tuition fee deleted successfully.'
            );
    }
}