<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRequirement;
use App\Models\Recommendation;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Get Current Student
    |--------------------------------------------------------------------------
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

    /*
    |--------------------------------------------------------------------------
    | Recommendation Results
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $student = $this->getStudent();

        $recommendations = Recommendation::with([
            'course.university',
            'course.requirements',
            'course.englishRequirements',
            'course.tuitionFees',
        ])
            ->where('student_id', $student->student_id)
            ->orderByDesc('match_percentage')
            ->paginate(10);

        return view(
            'student.recommendations.index',
            compact('recommendations')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Show Recommendation
    |--------------------------------------------------------------------------
    */

    public function show(Recommendation $recommendation)
    {
        $student = $this->getStudent();

        /*
        | Student can only view their own recommendation.
        */

        if (
            (int) $recommendation->student_id !==
            (int) $student->student_id
        ) {
            abort(403);
        }

        $recommendation->load([
            'course.university',
            'course.requirements',
            'course.englishRequirements',
            'course.tuitionFees',
        ]);

        return view(
            'student.recommendations.show',
            compact('recommendation')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Recommendations
    |--------------------------------------------------------------------------
    */

    public function generate()
    {
        $student = $this->getStudent();

        /*
        | Load all information required by the recommendation engine.
        */

        $student->load([
            'academicQualifications',
            'englishQualifications',
            'workExperiences',
            'preferences',
        ]);

        /*
        | Get all active courses.
        */

        $courses = Course::with([
            'university',
            'requirements',
            'englishRequirements',
            'tuitionFees',
        ])
            ->where('is_active', true)
            ->get();

        /*
        | Remove previously generated recommendations.
        |
        | Recommendations are regenerated using the student's
        | latest profile information.
        */

        Recommendation::where(
            'student_id',
            $student->student_id
        )->delete();

        $generatedCount = 0;

        foreach ($courses as $course) {

            /*
            |--------------------------------------------------------------------------
            | STEP 1 - ELIGIBILITY
            |--------------------------------------------------------------------------
            */

            $eligibility = $this->checkEligibility(
                $student,
                $course
            );

            /*
            | A course that fails a mandatory requirement
            | will not be recommended.
            */

            if (!$eligibility['eligible']) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | STEP 2 - MATCH FACTORS
            |--------------------------------------------------------------------------
            */

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

            /*
            |--------------------------------------------------------------------------
            | STEP 3 - WEIGHTED SCORE
            |--------------------------------------------------------------------------
            |
            | Academic / Qualification = 30%
            | English                 = 25%
            | Preferences             = 20%
            | Budget                  = 15%
            | Work Experience         = 10%
            |
            | Total                   = 100%
            |--------------------------------------------------------------------------
            */

            $matchPercentage = 0;

            if ($qualificationMatch) {
                $matchPercentage += 30;
            }

            if ($englishMatch) {
                $matchPercentage += 25;
            }

            if ($preferenceMatch) {
                $matchPercentage += 20;
            }

            if ($budgetMatch) {
                $matchPercentage += 15;
            }

            if ($workExperienceMatch) {
                $matchPercentage += 10;
            }

            /*
            |--------------------------------------------------------------------------
            | STEP 4 - REASON
            |--------------------------------------------------------------------------
            */

            $reason = $this->generateReason(
                $qualificationMatch,
                $englishMatch,
                $budgetMatch,
                $preferenceMatch,
                $workExperienceMatch,
                $eligibility['details']
            );

            /*
            |--------------------------------------------------------------------------
            | STEP 5 - SAVE RESULT
            |--------------------------------------------------------------------------
            */

            Recommendation::create([
                'student_id' => $student->student_id,
                'course_id' => $course->course_id,
                'match_percentage' => $matchPercentage,
                'qualification_match' => $qualificationMatch,
                'english_match' => $englishMatch,
                'budget_match' => $budgetMatch,
                'preference_match' => $preferenceMatch,
                'work_experience_match' => $workExperienceMatch,
                'recommendation_reason' => $reason,
                'recommendation_status' => 'Recommended',
            ]);

            $generatedCount++;
        }

        /*
        |--------------------------------------------------------------------------
        | Return Results
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('student.recommendations.index')
            ->with(
                'success',
                $generatedCount .
                ' suitable course recommendation(s) generated successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | COMPLETE ELIGIBILITY CHECK
    |--------------------------------------------------------------------------
    */

    private function checkEligibility(
        Student $student,
        Course $course
    ): array {

        /*
        | Course::requirements() is a hasMany relationship.
        | Therefore we use the first requirement record.
        */

        $requirements = $course->requirements;

        /*
        | If the course has no requirement record,
        | it is considered eligible.
        */

        if (!$requirements) {
            return [
                'eligible' => true,
                'details' => [
                    'No specific course eligibility requirements are defined.',
                ],
            ];
        }

        $details = [];

        /*
        |--------------------------------------------------------------------------
        | AGE
        |--------------------------------------------------------------------------
        */

        $ageMatch = $this->checkAgeRequirement(
            $student,
            $requirements
        );

        if (!$ageMatch['passed']) {
            return [
                'eligible' => false,
                'details' => [
                    $ageMatch['message'],
                ],
            ];
        }

        $details[] = $ageMatch['message'];

        /*
        |--------------------------------------------------------------------------
        | GPA
        |--------------------------------------------------------------------------
        */

        $gpaMatch = $this->checkGpaRequirement(
            $student,
            $requirements
        );

        if (!$gpaMatch['passed']) {
            return [
                'eligible' => false,
                'details' => [
                    $gpaMatch['message'],
                ],
            ];
        }

        $details[] = $gpaMatch['message'];

        /*
        |--------------------------------------------------------------------------
        | QUALIFICATION LEVEL
        |--------------------------------------------------------------------------
        */

        $qualificationLevelMatch =
            $this->checkQualificationLevelRequirement(
                $student,
                $requirements
            );

        if (!$qualificationLevelMatch['passed']) {
            return [
                'eligible' => false,
                'details' => [
                    $qualificationLevelMatch['message'],
                ],
            ];
        }

        $details[] =
            $qualificationLevelMatch['message'];

        /*
        |--------------------------------------------------------------------------
        | FIELD OF STUDY
        |--------------------------------------------------------------------------
        */

        $fieldMatch =
            $this->checkRequiredField(
                $student,
                $requirements
            );

        if (!$fieldMatch['passed']) {
            return [
                'eligible' => false,
                'details' => [
                    $fieldMatch['message'],
                ],
            ];
        }

        $details[] =
            $fieldMatch['message'];

        /*
        |--------------------------------------------------------------------------
        | WORK EXPERIENCE
        |--------------------------------------------------------------------------
        */

        $workMatch =
            $this->checkRequiredWorkExperience(
                $student,
                $requirements
            );

        if (!$workMatch['passed']) {
            return [
                'eligible' => false,
                'details' => [
                    $workMatch['message'],
                ],
            ];
        }

        $details[] =
            $workMatch['message'];

        /*
        |--------------------------------------------------------------------------
        | ENGLISH
        |--------------------------------------------------------------------------
        */

        $englishMatch =
            $this->checkEnglishMatch(
                $student,
                $course
            );

        if (!$englishMatch) {
            return [
                'eligible' => false,
                'details' => [
                    'English language requirement is not satisfied.',
                ],
            ];
        }

        $details[] =
            'English language requirement is satisfied.';

        /*
        |--------------------------------------------------------------------------
        | ELIGIBLE
        |--------------------------------------------------------------------------
        */

        return [
            'eligible' => true,
            'details' => $details,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | AGE REQUIREMENT
    |--------------------------------------------------------------------------
    */

    private function checkAgeRequirement(
        Student $student,
        CourseRequirement $requirements
    ): array {

        /*
        | No age restrictions.
        */

        if (
            !$requirements->minimum_age &&
            !$requirements->maximum_age
        ) {
            return [
                'passed' => true,
                'message' =>
                    'No specific age restriction is defined.',
            ];
        }

        /*
        | Student DOB is required.
        */

        if (!$student->date_of_birth) {
            return [
                'passed' => false,
                'message' =>
                    'Student date of birth is missing.',
            ];
        }

        $age = Carbon::parse(
            $student->date_of_birth
        )->age;

        /*
        | Minimum age.
        */

        if (
            $requirements->minimum_age &&
            $age < $requirements->minimum_age
        ) {
            return [
                'passed' => false,
                'message' =>
                    'Student age does not meet the minimum age requirement.',
            ];
        }

        /*
        | Maximum age.
        */

        if (
            $requirements->maximum_age &&
            $age > $requirements->maximum_age
        ) {
            return [
                'passed' => false,
                'message' =>
                    'Student age exceeds the maximum age requirement.',
            ];
        }

        return [
            'passed' => true,
            'message' =>
                'Age requirement is satisfied.',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | GPA REQUIREMENT
    |--------------------------------------------------------------------------
    */

    private function checkGpaRequirement(
        Student $student,
        CourseRequirement $requirements
    ): array {

        if (!$requirements->minimum_gpa) {
            return [
                'passed' => true,
                'message' =>
                    'No minimum GPA requirement is defined.',
            ];
        }

        $qualifications =
            $student->academicQualifications;

        if ($qualifications->isEmpty()) {
            return [
                'passed' => false,
                'message' =>
                    'No academic qualification is available.',
            ];
        }

        /*
        | Get the highest GPA available.
        */

        $highestGpa =
            $qualifications
                ->filter(
                    fn ($qualification) =>
                        $qualification->gpa !== null
                )
                ->max('gpa');

        if ($highestGpa === null) {
            return [
                'passed' => false,
                'message' =>
                    'Student GPA is not available.',
            ];
        }

        if (
            (float) $highestGpa <
            (float) $requirements->minimum_gpa
        ) {
            return [
                'passed' => false,
                'message' =>
                    'Student GPA does not meet the minimum GPA requirement.',
            ];
        }

        return [
            'passed' => true,
            'message' =>
                'GPA requirement is satisfied.',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | QUALIFICATION LEVEL REQUIREMENT
    |--------------------------------------------------------------------------
    */

    private function checkQualificationLevelRequirement(
        Student $student,
        CourseRequirement $requirements
    ): array {

        $requiredLevel =
            $requirements->required_qualification_level;

        if (!$requiredLevel) {
            return [
                'passed' => true,
                'message' =>
                    'No specific qualification level is required.',
            ];
        }

        $qualifications =
            $student->academicQualifications;

        if ($qualifications->isEmpty()) {
            return [
                'passed' => false,
                'message' =>
                    'Student has no academic qualifications.',
            ];
        }

        /*
        | Qualification hierarchy.
        */

        $levels = [
            'O_Level' => 1,
            'A_Level' => 2,
            'Certificate' => 3,
            'Diploma' => 4,
            'HND' => 5,
            'Bachelor' => 6,
            'Master' => 7,
            'PhD' => 8,
        ];

        $requiredRank =
            $levels[$requiredLevel] ?? null;

        /*
        | Unknown requirement:
        | don't incorrectly reject the student.
        */

        if ($requiredRank === null) {
            return [
                'passed' => true,
                'message' =>
                    'Qualification level requirement could not be evaluated.',
            ];
        }

        foreach ($qualifications as $qualification) {

            $studentLevel =
                $this->normaliseQualificationLevel(
                    $qualification->qualification_type,
                    $qualification->qualification_name
                );

            $studentRank =
                $levels[$studentLevel] ?? null;

            if (
                $studentRank !== null &&
                $studentRank >= $requiredRank
            ) {
                return [
                    'passed' => true,
                    'message' =>
                        'Qualification level requirement is satisfied.',
                ];
            }
        }

        return [
            'passed' => false,
            'message' =>
                'Student qualification level does not meet the required level.',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | NORMALISE QUALIFICATION LEVEL
    |--------------------------------------------------------------------------
    */

    private function normaliseQualificationLevel(
        ?string $type,
        ?string $name
    ): ?string {

        $value = strtolower(
            trim(
                ($type ?? '') .
                ' ' .
                ($name ?? '')
            )
        );

        if (
            str_contains($value, 'phd') ||
            str_contains($value, 'doctor')
        ) {
            return 'PhD';
        }

        if (
            str_contains($value, 'master') ||
            str_contains($value, 'msc') ||
            str_contains($value, 'mba')
        ) {
            return 'Master';
        }

        if (
            str_contains($value, 'bachelor') ||
            str_contains($value, 'degree') ||
            str_contains($value, 'bsc')
        ) {
            return 'Bachelor';
        }

        if (
            str_contains($value, 'hnd') ||
            str_contains(
                $value,
                'higher national diploma'
            )
        ) {
            return 'HND';
        }

        if (str_contains($value, 'diploma')) {
            return 'Diploma';
        }

        if (str_contains($value, 'certificate')) {
            return 'Certificate';
        }

        if (
            str_contains($value, 'a_level') ||
            str_contains($value, 'a level') ||
            str_contains($value, 'advanced level')
        ) {
            return 'A_Level';
        }

        if (
            str_contains($value, 'o_level') ||
            str_contains($value, 'o level') ||
            str_contains($value, 'ordinary level')
        ) {
            return 'O_Level';
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | REQUIRED FIELD
    |--------------------------------------------------------------------------
    */

    private function checkRequiredField(
        Student $student,
        CourseRequirement $requirements
    ): array {

        $requiredField =
            trim(
                (string)
                $requirements->required_field
            );

        if ($requiredField === '') {
            return [
                'passed' => true,
                'message' =>
                    'No specific field of study is required.',
            ];
        }

        $qualifications =
            $student->academicQualifications;

        if ($qualifications->isEmpty()) {
            return [
                'passed' => false,
                'message' =>
                    'No academic qualification is available for field matching.',
            ];
        }

        foreach ($qualifications as $qualification) {

            $studentField =
                strtolower(
                    trim(
                        (string)
                        $qualification->field_of_study
                    )
                );

            if ($studentField === '') {
                continue;
            }

            /*
            | Partial matching.
            */

            if (
                stripos(
                    $studentField,
                    $requiredField
                ) !== false ||

                stripos(
                    $requiredField,
                    $studentField
                ) !== false
            ) {
                return [
                    'passed' => true,
                    'message' =>
                        'Required academic field is satisfied.',
                ];
            }
        }

        return [
            'passed' => false,
            'message' =>
                'Student academic field does not match the required field.',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | REQUIRED WORK EXPERIENCE
    |--------------------------------------------------------------------------
    */

    private function checkRequiredWorkExperience(
        Student $student,
        CourseRequirement $requirements
    ): array {

        $requiredMonths =
            (int) (
                $requirements
                    ->minimum_work_experience_months
                ?? 0
            );

        if ($requiredMonths <= 0) {
            return [
                'passed' => true,
                'message' =>
                    'No minimum work experience is required.',
            ];
        }

        $totalMonths =
            $this->calculateWorkExperienceMonths(
                $student
            );

        if ($totalMonths < $requiredMonths) {
            return [
                'passed' => false,
                'message' =>
                    'Student work experience does not meet the minimum requirement.',
            ];
        }

        return [
            'passed' => true,
            'message' =>
                'Work experience requirement is satisfied.',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | QUALIFICATION MATCH
    |--------------------------------------------------------------------------
    */

    private function checkQualificationMatch(
        Student $student,
        Course $course
    ): bool {

        /*
        | Course requirements are a hasMany relationship.
        */

        $requirements =
            $course->requirements;

        if (!$requirements) {
            return true;
        }

        $age =
            $this->checkAgeRequirement(
                $student,
                $requirements
            );

        $gpa =
            $this->checkGpaRequirement(
                $student,
                $requirements
            );

        $qualification =
            $this->checkQualificationLevelRequirement(
                $student,
                $requirements
            );

        $field =
            $this->checkRequiredField(
                $student,
                $requirements
            );

        return
            $age['passed'] &&
            $gpa['passed'] &&
            $qualification['passed'] &&
            $field['passed'];
    }

    /*
    |--------------------------------------------------------------------------
    | ENGLISH MATCH
    |--------------------------------------------------------------------------
    */

    private function checkEnglishMatch(
        Student $student,
        Course $course
    ): bool {

        $requirements =
            $course->englishRequirements;

        /*
        | No English requirement.
        */

        if ($requirements->isEmpty()) {
            return true;
        }

        $studentQualifications =
            $student->englishQualifications;

        if ($studentQualifications->isEmpty()) {
            return false;
        }

        foreach ($requirements as $requirement) {

            foreach (
                $studentQualifications
                as $qualification
            ) {

                /*
                | Test type.
                */

                if (
                    strtolower(
                        trim(
                            (string)
                            $qualification->test_type
                        )
                    ) !==

                    strtolower(
                        trim(
                            (string)
                            $requirement->test_type
                        )
                    )
                ) {
                    continue;
                }

                /*
                | Expiry.
                */

                if (
                    $qualification->expiry_date &&
                    Carbon::parse(
                        $qualification->expiry_date
                    )->isPast()
                ) {
                    continue;
                }

                /*
                | Overall score.
                */

                if (
                    $requirement->minimum_overall_score !== null &&
                    (
                        $qualification->overall_score === null ||
                        (float)
                        $qualification->overall_score
                        <
                        (float)
                        $requirement->minimum_overall_score
                    )
                ) {
                    continue;
                }

                /*
                | Listening.
                */

                if (
                    $requirement->minimum_listening_score !== null &&
                    (
                        $qualification->listening_score === null ||
                        (float)
                        $qualification->listening_score
                        <
                        (float)
                        $requirement->minimum_listening_score
                    )
                ) {
                    continue;
                }

                /*
                | Reading.
                */

                if (
                    $requirement->minimum_reading_score !== null &&
                    (
                        $qualification->reading_score === null ||
                        (float)
                        $qualification->reading_score
                        <
                        (float)
                        $requirement->minimum_reading_score
                    )
                ) {
                    continue;
                }

                /*
                | Writing.
                */

                if (
                    $requirement->minimum_writing_score !== null &&
                    (
                        $qualification->writing_score === null ||
                        (float)
                        $qualification->writing_score
                        <
                        (float)
                        $requirement->minimum_writing_score
                    )
                ) {
                    continue;
                }

                /*
                | Speaking.
                */

                if (
                    $requirement->minimum_speaking_score !== null &&
                    (
                        $qualification->speaking_score === null ||
                        (float)
                        $qualification->speaking_score
                        <
                        (float)
                        $requirement->minimum_speaking_score
                    )
                ) {
                    continue;
                }

                /*
                | All English requirements passed.
                */

                return true;
            }
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | BUDGET MATCH
    |--------------------------------------------------------------------------
    */

    private function checkBudgetMatch(
        Student $student,
        Course $course
    ): bool {

        $preference =
            $student->preferences;

        /*
        | No student preference.
        */

        if (!$preference) {
            return true;
        }

        /*
        | No maximum budget.
        */

        if (
            $preference->max_budget === null
        ) {
            return true;
        }

        /*
        | TuitionFee uses fee_amount.
        |
        | We select the lowest available fee because
        | the actual TuitionFee model does not contain
        | an effective_from field.
        */

        $fee =
            $course->tuitionFees
                ->filter(
                    fn ($tuitionFee) =>
                        $tuitionFee->fee_amount !== null
                )
                ->sortBy('fee_amount')
                ->first();

        /*
        | If no fee exists, don't reject
        | the course because of missing data.
        */

        if (!$fee) {
            return true;
        }

        return
            (float) $fee->fee_amount <=
            (float) $preference->max_budget;
    }

    /*
    |--------------------------------------------------------------------------
    | COURSE PREFERENCE MATCH
    |--------------------------------------------------------------------------
    */

    private function checkPreferenceMatch(
        Student $student,
        Course $course
    ): bool {

        $preference =
            $student->preferences;

        if (!$preference) {
            return true;
        }

        $hasPreference = false;

        /*
        |--------------------------------------------------------------------------
        | COURSE LEVEL
        |--------------------------------------------------------------------------
        */

        if (
            $preference->preferred_course_level
        ) {

            $hasPreference = true;

            if (
                strcasecmp(
                    trim(
                        (string)
                        $course->course_level
                    ),
                    trim(
                        (string)
                        $preference
                            ->preferred_course_level
                    )
                ) !== 0
            ) {
                return false;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | COURSE FIELD
        |--------------------------------------------------------------------------
        */

        if (
            $preference->preferred_course_field
        ) {

            $hasPreference = true;

            if (
                stripos(
                    (string)
                    $course->field_of_study,

                    (string)
                    $preference
                        ->preferred_course_field
                ) === false
            ) {
                return false;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | STUDY MODE
        |--------------------------------------------------------------------------
        */

        if (
            $preference->preferred_study_mode
        ) {

            $hasPreference = true;

            if (
                strcasecmp(
                    trim(
                        (string)
                        $course->study_mode
                    ),
                    trim(
                        (string)
                        $preference
                            ->preferred_study_mode
                    )
                ) !== 0
            ) {
                return false;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | COUNTRY
        |--------------------------------------------------------------------------
        */

        if (
            $preference->preferred_country_id
        ) {

            $hasPreference = true;

            $university =
                $course->university;

            if (
                !$university ||
                (int)
                $university->country_id !==
                (int)
                $preference->preferred_country_id
            ) {
                return false;
            }
        }

        if (!$hasPreference) {
            return true;
        }

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | WORK EXPERIENCE MATCH
    |--------------------------------------------------------------------------
    */

    private function checkWorkExperienceMatch(
        Student $student,
        Course $course
    ): bool {

        /*
        | Course requirements are a hasMany relationship.
        */

        $requirements =
            $course->requirements;

        if (!$requirements) {
            return true;
        }

        $requiredMonths =
            (int) (
                $requirements
                    ->minimum_work_experience_months
                ?? 0
            );

        if ($requiredMonths <= 0) {
            return true;
        }

        $totalMonths =
            $this->calculateWorkExperienceMonths(
                $student
            );

        return
            $totalMonths >=
            $requiredMonths;
    }

    /*
    |--------------------------------------------------------------------------
    | CALCULATE WORK EXPERIENCE
    |--------------------------------------------------------------------------
    */

    private function calculateWorkExperienceMonths(
        Student $student
    ): int {

        $totalMonths = 0;

        foreach (
            $student->workExperiences
            as $experience
        ) {

            if (!$experience->start_date) {
                continue;
            }

            $startDate =
                Carbon::parse(
                    $experience->start_date
                );

            /*
            | Current employment.
            */

            if (
                $experience->is_current ||
                !$experience->end_date
            ) {

                $endDate =
                    Carbon::now();

            } else {

                $endDate =
                    Carbon::parse(
                        $experience->end_date
                    );
            }

            /*
            | Ignore invalid dates.
            */

            if (
                $endDate->lessThan($startDate)
            ) {
                continue;
            }

            $totalMonths +=
                $startDate->diffInMonths(
                    $endDate
                );
        }

        return $totalMonths;
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE RECOMMENDATION REASON
    |--------------------------------------------------------------------------
    */

    private function generateReason(
        bool $qualificationMatch,
        bool $englishMatch,
        bool $budgetMatch,
        bool $preferenceMatch,
        bool $workExperienceMatch,
        array $eligibilityDetails
    ): string {

        $reasons = [];

        /*
        | Academic.
        */

        if ($qualificationMatch) {

            $reasons[] =
                'Your academic qualifications satisfy the course requirements.';
        }

        /*
        | English.
        */

        if ($englishMatch) {

            $reasons[] =
                'Your English qualification satisfies the required test and scores.';
        }

        /*
        | Budget.
        */

        if ($budgetMatch) {

            $reasons[] =
                'The available tuition fee is within your preferred budget.';

        } else {

            $reasons[] =
                'The tuition fee may require additional budget consideration.';
        }

        /*
        | Preferences.
        */

        if ($preferenceMatch) {

            $reasons[] =
                'The course matches your selected study preferences.';
        }

        /*
        | Work experience.
        */

        if ($workExperienceMatch) {

            $reasons[] =
                'Your work experience satisfies the course requirement.';
        }

        /*
        | Eligibility details.
        */

        if (!empty($eligibilityDetails)) {

            $reasons[] =
                implode(
                    ' ',
                    array_slice(
                        $eligibilityDetails,
                        0,
                        3
                    )
                );
        }

        return implode(
            ' ',
            array_unique($reasons)
        );
    }
}