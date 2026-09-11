<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Recommendation;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    /**
     * Get the currently logged-in student.
     */
    private function getStudent(): Student
    {
        $user = Auth::user();

        $student = $user?->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        return $student;
    }

    /**
     * Display recommendations.
     */
    public function index()
    {
        $student = $this->getStudent();

        $recommendations = Recommendation::with([
            'course.university'
        ])
            ->where(
                'student_id',
                $student->student_id
            )
            ->latest('recommendation_id')
            ->paginate(10);

        return view(
            'student.recommendations.index',
            compact('recommendations')
        );
    }

    /**
     * Display a recommendation.
     */
    public function show(
        Recommendation $recommendation
    ) {
        $student = $this->getStudent();

        if (
            $recommendation->student_id !==
            $student->student_id
        ) {
            abort(403);
        }

        $recommendation->load([
            'course.university',
            'course.requirements',
            'course.englishRequirements',
            'course.tuitionFees'
        ]);

        return view(
            'student.recommendations.show',
            compact('recommendation')
        );
    }

    /**
     * Generate course recommendations.
     */
    public function generate(Request $request)
    {
        $student = $this->getStudent();

        $courses = Course::with([
            'university',
            'requirements',
            'englishRequirements',
            'tuitionFees'
        ])
            ->where('is_active', true)
            ->get();

        foreach ($courses as $course) {

            $qualificationMatch =
                $this->checkQualificationMatch(
                    $student,
                    $course
                );

            $englishMatch =
                $this->checkEnglishMatch(
                    $student,
                    $course
                );

            $budgetMatch =
                $this->checkBudgetMatch(
                    $student,
                    $course
                );

            $preferenceMatch =
                $this->checkPreferenceMatch(
                    $student,
                    $course
                );

            $workExperienceMatch =
                $this->checkWorkExperienceMatch(
                    $student,
                    $course
                );

            $matchCount = 0;

            $matchCount +=
                $qualificationMatch ? 1 : 0;

            $matchCount +=
                $englishMatch ? 1 : 0;

            $matchCount +=
                $budgetMatch ? 1 : 0;

            $matchCount +=
                $preferenceMatch ? 1 : 0;

            $matchCount +=
                $workExperienceMatch ? 1 : 0;

            $matchPercentage =
                ($matchCount / 5) * 100;

            if ($matchPercentage < 40) {
                continue;
            }

            Recommendation::updateOrCreate(
                [
                    'student_id' =>
                        $student->student_id,

                    'course_id' =>
                        $course->course_id,
                ],
                [
                    'match_percentage' =>
                        $matchPercentage,

                    'qualification_match' =>
                        $qualificationMatch,

                    'english_match' =>
                        $englishMatch,

                    'budget_match' =>
                        $budgetMatch,

                    'preference_match' =>
                        $preferenceMatch,

                    'work_experience_match' =>
                        $workExperienceMatch,

                    'recommendation_reason' =>
                        $this->generateReason(
                            $qualificationMatch,
                            $englishMatch,
                            $budgetMatch,
                            $preferenceMatch,
                            $workExperienceMatch
                        ),

                    'recommendation_status' =>
                        'Recommended',
                ]
            );
        }

        return redirect()
            ->route(
                'student.recommendations.index'
            )
            ->with(
                'success',
                'Recommendations generated successfully.'
            );
    }

    /**
     * Check qualification match.
     */
    private function checkQualificationMatch(
        Student $student,
        Course $course
    ): bool {
        if (!$course->requirements) {
            return true;
        }

        if (
            !$course->requirements
                ->required_qualification_level
        ) {
            return true;
        }

        $qualifications =
            $student->academicQualifications;

        if ($qualifications->isEmpty()) {
            return false;
        }

        return true;
    }

    /**
     * Check English qualification match.
     */
    private function checkEnglishMatch(
        Student $student,
        Course $course
    ): bool {
        $requirements =
            $course->englishRequirements;

        if ($requirements->isEmpty()) {
            return true;
        }

        $studentQualifications =
            $student->englishQualifications;

        if ($studentQualifications->isEmpty()) {
            return false;
        }

        foreach (
            $requirements as $requirement
        ) {
            foreach (
                $studentQualifications as $qualification
            ) {
                if (
                    $qualification->test_type ===
                    $requirement->test_type
                ) {
                    if (
                        $qualification->overall_score >=
                        $requirement->minimum_overall_score
                    ) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Check budget match.
     */
    private function checkBudgetMatch(
        Student $student,
        Course $course
    ): bool {
        $preference = $student->preferences;

        if (!$preference) {
            return true;
        }

        $fee = $course->tuitionFees->first();

        if (!$fee) {
            return true;
        }

        if (!$preference->max_budget) {
            return true;
        }

        return $fee->amount <=
            $preference->max_budget;
    }

    /**
     * Check study preference match.
     */
    private function checkPreferenceMatch(
        Student $student,
        Course $course
    ): bool {
        $preference = $student->preferences;

        if (!$preference) {
            return true;
        }

        $matches = true;

        if (
            $preference->preferred_course_level
        ) {
            $matches =
                $course->course_level ===
                $preference->preferred_course_level;
        }

        if (
            $matches &&
            $preference->preferred_course_field
        ) {
            $matches =
                stripos(
                    $course->field_of_study ?? '',
                    $preference->preferred_course_field
                ) !== false;
        }

        if (
            $matches &&
            $preference->preferred_study_mode
        ) {
            $matches =
                $course->study_mode ===
                $preference->preferred_study_mode;
        }

        return $matches;
    }

    /**
     * Check work experience match.
     */
    private function checkWorkExperienceMatch(
        Student $student,
        Course $course
    ): bool {
        $requirements =
            $course->requirements;

        if (!$requirements) {
            return true;
        }

        $requiredMonths =
            $requirements
                ->minimum_work_experience_months ?? 0;

        if ($requiredMonths <= 0) {
            return true;
        }

        $totalMonths = 0;

        foreach (
            $student->workExperiences as $experience
        ) {
            $start =
                $experience->start_date;

            $end =
                $experience->end_date ??
                now()->toDateString();

            if ($start) {
                $startDate =
                    \Carbon\Carbon::parse($start);

                $endDate =
                    \Carbon\Carbon::parse($end);

                $totalMonths +=
                    $startDate->diffInMonths(
                        $endDate
                    );
            }
        }

        return $totalMonths >= $requiredMonths;
    }

    /**
     * Generate recommendation reason.
     */
    private function generateReason(
        bool $qualificationMatch,
        bool $englishMatch,
        bool $budgetMatch,
        bool $preferenceMatch,
        bool $workExperienceMatch
    ): string {
        $reasons = [];

        if ($qualificationMatch) {
            $reasons[] =
                'Academic qualification matches.';
        }

        if ($englishMatch) {
            $reasons[] =
                'English qualification matches.';
        }

        if ($budgetMatch) {
            $reasons[] =
                'Tuition fee is within the preferred budget.';
        }

        if ($preferenceMatch) {
            $reasons[] =
                'Course matches the student preferences.';
        }

        if ($workExperienceMatch) {
            $reasons[] =
                'Work experience requirement is satisfied.';
        }

        if (empty($reasons)) {
            return 'Limited match based on the available student information.';
        }

        return implode(' ', $reasons);
    }
}