<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Application Details | INDIC RMC</title>

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
            max-width: 1100px;
            margin: 0 auto;
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
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

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-secondary {
            background: #172033;
            color: white;
        }

        .btn-secondary:hover {
            background: #263550;
        }

        .btn-primary {
            background: #f97316;
            color: white;
        }

        .btn-primary:hover {
            background: #e96b0d;
        }

        .btn-update {
            background: #198754;
            color: white;
        }

        .btn-update:hover {
            background: #157347;
        }

        .card {
            background: white;
            border: 1px solid #e2e6ec;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f4;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .card-header h2 {
            font-size: 17px;
        }

        .card-body {
            padding: 25px 20px;
        }

        .summary {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
        }

        .summary-item {
            background: #f8fafc;
            border: 1px solid #e2e6ec;
            border-radius: 8px;
            padding: 16px;
        }

        .label {
            display: block;
            color: #8a94a6;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .value {
            color: #172033;
            font-size: 14px;
            font-weight: 600;
        }

        .reference {
            font-size: 16px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
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

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 30px;
        }

        .detail {
            padding-bottom: 15px;
            border-bottom: 1px solid #edf0f4;
        }

        .detail:last-child {
            border-bottom: none;
        }

        .student-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .student-email {
            color: #718096;
            font-size: 13px;
        }

        .message-box {
            background: #f8fafc;
            border: 1px solid #e2e6ec;
            border-radius: 8px;
            padding: 18px;
            color: #4a5568;
            font-size: 13px;
            line-height: 1.7;
            white-space: pre-wrap;
        }

        .empty-message {
            color: #8a94a6;
            font-style: italic;
        }

        .bottom-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .info-note {
            color: #718096;
            font-size: 12px;
        }

        /* SUCCESS / ERROR MESSAGES */

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .alert-success {
            background: #e7f7ed;
            border: 1px solid #b8e6c8;
            color: #198754;
        }

        .alert-error {
            background: #fde8e8;
            border: 1px solid #f2b8b8;
            color: #c62828;
        }

        /* STATUS UPDATE FORM */

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            color: #172033;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d9dee7;
            border-radius: 7px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: #172033;
            background: white;
            outline: none;
        }

        .form-control:focus {
            border-color: #f97316;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-error {
            margin-top: 6px;
            color: #c62828;
            font-size: 11px;
        }

        .form-actions {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        /* STATUS HISTORY */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        .history-table th {
            background: #f8fafc;
            color: #718096;
            font-size: 11px;
            text-transform: uppercase;
            text-align: left;
            padding: 13px 12px;
            border-bottom: 1px solid #e2e6ec;
        }

        .history-table td {
            padding: 14px 12px;
            font-size: 12px;
            color: #4a5568;
            border-bottom: 1px solid #edf0f4;
            vertical-align: top;
        }

        .history-table tr:last-child td {
            border-bottom: none;
        }

        .history-date {
            white-space: nowrap;
            color: #718096;
        }

        .remarks {
            max-width: 250px;
            line-height: 1.5;
        }

        .no-history {
            color: #8a94a6;
            font-size: 13px;
            font-style: italic;
            text-align: center;
            padding: 20px;
        }

        @media (max-width: 800px) {

            .container {
                padding: 18px;
            }

            .page-header {
                flex-direction: column;
            }

            .summary {
                grid-template-columns: 1fr;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .bottom-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .bottom-actions .btn {
                text-align: center;
            }

            .form-actions {
                justify-content: stretch;
            }

            .form-actions .btn {
                width: 100%;
            }
        }

        @media (max-width: 750px) {

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


    <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h1>Application Details</h1>

            <p>
                Review the complete student application information.
            </p>

        </div>

        <a
            href="{{ route('admin.applications-list') }}"
            class="btn btn-secondary"
        >
            ← All Applications
        </a>

    </div>


    <!-- SUCCESS MESSAGE -->

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <!-- ERROR MESSAGE -->

    @if(session('error'))

        <div class="alert alert-error">
            {{ session('error') }}
        </div>

    @endif


    <!-- APPLICATION SUMMARY -->

    <div class="card">

        <div class="card-header">

            <h2>Application Summary</h2>

            @php

                $status =
                    $application->application_status
                    ?? 'Unknown';

                $statusClass = match(
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

            <span class="status {{ $statusClass }}">
                {{ $status }}
            </span>

        </div>


        <div class="card-body">

            <div class="summary">


                <!-- REFERENCE -->

                <div class="summary-item">

                    <span class="label">
                        Application Reference
                    </span>

                    <span class="value reference">
                        {{ $application->application_reference ?? '-' }}
                    </span>

                </div>


                <!-- APPLICATION TYPE -->

                <div class="summary-item">

                    <span class="label">
                        Application Type
                    </span>

                    <span class="value">
                        {{ $application->application_type ?? '-' }}
                    </span>

                </div>


                <!-- SUBMITTED -->

                <div class="summary-item">

                    <span class="label">
                        Submitted Date
                    </span>

                    <span class="value">

                        @if($application->submitted_at)

                            {{ $application->submitted_at->format('d M Y, h:i A') }}

                        @else

                            -

                        @endif

                    </span>

                </div>


            </div>

        </div>

    </div>


    <!-- UPDATE APPLICATION STATUS -->

    <div class="card">

        <div class="card-header">

            <h2>Update Application Status</h2>

        </div>


        <div class="card-body">

            <form
                action="{{ route('admin.applications-status', $application) }}"
                method="POST"
            >

                @csrf

                @method('PATCH')


                <div class="form-grid">


                    <!-- STATUS -->

                    <div class="form-group">

                        <label
                            for="application_status"
                            class="form-label"
                        >
                            New Status
                        </label>

                        <select
                            name="application_status"
                            id="application_status"
                            class="form-control"
                            required
                        >

                            @foreach(\App\Models\Application::STATUSES as $status)
                                <option
                                    value="{{ $status }}"
                                    {{ old('application_status', $application->application_status) === $status ? 'selected' : '' }}
                                >
                                    {{ $status }}
                                </option>
                            @endforeach

                        </select>


                        @error('application_status')

                            <div class="form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- REMARKS -->

                    <div class="form-group">

                        <label
                            for="remarks"
                            class="form-label"
                        >
                            Remarks
                        </label>

                        <textarea
                            name="remarks"
                            id="remarks"
                            class="form-control"
                            placeholder="Enter remarks about this status change..."
                        >{{ old('remarks') }}</textarea>


                        @error('remarks')

                            <div class="form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>


                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-update"
                    >
                        Update Status
                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- STUDENT INFORMATION -->

    <div class="card">

        <div class="card-header">

            <h2>Student Information</h2>

        </div>

        <div class="card-body">

            @if($application->student && $application->student->user)

                <div class="student-name">

                    {{ $application->student->user->first_name }}
                    {{ $application->student->user->last_name }}

                </div>

                <div class="student-email">

                    {{ $application->student->user->email }}

                </div>

            @else

                <div class="empty-message">
                    Student information is not available.
                </div>

            @endif

        </div>

    </div>


    <!-- STUDY PREFERENCES -->

    <div class="card">

        <div class="card-header">

            <h2>Study Preferences</h2>

        </div>

        <div class="card-body">

            <div class="details-grid">


                <!-- COUNTRY -->

                <div class="detail">

                    <span class="label">
                        Preferred Country
                    </span>

                    <span class="value">

                        {{ $application->preferredCountry->country_name ?? '-' }}

                    </span>

                </div>


                <!-- COURSE -->

                <div class="detail">

                    <span class="label">
                        Preferred Course
                    </span>

                    <span class="value">

                        {{ $application->preferredCourse->course_name ?? '-' }}

                    </span>

                </div>


                <!-- UNIVERSITY -->

                <div class="detail">

                    <span class="label">
                        University
                    </span>

                    <span class="value">

                        @if(
                            $application->preferredCourse &&
                            $application->preferredCourse->university
                        )

                            {{ $application->preferredCourse->university->university_name }}

                        @else

                            -

                        @endif

                    </span>

                </div>


                <!-- INTAKE -->

                <div class="detail">

                    <span class="label">
                        Preferred Intake
                    </span>

                    <span class="value">

                        @if($application->preferredIntake)

                            {{ $application->preferredIntake->intake_name ?? '-' }}

                        @else

                            -

                        @endif

                    </span>

                </div>


            </div>

        </div>

    </div>


    <!-- STUDENT MESSAGE -->

    <div class="card">

        <div class="card-header">

            <h2>Student Message</h2>

        </div>

        <div class="card-body">

            @if($application->student_message)

                <div class="message-box">

                    {{ $application->student_message }}

                </div>

            @else

                <div class="message-box empty-message">

                    No additional message was provided by the student.

                </div>

            @endif

        </div>

    </div>


    <!-- APPLICATION STATUS HISTORY -->

    <div class="card">

        <div class="card-header">

            <h2>Application Progress History</h2>

        </div>

        <div class="card-body">

            @if($application->statusHistory->count() > 0)

                <div class="table-wrapper">

                    <table class="history-table">

                        <thead>

                            <tr>

                                <th>
                                    Old Status
                                </th>

                                <th>
                                    New Status
                                </th>

                                <th>
                                    Changed By
                                </th>

                                <th>
                                    Remarks
                                </th>

                                <th>
                                    Date & Time
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($application->statusHistory as $history)

                                <tr>

                                    <td>

                                        @if($history->old_status)

                                            {{ $history->old_status }}

                                        @else

                                            -

                                        @endif

                                    </td>


                                    <td>

                                        <strong>
                                            {{ $history->new_status }}
                                        </strong>

                                    </td>


                                    <td>

                                        @if($history->changedBy)

                                            {{ $history->changedBy->first_name }}
                                            {{ $history->changedBy->last_name }}

                                        @else

                                            System

                                        @endif

                                    </td>


                                    <td class="remarks">

                                        @if($history->remarks)

                                            {{ $history->remarks }}

                                        @else

                                            -

                                        @endif

                                    </td>


                                    <td class="history-date">

                                        @if($history->changed_at)

                                            {{ $history->changed_at->format('d M Y, h:i A') }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="no-history">

                    No status changes have been recorded yet.

                </div>

            @endif

        </div>

    </div>


    <!-- ACTIONS -->

    <div class="card">

        <div class="card-body">

            <div class="bottom-actions">

                <span class="info-note">

                    Application ID:
                    {{ $application->application_id }}

                </span>

                <a
                    href="{{ route('admin.applications-list') }}"
                    class="btn btn-primary"
                >
                    ← Back to Applications
                </a>

            </div>

        </div>

    </div>


</div>

    </section>

</main>

</body>
</html>