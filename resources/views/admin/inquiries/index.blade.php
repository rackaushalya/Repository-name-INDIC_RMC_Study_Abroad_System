<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Inquiries</title>

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
        .row-actions a { font-size: 10px; font-weight: 600; color: #f97316; }
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