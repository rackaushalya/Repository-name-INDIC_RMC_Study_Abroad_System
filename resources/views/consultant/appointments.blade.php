@extends('layouts.consultant')

@section('title', 'Appointments')

@section('content')

<div class="page-header">
    <div>
        <h1>Appointments</h1>
        <p>Confirm requests, update statuses and open consultation notes.</p>
    </div>
    <a class="btn" href="{{ route('consultant.calendar') }}">Calendar view</a>
</div>

<div class="panel">

    <form class="toolbar" method="GET" action="{{ route('consultant.appointments') }}">
        <select name="view" onchange="this.form.submit()">
            <option value="upcoming" @selected($view === 'upcoming')>Upcoming</option>
            <option value="past" @selected($view === 'past')>Past / closed</option>
            <option value="all" @selected($view === 'all')>All</option>
        </select>
        <select name="status">
            <option value="">Any status</option>
            @foreach (['Requested', 'Confirmed', 'Completed', 'Cancelled', 'No Show'] as $s)
                <option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }}</option>
            @endforeach
        </select>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Student name">
        <button class="btn" type="submit">Filter</button>
        @if (request()->hasAny(['q', 'status']))
            <a class="btn btn-light" href="{{ route('consultant.appointments', ['view' => $view]) }}">Clear</a>
        @endif
    </form>

    <div class="table-wrap">
        <table class="tbl">
            <thead>
                <tr><th>Date &amp; time</th><th>Student</th><th>Type</th><th>Status</th><th>Update</th><th>Notes</th></tr>
            </thead>
            <tbody>
            @forelse ($appointments as $ap)
                @php $u = $ap->student?->user; @endphp
                <tr>
                    <td>
                        <div class="strong">{{ $ap->appointment_date->format('D, d M Y') }}</div>
                        <div class="muted">{{ \Carbon\Carbon::parse($ap->start_time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($ap->end_time)->format('h:i A') }}</div>
                    </td>
                    <td>
                        {{ trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student' }}
                        <div class="muted">{{ $ap->application->application_reference ?? 'No application' }}</div>
                    </td>
                    <td>
                        {{ $ap->appointment_type }}
                        @if ($ap->meeting_link)<div class="muted"><a href="{{ $ap->meeting_link }}" target="_blank" rel="noopener">Meeting link</a></div>@endif
                    </td>
                    <td>@include('consultant.partials.status-badge', ['status' => $ap->appointment_status])</td>
                    <td>
                        <form class="inline-form" method="POST" action="{{ route('consultant.appointments.status', $ap->appointment_id) }}">
                            @csrf @method('PATCH')
                            <select name="appointment_status">
                                @foreach (['Requested', 'Confirmed', 'Completed', 'Cancelled', 'No Show'] as $s)
                                    <option value="{{ $s }}" @selected($ap->appointment_status === $s)>{{ $s }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm" type="submit">Save</button>
                        </form>
                    </td>
                    <td>
                        @if ($recordByAppt = $recordIds->get($ap->appointment_id))
                            <a class="btn btn-light btn-sm" href="{{ route('consultant.consultations.show', $recordByAppt) }}">View record</a>
                        @elseif (in_array($ap->appointment_status, ['Confirmed', 'Completed']))
                            <a class="btn btn-sm" href="{{ route('consultant.consultations.create', $ap->appointment_id) }}">Add notes</a>
                        @else
                            <span class="muted">—</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">No appointments found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pager">{{ $appointments->links('pagination.portal') }}</div>
</div>

@endsection
