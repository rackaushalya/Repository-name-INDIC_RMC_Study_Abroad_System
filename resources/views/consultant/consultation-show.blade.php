@extends('layouts.consultant')

@section('title', 'Consultation Record')

@php
    $u = $record->student?->user;
    $fullName = trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student';
    $ap = $record->appointment;
    $app = $ap?->application;
@endphp

@section('content')

<div class="page-header">
    <div>
        <h1>Consultation Record</h1>
        <p>{{ $fullName }} · {{ $ap?->appointment_date?->format('d M Y') }}</p>
    </div>
    <div style="display:flex;gap:8px">
        <a class="btn btn-light" href="{{ route('consultant.consultations') }}">← Back</a>
        <a class="btn" href="{{ route('consultant.consultations.edit', $record->consultation_record_id) }}">Edit</a>
    </div>
</div>

<div class="stack">
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Session</div>
            @include('consultant.partials.status-badge', ['status' => $record->consultation_status])
        </div>
        <dl class="detail-grid">
            <div><dt>Student</dt><dd>{{ $fullName }}</dd></div>
            <div><dt>Date</dt><dd>{{ $ap?->appointment_date?->format('d M Y') }}</dd></div>
            <div><dt>Time</dt><dd>{{ $ap ? \Carbon\Carbon::parse($ap->start_time)->format('h:i A') . ' – ' . \Carbon\Carbon::parse($ap->end_time)->format('h:i A') : '-' }}</dd></div>
            <div><dt>Type</dt><dd>{{ $ap->appointment_type ?? '-' }}</dd></div>
            <div><dt>Application</dt><dd>{{ $app->application_reference ?? '-' }}</dd></div>
            <div><dt>Destination</dt><dd>{{ $app->preferredCountry->country_name ?? '-' }}</dd></div>
        </dl>
    </div>

    <div class="panel"><div class="panel-header"><div class="panel-title">Summary</div></div><div class="prose">{{ $record->consultation_summary }}</div></div>

    @if ($record->consultation_notes)
        <div class="panel"><div class="panel-header"><div class="panel-title">Detailed notes</div></div><div class="prose">{{ $record->consultation_notes }}</div></div>
    @endif
    @if ($record->recommendations)
        <div class="panel"><div class="panel-header"><div class="panel-title">Recommendations</div></div><div class="prose">{{ $record->recommendations }}</div></div>
    @endif
    @if ($record->next_action)
        <div class="panel"><div class="panel-header"><div class="panel-title">Next action</div></div><div class="prose">{{ $record->next_action }}</div></div>
    @endif
</div>
@endsection
