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
            .main { margin-left: 70px; width: calc(100% - 70px); }
            .content { padding: 16px; }
            .form-grid { grid-template-columns: 1fr; }
        }

        /* Database-backed page additions */
        .badge-inactive { background: #f2f4f7; color: #475467; }
        .form-errors { background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; border-radius: 8px; padding: 10px 14px; font-size: 12px; margin-bottom: 14px; }
        .form-errors ul { margin: 4px 0 0 16px; padding: 0; }
        .table-footer .portal-pager { width: 100%; }
        .empty-state { text-align: center; padding: 40px; color: #8a93a3; font-size: 13px; }
    </style>
@include('components.sidebar-style')
</head>
<body>

@php
    $allCountries = $countries->getCollection();
    $allCountries->loadCount(['universities', 'courses']);
    $totalCountries = $countries->total();
    $countriesForJs = $allCountries->map(fn ($c) => [
        'id' => $c->country_id,
        'name' => $c->country_name,
        'code' => $c->country_code,
        'description' => $c->description,
        'active' => (bool) $c->is_active,
        'flag' => $c->flag_url,
        'universityCount' => (int) $c->universities_count,
        'courseCount' => (int) $c->courses_count,
    ])->values();
@endphp

<div class="app">

    @include('components.admin-sidebar')

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
                    <strong>{{ auth()->user()->first_name ?? 'Admin' }} {{ auth()->user()->last_name ?? '' }}</strong>
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
                        <span class="title-badge">{{ $totalCountries }} {{ Str::plural('Destination', $totalCountries) }}</span>
                    </h1>
                    <p>Manage the international study destinations stored in the system.</p>
                </div>
            </div>

            @if (session('error'))
                <div class="form-errors" style="margin-bottom: 16px;">
                    {{ session('error') }}
                </div>
            @endif

            <!-- CONTROLS CARD -->
            <div class="controls-card">
                <div class="controls-left">
                    <div class="search-control">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7"/>
                            <path d="m20 20-4-4"/>
                        </svg>
                        <input type="text" id="countrySearchInput" placeholder="Search by name, code or description...">
                    </div>

                    <select id="statusFilterSelect" class="filter-select">
                        <option value="ALL">Filter by Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

                <div class="controls-right">
                    <div class="view-switcher">
                        <button type="button" class="view-btn active" id="btnViewTable" onclick="switchView('table')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v18"/></svg>
                            Table
                        </button>
                        <button type="button" class="view-btn" id="btnViewCards" onclick="switchView('cards')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            Cards
                        </button>
                    </div>

                    <button type="button" class="btn-secondary" onclick="exportCSV()" title="Export the countries on this page to CSV">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Export CSV
                    </button>

                    <button type="button" class="btn-orange" onclick="openAddModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Add New Country
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
                                <th>Country Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th style="min-width: 260px;">Description</th>
                                <th style="text-align: right; width: 140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="countryTableBody">
                            @forelse ($allCountries as $country)
                                <tr class="country-item"
                                    data-search="{{ strtolower($country->country_name . ' ' . $country->country_code . ' ' . $country->description) }}"
                                    data-status="{{ $country->is_active ? 'Active' : 'Inactive' }}">
                                    <td>
                                        <img data-flag-name="{{ $country->country_name }}" data-flag-code="{{ $country->country_code }}" data-flag-url="{{ $country->flag_url }}"
                                             src="https://flagcdn.com/w80/un.png" alt="{{ $country->country_name }}" class="country-flag-lg">
                                    </td>
                                    <td>
                                        <div class="country-name-text">{{ $country->country_name }}</div>
                                        <div class="country-subtext">Added {{ optional($country->created_at)->format('d M Y') }}</div>
                                    </td>
                                    <td><span class="iso-badge">{{ $country->country_code ?: '—' }}</span></td>
                                    <td>
                                        <span class="badge-status {{ $country->is_active ? 'badge-active' : 'badge-inactive' }}">
                                            {{ $country->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="guidelines-summary" onclick="viewCountry({{ $country->country_id }})" title="Click to read the full description">
                                            {{ $country->description ?: 'No description yet.' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="actions-cell">
                                            <button type="button" class="btn-icon-action" onclick="viewCountry({{ $country->country_id }})" title="View details">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                            </button>
                                            <button type="button" class="btn-icon-action" onclick="openEditModal({{ $country->country_id }})" title="Edit country">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                            </button>
                                            <button type="button" class="btn-icon-action delete" onclick="openDeleteModal({{ $country->country_id }})" title="Delete country">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="empty-state">No countries yet. Click <strong>Add New Country</strong> to create the first one.</td></tr>
                            @endforelse
                            <tr id="noMatchRow" style="display: none;"><td colspan="6" class="empty-state">No countries match your search or filter.</td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- CARDS VIEW -->
                <div class="cards-grid" id="cardsViewContainer" style="display: none;">
                    @foreach ($allCountries as $country)
                        <div class="country-card country-item"
                             data-search="{{ strtolower($country->country_name . ' ' . $country->country_code . ' ' . $country->description) }}"
                             data-status="{{ $country->is_active ? 'Active' : 'Inactive' }}"
                             style="background:#fff; border:1px solid #e7e9ed; border-radius:10px; padding:16px;">
                            <div style="display:flex; align-items:center; gap:12px; margin-bottom:10px;">
                                <img data-flag-name="{{ $country->country_name }}" data-flag-code="{{ $country->country_code }}" data-flag-url="{{ $country->flag_url }}"
                                     src="https://flagcdn.com/w80/un.png" alt="{{ $country->country_name }}" class="country-flag-lg">
                                <div style="flex:1; min-width:0;">
                                    <div class="country-name-text">{{ $country->country_name }}</div>
                                    <span class="iso-badge">{{ $country->country_code ?: '—' }}</span>
                                </div>
                                <span class="badge-status {{ $country->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $country->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="guidelines-summary" onclick="viewCountry({{ $country->country_id }})">
                                {{ $country->description ?: 'No description yet.' }}
                            </div>
                            <div class="actions-cell" style="margin-top:12px;">
                                <button type="button" class="btn-icon-action" onclick="viewCountry({{ $country->country_id }})" title="View details">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                                <button type="button" class="btn-icon-action" onclick="openEditModal({{ $country->country_id }})" title="Edit country">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <button type="button" class="btn-icon-action delete" onclick="openDeleteModal({{ $country->country_id }})" title="Delete country">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- TABLE FOOTER -->
                <div class="table-footer">
                    @if ($countries->hasPages())
                        {{ $countries->links('pagination.portal') }}
                    @else
                        <div>Showing {{ $totalCountries }} {{ Str::plural('destination', $totalCountries) }}</div>
                        <div>Click a description to read it in full.</div>
                    @endif
                </div>
            </div>

        </section>
    </main>
</div>

<!-- =====================================================
     MODAL 1: ADD / EDIT COUNTRY (saves to the database)
====================================================== -->
<div class="modal-backdrop" id="addEditModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="addEditModalTitle">Add New Country</h3>
                <div class="modal-subtitle">Add a study destination to the system.</div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('addEditModal')">✕</button>
        </div>
        <form id="countryForm" method="POST" action="{{ route('admin.countries.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="edit_id" id="editCountryId" value="{{ old('edit_id') }}">
            <div class="modal-body">

                @if ($errors->any())
                    <div class="form-errors">
                        Please fix the following:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="countryNameInput">Country Name *</label>
                        <input type="text" id="countryNameInput" name="country_name" class="form-input" placeholder="e.g. Canada"
                               maxlength="100" required value="{{ old('country_name') }}" oninput="handleCountryNameInput(this.value)">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="countryCodeInput">Country Code *</label>
                        <input type="text" id="countryCodeInput" name="country_code" class="form-input" placeholder="e.g. CAN"
                               maxlength="10" required value="{{ old('country_code') }}" style="text-transform: uppercase;">
                    </div>
                </div>

                <!-- FLAG UPLOAD -->
                <div class="form-group" style="margin-bottom: 14px;">
                    <div style="background: #f9fafb; border: 1px dashed #d0d5dd; border-radius: 8px; padding: 10px 12px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-size: 11px; font-weight: 600; color: #344054;">Country Flag</span>
                            <span id="flagBadge" style="font-size: 10px; font-weight: 600; padding: 2px 7px; border-radius: 4px; background: #e0f2fe; color: #0284c7;">Automatic</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div onclick="document.getElementById('flagFileInput').click()" title="Choose a flag image"
                                 style="cursor: pointer; width: 64px; height: 42px; border-radius: 6px; overflow: hidden; border: 1px solid #d0d5dd; background: #fff; flex-shrink: 0;">
                                <img id="flagPreviewImg" src="https://flagcdn.com/w80/un.png" alt="Flag preview" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                    <button type="button" class="btn-upload-logo" onclick="document.getElementById('flagFileInput').click()">Upload Flag Image</button>
                                    <button type="button" id="btnUseAutoFlag" class="btn-remove-logo" style="display: none;" onclick="useAutomaticFlag()">Use Automatic Flag</button>
                                </div>
                                <div style="font-size: 11px; color: #697386; margin-top: 4px;">
                                    JPG, PNG, WEBP or GIF, up to 2 MB. Leave empty to pick a flag automatically from the country name.
                                </div>
                            </div>
                        </div>
                        <input type="file" id="flagFileInput" name="flag_image" accept=".jpg,.jpeg,.png,.webp,.gif,image/jpeg,image/png,image/webp,image/gif" style="display: none;" onchange="handleFlagFileSelect(event)">
                        <input type="hidden" name="remove_flag" id="removeFlagInput" value="0">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="statusInput">Status *</label>
                    <select id="statusInput" name="is_active" class="form-select-modal" required>
                        <option value="1" @selected(old('is_active', '1') == '1')>Active</option>
                        <option value="0" @selected(old('is_active') === '0')>Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descriptionInput">Description</label>
                    <textarea id="descriptionInput" name="description" class="form-textarea"
                              placeholder="Visa rules, proof of funds, popular cities, or anything students should know...">{{ old('description') }}</textarea>
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
     MODAL 2: VIEW COUNTRY
====================================================== -->
<div class="modal-backdrop" id="viewCountryModal">
    <div class="modal-window" style="max-width: 600px;">
        <div class="modal-header">
            <div style="display: flex; align-items: center; gap: 12px;">
                <img id="modalCountryFlag" src="" alt="Flag" style="width: 38px; height: 26px; border-radius: 4px; object-fit: cover; border: 1px solid #e4e7ec;">
                <div>
                    <h3 class="modal-title" id="viewModalTitle">Country</h3>
                    <div class="modal-subtitle" id="viewModalSubtitle"></div>
                </div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('viewCountryModal')">✕</button>
        </div>
        <div class="modal-body">
            <div style="font-size: 13px; line-height: 1.65; color: #344054; white-space: pre-line;" id="viewModalDescription"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" onclick="closeModal('viewCountryModal')">Close</button>
        </div>
    </div>
</div>

<!-- =====================================================
     MODAL 3: DEACTIVATE CONFIRMATION
====================================================== -->
<div class="modal-backdrop" id="deleteModal">
    <div class="modal-window" style="max-width: 420px; text-align: center;">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-body" style="padding-top: 28px;">
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 22px;">⚠</div>
                <h3 class="modal-title" style="margin-bottom: 8px;">Delete Country</h3>
                <p style="font-size: 12px; color: #697386; line-height: 1.5; white-space: pre-line;" id="deleteConfirmText"></p>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
                <button type="submit" class="btn-danger">Delete Permanently</button>
            </div>
        </form>
    </div>
</div>

<!-- TOAST NOTIFICATION -->
<div class="toast" id="toast">
    <span id="toastMessage"></span>
</div>

<script>
    // Countries on this page, straight from the database.
    const countries = @json($countriesForJs);

    const countriesBaseUrl = @json(url('admin/countries'));
    const storeUrl = @json(route('admin.countries.store'));

    // Country name -> 2-letter code, used only to show a flag picture.
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

    // Suggested 3-letter codes while typing a name.
    const countryCodeMap = {
        'canada': 'CAN', 'united kingdom': 'GBR', 'uk': 'GBR', 'united states': 'USA', 'usa': 'USA',
        'australia': 'AUS', 'germany': 'DEU', 'ireland': 'IRL', 'new zealand': 'NZL', 'singapore': 'SGP',
        'france': 'FRA', 'netherlands': 'NLD', 'sweden': 'SWE', 'japan': 'JPN', 'italy': 'ITA',
        'spain': 'ESP', 'switzerland': 'CHE', 'china': 'CHN', 'south korea': 'KOR', 'malaysia': 'MYS',
        'uae': 'ARE', 'united arab emirates': 'ARE', 'india': 'IND', 'sri lanka': 'LKA'
    };

    function getCountryFlag(name = '', code = '') {
        const cleanName = (name || '').toLowerCase().trim();
        const cleanCode = (code || '').toLowerCase().trim();

        if (countryIsoMap[cleanName]) {
            return 'https://flagcdn.com/w80/' + countryIsoMap[cleanName] + '.png';
        }
        if (cleanCode.length === 2) {
            return 'https://flagcdn.com/w80/' + cleanCode + '.png';
        }
        for (const [n, iso] of Object.entries(countryIsoMap)) {
            if (cleanName && (cleanName.includes(n) || n.includes(cleanName))) {
                return 'https://flagcdn.com/w80/' + iso + '.png';
            }
        }
        return 'https://flagcdn.com/w80/un.png';
    }

    // ---- Flag upload in the form ----
    let savedFlagUrl = null;   // flag already saved for the country being edited
    let pickedFlagUrl = null;  // preview of a newly chosen file

    function refreshFlagPreview() {
        const name = document.getElementById('countryNameInput').value;
        const code = document.getElementById('countryCodeInput').value;
        const removing = document.getElementById('removeFlagInput').value === '1';
        const custom = pickedFlagUrl || (!removing && savedFlagUrl);

        document.getElementById('flagPreviewImg').src = custom || getCountryFlag(name, code);
        document.getElementById('flagBadge').innerText = custom ? 'Uploaded' : 'Automatic';
        document.getElementById('btnUseAutoFlag').style.display = custom ? 'inline-flex' : 'none';
    }

    function resetFlagInput(existingUrl) {
        savedFlagUrl = existingUrl || null;
        pickedFlagUrl = null;
        document.getElementById('flagFileInput').value = '';
        document.getElementById('removeFlagInput').value = '0';
        refreshFlagPreview();
    }

    function handleFlagFileSelect(event) {
        const file = event.target.files && event.target.files[0];
        if (!file) return;

        if (file.size > 2 * 1024 * 1024) {
            event.target.value = '';
            showToast('The flag image must be 2 MB or smaller.');
            return;
        }

        pickedFlagUrl = URL.createObjectURL(file);
        document.getElementById('removeFlagInput').value = '0';
        refreshFlagPreview();
    }

    function useAutomaticFlag() {
        pickedFlagUrl = null;
        document.getElementById('flagFileInput').value = '';
        document.getElementById('removeFlagInput').value = savedFlagUrl ? '1' : '0';
        refreshFlagPreview();
    }

    function handleCountryNameInput(value) {
        const codeInput = document.getElementById('countryCodeInput');
        const suggestion = countryCodeMap[(value || '').toLowerCase().trim()];
        if (suggestion && !codeInput.value) {
            codeInput.value = suggestion;
        }
        refreshFlagPreview();
    }

    function findCountry(id) {
        return countries.find(c => c.id === id);
    }

    // Search and status filter (applies to the countries shown on this page)
    function applyFilters() {
        const query = document.getElementById('countrySearchInput').value.toLowerCase().trim();
        const status = document.getElementById('statusFilterSelect').value;
        let visibleRows = 0;

        document.querySelectorAll('.country-item').forEach(el => {
            const matches = (!query || el.dataset.search.includes(query))
                && (status === 'ALL' || el.dataset.status === status);
            el.style.display = matches ? '' : 'none';
            if (matches && el.tagName === 'TR') visibleRows++;
        });

        document.getElementById('noMatchRow').style.display =
            countries.length > 0 && visibleRows === 0 ? '' : 'none';
    }

    function switchView(mode) {
        const isTable = mode === 'table';
        document.getElementById('tableViewContainer').style.display = isTable ? 'block' : 'none';
        document.getElementById('cardsViewContainer').style.display = isTable ? 'none' : 'grid';
        document.getElementById('btnViewTable').classList.toggle('active', isTable);
        document.getElementById('btnViewCards').classList.toggle('active', !isTable);
    }

    function exportCSV() {
        const q = v => '"' + String(v ?? '').replace(/"/g, '""') + '"';
        let csv = 'Country Name,Code,Status,Description\n';
        countries.forEach(c => {
            csv += [q(c.name), q(c.code), q(c.active ? 'Active' : 'Inactive'), q(c.description)].join(',') + '\n';
        });

        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = `INDIC_RMC_Countries_${new Date().toISOString().split('T')[0]}.csv`;
        link.click();
        showToast('Exported countries to CSV.');
    }

    function viewCountry(id) {
        const c = findCountry(id);
        if (!c) return;

        document.getElementById('modalCountryFlag').src = c.flag || getCountryFlag(c.name, c.code);
        document.getElementById('viewModalTitle').innerText = c.name;
        document.getElementById('viewModalSubtitle').innerText =
            `Code: ${c.code || '—'} • ${c.active ? 'Active' : 'Inactive'}`;
        document.getElementById('viewModalDescription').innerText = c.description || 'No description yet.';
        openModal('viewCountryModal');
    }

    function clearFormErrors() {
        const box = document.querySelector('#countryForm .form-errors');
        if (box) box.remove();
    }

    function openAddModal() {
        clearFormErrors();
        const form = document.getElementById('countryForm');
        form.action = storeUrl;
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('editCountryId').value = '';
        document.getElementById('countryNameInput').value = '';
        document.getElementById('countryCodeInput').value = '';
        document.getElementById('statusInput').value = '1';
        document.getElementById('descriptionInput').value = '';
        resetFlagInput(null);
        document.getElementById('addEditModalTitle').innerText = 'Add New Country';
        openModal('addEditModal');
    }

    function openEditModal(id) {
        const c = findCountry(id);
        if (!c) return;

        clearFormErrors();
        setFormForEdit(id);
        document.getElementById('countryNameInput').value = c.name;
        document.getElementById('countryCodeInput').value = c.code || '';
        document.getElementById('statusInput').value = c.active ? '1' : '0';
        document.getElementById('descriptionInput').value = c.description || '';
        resetFlagInput(c.flag);
        openModal('addEditModal');
    }

    function setFormForEdit(id) {
        document.getElementById('countryForm').action = countriesBaseUrl + '/' + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('editCountryId').value = id;
        document.getElementById('addEditModalTitle').innerText = 'Edit Country';
    }

    function openDeleteModal(id) {
        const c = findCountry(id);
        if (!c) return;

        document.getElementById('deleteForm').action = countriesBaseUrl + '/' + id;
        const plural = (n, word) => `${n} ${word}${n === 1 ? '' : 's'}`;
        const parts = [];
        if (c.universityCount) parts.push(plural(c.universityCount, 'university').replace('universitys', 'universities'));
        if (c.courseCount) parts.push(plural(c.courseCount, 'course'));

        document.getElementById('deleteConfirmText').innerText =
            `"${c.name}" will be deleted permanently`
            + (parts.length ? `, together with its ${parts.join(' and ')} (and their scholarships)` : '')
            + '. This cannot be undone.\n\nTo hide it from the website without deleting, use Edit and set the status to Inactive.';
        openModal('deleteModal');
    }

    function openModal(id) {
        document.getElementById(id).classList.add('open');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    function showToast(msg) {
        const toast = document.getElementById('toast');
        document.getElementById('toastMessage').innerText = msg;
        toast.style.display = 'flex';
        setTimeout(() => { toast.style.display = 'none'; }, 3200);
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('img[data-flag-name]').forEach(img => {
            img.src = img.dataset.flagUrl || getCountryFlag(img.dataset.flagName, img.dataset.flagCode);
        });

        document.getElementById('countrySearchInput').addEventListener('input', applyFilters);
        document.getElementById('statusFilterSelect').addEventListener('change', applyFilters);
        document.getElementById('countryCodeInput').addEventListener('input', refreshFlagPreview);

        @if (session('success'))
            showToast(@json(session('success')));
        @endif

        // If saving failed validation, reopen the form with what was typed.
        @if ($errors->any())
            @if (old('edit_id'))
                setFormForEdit({{ (int) old('edit_id') }});
                resetFlagInput((findCountry({{ (int) old('edit_id') }}) || {}).flag);
            @else
                resetFlagInput(null);
            @endif
            openModal('addEditModal');
        @endif
    });
</script>

</body>
</html>