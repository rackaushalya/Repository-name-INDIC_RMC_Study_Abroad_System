<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Appointments | INDIC RMC</title>

    @include('components.page-style')
    @include('components.sidebar-style')
</head>
<body>

@include('components.admin-sidebar')

@php
    $statusBadge = fn (?string $status): string => match ($status) {
        'Requested' => 'amber',
        'Confirmed' => 'purple',
        'Completed' => 'green',
        'Cancelled' => 'red',
        'No Show' => 'grey',
        default => '',
    };
@endphp

<main class="main">

    <x-admin-topbar current="Appointments" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Appointment Management</h1>
                <p>View consultations scheduled between students and consultants.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('admin.appointments.create') }}" class="pg-btn pg-btn-dark">
                    <i class="bi bi-plus-lg"></i> Add appointment
                </a>
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

        <div class="pg-card">

            <div class="pg-table-wrap">
                <table class="pg-table" style="min-width:980px;">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Student</th>
                            <th>Consultant</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($appointments as $appointment)
                            @php
                                $studentUser = $appointment->student?->user;
                                $studentName = $studentUser
                                    ? trim($studentUser->first_name . ' ' . $studentUser->last_name)
                                    : '';

                                $consultantUser = $appointment->consultant?->user;
                                $consultantName = $consultantUser
                                    ? trim($consultantUser->first_name . ' ' . $consultantUser->last_name)
                                    : '';

                                $status = $appointment->appointment_status ?? 'Unknown';
                            @endphp

                            <tr>
                                <td class="pg-strong">{{ $appointment->appointment_date?->format('d M Y') ?? '—' }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}
                                    &ndash;
                                    {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
                                </td>

                                <td>
                                    @if ($studentUser)
                                        <div class="pg-person">
                                            <div class="pg-person-avatar">{{ strtoupper(substr($studentName ?: $studentUser->email, 0, 1)) }}</div>
                                            <div>
                                                <div class="pg-strong">{{ $studentName ?: $studentUser->email }}</div>
                                                <span class="pg-sub">{{ $studentUser->email }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <span class="pg-muted">Unknown student</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($consultantUser)
                                        {{ $consultantName ?: $consultantUser->email }}
                                    @else
                                        <span class="pg-muted">Unassigned</span>
                                    @endif
                                </td>

                                <td>{{ $appointment->appointment_type ?? '—' }}</td>

                                <td><span class="pg-badge {{ $statusBadge($status) }}">{{ $status }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="pg-empty">
                                        <div class="pg-empty-icon"><i class="bi bi-calendar-event"></i></div>
                                        <h3>No appointments found</h3>
                                        <p>Consultations scheduled between students and consultants will appear here.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($appointments->hasPages())
                <div class="pg-pagination">
                    {{ $appointments->links('pagination.portal') }}
                </div>
            @endif

        </div>

    </section>
</main>

</body>
</html>