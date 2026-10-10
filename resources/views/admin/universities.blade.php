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
    </style>
@include('components.sidebar-style')
</head>
<body>

<div class="app">

    <!-- =====================================================
         SIDEBAR (Canonical Shell)
    ====================================================== -->
    @include('components.admin-sidebar')

    <!-- =====================================================
         MAIN CONTENT WRAPPER
    ====================================================== -->
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
                    <strong>{{ auth()->user()->first_name ?? 'Admin' }} {{ auth()->user()->last_name ?? 'User' }}</strong>
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
                        <span class="title-badge" id="totalUniBadge">7 Partner Universities</span>
                    </h1>
                    <p>Manage international university partnerships, global QS rankings, admissions contacts, and degree programs.</p>
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
                        <input type="text" id="uniSearchInput" placeholder="Search by name, country, ranking, or email...">
                    </div>

                    <select id="countryFilterSelect" class="filter-select">
                        <option value="ALL">Filter by Country</option>
                        <option value="Canada">Canada</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="Australia">Australia</option>
                        <option value="Germany">Germany</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Ireland">Ireland</option>
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

                    <button class="btn-orange" onclick="openAddModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        + Add New University
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
                                <th style="width: 60px;">Logo</th>
                                <th class="sortable" onclick="sortTable('name')">University Name ↕</th>
                                <th class="sortable" onclick="sortTable('country')">Location (Country) ↕</th>
                                <th class="sortable" onclick="sortTable('ranking')">Global Ranking ↕</th>
                                <th>Contact Email</th>
                                <th style="text-align: right; width: 220px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="uniTableBody">
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
                    <div id="footerStatsText">Showing 7 universities</div>
                    <div>Click <strong>View Courses</strong> to browse degree programs.</div>
                </div>
            </div>

        </section>
    </main>
</div>

<!-- =====================================================
     MODAL 1: ADD / EDIT UNIVERSITY
