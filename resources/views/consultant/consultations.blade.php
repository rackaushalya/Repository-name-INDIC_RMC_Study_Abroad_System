@extends('layouts.consultant')

@section('title', 'Consultations')

@section('content')

<div class="page-header">
    <div>
        <h1>Consultations</h1>
        <p>Record what was discussed, recommendations and next steps for each session.</p>
    </div>
    <div class="date">{{ $records->total() }} records</div>
</div>

<div class="stack">

    @if ($awaiting->isNotEmpty())
    <div class="panel" style="border-color:#f8d2b0;background:#fffaf5">
        <div class="panel-header"><div class="panel-title">Sessions awaiting notes ({{ $awaiting->count() }})</div></div>
        @foreach ($awaiting as $ap)
            @php $u = $ap->student?->user; @endphp
            <div class="agenda-item">
                <div class="agenda-time">{{ $ap->appointment_date->format('d M Y') }}<br><span class="muted">{{ \Carbon\Carbon::parse($ap->start_time)->format('h:i A') }}</span></div>
                <div style="flex:1">
                    <div class="strong">{{ trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student' }}</div>
                    <div class="muted">{{ $ap->appointment_type }} · {{ $ap->appointment_status }}</div>
                </div>
                <a class="btn btn-sm" href="{{ route('consultant.consultations.create', $ap->appointment_id) }}">Add notes</a>
            </div>
        @endforeach
    </div>
    @endif

    <div class="panel">
        <form class="toolbar" method="GET" action="{{ route('consultant.consultations') }}">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Student name">
            <select name="status">
                <option value="">Any outcome</option>
                @foreach (['Completed', 'Follow-up Required', 'Closed'] as $s)
                    <option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }}</option>
                @endforeach
            </select>
            <button class="btn" type="submit">Filter</button>
            @if (request()->hasAny(['q', 'status']))
                <a class="btn btn-light" href="{{ route('consultant.consultations') }}">Clear</a>
            @endif
        </form>

        <div class="table-wrap">
            <table class="tbl">
                <thead><tr><th>Session</th><th>Student</th><th>Summary</th><th>Next action</th><th>Outcome</th><th></th></tr></thead>
                <tbody>
                @forelse ($records as $r)
                    @php $u = $r->student?->user; @endphp
                    <tr>
                        <td>{{ $r->appointment?->appointment_date?->format('d M Y') ?? '-' }}</td>
                        <td class="strong">{{ trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: 'Student' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($r->consultation_summary, 80) }}</td>
                        <td class="muted">{{ \Illuminate\Support\Str::limit($r->next_action, 50) ?: '—' }}</td>
                        <td>@include('consultant.partials.status-badge', ['status' => $r->consultation_status])</td>
                        <td style="white-space:nowrap">
                            <a class="btn btn-light btn-sm" href="{{ route('consultant.consultations.show', $r->consultation_record_id) }}">View</a>
                            <a class="btn btn-light btn-sm" href="{{ route('consultant.consultations.edit', $r->consultation_record_id) }}">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty">No consultation records yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pager">{{ $records->links('pagination.portal') }}</div>
    </div>
</div>

@endsection
