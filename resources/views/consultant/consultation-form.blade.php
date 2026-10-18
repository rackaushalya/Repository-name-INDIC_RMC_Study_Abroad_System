@extends('layouts.consultant')

@section('title', $record ? 'Edit Consultation' : 'New Consultation')

@php
    $u = $appointment->student?->user;
    $fullName = trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student';
    $app = $appointment->application;
    $action = $record
        ? route('consultant.consultations.update', $record->consultation_record_id)
        : route('consultant.consultations.store', $appointment->appointment_id);
@endphp

@section('content')

<div class="page-header">
    <div>
        <h1>{{ $record ? 'Edit' : 'Record' }} Consultation</h1>
        <p>{{ $fullName }} · {{ $appointment->appointment_date->format('d M Y') }}, {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} ({{ $appointment->appointment_type }})</p>
    </div>
    <a class="btn btn-light" href="{{ route('consultant.consultations') }}">← Back</a>
</div>

<div class="stack">

    @if ($app)
    <div class="panel">
        <div class="panel-header"><div class="panel-title">Application context</div></div>
        <dl class="detail-grid">
            <div><dt>Reference</dt><dd>{{ $app->application_reference }}</dd></div>
            <div><dt>Destination</dt><dd>{{ $app->preferredCountry->country_name ?? '-' }}</dd></div>
            <div><dt>Course</dt><dd>{{ $app->preferredCourse->course_name ?? '-' }}</dd></div>
        </dl>
        @if ($appointment->student_notes)
            <div style="margin-top:14px"><div class="muted">Student's note for this appointment</div><div class="prose">{{ $appointment->student_notes }}</div></div>
        @endif
    </div>
    @endif

    <form class="panel" method="POST" action="{{ $action }}">
        @csrf
        @if ($record) @method('PUT') @endif

        <div class="form-grid">
            <div class="field full">
                <label for="consultation_summary">Summary of consultation *</label>
                <textarea id="consultation_summary" name="consultation_summary" rows="4" required maxlength="5000">{{ old('consultation_summary', $record->consultation_summary ?? '') }}</textarea>
            </div>
            <div class="field full">
                <label for="consultation_notes">Detailed notes (private to consultants)</label>
                <textarea id="consultation_notes" name="consultation_notes" rows="5" maxlength="10000">{{ old('consultation_notes', $record->consultation_notes ?? '') }}</textarea>
            </div>
            <div class="field full">
                <label for="recommendations">Recommendations for the student</label>
                <textarea id="recommendations" name="recommendations" rows="4" maxlength="10000">{{ old('recommendations', $record->recommendations ?? '') }}</textarea>
            </div>
            <div class="field full">
                <label for="next_action">Next action</label>
                <textarea id="next_action" name="next_action" rows="2" maxlength="5000">{{ old('next_action', $record->next_action ?? '') }}</textarea>
            </div>
            <div class="field">
                <label for="consultation_status">Outcome *</label>
                <select id="consultation_status" name="consultation_status" required style="width:100%">
                    @foreach (['Completed', 'Follow-up Required', 'Closed'] as $s)
                        <option value="{{ $s }}" @selected(old('consultation_status', $record->consultation_status ?? 'Completed') === $s)>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="margin-top:20px;display:flex;gap:10px">
            <button class="btn" type="submit">{{ $record ? 'Save changes' : 'Save consultation' }}</button>
            <a class="btn btn-light" href="{{ route('consultant.consultations') }}">Cancel</a>
        </div>

        @unless ($record)
            <p class="muted" style="margin-top:12px">Saving marks this appointment as Completed, updates the application stage and notifies the student.</p>
        @endunless
    </form>
</div>
@endsection
