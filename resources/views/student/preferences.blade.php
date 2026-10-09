<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC - Study Preferences</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; background: #f5f7fb; color: #172033; }
        a { text-decoration: none; color: inherit; }

        .main { margin-left: 245px; min-height: 100vh; }
        .topbar { height: 72px; background: white; border-bottom: 1px solid #e6e9ef; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; position: sticky; top: 0; z-index: 10; }
        .topbar h2 { font-size: 17px; color: #101a2b; }
        .user { display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 38px; height: 38px; border-radius: 50%; background: #f97316; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; }
        .user-info strong { display: block; font-size: 13px; color: #172033; }
        .user-info span { font-size: 11px; color: #8b95a5; }

        .content { padding: 30px; max-width: 900px; }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; color: #101a2b; margin-bottom: 4px; }
        .page-header p { font-size: 13px; color: #7c8493; }

        .alert { padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; }
        .alert-success { background: #eafaf0; color: #1b7a43; border: 1px solid #cdeed9; }
        .alert-error { background: #fff1f1; color: #c0362c; border: 1px solid #f6cfcc; }
        .alert ul { margin: 0; padding-left: 18px; }

        .card { background: white; border: 1px solid #e6e9ef; border-radius: 12px; padding: 26px 28px; margin-bottom: 24px; }
        .card-head { margin-bottom: 20px; }
        .card-head h3 { font-size: 15px; color: #101a2b; }
        .card-head p { font-size: 12px; color: #9aa2b0; margin-top: 3px; }

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .field { margin-bottom: 18px; }
        .field label { display: block; font-size: 12.5px; font-weight: 600; color: #37415a; margin-bottom: 6px; }
        .field input, .field select { width: 100%; padding: 10px 13px; border: 1px solid #dfe4ec; border-radius: 8px; font-size: 13.5px; color: #172033; background: #f8fafc; font-family: inherit; }
        .field input:focus, .field select:focus { outline: none; border-color: #f97316; background: white; }
        .field-error { color: #c0362c; font-size: 12px; margin-top: 5px; }

        .btn-primary { padding: 11px 22px; background: #f97316; color: white; border: none; border-radius: 8px; font-size: 13.5px; font-weight: 700; cursor: pointer; }
        .btn-primary:hover { background: #ea6a0f; }

        @media (max-width: 900px) {
            .main { margin-left: 0; }
            .grid-2 { grid-template-columns: 1fr; }
        }

    </style>
@include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

<main class="main">

    <header class="topbar">
        <h2>Study Preferences</h2>
        <a href="{{ route('student.account.edit') }}" class="user" style="text-decoration:none; color:inherit;">
            @if ($student->user->profile_image_url ?? null)
                <img src="{{ $student->user->profile_image_url }}" class="user-avatar" alt="" style="object-fit: cover;">
            @else
                <div class="user-avatar">{{ strtoupper(substr($student->user->first_name ?? 'S', 0, 1)) }}</div>
            @endif
            <div class="user-info">
                <strong>{{ trim(($student->user->first_name ?? '') . ' ' . ($student->user->last_name ?? '')) ?: 'Student' }}</strong>
                <span>Student</span>
            </div>
        </a>
    </header>

    <section class="content">

        <div class="page-header">
            <h1>Study Preferences</h1>
            <p>Tell us what you're looking for so we can recommend the best-fit courses and universities.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('student.partials.tips-card', [
            'tips' => $preferenceTips,
            'tipsTitle' => 'Smart tips',
            'tipsSubtitle' => 'Updates as you change your preferences.',
            'liveUrl' => route('student.preferences'),
        ])

        <form method="POST" action="{{ route('student.preferences.update') }}">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-head">
                    <h3>Where & What You Want to Study</h3>
                    <p>These preferences help our consultants and the recommendation engine match you to relevant options.</p>
                </div>

                <div class="grid-2">
                    <div class="field">
                        <label for="preferred_country_id">Preferred country</label>
                        <select id="preferred_country_id" name="preferred_country_id">
                            <option value="">No preference</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->country_id }}" @selected(old('preferred_country_id', $preferences?->preferred_country_id) == $country->country_id)>
                                    {{ $country->country_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('preferred_country_id')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="preferred_course_field">Preferred field of study</label>
                        <input type="text" id="preferred_course_field" name="preferred_course_field"
                            value="{{ old('preferred_course_field', $preferences?->preferred_course_field) }}"
                            placeholder="e.g. Computer Science, Business"
                            maxlength="255" pattern="[A-Za-z][A-Za-z\s&amp;,.\-\/()]*"
                            title="Letters, spaces and & , . - / ( ) only">
                        @error('preferred_course_field')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="preferred_course_level">Preferred course level</label>
                        <select id="preferred_course_level" name="preferred_course_level">
                            <option value="">No preference</option>
                            @foreach (['Certificate', 'Diploma', 'Bachelor', 'Master', 'PhD'] as $level)
                                <option value="{{ $level }}" @selected(old('preferred_course_level', $preferences?->preferred_course_level) === $level)>{{ $level }}</option>
                            @endforeach
                        </select>
                        @error('preferred_course_level')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="preferred_intake">Preferred intake</label>
                        <input type="text" id="preferred_intake" name="preferred_intake"
                            value="{{ old('preferred_intake', $preferences?->preferred_intake) }}"
                            placeholder="e.g. September 2027"
                            maxlength="100" pattern="[A-Za-z0-9][A-Za-z0-9\s,\-\/]*"
                            title="Letters, numbers, spaces and , - / only">
                        @error('preferred_intake')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="preferred_study_mode">Preferred study mode</label>
                        <select id="preferred_study_mode" name="preferred_study_mode">
                            <option value="">No preference</option>
                            @foreach (['On Campus', 'Online', 'Hybrid'] as $mode)
                                <option value="{{ $mode }}" @selected(old('preferred_study_mode', $preferences?->preferred_study_mode) === $mode)>{{ $mode }}</option>
                            @endforeach
                        </select>
                        @error('preferred_study_mode')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="preferred_duration">Preferred duration</label>
                        <input type="text" id="preferred_duration" name="preferred_duration"
                            value="{{ old('preferred_duration', $preferences?->preferred_duration) }}"
                            placeholder="e.g. 2 years"
                            maxlength="100" pattern="\d+(\.\d+)?(\s*-\s*\d+(\.\d+)?)?\s*([Ww]eeks?|[Mm]onths?|[Yy]ears?)"
                            title="A number followed by weeks, months or years (e.g. 2 years)">
                        @error('preferred_duration')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="min_budget">Minimum budget (per year)</label>
                        <input type="number" step="0.01" min="0" max="9999999999.99" id="min_budget" name="min_budget" inputmode="decimal"
                            onkeydown="if(['e','E','+','-'].includes(event.key)) event.preventDefault()"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                            value="{{ old('min_budget', $preferences?->min_budget) }}">
                        @error('min_budget')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="max_budget">Maximum budget (per year)</label>
                        <input type="number" step="0.01" min="0" max="9999999999.99" id="max_budget" name="max_budget" inputmode="decimal"
                            onkeydown="if(['e','E','+','-'].includes(event.key)) event.preventDefault()"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                            value="{{ old('max_budget', $preferences?->max_budget) }}">
                        @error('max_budget')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <button type="submit" class="btn-primary">Save Preferences</button>
            </div>
        </form>

    </section>

</main>

<script>
    document.getElementById('max_budget').form.addEventListener('submit', function (e) {
        var min = document.getElementById('min_budget');
        var max = document.getElementById('max_budget');
        max.setCustomValidity('');
        if (min.value !== '' && max.value !== '' && parseFloat(max.value) < parseFloat(min.value)) {
            max.setCustomValidity('Maximum budget must be greater than or equal to the minimum budget.');
            max.reportValidity();
            e.preventDefault();
        }
    });
    document.getElementById('max_budget').addEventListener('input', function () { this.setCustomValidity(''); });
</script>

</body>
</html>
