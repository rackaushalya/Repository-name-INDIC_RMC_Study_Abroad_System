<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
           MAIN
        ========================= */

        .main {
            margin-left: 245px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
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


        /* TOP RIGHT */

        .top-right {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-left: auto;
        }

        .notification-wrap {
            position: relative;
        }

        .notification {
            position: relative;
            display: block;
            padding: 0;
            background: none;
            border: none;
            font-size: 20px;
            color: #4b5563;
            cursor: pointer;
        }

        .notification:hover,
        .notification[aria-expanded="true"] {
            color: #f97316;
        }

        .notification-popup {
            display: none;
            position: absolute;
            top: calc(100% + 18px);
            right: -10px;
            z-index: 20;

            width: 380px;
            max-width: calc(100vw - 30px);

            background: white;
            border: 1px solid #e6e9ef;
            border-radius: 12px;
            box-shadow: 0 12px 32px rgba(16, 26, 43, 0.14);
        }

        .notification-popup.open {
            display: block;
        }

        .popup-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            border-bottom: 1px solid #eef0f4;
        }

        .popup-header h3 {
            font-size: 14px;
        }

        .popup-mark-all {
            background: none;
            border: none;
            padding: 0;
            font-family: inherit;
            font-size: 11px;
            font-weight: 600;
            color: #f97316;
            cursor: pointer;
        }

        .popup-mark-all[hidden] {
            display: none;
        }

        .popup-list {
            max-height: 380px;
            overflow-y: auto;
            padding: 0 18px;
        }

        .popup-item {
            cursor: pointer;
        }

        .popup-item.read {
            cursor: default;
        }

        .popup-item a {
            display: inline-block;
            margin-top: 4px;
            font-size: 10px;
            font-weight: 600;
            color: #f97316;
        }

        .popup-empty {
            padding: 30px 15px;
            text-align: center;
            color: #8b95a5;
            font-size: 12px;
        }

        .notification-badge {
            position: absolute;
            top: -7px;
            right: -10px;

            min-width: 17px;
            height: 17px;
            padding: 0 4px;
            border-radius: 9px;

            background: #ef4444;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 9px;
        }

        .notification-badge.pop {
            animation: badge-pop 0.5s ease;
        }

        @keyframes badge-pop {
            0%   { transform: scale(1); }
            40%  { transform: scale(1.5); }
            100% { transform: scale(1); }
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

        .notification-dot.read {
            background: #d8dee8;
        }

        .notification-item.read .notification-text {
            color: #8b95a5;
        }

        .notification-title {
            font-weight: 700;
            margin-bottom: 2px;
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

            .main,
            .sidebar-collapsed .main {
                margin-left: 70px;
            }

            .two-column {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 650px) {

            .topbar {
                padding: 0 15px;
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
@include('components.sidebar-style')
</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

@include('components.student-sidebar')



<!-- =====================================================
     MAIN
===================================================== -->

<main class="main">


    <!-- =================================================
         TOP BAR
    ================================================== -->

    <header class="topbar">


        <!-- TOP RIGHT -->

        <div class="top-right">


            <!-- NOTIFICATION -->

            <div class="notification-wrap">

                <button type="button" class="notification" id="notificationToggle" title="Notifications" aria-haspopup="true" aria-expanded="false">

                    <i class="bi bi-bell-fill"></i>

                    <div class="notification-badge" id="notificationBadge" data-count="{{ $unreadNotificationCount }}" @if($unreadNotificationCount < 1) style="display:none" @endif>
                        {{ $unreadNotificationCount > 9 ? '9+' : $unreadNotificationCount }}
                    </div>

                </button>

                <div class="notification-popup" id="notificationPopup" role="dialog" aria-label="Notifications">

                    <div class="popup-header">
                        <h3>Notifications</h3>

                        <button type="button" class="popup-mark-all" id="markAllRead" @if($unreadNotificationCount < 1) hidden @endif>
                            Mark all as read
                        </button>
                    </div>

                    <div class="popup-list" id="popupList">
                        @include('student.partials.notification-popup-items')
                    </div>

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



        @include('student.partials.readiness')

        @include('student.partials.eligibility-matcher')

        @include('student.partials.application-overview')

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

                        <div class="timeline-progress" data-progress="{{ $timelineProgressPercent ?? 0 }}"></div>

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

                            <a href="{{ route('student.appointments') }}" class="appointment-button">
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
                        <a href="{{ route('student.recommendations.index') }}" class="view-link">
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

                    <a href="{{ route('student.notifications.index') }}" class="view-link" id="viewAllNotifications" @if($notifications->isEmpty()) style="display:none" @endif>
                        View All
                    </a>

                </div>

                <div id="cardNotifications">
                    @include('student.partials.notification-card-items')
                </div>

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
                    <a href="{{ route('student.fund-requirements.show', $fundRequirement) }}" class="view-link">
                        View Details
                    </a>
                @else
                    <a href="{{ route('student.fund-requirements.create') }}" class="view-link">
                        Generate
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
                    <a href="{{ route('student.fund-requirements.create') }}" class="view-link">
                        Generate Fund Requirement
                    </a>
                </div>

            @endif

        </div>


    </section>

</main>


<script>
(function () {

document.querySelectorAll('.timeline-progress[data-progress]').forEach(function (element) {
    element.style.width = element.dataset.progress + '%';
});


    const toggle = document.getElementById('notificationToggle');
    const popup = document.getElementById('notificationPopup');
    const badge = document.getElementById('notificationBadge');
    const markAll = document.getElementById('markAllRead');
    const viewAll = document.getElementById('viewAllNotifications');
    const popupList = document.getElementById('popupList');
    const cardList = document.getElementById('cardNotifications');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    function setOpen(open) {
        popup.classList.toggle('open', open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    function markItemsRead(id) {
        document.querySelectorAll('[data-notif-id="' + id + '"]').forEach(function (el) {
            el.classList.add('read');
            const dot = el.querySelector('.notification-dot');
            if (dot) dot.classList.add('read');
        });
    }

    function post(url) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(function (response) {
            if (!response.ok) throw new Error('Request failed');
            return response.json();
        });
    }

    toggle.addEventListener('click', function (event) {
        event.stopPropagation();
        setOpen(!popup.classList.contains('open'));
    });

    document.addEventListener('click', function (event) {
        if (!popup.contains(event.target)) setOpen(false);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') setOpen(false);
    });

    // Delegated, because the list is re-rendered whenever new data arrives.
    popupList.addEventListener('click', function (event) {
        const item = event.target.closest('.popup-item');

        if (!item || event.target.closest('a') || item.classList.contains('read')) return;

        post(item.dataset.readUrl)
            .then(function (data) {
                markItemsRead(item.dataset.notifId);
                setUnread(data.unread);
            })
            .catch(function () {});
    });

    markAll.addEventListener('click', function () {
        post("{{ route('student.notifications.read-all') }}")
            .then(function () {
                popup.querySelectorAll('.popup-item').forEach(function (item) {
                    markItemsRead(item.dataset.notifId);
                });
                setUnread(0);
            })
            .catch(function () {});
    });


    /* Live updates: poll for new notifications while the tab is visible. */

    const FEED_URL = "{{ route('student.notifications.feed') }}";
    const POLL_MS = 10000;
    let polling = false;
    let timer = null;

    function poll() {
        if (polling || document.hidden) return Promise.resolve();
        polling = true;

        return fetch(FEED_URL, {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            cache: 'no-store'
        }).then(function (response) {
            // Logged out or session expired: stop quietly instead of erroring.
            if (response.status === 401 || response.status === 403 || response.status === 419) {
                clearInterval(timer);
                throw new Error('stopped');
            }
            if (!response.ok) throw new Error('Request failed');
            return response.json();
        }).then(function (data) {
            const previous = parseInt(badge.dataset.count || '0', 10);

            if (popupList.innerHTML.trim() !== data.popup_html.trim()) {
                const scroll = popupList.scrollTop;
                popupList.innerHTML = data.popup_html;
                popupList.scrollTop = scroll;
            }

            if (cardList.innerHTML.trim() !== data.card_html.trim()) {
                cardList.innerHTML = data.card_html;
            }

            viewAll.style.display = data.has_any ? '' : 'none';
            setUnread(data.unread);

            if (data.unread > previous) {
                badge.classList.remove('pop');
                void badge.offsetWidth; // restart the animation
                badge.classList.add('pop');
            }
        }).catch(function () {
            // Network blips are fine; the next tick will try again.
        }).then(function () {
            polling = false;
        });
    }

    function setUnread(count) {
        badge.dataset.count = count;
        badge.textContent = count > 9 ? '9+' : count;
        badge.style.display = count > 0 ? 'flex' : 'none';
        markAll.hidden = count < 1;
    }

    timer = setInterval(poll, POLL_MS);

    document.addEventListener('visibilitychange', function () {
        if (!document.hidden) poll();
    });
})();
</script>

</body>
</html>
