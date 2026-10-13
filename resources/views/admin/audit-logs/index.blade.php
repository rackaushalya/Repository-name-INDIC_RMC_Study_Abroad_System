<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Audit Logs | INDIC RMC</title>

    @include('components.page-style')

    <style>
        .al-json {
            margin: 0 0 10px;
            padding: 10px 12px;
            background: #0f172a;
            color: #e2e8f0;
            border-radius: 8px;
            font-size: 11px;
            line-height: 1.5;
            max-height: 220px;
            overflow: auto;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .al-detail-row td { background: #fafbfc; padding: 18px 24px; }
        .al-detail-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
        .al-detail-grid h4 { margin: 0 0 6px; font-size: 11px; text-transform: uppercase; letter-spacing: .5px; color: #727c8d; }
        .al-agent { font-size: 11px; color: #727c8d; word-break: break-word; margin-top: 4px; }
        .al-toggle { cursor: pointer; }
        .al-toggle.open i { transform: rotate(180deg); }
        .al-toggle i { transition: transform .2s; }

        @media (max-width: 760px) { .al-detail-grid { grid-template-columns: 1fr; } }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.admin-sidebar')

@php
    $badgeFor = function (string $action): string {
        $a = strtolower($action);

        return match (true) {
            str_contains($a, 'delete'), str_contains($a, 'remove'), str_contains($a, 'fail') => 'red',
            str_contains($a, 'login'), str_contains($a, 'logout'), str_contains($a, 'register') => 'purple',
            str_contains($a, 'create'), str_contains($a, 'generat'), str_contains($a, 'add') => 'green',
            str_contains($a, 'update'), str_contains($a, 'edit'), str_contains($a, 'status') => 'amber',
            str_contains($a, 'download'), str_contains($a, 'view') => 'blue',
            default => 'orange',
        };
    };

    $filtering = request()->hasAny(['search', 'action', 'from', 'to']);
@endphp

<main class="main">

    <x-admin-topbar current="Audit Logs" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Audit Logs</h1>
                <p>Monitor recorded activities and changes within INDIC RMC.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('admin.dashboard') }}" class="pg-btn">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
            </div>
        </div>

        <div class="pg-stats">
            <div class="pg-stat">
                <div class="pg-stat-icon"><i class="bi bi-journal-text"></i></div>
                <div><span>Total Records</span><strong>{{ number_format($stats['total']) }}</strong></div>
            </div>

            <div class="pg-stat">
                <div class="pg-stat-icon blue"><i class="bi bi-calendar-day"></i></div>
                <div><span>Activity Today</span><strong>{{ number_format($stats['today']) }}</strong></div>
            </div>

            <div class="pg-stat">
                <div class="pg-stat-icon green"><i class="bi bi-people"></i></div>
                <div><span>Active Users</span><strong>{{ number_format($stats['users']) }}</strong></div>
            </div>
        </div>

        <div class="pg-card">

            <form method="GET" action="{{ route('admin.audit-logs.index') }}" class="pg-toolbar">

                <div class="pg-search">
                    <i class="bi bi-search"></i>
                    <input type="text"
                           name="search"
                           placeholder="Search action, table, record ID or user..."
                           value="{{ request('search') }}">
                </div>

                <select name="action" title="Filter by action">
                    <option value="">All actions</option>
                    @foreach ($actions as $action)
                        <option value="{{ $action }}" @selected(request('action') === $action)>{{ $action }}</option>
                    @endforeach
                </select>

                <input type="date" name="from" value="{{ request('from') }}" title="From date">
                <input type="date" name="to" value="{{ request('to') }}" title="To date">

                <button type="submit" class="pg-btn pg-btn-dark">
                    <i class="bi bi-funnel"></i> Filter
                </button>

                @if ($filtering)
                    <a href="{{ route('admin.audit-logs.index') }}" class="pg-btn">Clear</a>
                @endif
            </form>

            <div class="pg-card-head" style="border-bottom:0;">
                <h2><i class="bi bi-clock-history"></i> Activity History</h2>
                <small>{{ number_format($auditLogs->total()) }} {{ \Illuminate\Support\Str::plural('record', $auditLogs->total()) }}</small>
            </div>

            <div class="pg-table-wrap">
                <table class="pg-table" style="min-width:900px;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date &amp; Time</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Record</th>
                            <th>IP Address</th>
                            <th style="text-align:right;">Changes</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($auditLogs as $log)
                            @php
                                $fullName = $log->user
                                    ? trim(($log->user->first_name ?? '') . ' ' . ($log->user->last_name ?? ''))
                                    : '';
                            @endphp

                            <tr>
                                <td class="pg-muted">#{{ $log->audit_id }}</td>

                                <td>
                                    @if ($log->created_at)
                                        <div class="pg-strong">{{ $log->created_at->format('d M Y') }}</div>
                                        <span class="pg-sub">{{ $log->created_at->format('h:i A') }} · {{ $log->created_at->diffForHumans() }}</span>
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td>
                                    @if ($log->user)
                                        <div class="pg-person">
                                            <div class="pg-person-avatar">{{ strtoupper(substr($fullName ?: ($log->user->email ?? 'U'), 0, 1)) }}</div>
                                            <div>
                                                <div class="pg-strong">{{ $fullName ?: 'User #' . $log->user_id }}</div>
                                                <span class="pg-sub">{{ $log->user->email ?? '' }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <span class="pg-muted">
                                            {{ $log->user_id ? 'User #' . $log->user_id . ' (removed)' : 'System' }}
                                        </span>
                                    @endif
                                </td>

                                <td><span class="pg-badge {{ $badgeFor($log->action) }}">{{ $log->action }}</span></td>

                                <td>
                                    <div class="pg-strong">{{ $log->table_name ?? '—' }}</div>
                                    <span class="pg-sub">{{ $log->record_id ? 'ID ' . $log->record_id : '' }}</span>
                                </td>

                                <td class="pg-muted">{{ $log->ip_address ?? '—' }}</td>

                                <td style="text-align:right;">
                                    <button type="button"
                                            class="pg-btn pg-btn-sm al-toggle"
                                            data-target="al-detail-{{ $log->audit_id }}">
                                        Details <i class="bi bi-chevron-down"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr class="al-detail-row" id="al-detail-{{ $log->audit_id }}" hidden>
                                <td colspan="7">
                                    <div class="al-detail-grid">
                                        <div>
                                            <h4>Old values</h4>
                                            <pre class="al-json">{{ $log->old_values ? json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : 'No previous values' }}</pre>
                                        </div>

                                        <div>
                                            <h4>New values</h4>
                                            <pre class="al-json">{{ $log->new_values ? json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : 'No new values' }}</pre>
                                        </div>
                                    </div>

                                    <div class="al-agent"><strong>User agent:</strong> {{ $log->user_agent ?? '—' }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="pg-empty">
                                        <div class="pg-empty-icon"><i class="bi bi-shield-check"></i></div>
                                        <h3>No audit logs found</h3>
                                        <p>
                                            {{ $filtering ? 'No records match your filters. Try clearing them.' : 'Recorded activities will appear here.' }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($auditLogs->hasPages())
                <div class="pg-pagination">
                    {{ $auditLogs->links('pagination.portal') }}
                </div>
            @endif

        </div>

    </section>
</main>

<script>
    document.querySelectorAll('.al-toggle').forEach(function (button) {
        button.addEventListener('click', function () {
            const row = document.getElementById(button.dataset.target);
            row.hidden = !row.hidden;
            button.classList.toggle('open', !row.hidden);
        });
    });
</script>

</body>
</html>
