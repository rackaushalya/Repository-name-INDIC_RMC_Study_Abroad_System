html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Logs | INDIC RMC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
            color: #253047;
        }

        .page {
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .subtitle {
            color: #718096;
            margin: 0;
        }

        .panel {
            background: #fff;
            border: 1px solid #e5eaf2;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(30, 50, 80, 0.04);
        }

        .table thead th {
            background: #f0f4fa;
            color: #536179;
            font-size: 12px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
            font-size: 13px;
        }

        .action-badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: #e8efff;
            color: #315acb;
            font-size: 12px;
            font-weight: 600;
        }

        .muted {
            color: #718096;
        }

        .pagination {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .page {
                padding: 15px;
            }

            .panel {
                padding: 12px;
            }
        }
    </style>
</head>
<body>

<div class="page">
    <div class="page-header">
        <div>
            <h1>Audit Logs</h1>
            <p class="subtitle">
                Monitor recorded activities and changes within INDIC RMC.
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-outline-secondary">
            Back to Dashboard
        </a>
    </div>

    <div class="panel">
        <form method="GET"
              action="{{ route('admin.audit-logs.index') }}"
              class="row g-2 mb-4">

            <div class="col-md-6">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search action, table, record ID or user ID..."
                    value="{{ request('search') }}"
                >
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    Search
                </button>
            </div>

            @if(request()->filled('search'))
                <div class="col-auto">
                    <a href="{{ route('admin.audit-logs.index') }}"
                       class="btn btn-outline-secondary">
                        Clear
                    </a>
                </div>
            @endif
        </form>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h6 mb-0">Activity History</h2>
            <span class="muted small">
                {{ $auditLogs->total() }} records
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date &amp; Time</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Table</th>
                        <th>Record ID</th>
                        <th>IP Address</th>
                        <th>Changes</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($auditLogs as $log)
                        <tr>
                            <td>{{ $log->audit_id }}</td>

                            <td>
                                {{ $log->created_at
                                    ? $log->created_at->format('d M Y, h:i A')
                                    : 'N/A' }}
                            </td>

                            <td>
                                @if($log->user)
                                    {{ $log->user->name
                                        ?? $log->user->email
                                        ?? 'User #'.$log->user_id }}
                                @else
                                    {{ $log->user_id
                                        ? 'User #'.$log->user_id
                                        : 'System / Deleted User' }}
                                @endif
                            </td>

                            <td>
                                <span class="action-badge">
                                    {{ $log->action }}
                                </span>
                            </td>

                            <td>{{ $log->table_name ?? '—' }}</td>
                            <td>{{ $log->record_id ?? '—' }}</td>
                            <td>{{ $log->ip_address ?? '—' }}</td>

                            <td>
                                <details>
                                    <summary>View</summary>

                                    <div class="mt-2">
                                        <strong>Old values</strong>
                                        <pre class="small text-wrap">{{ $log->old_values ? json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : 'No previous values' }}</pre>

                                        <strong>New values</strong>
                                        <pre class="small text-wrap">{{ $log->new_values ? json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : 'No new values' }}</pre>

                                        <strong>User agent</strong>
                                        <p class="small text-break">{{ $log->user_agent ?? '—' }}</p>
                                    </div>
                                </details>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <h3 class="h6">No audit logs found</h3>
                                <p class="muted mb-0">
                                    Recorded activities will appear here.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $auditLogs->links() }}
        </div>
    </div>
</div>

</body>
</html>