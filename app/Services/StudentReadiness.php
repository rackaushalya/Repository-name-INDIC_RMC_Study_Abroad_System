<?php

namespace App\Services;

use App\Models\RequiredDocument;
use App\Models\Student;

/**
 * Weighted "application readiness" score for a student.
 *
 * The score is built from small checklist items. Every item has a weight,
 * and the weights add up to 100, so finishing an item adds exactly that many
 * percentage points. The unfinished items double as the "next best actions".
 */
class StudentReadiness
{
    private const WEIGHT_PROFILE = 25;
    private const WEIGHT_QUALIFICATIONS = 30;
    private const WEIGHT_PREFERENCES = 20;
    private const WEIGHT_DOCUMENTS = 25;

    /**
     * Required documents that apply to this student (global ones, plus the
     * ones for the country they want to study in).
     */
    public static function applicableRequiredDocuments(Student $student)
    {
        $countryId = $student->preferences?->preferred_country_id;

        return RequiredDocument::where('is_active', true)
            ->where(function ($query) use ($countryId) {
                $query->whereNull('country_id')
                    ->orWhere('country_id', $countryId);
            })
            ->orderBy('document_name')
            ->get();
    }

    /**
     * @return array{
     *     percentage: int,
     *     label: string,
     *     sections: array<int, array{key: string, label: string, icon: string, earned: float, max: int, percent: int}>,
     *     actions: array<int, array{label: string, hint: string, points: int, url: string}>
     * }
     */
    public function evaluate(?Student $student): array
    {
        if (!$student) {
            return ['percentage' => 0, 'label' => 'Not started', 'sections' => [], 'actions' => []];
        }

        $student->loadMissing('user', 'preferences');

        $items = array_merge(
            $this->profileItems($student),
            $this->qualificationItems($student),
            $this->preferenceItems($student),
            $this->documentItems($student),
        );

        $total = 0.0;
        $sections = [];

        foreach ($items as $item) {
            $key = $item['section'];
            $sections[$key] ??= [
                'key' => $key,
                'label' => $item['section_label'],
                'icon' => $item['icon'],
                'earned' => 0.0,
                'max' => 0,
            ];
            $sections[$key]['max'] += $item['weight'];

            if ($item['done']) {
                $sections[$key]['earned'] += $item['weight'];
                $total += $item['weight'];
            }
        }

        $sections = array_values(array_map(function ($section) {
            $section['percent'] = $section['max'] > 0
                ? (int) round(($section['earned'] / $section['max']) * 100)
                : 0;

            return $section;
        }, $sections));

        $actions = collect($items)
            ->reject(fn ($item) => $item['done'])
            ->sortByDesc('weight')
            ->take(5)
            ->map(fn ($item) => [
                'label' => $item['label'],
                'hint' => $item['hint'],
                'points' => (int) round($item['weight']),
                'url' => $item['url'],
            ])
            ->values()
            ->all();

        $percentage = (int) round($total);

        return [
            'percentage' => $percentage,
            'label' => match (true) {
                $percentage >= 100 => 'Ready to apply',
                $percentage >= 80 => 'Almost ready',
                $percentage >= 50 => 'Getting there',
                $percentage > 0 => 'Just getting started',
                default => 'Not started',
            },
            'sections' => $sections,
            'actions' => $actions,
        ];
    }

    private function item(string $section, string $sectionLabel, string $icon, string $label, string $hint, float $weight, bool $done, string $url): array
    {
        return compact('section', 'icon', 'label', 'hint', 'weight', 'done', 'url') + [
            'section_label' => $sectionLabel,
        ];
    }

    private function profileItems(Student $student): array
    {
        $url = route('student.profile');
        $make = fn (string $label, string $hint, float $weight, $value) => $this->item(
            'profile', 'Profile', 'bi-person-fill', $label, $hint, $weight, filled($value), $url
        );

        return [
            $make('Add your phone number', 'Consultants use it to reach you.', 5, $student->user?->phone),
            $make('Add your date of birth', 'Needed to check age-based eligibility.', 5, $student->date_of_birth),
            $make('Select your gender', 'Part of your personal details.', 3, $student->gender),
            $make('Add your nationality', 'Universities and visas depend on it.', 4, $student->nationality),
            $make('Add your passport number', 'Required for almost every application.', 4, $student->passport_number),
            $make('Add your current address', 'Where you live right now.', 2, $student->current_address),
            $make('Add your city', 'Part of your address details.', 1, $student->city),
            $make('Select your country', 'Part of your address details.', 1, $student->country),
        ];
    }

    private function qualificationItems(Student $student): array
    {
        $url = route('student.qualifications');

        return [
            $this->item(
                'qualifications', 'Qualifications', 'bi-mortarboard-fill',
                'Add an academic qualification', 'Your latest school or degree results.',
                15, $student->academicQualifications()->exists(), $url . '#academic'
            ),
            $this->item(
                'qualifications', 'Qualifications', 'bi-mortarboard-fill',
                'Add an English test score', 'IELTS, TOEFL, PTE or similar.',
                15, $student->englishQualifications()->exists(), $url . '#english'
            ),
        ];
    }

    private function preferenceItems(Student $student): array
    {
        $url = route('student.preferences');
        $prefs = $student->preferences;
        $make = fn (string $label, string $hint, float $weight, $value) => $this->item(
            'preferences', 'Study Preferences', 'bi-sliders', $label, $hint, $weight, filled($value), $url
        );

        return [
            $make('Choose a preferred country', 'Lets us match you to the right universities.', 6, $prefs?->preferred_country_id),
            $make('Enter your preferred field of study', 'For example Computer Science or Business.', 4, $prefs?->preferred_course_field),
            $make('Pick a preferred course level', 'Bachelor, Master, Diploma and so on.', 3, $prefs?->preferred_course_level),
            $make('Set your preferred intake', 'When you would like to start.', 3, $prefs?->preferred_intake),
            $make('Set your yearly budget', 'Used to filter courses you can afford.', 4, $prefs?->max_budget),
        ];
    }

    private function documentItems(Student $student): array
    {
        $url = route('student.documents');
        $required = self::applicableRequiredDocuments($student)->where('is_mandatory', true);

        $uploaded = $student->documents()->get();

        // No mandatory checklist to follow: any uploaded, still-valid document counts.
        if ($required->isEmpty()) {
            $hasValidDocument = $uploaded->contains(
                fn ($document) => $document->status !== 'rejected' && $document->expiryState() !== 'expired'
            );

            return [
                $this->item(
                    'documents', 'Documents', 'bi-folder2-open',
                    'Upload your first document', 'A passport copy is a good place to start.',
                    self::WEIGHT_DOCUMENTS, $hasValidDocument, $url
                ),
            ];
        }

        $weight = self::WEIGHT_DOCUMENTS / $required->count();

        return $required->map(function ($document) use ($uploaded, $weight, $url) {
            $match = $uploaded->firstWhere('required_document_id', $document->required_document_id);

            $done = $match
                && $match->status !== 'rejected'
                && $match->expiryState() !== 'expired';

            $hint = match (true) {
                !$match => 'Mandatory document that is still missing.',
                $match->status === 'rejected' => 'Your last upload was rejected. Please upload it again.',
                $match->expiryState() === 'expired' => 'This document has expired. Upload a valid one.',
                default => 'Uploaded.',
            };

            return $this->item(
                'documents', 'Documents', 'bi-folder2-open',
                'Upload: ' . $document->document_name, $hint, $weight, (bool) $done, $url
            );
        })->all();
    }
}
