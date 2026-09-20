<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Applications | INDIC RMC</title>


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
            background: #17233c;
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
            color: #17233c;
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
            border: 1px solid #ff7a18;
            color: #ff7a18;
            border-radius: 6px;
            font-size: 11px;
            font-weight: bold;
        }


        .view-btn:hover {
            background: #ff7a18;
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

    </style>

</head>


<body>


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


</body>

</html>