<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC - Student Dashboard</title>

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

        <a href="{{ url("/student/dashboard") }}" class="menu-item active">
            <div class="menu-icon">▦</div>
            <span>Dashboard</span>
        </a>

        <a href="{{ url("/student/profile") }}" class="menu-item">
            <div class="menu-icon">○</div>
            <span>My Profile</span>
        </a>

        <a href="{{ url("/student/qualifications") }}" class="menu-item">
            <div class="menu-icon">▣</div>
            <span>Qualifications</span>
        </a>

        <a href="{{ url("/student/english-qualifications") }}" class="menu-item">
            <div class="menu-icon">□</div>
            <span>English Qualifications</span>
        </a>

        <a href="{{ url("/student/work-experience") }}" class="menu-item">
            <div class="menu-icon">↗</div>
            <span>Work Experience</span>
        </a>

        <a href="{{ url("/student/preferences") }}" class="menu-item">
            <div class="menu-icon">◉</div>
            <span>Study Preferences</span>
        </a>

    </div>


    <!-- STUDY ABROAD -->

    <div class="menu-section">

        <div class="menu-title">
            Study Abroad
        </div>

        <a href="{{ url("/student/applications") }}" class="menu-item">
            <div class="menu-icon">▱</div>
            <span>Consultancy Application</span>
        </a>

        <a href="{{ url("/student/recommendations") }}" class="menu-item">
            <div class="menu-icon">⌂</div>
            <span>Recommendations</span>
        </a>

        <a href="{{ url("/student/appointments") }}" class="menu-item">
            <div class="menu-icon">□</div>
            <span>Appointments</span>
        </a>

        <a href="{{ url("/student/consultations") }}" class="menu-item">
            <div class="menu-icon">◷</div>
            <span>Consultations</span>
        </a>

        <a href="{{ url("/student/follow-ups") }}" class="menu-item">
            <div class="menu-icon">↻</div>
            <span>Follow-ups</span>
        </a>

        <a href="{{ url("/student/fund-requirement") }}" class="menu-item">
            <div class="menu-icon">▤</div>
            <span>Fund Requirement</span>
        </a>

        <a href="{{ url("/student/documents") }}" class="menu-item">
            <div class="menu-icon">▧</div>
            <span>Required Documents</span>
        </a>

    </div>


    <!-- ACCOUNT -->

    <div class="menu-section">

        <div class="menu-title">
            Account
        </div>

        <a href="{{ url("/student/settings") }}" class="menu-item">
            <div class="menu-icon">⚙</div>
            <span>Account Settings</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="menu-item" style="width:100%; border:0; background:transparent; cursor:pointer; text-align:left;">
                <div class="menu-icon">→</div>
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
                ⌕
            </div>

            <input
                type="text"
                placeholder="Search universities, courses, countries..."
            >

        </div>


        <!-- TOP RIGHT -->

        <div class="top-right">


            <!-- NOTIFICATION -->

            <a href="{{ url("/student/notifications") }}" class="notification" aria-label="Notifications">

                ♧

                <div class="notification-badge">
                    3
                </div>

            </div>


            <!-- USER -->

            <div class="user">

                <div class="user-avatar">
                    DG
                </div>

                <div class="user-info">

                    <strong>
                        Student Name
                    </strong>

                    <span>
                        Student
                    </span>

                </div>

            </div>

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
                    Welcome back, Student!
                </h1>

                <p>
                    Manage your study abroad journey and track your consultancy progress.
                </p>

            </div>

            <div class="date">
                11 September 2026
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
                            Under Review
                        </div>

                        <div class="summary-status">
                            Application submitted
                        </div>
                    </div>

                    <div class="summary-icon orange">
                        ▤
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
                            8
                        </div>

                        <div class="summary-status">
                            Study options available
                        </div>

                    </div>

                    <div class="summary-icon blue">
                        ◆
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
                            01
                        </div>

                        <div class="summary-status">
                            15 September 2026
                        </div>

                    </div>

                    <div class="summary-icon green">
                        □
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
                            85%
                        </div>

                        <div class="summary-status">
                            Almost complete
                        </div>

                    </div>

                    <div class="summary-icon purple">
                        ○
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

                    <a href="{{ url("/student/applications") }}" class="view-link">
                        View Details
                    </a>

                </div>


                <div class="timeline">

                    <div class="timeline-line"></div>

                    <div class="timeline-progress"></div>


                    <div class="timeline-step">

                        <div class="step-circle completed">
                            ✓
                        </div>

                        <div class="step-title">
                            Submitted
                        </div>

                        <div class="step-date">
                            01 Sep 2026
                        </div>

                    </div>


                    <div class="timeline-step">

                        <div class="step-circle completed">
                            ✓
                        </div>

                        <div class="step-title">
                            Under Review
                        </div>

                        <div class="step-date">
                            05 Sep 2026
                        </div>

                    </div>


                    <div class="timeline-step">

                        <div class="step-circle completed">
                            ✓
                        </div>

                        <div class="step-title">
                            Consultant Assigned
                        </div>

                        <div class="step-date">
                            10 Sep 2026
                        </div>

                    </div>


                    <div class="timeline-step">

                        <div class="step-circle">
                            4
                        </div>

                        <div class="step-title">
                            Consultation
                        </div>

                        <div class="step-date">
                            Pending
                        </div>

                    </div>


                    <div class="timeline-step">

                        <div class="step-circle">
                            5
                        </div>

                        <div class="step-title">
                            Completed
                        </div>

                        <div class="step-date">
                            Pending
                        </div>

                    </div>

                </div>

            </div>



            <!-- CONSULTANT -->

            <div class="card">

                <div class="card-header">

                    <h2>
                        My Consultant
                    </h2>

                    <a href="{{ url("/student/profile") }}" class="view-link">
                        View Profile
                    </a>

                </div>


                <div class="consultant-box">

                    <div class="consultant-avatar">
                        CS
                    </div>

                    <div class="consultant-info">

                        <h3>
                            Consultant Name
                        </h3>

                        <p>
                            Senior Study Abroad Consultant
                        </p>

                    </div>

                </div>


                <div class="appointment-box">

                    <div class="appointment-label">
                        Next Consultation
                    </div>

                    <div class="appointment-time">
                        15 September 2026 | 10:30 AM
                    </div>

                    <a href="{{ url("/student/appointments") }}" class="appointment-button">
                        View Appointment
                    </a>

                </div>

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

                    <a href="{{ url("/student/recommendations") }}" class="view-link">
                        View All
                    </a>

                </div>


                <!-- RECOMMENDATION 1 -->

                <div class="recommendation">

                    <div class="university-image">
                        UNIVERSITY
                    </div>

                    <div class="recommendation-info">

                        <h3>
                            BSc Computer Science
                        </h3>

                        <p>
                            University of Manchester • United Kingdom
                        </p>

                    </div>

                    <div class="match">
                        94% Match
                    </div>

                </div>


                <!-- RECOMMENDATION 2 -->

                <div class="recommendation">

                    <div class="university-image">
                        UNIVERSITY
                    </div>

                    <div class="recommendation-info">

                        <h3>
                            BSc Software Engineering
                        </h3>

                        <p>
                            University of Melbourne • Australia
                        </p>

                    </div>

                    <div class="match">
                        91% Match
                    </div>

                </div>


                <!-- RECOMMENDATION 3 -->

                <div class="recommendation">

                    <div class="university-image">
                        UNIVERSITY
                    </div>

                    <div class="recommendation-info">

                        <h3>
                            BSc Information Technology
                        </h3>

                        <p>
                            University of Auckland • New Zealand
                        </p>

                    </div>

                    <div class="match">
                        87% Match
                    </div>

                </div>

            </div>



            <!-- NOTIFICATIONS -->

            <div class="card">

                <div class="card-header">

                    <h2>
                        Recent Notifications
                    </h2>

                    <a href="{{ url("/student/notifications") }}" class="view-link">
                        View All
                    </a>

                </div>


                <div class="notification-item">

                    <div class="notification-dot"></div>

                    <div>

                        <div class="notification-text">
                            Your consultancy application is under review.
                        </div>

                        <div class="notification-time">
                            2 hours ago
                        </div>

                    </div>

                </div>


                <div class="notification-item">

                    <div class="notification-dot"></div>

                    <div>

                        <div class="notification-text">
                            New university recommendations are available.
                        </div>

                        <div class="notification-time">
                            Yesterday
                        </div>

                    </div>

                </div>


                <div class="notification-item">

                    <div class="notification-dot"></div>

                    <div>

                        <div class="notification-text">
                            Your consultation appointment has been confirmed.
                        </div>

                        <div class="notification-time">
                            2 days ago
                        </div>

                    </div>

                </div>


                <div class="notification-item">

                    <div class="notification-dot"></div>

                    <div>

                        <div class="notification-text">
                            New message from your consultant.
                        </div>

                        <div class="notification-time">
                            3 days ago
                        </div>

                    </div>

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

                <a href="{{ url("/student/fund-requirement") }}" class="view-link">
                    View Details
                </a>

            </div>


            <div class="fund-grid">


                <div class="fund-item">

                    <span>
                        Tuition Fee
                    </span>

                    <strong>
                        LKR 3,500,000
                    </strong>

                </div>


                <div class="fund-item">

                    <span>
                        Living Expenses
                    </span>

                    <strong>
                        LKR 1,800,000
                    </strong>

                </div>


                <div class="fund-item">

                    <span>
                        Estimated Total
                    </span>

                    <strong>
                        LKR 5,450,000
                    </strong>

                </div>


            </div>

        </div>


    </section>

</main>


</body>
</html>