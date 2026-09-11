<?php

namespace App\Http\Controllers;

use App\Models\AcademicQualification;
use App\Models\EnglishQualification;
use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QualificationController extends Controller
{
    private function getStudent()
    {
        $user = Auth::user();

        if (!$user || !$user->student) {
            abort(403);
        }

        return $user->student;
    }

    public function index()
    {
        $student = $this->getStudent();

        $academicQualifications = $student->academicQualifications()
            ->latest('qualification_id')
            ->get();

        $englishQualifications = $student->englishQualifications()
            ->latest('english_qualification_id')
            ->get();

        $workExperiences = $student->workExperiences()
            ->latest('work_experience_id')
            ->get();

        return view('student.qualifications', compact(
            'student',
            'academicQualifications',
            'englishQualifications',
            'workExperiences'
        ));
    }

    public function storeAcademic(Request $request)
    {
        $student = $this->getStudent();

        $validated = $request->validate([
            'qualification_type' => ['required', 'string'],
            'institution_name' => ['required', 'string', 'max:255'],
            'qualification_name' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'completion_date' => ['nullable', 'date'],
            'grade' => ['nullable', 'string', 'max:50'],
            'gpa' => ['nullable', 'numeric', 'between:0,100'],
            'description' => ['nullable', 'string'],
        ]);

        $student->academicQualifications()->create($validated);

        return back()->with(
            'success',
            'Academic qualification added successfully.'
        );
    }

    public function updateAcademic(
        Request $request,
        AcademicQualification $qualification
    ) {
        $student = $this->getStudent();

        if ($qualification->student_id !== $student->student_id) {
            abort(403);
        }

        $validated = $request->validate([
            'qualification_type' => ['required', 'string'],
            'institution_name' => ['required', 'string', 'max:255'],
            'qualification_name' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'completion_date' => ['nullable', 'date'],
            'grade' => ['nullable', 'string', 'max:50'],
            'gpa' => ['nullable', 'numeric', 'between:0,100'],
            'description' => ['nullable', 'string'],
        ]);

        $qualification->update($validated);

        return back()->with(
            'success',
            'Academic qualification updated successfully.'
        );
    }

    public function deleteAcademic(
        AcademicQualification $qualification
    ) {
        $student = $this->getStudent();

        if ($qualification->student_id !== $student->student_id) {
            abort(403);
        }

        $qualification->delete();

        return back()->with(
            'success',
            'Academic qualification deleted successfully.'
        );
    }

    public function storeEnglish(Request $request)
    {
        $student = $this->getStudent();

        $validated = $request->validate([
            'test_type' => ['required', 'string'],
            'overall_score' => ['nullable', 'numeric'],
            'listening_score' => ['nullable', 'numeric'],
            'reading_score' => ['nullable', 'numeric'],
            'writing_score' => ['nullable', 'numeric'],
            'speaking_score' => ['nullable', 'numeric'],
            'test_date' => ['nullable', 'date'],
            'expiry_date' => ['nullable', 'date'],
            'certificate_number' => ['nullable', 'string', 'max:100'],
        ]);

        $student->englishQualifications()->create($validated);

        return back()->with(
            'success',
            'English qualification added successfully.'
        );
    }

    public function updateEnglish(
        Request $request,
        EnglishQualification $qualification
    ) {
        $student = $this->getStudent();

        if ($qualification->student_id !== $student->student_id) {
            abort(403);
        }

        $validated = $request->validate([
            'test_type' => ['required', 'string'],
            'overall_score' => ['nullable', 'numeric'],
            'listening_score' => ['nullable', 'numeric'],
            'reading_score' => ['nullable', 'numeric'],
            'writing_score' => ['nullable', 'numeric'],
            'speaking_score' => ['nullable', 'numeric'],
            'test_date' => ['nullable', 'date'],
            'expiry_date' => ['nullable', 'date'],
            'certificate_number' => ['nullable', 'string', 'max:100'],
        ]);

        $qualification->update($validated);

        return back()->with(
            'success',
            'English qualification updated successfully.'
        );
    }

    public function deleteEnglish(
        EnglishQualification $qualification
    ) {
        $student = $this->getStudent();

        if ($qualification->student_id !== $student->student_id) {
            abort(403);
        }

        $qualification->delete();

        return back()->with(
            'success',
            'English qualification deleted successfully.'
        );
    }

    public function storeWorkExperience(Request $request)
    {
        $student = $this->getStudent();

        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'is_current' => ['boolean'],
            'description' => ['nullable', 'string'],
        ]);

        $student->workExperiences()->create($validated);

        return back()->with(
            'success',
            'Work experience added successfully.'
        );
    }

    public function updateWorkExperience(
        Request $request,
        WorkExperience $workExperience
    ) {
        $student = $this->getStudent();

        if ($workExperience->student_id !== $student->student_id) {
            abort(403);
        }

        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'is_current' => ['boolean'],
            'description' => ['nullable', 'string'],
        ]);

        $workExperience->update($validated);

        return back()->with(
            'success',
            'Work experience updated successfully.'
        );
    }

    public function deleteWorkExperience(
        WorkExperience $workExperience
    ) {
        $student = $this->getStudent();

        if ($workExperience->student_id !== $student->student_id) {
            abort(403);
        }

        $workExperience->delete();

        return back()->with(
            'success',
            'Work experience deleted successfully.'
        );
    }
}