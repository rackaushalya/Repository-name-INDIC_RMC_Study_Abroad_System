<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Management | INDIC RMC</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a {
            text-decoration: none;
            color: inherit;
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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 14px;
        }

        .page-header h1 {
            font-size: 27px;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #718096;
            font-size: 14px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            height: 40px;
            padding: 0 16px;
            border-radius: 7px;
            border: none;
            background: #f97316;
            color: white;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: #ea670f;
        }

        .btn-outline {
            height: 40px;
            padding: 0 16px;
            border-radius: 7px;
            border: 1px solid #dce1e8;
            background: white;
            color: #172033;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-outline:hover {
            background: #f8fafc;
        }

        /* =====================================
           MODAL
        ====================================== */

        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.5);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-backdrop.show {
            display: flex;
        }

        .modal-box {
            background: white;
            border-radius: 12px;
            width: 100%;
            max-width: 640px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.15);
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #edf0f4;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: #172033;
        }

        .modal-close-btn {
            background: transparent;
            border: none;
            color: #8c96a8;
            cursor: pointer;
            font-size: 20px;
            line-height: 1;
            padding: 4px;
        }

        .modal-close-btn:hover {
            color: #172033;
        }

        .modal-body {
            padding: 22px 24px;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #edf0f4;
            background: #fafbfc;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-grid .form-group.full {
            grid-column: span 2;
        }

        .form-grid label {
            font-size: 12px;
            font-weight: 600;
            color: #172033;
            margin-bottom: 6px;
            display: block;
        }

        .form-hint {
            color: #8a94a6;
            font-size: 11px;
            margin-top: 4px;
            display: block;
        }

        textarea.form-control {
            height: 70px;
            padding: 10px 12px;
            resize: vertical;
            font-family: inherit;
        }

        .btn-secondary {
            height: 40px;
            padding: 0 18px;
            border-radius: 7px;
            border: 1px solid #dce1e8;
            background: white;
            color: #172033;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background: #f8fafc;
        }

        /* -------------------------------------------------
           Alerts
        ------------------------------------------------- */

        .alert {
            padding: 13px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-success {
            background: #eafaf0;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fdecec;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        /* =====================================
           STAT CARDS
        ====================================== */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e2e6ec;
            border-radius: 10px;
            padding: 20px;
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-title {
            color: #68758a;
            font-size: 13px;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .stat-icon.orange { background: #fff1e8; color: #f97316; }
        .stat-icon.blue { background: #eaf3ff; color: #2878df; }
        .stat-icon.green { background: #eafaf0; color: #22a35a; }
        .stat-icon.purple { background: #f2ecff; color: #7c3aed; }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #172033;
        }

        .stat-description {
            margin-top: 6px;
            color: #8a94a6;
            font-size: 12px;
        }

        /* =====================================
           FILTERS
        ====================================== */

        .filter-card {
            background: white;
            border: 1px solid #e2e6ec;
            border-radius: 10px;
            padding: 18px 20px;
            margin-bottom: 20px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr 200px 200px auto;
            gap: 12px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 12px;
            font-weight: 600;
            color: #475569;
        }

        .form-control {
            width: 100%;
            height: 40px;
            padding: 0 12px;
            border: 1px solid #dce1e8;
            border-radius: 7px;
            background: #f8fafc;
            color: #172033;
            outline: none;
            font-size: 13px;
        }

        .form-control:focus {
            border-color: #f97316;
            background: white;
        }

        .btn-reset {
            height: 40px;
            padding: 0 16px;
            border-radius: 7px;
            border: 1px solid #dce1e8;
            background: white;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-reset:hover {
            background: #f8fafc;
        }

        /* =====================================
           TABLE CARD
        ====================================== */

        .card {
            background: white;
            border: 1px solid #e2e6ec;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f4;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 16px;
        }

        .card-header span {
            color: #8a94a6;
            font-size: 12px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 13px 20px;
            background: #f8fafc;
            color: #6b7280;
            font-size: 11px;
            text-transform: uppercase;
        }

        td {
            padding: 15px 20px;
            border-top: 1px solid #edf0f4;
            font-size: 13px;
        }

        tr:hover td {
            background: #fafafa;
        }

        .student-identity {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #fff1e8;
            color: #f97316;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 13px;
            flex-shrink: 0;
            overflow: hidden;
        }

        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-name {
            font-weight: 600;
            font-size: 13px;
        }

        .student-id {
            font-size: 11px;
            color: #8a94a6;
            margin-top: 2px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            background: #eaf3ff;
            color: #2878df;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: bold;
        }

        .status-success {
            background: #e7f7ed;
            color: #198754;
        }

        .status-muted {
            background: #eef1f5;
            color: #64748b;
        }

        .empty {
            text-align: center;
            padding: 45px 20px;
            color: #8a94a6;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 7px;
            border: 1px solid #e2e6ec;
            background: white;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .action-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .action-btn.activate:hover {
            border-color: #bbf7d0;
            color: #15803d;
            background: #f0fdf4;
        }

        .action-btn.deactivate:hover {
            border-color: #fed7aa;
            color: #c2410c;
            background: #fff7ed;
        }

        .action-btn.delete:hover {
            border-color: #fecaca;
            color: #b91c1c;
            background: #fdecec;
        }

        .inline-form {
            display: inline;
        }

        /* =====================================
           PAGINATION
        ====================================== */

        .pagination-section {
            padding: 16px 20px;
            border-top: 1px solid #edf0f4;
            display: flex;
            justify-content: center;
        }

        /* =====================================
           RESPONSIVE
        ====================================== */

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 1000px) {
            .filter-form {
                grid-template-columns: 1fr 1fr;
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

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 15px;
            }

            .topbar {
                padding: 0 15px;
            }

            .search-box {
                width: 200px;
            }

            .filter-form {
                grid-template-columns: 1fr;
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

        <div class="page-header">
            <div>
                <h1>Student Management</h1>
                <p>View and manage every registered student, their accounts, applications, and consultancy progress.</p>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.students.export', request()->query()) }}" class="btn-outline">
                    <i class="bi bi-download"></i> Download CSV
                </a>

                <button type="button" id="btnOpenAddStudent" class="btn-primary">
                    <i class="bi bi-plus-lg"></i> Add Student
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <!-- STAT CARDS -->

        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-title">Total Students</span>
                    <div class="stat-icon orange"><i class="bi bi-people-fill"></i></div>
                </div>
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-description">Registered across all programs</div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-title">Active Accounts</span>
                    <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
                </div>
                <div class="stat-value">{{ $stats['active'] }}</div>
                <div class="stat-description">{{ $stats['inactive'] }} inactive accounts</div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-title">Total Applications</span>
                    <div class="stat-icon blue"><i class="bi bi-file-earmark-text-fill"></i></div>
                </div>
                <div class="stat-value">{{ $stats['total_applications'] }}</div>
                <div class="stat-description">Submitted by students</div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-title">New This Month</span>
                    <div class="stat-icon purple"><i class="bi bi-calendar2-plus-fill"></i></div>
                </div>
                <div class="stat-value">{{ $stats['new_this_month'] }}</div>
                <div class="stat-description">Joined in {{ now()->format('F Y') }}</div>
            </div>

        </div>

        <!-- FILTERS -->

        <form method="GET" action="{{ route('admin.students') }}">
            <div class="filter-card">
                <div class="filter-form">

                    <div class="form-group">
                        <label for="search">Search</label>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Name, email, phone, nationality..." value="{{ request('search') }}">
                    </div>

                    <div class="form-group">
                        <label for="account_status">Status</label>
                        <select id="account_status" name="account_status" class="form-control">
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('account_status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('account_status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country" name="country" class="form-control">
                            <option value="">All Countries</option>
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ request('country') === $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div style="display:flex; gap:8px;">
                            <button type="submit" class="btn-reset" style="background:#f97316; color:white; border-color:#f97316;">Search</button>
                            <a href="{{ route('admin.students') }}" class="btn-reset">Reset</a>
                        </div>
                    </div>

                </div>
            </div>
        </form>

        <!-- TABLE -->

        <div class="card">

            <div class="card-header">
                <h2>Registered Students</h2>
                <span>{{ $students->total() }} {{ $students->total() === 1 ? 'student' : 'students' }}</span>
            </div>

            <div class="table-wrapper">

                @if($students->count() > 0)

                    <table>
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Contact</th>
                                <th>Nationality / Country</th>
                                <th>Applications</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <div class="student-identity">
                                            <div class="student-avatar">
                                                @if($student->user->profile_image_url ?? null)
                                                    <img src="{{ $student->user->profile_image_url }}" alt="">
                                                @else
                                                    {{ strtoupper(substr($student->user->first_name ?? 'S', 0, 1)) }}
                                                @endif
                                            </div>
                                            <div>
                                                <div class="student-name">
                                                    {{ trim(($student->user->first_name ?? '') . ' ' . ($student->user->last_name ?? '')) ?: 'Unknown' }}
                                                </div>
                                                <div class="student-id">STU-{{ str_pad($student->student_id, 4, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $student->user->email ?? 'N/A' }}<br>
                                        <span style="color:#8a94a6;">{{ $student->user->phone ?: 'No phone on file' }}</span>
                                    </td>
                                    <td>
                                        @if($student->nationality || $student->country)
                                            <span class="pill">{{ $student->nationality ?: $student->country }}</span>
                                        @else
                                            <span style="color:#9ca3af;">Not provided</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $student->applications_count }} {{ Str::plural('application', $student->applications_count) }}
                                    </td>
                                    <td>
                                        @if(($student->user->account_status ?? null) === 'active')
                                            <span class="status status-success">Active</span>
                                        @else
                                            <span class="status status-muted">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('admin.students.show', $student) }}" class="action-btn" title="View Profile">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                            <a href="{{ route('admin.students.edit', $student) }}" class="action-btn" title="Edit Student">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>

                                            <form method="POST" action="{{ route('admin.students.status', $student) }}" class="inline-form">
                                                @csrf
                                                @method('PATCH')

                                                @if(($student->user->account_status ?? null) === 'active')
                                                    <input type="hidden" name="account_status" value="inactive">
                                                    <button type="submit" class="action-btn deactivate" title="Deactivate" onclick="return confirm('Deactivate this student account?')">
                                                        <i class="bi bi-slash-circle"></i>
                                                    </button>
                                                @else
                                                    <input type="hidden" name="account_status" value="active">
                                                    <button type="submit" class="action-btn activate" title="Activate" onclick="return confirm('Activate this student account?')">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                @endif
                                            </form>

                                            <form method="POST" action="{{ route('admin.students.destroy', $student) }}" class="inline-form">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="action-btn delete" title="Delete Student" onclick="return confirm('Delete this student permanently? This cannot be undone. Students with applications on file cannot be deleted.')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else

                    <div class="empty">
                        <p>No students found matching your current search or filters.</p>
                    </div>

                @endif

            </div>

            @if($students->hasPages())
                <div class="pagination-section">
                    {{ $students->links() }}
                </div>
            @endif

        </div>

    </section>

</main>

<!-- =====================================
     MODAL: ADD STUDENT
====================================== -->

<div class="modal-backdrop @if($errors->any() && old('first_name') !== null) show @endif" id="modalAddStudentBackdrop">
    <div class="modal-box">

        <div class="modal-header">
            <h3 class="modal-title">Add New Student</h3>
            <button type="button" class="modal-close-btn" id="btnCloseAddStudentModal">&times;</button>
        </div>

        <form method="POST" action="{{ route('admin.students.store') }}">
            @csrf

            <div class="modal-body">

                @if($errors->any())
                    <div class="alert alert-error">
                        <strong>Please fix the following:</strong>
                        <ul style="margin: 6px 0 0 18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-grid">

                    <div class="form-group">
                        <label for="modal_first_name">Full Name *</label>
                        <input type="text" id="modal_first_name" name="first_name" class="form-control" placeholder="e.g. Jane" value="{{ old('first_name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="modal_last_name">Last Name</label>
                        <input type="text" id="modal_last_name" name="last_name" class="form-control" placeholder="e.g. Perera" value="{{ old('last_name') }}">
                    </div>

                    <div class="form-group">
                        <label for="modal_email">Email Address *</label>
                        <input type="email" id="modal_email" name="email" class="form-control" placeholder="e.g. jane.perera@email.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="modal_phone">Phone Number</label>
                        <input type="tel" id="modal_phone" name="phone" class="form-control"
                            inputmode="numeric" pattern="[0-9]{10}" maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                            placeholder="e.g. 0771234567" value="{{ old('phone') }}">
                    </div>

                    <div class="form-group">
                        <label for="modal_password">Password *</label>
                        <input type="password" id="modal_password" name="password" class="form-control" required>
                        <span class="form-hint">Minimum 8 characters.</span>
                    </div>

                    <div class="form-group">
                        <label for="modal_password_confirmation">Confirm Password *</label>
                        <input type="password" id="modal_password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="modal_account_status">Account Status *</label>
                        <select id="modal_account_status" name="account_status" class="form-control" required>
                            <option value="active" {{ old('account_status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('account_status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="modal_nationality">Nationality</label>
                        <input type="text" id="modal_nationality" name="nationality" class="form-control" placeholder="e.g. Sri Lankan" value="{{ old('nationality') }}">
                    </div>

                    <div class="form-group">
                        <label for="modal_date_of_birth">Date of Birth</label>
                        <input type="date" id="modal_date_of_birth" name="date_of_birth" class="form-control" max="{{ now()->format('Y-m-d') }}" value="{{ old('date_of_birth') }}">
                    </div>

                    <div class="form-group">
                        <label for="modal_gender">Gender</label>
                        <select id="modal_gender" name="gender" class="form-control">
                            <option value="">Select gender</option>
                            <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="modal_passport_number">Passport Number</label>
                        <input type="text" id="modal_passport_number" name="passport_number" class="form-control" value="{{ old('passport_number') }}">
                    </div>

                    <div class="form-group">
                        <label for="modal_city">City</label>
                        <input type="text" id="modal_city" name="city" class="form-control" value="{{ old('city') }}">
                    </div>

                    <div class="form-group">
                        <label for="modal_country">Country</label>
                        <select id="modal_country" name="country" class="form-control">
                            <option value="">Select country</option>
                            @foreach($countryOptions as $countryOption)
                                <option value="{{ $countryOption->country_name }}" {{ old('country') === $countryOption->country_name ? 'selected' : '' }}>
                                    {{ $countryOption->country_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group full">
                        <label for="modal_current_address">Address</label>
                        <textarea id="modal_current_address" name="current_address" class="form-control" maxlength="500">{{ old('current_address') }}</textarea>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" id="btnCancelAddStudentModal">Cancel</button>
                <button type="submit" class="btn-primary">Save Student</button>
            </div>

        </form>

    </div>
</div>

<script>
    (function () {
        var backdrop = document.getElementById('modalAddStudentBackdrop');
        var openBtn = document.getElementById('btnOpenAddStudent');
        var closeBtn = document.getElementById('btnCloseAddStudentModal');
        var cancelBtn = document.getElementById('btnCancelAddStudentModal');

        function openModal() {
            backdrop.classList.add('show');
        }

        function closeModal() {
            backdrop.classList.remove('show');
        }

        if (openBtn) {
            openBtn.addEventListener('click', openModal);
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeModal);
        }

        if (backdrop) {
            backdrop.addEventListener('click', function (event) {
                if (event.target === backdrop) {
                    closeModal();
                }
            });
        }
    })();
</script>

</body>
</html>
