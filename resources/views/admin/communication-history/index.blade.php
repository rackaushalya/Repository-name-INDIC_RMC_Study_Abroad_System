<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Communication History</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a { text-decoration: none; color: inherit; }

        .app { display: flex; min-height: 100vh; }

        .main {
            margin-left: 245px;
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e6e9ef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .search-box {
            width: 330px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 11px 15px 11px 40px;
            border: 1px solid #dce1e8;
            border-radius: 7px;
            outline: none;
            font-size: 13px;
            background: #f8fafc;
        }

        .search-box input:focus {
            border-color: #f97316;
            background: white;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 11px;
            color: #8a94a6;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f97316;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 13px;
        }

        .profile-info strong {
            display: block;
            font-size: 13px;
        }

        .profile-info span {
            display: block;
            font-size: 11px;
            color: #8a94a6;
            margin-top: 3px;
        }

        .content { padding: 28px 30px 40px; }

        .page-header {
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: 24px;
        }

        .page-header h1 { font-size: 23px; font-weight: 700; color: #111827; letter-spacing: -.4px; }
        .page-header p { margin-top: 5px; font-size: 12px; color: #737d8e; }

        .btn-primary {
            background: #f97316; color: #fff; border: none;
            padding: 11px 18px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer;
        }

        .btn-primary:hover { background: #e07116; }

        .alert-success {
            background: #edf8f2; color: #32815a;
            border: 1px solid #c9ead9; border-radius: 7px;
            padding: 12px 16px; font-size: 12px; margin-bottom: 18px;
        }

        .panel { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 20px; }

        .filter-bar {
            display: flex; gap: 10px; margin-bottom: 18px; flex-wrap: wrap;
        }

        .filter-bar select {
            padding: 9px 12px; border: 1px solid #dce1e8; border-radius: 7px;
            font-size: 12px; background: #f8fafc; color: #4b5565;
        }

        .filter-bar button {
            padding: 9px 16px; border: 1px solid #dce1e8; border-radius: 7px;
            background: white; font-size: 12px; font-weight: 600; color: #4b5565; cursor: pointer;
        }

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
        .badge-orange { background: #fff2e8; color: #d9650b; }
        .badge-blue { background: #edf3ff; color: #416dc0; }
        .badge-green { background: #edf8f2; color: #32815a; }
        .badge-gray { background: #f0f1f3; color: #697386; }

        .row-actions { display: flex; gap: 8px; }
        .row-actions button { background: none; border: none; color: #c0392b; font-size: 10px; font-weight: 600; cursor: pointer; padding: 0; }

        .empty-state { text-align: center; padding: 40px 0; color: #8a93a3; font-size: 12px; }

        .pagination-wrap { margin-top: 18px; }

        @media (max-width: 750px) {

            .main {
                margin-left: 70px;
            }

            .topbar {
                padding: 0 15px;
            }

            .search-box {
                width: 200px;
            }
        }

    </style>

@include('components.sidebar-style')
</head>
<body>

<div class="app">

    @include('components.admin-sidebar')

    <main class="main">

        <header class="topbar">

            <div class="search-box">
                <span class="search-icon"><i class="bi bi-search"></i></span>
                <input type="text" placeholder="Search students, applications...">
            </div>

            <div class="admin-profile">
                <div class="profile-circle">
                    {{ strtoupper(substr(auth()->user()->first_name ?? 'A', 0, 1)) }}
                </div>
                <div class="profile-info">
                    <strong>{{ auth()->user()->first_name ?? 'Admin' }} {{ auth()->user()->last_name ?? 'User' }}</strong>
                    <span>Administrator</span>
                </div>
            </div>

        </header>

        <section class="content">

            <div class="page-header">
                <div>
                    <h1>Communication History</h1>
                    <p>Every call, email, message, and note logged against a lead or inquiry.</p>
                </div>
                <a href="{{ route('admin.communication-history.create') }}" class="btn-primary">+ Log Communication</a>
            </div>

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="panel">

                <form method="GET" action="{{ route('admin.communication-history.index') }}" class="filter-bar">

                    <select name="lead_id" onchange="this.form.submit()">
                        <option value="">All Leads</option>
                        @foreach ($leads as $lead)
                            <option value="{{ $lead->lead_id }}" {{ request('lead_id') == $lead->lead_id ? 'selected' : '' }}>
                                {{ $lead->first_name }} {{ $lead->last_name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="inquiry_id" onchange="this.form.submit()">
                        <option value="">All Inquiries</option>
                        @foreach ($inquiries as $inquiry)
                            <option value="{{ $inquiry->inquiry_id }}" {{ request('inquiry_id') == $inquiry->inquiry_id ? 'selected' : '' }}>
                                #{{ $inquiry->inquiry_id }} — {{ $inquiry->inquiry_subject }}
                            </option>
                        @endforeach
                    </select>

                    <select name="communication_type" onchange="this.form.submit()">
                        <option value="">All Types</option>
                        @foreach (['Message', 'Email', 'Phone', 'Note'] as $type)
                            <option value="{{ $type }}" {{ request('communication_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>

                    @if (request('lead_id') || request('inquiry_id') || request('communication_type'))
                        <a href="{{ route('admin.communication-history.index') }}" style="align-self: center; font-size: 11px; color: #f97316; font-weight: 600;">Clear filters</a>
                    @endif

                </form>

                <div class="table-container">

                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Related To</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Logged By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($history as $entry)
                                <tr>
                                    <td>{{ $entry->created_at?->format('d M Y, h:i A') }}</td>
                                    <td>
                                        @php
                                            $typeClass = match($entry->communication_type) {
                                                'Email' => 'badge-blue',
                                                'Phone' => 'badge-green',
                                                'Message' => 'badge-orange',
                                                'Note' => 'badge-gray',
                                                default => 'badge-gray',
                                            };
                                        @endphp
                                        <span class="badge {{ $typeClass }}">{{ $entry->communication_type }}</span>
                                    </td>
                                    <td>
                                        @if ($entry->lead)
                                            Lead: {{ $entry->lead->first_name }} {{ $entry->lead->last_name }}
                                        @elseif ($entry->inquiry)
                                            Inquiry #{{ $entry->inquiry->inquiry_id }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>{{ $entry->subject ?? '—' }}</td>
                                    <td style="max-width: 280px;">{{ \Illuminate\Support\Str::limit($entry->message, 80) }}</td>
                                    <td>{{ $entry->sender->first_name ?? '—' }} {{ $entry->sender->last_name ?? '' }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <form action="{{ route('admin.communication-history.destroy', $entry->communication_id) }}" method="POST" onsubmit="return confirm('Delete this entry?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="empty-state">No communication logged yet. Click "Log Communication" to add one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <div class="pagination-wrap">
                    {{ $history->links() }}
                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>
