@extends('layouts.consultant')

@section('title', 'Follow-ups')

@section('content')

<div class="page-header">
    <div>
        <h1>Follow-ups</h1>
        <p>Scheduled check-ins and outstanding actions for your students.</p>
    </div>
</div>

<div class="panel">
    <div class="table-wrap">
        <table class="tbl">
            <thead>
                <tr><th>Date</th><th>Student</th><th>Application</th><th>Type</th><th>Notes</th><th>Status</th></tr>
            </thead>
            <tbody>
            @forelse ($followUps as $f)
                @php $u = $f->application?->student?->user; @endphp
                <tr>
                    <td class="strong">{{ $f->follow_up_date?->format('d M Y') }}</td>
                    <td>
                        {{ trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student' }}
                    </td>
                    <td class="muted">{{ $f->application->application_reference ?? '-' }}</td>
                    <td>{{ $f->follow_up_type }}</td>
                    <td class="muted">{{ \Illuminate\Support\Str::limit($f->notes, 60) ?: '-' }}</td>
                    <td>@include('consultant.partials.status-badge', ['status' => $f->follow_up_status])</td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">No follow-ups scheduled.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pager">{{ $followUps->links('pagination.portal') }}</div>
</div>

@endsection
