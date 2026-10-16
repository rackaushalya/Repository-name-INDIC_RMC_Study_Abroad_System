<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDIC RMC | University Management</title>

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
           MAIN
        ===================================================== */
        .main {
            margin-left: 245px;
            min-height: 100vh;
        }

        /* =====================================================
           TOPBAR
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
           CONTROLS CARD
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
        }

        .search-control {
            position: relative;
            flex: 1;
            max-width: 360px;
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
            background: #ea580c;
        }

        .btn-orange:active {
            transform: scale(0.98);
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

        .uni-identity {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .uni-logo-thumb {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            flex-shrink: 0;
        }

        .uni-name-text {
            font-weight: 600;
            color: #172033;
            font-size: 13px;
        }

        .uni-meta-text {
            font-size: 11px;
            color: #8a93a3;
            margin-top: 2px;
        }

        .country-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: #172033;
            font-weight: 500;
        }

        .country-flag-icon {
            width: 20px;
            height: 14px;
            border-radius: 2px;
            object-fit: cover;
            border: 1px solid rgba(0,0,0,0.1);
        }

        .ranking-pill {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
        }

        .email-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #4b5565;
            font-family: inherit;
            font-size: 11px;
            background: #f4f5f7;
            padding: 4px 8px;
            border-radius: 6px;
            cursor: pointer;
            transition: all .15s;
        }

        .email-chip:hover {
            background: #fff2e8;
            color: #f97316;
        }

        .actions-cell {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-view-courses {
            background: #fff2e8;
            color: #c2410c;
            border: 1px solid rgba(249, 115, 22, 0.3);
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all .15s;
        }

        .btn-view-courses:hover {
            background: #f97316;
            color: #ffffff;
            border-color: #f97316;
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
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
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
            gap: 14px;
            transition: transform .15s, box-shadow .15s;
        }

        .uni-grid-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            transform: translateY(-2px);
        }

        .card-top {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .card-details {
            flex: 1;
        }

        .card-actions {
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid #f0f1f3;
            display: flex;
            align-items: center;
            justify-content: space-between;
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
           MODAL SYSTEM
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
            max-width: 620px;
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

        .btn-secondary {
            background: #ffffff;
            border: 1px solid #d0d5dd;
            color: #344054;
            padding: 8px 16px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s;
        }

        .btn-secondary:hover {
            background: #f9fafb;
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

        /* Logo upload styling */
        .logo-upload-box {
            border: 2px dashed #d0d5dd;
            border-radius: 8px;
            padding: 16px;
            background: #fafbfc;
            text-align: center;
            cursor: pointer;
            transition: all .2s ease;
        }

        .logo-upload-box:hover, .logo-upload-box.dragover {
            border-color: #f97316;
            background: #fffaf5;
        }

        .country-img-dropzone {
            transition: all .2s ease;
        }

        .country-img-dropzone:hover, .country-img-dropzone.dragover {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.15) !important;
            background: #fffaf5 !important;
        }

        .logo-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .logo-preview-thumb {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e1e5eb;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            background: #ffffff;
        }

        .logo-upload-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: #4b5565;
            font-size: 12px;
            font-weight: 500;
        }

        .logo-upload-placeholder svg {
            color: #8a93a3;
            margin-bottom: 2px;
        }

        .btn-upload-logo {
            background: #ffffff;
            border: 1px solid #d0d5dd;
            border-radius: 6px;
            padding: 6px 12px;
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
            padding: 6px 12px;
            font-size: 11px;
            font-weight: 600;
            color: #dc2626;
            cursor: pointer;
            transition: all .15s;
        }

        .btn-remove-logo:hover {
            background: #fee2e2;
        }

        /* Course list cards in modal */
        .course-card {
            background: #fafbfc;
            border: 1px solid #e7e9ed;
            border-radius: 8px;
            padding: 14px;
            margin-bottom: 10px;
        }

        .course-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .course-title {
            font-size: 13px;
            font-weight: 600;
            color: #172033;
        }

        .degree-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 4px;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .degree-badge.mba {
            background: #fdf2f8;
            color: #be185d;
        }

        .degree-badge.bachelor {
            background: #f0fdf4;
            color: #15803d;
        }

        .course-meta-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-top: 8px;
            font-size: 11px;
            color: #4b5565;
        }

        .meta-item strong {
            display: block;
            color: #172033;
            font-weight: 600;
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
            .main {
                margin-left: 70px;
            }
            .content {
                padding: 16px;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Database-backed page additions */
        .uni-initials { display: inline-flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; color: #c2410c; background: #fff2e8; }
        .status-pill { display: inline-block; padding: 3px 9px; border-radius: 999px; font-size: 10px; font-weight: 600; }
        .status-pill.active { background: #ecfdf3; color: #027a48; }
        .status-pill.inactive { background: #f2f4f7; color: #475467; }
        .form-errors { background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; border-radius: 8px; padding: 10px 14px; font-size: 12px; margin-bottom: 14px; }
        .form-errors ul { margin: 4px 0 0 16px; padding: 0; }
        .form-textarea-db { width: 100%; min-height: 90px; padding: 10px 12px; border: 1px solid #d0d5dd; border-radius: 8px; font-size: 13px; font-family: inherit; resize: vertical; }
        .empty-state { text-align: center; padding: 40px; color: #8a93a3; font-size: 13px; }
        .website-link { font-size: 12px; color: #2563eb; text-decoration: none; word-break: break-all; }
        .website-link:hover { text-decoration: underline; }
        .course-row { display: flex; justify-content: space-between; gap: 12px; padding: 10px 12px; border: 1px solid #eef0f3; border-radius: 8px; margin-bottom: 8px; font-size: 12px; }
        .table-footer .portal-pager { width: 100%; }
    </style>
@include('components.sidebar-style')
</head>
<body>

@php
    $allUniversities = $universities->getCollection();
    $allUniversities->loadCount('scholarships');
    $totalUniversities = $universities->total();

    // Every country for the dropdown (inactive ones are marked).
    $countryOptions = \App\Models\Country::orderBy('country_name')->get();

    $universitiesForJs = $allUniversities->map(fn ($u) => [
        'id' => $u->university_id,
        'name' => $u->university_name,
        'code' => $u->university_code,
        'countryId' => $u->country_id,
        'country' => $u->country?->country_name,
        'countryCode' => $u->country?->country_code,
        'countryFlag' => $u->country?->flag_url,
        'city' => $u->city,
        'address' => $u->address,
        'website' => $u->website,
        'ranking' => $u->ranking,
        'description' => $u->description,
        'active' => (bool) $u->is_active,
        'logo' => $u->logo_url,
        'scholarshipCount' => (int) $u->scholarships_count,
        'courses' => $u->courses->map(fn ($c) => [
            'name' => $c->course_name,
            'level' => $c->course_level,
            'duration' => $c->duration,
            'mode' => $c->study_mode,
            'active' => (bool) $c->is_active,
        ])->values(),
    ])->values();
@endphp

<div class="app">

    @include('components.admin-sidebar')

    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="search-box">
                <span class="search-icon"><i class="bi bi-search"></i></span>
                <input type="text" id="topbarSearchInput" placeholder="Quick search universities, courses...">
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

        <!-- CONTENT -->
        <section class="content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <div>
                    <h1>
                        University Management
                        <span class="title-badge">{{ $totalUniversities }} {{ Str::plural('University', $totalUniversities) }}</span>
                    </h1>
                    <p>Manage partner universities, their locations, rankings and degree programs.</p>
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
                        <input type="text" id="uniSearchInput" placeholder="Search by name, code, city or country...">
                    </div>

                    <select id="countryFilterSelect" class="filter-select">
                        <option value="ALL">Filter by Country</option>
                        @foreach ($countryOptions as $option)
                            <option value="{{ $option->country_id }}">{{ $option->country_name }}</option>
                        @endforeach
                    </select>

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

                    <button type="button" class="btn-orange" onclick="openAddModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Add New University
                    </button>
                </div>
            </div>

            @if (session('error'))
                <div class="form-errors" style="margin-bottom: 16px;">
                    {{ session('error') }}
                </div>
            @endif

            @if ($countryOptions->isEmpty())
                <div class="form-errors" style="margin-bottom: 16px;">
                    You need at least one country before adding a university.
                    <a href="{{ route('admin.countries-list') }}" style="color: inherit; font-weight: 700;">Add a country first →</a>
                </div>
            @endif

            <!-- CORE DATA CONTAINER -->
            <div class="card-container">

                <!-- TABLE VIEW -->
                <div class="table-responsive" id="tableViewContainer">
                    <table class="uni-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">Image</th>
                                <th>University Name</th>
                                <th>Location (Country)</th>
                                <th>Ranking</th>
                                <th>Website</th>
                                <th>Status</th>
                                <th style="text-align: right; width: 220px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allUniversities as $uni)
                                <tr class="uni-item"
                                    data-search="{{ strtolower($uni->university_name . ' ' . $uni->university_code . ' ' . $uni->city . ' ' . $uni->country?->country_name) }}"
                                    data-country="{{ $uni->country_id }}"
                                    data-status="{{ $uni->is_active ? 'Active' : 'Inactive' }}">
                                    <td>
                                        @if ($uni->logo_url)
                                            <img src="{{ $uni->logo_url }}" alt="{{ $uni->university_name }}" class="uni-logo-thumb">
                                        @else
                                            <span class="uni-logo-thumb uni-initials">{{ strtoupper(substr($uni->university_name, 0, 1)) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="uni-name-text">{{ $uni->university_name }}</div>
                                        <div class="uni-meta-text">
                                            {{ $uni->university_code ?: 'No code' }} • {{ $uni->courses->count() }} {{ Str::plural('course', $uni->courses->count()) }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="country-pill">
                                            <img class="country-flag-icon" alt=""
                                                 data-flag-url="{{ $uni->country?->flag_url }}"
                                                 data-flag-name="{{ $uni->country?->country_name }}"
                                                 data-flag-code="{{ $uni->country?->country_code }}"
                                                 src="https://flagcdn.com/w80/un.png">
                                            {{ $uni->country?->country_name ?? 'Unknown' }}
                                        </span>
                                        <div class="uni-meta-text">{{ $uni->city ?: '—' }}</div>
                                    </td>
                                    <td>
                                        @if ($uni->ranking)
                                            <span class="ranking-pill">#{{ $uni->ranking }}</span>
                                        @else
                                            <span class="uni-meta-text">Not ranked</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($uni->website)
                                            <a href="{{ $uni->website }}" target="_blank" rel="noopener" class="website-link">
                                                {{ preg_replace('#^https?://(www\.)?#', '', rtrim($uni->website, '/')) }}
                                            </a>
                                        @else
                                            <span class="uni-meta-text">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="status-pill {{ $uni->is_active ? 'active' : 'inactive' }}">
                                            {{ $uni->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions-cell">
                                            <button type="button" class="btn-view-courses" onclick="viewCourses({{ $uni->university_id }})">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                                View Courses
                                            </button>
                                            <button type="button" class="btn-icon-action" onclick="openEditModal({{ $uni->university_id }})" title="Edit university">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                            </button>
                                            <button type="button" class="btn-icon-action delete" onclick="openDeleteModal({{ $uni->university_id }})" title="Delete university">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="empty-state">No universities yet. Click <strong>Add New University</strong> to create the first one.</td></tr>
                            @endforelse
                            <tr id="noMatchRow" style="display: none;"><td colspan="7" class="empty-state">No universities match your search or filters.</td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- CARDS VIEW -->
                <div class="cards-grid" id="cardsViewContainer" style="display: none;">
                    @foreach ($allUniversities as $uni)
                        <div class="uni-grid-card uni-item"
                             data-search="{{ strtolower($uni->university_name . ' ' . $uni->university_code . ' ' . $uni->city . ' ' . $uni->country?->country_name) }}"
                             data-country="{{ $uni->country_id }}"
                             data-status="{{ $uni->is_active ? 'Active' : 'Inactive' }}">
                            <div class="card-top">
                                @if ($uni->logo_url)
                                    <img src="{{ $uni->logo_url }}" class="uni-logo-thumb" style="width: 48px; height: 48px;" alt="{{ $uni->university_name }}">
                                @else
                                    <span class="uni-logo-thumb uni-initials" style="width: 48px; height: 48px;">{{ strtoupper(substr($uni->university_name, 0, 1)) }}</span>
                                @endif
                                <div class="card-details">
                                    <div class="uni-name-text">{{ $uni->university_name }}</div>
                                    <div class="uni-meta-text" style="display: flex; align-items: center; gap: 6px; margin-top: 2px;">
                                        <img class="country-flag-icon" alt=""
                                             data-flag-url="{{ $uni->country?->flag_url }}"
                                             data-flag-name="{{ $uni->country?->country_name }}"
                                             data-flag-code="{{ $uni->country?->country_code }}"
                                             src="https://flagcdn.com/w80/un.png">
                                        <span>{{ $uni->city ? $uni->city . ', ' : '' }}{{ $uni->country?->country_name }}</span>
                                    </div>
                                    <div style="margin-top: 8px; display: flex; gap: 6px; align-items: center;">
                                        @if ($uni->ranking)
                                            <span class="ranking-pill">#{{ $uni->ranking }}</span>
                                        @endif
                                        <span class="status-pill {{ $uni->is_active ? 'active' : 'inactive' }}">{{ $uni->is_active ? 'Active' : 'Inactive' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div style="font-size: 11px; color: #4b5565;">
                                <div><strong>Programs:</strong> {{ $uni->courses->count() }} {{ Str::plural('course', $uni->courses->count()) }}</div>
                            </div>
                            <div class="card-actions">
                                <button type="button" class="btn-view-courses" onclick="viewCourses({{ $uni->university_id }})">View Courses</button>
                                <div style="display: flex; gap: 6px;">
                                    <button type="button" class="btn-icon-action" onclick="openEditModal({{ $uni->university_id }})" title="Edit university"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>
                                    <button type="button" class="btn-icon-action delete" onclick="openDeleteModal({{ $uni->university_id }})" title="Delete university"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- TABLE FOOTER -->
                <div class="table-footer">
                    @if ($universities->hasPages())
                        {{ $universities->links('pagination.portal') }}
                    @else
                        <div>Showing {{ $totalUniversities }} {{ Str::plural('university', $totalUniversities) }}</div>
                        <div>Click <strong>View Courses</strong> to see a university's programs.</div>
                    @endif
                </div>
            </div>

        </section>
    </main>
</div>

<!-- =====================================================
     MODAL 1: ADD / EDIT UNIVERSITY (saves to the database)
====================================================== -->
<div class="modal-backdrop" id="addEditModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="addEditModalTitle">Add New University</h3>
                <div class="modal-subtitle">Add a partner university to the system.</div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('addEditModal')">✕</button>
        </div>
        <form id="uniForm" method="POST" action="{{ route('admin.universities.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="edit_id" id="editUniId" value="{{ old('edit_id') }}">
            <input type="hidden" name="remove_logo" id="removeLogoInput" value="0">
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

                <!-- Logo Upload -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label">University Image</label>
                    <div class="logo-upload-box" onclick="document.getElementById('uniLogoFile').click()">
                        <div class="logo-preview-container">
                            <img id="logoPreviewImg" src="" alt="Image preview" style="display: none;" class="logo-preview-thumb">
                            <div id="logoUploadPlaceholder" class="logo-upload-placeholder">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                <span>Click to choose an image (shown as the card background on the public website)</span>
                                <span style="font-size: 10px; color: #8a93a3;">JPG, PNG, WEBP or GIF, up to 2 MB (optional)</span>
                            </div>
                        </div>
                        <input type="file" id="uniLogoFile" name="logo_image" accept=".jpg,.jpeg,.png,.webp,.gif,image/jpeg,image/png,image/webp,image/gif" style="display: none;" onchange="handleLogoFileSelect(event)">
                    </div>
                    <div style="display: flex; gap: 8px; justify-content: flex-end; margin-top: 6px;">
                        <button type="button" class="btn-remove-logo" id="btnRemoveLogo" style="display: none;" onclick="removeLogo()">
                            Remove Image
                        </button>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="uniNameInput">University Name *</label>
                        <input type="text" id="uniNameInput" name="university_name" class="form-input" placeholder="e.g. University of Toronto"
                               maxlength="255" required value="{{ old('university_name') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="uniCodeInput">Short Code</label>
                        <input type="text" id="uniCodeInput" name="university_code" class="form-input" placeholder="e.g. UOFT"
                               maxlength="50" value="{{ old('university_code') }}" style="text-transform: uppercase;">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="uniCountryInput">Country *</label>
                        <select id="uniCountryInput" name="country_id" class="form-select-modal" required>
                            <option value="">Choose a country...</option>
                            @foreach ($countryOptions as $option)
                                <option value="{{ $option->country_id }}" @selected(old('country_id') == $option->country_id)>
                                    {{ $option->country_name }}{{ $option->is_active ? '' : ' (inactive)' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="uniCityInput">City</label>
                        <input type="text" id="uniCityInput" name="city" class="form-input" placeholder="e.g. Toronto"
                               maxlength="100" value="{{ old('city') }}">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="uniRankingInput">World Ranking</label>
                        <input type="number" id="uniRankingInput" name="ranking" class="form-input" placeholder="e.g. 21"
                               min="1" step="1" value="{{ old('ranking') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="uniWebsiteInput">Website</label>
                        <input type="url" id="uniWebsiteInput" name="website" class="form-input" placeholder="https://www.university.edu"
                               maxlength="255" value="{{ old('website') }}">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="uniAddressInput">Address</label>
                        <input type="text" id="uniAddressInput" name="address" class="form-input" placeholder="Street address"
                               maxlength="255" value="{{ old('address') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="uniStatusInput">Status *</label>
                        <select id="uniStatusInput" name="is_active" class="form-select-modal" required>
                            <option value="1" @selected(old('is_active', '1') == '1')>Active</option>
                            <option value="0" @selected(old('is_active') === '0')>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="uniDescriptionInput">Description</label>
                    <textarea id="uniDescriptionInput" name="description" class="form-textarea-db"
                              placeholder="What makes this university a good choice for students...">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('addEditModal')">Cancel</button>
                <button type="submit" class="btn-orange">Save University</button>
            </div>
        </form>
    </div>
</div>

<!-- =====================================================
     MODAL 2: VIEW COURSES
====================================================== -->
<div class="modal-backdrop" id="viewCoursesModal">
    <div class="modal-window" style="max-width: 680px;">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="courseModalTitle">Courses</h3>
                <div class="modal-subtitle" id="courseModalSubtitle"></div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('viewCoursesModal')">✕</button>
        </div>
        <div class="modal-body" id="coursesListContainer"></div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" onclick="closeModal('viewCoursesModal')">Close</button>
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
                <div style="width: 50px; height: 50px; border-radius: 50%; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px;">⚠</div>
                <h3 class="modal-title" style="margin-bottom: 8px;">Delete University</h3>
                <p style="font-size: 12px; color: #697386; white-space: pre-line; line-height: 1.5;" id="deleteConfirmText"></p>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
                <button type="submit" class="btn-danger">Delete Permanently</button>
            </div>
        </form>
    </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast">
    <span id="toastMessage"></span>
</div>

<script>
    // Universities on this page, straight from the database.
    const universities = @json($universitiesForJs);

    const universitiesBaseUrl = @json(url('admin/universities'));
    const storeUrl = @json(route('admin.universities.store'));

    // Country name -> 2-letter code, used only to show a flag picture.
    const countryIsoMap = {
        'argentina': 'ar', 'australia': 'au', 'austria': 'at', 'bangladesh': 'bd', 'belgium': 'be',
        'brazil': 'br', 'canada': 'ca', 'china': 'cn', 'cyprus': 'cy', 'czech republic': 'cz',
        'czechia': 'cz', 'denmark': 'dk', 'estonia': 'ee', 'finland': 'fi', 'france': 'fr',
        'georgia': 'ge', 'germany': 'de', 'greece': 'gr', 'hong kong': 'hk', 'hungary': 'hu',
        'iceland': 'is', 'india': 'in', 'indonesia': 'id', 'ireland': 'ie', 'italy': 'it',
        'japan': 'jp', 'latvia': 'lv', 'lithuania': 'lt', 'luxembourg': 'lu', 'malaysia': 'my',
        'maldives': 'mv', 'malta': 'mt', 'mauritius': 'mu', 'netherlands': 'nl', 'new zealand': 'nz',
        'norway': 'no', 'poland': 'pl', 'portugal': 'pt', 'qatar': 'qa', 'romania': 'ro',
        'russia': 'ru', 'saudi arabia': 'sa', 'singapore': 'sg', 'slovakia': 'sk', 'slovenia': 'si',
        'south africa': 'za', 'south korea': 'kr', 'korea': 'kr', 'spain': 'es', 'sri lanka': 'lk',
        'sweden': 'se', 'switzerland': 'ch', 'taiwan': 'tw', 'thailand': 'th', 'turkey': 'tr',
        'ukraine': 'ua', 'united arab emirates': 'ae', 'uae': 'ae', 'united kingdom': 'gb', 'uk': 'gb',
        'united states': 'us', 'usa': 'us', 'vietnam': 'vn'
    };

    function getCountryFlag(name = '', code = '') {
        const cleanName = (name || '').toLowerCase().trim();
        const cleanCode = (code || '').toLowerCase().trim();
        if (countryIsoMap[cleanName]) return 'https://flagcdn.com/w80/' + countryIsoMap[cleanName] + '.png';
        if (cleanCode.length === 2) return 'https://flagcdn.com/w80/' + cleanCode + '.png';
        return 'https://flagcdn.com/w80/un.png';
    }

    function findUniversity(id) {
        return universities.find(u => u.id === id);
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.innerText = value ?? '';
        return div.innerHTML;
    }

    // ---- Search and filters (apply to the universities on this page) ----
    function applyFilters() {
        const query = document.getElementById('uniSearchInput').value.toLowerCase().trim();
        const country = document.getElementById('countryFilterSelect').value;
        const status = document.getElementById('statusFilterSelect').value;
        let visibleRows = 0;

        document.querySelectorAll('.uni-item').forEach(el => {
            const matches = (!query || el.dataset.search.includes(query))
                && (country === 'ALL' || el.dataset.country === country)
                && (status === 'ALL' || el.dataset.status === status);
            el.style.display = matches ? '' : 'none';
            if (matches && el.tagName === 'TR') visibleRows++;
        });

        document.getElementById('noMatchRow').style.display =
            universities.length > 0 && visibleRows === 0 ? '' : 'none';
    }

    function switchView(mode) {
        const isTable = mode === 'table';
        document.getElementById('tableViewContainer').style.display = isTable ? 'block' : 'none';
        document.getElementById('cardsViewContainer').style.display = isTable ? 'none' : 'grid';
        document.getElementById('btnViewTable').classList.toggle('active', isTable);
        document.getElementById('btnViewCards').classList.toggle('active', !isTable);
    }

    // ---- View courses ----
    function viewCourses(id) {
        const uni = findUniversity(id);
        if (!uni) return;

        document.getElementById('courseModalTitle').innerText = uni.name + ' – Courses';
        document.getElementById('courseModalSubtitle').innerText =
            `${uni.courses.length} ${uni.courses.length === 1 ? 'course' : 'courses'} in the system`;

        const container = document.getElementById('coursesListContainer');
        if (uni.courses.length === 0) {
            container.innerHTML = '<div class="empty-state">No courses have been added for this university yet.</div>';
        } else {
            container.innerHTML = uni.courses.map(c => `
                <div class="course-row">
                    <div>
                        <strong>${escapeHtml(c.name)}</strong>
                        <div class="uni-meta-text">${escapeHtml(c.level)}${c.mode ? ' • ' + escapeHtml(c.mode) : ''}</div>
                    </div>
                    <div style="text-align: right;">
                        <div>${escapeHtml(c.duration || '')}</div>
                        <span class="status-pill ${c.active ? 'active' : 'inactive'}">${c.active ? 'Active' : 'Inactive'}</span>
                    </div>
                </div>`).join('');
        }

        openModal('viewCoursesModal');
    }

    // ---- Logo upload in the form ----
    let savedLogoUrl = null;
    let pickedLogoUrl = null;

    function refreshLogoPreview() {
        const removing = document.getElementById('removeLogoInput').value === '1';
        const shown = pickedLogoUrl || (!removing && savedLogoUrl);
        const img = document.getElementById('logoPreviewImg');

        img.src = shown || '';
        img.style.display = shown ? 'block' : 'none';
        document.getElementById('logoUploadPlaceholder').style.display = shown ? 'none' : 'flex';
        document.getElementById('btnRemoveLogo').style.display = shown ? 'inline-flex' : 'none';
    }

    function resetLogoInput(existingUrl) {
        savedLogoUrl = existingUrl || null;
        pickedLogoUrl = null;
        document.getElementById('uniLogoFile').value = '';
        document.getElementById('removeLogoInput').value = '0';
        refreshLogoPreview();
    }

    function handleLogoFileSelect(event) {
        const file = event.target.files && event.target.files[0];
        if (!file) return;

        if (file.size > 2 * 1024 * 1024) {
            event.target.value = '';
            showToast('The image must be 2 MB or smaller.');
            return;
        }

        pickedLogoUrl = URL.createObjectURL(file);
        document.getElementById('removeLogoInput').value = '0';
        refreshLogoPreview();
    }

    function removeLogo() {
        pickedLogoUrl = null;
        document.getElementById('uniLogoFile').value = '';
        document.getElementById('removeLogoInput').value = savedLogoUrl ? '1' : '0';
        refreshLogoPreview();
    }

    // ---- Add / edit ----
    function clearFormErrors() {
        const box = document.querySelector('#uniForm .form-errors');
        if (box) box.remove();
    }

    function openAddModal() {
        clearFormErrors();
        const form = document.getElementById('uniForm');
        form.action = storeUrl;
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('editUniId').value = '';
        document.getElementById('addEditModalTitle').innerText = 'Add New University';

        ['uniNameInput', 'uniCodeInput', 'uniCountryInput', 'uniCityInput', 'uniRankingInput',
         'uniWebsiteInput', 'uniAddressInput', 'uniDescriptionInput'].forEach(id => {
            document.getElementById(id).value = '';
        });
        document.getElementById('uniStatusInput').value = '1';

        resetLogoInput(null);
        openModal('addEditModal');
    }

    function setFormForEdit(id) {
        document.getElementById('uniForm').action = universitiesBaseUrl + '/' + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('editUniId').value = id;
        document.getElementById('addEditModalTitle').innerText = 'Edit University';
    }

    function openEditModal(id) {
        const uni = findUniversity(id);
        if (!uni) return;

        clearFormErrors();
        setFormForEdit(id);
        document.getElementById('uniNameInput').value = uni.name;
        document.getElementById('uniCodeInput').value = uni.code || '';
        document.getElementById('uniCountryInput').value = uni.countryId;
        document.getElementById('uniCityInput').value = uni.city || '';
        document.getElementById('uniRankingInput').value = uni.ranking || '';
        document.getElementById('uniWebsiteInput').value = uni.website || '';
        document.getElementById('uniAddressInput').value = uni.address || '';
        document.getElementById('uniStatusInput').value = uni.active ? '1' : '0';
        document.getElementById('uniDescriptionInput').value = uni.description || '';

        resetLogoInput(uni.logo);
        openModal('addEditModal');
    }

    function openDeleteModal(id) {
        const uni = findUniversity(id);
        if (!uni) return;

        document.getElementById('deleteForm').action = universitiesBaseUrl + '/' + id;
        const parts = [];
        if (uni.courses.length) parts.push(`${uni.courses.length} ${uni.courses.length === 1 ? 'course' : 'courses'} (with their fees and intakes)`);
        if (uni.scholarshipCount) parts.push(`${uni.scholarshipCount} ${uni.scholarshipCount === 1 ? 'scholarship' : 'scholarships'}`);

        document.getElementById('deleteConfirmText').innerText =
            `"${uni.name}" will be deleted permanently`
            + (parts.length ? `, together with its ${parts.join(' and ')}` : '')
            + '. This cannot be undone.\n\nTo hide it from the website without deleting, use Edit and set the status to Inactive.';
        openModal('deleteModal');
    }

    // ---- Helpers ----
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

        document.getElementById('uniSearchInput').addEventListener('input', applyFilters);
        document.getElementById('countryFilterSelect').addEventListener('change', applyFilters);
        document.getElementById('statusFilterSelect').addEventListener('change', applyFilters);

        @if (session('success'))
            showToast(@json(session('success')));
        @endif

        // If saving failed validation, reopen the form with what was typed.
        @if ($errors->any())
            @if (old('edit_id'))
                setFormForEdit({{ (int) old('edit_id') }});
                resetLogoInput((findUniversity({{ (int) old('edit_id') }}) || {}).logo);
            @else
                resetLogoInput(null);
            @endif
            openModal('addEditModal');
        @endif
    });
</script>

</body>
</html>