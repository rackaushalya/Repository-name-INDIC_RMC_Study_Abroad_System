@extends('layouts.consultant')

@section('title', 'Assigned Students')

@section('content')

<div class="page-header">
    <div>
        <h1>Assigned Students</h1>
        <p>Students and applications assigned to you by the admin team.</p>
    </div>
    <div class="date">{{ $assignments->total() }} total</div>
</div>

<div class="panel">

    <form class="toolbar" method="GET" action="{{ route('consultant.students') }}">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name, email or reference">
        <select name="status">
            <option value="">All assignments</option>
            @foreach (['Active', 'Completed', 'Cancelled'] as $s)
                <option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }}</option>
            @endforeach
        </select>
        <select name="stage">
            <option value="">All application stages</option>
            @foreach ($stages as $s)
                <option value="{{ $s }}" @selected(request('stage') === $s)>{{ $s }}</option>
            @endforeach
        </select>
        <button class="btn" type="submit">Filter</button>
        @if (request()->hasAny(['q', 'status', 'stage']))
            <a class="btn btn-light" href="{{ route('consultant.students') }}">Clear</a>
        @endif
    </form>

    <div class="table-wrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Application</th>
                    <th>Destination / Course</th>
                    <th>Stage</th>
                    <th>Assignment</th>
                    <th>Assigned</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @forelse ($assignments as $a)
                @php
                    $app = $a->application;
                    $u = $app?->student?->user;
                @endphp
                <tr>
                    <td>
                        <div class="strong">{{ trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student' }}</div>
                        <div class="muted">{{ $u->email ?? '' }}</div>
                    </td>
                    <td>{{ $app->application_reference ?? '-' }}<div class="muted">{{ $app->application_type ?? '' }}</div></td>
                    <td>
                        {{ $app?->preferredCountry?->country_name ?? '-' }}
                        <div class="muted">{{ $app?->preferredCourse?->course_name ?? '' }}</div>
                    </td>
                    <td>@include('consultant.partials.status-badge', ['status' => $app->application_status ?? null])</td>
                    <td>@include('consultant.partials.status-badge', ['status' => $a->assignment_status])</td>
                    <td class="muted">{{ $a->assigned_at?->format('d M Y') }}</td>
                    <td><a class="btn btn-light btn-sm" href="{{ route('consultant.students.show', $a->assignment_id) }}">Open</a></td>
                </tr>
            @empty
                <tr><td colspan="7" class="empty">No assigned students match your filters.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pager">{{ $assignments->links('pagination.portal') }}</div>
</div>

@endsection
