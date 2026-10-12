<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Applications | INDIC RMC</title>

    @include('components.page-style')

    <style>
        .ap-progress { min-width: 190px; max-width: 260px; }
        .ap-progress strong { display: block; font-size: 12px; }
        .ap-progress p { margin: 3px 0 0; font-size: 11px; line-height: 1.5; color: #727c8d; }
        .ap-progress small { display: block; margin-top: 4px; font-size: 10px; color: #9aa3b2; }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

@php
    $statusBadge = fn (string $status): string => match ($status) {
        'Submitted', 'Consultation Completed' => 'blue',
        'Under Review' => 'amber',
        'Consultant Assigned', 'Consultation Scheduled' => 'purple',
        'Recommendation Provided', 'Completed' => 'green',
        'Follow-up Required' => 'orange',
        'Rejected' => 'red',
        'Cancelled' => 'grey',
        default => '',
    };
@endphp

<main class="main">

    <x-student-topbar current="Consultancy Applications" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>My Applications</h1>
                <p>Track your study abroad consultancy applications and their progress.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('student.applications.create') }}" class="pg-btn pg-btn-primary">
                    <i class="bi bi-plus-lg"></i> New Application
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="pg-alert success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Status summary --}}
        <div class="pg-stats">
            <div class="pg-stat">
                <div class="pg-stat-icon blue"><i class="bi bi-hourglass-split"></i></div>
                <div><span>In progress</span><strong>{{ $overview['counts']['active'] }}</strong></div>
            </div>
            <div class="pg-stat">
                <div class="pg-stat-icon"><i class="bi bi-lightning-charge"></i></div>
                <div><span>Need your action</span><strong>{{ $overview['counts']['needs_action'] }}</strong></div>
            </div>
            <div class="pg-stat">
                <div class="pg-stat-icon navy"><i class="bi bi-alarm"></i></div>
                <div>
                    <span>Deadlines due soon</span>
                    <strong>{{ $overview['due_soon'] }}@if ($overview['overdue']) <small style="color:#dc2626; font-size:12px;">+{{ $overview['overdue'] }} overdue</small>@endif</strong>
                </div>
            </div>
            <div class="pg-stat">
                <div class="pg-stat-icon green"><i class="bi bi-check2-circle"></i></div>
                <div><span>Completed</span><strong>{{ $overview['counts']['completed'] }}</strong></div>
            </div>
        </div>

        <div class="pg-card">

            <div class="pg-card-head">
                <h2><i class="bi bi-file-earmark-text"></i> Applications</h2>
                <small>{{ $applications->total() }} total</small>
            </div>

            @if ($applications->count())

                <div class="pg-table-wrap">
                    <table class="pg-table" style="min-width:1100px;">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Destination / Course</th>
                                <th>Intake</th>
                                <th>Status</th>
                                <th>Next Step</th>
                                <th>Latest Update</th>
                                <th>Submitted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($applications as $application)
                                @php
                                    $status = $application->application_status ?? 'Unknown';
                                    $latest = $application->statusHistory->last();
                                    $journey = $overview['journeys'][$application->application_id] ?? null;
                                    $nextDeadline = $journey['next_deadline'] ?? null;
                                @endphp

                                <tr>
                                    <td>
                                        <a href="{{ route('student.applications.show', $application) }}"
                                           class="pg-strong" style="color:#f97316;">
                                            {{ $application->application_reference ?? '#' . $application->application_id }}
                                        </a>
                                        <span class="pg-sub">{{ $application->application_type ?? '' }}</span>
                                    </td>

                                    <td>
                                        <div class="pg-strong">{{ $application->preferredCountry->country_name ?? '—' }}</div>
                                        <span class="pg-sub">{{ $application->preferredCourse->course_name ?? '—' }}</span>
                                    </td>

                                    <td>{{ $application->preferredIntake->intake_name ?? '—' }}</td>

                                    <td><span class="pg-badge {{ $statusBadge($status) }}">{{ $status }}</span></td>

                                    <td>
                                        @if ($journey)
                                            <div class="ap-progress">
                                                <strong style="{{ $journey['next_action']['needs_action'] ? 'color:#d9560a;' : '' }}">{{ $journey['next_action']['label'] }}</strong>

                                                @if ($nextDeadline)
                                                    <p>
                                                        <span class="pg-badge {{ ['overdue' => 'red', 'urgent' => 'red', 'soon' => 'amber', 'ok' => 'grey'][$nextDeadline['urgency']] }}">
                                                            {{ $nextDeadline['days'] < 0 ? 'Overdue' : ($nextDeadline['days'] === 0 ? 'Due today' : $nextDeadline['days'] . ' ' . \Illuminate\Support\Str::plural('day', $nextDeadline['days']) . ' left') }}
                                                        </span>
                                                    </p>
                                                    <small>{{ $nextDeadline['title'] }}</small>
                                                @endif
                                            </div>
                                        @else
                                            <span class="pg-muted">—</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($latest)
                                            <div class="ap-progress">
                                                <strong>{{ $latest->new_status }}</strong>
                                                <p>{{ $latest->remarks ?: 'Status updated without remarks.' }}</p>

                                                @if ($latest->changed_at)
                                                    <small>{{ $latest->changed_at->format('d M Y, h:i A') }}</small>
                                                @endif
                                            </div>
                                        @else
                                            <span class="pg-muted" style="font-style:italic;">No status updates yet</span>
                                        @endif
                                    </td>

                                    <td>{{ $application->submitted_at?->format('d M Y') ?? '—' }}</td>

                                    <td>
                                        <div class="pg-row-actions">
                                            <a href="{{ route('student.applications.journey', $application) }}"
                                               class="pg-icon-btn" title="View journey and deadlines">
                                                <i class="bi bi-signpost-split"></i>
                                            </a>

                                            <a href="{{ route('student.applications.show', $application) }}"
                                               class="pg-icon-btn" title="View application">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            @if (in_array($application->application_status, ['Submitted', 'Under Review']))
                                                <a href="{{ route('student.applications.edit', $application) }}"
                                                   class="pg-icon-btn" title="Edit application">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('student.fund-requirements.create', ['application' => $application->application_id]) }}"
                                               class="pg-icon-btn" title="Estimate funds for this application">
                                                <i class="bi bi-cash-coin"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($applications->hasPages())
                    <div class="pg-pagination">
                        {{ $applications->links('pagination.portal') }}
                    </div>
                @endif

            @else

                <div class="pg-empty">
                    <div class="pg-empty-icon"><i class="bi bi-file-earmark-text"></i></div>
                    <h3>No applications yet</h3>
                    <p>You have not submitted any applications yet.</p>

                    <a href="{{ route('student.applications.create') }}" class="pg-btn pg-btn-primary">
                        <i class="bi bi-plus-lg"></i> Create Your First Application
                    </a>
                </div>

            @endif

        </div>

    </section>
</main>

</body>
</html>
