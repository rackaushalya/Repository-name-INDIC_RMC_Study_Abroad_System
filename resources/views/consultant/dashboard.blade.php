<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Consultant Dashboard</title>

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

    </style>

</head>


<body>


<div class="app">


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <aside class="sidebar">


        <div class="brand">

            <div class="brand-mark">
                IR
            </div>

            <div>

                <div class="brand-name">
                    INDIC RMC
                </div>

                <div class="brand-subtitle">
                    Consultant Portal
                </div>

            </div>

        </div>


        <nav class="nav">


            <!-- OVERVIEW -->

            <div class="nav-section">
                Overview
            </div>


            <a href="#" class="nav-link active">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>

                </svg>

                <span>
                    Dashboard
                </span>

            </a>


            <!-- STUDENTS -->

            <div class="nav-section">
                Students
            </div>


            <a href="#" class="nav-link">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <circle cx="9" cy="8" r="4"/>
                    <path d="M2 21a7 7 0 0 1 14 0"/>
                    <path d="M17 11a4 4 0 1 0 0-6"/>
                    <path d="M22 21a6 6 0 0 0-5-5.9"/>

                </svg>

                <span>
                    Assigned Students
                </span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <rect x="4" y="3" width="16" height="18" rx="2"/>
                    <path d="M8 7h8"/>
                    <path d="M8 11h8"/>
                    <path d="M8 15h5"/>

                </svg>

                <span>
                    Applications
                </span>

            </a>


            <!-- CONSULTATION -->

            <div class="nav-section">
                Consultation
            </div>


            <a href="#" class="nav-link">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <rect x="3" y="4" width="18" height="17" rx="2"/>
                    <path d="M16 2v4"/>
                    <path d="M8 2v4"/>
                    <path d="M3 10h18"/>

                </svg>

                <span>
                    Appointments
                </span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <rect x="4" y="3" width="16" height="18" rx="2"/>
                    <path d="M8 8h8"/>
                    <path d="M8 12h8"/>
                    <path d="M8 16h5"/>

                </svg>

                <span>
                    Consultations
                </span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <path d="M4 5h16v14H4z"/>
                    <path d="M7 9h10"/>
                    <path d="M7 13h7"/>
                    <path d="M7 17h4"/>

                </svg>

                <span>
                    Consultation Records
                </span>

            </a>


            <!-- SCHEDULE -->

            <div class="nav-section">
                Schedule
            </div>


            <a href="#" class="nav-link">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 7v5l3 2"/>

                </svg>

                <span>
                    Availability
                </span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <rect x="3" y="4" width="18" height="17" rx="2"/>
                    <path d="M16 2v4"/>
                    <path d="M8 2v4"/>
                    <path d="M3 10h18"/>

                </svg>

                <span>
                    Calendar
                </span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4z"/>

                </svg>

                <span>
                    Follow-ups
                </span>

            </a>


            <!-- ACCOUNT -->

            <div class="nav-section">
                Account
            </div>


            <a href="#" class="nav-link">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.5 1.5-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1 1.55V20h-2v-.41a1.7 1.7 0 0 0-1-1.55 1.7 1.7 0 0 0-1.88.34l-.06.06-1.5-1.5.06-.06A1.7 1.7 0 0 0 7.4 15a1.7 1.7 0 0 0-1.55-1H5v-2h.85a1.7 1.7 0 0 0 1.55-1 1.7 1.7 0 0 0-.34-1.88L7 9.06l1.5-1.5.06.06a1.7 1.7 0 0 0 1.88.34 1.7 1.7 0 0 0 1.55 1H20v2h-.41a1.7 1.7 0 0 0-1.55 1z"/>

                </svg>

                <span>
                    Account Settings
                </span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <path d="M10 17l5-5-5-5"/>
                    <path d="M15 12H3"/>
                    <path d="M21 4v16"/>

                </svg>

                <span>
                    Logout
                </span>

            </a>


        </nav>

    </aside>



    <!-- =====================================================
         MAIN
    ====================================================== -->

    <main class="main">


        <!-- TOPBAR -->

        <header class="topbar">


            <div class="search">

                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2">

                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-4-4"/>

                </svg>

                <input
                    type="text"
                    placeholder="Search students, applications..."
                >

            </div>


            <div class="topbar-right">


                <div class="notification">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>

                    </svg>

                    <span class="notification-dot"></span>

                </div>


                <div class="profile">

                    <div class="profile-avatar">
                        C
                    </div>

                    <div>

                        <div class="profile-name">
                            Consultant Name
                        </div>

                        <div class="profile-role">
                            Study Abroad Consultant
                        </div>

                    </div>

                </div>

            </div>

        </header>



        <!-- =====================================================
             CONTENT
        ====================================================== -->

        <section class="content">


            <!-- PAGE HEADER -->

            <div class="page-header">

                <div>

                    <h1>
                        Consultant Dashboard
                    </h1>

                    <p>
                        Manage assigned students, consultations and follow-ups.
                    </p>

                </div>

                <div class="date">
                    11 September 2026
                </div>

            </div>



            <!-- =================================================
                 KPI CARDS
            ================================================== -->

            <div class="kpi-grid">


                <!-- STUDENTS -->

                <div class="kpi">

                    <div class="kpi-header">

                        <span class="kpi-label">
                            Assigned Students
                        </span>

                        <div class="kpi-icon">

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <circle cx="9" cy="8" r="4"/>
                                <path d="M2 21a7 7 0 0 1 14 0"/>
                                <path d="M17 11a4 4 0 1 0 0-6"/>
                                <path d="M22 21a6 6 0 0 0-5-5.9"/>

                            </svg>

                        </div>

                    </div>

                    <div class="kpi-value">
                        24
                    </div>

                    <div class="kpi-footer">
                        Active students
                    </div>

                </div>



                <!-- APPOINTMENTS -->

                <div class="kpi">

                    <div class="kpi-header">

                        <span class="kpi-label">
                            Today's Appointments
                        </span>

                        <div class="kpi-icon">

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <rect x="3" y="4" width="18" height="17" rx="2"/>
                                <path d="M16 2v4"/>
                                <path d="M8 2v4"/>
                                <path d="M3 10h18"/>

                            </svg>

                        </div>

                    </div>

                    <div class="kpi-value">
                        06
                    </div>

                    <div class="kpi-footer">
                        4 confirmed
                    </div>

                </div>



                <!-- CONSULTATIONS -->

                <div class="kpi">

                    <div class="kpi-header">

                        <span class="kpi-label">
                            Pending Consultations
                        </span>

                        <div class="kpi-icon">

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <rect x="4" y="3" width="16" height="18" rx="2"/>
                                <path d="M8 8h8"/>
                                <path d="M8 12h8"/>
                                <path d="M8 16h5"/>

                            </svg>

                        </div>

                    </div>

                    <div class="kpi-value">
                        08
                    </div>

                    <div class="kpi-footer">
                        Require consultation
                    </div>

                </div>



                <!-- FOLLOW UPS -->

                <div class="kpi">

                    <div class="kpi-header">

                        <span class="kpi-label">
                            Pending Follow-ups
                        </span>

                        <div class="kpi-icon">

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <path d="M12 20h9"/>
                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4z"/>

                            </svg>

                        </div>

                    </div>

                    <div class="kpi-value">
                        05
                    </div>

                    <div class="kpi-footer">
                        Need your attention
                    </div>

                </div>


            </div>



            <!-- =================================================
                 APPOINTMENTS + AVAILABILITY
            ================================================== -->

            <div class="grid-main">


                <!-- TODAY'S APPOINTMENTS -->

                <div class="panel">

                    <div class="panel-header">

                        <h2 class="panel-title">
                            Today's Appointments
                        </h2>

                        <a href="#" class="panel-link">
                            View Calendar
                        </a>

                    </div>


                    <div class="appointment">


                        <div class="appointment-time">
                            09:00 AM
                        </div>


                        <div class="student-avatar">
                            AM
                        </div>


                        <div class="appointment-info">

                            <strong>
                                Amila Perera
                            </strong>

                            <span>
                                Australia • Software Engineering
                            </span>

                        </div>


                        <div class="appointment-status confirmed">
                            Confirmed
                        </div>

                    </div>


                    <div class="appointment">


                        <div class="appointment-time">
                            10:30 AM
                        </div>


                        <div class="student-avatar">
                            NS
                        </div>


                        <div class="appointment-info">

                            <strong>
                                Nethmi Silva
                            </strong>

                            <span>
                                United Kingdom • Computer Science
                            </span>

                        </div>


                        <div class="appointment-status confirmed">
                            Confirmed
                        </div>

                    </div>


                    <div class="appointment">


                        <div class="appointment-time">
                            01:30 PM
                        </div>


                        <div class="student-avatar">
                            RK
                        </div>


                        <div class="appointment-info">

                            <strong>
                                Ravindu Kumar
                            </strong>

                            <span>
                                Canada • Information Technology
                            </span>

                        </div>


                        <div class="appointment-status pending">
                            Pending
                        </div>

                    </div>


                    <div class="appointment">


                        <div class="appointment-time">
                            03:00 PM
                        </div>


                        <div class="student-avatar">
                            DP
                        </div>


                        <div class="appointment-info">

                            <strong>
                                Dinuka Perera
                            </strong>

                            <span>
                                New Zealand • Data Science
                            </span>

                        </div>


                        <div class="appointment-status confirmed">
                            Confirmed
                        </div>

                    </div>


                </div>



                <!-- AVAILABILITY -->

                <div class="panel">

                    <div class="panel-header">

                        <h2 class="panel-title">
                            My Availability
                        </h2>

                        <a href="#" class="panel-link">
                            Manage
                        </a>

                    </div>


                    <div class="availability-box">

                        <div class="availability-header">

                            <div class="availability-title">
                                Current Status
                            </div>

                            <div class="availability-status">
                                Available
                            </div>

                        </div>

                        <div class="availability-text">
                            You are currently accepting consultation appointments.
                        </div>

                    </div>


                    <div class="availability-box">

                        <div class="availability-header">

                            <div class="availability-title">
                                Today's Schedule
                            </div>

                        </div>

                        <div class="availability-text">
                            09:00 AM — 05:00 PM
                        </div>

                        <a href="#" class="button">
                            Update Availability
                        </a>

                    </div>

                </div>


            </div>



            <!-- =================================================
                 STUDENTS + CONSULTATIONS
            ================================================== -->

            <div class="grid-bottom">


                <!-- ASSIGNED STUDENTS -->

                <div class="panel">

                    <div class="panel-header">

                        <h2 class="panel-title">
                            Assigned Students
                        </h2>

                        <a href="#" class="panel-link">
                            View All
                        </a>

                    </div>


                    <div class="student-row">

                        <div class="student-avatar">
                            AM
                        </div>

                        <div class="student-info">

                            <strong>
                                Amila Perera
                            </strong>

                            <span>
                                Australia • Software Engineering
                            </span>

                        </div>

                        <div class="student-stage">
                            Consultation
                        </div>

                    </div>


                    <div class="student-row">

                        <div class="student-avatar">
                            NS
                        </div>

                        <div class="student-info">

                            <strong>
                                Nethmi Silva
                            </strong>

                            <span>
                                United Kingdom • Computer Science
                            </span>

                        </div>

                        <div class="student-stage">
                            Recommendation
                        </div>

                    </div>


                    <div class="student-row">

                        <div class="student-avatar">
                            RK
                        </div>

                        <div class="student-info">

                            <strong>
                                Ravindu Kumar
                            </strong>

                            <span>
                                Canada • Information Technology
                            </span>

                        </div>

                        <div class="student-stage">
                            Under Review
                        </div>

                    </div>


                    <div class="student-row">

                        <div class="student-avatar">
                            DP
                        </div>

                        <div class="student-info">

                            <strong>
                                Dinuka Perera
                            </strong>

                            <span>
                                New Zealand • Data Science
                            </span>

                        </div>

                        <div class="student-stage">
                            Follow-up
                        </div>

                    </div>


                </div>



                <!-- RECENT CONSULTATIONS -->

                <div class="panel">

                    <div class="panel-header">

                        <h2 class="panel-title">
                            Recent Consultations
                        </h2>

                        <a href="#" class="panel-link">
                            View All
                        </a>

                    </div>


                    <div class="consultation">

                        <div class="consultation-header">

                            <div class="consultation-name">
                                Amila Perera
                            </div>

                            <div class="consultation-date">
                                10 Sep 2026
                            </div>

                        </div>

                        <div class="consultation-text">
                            Initial consultation completed. Discussed study options in Australia.
                        </div>

                    </div>


                    <div class="consultation">

                        <div class="consultation-header">

                            <div class="consultation-name">
                                Nethmi Silva
                            </div>

                            <div class="consultation-date">
                                09 Sep 2026
                            </div>

                        </div>

                        <div class="consultation-text">
                            Academic qualifications reviewed and suitable universities discussed.
                        </div>

                    </div>


                    <div class="consultation">

                        <div class="consultation-header">

                            <div class="consultation-name">
                                Kavindu Fernando
                            </div>

                            <div class="consultation-date">
                                08 Sep 2026
                            </div>

                        </div>

                        <div class="consultation-text">
                            Discussed English qualification requirements and available intakes.
                        </div>

                    </div>


                </div>


            </div>



            <!-- =================================================
                 FOLLOW UPS
            ================================================== -->

            <div class="panel" style="margin-bottom:18px;">

                <div class="panel-header">

                    <h2 class="panel-title">
                        Upcoming Follow-ups
                    </h2>

                    <a href="#" class="panel-link">
                        View All
                    </a>

                </div>


                <div class="follow-up">


                    <div class="follow-up-date">

                        <strong>
                            12
                        </strong>

                        <span>
                            Sep
                        </span>

                    </div>


                    <div class="follow-up-info">

                        <strong>
                            Follow up with Amila Perera
                        </strong>

                        <span>
                            Check university selection and application progress
                        </span>

                    </div>


                    <div class="student-stage">
                        Pending
                    </div>

                </div>


                <div class="follow-up">


                    <div class="follow-up-date">

                        <strong>
                            14
                        </strong>

                        <span>
                            Sep
                        </span>

                    </div>


                    <div class="follow-up-info">

                        <strong>
                            Follow up with Nethmi Silva
                        </strong>

                        <span>
                            Review recommended courses and next steps
                        </span>

                    </div>


                    <div class="student-stage">
                        Pending
                    </div>

                </div>


                <div class="follow-up">


                    <div class="follow-up-date">

                        <strong>
                            16
                        </strong>

                        <span>
                            Sep
                        </span>

                    </div>


                    <div class="follow-up-info">

                        <strong>
                            Follow up with Ravindu Kumar
                        </strong>

                        <span>
                            Discuss additional academic information
                        </span>

                    </div>


                    <div class="student-stage">
                        Pending
                    </div>

                </div>


            </div>



            <!-- =================================================
                 QUICK ACTIONS
            ================================================== -->

            <div class="panel">

                <div class="panel-header">

                    <h2 class="panel-title">
                        Quick Actions
                    </h2>

                </div>


                <div class="quick-actions">


                    <a href="#" class="quick-action">

                        <div class="quick-action-icon">
                            +
                        </div>

                        <span>
                            Add Availability
                        </span>

                    </a>


                    <a href="#" class="quick-action">

                        <div class="quick-action-icon">
                            □
                        </div>

                        <span>
                            View Students
                        </span>

                    </a>


                    <a href="#" class="quick-action">

                        <div class="quick-action-icon">
                            ◷
                        </div>

                        <span>
                            View Calendar
                        </span>

                    </a>


                    <a href="#" class="quick-action">

                        <div class="quick-action-icon">
                            ✓
                        </div>

                        <span>
                            Add Consultation Record
                        </span>

                    </a>


                </div>

            </div>


        </section>

    </main>

</div>


</body>
</html>