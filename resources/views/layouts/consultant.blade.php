<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Consultant Portal') | INDIC RMC</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI",
                         Roboto, Arial, sans-serif;
            background: #f7f8fa;
            color: #172033;
        }

        a {
            text-decoration: none;
            color: inherit;
        }


        /* =====================================================
           LAYOUT
        ===================================================== */

         /* =====================================================
           LAYOUT
        ===================================================== */
        .app {
            display: flex;
            min-height: 100vh;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 250px;
            background: #111827;
            color: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 100;
        }

        .brand {
            height: 76px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid #252d3b;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: #f58220;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            margin-right: 11px;
        }

        .brand-name {
            font-size: 17px;
            font-weight: 700;
            letter-spacing: -.3px;
        }

        .brand-subtitle {
            font-size: 10px;
            color: #8c96a8;
            margin-top: 2px;
        }


        /* =====================================================
           NAVIGATION
        ===================================================== */

        .nav {
            padding: 20px 12px;
        }

        .nav-section {
            font-size: 10px;
            text-transform: uppercase;
            color: #697386;
            font-weight: 700;
            letter-spacing: .8px;
            padding: 0 12px;
            margin: 18px 0 8px;
        }

        .nav-section:first-child {
            margin-top: 0;
        }

        .nav-link {
            height: 42px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 12px;
            border-radius: 7px;
            color: #b9c0cc;
            font-size: 13px;
            margin-bottom: 3px;
            transition: all .2s ease;
        }

        .nav-link:hover {
            background: #1c2534;
            color: #ffffff;
        }

        .nav-link.active {
            background: #f58220;
            color: #ffffff;
        }

        .nav-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            height: 76px;
            background: #ffffff;
            border-bottom: 1px solid #e7e9ee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .search {
            width: 360px;
            position: relative;
        }

        .search input {
            width: 100%;
            height: 40px;
            border: 1px solid #e1e5eb;
            border-radius: 7px;
            background: #fafbfc;
            padding: 0 14px 0 38px;
            font-size: 12px;
            outline: none;
            color: #172033;
        }

        .search input:focus {
            border-color: #f58220;
            background: #ffffff;
        }

        .search svg {
            position: absolute;
            left: 13px;
            top: 12px;
            width: 15px;
            height: 15px;
            color: #8b94a4;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .notification {
            width: 36px;
            height: 36px;
            border-radius: 7px;
            border: 1px solid #e4e7ec;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: #4b5565;
        }

        .notification svg {
            width: 17px;
            height: 17px;
        }

        .notification-dot {
            width: 7px;
            height: 7px;
            background: #f58220;
            border-radius: 50%;
            position: absolute;
            top: 7px;
            right: 7px;
            border: 2px solid white;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-left: 18px;
            border-left: 1px solid #e5e7eb;
        }

        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f58220;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 13px;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 600;
        }

        .profile-role {
            font-size: 10px;
            color: #8a93a3;
            margin-top: 2px;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            padding: 28px 30px 40px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-size: 23px;
            font-weight: 700;
            color: #111827;
            letter-spacing: -.4px;
        }

        .page-header p {
            margin-top: 5px;
            font-size: 12px;
            color: #737d8e;
        }

        .date {
            font-size: 11px;
            color: #697386;
            background: #ffffff;
            border: 1px solid #e1e5eb;
            border-radius: 7px;
            padding: 9px 13px;
        }


        /* =====================================================
           KPI CARDS
        ===================================================== */

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .kpi {
            background: #ffffff;
            border: 1px solid #e4e7ec;
            border-radius: 9px;
            padding: 18px;
        }

        .kpi-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .kpi-label {
            color: #737d8e;
            font-size: 11px;
            font-weight: 500;
        }

        .kpi-icon {
            width: 34px;
            height: 34px;
            border-radius: 7px;
            background: #fff3e9;
            color: #f58220;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kpi-icon svg {
            width: 17px;
            height: 17px;
        }

        .kpi-value {
            font-size: 21px;
            font-weight: 700;
            color: #111827;
            margin: 12px 0 5px;
        }

        .kpi-footer {
            font-size: 10px;
            color: #8a93a3;
        }

        .success {
            color: #198754;
            font-weight: 600;
        }


        /* =====================================================
           GRID
        ===================================================== */

        .grid-main {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 18px;
            margin-bottom: 18px;
        }

        .grid-bottom {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 18px;
            margin-bottom: 18px;
        }

        .panel {
            background: #ffffff;
            border: 1px solid #e4e7ec;
            border-radius: 9px;
            padding: 20px;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .panel-title {
            font-size: 14px;
            font-weight: 650;
            color: #111827;
        }

        .panel-link {
            font-size: 10px;
            color: #f58220;
            font-weight: 600;
        }


        /* =====================================================
           TODAY'S APPOINTMENTS
        ===================================================== */

        .appointment {
            display: flex;
            align-items: center;
            padding: 13px 0;
            border-bottom: 1px solid #f0f1f3;
            gap: 12px;
        }

        .appointment:last-child {
            border-bottom: none;
        }

        .appointment-time {
            width: 65px;
            font-size: 10px;
            color: #737d8e;
            font-weight: 600;
        }

        .student-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #fff3e9;
            color: #f58220;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
        }

        .appointment-info {
            flex: 1;
        }

        .appointment-info strong {
            display: block;
            font-size: 11px;
            font-weight: 650;
        }

        .appointment-info span {
            display: block;
            font-size: 9px;
            color: #8a93a3;
            margin-top: 4px;
        }

        .appointment-status {
            font-size: 9px;
            padding: 5px 7px;
            border-radius: 5px;
            font-weight: 600;
        }

        .confirmed {
            color: #198754;
            background: #edf8f2;
        }

        .pending {
            color: #b7791f;
            background: #fff8e6;
        }


        /* =====================================================
           AVAILABILITY
        ===================================================== */

        .availability-box {
            background: #fafbfc;
            border: 1px solid #edf0f3;
            border-radius: 7px;
            padding: 15px;
            margin-bottom: 14px;
        }

        .availability-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .availability-title {
            font-size: 11px;
            font-weight: 650;
        }

        .availability-status {
            font-size: 9px;
            color: #198754;
            background: #edf8f2;
            padding: 5px 7px;
            border-radius: 5px;
            font-weight: 600;
        }

        .availability-text {
            font-size: 9px;
            color: #8a93a3;
            margin-top: 8px;
        }

        .button {
            display: inline-block;
            background: #f58220;
            color: white;
            padding: 8px 11px;
            border-radius: 6px;
            font-size: 9px;
            margin-top: 10px;
        }


        /* =====================================================
           ASSIGNED STUDENTS
        ===================================================== */

        .student-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f1f3;
        }

        .student-row:last-child {
            border-bottom: none;
        }

        .student-info {
            flex: 1;
        }

        .student-info strong {
            display: block;
            font-size: 11px;
            font-weight: 650;
        }

        .student-info span {
            display: block;
            font-size: 9px;
            color: #8a93a3;
            margin-top: 4px;
        }

        .student-stage {
            font-size: 9px;
            color: #697386;
            background: #f4f5f7;
            padding: 5px 7px;
            border-radius: 5px;
        }


        /* =====================================================
           CONSULTATIONS
        ===================================================== */

        .consultation {
            padding: 12px 0;
            border-bottom: 1px solid #f0f1f3;
        }

        .consultation:last-child {
            border-bottom: none;
        }

        .consultation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .consultation-name {
            font-size: 11px;
            font-weight: 650;
        }

        .consultation-date {
            font-size: 8px;
            color: #9aa2af;
        }

        .consultation-text {
            font-size: 9px;
            color: #737d8e;
            margin-top: 5px;
            line-height: 1.4;
        }


        /* =====================================================
           FOLLOW UPS
        ===================================================== */

        .follow-up {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f1f3;
        }

        .follow-up:last-child {
            border-bottom: none;
        }

        .follow-up-date {
            width: 42px;
            height: 42px;
            border-radius: 7px;
            background: #fff3e9;
            color: #f58220;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .follow-up-date strong {
            font-size: 13px;
        }

        .follow-up-date span {
            font-size: 7px;
            text-transform: uppercase;
        }

        .follow-up-info {
            flex: 1;
        }

        .follow-up-info strong {
            display: block;
            font-size: 11px;
        }

        .follow-up-info span {
            display: block;
            font-size: 9px;
            color: #8a93a3;
            margin-top: 4px;
        }


        /* =====================================================
           QUICK ACTIONS
        ===================================================== */

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .quick-action {
            border: 1px solid #e5e8ed;
            border-radius: 7px;
            padding: 14px;
            text-align: center;
            background: #ffffff;
            transition: .2s;
        }

        .quick-action:hover {
            border-color: #f58220;
        }

        .quick-action-icon {
            width: 30px;
            height: 30px;
            margin: 0 auto 8px;
            border-radius: 6px;
            background: #fff3e9;
            color: #f58220;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .quick-action span {
            font-size: 9px;
            color: #4b5565;
            font-weight: 600;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1150px) {

            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .grid-main,
            .grid-bottom {
                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 750px) {

            .sidebar {
                width: 70px;
            }

            .brand {
                justify-content: center;
                padding: 0;
            }

            .brand-mark {
                margin: 0;
            }

            .brand-name,
            .brand-subtitle,
            .nav-section,
            .nav-link span {
                display: none;
            }

            .nav-link {
                justify-content: center;
            }

            .main {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .search {
                display: none;
            }

            .content {
                padding: 20px;
            }

            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }

        }


        @media (max-width: 500px) {

            .kpi-grid {
                grid-template-columns: 1fr;
            }

            .profile-name,
            .profile-role {
                display: none;
            }

            .topbar {
                padding: 0 18px;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

        }

        /* ---- shared page components (added) ---- */
        .alert { padding: 11px 14px; border-radius: 7px; font-size: 12px; margin-bottom: 16px; }
        .alert-success { background:#e8f6ee; color:#146c43; border:1px solid #bfe3cf; }
        .alert-error { background:#fdecec; color:#b02a37; border:1px solid #f3c2c6; }
        .toolbar { display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin-bottom:16px; }
        .toolbar input, .toolbar select, .field input, .field select, .field textarea {
            height:38px; border:1px solid #e1e5eb; border-radius:7px; background:#fff; padding:0 12px;
            font-size:12px; color:#172033; outline:none; font-family:inherit; }
        .field textarea { height:auto; padding:10px 12px; width:100%; resize:vertical; line-height:1.5; }
        .toolbar input:focus, .toolbar select:focus, .field input:focus, .field select:focus, .field textarea:focus { border-color:#f58220; }
        .toolbar input[type=text] { width:260px; }
        .btn { display:inline-flex; align-items:center; justify-content:center; gap:6px; height:36px; padding:0 15px;
            border-radius:7px; border:1px solid #f58220; background:#f58220; color:#fff; font-size:12px; font-weight:600; cursor:pointer; font-family:inherit; }
        .btn:hover { background:#e07414; }
        .btn-light { background:#fff; color:#4b5565; border-color:#e1e5eb; }
        .btn-light:hover { background:#f7f8fa; }
        .btn-sm { height:30px; padding:0 11px; font-size:11px; }
        .table-wrap { overflow-x:auto; }
        table.tbl { width:100%; border-collapse:collapse; font-size:12px; }
        table.tbl th { text-align:left; font-size:10px; text-transform:uppercase; letter-spacing:.6px; color:#697386; padding:10px 12px; border-bottom:1px solid #e4e7ec; white-space:nowrap; }
        table.tbl td { padding:12px; border-bottom:1px solid #f0f2f5; vertical-align:middle; }
        table.tbl tr:last-child td { border-bottom:0; }
        .muted { color:#8a93a3; font-size:11px; }
        .strong { font-weight:600; color:#111827; }
        .badge { align-self:center; display:inline-block; padding:3px 9px; border-radius:20px; font-size:10px; font-weight:600; background:#eef0f4; color:#4b5565; white-space:nowrap; }
        .badge.orange { background:#fff3e9; color:#c2610c; }
        .badge.green { background:#e8f6ee; color:#146c43; }
        .badge.blue { background:#e7f0fd; color:#1d4ed8; }
        .badge.red { background:#fdecec; color:#b02a37; }
        .badge.grey { background:#eef0f4; color:#4b5565; }
        .empty { text-align:center; padding:34px 10px; color:#8a93a3; font-size:12px; }
        .pager { margin-top:16px; font-size:12px; }
        .pager nav svg { width:16px; height:16px; }
        .pager nav > div:first-child { display:none; }
        .pager nav a, .pager nav span[aria-current] span { padding:5px 10px; }
        .detail-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px 20px; }
        .detail-grid dt { font-size:10px; text-transform:uppercase; letter-spacing:.5px; color:#8a93a3; margin-bottom:3px; }
        .detail-grid dd { font-size:13px; color:#172033; }
        .stack { display:flex; flex-direction:column; gap:18px; }
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        .field label { display:block; font-size:11px; font-weight:600; color:#4b5565; margin-bottom:6px; }
        .field.full { grid-column:1/-1; }
        .field .err { color:#b02a37; font-size:11px; margin-top:4px; }
        .inline-form { display:inline-flex; gap:6px; align-items:center; }
        .inline-form select { height:30px; font-size:11px; border:1px solid #e1e5eb; border-radius:7px; padding:0 8px; background:#fff; }
        .prose { font-size:13px; line-height:1.65; white-space:pre-line; color:#172033; }
        /* calendar */
        .cal-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; }
        .cal-head h2 { font-size:16px; font-weight:700; }
        .cal-grid { display:grid; grid-template-columns:repeat(7,1fr); border-top:1px solid #e4e7ec; border-left:1px solid #e4e7ec; }
        .cal-dow { padding:8px; font-size:10px; text-transform:uppercase; font-weight:700; color:#697386; background:#fafbfc; border-right:1px solid #e4e7ec; border-bottom:1px solid #e4e7ec; }
        .cal-cell { min-height:98px; padding:6px; border-right:1px solid #e4e7ec; border-bottom:1px solid #e4e7ec; background:#fff; font-size:11px; }
        .cal-cell.out { background:#fafbfc; color:#b4bac5; }
        .cal-cell.today { background:#fff8f1; }
        .cal-cell.selected { outline:2px solid #f58220; outline-offset:-2px; }
        .cal-day { font-weight:700; font-size:11px; margin-bottom:4px; display:block; }
        .cal-ev { display:block; padding:2px 5px; margin-bottom:3px; border-radius:4px; font-size:10px; line-height:1.35; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; background:#e7f0fd; color:#1d4ed8; }
        .cal-ev.Requested { background:#fff3e9; color:#c2610c; }
        .cal-ev.Confirmed { background:#e7f0fd; color:#1d4ed8; }
        .cal-ev.Completed { background:#e8f6ee; color:#146c43; }
        .cal-ev.Cancelled, .cal-ev.No\ Show { background:#eef0f4; color:#697386; text-decoration:line-through; }
        .cal-more { font-size:10px; color:#697386; }
        .legend { display:flex; gap:14px; flex-wrap:wrap; margin-top:14px; font-size:11px; color:#697386; }
        .agenda-item { display:flex; gap:12px; padding:12px 0; border-bottom:1px solid #f0f2f5; }
        .agenda-item:last-child { border-bottom:0; }
        .agenda-time { min-width:92px; font-weight:700; font-size:12px; color:#111827; }
        @media (max-width:1150px){ .detail-grid{grid-template-columns:repeat(2,1fr);} }
        @media (max-width:750px){ .form-grid{grid-template-columns:1fr;} .cal-cell{min-height:64px;} .cal-ev{font-size:0; height:6px; padding:0;} .toolbar input[type=text]{width:100%;} }
    </style>
    @stack('styles')
</head>
<body>
<div class="app">

    @include('components.consultant-sidebar')

    <main class="main">

        <header class="topbar">
            <form class="search" method="GET" action="{{ route('consultant.students') }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-4-4"/>
                </svg>
                <input type="text" name="q" value="{{ request()->routeIs('consultant.students') ? request('q') : '' }}"
                       placeholder="Search assigned students...">
            </form>

            <div class="topbar-right">
                @php
                    $authUser = auth()->user();
                    $fullName = trim(($authUser->first_name ?? '') . ' ' . ($authUser->last_name ?? '')) ?: 'Consultant';
                @endphp
                <div class="profile">
                    <div class="profile-avatar">{{ strtoupper(mb_substr($fullName, 0, 1)) }}</div>
                    <div>
                        <div class="profile-name">{{ $fullName }}</div>
                        <div class="profile-role">Study Abroad Consultant</div>
                    </div>
                </div>
            </div>
        </header>

        <section class="content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @yield('content')
        </section>
    </main>
</div>
@stack('scripts')
</body>
</html>
