<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Applications | INDIC RMC</title>

    @include('components.page-style')
    @include('components.sidebar-style')
</head>
<body>

@include('components.admin-sidebar')

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

    $totalAll = (int) $statusCounts->sum();
    $filtering = request()->hasAny(['search', 'status']);
    $activeStatus = request('status');
@endphp

<main class="main">

    <x-admin-topbar current="Applications" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Application Management</h1>
                <p>View and manage student consultancy applications.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('admin.dashboard') }}" class="pg-btn">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="pg-alert success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <div class="pg-stats">
            <div class="pg-stat">
                <div class="pg-stat-icon"><i class="bi bi-file-earmark-text"></i></div>
                <div><span>Total Applications</span><strong>{{ $totalAll }}</strong></div>
            </div>

            <div class="pg-stat">
                <div class="pg-stat-icon blue"><i class="bi bi-send"></i></div>
                <div><span>Newly Submitted</span><strong>{{ $statusCounts['Submitted'] ?? 0 }}</strong></div>
            </div>

            <div class="pg-stat">
                <div class="pg-stat-icon navy"><i class="bi bi-hourglass-split"></i></div>
                <div><span>Under Review</span><strong>{{ $statusCounts['Under Review'] ?? 0 }}</strong></div>
            </div>

            <div class="pg-stat">
                <div class="pg-stat-icon green"><i class="bi bi-check2-circle"></i></div>
                <div><span>Completed</span><strong>{{ $statusCounts['Completed'] ?? 0 }}</strong></div>
            </div>
        </div>

        <div class="pg-card">

            <form method="GET" action="{{ route('admin.applications-list') }}" class="pg-toolbar">

                <div class="pg-search">
                    <i class="bi bi-search"></i>
                    <input type="text"
                           name="search"
                           placeholder="Search reference, student, course or country..."
                           value="{{ request('search') }}">
                </div>

                @if ($activeStatus)
                    <input type="hidden" name="status" value="{{ $activeStatus }}">
                @endif

                <button type="submit" class="pg-btn pg-btn-dark">
                    <i class="bi bi-search"></i> Search
                </button>

                @if ($filtering)
                    <a href="{{ route('admin.applications-list') }}" class="pg-btn">Clear</a>
                @endif
            </form>

            <div class="pg-chips">
                <a href="{{ route('admin.applications-list', array_filter(['search' => request('search')])) }}"
                   class="pg-chip {{ $activeStatus ? '' : 'active' }}">
                    All <b>{{ $totalAll }}</b>
                </a>

                @foreach (\App\Models\Application::STATUSES as $statusName)
                    <a href="{{ route('admin.applications-list', array_filter(['search' => request('search'), 'status' => $statusName])) }}"
                       class="pg-chip {{ $activeStatus === $statusName ? 'active' : '' }}">
                        {{ $statusName }} <b>{{ $statusCounts[$statusName] ?? 0 }}</b>
                    </a>
                @endforeach
            </div>

            <div class="pg-table-wrap">
                <table class="pg-table" style="min-width:980px;">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Student</th>
                            <th>Type</th>
                            <th>Destination</th>
                            <th>Intake</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($applications as $application)
                            @php
                                $user = $application->student?->user;
                                $name = $user ? trim($user->first_name . ' ' . $user->last_name) : '';
                                $status = $application->application_status ?? 'Unknown';
                            @endphp

                            <tr>

                                <td>
                                    @if ($user)
                                        <div class="pg-person">
                                            <div class="pg-person-avatar">{{ strtoupper(substr($name ?: $user->email, 0, 1)) }}</div>
                                            <div>
                                                <div class="pg-strong">{{ $name }}</div>
                                                <span class="pg-sub">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <span class="pg-muted">Unknown student</span>
                                    @endif
                                </td>

                                <td>{{ $application->application_type ?? '—' }}</td>

                                <td>
                                    <div class="pg-strong">{{ $application->preferredCountry->country_name ?? '—' }}</div>
                                    <span class="pg-sub">{{ $application->preferredCourse->course_name ?? '—' }}</span>
                                </td>

                                <td>{{ $application->preferredIntake->intake_name ?? '—' }}</td>

                                <td><span class="pg-badge {{ $statusBadge($status) }}">{{ $status }}</span></td>

                                <td>{{ $application->submitted_at?->format('d M Y') ?? '—' }}</td>

                                <td>
                                    <a href="{{ route('admin.applications-show', $application) }}"
                                       class="pg-btn pg-btn-sm">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="pg-empty">
                                        <div class="pg-empty-icon"><i class="bi bi-file-earmark-text"></i></div>
                                        <h3>No applications found</h3>
                                        <p>{{ $filtering ? 'No applications match your search or filter.' : 'Student applications will appear here.' }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($applications->hasPages())
                <div class="pg-pagination">
                    {{ $applications->links('pagination.portal') }}
                </div>
            @endif

        </div>

    </section>
</main>

</body>
</html>
