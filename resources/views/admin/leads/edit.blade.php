<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Edit Lead</title>

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

        .content { padding: 28px 30px 40px; max-width: 700px; }

        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 23px; font-weight: 700; color: #111827; letter-spacing: -.4px; }
        .page-header p { margin-top: 5px; font-size: 12px; color: #737d8e; }

        .panel { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 24px; }

        .form-group { margin-bottom: 18px; }

        .form-group label {
            display: block; font-size: 11px; font-weight: 600;
            color: #4b5565; margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%; padding: 10px 12px;
            border: 1px solid #dde1e7; border-radius: 7px;
            font-size: 13px; color: #172033;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none; border-color: #f97316;
        }

        .error { display: block; color: #c0392b; font-size: 11px; margin-top: 4px; }

        .form-actions {
            display: flex; gap: 10px; margin-top: 24px;
            padding-top: 20px; border-top: 1px solid #f0f1f3;
        }

        .btn-primary {
            background: #f97316; color: #fff; border: none;
            padding: 11px 20px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer;
        }

        .btn-primary:hover { background: #e07116; }

        .btn-secondary {
            background: #ffffff; color: #4b5565;
            border: 1px solid #dde1e7;
            padding: 11px 20px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer;
        }

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
                <h1>Edit Lead</h1>
                <p>Update this lead's details.</p>
            </div>

            <div class="panel">

                <form action="{{ route('admin.leads.update', $lead->lead_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('admin.leads.form')

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Update Lead</button>
                        <a href="{{ route('admin.leads.index') }}" class="btn-secondary">Cancel</a>
                    </div>

                </form>

            </div>

        </section>

    </main>

</div>

</body>
</html>