====================================================== -->
<div class="modal-backdrop" id="addEditModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="addEditModalTitle">Add New University</h3>
                <div class="modal-subtitle">Configure an international partner university.</div>
            </div>
            <button class="modal-close-btn" onclick="closeModal('addEditModal')">✕</button>
        </div>
        <form id="uniForm" onsubmit="saveUniversity(event)">
            <input type="hidden" id="editUniId">
            <div class="modal-body">
                <!-- Logo Upload Section -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label">University Logo (Desktop Upload)</label>
                    <div class="logo-upload-box" id="logoUploadArea" onclick="document.getElementById('uniLogoFile').click()">
                        <div class="logo-preview-container">
                            <img id="logoPreviewImg" src="" alt="Logo Preview" style="display: none;" class="logo-preview-thumb">
                            <div id="logoUploadPlaceholder" class="logo-upload-placeholder">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                <span>Click to choose or drag & drop logo from desktop</span>
                                <span style="font-size: 10px; color: #8a93a3;">PNG, JPG, WEBP or SVG</span>
                            </div>
                        </div>
                        <input type="file" id="uniLogoFile" accept="image/*" style="display: none;" onchange="handleLogoFileSelect(event)">
                    </div>
                    <div style="display: flex; gap: 8px; justify-content: flex-end; margin-top: 6px; margin-bottom: 8px;">
                        <button type="button" class="btn-upload-logo" onclick="document.getElementById('uniLogoFile').click()">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                            Choose Logo from Desktop
                        </button>
                        <button type="button" class="btn-remove-logo" id="btnRemoveLogo" style="display: none;" onclick="removeUploadedLogo(event)">
                            Remove Logo
                        </button>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">University Name *</label>
                        <input type="text" id="uniNameInput" class="form-input" placeholder="e.g. University of Toronto" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Acronym / Code</label>
                        <input type="text" id="uniCodeInput" class="form-input" placeholder="e.g. UofT, ICL">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <label class="form-label" style="margin-bottom: 0;">Country Destination *</label>
                            <button type="button" id="toggleCountryModeBtn" onclick="toggleCountryMode()" style="background: none; border: none; color: #f97316; font-size: 11px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 4px; padding: 0; outline: none;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                                <span>Type New Country</span>
                            </button>
                        </div>
                        
                        <!-- Mode 1: Country Select Dropdown -->
                        <div id="countrySelectContainer">
                            <select id="uniCountryInput" class="form-select-modal" required onchange="handleCountrySelectChange(this.value)">
                                <option value="Canada">Canada</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="Australia">Australia</option>
                                <option value="Germany">Germany</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Ireland">Ireland</option>
                                <option value="__TYPE_NEW__">+ Type a new country...</option>
                            </select>
                        </div>

                        <!-- Mode 2: Type Any Country Text Input -->
                        <div id="countryTypeContainer" style="display: none;">
                            <div style="display: flex; gap: 8px;">
                                <input type="text" id="uniCountryTextInput" list="countryDatalist" class="form-input" placeholder="Type country name (e.g. France, Japan)..." autocomplete="off" oninput="handleCountryTextInput(this.value)">
                                <button type="button" class="btn-secondary" onclick="setCountryInputMode('select')" style="padding: 0 12px; font-size: 11px; font-weight: 600; white-space: nowrap; height: 38px; border: 1px solid #dcdfe6; border-radius: 8px; background: #fff; cursor: pointer; color: #475467;">
                                    Use Dropdown
                                </button>
                            </div>
                            <datalist id="countryDatalist"></datalist>
                        </div>

                        <!-- Country Image / Flag Upload Section -->
                        <div id="countryImageSection" style="margin-top: 8px; background: #f9fafb; border: 1px dashed #d0d5dd; border-radius: 8px; padding: 8px 10px; transition: all 0.2s ease;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                <span style="font-size: 11px; font-weight: 600; color: #344054; display: flex; align-items: center; gap: 5px;">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                    Country Image / Flag
                                </span>
                                <span id="countryImgBadge" style="font-size: 9px; font-weight: 600; padding: 2px 6px; border-radius: 4px; background: #e0f2fe; color: #0284c7;">
                                    Auto Flag
                                </span>
                            </div>

                            <div style="display: flex; align-items: center; gap: 10px;">
                                <!-- Dropzone & Thumbnail Preview -->
                                <div id="countryImgDropArea" class="country-img-dropzone" onclick="document.getElementById('countryImageFileInput').click()" title="Click to choose or drag & drop country image from desktop" style="cursor: pointer; position: relative; width: 56px; height: 36px; border-radius: 6px; overflow: hidden; border: 1px solid #d0d5dd; background: #ffffff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                                    <img id="countryFlagPreviewImg" src="https://flagcdn.com/w80/ca.png" alt="Country Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>

                                <!-- Upload Controls -->
                                <div style="flex: 1; min-width: 0;">
                                    <div style="display: flex; gap: 6px; align-items: center; flex-wrap: wrap;">
                                        <button type="button" class="btn-upload-logo" onclick="document.getElementById('countryImageFileInput').click()" style="padding: 3px 8px; font-size: 10px; height: 26px; border-radius: 5px;">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                                <polyline points="17 8 12 3 7 8"/>
                                                <line x1="12" y1="3" x2="12" y2="15"/>
                                            </svg>
                                            Choose from Desktop
                                        </button>
                                        <button type="button" id="btnRemoveCountryImg" class="btn-remove-logo" style="display: none; padding: 3px 8px; font-size: 10px; height: 26px; border-radius: 5px;" onclick="removeUploadedCountryImage(event)">
                                            Reset
                                        </button>
                                    </div>
                                    <div style="font-size: 10px; color: #697386; margin-top: 3px;">
                                        Upload custom image or flag from desktop, or auto-detect.
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="countryImageFileInput" accept="image/*" style="display: none;" onchange="handleCountryImageFileSelect(event)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Campus City / State *</label>
                        <input type="text" id="uniCityInput" class="form-input" placeholder="e.g. Toronto, Ontario" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Global Ranking (QS World) *</label>
                        <input type="text" id="uniRankingInput" class="form-input" placeholder="e.g. #21 QS World" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Admissions Contact Email *</label>
                        <input type="email" id="uniEmailInput" class="form-input" placeholder="admissions@university.edu" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Institution Category</label>
                        <input type="text" id="uniCategoryInput" class="form-input" placeholder="e.g. Public Research University">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Official Website URL</label>
                        <input type="url" id="uniWebsiteInput" class="form-input" placeholder="https://www.university.edu">
                    </div>
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
                <h3 class="modal-title" id="courseModalTitle">Accredited Degree Programs</h3>
                <div class="modal-subtitle" id="courseModalSubtitle">Available degree options, fees, and requirements.</div>
            </div>
            <button class="modal-close-btn" onclick="closeModal('viewCoursesModal')">✕</button>
        </div>
        <div class="modal-body" id="coursesListContainer">
            <!-- Populated dynamically -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" onclick="closeModal('viewCoursesModal')">Close</button>
        </div>
    </div>
</div>

<!-- =====================================================
     MODAL 3: DELETE CONFIRMATION
====================================================== -->
<div class="modal-backdrop" id="deleteModal">
    <div class="modal-window" style="max-width: 420px; text-align: center;">
        <div class="modal-body" style="padding-top: 28px;">
            <div style="width: 50px; height: 50px; border-radius: 50%; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 24px;">⚠</div>
            <h3 class="modal-title" style="margin-bottom: 8px;">Delete University</h3>
            <p style="font-size: 12px; color: #697386;" id="deleteConfirmText">Are you sure you want to remove this university from the consultancy directory? This action cannot be undone.</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
            <button type="button" class="btn-danger" id="confirmDeleteBtn" onclick="confirmDelete()">Delete</button>
        </div>
    </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast">
    <span id="toastMessage">Action completed successfully.</span>
</div>

<!-- =====================================================
     INTERACTIVE CONTROLLER JAVASCRIPT
