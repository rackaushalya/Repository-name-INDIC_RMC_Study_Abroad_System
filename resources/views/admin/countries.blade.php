<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDIC RMC | Country Management</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f8fa;
            color: #172033;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* =====================================================
           LAYOUT
        ===================================================== */
        .app {
            display: flex;
            min-height: 100vh;
        }

        /* =====================================================
           SIDEBAR (Canonical shell)
        ===================================================== */
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

        .nav-badge {
            margin-left: auto;
            background: rgba(255,255,255,0.15);
            padding: 2px 7px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
        }

        /* =====================================================
           MAIN
        ===================================================== */
        .main {
            margin-left: 245px;
            width: calc(100% - 245px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* =====================================================
           TOPBAR (Canonical shell)
        ===================================================== */
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

        /* =====================================================
           PAGE CONTENT
        ===================================================== */
        .content {
            padding: 30px;
            flex: 1;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #172033;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .title-badge {
            background: #fff2e8;
            color: #f97316;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            border: 1px solid rgba(249, 115, 22, 0.2);
        }

        .page-header p {
            font-size: 12px;
            color: #697386;
            margin-top: 4px;
        }

        /* =====================================================
           CONTROLS CARD (Exact match to Universities)
        ===================================================== */
        .controls-card {
            background: #ffffff;
            border: 1px solid #e7e9ed;
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .controls-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            min-width: 280px;
            flex-wrap: wrap;
        }

        .search-control {
            position: relative;
            flex: 1;
            max-width: 360px;
            min-width: 220px;
        }

        .search-control input {
            width: 100%;
            height: 38px;
            border: 1px solid #e1e5eb;
            border-radius: 7px;
            background: #fafbfc;
            padding: 0 12px 0 36px;
            font-size: 12px;
            color: #172033;
            outline: none;
            transition: all .2s;
        }

        .search-control input:focus {
            border-color: #f97316;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        .search-control svg {
            position: absolute;
            left: 11px;
            top: 11px;
            width: 16px;
            height: 16px;
            color: #8a93a3;
        }

        .filter-select {
            height: 38px;
            padding: 0 12px;
            border: 1px solid #e1e5eb;
            border-radius: 7px;
            background: #fafbfc;
            font-size: 12px;
            color: #4d5666;
            outline: none;
            cursor: pointer;
            transition: border-color .2s;
        }

        .filter-select:focus {
            border-color: #f97316;
            background: #ffffff;
        }

        .controls-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .view-switcher {
            display: flex;
            background: #f0f2f5;
            padding: 3px;
            border-radius: 7px;
        }

        .view-btn {
            border: none;
            background: transparent;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            color: #697386;
            transition: all .15s;
        }

        .view-btn.active {
            background: #ffffff;
            color: #172033;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .btn-orange {
            background: #f97316;
            color: #ffffff;
            border: none;
            height: 38px;
            padding: 0 18px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background .2s, transform .1s;
        }

        .btn-orange:hover {
            background: #e07316;
        }

        .btn-orange:active {
            transform: scale(0.98);
        }

        .btn-secondary {
            background: #ffffff;
            border: 1px solid #d0d5dd;
            color: #344054;
            padding: 0 14px;
            height: 38px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background .15s;
        }

        .btn-secondary:hover {
            background: #f9fafb;
        }

        /* =====================================================
           CARD / TABLE CONTAINER
        ===================================================== */
        .card-container {
            background: #ffffff;
            border: 1px solid #e7e9ed;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table.uni-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        table.uni-table th {
            background: #fafbfc;
            padding: 12px 16px;
            border-bottom: 1px solid #e7e9ed;
            color: #697386;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 600;
            user-select: none;
        }

        table.uni-table th.sortable {
            cursor: pointer;
        }

        table.uni-table th.sortable:hover {
            color: #f97316;
        }

        table.uni-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f1f3;
            font-size: 12px;
            color: #4b5565;
            vertical-align: middle;
        }

        table.uni-table tr:hover td {
            background: #fcfdfe;
        }

        .country-flag-lg {
            width: 46px;
            height: 30px;
            border-radius: 4px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            flex-shrink: 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            display: inline-block;
            vertical-align: middle;
        }

        .country-name-text {
            font-weight: 600;
            color: #172033;
            font-size: 13px;
        }

        .country-subtext {
            font-size: 11px;
            color: #8a93a3;
            margin-top: 2px;
        }

        .iso-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #dbeafe;
            letter-spacing: .3px;
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 9px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-active {
            background: #ecfdf3;
            color: #027a48;
        }

        .badge-active::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #12b76a;
        }

        .badge-review {
            background: #fff8eb;
            color: #b54708;
        }

        .badge-review::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #f79009;
        }

        .guidelines-summary {
            max-width: 360px;
            font-size: 12px;
            color: #4b5565;
            line-height: 1.45;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            cursor: pointer;
            transition: color .15s;
        }

        .guidelines-summary:hover {
            color: #f97316;
        }

        .actions-cell {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        .btn-icon-action {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: 1px solid #e1e5eb;
            background: #ffffff;
            color: #616e85;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .15s;
        }

        .btn-icon-action:hover {
            background: #f4f5f7;
            color: #172033;
        }

        .btn-icon-action.delete:hover {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        /* =====================================================
           CARDS GRID VIEW
        ===================================================== */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 18px;
            padding: 20px;
        }

        .uni-grid-card {
            background: #ffffff;
            border: 1px solid #e7e9ed;
            border-radius: 9px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: transform .15s, box-shadow .15s;
        }

        .uni-grid-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            transform: translateY(-2px);
        }

        .card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .card-actions {
            margin-top: auto;
            padding-top: 10px;
            border-top: 1px solid #f0f1f3;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        /* =====================================================
           TABLE FOOTER
        ===================================================== */
        .table-footer {
            padding: 14px 20px;
            background: #fafbfc;
            border-top: 1px solid #e7e9ed;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11px;
            color: #697386;
        }

        /* =====================================================
           MODAL SYSTEM (Exact match to Universities)
        ===================================================== */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(17, 24, 39, 0.6);
            backdrop-filter: blur(2px);
            z-index: 999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-backdrop.open {
            display: flex;
        }

        .modal-window {
            background: #ffffff;
            border-radius: 12px;
            width: 100%;
            max-width: 640px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
            animation: modalPop .2s ease-out;
        }

        @keyframes modalPop {
            from { opacity: 0; transform: scale(0.96); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-header {
            padding: 18px 24px;
            border-bottom: 1px solid #e7e9ed;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 700;
            color: #172033;
        }

        .modal-subtitle {
            font-size: 11px;
            color: #697386;
            margin-top: 2px;
        }

        .modal-close-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            color: #8c96a8;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }

        .modal-close-btn:hover {
            color: #172033;
            background: #f0f2f5;
        }

        .modal-body {
            padding: 20px 24px;
        }

        .modal-footer {
            padding: 14px 24px;
            border-top: 1px solid #e7e9ed;
            background: #fafbfc;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .btn-danger {
            background: #dc2626;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #344054;
            margin-bottom: 5px;
        }

        .form-input, .form-select-modal {
            width: 100%;
            height: 38px;
            border: 1px solid #d0d5dd;
            border-radius: 7px;
            padding: 0 12px;
            font-size: 12px;
            color: #172033;
            outline: none;
            transition: border-color .15s;
        }

        .form-input:focus, .form-select-modal:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        .form-textarea {
            width: 100%;
            height: 85px;
            border: 1px solid #d0d5dd;
            border-radius: 7px;
            padding: 10px 12px;
            font-size: 12px;
            color: #172033;
            outline: none;
            resize: vertical;
            font-family: inherit;
            transition: border-color .15s;
        }

        .form-textarea:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        /* Desktop Country Image Upload Styling (from Universities) */
        .country-img-dropzone {
            transition: all .2s ease;
        }

        .country-img-dropzone:hover, .country-img-dropzone.dragover {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.15) !important;
            background: #fffaf5 !important;
        }

        .btn-upload-logo {
            background: #ffffff;
            border: 1px solid #d0d5dd;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 600;
            color: #344054;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .15s;
        }

        .btn-upload-logo:hover {
            background: #f4f5f7;
            border-color: #98a2b3;
        }

        .btn-remove-logo {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 600;
            color: #dc2626;
            cursor: pointer;
            transition: all .15s;
        }

        .btn-remove-logo:hover {
            background: #fee2e2;
        }

        /* Toast notification */
        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #111827;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 12px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.2);
            display: none;
            align-items: center;
            gap: 8px;
            z-index: 1000;
            animation: slideUp .2s ease;
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 750px) {
            .sidebar { width: 70px; }
            .logo-subtitle,
            .logo-main span,
            .menu-title,
            .menu-item span:not(.menu-icon) { display: none; }
            .logo { text-align: center; padding: 0; }
            .logo-main { font-size: 17px; }
            .menu-item { justify-content: center; }
            .main { margin-left: 70px; width: calc(100% - 70px); }
            .content { padding: 16px; }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="app">

    <!-- =====================================================
         SIDEBAR
    ====================================================== -->
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

            <a href="{{ route('admin.countries-list') }}" class="menu-item active">
                <span class="menu-icon"><i class="bi bi-globe-americas"></i></span>
                <span>Countries</span>
                <span class="nav-badge" id="navCountryCountBadge">12</span>
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

    <!-- =====================================================
         MAIN CONTENT WRAPPER
    ====================================================== -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="search-box">
                <span class="search-icon"><i class="bi bi-search"></i></span>
                <input type="text" id="topbarSearchInput" placeholder="Search students, applications...">
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

        <!-- CONTENT SECTION -->
        <section class="content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <div>
                    <h1>
                        Country Management
                        <span class="title-badge" id="totalCountryBadge">12 Destinations</span>
                    </h1>
                    <p>Manage international study destinations, student visa rules, and living fund criteria.</p>
                </div>
            </div>

            <!-- CONTROLS CARD -->
            <div class="controls-card">
                <div class="controls-left">
                    <div class="search-control">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7"/>
                            <path d="m20 20-4-4"/>
                        </svg>
                        <input type="text" id="countrySearchInput" placeholder="Search by name, code, capital, or guidelines...">
                    </div>

                    <select id="regionFilterSelect" class="filter-select">
                        <option value="ALL">Filter by Region</option>
                        <option value="North America">North America</option>
                        <option value="Europe">Europe</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Oceania">Oceania</option>
                        <option value="Asia-Pacific">Asia-Pacific</option>
                        <option value="East Asia">East Asia</option>
                    </select>

                    <select id="statusFilterSelect" class="filter-select">
                        <option value="ALL">Filter by Status</option>
                        <option value="Active">Active</option>
                        <option value="Under Review">Under Review</option>
                    </select>
                </div>

                <div class="controls-right">
                    <div class="view-switcher">
                        <button class="view-btn active" id="btnViewTable" onclick="switchView('table')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v18"/></svg>
                            Table
                        </button>
                        <button class="view-btn" id="btnViewCards" onclick="switchView('cards')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            Cards
                        </button>
                    </div>

                    <button class="btn-secondary" onclick="exportCSV()" title="Export destinations to CSV">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Export CSV
                    </button>

                    <button class="btn-orange" onclick="openAddModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        + Add New Country
                    </button>
                </div>
            </div>

            <!-- CORE DATA CONTAINER -->
            <div class="card-container">
                <!-- TABLE VIEW -->
                <div class="table-responsive" id="tableViewContainer">
                    <table class="uni-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">Flag</th>
                                <th class="sortable" onclick="sortTable('name')">Country Name ↕</th>
                                <th>ISO Code</th>
                                <th class="sortable" onclick="sortTable('region')">Region ↕</th>
                                <th>Status</th>
                                <th style="min-width: 260px;">Visa Guidelines & Proof of Funds</th>
                                <th style="text-align: right; width: 140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="countryTableBody">
                            <!-- Populated dynamically -->
                        </tbody>
                    </table>
                </div>

                <!-- CARDS VIEW (Initially hidden) -->
                <div class="cards-grid" id="cardsViewContainer" style="display: none;">
                    <!-- Populated dynamically -->
                </div>

                <!-- TABLE FOOTER -->
                <div class="table-footer">
                    <div id="footerStatsText">Showing 12 destinations</div>
                    <div>Click on any guideline excerpt to view complete embassy instructions.</div>
                </div>
            </div>

        </section>
    </main>
</div>

<!-- =====================================================
     MODAL 1: ADD / EDIT COUNTRY
====================================================== -->
<div class="modal-backdrop" id="addEditModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="addEditModalTitle">Add New Country</h3>
                <div class="modal-subtitle">Configure an international destination for study abroad consultancies.</div>
            </div>
            <button class="modal-close-btn" onclick="closeModal('addEditModal')">✕</button>
        </div>
        <form id="countryForm" onsubmit="saveCountry(event)">
            <input type="hidden" id="editCountryId">
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Country Name *</label>
                        <input type="text" id="countryNameInput" class="form-input" placeholder="e.g. Canada" required oninput="handleCountryNameInput(this.value)">
                    </div>
                    <div class="form-group">
                        <label class="form-label">ISO Alpha-3 Code *</label>
                        <input type="text" id="countryCodeInput" class="form-input" placeholder="e.g. CAN" maxlength="3" required style="text-transform: uppercase;">
                    </div>
                </div>

                <!-- Desktop Country Image / Flag Upload Section (Identical to Universities) -->
                <div class="form-group" style="margin-bottom: 14px;">
                    <div id="countryImageSection" style="background: #f9fafb; border: 1px dashed #d0d5dd; border-radius: 8px; padding: 10px 12px; transition: all 0.2s ease;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-size: 11px; font-weight: 600; color: #344054; display: flex; align-items: center; gap: 6px;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                Country Flag / National Image
                            </span>
                            <span id="countryImgBadge" style="font-size: 10px; font-weight: 600; padding: 2px 7px; border-radius: 4px; background: #e0f2fe; color: #0284c7;">
                                Auto Flag
                            </span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 12px;">
                            <!-- Dropzone & Thumbnail Preview -->
                            <div id="countryImgDropArea" class="country-img-dropzone" onclick="document.getElementById('countryImageFileInput').click()" title="Click to choose or drag & drop country image from desktop" style="cursor: pointer; position: relative; width: 64px; height: 42px; border-radius: 6px; overflow: hidden; border: 1px solid #d0d5dd; background: #ffffff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                                <img id="countryFlagPreviewImg" src="https://flagcdn.com/w80/un.png" alt="Country Preview" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <!-- Upload Controls -->
                            <div style="flex: 1; min-width: 0;">
                                <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                    <button type="button" class="btn-upload-logo" onclick="document.getElementById('countryImageFileInput').click()">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                            <polyline points="17 8 12 3 7 8"/>
                                            <line x1="12" y1="3" x2="12" y2="15"/>
                                        </svg>
                                        Choose from Desktop
                                    </button>
                                    <button type="button" id="btnRemoveCountryImg" class="btn-remove-logo" style="display: none;" onclick="removeUploadedCountryImage(event)">
                                        Reset to Auto Flag
                                    </button>
                                </div>
                                <div style="font-size: 11px; color: #697386; margin-top: 4px;">
                                    Upload custom image or flag from desktop, or auto-detect from country name.
                                </div>
                            </div>
                        </div>
                        <input type="file" id="countryImageFileInput" accept="image/*" style="display: none;" onchange="handleCountryImageFileSelect(event)">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Capital City</label>
                        <input type="text" id="capitalInput" class="form-input" placeholder="e.g. Ottawa">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Key Student Cities</label>
                        <input type="text" id="citiesInput" class="form-input" placeholder="e.g. Toronto, Vancouver, Montreal">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Region *</label>
                        <select id="regionInput" class="form-select-modal" required>
                            <option value="North America">North America</option>
                            <option value="Europe">Europe</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Oceania">Oceania</option>
                            <option value="Asia-Pacific">Asia-Pacific</option>
                            <option value="East Asia">East Asia</option>
                            <option value="Middle East">Middle East</option>
                            <option value="Latin America">Latin America</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Operational Status *</label>
                        <select id="statusInput" class="form-select-modal" required>
                            <option value="Active">Active</option>
                            <option value="Under Review">Under Review</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Visa Processing Time</label>
                        <input type="text" id="procTimeInput" class="form-input" placeholder="e.g. 4 - 8 Weeks">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Living Funds Required</label>
                        <input type="text" id="fundsInput" class="form-input" placeholder="e.g. CAD $20,635 / yr">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Visa Guidelines & Embassy Rules *</label>
                    <textarea id="guidelinesInput" class="form-textarea" placeholder="Detailed visa guidelines, proof of funds, and required test scores..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('addEditModal')">Cancel</button>
                <button type="submit" class="btn-orange">Save Country</button>
            </div>
        </form>
    </div>
</div>

<!-- =====================================================
     MODAL 2: VIEW VISA GUIDELINES
====================================================== -->
<div class="modal-backdrop" id="viewGuidelinesModal">
    <div class="modal-window" style="max-width: 600px;">
        <div class="modal-header">
            <div style="display: flex; align-items: center; gap: 12px;">
                <img id="modalCountryFlag" src="" alt="Flag" style="width: 38px; height: 26px; border-radius: 4px; object-fit: cover; border: 1px solid #e4e7ec;">
                <div>
                    <h3 class="modal-title" id="guidelinesModalTitle">Visa Guidelines</h3>
                    <div class="modal-subtitle" id="guidelinesModalSubtitle">Official embassy requirements & proof of funds.</div>
                </div>
            </div>
            <button class="modal-close-btn" onclick="closeModal('viewGuidelinesModal')">✕</button>
        </div>
        <div class="modal-body">
            <div style="background: #fafbfc; border: 1px solid #e7e9ed; border-radius: 8px; padding: 14px 16px; margin-bottom: 16px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; font-size: 12px;">
                    <div><span style="color:#697386;">Estimated Processing:</span> <strong id="modalProcTime" style="color:#172033; display: block; margin-top: 2px;"></strong></div>
                    <div><span style="color:#697386;">Funds Threshold:</span> <strong id="modalFunds" style="color:#172033; display: block; margin-top: 2px;"></strong></div>
                </div>
            </div>
            <div style="font-size: 13px; line-height: 1.65; color: #344054; white-space: pre-line;" id="modalGuidelinesContent"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" onclick="closeModal('viewGuidelinesModal')">Close</button>
        </div>
    </div>
</div>

<!-- =====================================================
     MODAL 3: DELETE CONFIRMATION
====================================================== -->
<div class="modal-backdrop" id="deleteModal">
    <div class="modal-window" style="max-width: 420px; text-align: center;">
        <div class="modal-body" style="padding-top: 28px;">
            <div style="width: 48px; height: 48px; border-radius: 50%; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 22px;">⚠</div>
            <h3 class="modal-title" style="margin-bottom: 8px;">Delete Country</h3>
            <p style="font-size: 12px; color: #697386; line-height: 1.5;" id="deleteConfirmText">Are you sure you want to remove this country from the directory? This action cannot be undone.</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
            <button type="button" class="btn-danger" id="confirmDeleteBtn" onclick="confirmDelete()">Delete</button>
        </div>
    </div>
</div>

<!-- TOAST NOTIFICATION -->
<div class="toast" id="toast">
    <span id="toastMessage">Action completed successfully.</span>
</div>

<!-- =====================================================
     INTERACTIVE CONTROLLER JAVASCRIPT
====================================================== -->
<script>
    // 100+ Country ISO 2-letter mapping dictionary
    const countryIsoMap = {
        'afghanistan': 'af', 'albania': 'al', 'algeria': 'dz', 'andorra': 'ad', 'angola': 'ao',
        'argentina': 'ar', 'armenia': 'am', 'australia': 'au', 'austria': 'at', 'azerbaijan': 'az',
        'bahamas': 'bs', 'bahrain': 'bh', 'bangladesh': 'bd', 'barbados': 'bb', 'belarus': 'by',
        'belgium': 'be', 'belize': 'bz', 'benin': 'bj', 'bhutan': 'bt', 'bolivia': 'bo',
        'bosnia and herzegovina': 'ba', 'botswana': 'bw', 'brazil': 'br', 'brunei': 'bn', 'bulgaria': 'bg',
        'cambodia': 'kh', 'cameroon': 'cm', 'canada': 'ca', 'chile': 'cl', 'china': 'cn',
        'colombia': 'co', 'costa rica': 'cr', 'croatia': 'hr', 'cuba': 'cu', 'cyprus': 'cy',
        'czech republic': 'cz', 'czechia': 'cz', 'denmark': 'dk', 'ecuador': 'ec', 'egypt': 'eg',
        'estonia': 'ee', 'ethiopia': 'et', 'fiji': 'fj', 'finland': 'fi', 'france': 'fr',
        'georgia': 'ge', 'germany': 'de', 'ghana': 'gh', 'greece': 'gr', 'hong kong': 'hk',
        'hungary': 'hu', 'iceland': 'is', 'india': 'in', 'indonesia': 'id', 'iran': 'ir',
        'iraq': 'iq', 'ireland': 'ie', 'israel': 'il', 'italy': 'it', 'jamaica': 'jm',
        'japan': 'jp', 'jordan': 'jo', 'kazakhstan': 'kz', 'kenya': 'ke', 'kuwait': 'kw',
        'latvia': 'lv', 'lebanon': 'lb', 'lithuania': 'lt', 'luxembourg': 'lu', 'malaysia': 'my',
        'maldives': 'mv', 'malta': 'mt', 'mauritius': 'mu', 'mexico': 'mx', 'monaco': 'mc',
        'morocco': 'ma', 'nepal': 'np', 'netherlands': 'nl', 'new zealand': 'nz', 'nigeria': 'ng',
        'norway': 'no', 'oman': 'om', 'pakistan': 'pk', 'philippines': 'ph', 'poland': 'pl',
        'portugal': 'pt', 'qatar': 'qa', 'romania': 'ro', 'russia': 'ru', 'saudi arabia': 'sa',
        'serbia': 'rs', 'singapore': 'sg', 'slovakia': 'sk', 'slovenia': 'si', 'south africa': 'za',
        'south korea': 'kr', 'korea': 'kr', 'spain': 'es', 'sri lanka': 'lk', 'sweden': 'se',
        'switzerland': 'ch', 'taiwan': 'tw', 'thailand': 'th', 'turkey': 'tr', 'türkiye': 'tr',
        'ukraine': 'ua', 'united arab emirates': 'ae', 'uae': 'ae', 'united kingdom': 'gb', 'uk': 'gb',
        'united states': 'us', 'usa': 'us', 'vietnam': 'vn', 'zimbabwe': 'zw'
    };

    // Auto-suggest ISO Alpha-3 codes
    const countryCodeMap = {
        'canada': 'CAN', 'united kingdom': 'GBR', 'uk': 'GBR', 'united states': 'USA', 'usa': 'USA',
        'australia': 'AUS', 'germany': 'DEU', 'ireland': 'IRL', 'new zealand': 'NZL', 'singapore': 'SGP',
        'france': 'FRA', 'netherlands': 'NLD', 'sweden': 'SWE', 'japan': 'JPN', 'italy': 'ITA',
        'spain': 'ESP', 'switzerland': 'CHE', 'china': 'CHN', 'south korea': 'KOR', 'malaysia': 'MYS',
        'uae': 'ARE', 'united arab emirates': 'ARE', 'india': 'IND'
    };

    // Initial Countries Dataset (12 international destinations)
    const initialCountries = [
        {
            id: "CTR-CAN-01",
            code: "CAN",
            name: "Canada",
            capital: "Ottawa",
            cities: "Toronto, Vancouver, Montreal",
            region: "North America",
            flag: "https://flagcdn.com/w80/ca.png",
            visaGuidelines: "SDS stream for fast-track processing (20 days). Requires min IELTS 6.0 (CLB 7), upfront medical exam, and GIC financial proof of CAD $20,635. Post-Graduation Work Permit (PGWP) allows up to 3 years of work rights.",
            processingTime: "4 - 8 Weeks",
            fundsRequired: "CAD $20,635 + 1st yr tuition",
            status: "Active"
        },
        {
            id: "CTR-GBR-02",
            code: "GBR",
            name: "United Kingdom",
            capital: "London",
            cities: "London, Manchester, Edinburgh",
            region: "United Kingdom",
            flag: "https://flagcdn.com/w80/gb.png",
            visaGuidelines: "Student Visa (Points-Based System: 70 points needed). CAS letter from licensed sponsor mandatory. Financial proof: £1,334/mo (London) or £1,023/mo (outside London) held for 28 consecutive days. Graduate Route offers 2-year post-study work visa.",
            processingTime: "3 - 5 Weeks",
            fundsRequired: "£9,207 - £12,006 living + tuition",
            status: "Active"
        },
        {
            id: "CTR-USA-03",
            code: "USA",
            name: "United States",
            capital: "Washington, D.C.",
            cities: "Boston, New York, San Francisco",
            region: "North America",
            flag: "https://flagcdn.com/w80/us.png",
            visaGuidelines: "F-1 Academic Student Visa requires Form I-20 and SEVIS fee payment ($350). In-person embassy consular interview mandatory. STEM degree graduates eligible for up to 36 months of Optional Practical Training (OPT).",
            processingTime: "4 - 6 Weeks",
            fundsRequired: "1 full year estimated cost on I-20",
            status: "Active"
        },
        {
            id: "CTR-AUS-04",
            code: "AUS",
            name: "Australia",
            capital: "Canberra",
            cities: "Melbourne, Sydney, Brisbane",
            region: "Oceania",
            flag: "https://flagcdn.com/w80/au.png",
            visaGuidelines: "Subclass 500 Student Visa. Genuine Student (GS) criterion applies. Financial requirement is AUD $29,710 for annual living costs. Overseas Student Health Cover (OSHC) mandatory. Temporary Graduate (Subclass 485) visa available.",
            processingTime: "4 - 10 Weeks",
            fundsRequired: "AUD $29,710 living + tuition",
            status: "Active"
        },
        {
            id: "CTR-DEU-05",
            code: "DEU",
            name: "Germany",
            capital: "Berlin",
            cities: "Munich, Berlin, Aachen",
            region: "Europe",
            flag: "https://flagcdn.com/w80/de.png",
            visaGuidelines: "National Visa for Study (D-Visa). Blocked account (Sperrkonto) with €11,904/year required as living expense proof. Most public universities tuition-free. 18-month job seeker permit granted after graduation.",
            processingTime: "6 - 12 Weeks",
            fundsRequired: "€11,904 blocked account",
            status: "Under Review"
        },
        {
            id: "CTR-IRL-06",
            code: "IRL",
            name: "Ireland",
            capital: "Dublin",
            cities: "Dublin, Cork, Galway",
            region: "Europe",
            flag: "https://flagcdn.com/w80/ie.png",
            visaGuidelines: "Stamp 2 Study Visa. Non-EEA students must demonstrate €10,000 immediately accessible funds plus evidence of €10,000 for each subsequent study year. Third Level Graduate Scheme allows 2-year post-study work for Master's graduates.",
            processingTime: "5 - 8 Weeks",
            fundsRequired: "€10,000 immediate access + tuition",
            status: "Active"
        },
        {
            id: "CTR-NZL-07",
            code: "NZL",
            name: "New Zealand",
            capital: "Wellington",
            cities: "Auckland, Christchurch",
            region: "Oceania",
            flag: "https://flagcdn.com/w80/nz.png",
            visaGuidelines: "Fee Paying Student Visa. Requires NZD $20,000 per year living expenses plus prepaid tuition fee receipt. Post Study Work Visa available for degree level 7 and above for up to 3 years.",
            processingTime: "4 - 8 Weeks",
            fundsRequired: "NZD $20,000 living + tuition",
            status: "Active"
        },
        {
            id: "CTR-SGP-08",
            code: "SGP",
            name: "Singapore",
            capital: "Singapore",
            cities: "Singapore City",
            region: "Asia-Pacific",
            flag: "https://flagcdn.com/w80/sg.png",
            visaGuidelines: "Student's Pass (STP) administered by ICA. Requires an In-Principle Approval (IPA) letter from accredited Institute of Higher Learning. Financial proof SGD $30,000 in bank deposit.",
            processingTime: "2 - 4 Weeks",
            fundsRequired: "SGD $30,000 bank proof",
            status: "Active"
        },
        {
            id: "CTR-FRA-09",
            code: "FRA",
            name: "France",
            capital: "Paris",
            cities: "Paris, Lyon, Toulouse",
            region: "Europe",
            flag: "https://flagcdn.com/w80/fr.png",
            visaGuidelines: "Long-stay student visa (VLS-TS). Campus France procedure mandatory for EEF member countries. Proof of minimum €615/month living expenses. Post-study APS visa allows 1-year job search.",
            processingTime: "3 - 6 Weeks",
            fundsRequired: "€7,380 per academic year",
            status: "Active"
        },
        {
            id: "CTR-NLD-10",
            code: "NLD",
            name: "Netherlands",
            capital: "Amsterdam",
            cities: "Amsterdam, Rotterdam, Utrecht",
            region: "Europe",
            flag: "https://flagcdn.com/w80/nl.png",
            visaGuidelines: "Entry visa (MVV) and Residence Permit (VVR) applied on student's behalf by Dutch university. IND requirement of approx €1,000/month living cost. 'Orientation Year' permits graduates 1 year work rights.",
            processingTime: "4 - 6 Weeks",
            fundsRequired: "€12,500 IND living proof",
            status: "Active"
        },
        {
            id: "CTR-SWE-11",
            code: "SWE",
            name: "Sweden",
            capital: "Stockholm",
            cities: "Stockholm, Gothenburg, Lund",
            region: "Europe",
            flag: "https://flagcdn.com/w80/se.png",
            visaGuidelines: "Residence permit for higher education through Swedish Migration Agency. Financial maintenance minimum SEK 9,450/month. First tuition installment must be paid before permit issuance.",
            processingTime: "6 - 10 Weeks",
            fundsRequired: "SEK 94,500 for 10-month academic year",
            status: "Active"
        },
        {
            id: "CTR-JPN-12",
            code: "JPN",
            name: "Japan",
            capital: "Tokyo",
            cities: "Tokyo, Kyoto, Osaka",
            region: "East Asia",
            flag: "https://flagcdn.com/w80/jp.png",
            visaGuidelines: "College Student Visa requires Certificate of Eligibility (COE) issued by Japanese Immigration. Financial proof of 2.0 - 2.5 million JPY. Permission to work part-time up to 28 hours/week.",
            processingTime: "8 - 12 Weeks",
            fundsRequired: "2.0 - 2.5 Million JPY bank statement",
            status: "Active"
        }
    ];

    let countries = [...initialCountries];
    let activeSort = { column: 'name', ascending: true };
    let deleteTargetId = null;
    let currentCountryImageDataUrl = null;

    // Resolve flag by country name or code
    function getCountryFlag(name = '', code = '') {
        const cleanName = (name || '').toLowerCase().trim();
        const cleanCode = (code || '').toLowerCase().trim();

        if (countryIsoMap[cleanName]) {
            return 'https://flagcdn.com/w80/' + countryIsoMap[cleanName] + '.png';
        }
        if (cleanCode.length === 2) {
            return 'https://flagcdn.com/w80/' + cleanCode + '.png';
        }
        if (cleanCode.length === 3) {
            for (const [n, iso] of Object.entries(countryIsoMap)) {
                if (cleanName.includes(n) || n.includes(cleanName)) {
                    return 'https://flagcdn.com/w80/' + iso + '.png';
                }
            }
        }
        return 'https://flagcdn.com/w80/un.png';
    }

    // Handle Country image selected from desktop
    function handleCountryImageFileSelect(event) {
        const file = event.target.files && event.target.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            showToast('Please select a valid image file (PNG, JPG, SVG, WEBP).');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            currentCountryImageDataUrl = e.target.result;
            updateCountryImagePreview();
            showToast('Country image loaded from desktop!');
        };
        reader.readAsDataURL(file);
    }

    // Reset uploaded country image back to auto-detected flag
    function removeUploadedCountryImage(event) {
        if (event) event.stopPropagation();
        currentCountryImageDataUrl = null;
        const fileInput = document.getElementById('countryImageFileInput');
        if (fileInput) fileInput.value = '';

        updateCountryImagePreview();
        showToast('Country image reset to auto flag.');
    }

    // Update Country Image preview & badge
    function updateCountryImagePreview() {
        const previewImg = document.getElementById('countryFlagPreviewImg');
        const badge = document.getElementById('countryImgBadge');
        const btnReset = document.getElementById('btnRemoveCountryImg');
        if (!previewImg) return;

        const countryName = document.getElementById('countryNameInput').value.trim();
        const countryCode = document.getElementById('countryCodeInput').value.trim();

        if (currentCountryImageDataUrl) {
            previewImg.src = currentCountryImageDataUrl;
            if (badge) {
                badge.innerText = 'Custom Image';
                badge.style.background = '#dcfce7';
                badge.style.color = '#15803d';
            }
            if (btnReset) btnReset.style.display = 'inline-flex';
        } else {
            const flagUrl = getCountryFlag(countryName, countryCode);
            previewImg.src = flagUrl;
            if (badge) {
                badge.innerText = 'Auto Flag';
                badge.style.background = '#e0f2fe';
                badge.style.color = '#0284c7';
            }
            if (btnReset) btnReset.style.display = 'none';
        }
    }

    // Live typing in Country Name input
    function handleCountryNameInput(val) {
        const clean = (val || '').toLowerCase().trim();
        const codeInput = document.getElementById('countryCodeInput');

        // Auto-fill ISO code if empty
        if (codeInput && !codeInput.value && countryCodeMap[clean]) {
            codeInput.value = countryCodeMap[clean];
        }

        if (!currentCountryImageDataUrl) {
            updateCountryImagePreview();
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        renderTable();
        renderCards();

        // Search listener
        document.getElementById('countrySearchInput').addEventListener('input', applyFilters);
        document.getElementById('topbarSearchInput').addEventListener('input', (e) => {
            document.getElementById('countrySearchInput').value = e.target.value;
            applyFilters();
        });

        // Filter listeners
        document.getElementById('regionFilterSelect').addEventListener('change', applyFilters);
        document.getElementById('statusFilterSelect').addEventListener('change', applyFilters);

        // Drag & Drop for Country Image Dropzone
        const dropArea = document.getElementById('countryImgDropArea');
        if (dropArea) {
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropArea.classList.add('dragover');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropArea.classList.remove('dragover');
                }, false);
            });

            dropArea.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files && files.length > 0) {
                    const file = files[0];
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            currentCountryImageDataUrl = evt.target.result;
                            updateCountryImagePreview();
                            showToast('Country image dropped from desktop!');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        showToast('Please drop a valid image file.');
                    }
                }
            }, false);
        }
    });

    // Render Table
    function renderTable(data = countries) {
        const tbody = document.getElementById('countryTableBody');
        tbody.innerHTML = '';

        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 40px; color: #8a93a3;">No countries match your search or filter criteria.</td></tr>';
            return;
        }

        data.forEach(c => {
            const tr = document.createElement('tr');
            const statusClass = c.status === 'Active' ? 'badge-status badge-active' : 'badge-status badge-review';
            tr.innerHTML = `
                <td>
                    <img src="${c.flag}" alt="${c.name}" class="country-flag-lg">
                </td>
                <td>
                    <div class="country-name-text">${c.name}</div>
                    <div class="country-subtext">${c.capital ? 'Capital: ' + c.capital : c.cities || ''}</div>
                </td>
                <td>
                    <span class="iso-badge">${c.code}</span>
                </td>
                <td>${c.region}</td>
                <td>
                    <span class="${statusClass}">${c.status}</span>
                </td>
                <td>
                    <div class="guidelines-summary" onclick="viewGuidelines('${c.id}')" title="Click to view full embassy guidelines">
                        ${c.visaGuidelines}
                    </div>
                </td>
                <td>
                    <div class="actions-cell">
                        <button class="btn-icon-action" onclick="viewGuidelines('${c.id}')" title="View Visa Guidelines">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                        <button class="btn-icon-action" onclick="openEditModal('${c.id}')" title="Edit country">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <button class="btn-icon-action delete" onclick="openDeleteModal('${c.id}')" title="Delete country">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });

        updateStats(data.length);
    }

    // Render Cards
    function renderCards(data = countries) {
        const container = document.getElementById('cardsViewContainer');
        container.innerHTML = '';

        data.forEach(c => {
            const card = document.createElement('div');
            card.className = 'uni-grid-card';
            const statusClass = c.status === 'Active' ? 'badge-status badge-active' : 'badge-status badge-review';
            card.innerHTML = `
                <div class="card-top">
                    <img src="${c.flag}" class="country-flag-lg" alt="${c.name}">
                    <div style="flex: 1;">
                        <div class="country-name-text">${c.name}</div>
                        <span class="iso-badge" style="margin-top: 3px;">${c.code}</span>
                    </div>
                    <span class="${statusClass}">${c.status}</span>
                </div>
                <div style="font-size: 11px; color: #4b5565;">
                    <div><strong>Region:</strong> ${c.region}</div>
                    <div style="margin-top: 3px;"><strong>Processing:</strong> ${c.processingTime || 'N/A'}</div>
                    <div style="margin-top: 3px;"><strong>Funds:</strong> ${c.fundsRequired || 'N/A'}</div>
                </div>
                <div class="guidelines-summary" onclick="viewGuidelines('${c.id}')" style="margin-top: 4px;" title="Click to view full embassy guidelines">
                    ${c.visaGuidelines}
                </div>
                <div class="card-actions">
                    <button class="btn-icon-action" onclick="viewGuidelines('${c.id}')" title="View Visa Guidelines"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
                    <button class="btn-icon-action" onclick="openEditModal('${c.id}')" title="Edit country"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>
                    <button class="btn-icon-action delete" onclick="openDeleteModal('${c.id}')" title="Delete country"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
                </div>
            `;
            container.appendChild(card);
        });
    }

    // Apply Filter & Search
    function applyFilters() {
        const query = document.getElementById('countrySearchInput').value.toLowerCase().trim();
        const selectedRegion = document.getElementById('regionFilterSelect').value;
        const selectedStatus = document.getElementById('statusFilterSelect').value;

        const filtered = countries.filter(c => {
            const matchesQuery = !query ||
                c.name.toLowerCase().includes(query) ||
                c.code.toLowerCase().includes(query) ||
                (c.visaGuidelines && c.visaGuidelines.toLowerCase().includes(query)) ||
                (c.capital && c.capital.toLowerCase().includes(query)) ||
                (c.cities && c.cities.toLowerCase().includes(query));

            const matchesRegion = selectedRegion === 'ALL' || c.region === selectedRegion;
            const matchesStatus = selectedStatus === 'ALL' || c.status === selectedStatus;

            return matchesQuery && matchesRegion && matchesStatus;
        });

        renderTable(filtered);
        renderCards(filtered);
    }

    // Sort Table
    function sortTable(column) {
        if (activeSort.column === column) {
            activeSort.ascending = !activeSort.ascending;
        } else {
            activeSort.column = column;
            activeSort.ascending = true;
        }

        countries.sort((a, b) => {
            let valA = (a[column] || '').toLowerCase();
            let valB = (b[column] || '').toLowerCase();

            if (valA < valB) return activeSort.ascending ? -1 : 1;
            if (valA > valB) return activeSort.ascending ? 1 : -1;
            return 0;
        });

        applyFilters();
    }

    // Switch View
    function switchView(mode) {
        const tableContainer = document.getElementById('tableViewContainer');
        const cardsContainer = document.getElementById('cardsViewContainer');
        const btnTable = document.getElementById('btnViewTable');
        const btnCards = document.getElementById('btnViewCards');

        if (mode === 'table') {
            tableContainer.style.display = 'block';
            cardsContainer.style.display = 'none';
            btnTable.classList.add('active');
            btnCards.classList.remove('active');
        } else {
            tableContainer.style.display = 'none';
            cardsContainer.style.display = 'grid';
            btnTable.classList.remove('active');
            btnCards.classList.add('active');
        }
    }

    // Export CSV
    function exportCSV() {
        let csv = 'Country Name,ISO Code,Region,Status,Processing Time,Funds Required,Visa Guidelines\n';
        countries.forEach(c => {
            const safeGuidelines = (c.visaGuidelines || '').replace(/"/g, '""');
            csv += `"${c.name}","${c.code}","${c.region}","${c.status}","${c.processingTime || ''}","${c.fundsRequired || ''}","${safeGuidelines}"\n`;
        });

        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = `INDIC_RMC_Countries_${new Date().toISOString().split('T')[0]}.csv`;
        link.click();
        showToast('Exported countries list to CSV.');
    }

    // View Guidelines Modal
    function viewGuidelines(id) {
        const c = countries.find(item => item.id === id);
        if (!c) return;

        document.getElementById('modalCountryFlag').src = c.flag;
        document.getElementById('guidelinesModalTitle').innerText = `${c.name} - Visa Guidelines`;
        document.getElementById('guidelinesModalSubtitle').innerText = `Region: ${c.region} • ISO Alpha-3: ${c.code}`;
        document.getElementById('modalProcTime').innerText = c.processingTime || 'Standard 4 - 8 Weeks';
        document.getElementById('modalFunds').innerText = c.fundsRequired || 'Tuition + Living Expenses';
        document.getElementById('modalGuidelinesContent').innerText = c.visaGuidelines;

        openModal('viewGuidelinesModal');
    }

    // Add Country
    function openAddModal() {
        document.getElementById('countryForm').reset();
        document.getElementById('editCountryId').value = '';
        currentCountryImageDataUrl = null;
        const fileInput = document.getElementById('countryImageFileInput');
        if (fileInput) fileInput.value = '';

        document.getElementById('addEditModalTitle').innerText = 'Add New Country';
        updateCountryImagePreview();
        openModal('addEditModal');
    }

    // Edit Country
    function openEditModal(id) {
        const c = countries.find(item => item.id === id);
        if (!c) return;

        document.getElementById('editCountryId').value = c.id;
        document.getElementById('countryNameInput').value = c.name;
        document.getElementById('countryCodeInput').value = c.code;
        document.getElementById('capitalInput').value = c.capital || '';
        document.getElementById('citiesInput').value = c.cities || '';
        document.getElementById('regionInput').value = c.region;
        document.getElementById('statusInput').value = c.status;
        document.getElementById('procTimeInput').value = c.processingTime || '';
        document.getElementById('fundsInput').value = c.fundsRequired || '';
        document.getElementById('guidelinesInput').value = c.visaGuidelines || '';

        // If country has custom image (e.g. data URL or custom upload)
        if (c.flag && c.flag.startsWith('data:image')) {
            currentCountryImageDataUrl = c.flag;
        } else {
            currentCountryImageDataUrl = null;
        }

        const fileInput = document.getElementById('countryImageFileInput');
        if (fileInput) fileInput.value = '';

        document.getElementById('addEditModalTitle').innerText = 'Edit Country Details';
        updateCountryImagePreview();
        openModal('addEditModal');
    }

    // Save Country
    function saveCountry(e) {
        e.preventDefault();
        const editId = document.getElementById('editCountryId').value;
        const name = document.getElementById('countryNameInput').value.trim();
        const code = document.getElementById('countryCodeInput').value.trim().toUpperCase();
        const capital = document.getElementById('capitalInput').value.trim();
        const cities = document.getElementById('citiesInput').value.trim();
        const region = document.getElementById('regionInput').value;
        const status = document.getElementById('statusInput').value;
        const processingTime = document.getElementById('procTimeInput').value.trim();
        const fundsRequired = document.getElementById('fundsInput').value.trim();
        const visaGuidelines = document.getElementById('guidelinesInput').value.trim();

        // Determine flag image: custom desktop uploaded image or auto flag
        const flag = currentCountryImageDataUrl || getCountryFlag(name, code);

        if (editId) {
            const index = countries.findIndex(item => item.id === editId);
            if (index !== -1) {
                countries[index] = {
                    ...countries[index],
                    name, code, capital, cities, region, status, processingTime, fundsRequired, visaGuidelines, flag
                };
                showToast('Country details updated successfully!');
            }
        } else {
            const newId = 'CTR-' + code + '-' + String(countries.length + 1).padStart(2, '0');
            countries.unshift({
                id: newId,
                code,
                name,
                capital,
                cities,
                region,
                status,
                processingTime,
                fundsRequired,
                visaGuidelines,
                flag
            });
            showToast('New destination added successfully!');
        }

        closeModal('addEditModal');
        applyFilters();
    }

    // Delete Modal
    function openDeleteModal(id) {
        deleteTargetId = id;
        const c = countries.find(item => item.id === id);
        if (c) {
            document.getElementById('deleteConfirmText').innerText = `Are you sure you want to remove "${c.name}" (${c.code}) from the directory? This action cannot be undone.`;
        }
        openModal('deleteModal');
    }

    function confirmDelete() {
        if (!deleteTargetId) return;
        countries = countries.filter(item => item.id !== deleteTargetId);
        deleteTargetId = null;
        closeModal('deleteModal');
        applyFilters();
        showToast('Country removed from directory.');
    }

    // Modal Helpers
    function openModal(id) {
        document.getElementById(id).classList.add('open');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    // Toast
    function showToast(msg) {
        const toast = document.getElementById('toast');
        document.getElementById('toastMessage').innerText = msg;
        toast.style.display = 'flex';
        setTimeout(() => {
            toast.style.display = 'none';
        }, 3200);
    }

    // Update Counts & Stats
    function updateStats(count) {
        document.getElementById('totalCountryBadge').innerText = `${count} Destinations`;
        document.getElementById('navCountryCountBadge').innerText = count;
        document.getElementById('footerStatsText').innerText = `Showing ${count} destinations`;
    }
</script>

</body>
</html>
