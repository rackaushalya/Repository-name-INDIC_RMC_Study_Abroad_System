@extends('layouts.consultant')

@section('title', 'Student Profile')

@php
    $u = $student->user;
    $fullName = trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student';
    $recordByAppt = $records->keyBy('appointment_id');
@endphp

@section('content')

<div class="page-header">
    <div>
        <h1>{{ $fullName }}</h1>
        <p>{{ $application->application_reference }} · assigned {{ $assignment->assigned_at?->format('d M Y') }}</p>
    </div>
    <a class="btn btn-light" href="{{ route('consultant.students') }}">← Back to students</a>
</div>

<div class="stack">

    <div class="panel">
        <div class="panel-header"><div class="panel-title">Student Details</div></div>
        <dl class="detail-grid">
            <div><dt>Email</dt><dd>{{ $u->email ?? '-' }}</dd></div>
            <div><dt>Phone</dt><dd>{{ $u->phone ?? '-' }}</dd></div>
            <div><dt>Nationality</dt><dd>{{ $student->nationality ?? '-' }}</dd></div>
            <div><dt>Date of birth</dt><dd>{{ $student->date_of_birth?->format('d M Y') ?? '-' }}</dd></div>
            <div><dt>Gender</dt><dd>{{ $student->gender ?? '-' }}</dd></div>
            <div><dt>Location</dt><dd>{{ collect([$student->city, $student->country])->filter()->implode(', ') ?: '-' }}</dd></div>
        </dl>
    </div>

    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Application</div>
            @include('consultant.partials.status-badge', ['status' => $application->application_status])
        </div>
        <dl class="detail-grid">
            <div><dt>Type</dt><dd>{{ $application->application_type }}</dd></div>
            <div><dt>Preferred country</dt><dd>{{ $application->preferredCountry->country_name ?? '-' }}</dd></div>
            <div><dt>Preferred course</dt><dd>{{ $application->preferredCourse->course_name ?? '-' }}</dd></div>
            <div><dt>Preferred intake</dt><dd>{{ $application->preferredIntake->intake_name ?? '-' }}</dd></div>
            <div><dt>Submitted</dt><dd>{{ $application->submitted_at?->format('d M Y') ?? '-' }}</dd></div>
            <div><dt>Assignment status</dt><dd>@include('consultant.partials.status-badge', ['status' => $assignment->assignment_status])</dd></div>
        </dl>
        @if ($application->student_message)
            <div style="margin-top:16px">
                <div class="muted" style="text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Student message</div>
                <div class="prose">{{ $application->student_message }}</div>
            </div>
        @endif
        @if ($assignment->notes)
            <div style="margin-top:16px">
                <div class="muted" style="text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Admin assignment notes</div>
                <div class="prose">{{ $assignment->notes }}</div>
            </div>
        @endif
    </div>

    <div class="panel">
        <div class="panel-header"><div class="panel-title">Appointments</div></div>
        <div class="table-wrap">
            <table class="tbl">
                <thead><tr><th>Date</th><th>Time</th><th>Type</th><th>Status</th><th>Consultation</th></tr></thead>
                <tbody>
                @forelse ($appointments as $ap)
                    <tr>
                        <td>{{ $ap->appointment_date->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($ap->start_time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($ap->end_time)->format('h:i A') }}</td>
                        <td>{{ $ap->appointment_type }}</td>
                        <td>@include('consultant.partials.status-badge', ['status' => $ap->appointment_status])</td>
                        <td>
                            @if ($recordByAppt->has($ap->appointment_id))
                                <a class="btn btn-light btn-sm" href="{{ route('consultant.consultations.show', $recordByAppt[$ap->appointment_id]->consultation_record_id) }}">View record</a>
                            @elseif (in_array($ap->appointment_status, ['Confirmed', 'Completed']))
                                <a class="btn btn-sm" href="{{ route('consultant.consultations.create', $ap->appointment_id) }}">Add notes</a>
                            @else
                                <span class="muted">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">No appointments with this student yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><div class="panel-title">Application Timeline</div></div>
        @forelse ($application->statusHistory as $h)
            <div class="agenda-item">
                <div class="agenda-time">{{ $h->changed_at?->format('d M Y') }}<br><span class="muted">{{ $h->changed_at?->format('h:i A') }}</span></div>
                <div style="flex:1">
                    <div class="strong">{{ $h->old_status ? $h->old_status . ' → ' : '' }}{{ $h->new_status }}</div>
                    @if ($h->remarks)<div class="muted">{{ $h->remarks }}</div>@endif
                </div>
            </div>
        @empty
            <div class="empty">No status changes recorded.</div>
        @endforelse
    </div>

</div>
@endsection
