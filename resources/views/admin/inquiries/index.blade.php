<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Inquiries</title>

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI",
                         Roboto, Arial, sans-serif;
            background: #f7f8fa;
            color: #172033;
        }

        a { text-decoration: none; color: inherit; }

        .app { display: flex; min-height: 100vh; }

        .sidebar {
            width: 250px;
            background: #111827;
            color: #ffffff;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            overflow-y: auto;
            z-index: 100;
        }

        .brand {
            height: 76px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid #252d3b;
        }

        .brand-mark {
            width: 38px; height: 38px;
            border-radius: 8px;
            background: #f58220;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
            margin-right: 11px;
        }

        .brand-name { font-size: 17px; font-weight: 700; letter-spacing: -.3px; }
        .brand-subtitle { font-size: 10px; color: #8c96a8; margin-top: 2px; }

        .nav { padding: 20px 12px; }

        .nav-section {
            font-size: 10px; text-transform: uppercase;
            color: #697386; font-weight: 700; letter-spacing: .8px;
            padding: 0 12px; margin: 18px 0 8px;
        }

        .nav-section:first-child { margin-top: 0; }

        .nav-link {
            height: 42px; display: flex; align-items: center; gap: 12px;
            padding: 0 12px; border-radius: 7px;
            color: #b9c0cc; font-size: 13px; margin-bottom: 3px;
            transition: all .2s ease;
        }

        .nav-link:hover { background: #1c2534; color: #ffffff; }
        .nav-link.active { background: #f58220; color: #ffffff; }
        .nav-icon { width: 18px; height: 18px; flex-shrink: 0; }

        .main { margin-left: 250px; width: calc(100% - 250px); min-height: 100vh; }

        .topbar {
            height: 76px; background: #ffffff;
            border-bottom: 1px solid #e7e9ee;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 30px;
        }

        .profile { display: flex; align-items: center; gap: 10px; padding-left: 18px; border-left: 1px solid #e5e7eb; }
        .profile-avatar { width: 36px; height: 36px; border-radius: 50%; background: #f58220; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; }
        .profile-name { font-size: 12px; font-weight: 600; }
        .profile-role { font-size: 10px; color: #8a93a3; margin-top: 2px; }

        .content { padding: 28px 30px 40px; }

        .page-header {
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: 24px;
        }

        .page-header h1 { font-size: 23px; font-weight: 700; color: #111827; letter-spacing: -.4px; }
        .page-header p { margin-top: 5px; font-size: 12px; color: #737d8e; }

        .btn-primary {
            background: #f58220; color: #fff; border: none;
            padding: 11px 18px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer;
        }

        .btn-primary:hover { background: #de7213; }

        .alert-success {
            background: #edf8f2; color: #32815a;
            border: 1px solid #c9ead9; border-radius: 7px;
            padding: 12px 16px; font-size: 12px; margin-bottom: 18px;
        }

        .alert-error {
            background: #fdecec; color: #c0392b;
            border: 1px solid #f5c6c6; border-radius: 7px;
            padding: 12px 16px; font-size: 12px; margin-bottom: 18px;
        }

        .panel { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 20px; }

        .table-container { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        th {
            text-align: left; padding: 10px 8px;
            border-bottom: 1px solid #e7e9ed;
            color: #8a93a3; font-size: 9px;
            text-transform: uppercase; letter-spacing: .5px; font-weight: 600;
        }

        td {
            padding: 13px 8px; border-bottom: 1px solid #f0f1f3;
            font-size: 11px; color: #4b5565;
        }

        td:first-child { color: #172033; font-weight: 600; }

        .badge { display: inline-block; padding: 5px 8px; border-radius: 5px; font-size: 9px; font-weight: 600; }
        .badge-blue { background: #edf3ff; color: #416dc0; }
        .badge-orange { background: #fff2e8; color: #d9650b; }
        .badge-green { background: #edf8f2; color: #32815a; }
        .badge-gray { background: #f0f1f3; color: #697386; }

        .row-actions { display: flex; gap: 8px; }
        .row-actions a { font-size: 10px; font-weight: 600; color: #f58220; }
        .row-actions button { background: none; border: none; color: #c0392b; font-size: 10px; font-weight: 600; cursor: pointer; padding: 0; }

        .empty-state { text-align: center; padding: 40px 0; color: #8a93a3; font-size: 12px; }

        .pagination-wrap { margin-top: 18px; }

    </style>

</head>
<body>

<div class="app">

    <aside class="sidebar">

        <div class="brand">
            <div class="brand-mark">IR</div>
            <div>
                <div class="brand-name">INDIC RMC</div>
                <div class="brand-subtitle">Administration Portal</div>
            </div>
        </div>

        <nav class="nav">

            <div class="nav-section">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <div class="nav-section">CRM &amp; Intelligence</div>

            <a href="{{ route('admin.leads.index') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M3 12h18"/>
                </svg>
                <span>Leads</span>
            </a>

            <a href="{{ route('admin.inquiries.index') }}" class="nav-link active">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 19V5"/>
                </svg>
                <span>Inquiries</span>
            </a>

        </nav>

    </aside>

    <main class="main">

        <header class="topbar">
            <div></div>
            <div class="profile">
                <div class="profile-avatar">A</div>
                <div>
                    <div class="profile-name">Admin User</div>
                    <div class="profile-role">Administrator</div>
                </div>
            </div>
        </header>

        <section class="content">

            <div class="page-header">
                <div>
                    <h1>Inquiries</h1>
                    <p>Specific questions and requests tied to leads or students.</p>
                </div>
                <a href="{{ route('admin.inquiries.create') }}" class="btn-primary">+ Add Inquiry</a>
            </div>

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @error('lead_id')
                <div class="alert-error">{{ $message }}</div>
            @enderror

            <div class="panel">

                <div class="table-container">

                    <table>
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>From</th>
                                <th>Status</th>
                                <th>Consultant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($inquiries as $inquiry)
                                <tr>
                                    <td>{{ $inquiry->inquiry_subject }}</td>
                                    <td>
                                        @if ($inquiry->lead)
                                            {{ $inquiry->lead->first_name }} {{ $inquiry->lead->last_name }} (Lead)
                                        @elseif ($inquiry->student)
                                            {{ $inquiry->student->user->name ?? 'Student #' . $inquiry->student_id }} (Student)
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = match($inquiry->inquiry_status) {
                                                'New' => 'badge-blue',
                                                'In Progress' => 'badge-orange',
                                                'Resolved' => 'badge-green',
                                                'Closed' => 'badge-gray',
                                                default => 'badge-gray',
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $inquiry->inquiry_status }}</span>
                                    </td>
                                    <td>{{ $inquiry->assignedConsultant->user->name ?? '—' }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <a href="{{ route('admin.inquiries.edit', $inquiry->inquiry_id) }}">Edit</a>
                                            <form action="{{ route('admin.inquiries.destroy', $inquiry->inquiry_id) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-state">No inquiries yet. Click "Add Inquiry" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <div class="pagination-wrap">
                    {{ $inquiries->links() }}
                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>