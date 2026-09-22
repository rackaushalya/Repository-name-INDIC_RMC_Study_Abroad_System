<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Leads</title>

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

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 245px;
            height: 100vh;
            background: #101a2b;
            color: white;
            padding: 25px 15px;
            overflow-y: auto;
        }

        .logo {
            padding: 0 12px;
            margin-bottom: 35px;
        }

        .logo-main {
            font-size: 25px;
            font-weight: 700;
            color: #f97316;
        }

        .logo-main span {
            color: white;
        }

        .logo-subtitle {
            font-size: 8px;
            letter-spacing: 0.8px;
            color: #aeb7c7;
            margin-top: 4px;
        }

        .menu-section {
            margin-bottom: 25px;
        }

        .menu-title {
            color: #7e8ba1;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 12px 10px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            margin-bottom: 4px;
            border-radius: 7px;
            color: #cbd3df;
            font-size: 13px;
            transition: 0.2s;
        }

        .menu-item:hover {
            background: #1d2a40;
            color: white;
        }

        .menu-item.active {
            background: #f97316;
            color: white;
        }

        .menu-icon {
            width: 19px;
            height: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

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
        .badge-red { background: #fdecec; color: #c0392b; }

        .row-actions { display: flex; gap: 8px; }
        .row-actions a { font-size: 10px; font-weight: 600; color: #f97316; }
        .row-actions button { background: none; border: none; color: #c0392b; font-size: 10px; font-weight: 600; cursor: pointer; padding: 0; }

        .empty-state { text-align: center; padding: 40px 0; color: #8a93a3; font-size: 12px; }

        .pagination-wrap { margin-top: 18px; }

        @media (max-width: 750px) {
            .sidebar {
                width: 70px;
            }

            .logo-subtitle,
            .logo-main span,
            .menu-title,
            .menu-item span:not(.menu-icon) {
                display: none;
            }

            .logo {
                text-align: center;
                padding: 0;
            }

            .logo-main {
                font-size: 17px;
            }

            .menu-item {
                justify-content: center;
            }

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

</head>
<body>

<div class="app">

    <aside class="sidebar">

        <div class="logo">
            <div class="logo-main">INDIC <span>RMC</span></div>
            <div class="logo-subtitle">ADMINISTRATION PORTAL</div>
        </div>

        <div class="menu-section">
            <div class="menu-title">OVERVIEW</div>

            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <span class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></span>
                <span>Dashboard</span>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-title">MANAGEMENT</div>

            <a href="{{ route('admin.users') }}" class="menu-item">
                <span class="menu-icon"><i class="bi bi-people-fill"></i></span>
                <span>Users</span>
            </a>

            <a href="{{ route('admin.students') }}" class="menu-item">
                <span class="menu-icon"><i class="bi bi-person-fill"></i></span>
                <span>Students</span>
            </a>

            <a href="{{ route('admin.consultants') }}" class="menu-item">
                <span class="menu-icon"><i class="bi bi-person-badge-fill"></i></span>
                <span>Consultants</span>
            </a>

            <a href="{{ route('admin.applications-list') }}" class="menu-item">
                <span class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></span>
                <span>Applications</span>
            </a>

            <a href="{{ route('admin.appointments-list') }}" class="menu-item">
                <span class="menu-icon"><i class="bi bi-calendar2-check-fill"></i></span>
                <span>Appointments</span>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-title">STUDY ABROAD</div>

            <a href="{{ route('admin.countries-list') }}" class="menu-item">
                <span class="menu-icon"><i class="bi bi-globe-americas"></i></span>
                <span>Countries</span>
            </a>

            <a href="{{ route('admin.universities-list') }}" class="menu-item">
                <span class="menu-icon"><i class="bi bi-bank"></i></span>
                <span>Universities</span>
            </a>

            <a href="{{ route('admin.courses-list') }}" class="menu-item">
                <span class="menu-icon"><i class="bi bi-mortarboard-fill"></i></span>
                <span>Courses</span>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-title">SYSTEM</div>

            <a href="{{ route('admin.users') }}" class="menu-item">
                <span class="menu-icon"><i class="bi bi-gear-fill"></i></span>
                <span>User Management</span>
            </a>
        </div>

    </aside>

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
                    <h1>Leads</h1>
                    <p>All leads captured from inquiries, calls, and the website.</p>
                </div>
                <a href="{{ route('admin.leads.create') }}" class="btn-primary">+ Add Lead</a>
            </div>

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="panel">

                <div class="table-container">

                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Source</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Consultant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($leads as $lead)
                                <tr>
                                    <td>{{ $lead->first_name }} {{ $lead->last_name }}</td>
                                    <td>
                                        {{ $lead->email ?? '—' }}<br>
                                        <span style="color:#8a93a3;">{{ $lead->phone ?? '' }}</span>
                                    </td>
                                    <td>{{ $lead->source ?? '—' }}</td>
                                    <td>{{ $lead->interestedCountry->country_name ?? '—' }}</td>
                                    <td>
                                        @php
                                            $statusClass = match($lead->lead_status) {
                                                'New' => 'badge-blue',
                                                'Contacted' => 'badge-orange',
                                                'Qualified' => 'badge-green',
                                                'Converted' => 'badge-green',
                                                'Lost' => 'badge-red',
                                                default => 'badge-gray',
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $lead->lead_status }}</span>
                                    </td>
                                    <td>{{ $lead->assignedConsultant->user->name ?? '—' }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <a href="{{ route('admin.leads.edit', $lead->lead_id) }}">Edit</a>
                                            <form action="{{ route('admin.leads.destroy', $lead->lead_id) }}" method="POST" onsubmit="return confirm('Delete this lead?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="empty-state">No leads yet. Click "Add Lead" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <div class="pagination-wrap">
                    {{ $leads->links() }}
                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>