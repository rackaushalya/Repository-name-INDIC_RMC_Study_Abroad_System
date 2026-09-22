<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Applications | INDIC RMC</title>

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

        .container {
            padding: 30px;
        }


        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }


        .page-header h1 {
            font-size: 28px;
            margin-bottom: 7px;
        }


        .page-header p {
            color: #718096;
            font-size: 14px;
        }


        .back-btn {
            background: #172033;
            color: white;
            padding: 10px 16px;
            border-radius: 7px;
            font-size: 13px;
        }


        .back-btn:hover {
            background: #263550;
        }


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
            font-size: 17px;
        }


        .total {
            color: #718096;
            font-size: 13px;
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
            padding: 14px 18px;
            background: #f8fafc;
            color: #68758a;
            font-size: 11px;
            text-transform: uppercase;
            white-space: nowrap;
        }


        td {
            padding: 15px 18px;
            border-top: 1px solid #edf0f4;
            font-size: 13px;
            vertical-align: middle;
        }


        tr:hover td {
            background: #fafafa;
        }


        .reference {
            font-weight: bold;
            color: #172033;
        }


        .student-name {
            font-weight: 600;
        }


        .email {
            display: block;
            margin-top: 4px;
            color: #8a94a6;
            font-size: 11px;
        }


        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: bold;
        }


        .status-submitted {
            background: #e8f1ff;
            color: #2767b1;
        }


        .status-review {
            background: #fff3df;
            color: #c46b00;
        }


        .status-approved {
            background: #e7f7ed;
            color: #198754;
        }


        .status-rejected {
            background: #fde8e8;
            color: #c62828;
        }


        .status-cancelled {
            background: #eeeeee;
            color: #666666;
        }


        .status-default {
            background: #f0f2f5;
            color: #596579;
        }


        .view-btn {
            display: inline-block;
            padding: 7px 11px;
            border: 1px solid #f97316;
            color: #f97316;
            border-radius: 6px;
            font-size: 11px;
            font-weight: bold;
        }


        .view-btn:hover {
            background: #f97316;
            color: white;
        }


        .empty {
            text-align: center;
            padding: 50px 20px;
            color: #8a94a6;
        }


        .pagination {
            padding: 18px 20px;
            border-top: 1px solid #edf0f4;
        }


        @media (max-width: 900px) {

            .container {
                padding: 18px;
            }


            .page-header {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }


            th,
            td {
                padding: 12px;
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

            .content {
                padding: 15px;
            }

            .topbar {
                padding: 0 15px;
            }

            .search-box {
                width: 200px;
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

        <a href="{{ route('admin.students') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-person-fill"></i></span>
            <span>Students</span>
        </a>

        <a href="{{ route('admin.consultants') }}" class="menu-item">
            <span class="menu-icon"><i class="bi bi-person-badge-fill"></i></span>
            <span>Consultants</span>
        </a>

        <a href="{{ route('admin.applications-list') }}" class="menu-item active">
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

<div class="container">


    <!-- ==============================
         PAGE HEADER
    =============================== -->

    <div class="page-header">

        <div>

            <h1>
                Application Management
            </h1>

            <p>
                View and manage student consultancy applications.
            </p>

        </div>


        <a
            href="{{ route('admin.dashboard') }}"
            class="back-btn"
        >
            ← Dashboard
        </a>

    </div>



    <!-- ==============================
         APPLICATIONS CARD
    =============================== -->

    <div class="card">


        <div class="card-header">

            <h2>
                All Applications
            </h2>


            <span class="total">

                Total:
                {{ $applications->total() }}

            </span>

        </div>



        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Reference
                        </th>

                        <th>
                            Student
                        </th>

                        <th>
                            Type
                        </th>

                        <th>
                            Country
                        </th>

                        <th>
                            Course
                        </th>

                        <th>
                            Intake
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Submitted
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>


                    @forelse($applications as $application)


                        <tr>


                            <!-- REFERENCE -->

                            <td>

                                <span class="reference">

                                    {{ $application->application_reference ?? '-' }}

                                </span>

                            </td>



                            <!-- STUDENT -->

                            <td>

                                @if(
                                    $application->student &&
                                    $application->student->user
                                )

                                    <span class="student-name">

                                        {{ $application->student->user->first_name }}

                                        {{ $application->student->user->last_name }}

                                    </span>


                                    <span class="email">

                                        {{ $application->student->user->email }}

                                    </span>

                                @else

                                    <span class="student-name">
                                        Unknown Student
                                    </span>

                                @endif

                            </td>



                            <!-- APPLICATION TYPE -->

                            <td>

                                {{ $application->application_type ?? '-' }}

                            </td>



                            <!-- COUNTRY -->

                            <td>

                                {{ $application->preferredCountry->country_name ?? '-' }}

                            </td>



                            <!-- COURSE -->

                            <td>

                                {{ $application->preferredCourse->course_name ?? '-' }}

                            </td>



                            <!-- INTAKE -->

                            <td>

                                @if($application->preferredIntake)

                                    {{ $application->preferredIntake->intake_name ?? '-' }}

                                @else

                                    -

                                @endif

                            </td>



                            <!-- STATUS -->

                            <td>


                                @php

                                    $status =
                                        $application->application_status
                                        ?? 'Unknown';


                                    $statusClass =
                                        match(
                                            strtolower($status)
                                        ) {

                                            'submitted'
                                                => 'status-submitted',

                                            'under review',
                                            'in review'
                                                => 'status-review',

                                            'approved',
                                            'accepted',
                                            'completed',
                                            'enrolled'
                                                => 'status-approved',

                                            'rejected'
                                                => 'status-rejected',

                                            'cancelled',
                                            'canceled'
                                                => 'status-cancelled',

                                            default
                                                => 'status-default',

                                        };

                                @endphp


                                <span
                                    class="status {{ $statusClass }}"
                                >

                                    {{ $status }}

                                </span>


                            </td>



                            <!-- SUBMITTED -->

                            <td>

                                @if($application->submitted_at)

                                    {{ $application->submitted_at->format('d M Y') }}

                                @else

                                    -

                                @endif

                            </td>



                            <!-- VIEW -->

                            <td>

                                <a
                                    href="{{ route('admin.applications-show', $application) }}"
                                    class="view-btn"
                                >
                                    View
                                </a>

                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td
                                colspan="9"
                                class="empty"
                            >

                                No applications found.

                            </td>

                        </tr>


                    @endforelse


                </tbody>

            </table>

        </div>



        <!-- PAGINATION -->

        @if($applications->hasPages())

            <div class="pagination">

                {{ $applications->links() }}

            </div>

        @endif


    </div>


</div>

    </section>

</main>

</body>

</html>