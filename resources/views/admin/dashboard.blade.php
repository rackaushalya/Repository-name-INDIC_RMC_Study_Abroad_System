<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | INDIC RMC</title>

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

            border-bottom: 1px solid #e5e7eb;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 28px;
        }


        .search-box {

            width: 315px;

            position: relative;
        }


        .search-box input {

            width: 100%;

            padding: 11px 15px 11px 40px;

            border: 1px solid #dce1e8;

            border-radius: 7px;

            outline: none;
        }


        .search-box input:focus {

            border-color: #f97316;
        }


        .search-icon {

            position: absolute;

            left: 14px;

            top: 10px;

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
        }


        .page-header h1 {

            font-size: 27px;

            margin-bottom: 6px;
        }


        .page-header p {

            color: #718096;

            font-size: 14px;
        }


        .date-box {

            padding: 10px 15px;

            background: white;

            border: 1px solid #e0e5ec;

            border-radius: 7px;

            font-size: 13px;

            color: #596579;
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


        .stat-icon.orange {
            background: #fff1e8;
            color: #f97316;
        }


        .stat-icon.blue {
            background: #eaf3ff;
            color: #2878df;
        }


        .stat-icon.green {
            background: #eafaf0;
            color: #22a35a;
        }


        .stat-icon.purple {
            background: #f2ecff;
            color: #7c3aed;
        }


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
           DASHBOARD GRID
        ====================================== */

        .dashboard-grid {

            display: grid;

            grid-template-columns: 2fr 1fr;

            gap: 20px;

            margin-bottom: 20px;
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

            font-size: 16px;
        }


        .card-header a {

            color: #f97316;

            font-size: 12px;

            font-weight: bold;
        }


        .card-header a:hover {

            text-decoration: underline;
        }


        .card-body {

            padding: 20px;
        }


        /* =====================================
           TABLE
        ====================================== */

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


        /* =====================================
           STATUS
        ====================================== */

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


        .status-warning {

            background: #fff3df;

            color: #c46b00;
        }


        .status-danger {

            background: #fde8e8;

            color: #c62828;
        }


        .status-info {

            background: #e8f1ff;

            color: #2767b1;
        }


        .empty {

            text-align: center;

            padding: 35px;

            color: #8a94a6;
        }


        /* =====================================
           APPOINTMENTS
        ====================================== */

        .appointment {

            padding: 14px 0;

            border-bottom: 1px solid #edf0f4;
        }


        .appointment:last-child {

            border-bottom: none;
        }


        .appointment-name {

            font-weight: bold;

            font-size: 13px;
        }


        .appointment-details {

            margin-top: 5px;

            font-size: 12px;

            color: #7b8798;
        }


        /* =====================================
           QUICK ACTIONS
        ====================================== */

        .quick-actions {

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 12px;
        }


        .quick-action {

            border: 1px solid #e5e7eb;

            border-radius: 8px;

            padding: 16px;

            transition: 0.2s;
        }


        .quick-action:hover {

            border-color: #f97316;

            background: #fff7f1;
        }


        .quick-action strong {

            display: block;

            margin-bottom: 5px;

            font-size: 14px;
        }


        .quick-action span {

            color: #7b8798;

            font-size: 11px;
        }


        /* =====================================
           RESPONSIVE
        ====================================== */

        @media (max-width: 1100px) {

            .stats-grid {

                grid-template-columns: repeat(2, 1fr);
            }


            .dashboard-grid {

                grid-template-columns: 1fr;
            }


            .quick-actions {

                grid-template-columns: repeat(2, 1fr);
            }
        }


        @media (max-width: 750px) {


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


            .quick-actions {

                grid-template-columns: 1fr;
            }
        }

    </style>

@include('components.sidebar-style')
</head>


<body>


<!-- =====================================
     SIDEBAR
====================================== -->

@include('components.admin-sidebar')



<!-- =====================================
     MAIN
====================================== -->

<main class="main">


    <!-- =================================
         TOP BAR
    ================================== -->

    <header class="topbar">


        <!-- SEARCH -->

        <div class="search-box">

            <span class="search-icon"><i class="bi bi-search"></i></span>


            <input
                type="text"
                placeholder="Search students, applications..."
            >

        </div>



        <!-- ADMIN PROFILE -->

        <div class="admin-profile">


            <div class="profile-circle">

                {{ strtoupper(
                    substr(
                        auth()->user()->first_name ?? 'A',
                        0,
                        1
                    )
                ) }}

            </div>


            <div class="profile-info">

                <strong>

                    {{ auth()->user()->first_name ?? 'Admin' }}

                    {{ auth()->user()->last_name ?? 'User' }}

                </strong>


                <span>
                    Administrator
                </span>

            </div>

        </div>


    </header>



    <!-- =================================
         CONTENT
    ================================== -->

    <section class="content">


        <!-- PAGE HEADER -->

        <div class="page-header">


            <div>

                <h1>
                    Admin Dashboard
                </h1>


                <p>
                    Overview of INDIC RMC system activity.
                </p>

            </div>


            <div class="date-box">

                {{ now()->format('d F Y') }}

            </div>


        </div>



        <!-- =================================
             FIRST STAT ROW
        ================================== -->

        <div class="stats-grid">


            <!-- TOTAL USERS -->

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Total Users
                    </span>


                    <div class="stat-icon orange">
                        <i class="bi bi-people-fill"></i>
                    </div>

                </div>


                <div class="stat-value">

                    {{ $stats['total_users'] ?? 0 }}

                </div>


                <div class="stat-description">

                    Registered system users

                </div>

            </div>



            <!-- TOTAL STUDENTS -->

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Total Students
                    </span>


                    <div class="stat-icon blue">
                        <i class="bi bi-person-fill"></i>
                    </div>

                </div>


                <div class="stat-value">

                    {{ $stats['total_students'] ?? 0 }}

                </div>


                <div class="stat-description">

                    Registered students

                </div>

            </div>



            <!-- CONSULTANTS -->

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Total Consultants
                    </span>


                    <div class="stat-icon green">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>

                </div>


                <div class="stat-value">

                    {{ $stats['total_consultants'] ?? 0 }}

                </div>


                <div class="stat-description">

                    Registered consultants

                </div>

            </div>



            <!-- APPLICATIONS -->

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Applications
                    </span>


                    <div class="stat-icon purple">
                        <i class="bi bi-file-earmark-text-fill"></i>
                    </div>

                </div>


                <div class="stat-value">

                    {{ $stats['total_applications'] ?? 0 }}

                </div>


                <div class="stat-description">

                    Student applications

                </div>

            </div>


        </div>



        <!-- =================================
             SECOND STAT ROW
        ================================== -->

        <div class="stats-grid">


            <!-- COUNTRIES -->

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Active Countries
                    </span>


                    <div class="stat-icon orange">
                        <i class="bi bi-globe-americas"></i>
                    </div>

                </div>


                <div class="stat-value">

                    {{ $stats['total_countries'] ?? 0 }}

                </div>


                <div class="stat-description">

                    Available destinations

                </div>

            </div>



            <!-- UNIVERSITIES -->

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Universities
                    </span>


                    <div class="stat-icon blue">
                        <i class="bi bi-bank"></i>
                    </div>

                </div>


                <div class="stat-value">

                    {{ $stats['total_universities'] ?? 0 }}

                </div>


                <div class="stat-description">

                    Active universities

                </div>

            </div>



            <!-- COURSES -->

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Courses
                    </span>


                    <div class="stat-icon green">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>

                </div>


                <div class="stat-value">

                    {{ $stats['total_courses'] ?? 0 }}

                </div>


                <div class="stat-description">

                    Active courses

                </div>

            </div>



            <!-- APPOINTMENTS -->

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Appointments
                    </span>


                    <div class="stat-icon purple">
                        <i class="bi bi-calendar2-check-fill"></i>
                    </div>

                </div>


                <div class="stat-value">

                    {{ $stats['total_appointments'] ?? 0 }}

                </div>


                <div class="stat-description">

                    Total appointments

                </div>

            </div>


        </div>



        <!-- =================================
             APPLICATIONS + APPOINTMENTS
        ================================== -->

        <div class="dashboard-grid">


            <!-- =================================
                 RECENT APPLICATIONS
            ================================== -->

            <div class="card">


                <div class="card-header">

                    <h2>
                        Recent Applications
                    </h2>


                    <a href="{{ route('admin.applications-list') }}">
                        View All
                    </a>

                </div>



                <div class="table-wrapper">

                    <table>


                        <thead>

                            <tr>

                                <th>
                                    Student
                                </th>

                                <th>
                                    Application
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Submitted
                                </th>

                            </tr>

                        </thead>



                        <tbody>


                            @forelse($recentApplications as $application)


                                <tr>


                                    <!-- STUDENT -->

                                    <td>

                                        @if(
                                            $application->student &&
                                            $application->student->user
                                        )

                                            {{ $application->student->user->first_name }}

                                            {{ $application->student->user->last_name }}

                                        @else

                                            Unknown Student

                                        @endif

                                    </td>



                                    <!-- APPLICATION ID -->

                                    <td>

                                        #{{ $application->application_id ?? $application->id }}

                                    </td>



                                    <!-- STATUS -->

                                    <td>


                                        @php

                                            $status =
                                                $application->application_status
                                                ?? $application->status
                                                ?? 'Pending';


                                            $statusClass =
                                                match(
                                                    strtolower($status)
                                                ) {

                                                    'approved',
                                                    'completed'
                                                        => 'status-success',

                                                    'rejected',
                                                    'cancelled'
                                                        => 'status-danger',

                                                    'under review',
                                                    'pending'
                                                        => 'status-warning',

                                                    default
                                                        => 'status-info',
                                                };

                                        @endphp


                                        <span class="status {{ $statusClass }}">

                                            {{ $status }}

                                        </span>


                                    </td>



                                    <!-- SUBMITTED DATE -->

                                    <td>


                                        @if($application->submitted_at)

                                            {{ \Carbon\Carbon::parse(
                                                $application->submitted_at
                                            )->format('d M Y') }}

                                        @else

                                            -

                                        @endif


                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td
                                        colspan="4"
                                        class="empty"
                                    >

                                        No applications found.

                                    </td>

                                </tr>


                            @endforelse


                        </tbody>


                    </table>

                </div>


            </div>



            <!-- =================================
                 UPCOMING APPOINTMENTS
            ================================== -->

            <div class="card">


                <div class="card-header">

                    <h2>
                        Upcoming Appointments
                    </h2>


                    <a href="{{ route('admin.appointments-list') }}">
                        View All
                    </a>

                </div>



                <div class="card-body">


                    @forelse(
                        $upcomingAppointments
                        as $appointment
                    )


                        <div class="appointment">


                            <!-- STUDENT NAME -->

                            <div class="appointment-name">


                                @if(
                                    $appointment->student &&
                                    $appointment->student->user
                                )

                                    {{ $appointment->student->user->first_name }}

                                    {{ $appointment->student->user->last_name }}

                                @else

                                    Student

                                @endif


                            </div>



                            <!-- DATE + TIME -->

                            <div class="appointment-details">


                                {{ $appointment->appointment_date

                                    ? \Carbon\Carbon::parse(
                                        $appointment->appointment_date
                                    )->format('d M Y')

                                    : 'Date not available'
                                }}



                                @if($appointment->start_time)

                                    • {{ $appointment->start_time }}

                                @endif


                            </div>



                            <!-- STATUS -->

                            <div style="margin-top: 7px;">


                                @php

                                    $appointmentStatus =
                                        $appointment->appointment_status
                                        ?? 'Pending';


                                    $appointmentClass =
                                        match(
                                            strtolower(
                                                $appointmentStatus
                                            )
                                        ) {

                                            'confirmed'
                                                => 'status-success',

                                            'cancelled',
                                            'rejected'
                                                => 'status-danger',

                                            'requested',
                                            'pending'
                                                => 'status-warning',

                                            default
                                                => 'status-info',
                                        };

                                @endphp


                                <span
                                    class="status {{ $appointmentClass }}"
                                >

                                    {{ $appointmentStatus }}

                                </span>


                            </div>


                        </div>


                    @empty


                        <div class="empty">

                            No upcoming appointments.

                        </div>


                    @endforelse


                </div>


            </div>


        </div>



        <!-- =================================
             QUICK ACTIONS
        ================================== -->

        <div class="card">


            <div class="card-header">

                <h2>
                    Quick Actions
                </h2>

            </div>



            <div class="card-body">


                <div class="quick-actions">


                    <!-- USER MANAGEMENT -->

                    <a
                        href="{{ route('admin.users') }}"
                        class="quick-action"
                    >

                        <strong>
                            User Management
                        </strong>

                        <span>
                            Manage users, roles and account status
                        </span>

                    </a>



                    <!-- STUDENTS -->

                    <a
                        href="{{ route('admin.students') }}"
                        class="quick-action"
                    >

                        <strong>
                            Students
                        </strong>

                        <span>
                            View registered students
                        </span>

                    </a>



                    <!-- CONSULTANTS -->

                    <a
                        href="{{ route('admin.consultants') }}"
                        class="quick-action"
                    >

                        <strong>
                            Consultants
                        </strong>

                        <span>
                            Manage consultants
                        </span>

                    </a>



                    <!-- APPLICATIONS -->

                    <a
                        href="{{ route('admin.applications-list') }}"
                        class="quick-action"
                    >

                        <strong>
                            Applications
                        </strong>

                        <span>
                            Review student applications
                        </span>

                    </a>



                    <!-- APPOINTMENTS -->

                    <a
                        href="{{ route('admin.appointments-list') }}"
                        class="quick-action"
                    >

                        <strong>
                            Appointments
                        </strong>

                        <span>
                            View and manage appointments
                        </span>

                    </a>



                    <!-- COUNTRIES -->

                    <a
                        href="{{ route('admin.countries-list') }}"
                        class="quick-action"
                    >

                        <strong>
                            Countries
                        </strong>

                        <span>
                            Manage study destinations
                        </span>

                    </a>



                    <!-- UNIVERSITIES -->

                    <a
                        href="{{ route('admin.universities-list') }}"
                        class="quick-action"
                    >

                        <strong>
                            Universities
                        </strong>

                        <span>
                            Manage universities
                        </span>

                    </a>



                    <!-- COURSES -->

                    <a
                        href="{{ route('admin.courses-list') }}"
                        class="quick-action"
                    >

                        <strong>
                            Courses
                        </strong>

                        <span>
                            Manage available courses
                        </span>

                    </a>


                </div>


            </div>


        </div>


    </section>


</main>


</body>

</html>