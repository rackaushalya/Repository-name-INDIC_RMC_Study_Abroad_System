<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Application Details | INDIC RMC</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6fa;
            color: #17233c;
        }

        a {
            text-decoration: none;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 35px 20px;
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

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
        }

        .btn-primary {
            background: #ff7a18;
            color: white;
        }

        .btn-primary:hover {
            background: #e96b0d;
        }

        .btn-secondary {
            background: #17233c;
            color: white;
        }

        .btn-secondary:hover {
            background: #263550;
        }

        .btn-danger {
            background: #c62828;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-danger:hover {
            background: #a91f1f;
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
        }

        .card-header h2 {
            font-size: 17px;
        }

        .card-body {
            padding: 25px 20px;
        }

        .reference-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e2e6ec;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .reference-label {
            color: #718096;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .reference {
            font-size: 18px;
            font-weight: bold;
            color: #17233c;
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
            gap: 22px 30px;
        }

        .detail-item {
            padding-bottom: 15px;
            border-bottom: 1px solid #edf0f4;
        }

        .detail-label {
            display: block;
            color: #8a94a6;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .detail-value {
            color: #17233c;
            font-size: 14px;
            font-weight: 600;
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

        .no-message {
            color: #8a94a6;
            font-style: italic;
        }

        .bottom-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .left-actions,
        .right-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        form {
            margin: 0;
        }

        .success-message {
            background: #e7f7ed;
            color: #198754;
            border: 1px solid #b9e4c8;
            padding: 12px 15px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* --------------------------------------------------
           APPLICATION PROGRESS
        -------------------------------------------------- */

        .progress-summary {
            background: #f8fafc;
            border: 1px solid #e2e6ec;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 20px;
        }

        .progress-summary-label {
            display: block;
            color: #8a94a6;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .progress-summary-status {
            font-size: 15px;
            font-weight: bold;
        }

        .progress-list {
            position: relative;
            margin-top: 10px;
        }

        .progress-item {
            position: relative;
            display: grid;
            grid-template-columns: 25px 1fr;
            column-gap: 15px;
            padding-bottom: 25px;
        }

        .progress-item:last-child {
            padding-bottom: 0;
        }

        .progress-item::before {
            content: "";
            position: absolute;
            left: 11px;
            top: 22px;
            bottom: 0;
            width: 2px;
            background: #e2e6ec;
        }

        .progress-item:last-child::before {
            display: none;
        }

        .progress-dot {
            width: 23px;
            height: 23px;
            border-radius: 50%;
            background: #17233c;
            border: 4px solid #e8ebf0;
            position: relative;
            z-index: 1;
        }

        .progress-content {
            background: #f8fafc;
            border: 1px solid #e2e6ec;
            border-radius: 8px;
            padding: 15px;
        }

        .progress-change {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 9px;
        }

        .progress-old {
            color: #718096;
            font-size: 12px;
        }

        .progress-arrow {
            color: #8a94a6;
            font-size: 12px;
        }

        .progress-new {
            color: #17233c;
            font-size: 13px;
            font-weight: bold;
        }

        .progress-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 10px;
        }

        .progress-meta-item {
            font-size: 11px;
            color: #718096;
        }

        .progress-meta-label {
            display: block;
            color: #9aa3b2;
            text-transform: uppercase;
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .progress-remarks {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #e2e6ec;
            color: #4a5568;
            font-size: 12px;
            line-height: 1.6;
        }

        .progress-remarks-label {
            display: block;
            color: #9aa3b2;
            text-transform: uppercase;
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .no-progress {
            color: #8a94a6;
            font-size: 13px;
            font-style: italic;
        }


        @media (max-width: 700px) {

            .container {
                padding: 20px 15px;
            }

            .page-header {
                flex-direction: column;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn {
                flex: 1;
                text-align: center;
            }

            .details-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .reference-box {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .bottom-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .left-actions,
            .right-actions {
                width: 100%;
            }

            .left-actions .btn,
            .right-actions .btn {
                flex: 1;
                text-align: center;
            }

            .progress-meta {
                grid-template-columns: 1fr;
            }

        }

    </style>
@include('components.sidebar-style')
</head>

<body>

@include('components.student-sidebar')

<div class="main">

<div class="container">


    <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h1>Application Details</h1>

            <p>
                View the details of your study abroad application.
            </p>

        </div>


        <div class="header-actions">

            <a
                href="{{ route('student.applications.index') }}"
                class="btn btn-secondary"
            >
                ← My Applications
            </a>

        </div>

    </div>


    <!-- SUCCESS MESSAGE -->

    @if(session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif


    <!-- APPLICATION SUMMARY -->

    <div class="card">

        <div class="card-body">

            <div class="reference-box">

                <div>

                    <div class="reference-label">
                        APPLICATION REFERENCE
                    </div>

                    <div class="reference">
                        {{ $application->application_reference ?? '-' }}
                    </div>

                </div>


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


            <!-- APPLICATION DETAILS -->

            <div class="details-grid">


                <!-- APPLICATION TYPE -->

                <div class="detail-item">

                    <span class="detail-label">
                        Application Type
                    </span>

                    <span class="detail-value">

                        {{ $application->application_type ?? '-' }}

                    </span>

                </div>


                <!-- COUNTRY -->

                <div class="detail-item">

                    <span class="detail-label">
                        Preferred Country
                    </span>

                    <span class="detail-value">

                        {{ $application->preferredCountry->country_name ?? '-' }}

                    </span>

                </div>


                <!-- COURSE -->

                <div class="detail-item">

                    <span class="detail-label">
                        Preferred Course
                    </span>

                    <span class="detail-value">

                        {{ $application->preferredCourse->course_name ?? '-' }}

                    </span>

                </div>


                <!-- UNIVERSITY -->

                <div class="detail-item">

                    <span class="detail-label">
                        University
                    </span>

                    <span class="detail-value">

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

                <div class="detail-item">

                    <span class="detail-label">
                        Preferred Intake
                    </span>

                    <span class="detail-value">

                        @if($application->preferredIntake)

                            {{ $application->preferredIntake->intake_name ?? '-' }}

                        @else

                            -

                        @endif

                    </span>

                </div>


                <!-- SUBMITTED DATE -->

                <div class="detail-item">

                    <span class="detail-label">
                        Submitted Date
                    </span>

                    <span class="detail-value">

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


    <!-- APPLICATION PROGRESS -->

    <div class="card">

        <div class="card-header">

            <h2>
                Application Progress
            </h2>

        </div>


        <div class="card-body">


            <!-- CURRENT STATUS -->

            <div class="progress-summary">

                <span class="progress-summary-label">
                    Current Application Status
                </span>

                <span class="progress-summary-status">

                    <span class="status {{ $statusClass }}">
                        {{ $status }}
                    </span>

                </span>

            </div>


            <!-- STATUS HISTORY -->

            @if(
                isset($application->statusHistory) &&
                $application->statusHistory->count() > 0
            )

                <div class="progress-list">

                    @foreach(
                        $application->statusHistory->sortBy('changed_at')
                        as $history
                    )

                        <div class="progress-item">

                            <div class="progress-dot"></div>


                            <div class="progress-content">


                                <!-- STATUS CHANGE -->

                                <div class="progress-change">

                                    @if($history->old_status)

                                        <span class="progress-old">
                                            {{ $history->old_status }}
                                        </span>

                                        <span class="progress-arrow">
                                            →
                                        </span>

                                    @endif

                                    <span class="progress-new">

                                        {{ $history->new_status }}

                                    </span>

                                </div>


                                <!-- META -->

                                <div class="progress-meta">


                                    <!-- CHANGED BY -->

                                    <div class="progress-meta-item">

                                        <span class="progress-meta-label">
                                            Updated By
                                        </span>

                                        @if($history->changedBy)

                                            {{ $history->changedBy->first_name }}
                                            {{ $history->changedBy->last_name }}

                                        @else

                                            System

                                        @endif

                                    </div>


                                    <!-- DATE -->

                                    <div class="progress-meta-item">

                                        <span class="progress-meta-label">
                                            Date & Time
                                        </span>

                                        @if($history->changed_at)

                                            {{ $history->changed_at->format('d M Y, h:i A') }}

                                        @else

                                            -

                                        @endif

                                    </div>


                                </div>


                                <!-- REMARKS -->

                                @if($history->remarks)

                                    <div class="progress-remarks">

                                        <span class="progress-remarks-label">
                                            Remarks
                                        </span>

                                        {{ $history->remarks }}

                                    </div>

                                @endif


                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="no-progress">

                    No status updates have been recorded yet.

                </div>

            @endif


        </div>

    </div>


    <!-- STUDENT MESSAGE -->

    <div class="card">

        <div class="card-header">

            <h2>
                Additional Message
            </h2>

        </div>

        <div class="card-body">

            @if($application->student_message)

                <div class="message-box">

                    {{ $application->student_message }}

                </div>

            @else

                <div class="message-box no-message">

                    No additional message was provided.

                </div>

            @endif

        </div>

    </div>


    <!-- ACTIONS -->

    <div class="card">

        <div class="card-body">

            <div class="bottom-actions">

                <div class="left-actions">

                    <a
                        href="{{ route('student.applications.index') }}"
                        class="btn btn-secondary"
                    >
                        ← Back
                    </a>

                    <a
                        href="{{ route('student.applications.journey', $application) }}"
                        class="btn btn-secondary"
                    >
                        View journey &amp; deadlines
                    </a>

                </div>


                <div class="right-actions">

                    @if(
                        in_array(
                            $application->application_status,
                            ['Submitted', 'Under Review']
                        )
                    )

                        <a
                            href="{{ route('student.applications.edit', $application) }}"
                            class="btn btn-primary"
                        >
                            Edit Application
                        </a>


                        <form
                            action="{{ route('student.applications.destroy', $application) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to cancel this application?');"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger"
                            >
                                Cancel Application
                            </button>

                        </form>

                    @endif

                </div>

            </div>

        </div>

    </div>


</div>

</div>

</body>
</html>