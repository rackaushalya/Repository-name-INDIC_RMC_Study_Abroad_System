<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Applications | INDIC RMC</title>

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
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
        }

        .page-header h1 {
            font-size: 28px;
            margin-bottom: 7px;
        }

        .page-header p {
            color: #718096;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
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
            color: #17233c;
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

        .progress-info {
            min-width: 170px;
        }

        .progress-status {
            display: block;
            font-size: 12px;
            font-weight: bold;
            color: #17233c;
            margin-bottom: 4px;
        }

        .progress-remark {
            display: block;
            color: #718096;
            font-size: 11px;
            line-height: 1.4;
            max-width: 230px;
        }

        .progress-date {
            display: block;
            color: #9aa3b2;
            font-size: 10px;
            margin-top: 5px;
        }

        .no-progress {
            color: #8a94a6;
            font-size: 11px;
            font-style: italic;
        }

        .action-btn {
            display: inline-block;
            padding: 7px 11px;
            border: 1px solid #17233c;
            color: #17233c;
            border-radius: 6px;
            font-size: 11px;
            font-weight: bold;
            margin-right: 5px;
        }

        .action-btn:hover {
            background: #17233c;
            color: white;
        }

        .edit-btn {
            border-color: #ff7a18;
            color: #ff7a18;
        }

        .edit-btn:hover {
            background: #ff7a18;
            color: white;
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #8a94a6;
        }

        .empty h3 {
            color: #17233c;
            margin-bottom: 8px;
            font-size: 18px;
        }

        .empty p {
            margin-bottom: 20px;
            font-size: 13px;
        }

        .pagination {
            padding: 18px 20px;
            border-top: 1px solid #edf0f4;
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

        @media (max-width: 1100px) {

            .container {
                padding: 20px;
            }

            th,
            td {
                padding: 12px;
            }

        }

        @media (max-width: 900px) {

            .container {
                padding: 18px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .actions {
                width: 100%;
            }

            .btn {
                text-align: center;
            }

            th,
            td {
                padding: 12px;
            }

        }

    </style>
</head>

<body>

<div class="container">


    <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h1>My Applications</h1>

            <p>
                View and manage your study abroad applications.
            </p>

        </div>


        <div class="actions">

            <a
                href="{{ route('student.applications.create') }}"
                class="btn btn-primary"
            >
                + New Application
            </a>

            <a
                href="{{ route('student.dashboard') }}"
                class="btn btn-secondary"
            >
                ← Dashboard
            </a>

        </div>

    </div>


    <!-- SUCCESS MESSAGE -->

    @if(session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif


    <!-- APPLICATION CARD -->

    <div class="card">

        <div class="card-header">

            <h2>My Applications</h2>

            <span class="total">
                Total: {{ $applications->total() }}
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
                            Progress
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


                            <!-- TYPE -->

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

                            </td>


                            <!-- PROGRESS -->

                            <td>

                                @if($application->statusHistory->count() > 0)

                                    @php
                                        $latestProgress =
                                            $application->statusHistory->last();
                                    @endphp

                                    <div class="progress-info">

                                        <span class="progress-status">

                                            {{ $latestProgress->new_status }}

                                        </span>


                                        @if($latestProgress->remarks)

                                            <span class="progress-remark">

                                                {{ $latestProgress->remarks }}

                                            </span>

                                        @else

                                            <span class="progress-remark">

                                                Status updated without remarks.

                                            </span>

                                        @endif


                                        @if($latestProgress->changed_at)

                                            <span class="progress-date">

                                                {{ $latestProgress->changed_at->format('d M Y, h:i A') }}

                                            </span>

                                        @endif

                                    </div>

                                @else

                                    <span class="no-progress">

                                        No status updates yet.

                                    </span>

                                @endif

                            </td>


                            <!-- SUBMITTED DATE -->

                            <td>

                                @if($application->submitted_at)

                                    {{ $application->submitted_at->format('d M Y') }}

                                @else

                                    -

                                @endif

                            </td>


                            <!-- ACTIONS -->

                            <td>

                                <a
                                    href="{{ route('student.applications.show', $application) }}"
                                    class="action-btn"
                                >
                                    View
                                </a>


                                @if(
                                    in_array(
                                        $application->application_status,
                                        ['Submitted', 'Under Review']
                                    )
                                )

                                    <a
                                        href="{{ route('student.applications.edit', $application) }}"
                                        class="action-btn edit-btn"
                                    >
                                        Edit
                                    </a>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="9"
                                class="empty"
                            >

                                <h3>No applications yet</h3>

                                <p>
                                    You have not submitted any applications yet.
                                </p>

                                <a
                                    href="{{ route('student.applications.create') }}"
                                    class="btn btn-primary"
                                >
                                    + Create Your First Application
                                </a>

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

</body>
</html>