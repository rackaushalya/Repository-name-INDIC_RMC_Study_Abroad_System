@extends('layouts.consultant')

@section('title', 'Calendar')

@section('content')

<div class="page-header">
    <div>
        <h1>Appointments Calendar</h1>
        <p>Your schedule at a glance. Click a day to see its appointments.</p>
    </div>
    <a class="btn btn-light" href="{{ route('consultant.appointments') }}">List view</a>
</div>

<div class="grid-main">

    <div class="panel">
        <div class="cal-head">
            <a class="btn btn-light btn-sm" href="{{ route('consultant.calendar', ['month' => $prevMonth]) }}">← Prev</a>
            <h2>{{ $month->format('F Y') }}</h2>
            <div style="display:flex;gap:6px">
                <a class="btn btn-light btn-sm" href="{{ route('consultant.calendar') }}">Today</a>
                <a class="btn btn-light btn-sm" href="{{ route('consultant.calendar', ['month' => $nextMonth]) }}">Next →</a>
            </div>
        </div>

        <div class="cal-grid">
            @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $d)
                <div class="cal-dow">{{ $d }}</div>
            @endforeach

            @foreach ($weeks as $week)
                @foreach ($week as $day)
                    @php
                        $key = $day->toDateString();
                        $events = $appointments->get($key, collect());
                        $classes = 'cal-cell'
                            . ($day->month !== $month->month ? ' out' : '')
                            . ($day->isToday() ? ' today' : '')
                            . ($day->isSameDay($selected) ? ' selected' : '');
                    @endphp
                    <a class="{{ $classes }}" href="{{ route('consultant.calendar', ['month' => $month->format('Y-m'), 'date' => $key]) }}">
                        <span class="cal-day">{{ $day->day }}</span>
                        @foreach ($events->take(3) as $ev)
                            @php $su = $ev->student?->user; @endphp
                            <span class="cal-ev {{ $ev->appointment_status }}" title="{{ $ev->appointment_status }}">
                                {{ \Carbon\Carbon::parse($ev->start_time)->format('H:i') }}
                                {{ $su->first_name ?? 'Student' }}
                            </span>
                        @endforeach
                        @if ($events->count() > 3)
                            <span class="cal-more">+{{ $events->count() - 3 }} more</span>
                        @endif
                    </a>
                @endforeach
            @endforeach
        </div>

        <div class="legend">
            <span><span class="badge orange">Requested</span></span>
            <span><span class="badge blue">Confirmed</span></span>
            <span><span class="badge green">Completed</span></span>
            <span><span class="badge grey">Cancelled / No show</span></span>
        </div>
    </div>

    <div class="stack">
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">{{ $selected->format('l, d M Y') }}</div>
            </div>

            @forelse ($selectedAppointments as $ap)
                @php $su = $ap->student?->user; @endphp
                <div class="agenda-item">
                    <div class="agenda-time">
                        {{ \Carbon\Carbon::parse($ap->start_time)->format('h:i A') }}<br>
                        <span class="muted">to {{ \Carbon\Carbon::parse($ap->end_time)->format('h:i A') }}</span>
                    </div>
                    <div style="flex:1">
                        <div class="strong">{{ trim(($su->first_name ?? '') . ' ' . ($su->last_name ?? '')) ?: 'Student' }}</div>
                        <div class="muted">{{ $ap->appointment_type }} · {{ $ap->application->application_reference ?? 'No application' }}</div>
                        <div style="margin-top:6px">@include('consultant.partials.status-badge', ['status' => $ap->appointment_status])</div>
                        @if ($ap->student_notes)<div class="muted" style="margin-top:6px">“{{ \Illuminate\Support\Str::limit($ap->student_notes, 90) }}”</div>@endif
                        @if ($ap->meeting_link)<div style="margin-top:6px"><a class="muted" href="{{ $ap->meeting_link }}" target="_blank" rel="noopener">Join link</a></div>@endif
                        <div style="margin-top:8px;display:flex;gap:6px;flex-wrap:wrap">
                            @if ($ap->appointment_status === 'Requested')
                                <form method="POST" action="{{ route('consultant.appointments.status', $ap->appointment_id) }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="appointment_status" value="Confirmed">
                                    <button class="btn btn-sm" type="submit">Confirm</button>
                                </form>
                            @endif
                            @if (in_array($ap->appointment_status, ['Confirmed', 'Completed']))
                                <a class="btn btn-light btn-sm" href="{{ route('consultant.consultations.create', $ap->appointment_id) }}">Consultation notes</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty">No appointments on this day.</div>
            @endforelse
        </div>

        <div class="panel">
            <div class="panel-header"><div class="panel-title">Weekly Availability</div></div>
            @forelse (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $dow)
                @if ($availability->has($dow))
                    <div class="agenda-item">
                        <div class="agenda-time">{{ substr($dow, 0, 3) }}</div>
                        <div style="flex:1" class="muted">
                            @foreach ($availability[$dow] as $slot)
                                {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}@if (!$loop->last), @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @empty
            @endforelse
            @if ($availability->isEmpty())
                <div class="empty">No availability slots set.</div>
            @endif
        </div>
    </div>
</div>

@endsection
