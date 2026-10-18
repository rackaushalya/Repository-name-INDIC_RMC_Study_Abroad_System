@extends('layouts.consultant')

@section('title', 'Consultant Dashboard')

@section('content')

<div class="page-header">
    <div>
        <h1>Consultant Dashboard</h1>
        <p>Manage assigned students, appointments and consultations.</p>
    </div>
    <div class="date">{{ now()->format('l, d F Y') }}</div>
</div>

{{-- KPI CARDS --}}
<div class="kpi-grid">
    <div class="kpi">
        <div class="kpi-header"><span class="kpi-label">Assigned Students</span></div>
        <div class="kpi-value">{{ $stats['total_students'] }}</div>
        <div class="kpi-footer"><a href="{{ route('consultant.students') }}">View all students →</a></div>
    </div>
    <div class="kpi">
        <div class="kpi-header"><span class="kpi-label">Today's Appointments</span></div>
        <div class="kpi-value">{{ $stats['today_appointments'] }}</div>
        <div class="kpi-footer">{{ $stats['week_appointments'] }} in the next 7 days</div>
    </div>
    <div class="kpi">
        <div class="kpi-header"><span class="kpi-label">Pending Requests</span></div>
        <div class="kpi-value">{{ $stats['pending_requests'] }}</div>
        <div class="kpi-footer"><a href="{{ route('consultant.appointments', ['status' => 'Requested', 'view' => 'all']) }}">Review requests →</a></div>
    </div>
    <div class="kpi">
        <div class="kpi-header"><span class="kpi-label">Consultations Recorded</span></div>
        <div class="kpi-value">{{ $stats['completed_consultations'] }}</div>
        <div class="kpi-footer">
            @if ($stats['pending_records'] > 0)
                <a href="{{ route('consultant.consultations') }}" style="color:#c2610c;font-weight:600;">{{ $stats['pending_records'] }} awaiting notes →</a>
            @else
                <span class="success">All sessions documented</span>
            @endif
        </div>
    </div>
</div>

<div class="grid-main">

    {{-- UPCOMING APPOINTMENTS --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Upcoming Appointments</div>
            <a href="{{ route('consultant.calendar') }}" class="btn btn-light btn-sm">Open calendar</a>
        </div>

        @forelse ($upcomingAppointments as $appt)
            @php $u = $appt->student?->user; @endphp
            <div class="agenda-item">
                <div class="agenda-time">
                    {{ $appt->appointment_date->format('d M') }}<br>
                    <span class="muted">{{ \Carbon\Carbon::parse($appt->start_time)->format('h:i A') }}</span>
                </div>
                <div style="flex:1">
                    <div class="strong">{{ trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student' }}</div>
                    <div class="muted">{{ $appt->appointment_type }} · {{ $appt->application->application_reference ?? 'No application' }}</div>
                </div>
                <div>@include('consultant.partials.status-badge', ['status' => $appt->appointment_status])</div>
            </div>
        @empty
            <div class="empty">No upcoming appointments.</div>
        @endforelse
    </div>

    {{-- AWAITING NOTES --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Awaiting Consultation Notes</div>
        </div>

        @forelse ($awaitingRecord as $appt)
            @php $u = $appt->student?->user; @endphp
            <div class="agenda-item">
                <div style="flex:1">
                    <div class="strong">{{ trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student' }}</div>
                    <div class="muted">{{ $appt->appointment_date->format('d M Y') }} · {{ \Carbon\Carbon::parse($appt->start_time)->format('h:i A') }}</div>
                </div>
                <a class="btn btn-sm" href="{{ route('consultant.consultations.create', $appt->appointment_id) }}">Add notes</a>
            </div>
        @empty
            <div class="empty">Nothing waiting — nice work.</div>
        @endforelse
    </div>
</div>

<div class="grid-bottom">

    {{-- ASSIGNED STUDENTS --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Recently Assigned Students</div>
            <a href="{{ route('consultant.students') }}" class="btn btn-light btn-sm">View all</a>
        </div>

        @forelse ($recentStudents as $a)
            @php $u = $a->application?->student?->user; @endphp
            <div class="agenda-item">
                <div style="flex:1">
                    <a class="strong" href="{{ route('consultant.students.show', $a->assignment_id) }}">
                        {{ trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student' }}
                    </a>
                    <div class="muted">
                        {{ $a->application->application_reference ?? '' }}
                        @if ($a->application?->preferredCountry) · {{ $a->application->preferredCountry->country_name }} @endif
                    </div>
                </div>
                @include('consultant.partials.status-badge', ['status' => $a->application->application_status ?? null])
            </div>
        @empty
            <div class="empty">No students assigned yet.</div>
        @endforelse
    </div>

    {{-- RECENT CONSULTATIONS --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Recent Consultations</div>
            <a href="{{ route('consultant.consultations') }}" class="btn btn-light btn-sm">All</a>
        </div>

        @forelse ($recentRecords as $r)
            @php $u = $r->student?->user; @endphp
            <div class="agenda-item">
                <div style="flex:1">
                    <a class="strong" href="{{ route('consultant.consultations.show', $r->consultation_record_id) }}">
                        {{ trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student' }}
                    </a>
                    <div class="muted">{{ $r->appointment?->appointment_date?->format('d M Y') }}</div>
                </div>
                @include('consultant.partials.status-badge', ['status' => $r->consultation_status])
            </div>
        @empty
            <div class="empty">No consultations recorded yet.</div>
        @endforelse
    </div>
</div>

@endsection