====================================================== -->
<script>
    // Initial Partner Universities Dataset
    const initialUniversities = [
        {
            id: "UNI-CAN-01",
            name: "University of Toronto",
            shortCode: "UofT",
            type: "Public Research University",
            logo: "https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=100&auto=format&fit=crop&q=80",
            country: "Canada",
            countryCode: "CAN",
            flag: "https://flagcdn.com/w80/ca.png",
            city: "Toronto, Ontario",
            ranking: "#21 QS World",
            rankingNum: 21,
            email: "admissions.international@utoronto.ca",
            website: "https://utoronto.ca",
            courses: [
                { name: "M.Sc. Advanced Computer Science & AI", degreeLevel: "Master's", duration: "2 Years", tuition: "CAD $47,800 / yr", intakes: "Sep 2025, Jan 2026", ielts: "7.0" },
                { name: "Master of Business Administration (Rotman MBA)", degreeLevel: "MBA", duration: "20 Months", tuition: "CAD $64,500 / yr", intakes: "Sep 2025", ielts: "7.0" },
                { name: "B.Sc. Mechanical Engineering (Co-op)", degreeLevel: "Bachelor's", duration: "4 Years", tuition: "CAD $42,200 / yr", intakes: "Sep 2025", ielts: "6.5" }
            ]
        },
        {
            id: "UNI-GBR-02",
            name: "Imperial College London",
            shortCode: "ICL",
            type: "Public Research University",
            logo: "https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=100&auto=format&fit=crop&q=80",
            country: "United Kingdom",
            countryCode: "GBR",
            flag: "https://flagcdn.com/w80/gb.png",
            city: "London, England",
            ranking: "#2 QS World",
            rankingNum: 2,
            email: "international-admissions@imperial.ac.uk",
            website: "https://imperial.ac.uk",
            courses: [
                { name: "M.Sc. Computing (Artificial Intelligence)", degreeLevel: "Master's", duration: "1 Year", tuition: "£41,750 / yr", intakes: "Oct 2025", ielts: "7.0" },
                { name: "M.Sc. Climate Change & Finance", degreeLevel: "Master's", duration: "1 Year", tuition: "£39,000 / yr", intakes: "Oct 2025", ielts: "7.0" },
                { name: "B.Eng. Aerospace & Aeronautical Engineering", degreeLevel: "Bachelor's", duration: "3 Years", tuition: "£37,900 / yr", intakes: "Oct 2025", ielts: "6.5" }
            ]
        },
        {
            id: "UNI-USA-03",
            name: "Columbia University",
            shortCode: "Columbia",
            type: "Ivy League Private Research University",
            logo: "https://images.unsplash.com/photo-1562774053-701939374585?w=100&auto=format&fit=crop&q=80",
            country: "United States",
            countryCode: "USA",
            flag: "https://flagcdn.com/w80/us.png",
            city: "New York City, New York",
            ranking: "#34 QS World",
            rankingNum: 34,
            email: "gradadmissions@columbia.edu",
            website: "https://columbia.edu",
            courses: [
                { name: "M.S. Data Science (DSI)", degreeLevel: "Master's", duration: "1.5 Years", tuition: "USD $58,200 / yr", intakes: "Sep 2025", ielts: "7.5" },
                { name: "Columbia Business School Full-Time MBA", degreeLevel: "MBA", duration: "2 Years", tuition: "USD $84,496 / yr", intakes: "Aug 2025, Jan 2026", ielts: "7.5" },
                { name: "M.S. Financial Engineering (IEOR)", degreeLevel: "Master's", duration: "1 Year", tuition: "USD $62,000 / yr", intakes: "Sep 2025", ielts: "7.0" }
            ]
        },
        {
            id: "UNI-AUS-04",
            name: "University of Melbourne",
            shortCode: "UniMelb",
            type: "Group of Eight Research University",
            logo: "https://images.unsplash.com/photo-1576495199011-eb94736d05d6?w=100&auto=format&fit=crop&q=80",
            country: "Australia",
            countryCode: "AUS",
            flag: "https://flagcdn.com/w80/au.png",
            city: "Melbourne, Victoria",
            ranking: "#13 QS World",
            rankingNum: 13,
            email: "study-abroad@unimelb.edu.au",
            website: "https://unimelb.edu.au",
            courses: [
                { name: "Master of Information Technology (Cyber Security)", degreeLevel: "Master's", duration: "2 Years", tuition: "AUD $51,680 / yr", intakes: "Feb 2026, Jul 2025", ielts: "6.5" },
                { name: "Bachelor of Commerce (Finance & Economics)", degreeLevel: "Bachelor's", duration: "3 Years", tuition: "AUD $47,232 / yr", intakes: "Feb 2026, Jul 2025", ielts: "6.5" }
            ]
        },
        {
            id: "UNI-DEU-05",
            name: "Technical University of Munich",
            shortCode: "TUM",
            type: "TU9 Technical University",
            logo: "https://images.unsplash.com/photo-1590012314607-cda9d9b699ae?w=100&auto=format&fit=crop&q=80",
            country: "Germany",
            countryCode: "DEU",
            flag: "https://flagcdn.com/w80/de.png",
            city: "Munich, Bavaria",
            ranking: "#28 QS World",
            rankingNum: 28,
            email: "studium@tum.de",
            website: "https://tum.de",
            courses: [
                { name: "M.Sc. Informatics (Computer Science)", degreeLevel: "Master's", duration: "2 Years", tuition: "€4,000 / sem", intakes: "Oct 2025, Apr 2026", ielts: "6.5" },
                { name: "M.Sc. Robotics, Cognition, Intelligence", degreeLevel: "Master's", duration: "2 Years", tuition: "€6,000 / sem", intakes: "Oct 2025", ielts: "6.5" }
            ]
        },
        {
            id: "UNI-SGP-06",
            name: "National University of Singapore",
            shortCode: "NUS",
            type: "Autonomous Research University",
            logo: "https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=100&auto=format&fit=crop&q=80",
            country: "Singapore",
            countryCode: "SGP",
            flag: "https://flagcdn.com/w80/sg.png",
            city: "Kent Ridge, Singapore",
            ranking: "#8 QS World",
            rankingNum: 8,
            email: "admissions.intl@nus.edu.sg",
            website: "https://nus.edu.sg",
            courses: [
                { name: "M.Sc. Computer Science (AI Track)", degreeLevel: "Master's", duration: "1.5 Years", tuition: "SGD $54,500 total", intakes: "Aug 2025, Jan 2026", ielts: "6.5" },
                { name: "NUS MBA (Full-Time)", degreeLevel: "MBA", duration: "17 Months", tuition: "SGD $87,000 total", intakes: "Aug 2025", ielts: "7.0" }
            ]
        },
        {
            id: "UNI-IRL-07",
            name: "Trinity College Dublin",
            shortCode: "TCD",
            type: "Collegiate Research University",
            logo: "https://images.unsplash.com/photo-1592280771190-3e2e4d571952?w=100&auto=format&fit=crop&q=80",
            country: "Ireland",
            countryCode: "IRL",
            flag: "https://flagcdn.com/w80/ie.png",
            city: "Dublin, Ireland",
            ranking: "#87 QS World",
            rankingNum: 87,
            email: "international.admissions@tcd.ie",
            website: "https://tcd.ie",
            courses: [
                { name: "M.Sc. High Performance Computing & Cloud", degreeLevel: "Master's", duration: "1 Year", tuition: "€25,400 / yr", intakes: "Sep 2025", ielts: "6.5" },
                { name: "M.Sc. International Management", degreeLevel: "Master's", duration: "1 Year", tuition: "€23,800 / yr", intakes: "Sep 2025", ielts: "7.0" }
            ]
        }
    ];

    let universities = [...initialUniversities];
    let activeSort = { column: 'ranking', ascending: true };
    let deleteTargetId = null;
    let currentLogoDataUrl = null;

    // Dynamic Countries Registry
    const defaultCountries = [
        "Australia",
        "Canada",
        "Germany",
        "Ireland",
        "Singapore",
        "United Kingdom",
        "United States"
    ];
    let availableCountries = Array.from(new Set([
        ...defaultCountries,
        ...universities.map(u => u.country)
    ])).sort();

    let countryInputMode = 'select'; // 'select' | 'type'
    let customCountryImages = {};
    let currentCountryImageDataUrl = null;

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

        const countryName = (countryInputMode === 'type')
            ? document.getElementById('uniCountryTextInput').value.trim()
            : document.getElementById('uniCountryInput').value.trim();

        if (countryName && customCountryImages[countryName]) {
            delete customCountryImages[countryName];
        }

        updateCountryImagePreview();
        showToast('Country image reset to auto flag.');
    }

    // Update Country Image preview & badge
    function updateCountryImagePreview() {
        const previewImg = document.getElementById('countryFlagPreviewImg');
        const badge = document.getElementById('countryImgBadge');
        const btnReset = document.getElementById('btnRemoveCountryImg');
        if (!previewImg) return;

        const countryName = (countryInputMode === 'type')
            ? document.getElementById('uniCountryTextInput').value.trim()
            : document.getElementById('uniCountryInput').value.trim();

        const customFlag = currentCountryImageDataUrl || customCountryImages[countryName];

        if (customFlag) {
            previewImg.src = customFlag;
            if (badge) {
                badge.innerText = 'Custom Image';
                badge.style.background = '#dcfce7';
                badge.style.color = '#15803d';
            }
            if (btnReset) btnReset.style.display = 'inline-flex';
        } else {
            const flagUrl = getCountryFlag(countryName);
            previewImg.src = flagUrl;
            if (badge) {
                badge.innerText = 'Auto Flag';
                badge.style.background = '#e0f2fe';
                badge.style.color = '#0284c7';
            }
            if (btnReset) btnReset.style.display = 'none';
        }
    }

    function handleCountryTextInput(val) {
        if (!currentCountryImageDataUrl) {
            updateCountryImagePreview();
        }
    }

    // Country flag ISO 2-letter mapping dictionary
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
        'mongolia': 'mn', 'montenegro': 'me', 'morocco': 'ma', 'myanmar': 'mm', 'nepal': 'np',
        'netherlands': 'nl', 'new zealand': 'nz', 'nigeria': 'ng', 'norway': 'no', 'oman': 'om',
        'pakistan': 'pk', 'panama': 'pa', 'peru': 'pe', 'philippines': 'ph', 'poland': 'pl',
        'portugal': 'pt', 'qatar': 'qa', 'romania': 'ro', 'russia': 'ru', 'saudi arabia': 'sa',
        'serbia': 'rs', 'singapore': 'sg', 'slovakia': 'sk', 'slovenia': 'si', 'south africa': 'za',
        'south korea': 'kr', 'spain': 'es', 'sri lanka': 'lk', 'sweden': 'se', 'switzerland': 'ch',
        'taiwan': 'tw', 'thailand': 'th', 'turkey': 'tr', 'ukraine': 'ua', 'united arab emirates': 'ae',
        'uae': 'ae', 'united kingdom': 'gb', 'uk': 'gb', 'united states': 'us', 'usa': 'us',
        'vietnam': 'vn'
    };

    function getCountryFlag(countryName) {
        if (!countryName) return 'https://flagcdn.com/w80/un.png';
        const clean = countryName.toLowerCase().trim();
        const code = countryIsoMap[clean];
        if (code) {
            return `https://flagcdn.com/w80/${code}.png`;
        }
        if (clean.length === 2 && /^[a-z]{2}$/.test(clean)) {
            return `https://flagcdn.com/w80/${clean}.png`;
        }
        return 'https://flagcdn.com/w80/un.png';
    }

    function getCountryCode(countryName) {
        if (!countryName) return 'GEN';
        const clean = countryName.trim().toUpperCase();
        if (clean.length <= 3 && /^[A-Z]{2,3}$/.test(clean)) return clean;
        const codes = {
            'CANADA': 'CAN', 'UNITED KINGDOM': 'GBR', 'UNITED STATES': 'USA',
            'AUSTRALIA': 'AUS', 'GERMANY': 'DEU', 'SINGAPORE': 'SGP',
            'IRELAND': 'IRL', 'FRANCE': 'FRA', 'JAPAN': 'JPN', 'SWITZERLAND': 'CHE',
            'NEW ZEALAND': 'NZL', 'NETHERLANDS': 'NLD', 'INDIA': 'IND', 'CHINA': 'CHN',
            'SPAIN': 'ESP', 'ITALY': 'ITA', 'SWEDEN': 'SWE', 'SOUTH KOREA': 'KOR',
            'UNITED ARAB EMIRATES': 'UAE', 'UAE': 'UAE', 'MALAYSIA': 'MYS', 'AUSTRIA': 'AUT'
        };
        if (codes[clean]) return codes[clean];
        const alphaOnly = clean.replace(/[^A-Z]/g, '');
        return alphaOnly.substring(0, 3) || 'UNI';
    }

    // Set Country input mode: 'select' (dropdown) or 'type' (text field)
    function setCountryInputMode(mode) {
        countryInputMode = mode;
        const selectContainer = document.getElementById('countrySelectContainer');
        const typeContainer = document.getElementById('countryTypeContainer');
        const toggleBtn = document.getElementById('toggleCountryModeBtn');
        const selectEl = document.getElementById('uniCountryInput');
        const textInputEl = document.getElementById('uniCountryTextInput');

        if (!selectContainer || !typeContainer) return;

        if (mode === 'type') {
            selectContainer.style.display = 'none';
            typeContainer.style.display = 'block';
            selectEl.removeAttribute('required');
            textInputEl.setAttribute('required', 'required');
            if (toggleBtn) {
                toggleBtn.innerHTML = `
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <span>Use Dropdown</span>
                `;
            }
            textInputEl.focus();
        } else {
            selectContainer.style.display = 'block';
            typeContainer.style.display = 'none';
            textInputEl.removeAttribute('required');
            selectEl.setAttribute('required', 'required');
            if (toggleBtn) {
                toggleBtn.innerHTML = `
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    <span>Type New Country</span>
                `;
            }
            if (selectEl.value === '__TYPE_NEW__') {
                selectEl.value = availableCountries[0] || 'Canada';
            }
        }
        updateCountryImagePreview();
    }

    function toggleCountryMode() {
        if (countryInputMode === 'select') {
            setCountryInputMode('type');
        } else {
            setCountryInputMode('select');
        }
    }

    function handleCountrySelectChange(val) {
        if (val === '__TYPE_NEW__') {
            setCountryInputMode('type');
            const textInput = document.getElementById('uniCountryTextInput');
            if (textInput) {
                textInput.value = '';
                textInput.focus();
            }
        } else {
            updateCountryImagePreview();
        }
    }

    // Populate all country dropdowns and datalists
    function populateCountryDropdowns(selectedVal = null) {
        // 1. Modal Select
        const modalSelect = document.getElementById('uniCountryInput');
        if (modalSelect) {
            const currentVal = selectedVal || modalSelect.value;
            modalSelect.innerHTML = '';
            availableCountries.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c;
                opt.textContent = c;
                modalSelect.appendChild(opt);
            });
            const newOpt = document.createElement('option');
            newOpt.value = '__TYPE_NEW__';
            newOpt.textContent = '+ Type a new country...';
            modalSelect.appendChild(newOpt);

            if (currentVal && availableCountries.includes(currentVal)) {
                modalSelect.value = currentVal;
            } else if (availableCountries.length > 0) {
                modalSelect.value = availableCountries[0];
            }
        }

        // 2. Datalist for autocomplete typing
        const datalist = document.getElementById('countryDatalist');
        if (datalist) {
            datalist.innerHTML = '';
            availableCountries.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c;
                datalist.appendChild(opt);
            });
        }

        // 3. Top filter select
        const filterSelect = document.getElementById('countryFilterSelect');
        if (filterSelect) {
            const curFilter = filterSelect.value || 'ALL';
            filterSelect.innerHTML = '<option value="ALL">Filter by Country</option>';
            availableCountries.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c;
                opt.textContent = c;
                filterSelect.appendChild(opt);
            });
            if (curFilter && (curFilter === 'ALL' || availableCountries.includes(curFilter))) {
                filterSelect.value = curFilter;
            } else {
                filterSelect.value = 'ALL';
            }
        }

        updateCountryImagePreview();
    }

    // Handle Logo file selected from desktop
    function handleLogoFileSelect(event) {
        const file = event.target.files && event.target.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            showToast('Please select a valid image file (PNG, JPG, SVG, WEBP).');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            currentLogoDataUrl = e.target.result;
            setLogoPreview(currentLogoDataUrl);
            showToast('Logo loaded from desktop!');
        };
        reader.readAsDataURL(file);
    }

    // Set logo preview display
    function setLogoPreview(dataUrl) {
        const previewImg = document.getElementById('logoPreviewImg');
        const placeholder = document.getElementById('logoUploadPlaceholder');
        const btnRemove = document.getElementById('btnRemoveLogo');

        if (dataUrl) {
            previewImg.src = dataUrl;
            previewImg.style.display = 'block';
            placeholder.style.display = 'none';
            btnRemove.style.display = 'inline-flex';
        } else {
            previewImg.src = '';
            previewImg.style.display = 'none';
            placeholder.style.display = 'flex';
            btnRemove.style.display = 'none';
        }
    }

    // Remove uploaded logo
    function removeUploadedLogo(event) {
        if (event) event.stopPropagation();
        currentLogoDataUrl = null;
        const fileInput = document.getElementById('uniLogoFile');
        if (fileInput) fileInput.value = '';
        setLogoPreview(null);
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        populateCountryDropdowns();
        renderTable();
        renderCards();

        // Search listener
        document.getElementById('uniSearchInput').addEventListener('input', applyFilters);
        document.getElementById('topbarSearchInput').addEventListener('input', (e) => {
            document.getElementById('uniSearchInput').value = e.target.value;
            applyFilters();
        });

        // Filter by country
        document.getElementById('countryFilterSelect').addEventListener('change', applyFilters);

        // Drag and drop for desktop logo upload
        const uploadArea = document.getElementById('logoUploadArea');
        if (uploadArea) {
            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    uploadArea.classList.add('dragover');
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    uploadArea.classList.remove('dragover');
                });
            });

            uploadArea.addEventListener('drop', (e) => {
                if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                    const file = e.dataTransfer.files[0];
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = (ev) => {
                            currentLogoDataUrl = ev.target.result;
                            setLogoPreview(currentLogoDataUrl);
                            showToast('Logo loaded from desktop!');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        showToast('Please drop a valid image file.');
                    }
                }
            });
        }

        // Drag and drop for country image upload
        const countryDropArea = document.getElementById('countryImgDropArea');
        if (countryDropArea) {
            ['dragenter', 'dragover'].forEach(eventName => {
                countryDropArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    countryDropArea.classList.add('dragover');
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                countryDropArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    countryDropArea.classList.remove('dragover');
                });
            });

            countryDropArea.addEventListener('drop', (e) => {
                if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                    const file = e.dataTransfer.files[0];
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = (ev) => {
                            currentCountryImageDataUrl = ev.target.result;
                            updateCountryImagePreview();
                            showToast('Country image loaded from desktop!');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        showToast('Please drop a valid image file.');
                    }
                }
            });
        }
    });

    // Render Table
    function renderTable(data = universities) {
        const tbody = document.getElementById('uniTableBody');
        tbody.innerHTML = '';

        if (data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" style="text-align: center; padding: 40px; color: #8a93a3;">No universities match your search or country criteria.</td></tr>`;
            return;
        }

        data.forEach(uni => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <img src="${uni.logo}" alt="${uni.name}" class="uni-logo-thumb">
                </td>
                <td>
                    <div class="uni-identity">
                        <div>
                            <div class="uni-name-text">${uni.name}</div>
                            <div class="uni-meta-text">${uni.shortCode || ''} • ${uni.type || 'University'}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="country-pill">
                        <img src="${uni.flag || 'https://flagcdn.com/w80/un.png'}" class="country-flag-icon" alt="${uni.country}">
                        ${uni.country}
                    </span>
                    <div class="uni-meta-text">${uni.city}</div>
                </td>
                <td>
                    <span class="ranking-pill">${uni.ranking}</span>
                </td>
                <td>
                    <span class="email-chip" onclick="copyEmail('${uni.email}')" title="Click to copy email">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                        ${uni.email}
                    </span>
                </td>
                <td>
                    <div class="actions-cell">
                        <button class="btn-view-courses" onclick="viewCourses('${uni.id}')">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            View Courses
                        </button>
                        <button class="btn-icon-action" onclick="openEditModal('${uni.id}')" title="Edit details">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <button class="btn-icon-action delete" onclick="openDeleteModal('${uni.id}')" title="Delete university">
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
    function renderCards(data = universities) {
        const container = document.getElementById('cardsViewContainer');
        container.innerHTML = '';

        data.forEach(uni => {
            const card = document.createElement('div');
            card.className = 'uni-grid-card';
            card.innerHTML = `
                <div class="card-top">
                    <img src="${uni.logo}" class="uni-logo-thumb" style="width: 48px; height: 48px;" alt="${uni.name}">
                    <div class="card-details">
                        <div class="uni-name-text">${uni.name}</div>
                        <div class="uni-meta-text" style="display: flex; align-items: center; gap: 6px; margin-top: 2px;">
                            <img src="${uni.flag || 'https://flagcdn.com/w80/un.png'}" class="country-flag-icon" alt="${uni.country}">
                            <span>${uni.city}, ${uni.country}</span>
                        </div>
                        <div style="margin-top: 8px;">
                            <span class="ranking-pill">${uni.ranking}</span>
                        </div>
                    </div>
                </div>
                <div style="font-size: 11px; color: #4b5565;">
                    <div><strong>Email:</strong> ${uni.email}</div>
                    <div style="margin-top: 3px;"><strong>Programs:</strong> ${uni.courses ? uni.courses.length : 0} accredited courses</div>
                </div>
                <div class="card-actions">
                    <button class="btn-view-courses" onclick="viewCourses('${uni.id}')">View Courses</button>
                    <div style="display: flex; gap: 6px;">
                        <button class="btn-icon-action" onclick="openEditModal('${uni.id}')"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>
                        <button class="btn-icon-action delete" onclick="openDeleteModal('${uni.id}')"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });
    }

    // Apply Filter & Search
    function applyFilters() {
        const query = document.getElementById('uniSearchInput').value.toLowerCase().trim();
        const selectedCountry = document.getElementById('countryFilterSelect').value;

        const filtered = universities.filter(u => {
            const matchesQuery = !query ||
                u.name.toLowerCase().includes(query) ||
                u.country.toLowerCase().includes(query) ||
                u.city.toLowerCase().includes(query) ||
                u.ranking.toLowerCase().includes(query) ||
                u.email.toLowerCase().includes(query);

            const matchesCountry = selectedCountry === 'ALL' || u.country.toLowerCase() === selectedCountry.toLowerCase();

            return matchesQuery && matchesCountry;
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

        universities.sort((a, b) => {
            let valA, valB;
            if (column === 'ranking') {
                valA = a.rankingNum || 999;
                valB = b.rankingNum || 999;
            } else {
                valA = (a[column] || '').toLowerCase();
                valB = (b[column] || '').toLowerCase();
            }

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

    // Copy Email
    function copyEmail(email) {
        navigator.clipboard.writeText(email).then(() => {
            showToast(`Copied ${email} to clipboard!`);
        });
    }

    // View Courses Modal
    function viewCourses(id) {
        const uni = universities.find(u => u.id === id);
        if (!uni) return;

        document.getElementById('courseModalTitle').innerText = `${uni.name}`;
        document.getElementById('courseModalSubtitle').innerText = `${uni.city}, ${uni.country} • ${uni.ranking}`;

        const container = document.getElementById('coursesListContainer');
        container.innerHTML = '';

        if (!uni.courses || uni.courses.length === 0) {
            container.innerHTML = `<div style="text-align:center; padding:20px; color:#8a93a3;">No courses registered yet.</div>`;
        } else {
            uni.courses.forEach(c => {
                const badgeClass = c.degreeLevel.toLowerCase().includes('mba') ? 'degree-badge mba' : (c.degreeLevel.toLowerCase().includes('bachelor') ? 'degree-badge bachelor' : 'degree-badge');
                const card = document.createElement('div');
                card.className = 'course-card';
                card.innerHTML = `
                    <div class="course-header">
                        <span class="course-title">${c.name}</span>
                        <span class="${badgeClass}">${c.degreeLevel}</span>
                    </div>
                    <div class="course-meta-grid">
                        <div class="meta-item"><span>Duration:</span> <strong>${c.duration}</strong></div>
                        <div class="meta-item"><span>Estimated Tuition:</span> <strong>${c.tuition}</strong></div>
                        <div class="meta-item"><span>IELTS Requirement:</span> <strong>${c.ielts}</strong></div>
                    </div>
                    <div style="font-size: 11px; color: #697386; margin-top: 6px;">
                        <span>Intakes: <strong>${c.intakes}</strong></span>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        openModal('viewCoursesModal');
    }

    // Add University
    function openAddModal() {
        document.getElementById('uniForm').reset();
        document.getElementById('editUniId').value = '';
        removeUploadedLogo();
        currentCountryImageDataUrl = null;
        const countryImgFileInput = document.getElementById('countryImageFileInput');
        if (countryImgFileInput) countryImgFileInput.value = '';
        setCountryInputMode('select');
        populateCountryDropdowns();
        updateCountryImagePreview();
        document.getElementById('addEditModalTitle').innerText = 'Add New University';
        openModal('addEditModal');
    }

    // Edit University
    function openEditModal(id) {
        const uni = universities.find(u => u.id === id);
        if (!uni) return;

        document.getElementById('editUniId').value = uni.id;
        document.getElementById('uniNameInput').value = uni.name;
        document.getElementById('uniCodeInput').value = uni.shortCode || '';

        // Ensure country is registered and selected
        if (uni.country && !availableCountries.includes(uni.country)) {
            availableCountries.push(uni.country);
            availableCountries.sort();
        }
        populateCountryDropdowns(uni.country);
        setCountryInputMode('select');
        document.getElementById('uniCountryInput').value = uni.country;

        // Restore custom country image if present
        currentCountryImageDataUrl = (uni.flag && !uni.flag.includes('flagcdn.com')) ? uni.flag : (customCountryImages[uni.country] || null);
        const countryImgFileInput = document.getElementById('countryImageFileInput');
        if (countryImgFileInput) countryImgFileInput.value = '';
        updateCountryImagePreview();

        document.getElementById('uniCityInput').value = uni.city;
        document.getElementById('uniRankingInput').value = uni.ranking;
        document.getElementById('uniEmailInput').value = uni.email;
        document.getElementById('uniCategoryInput').value = uni.type || '';
        document.getElementById('uniWebsiteInput').value = uni.website || '';

        // Load existing logo
        currentLogoDataUrl = uni.logo || null;
        setLogoPreview(currentLogoDataUrl);
        const fileInput = document.getElementById('uniLogoFile');
        if (fileInput) fileInput.value = '';

        document.getElementById('addEditModalTitle').innerText = 'Edit University Details';
        openModal('addEditModal');
    }

    // Save University
    function saveUniversity(e) {
        e.preventDefault();
        const editId = document.getElementById('editUniId').value;
        const name = document.getElementById('uniNameInput').value.trim();
        const shortCode = document.getElementById('uniCodeInput').value.trim();
        
        let country = '';
        if (countryInputMode === 'type') {
            country = document.getElementById('uniCountryTextInput').value.trim();
        } else {
            const selectVal = document.getElementById('uniCountryInput').value.trim();
            if (selectVal === '__TYPE_NEW__') {
                country = document.getElementById('uniCountryTextInput').value.trim();
            } else {
                country = selectVal;
            }
        }

        if (!country) {
            showToast('Please select or type a valid country destination.');
            if (countryInputMode === 'type') {
                document.getElementById('uniCountryTextInput').focus();
            } else {
                document.getElementById('uniCountryInput').focus();
            }
            return;
        }

        // Add to availableCountries registry if new, and update dropdowns
        if (!availableCountries.includes(country)) {
            availableCountries.push(country);
            availableCountries.sort();
            populateCountryDropdowns(country);
        }

        const city = document.getElementById('uniCityInput').value.trim();
        const ranking = document.getElementById('uniRankingInput').value.trim();
        const email = document.getElementById('uniEmailInput').value.trim();
        const type = document.getElementById('uniCategoryInput').value.trim();
        const website = document.getElementById('uniWebsiteInput').value.trim();

        // Extract rank number for sorting
        const rankMatch = ranking.match(/\d+/);
        const rankingNum = rankMatch ? parseInt(rankMatch[0]) : 100;

        const flagUrl = currentCountryImageDataUrl || customCountryImages[country] || getCountryFlag(country);
        if (currentCountryImageDataUrl) {
            customCountryImages[country] = currentCountryImageDataUrl;
        }
        const countryCode = getCountryCode(country);
        const defaultLogo = 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=100&auto=format&fit=crop&q=80';

        if (editId) {
            // Edit existing
            const index = universities.findIndex(u => u.id === editId);
            if (index !== -1) {
                universities[index] = {
                    ...universities[index],
                    name, shortCode, country, countryCode, city, ranking, rankingNum, email, type, website,
                    logo: currentLogoDataUrl || universities[index].logo || defaultLogo,
                    flag: flagUrl
                };
                showToast('University updated successfully!');
            }
        } else {
            // Create new
            const newId = 'UNI-' + countryCode + '-' + String(universities.length + 1).padStart(2, '0');
            const newUni = {
                id: newId,
                name,
                shortCode,
                country,
                countryCode,
                city,
                ranking,
                rankingNum,
                email,
                type,
                website,
                flag: flagUrl,
                logo: currentLogoDataUrl || defaultLogo,
                courses: [
                    { name: 'Bachelor of Science / Arts Program', degreeLevel: "Bachelor's", duration: '3-4 Years', tuition: 'Tuition on request', intakes: 'Sep 2025', ielts: '6.5' }
                ]
            };
            universities.unshift(newUni);
            showToast('New university partner registered successfully!');
        }

        closeModal('addEditModal');
        applyFilters();
    }

    // Delete Modal
    function openDeleteModal(id) {
        deleteTargetId = id;
        const uni = universities.find(u => u.id === id);
        if (uni) {
            document.getElementById('deleteConfirmText').innerText = `Are you sure you want to remove "${uni.name}" from the directory? This action cannot be undone.`;
        }
        openModal('deleteModal');
    }

    function confirmDelete() {
        if (!deleteTargetId) return;
        universities = universities.filter(u => u.id !== deleteTargetId);
        deleteTargetId = null;
        closeModal('deleteModal');
        applyFilters();
        showToast('University removed from system.');
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
        }, 3000);
    }

    // Update Counts
    function updateStats(count) {
        document.getElementById('totalUniBadge').innerText = `${count} Partner Universities`;
        document.getElementById('navUniCountBadge').innerText = count;
        document.getElementById('footerStatsText').innerText = `Showing ${count} universities`;
    }
</script>

</body>
</html>
