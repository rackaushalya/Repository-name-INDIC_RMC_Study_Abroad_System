<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ trim(($student->user->first_name ?? '') . ' ' . ($student->user->last_name ?? '')) ?: 'Student' }} | INDIC RMC</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        /* =====================================
           SIDEBAR
        ====================================== */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 245px;
            height: 100vh;
            background: #101a2b;
            color: white;
            padding: 25px 15px;
            overflow-y: auto;
        }

        .logo {
            padding: 0 12px;
            margin-bottom: 35px;
        }

        .logo-main {
            font-size: 25px;
            font-weight: 700;
            color: #f97316;
        }

        .logo-main span {
            color: white;
        }

        .logo-subtitle {
            font-size: 8px;
            letter-spacing: 0.8px;
            color: #aeb7c7;
            margin-top: 4px;
        }

        .menu-section {
            margin-bottom: 25px;
        }

        .menu-title {
            color: #7e8ba1;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 12px 10px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            margin-bottom: 4px;
            border-radius: 7px;
            color: #cbd3df;
            font-size: 13px;
            transition: 0.2s;
        }

        .menu-item:hover {
            background: #1d2a40;
            color: white;
        }

        .menu-item.active {
            background: #f97316;
            color: white;
        }

        .menu-icon {
            width: 19px;
            height: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        /* =====================================
           MAIN
        ====================================== */

        .main {
            margin-left: 245px;
            min-height: 100vh;
        }

        /* =====================================
           TOPBAR
        ====================================== */

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e6e9ef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .search-box {
            width: 330px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 11px 15px 11px 40px;
            border: 1px solid #dce1e8;
            border-radius: 7px;
            outline: none;
            font-size: 13px;
            background: #f8fafc;
        }

        .search-box input:focus {
            border-color: #f97316;
            background: white;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 11px;
            color: #8a94a6;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f97316;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 13px;
        }

        .profile-info strong {
            display: block;
            font-size: 13px;
        }

        .profile-info span {
            display: block;
            font-size: 11px;
            color: #8a94a6;
            margin-top: 3px;
        }

        /* =====================================
           CONTENT
        ====================================== */

        .content {
            padding: 28px;
        }

        .content-inner {
            max-width: 1200px;
            margin: auto;
        }

        /* -------------------------------------------------
           Back link
        ------------------------------------------------- */

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6b7280;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .back-link:hover {
            color: #172033;
        }

        /* -------------------------------------------------
           Alerts
        ------------------------------------------------- */

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #e8f7ee;
            color: #176b3a;
            border: 1px solid #b8e5c8;
        }

        .alert-error {
            background: #fdecec;
            color: #a32222;
            border: 1px solid #f3bcbc;
        }

        /* -------------------------------------------------
           Profile Header
        ------------------------------------------------- */

        .profile-header {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .profile-identity {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .avatar-lg {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fff1e8;
            color: #f97316;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 22px;
            flex-shrink: 0;
            overflow: hidden;
        }

        .avatar-lg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 22px;
            font-weight: 700;
        }

        .profile-meta {
            color: #6b7280;
            font-size: 13px;
            margin-top: 4px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: #e8f7ee;
            color: #176b3a;
        }

        .status-inactive {
            background: #fdecec;
            color: #a32222;
        }

        .profile-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            height: 40px;
            padding: 0 16px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-status {
            background: #172033;
            color: white;
        }

        .btn-status:hover {
            background: #0f172a;
        }

        .btn-outline {
            background: white;
            border: 1px solid #dce1e8;
            color: #172033;
        }

        .btn-outline:hover {
            background: #f8fafc;
        }

        .btn-danger {
            background: #fdecec;
            color: #b91c1c;
        }

        .btn-danger:hover {
            background: #fbd5d5;
        }

        /* -------------------------------------------------
           Grid / Cards
        ------------------------------------------------- */

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            margin-bottom: 22px;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .card h2 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 13px;
        }

        .info-row .label {
            color: #6b7280;
        }

        .info-row .value {
            color: #172033;
            font-weight: 600;
            text-align: right;
        }

        /* -------------------------------------------------
           Tables
        ------------------------------------------------- */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 10px 12px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #6b7280;
            font-weight: 700;
            border-bottom: 1px solid #e5e7eb;
            background: #f8fafc;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #edf0f3;
            font-size: 13px;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .empty-note {
            color: #9ca3af;
            font-size: 13px;
            padding: 10px 0;
        }

        .status-pill {
            display: inline-flex;
            padding: 4px 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            background: #eef1f5;
            color: #374151;
        }

        .doc-link {
            color: #285da8;
            font-weight: 600;
            text-decoration: none;
        }

        .doc-link:hover {
            text-decoration: underline;
        }

        /* -------------------------------------------------
           Responsive
        ------------------------------------------------- */

        @media (max-width: 900px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 750px) {
            .sidebar {
                width: 70px;
            }

            .logo-subtitle,
            .logo-main span,
            .menu-title,
            .menu-item span:not(.menu-icon) {
                display: none;
            }

            .logo {
                text-align: center;
                padding: 0;
            }

            .logo-main {
                font-size: 17px;
            }

            .menu-item {
                justify-content: center;
            }

            .main {
                margin-left: 70px;
            }

            .topbar {
                padding: 0 15px;
            }

            .search-box {
                width: 200px;
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px;
            }

            .profile-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

<!-- =====================================
     SIDEBAR
====================================== -->

<aside class="sidebar">

    <div class="logo">
        <div class="logo-main">INDIC <span>RMC</span></div>
        <div class="logo-subtitle">ADMINISTRATION PORTAL</div>
    </div>

    <div class="menu-section">
        <div class="menu-title">OVERVIEW</div>

        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></span>
            <span>Dashboard</span>
        </a>
    </div>

    <div class="menu-section">
        <div class="menu-title">MANAGEMENT</div>

        <a href="{{ route('admin.users') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-people-fill"></i></span>
            <span>Users</span>
        </a>

        <a href="{{ route('admin.students') }}" class="menu-item active">
            <span class="menu-icon"><i class="bi bi-person-fill"></i></span>
            <span>Students</span>
        </a>

        <a href="{{ route('admin.consultants') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-person-badge-fill"></i></span>
            <span>Consultants</span>
        </a>

        <a href="{{ route('admin.applications-list') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></span>
            <span>Applications</span>
        </a>

        <a href="{{ route('admin.appointments-list') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-calendar2-check-fill"></i></span>
            <span>Appointments</span>
        </a>
    </div>

    <div class="menu-section">
        <div class="menu-title">STUDY ABROAD</div>

        <a href="{{ route('admin.countries-list') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-globe-americas"></i></span>
            <span>Countries</span>
        </a>

        <a href="{{ route('admin.universities-list') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-bank"></i></span>
            <span>Universities</span>
        </a>

        <a href="{{ route('admin.courses-list') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-mortarboard-fill"></i></span>
            <span>Courses</span>
        </a>
    </div>

    <div class="menu-section">
        <div class="menu-title">SYSTEM</div>

        <a href="{{ route('admin.users') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-gear-fill"></i></span>
            <span>User Management</span>
        </a>
    </div>

</aside>

<!-- =====================================
     MAIN
====================================== -->

<main class="main">

    <header class="topbar">

        <div class="search-box">
            <span class="search-icon"><i class="bi bi-search"></i></span>
            <input type="text" placeholder="Search students, applications...">
        </div>

        <div class="admin-profile">
            <div class="profile-circle">
                {{ strtoupper(substr(auth()->user()->first_name ?? 'A', 0, 1)) }}
            </div>
            <div class="profile-info">
                <strong>{{ auth()->user()->first_name ?? 'Admin' }} {{ auth()->user()->last_name ?? 'User' }}</strong>
                <span>Administrator</span>
            </div>
        </div>

    </header>

<section class="content">
<div class="content-inner">

    <a href="{{ route('admin.students') }}" class="back-link">
        &larr; Back to Student Management
    </a>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif


    {{-- -------------------------------------------------
         Profile Header
    ------------------------------------------------- --}}

    <div class="profile-header">

        <div class="profile-identity">

            <div class="avatar-lg">
                @if($student->user->profile_image_url ?? null)
                    <img src="{{ $student->user->profile_image_url }}" alt="">
                @else
                    {{ strtoupper(substr($student->user->first_name ?? 'S', 0, 1)) }}
                @endif
            </div>

            <div>

                <div class="profile-name">
                    {{ trim(($student->user->first_name ?? '') . ' ' . ($student->user->last_name ?? '')) ?: 'Unknown Student' }}
                </div>

                <div class="profile-meta">
                    Student ID: {{ $student->student_id }}
                    &middot;
                    {{ $student->user->email ?? 'No email on file' }}
                </div>

                <div style="margin-top: 8px;">
                    @if(($student->user->account_status ?? null) === 'active')
                        <span class="badge status-active">Active</span>
                    @else
                        <span class="badge status-inactive">Inactive</span>
                    @endif
                </div>

            </div>

        </div>

        <div class="profile-actions">

            <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-outline">
                Edit Student
            </a>

            <form
                method="POST"
                action="{{ route('admin.students.status', $student) }}"
            >
                @csrf
                @method('PATCH')

                @if(($student->user->account_status ?? null) === 'active')

                    <input type="hidden" name="account_status" value="inactive">

                    <button
                        type="submit"
                        class="btn btn-status"
                        onclick="return confirm('Deactivate this student account?')"
                    >
                        Deactivate Account
                    </button>

                @else

                    <input type="hidden" name="account_status" value="active">

                    <button
                        type="submit"
                        class="btn btn-status"
                        onclick="return confirm('Activate this student account?')"
                    >
                        Activate Account
                    </button>

                @endif

            </form>

            <form
                method="POST"
                action="{{ route('admin.students.destroy', $student) }}"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-danger"
                    onclick="return confirm('Delete this student permanently? This cannot be undone. Students with applications on file cannot be deleted.')"
                >
                    Delete Student
                </button>

            </form>

        </div>

    </div>


    {{-- -------------------------------------------------
         Personal Info + Preferences
    ------------------------------------------------- --}}

    <div class="grid-2">

        <div class="card">

            <h2>Personal Information</h2>

            <div class="info-list">

                <div class="info-row">
                    <span class="label">Phone</span>
                    <span class="value">{{ $student->user->phone ?: 'Not provided' }}</span>
                </div>

                <div class="info-row">
                    <span class="label">Date of Birth</span>
                    <span class="value">{{ $student->date_of_birth?->format('d M Y') ?? 'Not provided' }}</span>
                </div>

                <div class="info-row">
                    <span class="label">Gender</span>
                    <span class="value">{{ $student->gender ?: 'Not provided' }}</span>
                </div>

                <div class="info-row">
                    <span class="label">Nationality</span>
                    <span class="value">{{ $student->nationality ?: 'Not provided' }}</span>
                </div>

                <div class="info-row">
                    <span class="label">Passport Number</span>
                    <span class="value">{{ $student->passport_number ?: 'Not provided' }}</span>
                </div>

                <div class="info-row">
                    <span class="label">Address</span>
                    <span class="value">{{ $student->current_address ?: 'Not provided' }}</span>
                </div>

                <div class="info-row">
                    <span class="label">City / Country</span>
                    <span class="value">{{ trim(($student->city ?? '') . ($student->city && $student->country ? ', ' : '') . ($student->country ?? '')) ?: 'Not provided' }}</span>
                </div>

            </div>

        </div>


        <div class="card">

            <h2>Study Preferences</h2>

            @if($student->preferences)

                <div class="info-list">

                    <div class="info-row">
                        <span class="label">Preferred Country</span>
                        <span class="value">{{ $student->preferences->preferredCountry->country_name ?? 'Not set' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="label">Field of Study</span>
                        <span class="value">{{ $student->preferences->preferred_course_field ?: 'Not set' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="label">Course Level</span>
                        <span class="value">{{ $student->preferences->preferred_course_level ?: 'Not set' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="label">Preferred Intake</span>
                        <span class="value">{{ $student->preferences->preferred_intake ?: 'Not set' }}</span>
                    </div>

                    <div class="info-row">
                        <span class="label">Budget Range</span>
                        <span class="value">
                            @if($student->preferences->min_budget || $student->preferences->max_budget)
                                {{ number_format($student->preferences->min_budget ?? 0) }} - {{ number_format($student->preferences->max_budget ?? 0) }}
                            @else
                                Not set
                            @endif
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="label">Study Mode</span>
                        <span class="value">{{ $student->preferences->preferred_study_mode ?: 'Not set' }}</span>
                    </div>

                </div>

            @else

                <div class="empty-note">No study preferences saved yet.</div>

            @endif

        </div>

    </div>


    {{-- -------------------------------------------------
         Academic Qualifications
    ------------------------------------------------- --}}

    <div class="card">

        <h2>Academic Qualifications</h2>

        @if($student->academicQualifications->isNotEmpty())

            <div class="table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>Qualification</th>
                            <th>Institution</th>
                            <th>Field of Study</th>
                            <th>Completion</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->academicQualifications as $qualification)
                            <tr>
                                <td>{{ $qualification->qualification_name }} ({{ $qualification->qualification_type }})</td>
                                <td>{{ $qualification->institution_name }}</td>
                                <td>{{ $qualification->field_of_study ?: '—' }}</td>
                                <td>{{ $qualification->completion_date?->format('M Y') ?? '—' }}</td>
                                <td>{{ $qualification->grade ?: ($qualification->gpa ?? '—') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        @else

            <div class="empty-note">No academic qualifications on file.</div>

        @endif

    </div>


    {{-- -------------------------------------------------
         English Qualifications
    ------------------------------------------------- --}}

    <div class="card">

        <h2>English Qualifications</h2>

        @if($student->englishQualifications->isNotEmpty())

            <div class="table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>Test</th>
                            <th>Overall Score</th>
                            <th>Test Date</th>
                            <th>Expiry</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->englishQualifications as $english)
                            <tr>
                                <td>{{ $english->test_type }}</td>
                                <td>{{ $english->overall_score ?? '—' }}</td>
                                <td>{{ $english->test_date?->format('d M Y') ?? '—' }}</td>
                                <td>{{ $english->expiry_date?->format('d M Y') ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        @else

            <div class="empty-note">No English qualifications on file.</div>

        @endif

    </div>


    {{-- -------------------------------------------------
         Work Experience
    ------------------------------------------------- --}}

    <div class="card">

        <h2>Work Experience</h2>

        @if($student->workExperiences->isNotEmpty())

            <div class="table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Type</th>
                            <th>Period</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->workExperiences as $work)
                            <tr>
                                <td>{{ $work->job_title }}</td>
                                <td>{{ $work->company_name }}</td>
                                <td>{{ $work->employment_type ?: '—' }}</td>
                                <td>
                                    {{ $work->start_date?->format('M Y') ?? '—' }}
                                    &ndash;
                                    {{ $work->is_current ? 'Present' : ($work->end_date?->format('M Y') ?? '—') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        @else

            <div class="empty-note">No work experience on file.</div>

        @endif

    </div>


    {{-- -------------------------------------------------
         Applications
    ------------------------------------------------- --}}

    <div class="card">

        <h2>Applications</h2>

        @if($student->applications->isNotEmpty())

            <div class="table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Country</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->applications as $application)
                            <tr>
                                <td>{{ $application->application_reference ?: '#' . $application->application_id }}</td>
                                <td>{{ $application->preferredCountry->country_name ?? '—' }}</td>
                                <td>{{ $application->preferredCourse->course_name ?? '—' }}</td>
                                <td><span class="status-pill">{{ $application->application_status }}</span></td>
                                <td>{{ $application->submitted_at?->format('d M Y') ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('admin.applications-show', $application) }}" class="doc-link">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        @else

            <div class="empty-note">No applications submitted yet.</div>

        @endif

    </div>


    {{-- -------------------------------------------------
         Documents
    ------------------------------------------------- --}}

    <div class="card">

        <h2>Uploaded Documents</h2>

        @if($student->documents->isNotEmpty())

            <div class="table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>Document</th>
                            <th>Status</th>
                            <th>Uploaded</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->documents as $document)
                            <tr>
                                <td>{{ $document->document_name }}</td>
                                <td><span class="status-pill">{{ $document->status ?: 'Pending' }}</span></td>
                                <td>{{ $document->uploaded_at?->format('d M Y') ?? '—' }}</td>
                                <td>
                                    @if($document->file_path)
                                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="doc-link">Download</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        @else

            <div class="empty-note">No documents uploaded yet.</div>

        @endif

    </div>


    {{-- -------------------------------------------------
         Appointments
    ------------------------------------------------- --}}

    <div class="card">

        <h2>Appointments</h2>

        @if($student->appointments->isNotEmpty())

            <div class="table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>Consultant</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->appointments as $appointment)
                            <tr>
                                <td>
                                    {{ trim(($appointment->consultant->user->first_name ?? '') . ' ' . ($appointment->consultant->user->last_name ?? '')) ?: 'Unassigned' }}
                                </td>
                                <td>{{ $appointment->appointment_date?->format('d M Y') ?? '—' }}</td>
                                <td>{{ $appointment->start_time ?? '—' }}</td>
                                <td>{{ $appointment->appointment_type ?: '—' }}</td>
                                <td><span class="status-pill">{{ $appointment->appointment_status }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        @else

            <div class="empty-note">No appointments scheduled yet.</div>

        @endif

    </div>

</div>
</section>

</main>

</body>
</html>
