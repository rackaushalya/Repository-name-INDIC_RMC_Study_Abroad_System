<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Admin Dashboard</title>

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
            width: 330px;
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
            font-size: 25px;
            font-weight: 700;
            color: #111827;
            margin: 12px 0 5px;
        }

        .kpi-footer {
            font-size: 10px;
            color: #8a93a3;
        }

        .growth {
            color: #198754;
            font-weight: 600;
        }


        /* =====================================================
           CONTENT GRID
        ===================================================== */

        .grid-main {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 18px;
            margin-bottom: 18px;
        }

        .grid-bottom {
            display: grid;
            grid-template-columns: 1.7fr 1fr;
            gap: 18px;
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
           CHART
        ===================================================== */

        .chart-area {
            height: 220px;
            display: flex;
            align-items: flex-end;
            gap: 22px;
            padding: 10px 8px 0;
            border-bottom: 1px solid #e7e9ed;
        }

        .bar-group {
            height: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
        }

        .bar-value {
            width: 100%;
            max-width: 28px;
            background: #f58220;
            border-radius: 4px 4px 0 0;
        }

        .bar-label {
            font-size: 9px;
            color: #9aa2af;
            margin-top: 8px;
            margin-bottom: -17px;
        }


        /* =====================================================
           APPLICATION STATUS
        ===================================================== */

        .status-item {
            margin-bottom: 18px;
        }

        .status-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 7px;
        }

        .status-name {
            font-size: 11px;
            color: #4d5666;
        }

        .status-count {
            font-size: 11px;
            font-weight: 600;
            color: #172033;
        }

        .progress {
            width: 100%;
            height: 6px;
            background: #eef0f3;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            background: #f58220;
        }

        .progress-blue {
            background: #4778d9;
        }

        .progress-green {
            background: #3c9a69;
        }

        .progress-gray {
            background: #8a93a3;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 10px 8px;
            border-bottom: 1px solid #e7e9ed;
            color: #8a93a3;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 600;
        }

        td {
            padding: 13px 8px;
            border-bottom: 1px solid #f0f1f3;
            font-size: 11px;
            color: #4b5565;
        }

        td:first-child {
            color: #172033;
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 5px;
            font-size: 9px;
            font-weight: 600;
        }

        .badge-orange {
            background: #fff2e8;
            color: #d9650b;
        }

        .badge-blue {
            background: #edf3ff;
            color: #416dc0;
        }

        .badge-green {
            background: #edf8f2;
            color: #32815a;
        }


        /* =====================================================
           DESTINATIONS
        ===================================================== */

        .destination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 0;
            border-bottom: 1px solid #f0f1f3;
        }

        .destination-left {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .country-code {
            width: 34px;
            height: 34px;
            border-radius: 7px;
            background: #f4f5f7;
            color: #4b5565;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
        }

        .destination-name {
            font-size: 11px;
            font-weight: 600;
            color: #172033;
        }

        .destination-count {
            font-size: 9px;
            color: #8a93a3;
            margin-top: 3px;
        }

        .destination-percent {
            font-size: 11px;
            font-weight: 700;
            color: #172033;
        }


        /* =====================================================
           APPOINTMENTS
        ===================================================== */

        .appointment {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f1f3;
        }

        .appointment-date {
            width: 42px;
            height: 44px;
            border: 1px solid #e5e7eb;
            border-radius: 7px;
            text-align: center;
            padding-top: 5px;
            flex-shrink: 0;
        }

        .appointment-day {
            display: block;
            font-size: 16px;
            font-weight: 700;
            color: #172033;
        }

        .appointment-month {
            font-size: 8px;
            color: #8a93a3;
            text-transform: uppercase;
        }

        .appointment-info strong {
            display: block;
            font-size: 11px;
            color: #172033;
            margin-bottom: 4px;
        }

        .appointment-info span {
            font-size: 9px;
            color: #8a93a3;
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
                    Administration Portal
                </div>
            </div>

        </div>


        <nav class="nav">


            <div class="nav-section">
                Overview
            </div>

            <a href="#" class="nav-link active">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                </svg>

                <span>Dashboard</span>

            </a>


            <div class="nav-section">
                Management
            </div>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>

                <span>Students</span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                </svg>

                <span>Consultants</span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <path d="M6 2h12v20H6z"/>
                    <path d="M9 6h6"/>
                    <path d="M9 10h6"/>
                    <path d="M9 14h4"/>
                </svg>

                <span>Applications</span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="4" width="18" height="17" rx="2"/>
                    <path d="M16 2v4"/>
                    <path d="M8 2v4"/>
                    <path d="M3 10h18"/>
                </svg>

                <span>Appointments</span>

            </a>


            <div class="nav-section">
                Study Abroad
            </div>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M3 12h18"/>
                    <path d="M12 3c3 3 3 15 0 18"/>
                    <path d="M12 3c-3 3-3 15 0 18"/>
                </svg>

                <span>Countries</span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <path d="M3 21h18"/>
                    <path d="M5 21V8l7-5 7 5v13"/>
                    <path d="M9 21v-6h6v6"/>
                </svg>

                <span>Universities</span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <path d="M3 10l9-6 9 6"/>
                    <path d="M5 10v9h14v-9"/>
                    <path d="M9 19v-5h6v5"/>
                </svg>

                <span>Courses</span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <path d="M12 3v18"/>
                    <path d="M17 7H9.5a3 3 0 0 0 0 6H14.5a3 3 0 0 1 0 6H7"/>
                </svg>

                <span>Scholarships</span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <path d="M5 12l4 4L19 6"/>
                </svg>

                <span>Eligibility Rules</span>

            </a>


            <div class="nav-section">
                CRM & Intelligence
            </div>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <path d="M3 12h18"/>
                    <path d="M5 12a7 7 0 0 1 14 0"/>
                    <path d="M5 12a7 7 0 0 0 14 0"/>
                </svg>

                <span>CRM</span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <path d="M4 19V5"/>
                    <path d="M4 19h17"/>
                    <path d="M7 15l4-5 3 3 5-7"/>
                </svg>

                <span>Reports & Analytics</span>

            </a>


            <div class="nav-section">
                System
            </div>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.5 1.5-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1 1.55V20h-2v-.41a1.7 1.7 0 0 0-1-1.55 1.7 1.7 0 0 0-1.88.34l-.06.06-1.5-1.5.06-.06A1.7 1.7 0 0 0 7.4 15a1.7 1.7 0 0 0-1.55-1H5v-2h.85a1.7 1.7 0 0 0 1.55-1 1.7 1.7 0 0 0-.34-1.88L7 9.06l1.5-1.5.06.06a1.7 1.7 0 0 0 1.88.34 1.7 1.7 0 0 0 1-1.55V6h2v.41a1.7 1.7 0 0 0 1 1.55 1.7 1.7 0 0 0 1.88-.34l.06-.06 1.5 1.5-.06.06a1.7 1.7 0 0 0-.34 1.88 1.7 1.7 0 0 0 1.55 1H20v2h-.41a1.7 1.7 0 0 0-1.55 1z"/>
                </svg>

                <span>Settings</span>

            </a>


            <a href="#" class="nav-link">

                <svg class="nav-icon" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <rect x="4" y="4" width="16" height="16" rx="2"/>
                    <path d="M8 8h8"/>
                    <path d="M8 12h8"/>
                    <path d="M8 16h5"/>
                </svg>

                <span>Audit Logs</span>

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

                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2">
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

                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>
                    </svg>

                    <span class="notification-dot"></span>

                </div>


                <div class="profile">

                    <div class="profile-avatar">
                        A
                    </div>

                    <div>
                        <div class="profile-name">
                            Admin User
                        </div>

                        <div class="profile-role">
                            Administrator
                        </div>
                    </div>

                </div>

            </div>

        </header>



        <!-- =====================================================
             PAGE CONTENT
        ====================================================== -->

        <section class="content">


            <div class="page-header">

                <div>

                    <h1>Dashboard</h1>

                    <p>
                        Overview of INDIC RMC consultancy operations.
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


                <div class="kpi">

                    <div class="kpi-header">

                        <span class="kpi-label">
                            Total Students
                        </span>

                        <div class="kpi-icon">

                            <svg viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.8">
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M2 21a7 7 0 0 1 14 0"/>
                                <path d="M16 4.5a4 4 0 0 1 0 7.5"/>
                                <path d="M18 14a6 6 0 0 1 4 7"/>
                            </svg>

                        </div>

                    </div>

                    <div class="kpi-value">
                        1,248
                    </div>

                    <div class="kpi-footer">
                        <span class="growth">+12.5%</span>
                        compared with last month
                    </div>

                </div>



                <div class="kpi">

                    <div class="kpi-header">

                        <span class="kpi-label">
                            Active Consultants
                        </span>

                        <div class="kpi-icon">

                            <svg viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="7" r="4"/>
                                <path d="M5 21a7 7 0 0 1 14 0"/>
                            </svg>

                        </div>

                    </div>

                    <div class="kpi-value">
                        18
                    </div>

                    <div class="kpi-footer">
                        2 added this month
                    </div>

                </div>



                <div class="kpi">

                    <div class="kpi-header">

                        <span class="kpi-label">
                            Consultancy Requests
                        </span>

                        <div class="kpi-icon">

                            <svg viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.8">
                                <rect x="4" y="3" width="16" height="18" rx="2"/>
                                <path d="M8 7h8"/>
                                <path d="M8 11h8"/>
                                <path d="M8 15h5"/>
                            </svg>

                        </div>

                    </div>

                    <div class="kpi-value">
                        325
                    </div>

                    <div class="kpi-footer">
                        <span class="growth">+8.4%</span>
                        this month
                    </div>

                </div>



                <div class="kpi">

                    <div class="kpi-header">

                        <span class="kpi-label">
                            Upcoming Consultations
                        </span>

                        <div class="kpi-icon">

                            <svg viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="4" width="18" height="17" rx="2"/>
                                <path d="M16 2v4"/>
                                <path d="M8 2v4"/>
                                <path d="M3 10h18"/>
                            </svg>

                        </div>

                    </div>

                    <div class="kpi-value">
                        42
                    </div>

                    <div class="kpi-footer">
                        Scheduled within 7 days
                    </div>

                </div>


            </div>



            <!-- =================================================
                 CHART + STATUS
            ================================================== -->

            <div class="grid-main">


                <div class="panel">

                    <div class="panel-header">

                        <h2 class="panel-title">
                            Student Registrations
                        </h2>

                        <a href="#" class="panel-link">
                            View Report
                        </a>

                    </div>


                    <div class="chart-area">

                        <div class="bar-group">
                            <div class="bar-value" style="height:35%;"></div>
                            <span class="bar-label">Jan</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar-value" style="height:44%;"></div>
                            <span class="bar-label">Feb</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar-value" style="height:53%;"></div>
                            <span class="bar-label">Mar</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar-value" style="height:47%;"></div>
                            <span class="bar-label">Apr</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar-value" style="height:62%;"></div>
                            <span class="bar-label">May</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar-value" style="height:70%;"></div>
                            <span class="bar-label">Jun</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar-value" style="height:78%;"></div>
                            <span class="bar-label">Jul</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar-value" style="height:73%;"></div>
                            <span class="bar-label">Aug</span>
                        </div>

                        <div class="bar-group">
                            <div class="bar-value" style="height:88%;"></div>
                            <span class="bar-label">Sep</span>
                        </div>

                    </div>

                </div>



                <!-- APPLICATION STATUS -->

                <div class="panel">

                    <div class="panel-header">

                        <h2 class="panel-title">
                            Consultancy Requests
                        </h2>

                        <a href="#" class="panel-link">
                            View All
                        </a>

                    </div>


                    <div class="status-item">

                        <div class="status-top">
                            <span class="status-name">Submitted</span>
                            <span class="status-count">78</span>
                        </div>

                        <div class="progress">
                            <div class="progress-fill" style="width:78%;"></div>
                        </div>

                    </div>


                    <div class="status-item">

                        <div class="status-top">
                            <span class="status-name">Under Review</span>
                            <span class="status-count">54</span>
                        </div>

                        <div class="progress">
                            <div class="progress-fill progress-blue"
                                 style="width:60%;"></div>
                        </div>

                    </div>


                    <div class="status-item">

                        <div class="status-top">
                            <span class="status-name">Consultant Assigned</span>
                            <span class="status-count">42</span>
                        </div>

                        <div class="progress">
                            <div class="progress-fill progress-green"
                                 style="width:48%;"></div>
                        </div>

                    </div>


                    <div class="status-item">

                        <div class="status-top">
                            <span class="status-name">Follow-up Required</span>
                            <span class="status-count">25</span>
                        </div>

                        <div class="progress">
                            <div class="progress-fill progress-gray"
                                 style="width:28%;"></div>
                        </div>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 RECENT APPLICATIONS + DESTINATIONS
            ================================================== -->

            <div class="grid-bottom">


                <div class="panel">

                    <div class="panel-header">

                        <h2 class="panel-title">
                            Recent Consultancy Requests
                        </h2>

                        <a href="#" class="panel-link">
                            View All
                        </a>

                    </div>


                    <div class="table-container">

                        <table>

                            <thead>

                                <tr>
                                    <th>Student</th>
                                    <th>Country</th>
                                    <th>Study Program</th>
                                    <th>Status</th>
                                </tr>

                            </thead>


                            <tbody>

                                <tr>

                                    <td>Kasun Perera</td>

                                    <td>Australia</td>

                                    <td>Computer Science</td>

                                    <td>
                                        <span class="badge badge-orange">
                                            Under Review
                                        </span>
                                    </td>

                                </tr>


                                <tr>

                                    <td>Amal Silva</td>

                                    <td>Canada</td>

                                    <td>Information Technology</td>

                                    <td>
                                        <span class="badge badge-blue">
                                            Consultant Assigned
                                        </span>
                                    </td>

                                </tr>


                                <tr>

                                    <td>Nimal Fernando</td>

                                    <td>New Zealand</td>

                                    <td>Software Engineering</td>

                                    <td>
                                        <span class="badge badge-green">
                                            Completed
                                        </span>
                                    </td>

                                </tr>


                                <tr>

                                    <td>Sarah Perera</td>

                                    <td>United Kingdom</td>

                                    <td>Business Management</td>

                                    <td>
                                        <span class="badge badge-orange">
                                            Submitted
                                        </span>
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>



                <!-- DESTINATIONS -->

                <div class="panel">

                    <div class="panel-header">

                        <h2 class="panel-title">
                            Popular Destinations
                        </h2>

                        <a href="#" class="panel-link">
                            Details
                        </a>

                    </div>


                    <div class="destination">

                        <div class="destination-left">

                            <div class="country-code">
                                AU
                            </div>

                            <div>

                                <div class="destination-name">
                                    Australia
                                </div>

                                <div class="destination-count">
                                    420 students
                                </div>

                            </div>

                        </div>

                        <div class="destination-percent">
                            34%
                        </div>

                    </div>


                    <div class="destination">

                        <div class="destination-left">

                            <div class="country-code">
                                CA
                            </div>

                            <div>

                                <div class="destination-name">
                                    Canada
                                </div>

                                <div class="destination-count">
                                    285 students
                                </div>

                            </div>

                        </div>

                        <div class="destination-percent">
                            23%
                        </div>

                    </div>


                    <div class="destination">

                        <div class="destination-left">

                            <div class="country-code">
                                UK
                            </div>

                            <div>

                                <div class="destination-name">
                                    United Kingdom
                                </div>

                                <div class="destination-count">
                                    210 students
                                </div>

                            </div>

                        </div>

                        <div class="destination-percent">
                            17%
                        </div>

                    </div>


                    <div class="destination">

                        <div class="destination-left">

                            <div class="country-code">
                                NZ
                            </div>

                            <div>

                                <div class="destination-name">
                                    New Zealand
                                </div>

                                <div class="destination-count">
                                    145 students
                                </div>

                            </div>

                        </div>

                        <div class="destination-percent">
                            12%
                        </div>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 UPCOMING CONSULTATIONS
            ================================================== -->

            <div class="panel" style="margin-top:18px;">

                <div class="panel-header">

                    <h2 class="panel-title">
                        Upcoming Consultations
                    </h2>

                    <a href="#" class="panel-link">
                        View Calendar
                    </a>

                </div>


                <div class="appointment">

                    <div class="appointment-date">

                        <span class="appointment-day">
                            12
                        </span>

                        <span class="appointment-month">
                            Sep
                        </span>

                    </div>


                    <div class="appointment-info">

                        <strong>
                            Kasun Perera
                        </strong>

                        <span>
                            Australia • 10:00 AM • Online • Consultant: Methuli
                        </span>

                    </div>

                </div>


                <div class="appointment">

                    <div class="appointment-date">

                        <span class="appointment-day">
                            13
                        </span>

                        <span class="appointment-month">
                            Sep
                        </span>

                    </div>


                    <div class="appointment-info">

                        <strong>
                            Amal Silva
                        </strong>

                        <span>
                            Canada • 11:30 AM • Online • Consultant: Nethara
                        </span>

                    </div>

                </div>


                <div class="appointment">

                    <div class="appointment-date">

                        <span class="appointment-day">
                            15
                        </span>

                        <span class="appointment-month">
                            Sep
                        </span>

                    </div>


                    <div class="appointment-info">

                        <strong>
                            Sarah Perera
                        </strong>

                        <span>
                            United Kingdom • 02:00 PM • Physical • Consultant: Rukshan
                        </span>

                    </div>

                </div>

            </div>


        </section>

    </main>

</div>


</body>
</html>