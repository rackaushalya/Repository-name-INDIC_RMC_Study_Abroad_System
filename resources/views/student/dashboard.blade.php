<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC - Student Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        /* =========================
           RESET
        ========================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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


        /* =========================
           SIDEBAR
        ========================= */

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


        /* MENU */

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


        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 245px;
            min-height: 100vh;
        }


        /* =========================
           TOP BAR
        ========================= */

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e6e9ef;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 30px;

            position: sticky;
            top: 0;
            z-index: 10;
        }


        /* SEARCH BAR */

        .search-container {
            width: 440px;
            position: relative;
        }

        .search-container input {
            width: 100%;
            height: 42px;

            border: 1px solid #dfe4ec;
            border-radius: 8px;

            padding: 0 15px 0 42px;

            font-size: 13px;
            outline: none;

            background: #f8fafc;
        }

        .search-container input:focus {
            background: white;
            border-color: #f97316;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 12px;
            color: #8a94a6;
            font-size: 17px;
        }


        /* TOP RIGHT */

        .top-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .notification {
            position: relative;
            font-size: 20px;
            color: #4b5563;
            cursor: pointer;
        }

        .notification-badge {
            position: absolute;
            top: -7px;
            right: -8px;

            width: 17px;
            height: 17px;

            background: #ef4444;
            color: white;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 9px;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;

            border-radius: 50%;

            background: #f97316;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 13px;
            font-weight: bold;
        }

        .user-info strong {
            display: block;
            font-size: 13px;
        }

        .user-info span {
            display: block;
            font-size: 11px;
            color: #7c8493;
            margin-top: 2px;
        }


        /* =========================
           CONTENT
        ========================= */

        .content {
            padding: 30px;
            max-width: 1600px;
        }


        /* WELCOME */

        .welcome {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 25px;
        }

        .welcome h1 {
            font-size: 25px;
            margin-bottom: 7px;
        }

        .welcome p {
            font-size: 13px;
            color: #727c8d;
        }

        .date {
            font-size: 12px;
            color: #697386;
        }


        /* =========================
           SUMMARY CARDS
        ========================= */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 20px;
        }

        .summary-card {
            background: white;
            border: 1px solid #e7eaf0;
            border-radius: 10px;
            padding: 20px;
            min-height: 145px;
        }

        .summary-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .summary-icon {
            width: 40px;
            height: 40px;

            border-radius: 9px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 19px;
        }

        .orange {
            background: #fff1e8;
            color: #f97316;
        }

        .blue {
            background: #eaf3ff;
            color: #2878df;
        }

        .green {
            background: #eafaf0;
            color: #22a35a;
        }

        .purple {
            background: #f2ecff;
            color: #7c3aed;
        }

        .summary-title {
            margin-top: 15px;
            font-size: 12px;
            color: #788294;
        }

        .summary-value {
            margin-top: 5px;
            font-size: 20px;
            font-weight: 700;
        }

        .summary-status {
            margin-top: 7px;
            font-size: 11px;
            color: #f97316;
        }


        /* =========================
           TWO COLUMN
        ========================= */

        .two-column {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border: 1px solid #e7eaf0;
            border-radius: 10px;
            padding: 22px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }

        .card-header h2 {
            font-size: 16px;
        }

        .view-link {
            color: #f97316;
            font-size: 11px;
            font-weight: 600;
        }


        /* =========================
           APPLICATION TIMELINE
        ========================= */

        .timeline {
            display: flex;
            align-items: flex-start;
            position: relative;
            justify-content: space-between;
        }

        .timeline-line {
            position: absolute;

            top: 17px;
            left: 35px;
            right: 35px;

            height: 2px;
            background: #e4e8ef;

            z-index: 0;
        }

        .timeline-progress {
            position: absolute;

            top: 17px;
            left: 35px;

            width: 55%;

            height: 2px;
            background: #f97316;

            z-index: 1;
        }

        .timeline-step {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100px;
        }

        .step-circle {
            width: 35px;
            height: 35px;

            margin: 0 auto;

            border-radius: 50%;

            background: white;
            border: 2px solid #d8dee8;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 12px;
            font-weight: bold;

            color: #8b95a5;
        }

        .step-circle.completed {
            background: #f97316;
            border-color: #f97316;
            color: white;
        }

        .step-circle.failed {
            background: #ef4444;
            border-color: #ef4444;
            color: white;
        }

        .empty-card-state {
            text-align: center;
            padding: 30px 15px;
            color: #8b95a5;
            font-size: 12px;
        }

        .empty-card-state p {
            margin-bottom: 10px;
        }

        .step-title {
            font-size: 10px;
            font-weight: 600;
            margin-top: 10px;
        }

        .step-date {
            font-size: 9px;
            color: #8b95a5;
            margin-top: 4px;
        }


        /* =========================
           CONSULTANT
        ========================= */

        .consultant-box {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }

        .consultant-avatar {
            width: 55px;
            height: 55px;

            border-radius: 50%;

            background: #f97316;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 17px;
            font-weight: bold;
        }

        .consultant-info h3 {
            font-size: 14px;
        }

        .consultant-info p {
            font-size: 11px;
            color: #7c8493;
            margin-top: 5px;
        }

        .appointment-box {
            background: #fff7f1;
            border-radius: 8px;
            padding: 14px;
        }

        .appointment-label {
            font-size: 10px;
            color: #8a6b58;
        }

        .appointment-time {
            font-size: 12px;
            font-weight: 600;
            margin-top: 6px;
        }

        .appointment-button {
            display: inline-block;

            margin-top: 12px;

            background: #f97316;
            color: white;

            padding: 8px 12px;

            border-radius: 6px;

            font-size: 10px;
        }


        /* =========================
           RECOMMENDATIONS
        ========================= */

        .recommendation {
            display: flex;
            align-items: center;
            gap: 15px;

            padding: 13px 0;

            border-bottom: 1px solid #eef0f4;
        }

        .recommendation:last-child {
            border-bottom: none;
        }

        .university-image {
            width: 65px;
            height: 55px;

            border-radius: 7px;

            background: #e9edf4;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #8490a3;
            font-size: 9px;
            text-align: center;
        }

        .recommendation-info {
            flex: 1;
        }

        .recommendation-info h3 {
            font-size: 12px;
        }

        .recommendation-info p {
            font-size: 10px;
            color: #7b8494;
            margin-top: 4px;
        }

        .match {
            background: #e4f8eb;
            color: #159447;

            padding: 5px 9px;

            border-radius: 20px;

            font-size: 10px;
            font-weight: 600;
        }


        /* =========================
           NOTIFICATIONS
        ========================= */

        .notification-item {
            display: flex;
            gap: 10px;

            padding: 12px 0;

            border-bottom: 1px solid #eef0f4;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-dot {
            width: 8px;
            height: 8px;

            background: #f97316;

            border-radius: 50%;

            margin-top: 4px;

            flex-shrink: 0;
        }

        .notification-text {
            font-size: 11px;
            line-height: 1.4;
        }

        .notification-time {
            font-size: 9px;
            color: #9aa2b0;
            margin-top: 3px;
        }


        /* =========================
           FUND REQUIREMENT
        ========================= */

        .fund-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .fund-item {
            border: 1px solid #e7eaf0;
            border-radius: 8px;
            padding: 16px;
        }

        .fund-item span {
            display: block;
            font-size: 10px;
            color: #7d8797;
            margin-bottom: 7px;
        }

        .fund-item strong {
            font-size: 16px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1200px) {

            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 900px) {

            .sidebar {
                width: 70px;
            }

            .logo-subtitle,
            .logo-main span,
            .menu-title,
            .menu-item span {
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

            .two-column {
                grid-template-columns: 1fr;
            }

            .search-container {
                width: 350px;
            }

        }

        @media (max-width: 650px) {

            .topbar {
                padding: 0 15px;
            }

            .search-container {
                width: 200px;
            }

            .user-info {
                display: none;
            }

            .content {
                padding: 20px 15px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .fund-grid {
                grid-template-columns: 1fr;
            }

            .welcome {
                display: block;
            }

            .date {
                margin-top: 10px;
            }

        }

    </style>
</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<aside class="sidebar">

    <div class="logo">

        <div class="logo-main">
            INDIC <span>RMC</span>
        </div>

        <div class="logo-subtitle">
            STUDY ABROAD, BRIGHTER TOMORROWS
        </div>

    </div>


    <!-- MAIN -->

    <div class="menu-section">

        <div class="menu-title">
            Main
        </div>

        <a href="{{ route('student.dashboard') }}" class="menu-item active">
            <div class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></div>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('student.profile') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-person-fill"></i></div>
            <span>My Profile</span>
        </a>

        <a href="{{ route('student.qualifications') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <span>Qualifications</span>
        </a>

        <a href="{{ route('student.preferences') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-sliders"></i></div>
            <span>Study Preferences</span>
        </a>

    </div>


    <!-- STUDY ABROAD -->

    <div class="menu-section">

        <div class="menu-title">
            Study Abroad
        </div>

        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
            <span>Consultancy Application</span>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-star-fill"></i></div>
            <span>Recommendations</span>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-calendar2-check-fill"></i></div>
            <span>Appointments</span>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-chat-dots-fill"></i></div>
            <span>Consultations</span>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-arrow-repeat"></i></div>
            <span>Follow-ups</span>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-cash-coin"></i></div>
            <span>Fund Requirement</span>
        </a>

        <a href="{{ route('student.documents') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-folder2-open"></i></div>
            <span>Required Documents</span>
        </a>

    </div>


    <!-- ACCOUNT -->

    <div class="menu-section">

        <div class="menu-title">
            Account
        </div>

        <a href="{{ route('student.account.edit') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-gear-fill"></i></div>
            <span>Account Settings</span>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-item" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;font-family:inherit;">
                <div class="menu-icon"><i class="bi bi-box-arrow-right"></i></div>
                <span>Logout</span>
            </button>
        </form>

    </div>

</aside>



<!-- =====================================================
     MAIN
===================================================== -->

<main class="main">


    <!-- =================================================
         TOP BAR
    ================================================== -->

    <header class="topbar">


        <!-- SEARCH BAR -->

        <div class="search-container">

            <div class="search-icon">
                <i class="bi bi-search"></i>
            </div>

            <input
                type="text"
                placeholder="Search universities, courses, countries..."
            >

        </div>


        <!-- TOP RIGHT -->

        <div class="top-right">


            <!-- NOTIFICATION -->

            <div class="notification">

                <i class="bi bi-bell-fill"></i>

                <div class="notification-badge">
                    3
                </div>

            </div>


            <!-- USER -->

            <a href="{{ route('student.account.edit') }}" class="user" style="text-decoration:none; color:inherit;">

                @if ($student->user->profile_image_url ?? null)
                    <img src="{{ $student->user->profile_image_url }}" class="user-avatar" alt="" style="object-fit: cover;">
                @else
                    <div class="user-avatar">
                        {{ strtoupper(substr($student->user->first_name ?? 'S', 0, 1) . substr($student->user->last_name ?? '', 0, 1)) }}
                    </div>
                @endif

                <div class="user-info">

                    <strong>
                        {{ trim(($student->user->first_name ?? '') . ' ' . ($student->user->last_name ?? '')) ?: 'Student' }}
                    </strong>

                    <span>
                        Student
                    </span>

                </div>

            </a>

        </div>

    </header>



    <!-- =================================================
         CONTENT
    ================================================== -->

    <section class="content">


        <!-- WELCOME -->

        <div class="welcome">

            <div>

                <h1>
                    Welcome back, {{ $student->user->first_name ?? 'Student' }}!
                </h1>

                <p>
                    Manage your study abroad journey and track your consultancy progress.
                </p>

            </div>

            <div class="date">
                {{ now()->format('d F Y') }}
            </div>

        </div>



        <!-- =================================================
             SUMMARY CARDS
        ================================================== -->

        <div class="summary-grid">


            <!-- APPLICATION -->

            <div class="summary-card">

                <div class="summary-top">

                    <div>
                        <div class="summary-title">
                            Consultancy Application
                        </div>

                        <div class="summary-value">
                            {{ $latestApplication->application_status ?? 'No Applications' }}
                        </div>

                        <div class="summary-status">
                            @if($latestApplication)
                                Submitted {{ $latestApplication->submitted_at?->format('d M Y') }}
                            @else
                                Start your first application
                            @endif
                        </div>
                    </div>

                    <div class="summary-icon orange">
                        <i class="bi bi-file-earmark-text-fill"></i>
                    </div>

                </div>

            </div>


            <!-- RECOMMENDATIONS -->

            <div class="summary-card">

                <div class="summary-top">

                    <div>

                        <div class="summary-title">
                            Recommendations
                        </div>

                        <div class="summary-value">
                            {{ $recommendations->count() }}
                        </div>

                        <div class="summary-status">
                            {{ $recommendations->isNotEmpty() ? 'Study options available' : 'No recommendations yet' }}
                        </div>

                    </div>

                    <div class="summary-icon blue">
                        <i class="bi bi-star-fill"></i>
                    </div>

                </div>

            </div>


            <!-- APPOINTMENT -->

            <div class="summary-card">

                <div class="summary-top">

                    <div>

                        <div class="summary-title">
                            Upcoming Appointment
                        </div>

                        <div class="summary-value">
                            {{ str_pad($upcomingAppointments->count(), 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="summary-status">
                            {{ $nextAppointment ? $nextAppointment->appointment_date->format('d F Y') : 'None scheduled' }}
                        </div>

                    </div>

                    <div class="summary-icon green">
                        <i class="bi bi-calendar2-check-fill"></i>
                    </div>

                </div>

            </div>


            <!-- PROFILE -->

            <div class="summary-card">

                <div class="summary-top">

                    <div>

                        <div class="summary-title">
                            Profile Completion
                        </div>

                        <div class="summary-value">
                            {{ $profileCompletion['percentage'] }}%
                        </div>

                        <div class="summary-status">
                            {{ $profileCompletion['label'] }}
                        </div>

                    </div>

                    <div class="summary-icon purple">
                        <i class="bi bi-person-check-fill"></i>
                    </div>

                </div>

            </div>

        </div>



        <!-- =================================================
             APPLICATION + CONSULTANT
        ================================================== -->

        <div class="two-column">


            <!-- APPLICATION STATUS -->

            <div class="card">

                <div class="card-header">

                    <h2>
                        Consultancy Application Status
                    </h2>

                    <a href="{{ route('student.applications.index') }}" class="view-link">
                        View Details
                    </a>

                </div>


                @if($latestApplication)

                    <div class="timeline">

                        <div class="timeline-line"></div>

                        <div class="timeline-progress" style="width: {{ $timelineProgressPercent }}%;"></div>

                        @foreach($applicationTimeline as $stepNumber => $step)

                            <div class="timeline-step">

                                <div class="step-circle {{ $step['completed'] ? ($step['failed'] ? 'failed' : 'completed') : '' }}">
                                    @if($step['failed'])
                                        ✕
                                    @elseif($step['completed'])
                                        ✓
                                    @else
                                        {{ $stepNumber }}
                                    @endif
                                </div>

                                <div class="step-title">
                                    {{ $step['label'] }}
                                </div>

                                <div class="step-date">
                                    {{ $step['date'] ? $step['date']->format('d M Y') : 'Pending' }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-card-state">
                        <p>You haven't submitted a consultancy application yet.</p>
                        <a href="{{ route('student.applications.index') }}" class="view-link">Start an application</a>
                    </div>

                @endif

            </div>



            <!-- CONSULTANT -->

            <div class="card">

                <div class="card-header">

                    <h2>
                        My Consultant
                    </h2>

                    @if($assignedConsultant)
                        <a href="#" class="view-link">
                            View Profile
                        </a>
                    @endif

                </div>

                @if($assignedConsultant)

                    <div class="consultant-box">

                        <div class="consultant-avatar">
                            {{ strtoupper(substr($assignedConsultant->user->first_name ?? 'C', 0, 1) . substr($assignedConsultant->user->last_name ?? '', 0, 1)) }}
                        </div>

                        <div class="consultant-info">

                            <h3>
                                {{ trim(($assignedConsultant->user->first_name ?? '') . ' ' . ($assignedConsultant->user->last_name ?? '')) ?: 'Consultant' }}
                            </h3>

                            <p>
                                {{ $assignedConsultant->specialization ?: 'Study Abroad Consultant' }}
                            </p>

                        </div>

                    </div>


                    @if($nextAppointment)

                        <div class="appointment-box">

                            <div class="appointment-label">
                                Next Consultation
                            </div>

                            <div class="appointment-time">
                                {{ $nextAppointment->appointment_date->format('d F Y') }}
                                @if($nextAppointment->start_time)
                                    | {{ \Carbon\Carbon::parse($nextAppointment->start_time)->format('h:i A') }}
                                @endif
                            </div>

                            <a href="#" class="appointment-button">
                                View Appointment
                            </a>

                        </div>

                    @endif

                @else

                    <div class="empty-card-state">
                        <p>No consultant has been assigned yet.</p>
                    </div>

                @endif

            </div>

        </div>



        <!-- =================================================
             RECOMMENDATIONS + NOTIFICATIONS
        ================================================== -->

        <div class="two-column">


            <!-- RECOMMENDATIONS -->

            <div class="card">

                <div class="card-header">

                    <h2>
                        Recommended Study Options
                    </h2>

                    @if($recommendations->isNotEmpty())
                        <a href="#" class="view-link">
                            View All
                        </a>
                    @endif

                </div>

                @forelse($recommendations->take(3) as $recommendation)

                    <div class="recommendation">

                        <div class="university-image">
                            UNIVERSITY
                        </div>

                        <div class="recommendation-info">

                            <h3>
                                {{ $recommendation->course->course_name ?? 'Course' }}
                            </h3>

                            <p>
                                {{ $recommendation->course->university->university_name ?? 'University' }}
                                @if($recommendation->course->university->country->country_name ?? null)
                                    • {{ $recommendation->course->university->country->country_name }}
                                @endif
                            </p>

                        </div>

                        <div class="match">
                            {{ (int) round($recommendation->match_percentage) }}% Match
                        </div>

                    </div>

                @empty

                    <div class="empty-card-state">
                        <p>No study recommendations yet.</p>
                    </div>

                @endforelse

            </div>



            <!-- NOTIFICATIONS -->

            <div class="card">

                <div class="card-header">

                    <h2>
                        Recent Notifications
                    </h2>

                    @if($notifications->isNotEmpty())
                        <a href="#" class="view-link">
                            View All
                        </a>
                    @endif

                </div>

                @forelse($notifications as $notification)

                    <div class="notification-item">

                        <div class="notification-dot"></div>

                        <div>

                            <div class="notification-text">
                                {{ $notification->message ?: $notification->title }}
                            </div>

                            <div class="notification-time">
                                {{ $notification->created_at?->diffForHumans() }}
                            </div>

                        </div>

                    </div>

                @empty

                    <div class="empty-card-state">
                        <p>No new notifications.</p>
                    </div>

                @endforelse

            </div>

        </div>



        <!-- =================================================
             FUND REQUIREMENT
        ================================================== -->

        <div class="card">

            <div class="card-header">

                <h2>
                    Fund Requirement Summary
                </h2>

                @if($fundRequirement)
                    <a href="#" class="view-link">
                        View Details
                    </a>
                @endif

            </div>

            @if($fundRequirement)

                <div class="fund-grid">


                    <div class="fund-item">

                        <span>
                            Tuition Fee
                        </span>

                        <strong>
                            {{ $fundRequirement->currency }} {{ number_format($fundRequirement->total_tuition, 0) }}
                        </strong>

                    </div>


                    <div class="fund-item">

                        <span>
                            Living Expenses
                        </span>

                        <strong>
                            {{ $fundRequirement->currency }} {{ number_format($fundRequirement->total_living_cost, 0) }}
                        </strong>

                    </div>


                    <div class="fund-item">

                        <span>
                            Estimated Total
                        </span>

                        <strong>
                            {{ $fundRequirement->currency }} {{ number_format($fundRequirement->total_required_amount, 0) }}
                        </strong>

                    </div>


                </div>

            @else

                <div class="empty-card-state">
                    <p>No fund requirement has been generated yet.</p>
                </div>

            @endif

        </div>


    </section>

</main>


</body>
</html>
