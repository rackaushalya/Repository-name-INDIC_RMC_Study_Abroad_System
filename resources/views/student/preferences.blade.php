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

        .sidebar { position: fixed; left: 0; top: 0; width: 245px; height: 100vh; background: #101a2b; color: white; padding: 25px 15px; overflow-y: auto; }
        .logo { padding: 0 12px; margin-bottom: 35px; }
        .logo-main { font-size: 25px; font-weight: 700; color: #f97316; }
        .logo-main span { color: white; }
        .logo-subtitle { font-size: 8px; letter-spacing: 0.8px; color: #aeb7c7; margin-top: 4px; }
        .menu-section { margin-bottom: 25px; }
        .menu-title { color: #7e8ba1; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; margin: 0 12px 10px; }
        .menu-item { display: flex; align-items: center; gap: 12px; padding: 11px 12px; margin-bottom: 4px; border-radius: 7px; color: #cbd3df; font-size: 13px; transition: 0.2s; }
        .menu-item:hover { background: #1d2a40; color: white; }
        .menu-item.active { background: #f97316; color: white; }
        .menu-icon { width: 19px; height: 19px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }

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
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .grid-2 { grid-template-columns: 1fr; }
        }

    </style>
</head>
<body>

<aside class="sidebar">
    <div class="logo">
        <div class="logo-main">INDIC <span>RMC</span></div>
        <div class="logo-subtitle">STUDY ABROAD, BRIGHTER TOMORROWS</div>
    </div>

    <div class="menu-section">
        <div class="menu-title">Main</div>
        <a href="{{ route('student.dashboard') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></div><span>Dashboard</span></a>
        <a href="{{ route('student.profile') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-person-fill"></i></div><span>My Profile</span></a>
        <a href="{{ route('student.qualifications') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-mortarboard-fill"></i></div><span>Qualifications</span></a>
        <a href="{{ route('student.preferences') }}" class="menu-item active"><div class="menu-icon"><i class="bi bi-sliders"></i></div><span>Study Preferences</span></a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Study Abroad</div>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></div><span>Consultancy Application</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-star-fill"></i></div><span>Recommendations</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-calendar2-check-fill"></i></div><span>Appointments</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-chat-dots-fill"></i></div><span>Consultations</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-arrow-repeat"></i></div><span>Follow-ups</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-cash-coin"></i></div><span>Fund Requirement</span></a>
        <a href="{{ route('student.documents') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-folder2-open"></i></div><span>Required Documents</span></a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Account</div>
        <a href="{{ route('student.account.edit') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-gear-fill"></i></div><span>Account Settings</span></a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-item" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;font-family:inherit;">
                <div class="menu-icon"><i class="bi bi-box-arrow-right"></i></div><span>Logout</span>
            </button>
        </form>
    </div>
</aside>

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
                            placeholder="e.g. Computer Science, Business">
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
                            placeholder="e.g. September 2027">
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
                            placeholder="e.g. 2 years">
                        @error('preferred_duration')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="min_budget">Minimum budget (per year)</label>
                        <input type="number" step="0.01" min="0" id="min_budget" name="min_budget"
                            value="{{ old('min_budget', $preferences?->min_budget) }}">
                        @error('min_budget')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="max_budget">Maximum budget (per year)</label>
                        <input type="number" step="0.01" min="0" id="max_budget" name="max_budget"
                            value="{{ old('max_budget', $preferences?->max_budget) }}">
                        @error('max_budget')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <button type="submit" class="btn-primary">Save Preferences</button>
            </div>
        </form>

    </section>

</main>

</body>
</html>
