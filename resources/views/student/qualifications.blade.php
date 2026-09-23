<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC - Qualifications</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body { font-family: Arial, Helvetica, sans-serif; background: #f5f7fb; color: #172033; }
        a { text-decoration: none; color: inherit; }

        /* SIDEBAR */
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

        /* MAIN */
        .main { margin-left: 245px; min-height: 100vh; }
        .topbar { height: 72px; background: white; border-bottom: 1px solid #e6e9ef; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; position: sticky; top: 0; z-index: 10; }
        .topbar h2 { font-size: 17px; color: #101a2b; }
        .user { display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 38px; height: 38px; border-radius: 50%; background: #f97316; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; }
        .user-info strong { display: block; font-size: 13px; color: #172033; }
        .user-info span { font-size: 11px; color: #8b95a5; }

        .content { padding: 30px; max-width: 1040px; }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; color: #101a2b; margin-bottom: 4px; }
        .page-header p { font-size: 13px; color: #7c8493; }

        .alert { padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; }
        .alert-success { background: #eafaf0; color: #1b7a43; border: 1px solid #cdeed9; }
        .alert-error { background: #fff1f1; color: #c0362c; border: 1px solid #f6cfcc; }
        .alert ul { margin: 0; padding-left: 18px; }

        /* SECTION TABS */
        .tabs { display: flex; gap: 8px; margin-bottom: 24px; border-bottom: 1px solid #e6e9ef; }
        .tab-link {
            padding: 12px 18px; font-size: 13.5px; font-weight: 600; color: #7c8493;
            border-bottom: 2px solid transparent; margin-bottom: -1px;
        }
        .tab-link.is-active { color: #f97316; border-bottom-color: #f97316; }

        .section { display: none; }
        .section.is-active { display: block; }

        .card { background: white; border: 1px solid #e6e9ef; border-radius: 12px; padding: 24px 26px; margin-bottom: 22px; }
        .card-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
        .card-head h3 { font-size: 15px; color: #101a2b; }
        .card-head p { font-size: 12px; color: #9aa2b0; margin-top: 3px; }

        .item-list { display: flex; flex-direction: column; gap: 12px; margin-bottom: 22px; }
        .item {
            border: 1px solid #eef0f4; border-radius: 10px; padding: 16px 18px;
            display: flex; justify-content: space-between; align-items: flex-start; gap: 14px;
        }
        .item-main strong { display: block; font-size: 14px; color: #172033; margin-bottom: 3px; }
        .item-main .meta { font-size: 12.5px; color: #7c8493; margin-bottom: 2px; }
        .item-main .desc { font-size: 12.5px; color: #8b95a5; margin-top: 6px; }
        .item-actions { display: flex; gap: 8px; flex-shrink: 0; }
        .btn-sm {
            padding: 7px 12px; border-radius: 6px; font-size: 12px; font-weight: 700;
            border: 1px solid #dfe4ec; background: white; color: #37415a; cursor: pointer; font-family: inherit;
        }
        .btn-sm:hover { background: #f5f7fb; }
        .btn-sm.danger { color: #c0362c; border-color: #f6cfcc; }
        .btn-sm.danger:hover { background: #fff1f1; }

        .empty-state { font-size: 13px; color: #9aa2b0; padding: 14px 0; }

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }

        .field { margin-bottom: 16px; }
        .field label { display: block; font-size: 12.5px; font-weight: 600; color: #37415a; margin-bottom: 6px; }
        .field input, .field select, .field textarea {
            width: 100%; padding: 10px 13px; border: 1px solid #dfe4ec; border-radius: 8px;
            font-size: 13.5px; color: #172033; background: #f8fafc; font-family: inherit;
        }
        .field input:focus, .field select:focus, .field textarea:focus { outline: none; border-color: #f97316; background: white; }
        .field textarea { resize: vertical; min-height: 70px; }
        .field-error { color: #c0362c; font-size: 12px; margin-top: 5px; }
        .checkbox-field { display: flex; align-items: center; gap: 8px; margin-bottom: 16px; }
        .checkbox-field input { width: auto; }
        .checkbox-field label { margin: 0; font-size: 13px; color: #37415a; font-weight: 600; }

        .btn-primary { padding: 10px 20px; background: #f97316; color: white; border: none; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; }
        .btn-primary:hover { background: #ea6a0f; }

        .toggle-form { display: none; }
        .toggle-form.is-open { display: block; }

        @media (max-width: 900px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .grid-2, .grid-4 { grid-template-columns: 1fr; }
            .item { flex-direction: column; }
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
        <a href="{{ route('student.dashboard') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></div><span>Dashboard</span>
        </a>
        <a href="{{ route('student.profile') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-person-fill"></i></div><span>My Profile</span>
        </a>
        <a href="{{ route('student.qualifications') }}" class="menu-item active" data-tab-target="academic">
            <div class="menu-icon"><i class="bi bi-mortarboard-fill"></i></div><span>Qualifications</span>
        </a>
        <a href="{{ route('student.preferences') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-sliders"></i></div><span>Study Preferences</span>
        </a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Study Abroad</div>
        <a href="{{ route('student.applications.index') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></div><span>Consultancy Application</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-star-fill"></i></div><span>Recommendations</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-calendar2-check-fill"></i></div><span>Appointments</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-chat-dots-fill"></i></div><span>Consultations</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-arrow-repeat"></i></div><span>Follow-ups</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-cash-coin"></i></div><span>Fund Requirement</span></a>
        <a href="{{ route('student.documents') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-folder2-open"></i></div><span>Required Documents</span></a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Account</div>
        <a href="{{ route('student.account.edit') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-gear-fill"></i></div><span>Account Settings</span>
        </a>
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
        <h2>Qualifications</h2>
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
            <h1>Qualifications</h1>
            <p>Add your academic background, English test results, and work experience.</p>
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

        <div class="tabs">
            <a href="#academic" class="tab-link" data-tab="academic">Academic Qualifications</a>
            <a href="#english" class="tab-link" data-tab="english">English Qualifications</a>
            <a href="#work" class="tab-link" data-tab="work">Work Experience</a>
        </div>


        {{-- ================= ACADEMIC QUALIFICATIONS ================= --}}
        <div class="section" id="academic" data-section="academic">

            <div class="card">
                <div class="card-head">
                    <div>
                        <h3>Your Academic Qualifications</h3>
                        <p>{{ $academicQualifications->count() }} record(s)</p>
                    </div>
                    <button type="button" class="btn-sm" data-toggle="academic-add-form">+ Add Qualification</button>
                </div>

                <div class="item-list">
                    @forelse ($academicQualifications as $qualification)
                        <div class="item">
                            <div class="item-main">
                                <strong>{{ str_replace('_', ' ', $qualification->qualification_type) }} — {{ $qualification->qualification_name }}</strong>
                                <div class="meta">{{ $qualification->institution_name }}@if($qualification->field_of_study) &middot; {{ $qualification->field_of_study }}@endif</div>
                                <div class="meta">
                                    {{ optional($qualification->start_date)->format('M Y') }}
                                    &ndash;
                                    {{ optional($qualification->completion_date)->format('M Y') ?: 'Present' }}
                                    @if($qualification->grade) &middot; Grade: {{ $qualification->grade }} @endif
                                    @if($qualification->gpa) &middot; GPA: {{ $qualification->gpa }} @endif
                                </div>
                                @if ($qualification->description)
                                    <div class="desc">{{ $qualification->description }}</div>
                                @endif
                            </div>
                            <div class="item-actions">
                                <button type="button" class="btn-sm" data-toggle="academic-edit-{{ $qualification->qualification_id }}">Edit</button>
                                <form method="POST" action="{{ route('student.qualifications.academic.delete', $qualification) }}" onsubmit="return confirm('Delete this qualification?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm danger">Delete</button>
                                </form>
                            </div>
                        </div>

                        <div class="toggle-form" id="academic-edit-{{ $qualification->qualification_id }}">
                            <form method="POST" action="{{ route('student.qualifications.academic.update', $qualification) }}" class="card" style="background:#f8fafc;">
                                @csrf
                                @method('PUT')
                                <div class="grid-2">
                                    <div class="field">
                                        <label>Qualification type</label>
                                        <select name="qualification_type" required>
                                            @foreach (['O_Level' => 'O/L', 'A_Level' => 'A/L', 'Certificate' => 'Certificate', 'Diploma' => 'Diploma', 'HND' => 'HND', 'Bachelor' => "Bachelor's Degree", 'Master' => "Master's Degree", 'PhD' => 'PhD', 'Other' => 'Other'] as $value => $label)
                                                <option value="{{ $value }}" @selected($qualification->qualification_type === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>Qualification name</label>
                                        <input type="text" name="qualification_name" value="{{ $qualification->qualification_name }}" required>
                                    </div>
                                    <div class="field">
                                        <label>Institution name</label>
                                        <input type="text" name="institution_name" value="{{ $qualification->institution_name }}" required>
                                    </div>
                                    <div class="field">
                                        <label>Field of study</label>
                                        <input type="text" name="field_of_study" value="{{ $qualification->field_of_study }}">
                                    </div>
                                    <div class="field">
                                        <label>Start date</label>
                                        <input type="date" name="start_date" value="{{ optional($qualification->start_date)->format('Y-m-d') }}">
                                    </div>
                                    <div class="field">
                                        <label>Completion date</label>
                                        <input type="date" name="completion_date" value="{{ optional($qualification->completion_date)->format('Y-m-d') }}">
                                    </div>
                                    <div class="field">
                                        <label>Grade</label>
                                        <input type="text" name="grade" value="{{ $qualification->grade }}">
                                    </div>
                                    <div class="field">
                                        <label>GPA (0-100)</label>
                                        <input type="number" step="0.01" min="0" max="100" name="gpa" value="{{ $qualification->gpa }}">
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Description</label>
                                    <textarea name="description">{{ $qualification->description }}</textarea>
                                </div>
                                <button type="submit" class="btn-primary">Save Changes</button>
                                <button type="button" class="btn-sm" data-toggle="academic-edit-{{ $qualification->qualification_id }}">Cancel</button>
                            </form>
                        </div>
                    @empty
                        <div class="empty-state">No academic qualifications added yet.</div>
                    @endforelse
                </div>

                <div class="toggle-form" id="academic-add-form">
                    <form method="POST" action="{{ route('student.qualifications.academic.store') }}" class="card" style="background:#f8fafc;">
                        @csrf
                        <div class="grid-2">
                            <div class="field">
                                <label>Qualification type</label>
                                <select name="qualification_type" required>
                                    <option value="">Select type</option>
                                    @foreach (['O_Level' => 'O/L', 'A_Level' => 'A/L', 'Certificate' => 'Certificate', 'Diploma' => 'Diploma', 'HND' => 'HND', 'Bachelor' => "Bachelor's Degree", 'Master' => "Master's Degree", 'PhD' => 'PhD', 'Other' => 'Other'] as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Qualification name</label>
                                <input type="text" name="qualification_name" placeholder="e.g. BSc in Computer Science" required>
                            </div>
                            <div class="field">
                                <label>Institution name</label>
                                <input type="text" name="institution_name" placeholder="e.g. University of Colombo" required>
                            </div>
                            <div class="field">
                                <label>Field of study</label>
                                <input type="text" name="field_of_study">
                            </div>
                            <div class="field">
                                <label>Start date</label>
                                <input type="date" name="start_date">
                            </div>
                            <div class="field">
                                <label>Completion date</label>
                                <input type="date" name="completion_date">
                            </div>
                            <div class="field">
                                <label>Grade</label>
                                <input type="text" name="grade" placeholder="e.g. First Class">
                            </div>
                            <div class="field">
                                <label>GPA (0-100)</label>
                                <input type="number" step="0.01" min="0" max="100" name="gpa">
                            </div>
                        </div>
                        <div class="field">
                            <label>Description</label>
                            <textarea name="description"></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Add Qualification</button>
                    </form>
                </div>

            </div>
        </div>


        {{-- ================= ENGLISH QUALIFICATIONS ================= --}}
        <div class="section" id="english" data-section="english">

            <div class="card">
                <div class="card-head">
                    <div>
                        <h3>Your English Qualifications</h3>
                        <p>{{ $englishQualifications->count() }} record(s)</p>
                    </div>
                    <button type="button" class="btn-sm" data-toggle="english-add-form">+ Add English Test</button>
                </div>

                <div class="item-list">
                    @forelse ($englishQualifications as $english)
                        <div class="item">
                            <div class="item-main">
                                <strong>{{ $english->test_type }}@if($english->overall_score) — Overall {{ $english->overall_score }}@endif</strong>
                                <div class="meta">
                                    L: {{ $english->listening_score ?? '-' }} &middot;
                                    R: {{ $english->reading_score ?? '-' }} &middot;
                                    W: {{ $english->writing_score ?? '-' }} &middot;
                                    S: {{ $english->speaking_score ?? '-' }}
                                </div>
                                <div class="meta">
                                    Test date: {{ optional($english->test_date)->format('M Y') ?? '-' }}
                                    @if($english->expiry_date) &middot; Expires: {{ $english->expiry_date->format('M Y') }} @endif
                                    @if($english->certificate_number) &middot; Cert #{{ $english->certificate_number }} @endif
                                </div>
                            </div>
                            <div class="item-actions">
                                <button type="button" class="btn-sm" data-toggle="english-edit-{{ $english->english_qualification_id }}">Edit</button>
                                <form method="POST" action="{{ route('student.qualifications.english.delete', $english) }}" onsubmit="return confirm('Delete this English qualification?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm danger">Delete</button>
                                </form>
                            </div>
                        </div>

                        <div class="toggle-form" id="english-edit-{{ $english->english_qualification_id }}">
                            <form method="POST" action="{{ route('student.qualifications.english.update', $english) }}" class="card" style="background:#f8fafc;">
                                @csrf
                                @method('PUT')
                                <div class="grid-2">
                                    <div class="field">
                                        <label>Test type</label>
                                        <select name="test_type" required>
                                            @foreach (['IELTS', 'PTE', 'TOEFL', 'Duolingo', 'Cambridge', 'Other'] as $type)
                                                <option value="{{ $type }}" @selected($english->test_type === $type)>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>Certificate number</label>
                                        <input type="text" name="certificate_number" value="{{ $english->certificate_number }}">
                                    </div>
                                </div>
                                <div class="grid-4">
                                    <div class="field">
                                        <label>Overall</label>
                                        <input type="number" step="0.01" name="overall_score" value="{{ $english->overall_score }}">
                                    </div>
                                    <div class="field">
                                        <label>Listening</label>
                                        <input type="number" step="0.01" name="listening_score" value="{{ $english->listening_score }}">
                                    </div>
                                    <div class="field">
                                        <label>Reading</label>
                                        <input type="number" step="0.01" name="reading_score" value="{{ $english->reading_score }}">
                                    </div>
                                    <div class="field">
                                        <label>Writing</label>
                                        <input type="number" step="0.01" name="writing_score" value="{{ $english->writing_score }}">
                                    </div>
                                </div>
                                <div class="grid-2">
                                    <div class="field">
                                        <label>Speaking</label>
                                        <input type="number" step="0.01" name="speaking_score" value="{{ $english->speaking_score }}">
                                    </div>
                                    <div class="field">
                                        <label>Test date</label>
                                        <input type="date" name="test_date" value="{{ optional($english->test_date)->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Expiry date</label>
                                    <input type="date" name="expiry_date" value="{{ optional($english->expiry_date)->format('Y-m-d') }}">
                                </div>
                                <button type="submit" class="btn-primary">Save Changes</button>
                                <button type="button" class="btn-sm" data-toggle="english-edit-{{ $english->english_qualification_id }}">Cancel</button>
                            </form>
                        </div>
                    @empty
                        <div class="empty-state">No English qualifications added yet.</div>
                    @endforelse
                </div>

                <div class="toggle-form" id="english-add-form">
                    <form method="POST" action="{{ route('student.qualifications.english.store') }}" class="card" style="background:#f8fafc;">
                        @csrf
                        <div class="grid-2">
                            <div class="field">
                                <label>Test type</label>
                                <select name="test_type" required>
                                    <option value="">Select test</option>
                                    @foreach (['IELTS', 'PTE', 'TOEFL', 'Duolingo', 'Cambridge', 'Other'] as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Certificate number</label>
                                <input type="text" name="certificate_number">
                            </div>
                        </div>
                        <div class="grid-4">
                            <div class="field">
                                <label>Overall</label>
                                <input type="number" step="0.01" name="overall_score">
                            </div>
                            <div class="field">
                                <label>Listening</label>
                                <input type="number" step="0.01" name="listening_score">
                            </div>
                            <div class="field">
                                <label>Reading</label>
                                <input type="number" step="0.01" name="reading_score">
                            </div>
                            <div class="field">
                                <label>Writing</label>
                                <input type="number" step="0.01" name="writing_score">
                            </div>
                        </div>
                        <div class="grid-2">
                            <div class="field">
                                <label>Speaking</label>
                                <input type="number" step="0.01" name="speaking_score">
                            </div>
                            <div class="field">
                                <label>Test date</label>
                                <input type="date" name="test_date">
                            </div>
                        </div>
                        <div class="field">
                            <label>Expiry date</label>
                            <input type="date" name="expiry_date">
                        </div>
                        <button type="submit" class="btn-primary">Add English Test</button>
                    </form>
                </div>

            </div>
        </div>


        {{-- ================= WORK EXPERIENCE ================= --}}
        <div class="section" id="work" data-section="work">

            <div class="card">
                <div class="card-head">
                    <div>
                        <h3>Your Work Experience</h3>
                        <p>{{ $workExperiences->count() }} record(s)</p>
                    </div>
                    <button type="button" class="btn-sm" data-toggle="work-add-form">+ Add Work Experience</button>
                </div>

                <div class="item-list">
                    @forelse ($workExperiences as $work)
                        <div class="item">
                            <div class="item-main">
                                <strong>{{ $work->job_title }} — {{ $work->company_name }}</strong>
                                <div class="meta">
                                    {{ $work->employment_type }} &middot;
                                    {{ optional($work->start_date)->format('M Y') }}
                                    &ndash;
                                    {{ $work->is_current ? 'Present' : (optional($work->end_date)->format('M Y') ?? '-') }}
                                </div>
                                @if ($work->description)
                                    <div class="desc">{{ $work->description }}</div>
                                @endif
                            </div>
                            <div class="item-actions">
                                <button type="button" class="btn-sm" data-toggle="work-edit-{{ $work->work_experience_id }}">Edit</button>
                                <form method="POST" action="{{ route('student.qualifications.work.delete', $work) }}" onsubmit="return confirm('Delete this work experience?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm danger">Delete</button>
                                </form>
                            </div>
                        </div>

                        <div class="toggle-form" id="work-edit-{{ $work->work_experience_id }}">
                            <form method="POST" action="{{ route('student.qualifications.work.update', $work) }}" class="card" style="background:#f8fafc;">
                                @csrf
                                @method('PUT')
                                <div class="grid-2">
                                    <div class="field">
                                        <label>Company name</label>
                                        <input type="text" name="company_name" value="{{ $work->company_name }}" required>
                                    </div>
                                    <div class="field">
                                        <label>Job title</label>
                                        <input type="text" name="job_title" value="{{ $work->job_title }}" required>
                                    </div>
                                    <div class="field">
                                        <label>Employment type</label>
                                        <select name="employment_type" required>
                                            @foreach (['Full Time', 'Part Time', 'Internship', 'Contract', 'Other'] as $type)
                                                <option value="{{ $type }}" @selected($work->employment_type === $type)>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>Start date</label>
                                        <input type="date" name="start_date" value="{{ optional($work->start_date)->format('Y-m-d') }}" required>
                                    </div>
                                    <div class="field">
                                        <label>End date</label>
                                        <input type="date" name="end_date" value="{{ optional($work->end_date)->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="checkbox-field">
                                    <input type="checkbox" name="is_current" id="is_current_{{ $work->work_experience_id }}" value="1" @checked($work->is_current)>
                                    <label for="is_current_{{ $work->work_experience_id }}">I currently work here</label>
                                </div>
                                <div class="field">
                                    <label>Description</label>
                                    <textarea name="description">{{ $work->description }}</textarea>
                                </div>
                                <button type="submit" class="btn-primary">Save Changes</button>
                                <button type="button" class="btn-sm" data-toggle="work-edit-{{ $work->work_experience_id }}">Cancel</button>
                            </form>
                        </div>
                    @empty
                        <div class="empty-state">No work experience added yet.</div>
                    @endforelse
                </div>

                <div class="toggle-form" id="work-add-form">
                    <form method="POST" action="{{ route('student.qualifications.work.store') }}" class="card" style="background:#f8fafc;">
                        @csrf
                        <div class="grid-2">
                            <div class="field">
                                <label>Company name</label>
                                <input type="text" name="company_name" required>
                            </div>
                            <div class="field">
                                <label>Job title</label>
                                <input type="text" name="job_title" required>
                            </div>
                            <div class="field">
                                <label>Employment type</label>
                                <select name="employment_type" required>
                                    <option value="">Select type</option>
                                    @foreach (['Full Time', 'Part Time', 'Internship', 'Contract', 'Other'] as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Start date</label>
                                <input type="date" name="start_date" required>
                            </div>
                            <div class="field">
                                <label>End date</label>
                                <input type="date" name="end_date">
                            </div>
                        </div>
                        <div class="checkbox-field">
                            <input type="checkbox" name="is_current" id="is_current_new" value="1">
                            <label for="is_current_new">I currently work here</label>
                        </div>
                        <div class="field">
                            <label>Description</label>
                            <textarea name="description"></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Add Work Experience</button>
                    </form>
                </div>

            </div>
        </div>

    </section>

</main>

<script>
    (function () {
        var tabLinks = document.querySelectorAll('.tab-link');
        var sections = document.querySelectorAll('.section');
        var menuLinks = document.querySelectorAll('[data-tab-target]');

        function activate(tab) {
            tabLinks.forEach(function (l) {
                l.classList.toggle('is-active', l.dataset.tab === tab);
            });
            sections.forEach(function (s) {
                s.classList.toggle('is-active', s.dataset.section === tab);
            });
        }

        tabLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                activate(link.dataset.tab);
                history.replaceState(null, '', '#' + link.dataset.tab);
            });
        });

        var initial = window.location.hash ? window.location.hash.substring(1) : 'academic';
        if (!['academic', 'english', 'work'].includes(initial)) {
            initial = 'academic';
        }
        activate(initial);

        document.querySelectorAll('[data-toggle]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var target = document.getElementById(btn.dataset.toggle);
                if (target) {
                    target.classList.toggle('is-open');
                }
            });
        });
    })();
</script>

</body>
</html>

