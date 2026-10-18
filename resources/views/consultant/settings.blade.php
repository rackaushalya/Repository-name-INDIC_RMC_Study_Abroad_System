@extends('layouts.consultant')

@section('title', 'Settings')

@php
    $u = $consultant->user;
    $fullName = trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Consultant';
@endphp

@section('content')

<div class="page-header">
    <div>
        <h1>Settings</h1>
        <p>Your consultant profile details.</p>
    </div>
</div>

<div class="panel">
    <div class="panel-header">
        <div class="panel-title">Profile</div>
    </div>

    <dl class="detail-grid">
        <div><dt>Name</dt><dd>{{ $fullName }}</dd></div>
        <div><dt>Email</dt><dd>{{ $u->email ?? '-' }}</dd></div>
        <div><dt>Phone</dt><dd>{{ $u->phone ?? '-' }}</dd></div>
        <div><dt>Employee code</dt><dd>{{ $consultant->employee_code }}</dd></div>
        <div><dt>Specialization</dt><dd>{{ $consultant->specialization ?? '-' }}</dd></div>
        <div><dt>Years of experience</dt><dd>{{ $consultant->years_of_experience ?? '0' }}</dd></div>
        <div><dt>Status</dt><dd>@include('consultant.partials.status-badge', ['status' => $consultant->consultant_status])</dd></div>
    </dl>

    @if ($consultant->bio)
        <div style="margin-top:18px">
            <div class="muted">Bio</div>
            <div class="prose">{{ $consultant->bio }}</div>
        </div>
    @endif

    <p class="muted" style="margin-top:20px">
        To update these details, contact an administrator.
    </p>
</div>

@endsection
