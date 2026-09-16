<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDIC RMC | Scholarship Management</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI",
                         Roboto, Arial, sans-serif;
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
           SIDEBAR (Exact match to Dashboard, Universities, Countries, Courses)
        ===================================================== */
        .sidebar {
            width: 250px;
            background: #111827;
            color: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
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
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: #f58220;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            margin-right: 11px;
            color: #ffffff;
        }

        .brand-name {
            font-size: 17px;
            font-weight: 700;
            letter-spacing: -.3px;
            color: #ffffff;
        }

        .brand-subtitle {
            font-size: 10px;
            color: #8c96a8;
            margin-top: 2px;
        }

        .nav {
            padding: 20px 12px;
        }

        .nav-section {
            font-size: 10px;
            text-transform: uppercase;
            color: #697386;
            font-weight: 700;
            letter-spacing: .8px;
            padding: 0 12px;
            margin: 18px 0 8px;
        }

        .nav-section:first-child {
            margin-top: 0;
        }

        .nav-link {
            height: 42px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 12px;
            border-radius: 7px;
            color: #b9c0cc;
            font-size: 13px;
            margin-bottom: 3px;
            transition: all .2s ease;
        }

        .nav-link:hover {
            background: #1c2534;
            color: #ffffff;
        }

        .nav-link.active {
            background: #f58220;
            color: #ffffff;
        }

        .nav-icon {
            width: 18px;
            height: 18px;
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
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* =====================================================
           TOPBAR (Exact match to Dashboard, Universities, Countries, Courses)
        ===================================================== */
        .topbar {
            height: 76px;
            background: #ffffff;
            border-bottom: 1px solid #e7e9ee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .search {
            width: 330px;
            position: relative;
        }

        .search input {
            width: 100%;
            height: 40px;
            border: 1px solid #e1e5eb;
            border-radius: 7px;
            background: #fafbfc;
            padding: 0 14px 0 38px;
            font-size: 12px;
            outline: none;
            transition: border-color .2s;
        }

        .search input:focus {
            border-color: #f58220;
            background: #ffffff;
        }

        .search svg {
            position: absolute;
            top: 12px;
            left: 12px;
            width: 16px;
            height: 16px;
            color: #8c96a8;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .notification {
            width: 36px;
            height: 36px;
            border-radius: 7px;
            border: 1px solid #e4e7ec;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: #4b5565;
            cursor: pointer;
            transition: all .2s ease;
        }

        .notification:hover {
            background: #f8fafc;
            border-color: #d0d5dd;
        }

        .notification svg {
            width: 17px;
            height: 17px;
        }

        .notification-dot {
            width: 7px;
            height: 7px;
            background: #f58220;
            border-radius: 50%;
            position: absolute;
            top: 7px;
            right: 7px;
            border: 2px solid white;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f58220;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 600;
            color: #172033;
        }

        .profile-role {
            font-size: 10px;
            color: #8c96a8;
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
            color: #f58220;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            border: 1px solid rgba(245, 130, 32, 0.2);
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
            flex-wrap: wrap;
        }

        .search-control {
            position: relative;
            flex: 1;
            max-width: 320px;
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
            border-color: #f58220;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(245, 130, 32, 0.1);
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
            border-color: #f58220;
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
            background: #f58220;
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
            height: 38px;
            padding: 0 14px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all .15s;
        }

        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #98a2b3;
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
            color: #f58220;
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

        .scholarship-icon-thumb {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            border: 1px solid #fed7aa;
            background: #fff7ed;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ea580c;
            font-weight: 700;
            font-size: 15px;
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

        /* Coverage Pills */
        .coverage-pill {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }

        .coverage-pill.full {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .coverage-pill.partial {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .coverage-pill.grant {
            background: #faf5ff;
            color: #7e22ce;
            border: 1px solid #e9d5ff;
        }

        .coverage-pill.stipend {
            background: #fff7ed;
            color: #c2410c;
            border: 1px solid #fed7aa;
        }

        /* Deadline Urgency Badge */
        .deadline-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .deadline-badge.open {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .deadline-badge.closing {
            background: #fffbeb;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 9px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-badge.active {
            background: #ecfdf5;
            color: #059669;
        }

        .status-badge.active::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #10b981;
        }

        .status-badge.inactive {
            background: #f3f4f6;
            color: #6b7280;
        }

        .status-badge.inactive::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #9ca3af;
        }

        .actions-cell {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-view-courses {
            background: #fff2e8;
            color: #d9650b;
            border: 1px solid rgba(245, 130, 32, 0.3);
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
            background: #f58220;
            color: #ffffff;
            border-color: #f58220;
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

        .card-metric-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            background: #f9fafb;
            padding: 10px 12px;
            border-radius: 7px;
            font-size: 11px;
        }

        .card-metric-label {
            color: #6b7280;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .card-metric-val {
            color: #111827;
            font-weight: 600;
            margin-top: 2px;
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
           MODAL SYSTEM (Exact match to Universities, Countries, Courses)
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
            max-width: 680px;
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

        /* Form elements */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 5px;
        }

        .form-label span.req {
            color: #ef4444;
        }

        .form-input, .form-select {
            width: 100%;
            height: 38px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            padding: 0 12px;
            font-size: 12px;
            color: #111827;
            background: #ffffff;
            outline: none;
            transition: border-color .15s;
        }

        .form-input:focus, .form-select:focus {
            border-color: #f58220;
            box-shadow: 0 0 0 3px rgba(245, 130, 32, 0.1);
        }

        .form-textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            padding: 10px 12px;
            font-size: 12px;
            color: #111827;
            background: #ffffff;
            outline: none;
            resize: vertical;
            min-height: 70px;
            font-family: inherit;
            transition: border-color .15s;
        }

        .form-textarea:focus {
            border-color: #f58220;
            box-shadow: 0 0 0 3px rgba(245, 130, 32, 0.1);
        }

        .form-checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
            margin-top: 4px;
        }

        /* Detail Modal Sections */
        .req-section {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 12px;
        }

        .req-section-title {
            font-size: 12px;
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .req-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            font-size: 12px;
        }

        .req-item strong {
            color: #374151;
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 2px;
        }

        .req-item span {
            color: #111827;
            font-weight: 500;
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

        /* Footer */
        .footer {
            padding: 20px 30px;
            border-top: 1px solid #e7e9ee;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11px;
            color: #8c96a8;
        }

        /* Responsive */
        @media (max-width: 750px) {
            .sidebar { width: 70px; }
            .brand { justify-content: center; padding: 0; }
            .brand-mark { margin: 0; }
            .brand-name, .brand-subtitle, .nav-section, .nav-link span, .nav-badge { display: none; }
            .nav-link { justify-content: center; }
            .main { margin-left: 70px; width: calc(100% - 70px); }
            .content { padding: 16px; }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="app">

    <!-- =====================================================
         SIDEBAR (Group Repo Layout Standard with All 5 Sections)
    ====================================================== -->
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-mark">IR</div>
            <div>
                <div class="brand-name">INDIC RMC</div>
                <div class="brand-subtitle">Administration Portal</div>
            </div>
        </div>

        <nav class="nav">
            <!-- SECTION 1: OVERVIEW -->
            <div class="nav-section">Overview</div>
            <a href="{{ url('/admin/dashboard') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- SECTION 2: MANAGEMENT -->
            <div class="nav-section">Management</div>
            <a href="#" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <span>Students</span>
            </a>

            <a href="#" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                </svg>
                <span>Consultants</span>
            </a>

            <a href="#" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M6 2h12v20H6z"/>
                    <path d="M9 6h6"/>
                    <path d="M9 10h6"/>
                    <path d="M9 14h4"/>
                </svg>
                <span>Applications</span>
            </a>

            <a href="#" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="4" width="18" height="17" rx="2"/>
                    <path d="M16 2v4"/>
                    <path d="M8 2v4"/>
                    <path d="M3 10h18"/>
                </svg>
                <span>Appointments</span>
            </a>

            <!-- SECTION 3: STUDY ABROAD -->
            <div class="nav-section">Study Abroad</div>
            <a href="{{ url('/admin/countries') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M3 12h18"/>
                    <path d="M12 3c3 3 3 15 0 18"/>
                    <path d="M12 3c-3 3-3 15 0 18"/>
                </svg>
                <span>Countries</span>
            </a>

            <a href="{{ url('/admin/universities') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M3 21h18"/>
                    <path d="M5 21V8l7-5 7 5v13"/>
                    <path d="M9 21v-6h6v6"/>
                </svg>
                <span>Universities</span>
            </a>

            <a href="{{ url('/admin/courses') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M3 10l9-6 9 6"/>
                    <path d="M5 10v9h14v-9"/>
                    <path d="M9 19v-5h6v5"/>
                </svg>
                <span>Courses</span>
            </a>

            <!-- ACTIVE ITEM: Scholarships -->
            <a href="{{ url('/admin/scholarships') }}" class="nav-link active">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 3v18"/>
                    <path d="M17 7H9.5a3 3 0 0 0 0 6H14.5a3 3 0 0 1 0 6H7"/>
                </svg>
                <span>Scholarships</span>
                <span class="nav-badge" id="navScholarshipCountBadge">14</span>
            </a>

            <a href="#" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M5 12l4 4L19 6"/>
                </svg>
                <span>Eligibility Rules</span>
            </a>

            <!-- SECTION 4: CRM & INTELLIGENCE -->
            <div class="nav-section">CRM & Intelligence</div>
            <a href="#" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M3 12h18"/>
                    <path d="M5 12a7 7 0 0 1 14 0"/>
                    <path d="M5 12a7 7 0 0 0 14 0"/>
                </svg>
                <span>CRM</span>
            </a>

            <a href="#" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 19V5"/>
                    <path d="M4 19h17"/>
                    <path d="M7 15l4-5 3 3 5-7"/>
                </svg>
                <span>Reports & Analytics</span>
            </a>

            <!-- SECTION 5: SYSTEM -->
            <div class="nav-section">System</div>
            <a href="{{ url('/admin/settings') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.5 1.5-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1 1.55V20h-2v-.41a1.7 1.7 0 0 0-1-1.55 1.7 1.7 0 0 0-1.88.34l-.06.06-1.5-1.5.06-.06A1.7 1.7 0 0 0 7.4 15a1.7 1.7 0 0 0-1.55-1H5v-2h.85a1.7 1.7 0 0 0 1.55-1 1.7 1.7 0 0 0-.34-1.88L7 9.06l1.5-1.5.06.06a1.7 1.7 0 0 0 1.88.34 1.7 1.7 0 0 0 1-1.55V6h2v.41a1.7 1.7 0 0 0 1 1.55 1.7 1.7 0 0 0 1.88-.34l.06-.06 1.5 1.5-.06.06a1.7 1.7 0 0 0-.34 1.88 1.7 1.7 0 0 0 1.55 1H20v2h-.41a1.7 1.7 0 0 0-1.55 1z"/>
                </svg>
                <span>Settings</span>
            </a>

            <a href="#" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="4" y="4" width="16" height="16" rx="2"/>
                    <path d="M8 8h8"/>
                    <path d="M8 12h8"/>
                    <path d="M8 16h5"/>
                </svg>
                <span>Audit Logs</span>
            </a>
        </nav>
    </aside>

    <!-- =====================================================
         MAIN CONTENT WRAPPER
    ====================================================== -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-4-4"/>
                </svg>
                <input type="text" id="topbarSearchInput" placeholder="Quick search scholarships, grants, universities... (Ctrl+/)">
            </div>

            <div class="topbar-right">
                <div class="notification" title="Notifications">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>
                    </svg>
                    <span class="notification-dot"></span>
                </div>

                <div class="profile">
                    <div class="profile-avatar">A</div>
                    <div>
                        <div class="profile-name">Admin User</div>
                        <div class="profile-role">Administrator</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <div class="content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <div>
                    <h1>
                        Scholarship Management
                        <span class="title-badge" id="totalScholarshipsBadge">14 Total Scholarships</span>
                    </h1>
                    <p>Administer merit-based grants, government bursaries, tuition fee waivers, and partner university sponsorships.</p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn-secondary" onclick="exportScholarshipsCSV()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Export CSV
                    </button>
                    <button class="btn-orange" onclick="openAddScholarshipModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Add New Scholarship
                    </button>
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
                        <input type="text" id="scholarshipSearchInput" placeholder="Search by scholarship name, university, or eligibility...">
                    </div>

                    <select class="filter-select" id="coverageFilter">
                        <option value="ALL">All Coverage Types</option>
                        <option value="Full">Full Tuition (100%)</option>
                        <option value="Partial">Partial Tuition</option>
                        <option value="Grant">Cash Grant / Bursary</option>
                        <option value="Stipend">Living Stipend / Fellowship</option>
                    </select>

                    <select class="filter-select" id="universityFilter">
                        <option value="ALL">All Universities</option>
                    </select>

                    <select class="filter-select" id="countryFilter">
                        <option value="ALL">All Countries</option>
                        <option value="Canada">Canada</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Germany">Germany</option>
                        <option value="Australia">Australia</option>
                        <option value="Ireland">Ireland</option>
                    </select>

                    <select class="filter-select" id="levelFilter">
                        <option value="ALL">All Degree Levels</option>
                        <option value="Undergraduate">Undergraduate</option>
                        <option value="Postgraduate">Postgraduate</option>
                        <option value="PhD">Doctoral (PhD)</option>
                        <option value="All Levels">All Levels</option>
                    </select>

                    <select class="filter-select" id="statusFilter">
                        <option value="ALL">All Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

                <div class="controls-right">
                    <div class="view-switcher">
                        <button class="view-btn active" id="tableViewBtn" onclick="switchView('table')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="8" y1="6" x2="21" y2="6"/>
                                <line x1="8" y1="12" x2="21" y2="12"/>
                                <line x1="8" y1="18" x2="21" y2="18"/>
                                <line x1="3" y1="6" x2="3.01" y2="6"/>
                                <line x1="3" y1="12" x2="3.01" y2="12"/>
                                <line x1="3" y1="18" x2="3.01" y2="18"/>
                            </svg>
                            Table
                        </button>
                        <button class="view-btn" id="gridViewBtn" onclick="switchView('grid')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7"/>
                                <rect x="14" y="3" width="7" height="7"/>
                                <rect x="14" y="14" width="7" height="7"/>
                                <rect x="3" y="14" width="7" height="7"/>
                            </svg>
                            Cards
                        </button>
                    </div>
                </div>
            </div>

            <!-- CARD / TABLE CONTAINER -->
            <div class="card-container">
                <!-- TABLE VIEW -->
                <div class="table-responsive" id="tableViewSection">
                    <table class="uni-table">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)" style="cursor: pointer;">
                                </th>
                                <th class="sortable" onclick="sortTable('name')">Scholarship & Code ↕</th>
                                <th class="sortable" onclick="sortTable('university')">Partner University ↕</th>
                                <th class="sortable" onclick="sortTable('value')">Award Value / Coverage ↕</th>
                                <th>Target Level & Field</th>
                                <th class="sortable" onclick="sortTable('deadline')">Deadline ↕</th>
                                <th>Status</th>
                                <th style="text-align: right; width: 170px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="scholarshipTableBody">
                            <!-- Populated dynamically via JS -->
                        </tbody>
                    </table>
                </div>

                <!-- GRID CARDS VIEW -->
                <div class="cards-grid" id="gridViewSection" style="display: none;">
                    <!-- Populated dynamically via JS -->
                </div>

                <!-- TABLE FOOTER -->
                <div class="table-footer">
                    <div id="paginationInfo">Showing 1 to 14 of 14 scholarships</div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span>Rows per page:</span>
                        <select id="perPageSelect" class="filter-select" style="height: 30px; padding: 0 8px; font-size: 11px;" onchange="changePerPage(this.value)">
                            <option value="10">10</option>
                            <option value="20" selected>20</option>
                            <option value="50">50</option>
                            <option value="ALL">All</option>
                        </select>
                        <div style="display: flex; gap: 4px; margin-left: 10px;" id="paginationControls">
                            <!-- Generated dynamically -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <footer class="footer">
            <div>&copy; 2026 INDIC RMC Study Abroad Platform. All rights reserved.</div>
            <div style="display: flex; gap: 16px;">
                <a href="#" style="color: inherit;">Privacy Policy</a>
                <a href="#" style="color: inherit;">Terms of Service</a>
                <a href="#" style="color: inherit;">Support</a>
            </div>
        </footer>

    </main>

</div>

<!-- =====================================================
     MODAL 1: ADD / EDIT SCHOLARSHIP
====================================================== -->
<div class="modal-backdrop" id="addEditScholarshipModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <div class="modal-title" id="addEditModalTitle">Add New Scholarship Program</div>
                <div class="modal-subtitle">Configure grant award value, university affiliation, eligibility requirements, and deadlines.</div>
            </div>
            <button class="modal-close-btn" onclick="closeModal('addEditScholarshipModal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <form id="scholarshipForm" onsubmit="handleSaveScholarship(event)">
            <input type="hidden" id="scholarshipIdField" value="">
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Scholarship Name <span class="req">*</span></label>
                        <input type="text" class="form-input" id="scholarshipNameInput" placeholder="e.g. Pearson International Scholarship" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Reference Code <span class="req">*</span></label>
                        <input type="text" class="form-input" id="scholarshipCodeInput" placeholder="e.g. SCH-TOR-01" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Partner University <span class="req">*</span></label>
                        <select class="form-select" id="scholarshipUniversitySelect" onchange="syncCountryFromUniversity(this.value)" required>
                            <option value="">Select University...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Host Country <span class="req">*</span></label>
                        <input type="text" class="form-input" id="scholarshipCountryInput" placeholder="Country" readonly style="background: #f9fafb;">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Coverage Type <span class="req">*</span></label>
                        <select class="form-select" id="scholarshipCoverageSelect" required>
                            <option value="Full">Full Tuition (100% Waiver)</option>
                            <option value="Partial">Partial Tuition Waiver</option>
                            <option value="Grant">Cash Grant / Bursary</option>
                            <option value="Stipend">Living Stipend / Fellowship</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Award Value / Amount <span class="req">*</span></label>
                        <input type="text" class="form-input" id="scholarshipAmountInput" placeholder="e.g. $42,500 / yr or 100% Tuition" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Target Degree Level <span class="req">*</span></label>
                        <select class="form-select" id="scholarshipLevelSelect" required>
                            <option value="Undergraduate">Undergraduate</option>
                            <option value="Postgraduate">Postgraduate</option>
                            <option value="PhD">Doctoral (PhD)</option>
                            <option value="All Levels">All Degree Levels</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Target Field / Course</label>
                        <input type="text" class="form-input" id="scholarshipFieldInput" placeholder="e.g. STEM, Business, or All Programs">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Minimum GPA Requirement <span class="req">*</span></label>
                        <input type="text" class="form-input" id="scholarshipGpaInput" placeholder="e.g. 3.5 / 4.0 or 85%" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Application Deadline <span class="req">*</span></label>
                        <input type="date" class="form-input" id="scholarshipDeadlineInput" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Available Slots / Quota</label>
                        <input type="text" class="form-input" id="scholarshipQuotaInput" placeholder="e.g. 15 recipients annually">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Funding Category</label>
                        <select class="form-select" id="scholarshipCategorySelect">
                            <option value="Merit-Based">Merit-Based Academic</option>
                            <option value="Need-Based">Financial Need-Based</option>
                            <option value="Merit + Need">Merit + Need Combined</option>
                            <option value="Government Grant">Government / State Sponsored</option>
                            <option value="Research Fellowship">Research Fellowship</option>
                        </select>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Eligibility Criteria & Prerequisites</label>
                    <textarea class="form-textarea" id="scholarshipEligibilityInput" placeholder="Define academic merit cutoffs, nationality restrictions, language test scores, and research track record requirements..."></textarea>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Scholarship Overview & Application Instructions</label>
                    <textarea class="form-textarea" id="scholarshipDescInput" placeholder="Describe the grant history, selection committee process, renewal conditions, and required application documents..."></textarea>
                </div>

                <div class="form-group full-width">
                    <label class="form-checkbox-label">
                        <input type="checkbox" id="scholarshipActiveCheckbox" checked>
                        <span>Active Scholarship Program (visible to student applicants and consultants)</span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('addEditScholarshipModal')">Cancel</button>
                <button type="submit" class="btn-orange">Save Scholarship</button>
            </div>
        </form>
    </div>
</div>

<!-- =====================================================
     MODAL 2: ELIGIBILITY CRITERIA & DETAILS MODAL
====================================================== -->
<div class="modal-backdrop" id="scholarshipDetailsModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <div class="modal-title" id="detailScholarshipName">Scholarship Title</div>
                <div class="modal-subtitle" id="detailScholarshipSubtitle">Code & University</div>
            </div>
            <button class="modal-close-btn" onclick="closeModal('scholarshipDetailsModal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" id="detailModalBodyContent">
            <!-- Dynamic Content -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" id="detailEditBtn">Edit Scholarship</button>
            <button type="button" class="btn-orange" onclick="closeModal('scholarshipDetailsModal')">Close</button>
        </div>
    </div>
</div>

<!-- =====================================================
     MODAL 3: DELETE / DEACTIVATE CONFIRMATION
====================================================== -->
<div class="modal-backdrop" id="deleteScholarshipModal">
    <div class="modal-window" style="max-width: 440px;">
        <div class="modal-header">
            <div>
                <div class="modal-title" style="color: #dc2626;">Deactivate Scholarship</div>
                <div class="modal-subtitle">Are you sure you want to deactivate this scholarship opportunity?</div>
            </div>
            <button class="modal-close-btn" onclick="closeModal('deleteScholarshipModal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <p style="font-size: 13px; color: #4b5565; line-height: 1.5;">
                Deactivating <strong id="deleteScholarshipName" style="color: #111827;"></strong> will withdraw it from the student scholarship portal and stop incoming applications.
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" onclick="closeModal('deleteScholarshipModal')">Cancel</button>
            <button type="button" class="btn-danger" id="confirmDeleteBtn">Deactivate Scholarship</button>
        </div>
    </div>
</div>

<!-- TOAST NOTIFICATION -->
<div class="toast" id="toast">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
        <polyline points="20 6 9 17 4 12"/>
    </svg>
    <span id="toastMessage">Action completed successfully!</span>
</div>

<!-- =====================================================
     SCRIPTS & STATE MANAGEMENT
====================================================== -->
<script>
    // Initial Universities Directory with Flags
    const universityDirectory = [
        { name: "University of Toronto", country: "Canada", flag: "https://flagcdn.com/w40/ca.png" },
        { name: "University of British Columbia", country: "Canada", flag: "https://flagcdn.com/w40/ca.png" },
        { name: "McGill University", country: "Canada", flag: "https://flagcdn.com/w40/ca.png" },
        { name: "University of Oxford", country: "United Kingdom", flag: "https://flagcdn.com/w40/gb.png" },
        { name: "University of Cambridge", country: "United Kingdom", flag: "https://flagcdn.com/w40/gb.png" },
        { name: "Imperial College London", country: "United Kingdom", flag: "https://flagcdn.com/w40/gb.png" },
        { name: "Harvard University", country: "United States", flag: "https://flagcdn.com/w40/us.png" },
        { name: "MIT", country: "United States", flag: "https://flagcdn.com/w40/us.png" },
        { name: "Stanford University", country: "United States", flag: "https://flagcdn.com/w40/us.png" },
        { name: "National University of Singapore", country: "Singapore", flag: "https://flagcdn.com/w40/sg.png" },
        { name: "Nanyang Technological University", country: "Singapore", flag: "https://flagcdn.com/w40/sg.png" },
        { name: "Technical University of Munich", country: "Germany", flag: "https://flagcdn.com/w40/de.png" },
        { name: "Heidelberg University", country: "Germany", flag: "https://flagcdn.com/w40/de.png" },
        { name: "University of Melbourne", country: "Australia", flag: "https://flagcdn.com/w40/au.png" },
        { name: "University of Sydney", country: "Australia", flag: "https://flagcdn.com/w40/au.png" },
        { name: "Trinity College Dublin", country: "Ireland", flag: "https://flagcdn.com/w40/ie.png" }
    ];

    // Initial Accredited Scholarships Dataset (14 Leading Global Awards)
    let scholarshipsData = [
        {
            id: 1,
            code: "SCH-TOR-01",
            name: "Lester B. Pearson International Scholarship",
            university: "University of Toronto",
            country: "Canada",
            flag: "https://flagcdn.com/w40/ca.png",
            coverage: "Full",
            amount: "100% Tuition + Living Allowance & Books",
            level: "Undergraduate",
            field: "All Undergraduate Disciplines",
            minGpa: "3.8 / 4.0 (92%+)",
            deadline: "2026-11-30",
            quota: "37 International Scholars annually",
            category: "Merit-Based",
            eligibility: "High school graduating seniors recognized for exceptional academic achievement, creative leadership, and impactful community contribution.",
            description: "The most prestigious and competitive scholarship for international students at U of T, covering tuition, books, incidental fees, and four years of residence support.",
            active: true
        },
        {
            id: 2,
            code: "SCH-OXF-02",
            name: "Rhodes Scholarship for International Scholars",
            university: "University of Oxford",
            country: "United Kingdom",
            flag: "https://flagcdn.com/w40/gb.png",
            coverage: "Full",
            amount: "100% University Fees + £19,240 Annual Stipend",
            level: "Postgraduate",
            field: "All Postgraduate Degrees",
            minGpa: "3.7 / 4.0 or First Class Honors",
            deadline: "2026-10-15",
            quota: "100 Global Scholars",
            category: "Merit-Based",
            eligibility: "Outstanding undergraduate scholars with exceptional intellect, character, leadership potential, and commitment to global public service.",
            description: "The world's oldest and most renowned graduate fellowship supporting study in any postgraduate degree program at the University of Oxford.",
            active: true
        },
        {
            id: 3,
            code: "SCH-CAM-03",
            name: "Gates Cambridge Scholarship",
            university: "University of Cambridge",
            country: "United Kingdom",
            flag: "https://flagcdn.com/w40/gb.png",
            coverage: "Full",
            amount: "Full Cost of Study + Airfare & Family Allowance",
            level: "Postgraduate",
            field: "PhD and Master's Degrees",
            minGpa: "3.8 / 4.0 (Top 5% of graduating class)",
            deadline: "2026-12-05",
            quota: "80 Full Cost Scholarships",
            category: "Merit-Based",
            eligibility: "Citizen of any country outside the UK applying for a full-time residential postgraduate course at Cambridge University.",
            description: "Endowed by the Bill & Melinda Gates Foundation to build a global network of future leaders dedicated to improving the lives of others.",
            active: true
        },
        {
            id: 4,
            code: "SCH-HAR-04",
            name: "Harvard Presidential Doctoral Fellowship",
            university: "Harvard University",
            country: "United States",
            flag: "https://flagcdn.com/w40/us.png",
            coverage: "Full",
            amount: "$48,500 Living Stipend + 100% Tuition & Health",
            level: "PhD",
            field: "Sciences, Public Health & Engineering",
            minGpa: "3.85 / 4.0",
            deadline: "2026-12-15",
            quota: "25 Doctoral Fellows",
            category: "Research Fellowship",
            eligibility: "Exceptional applicants demonstrating breakthrough potential in biomedical, computational, or social policy research.",
            description: "Five full years of guaranteed doctoral funding, health coverage, and interdisciplinary travel grants across Harvard faculties.",
            active: true
        },
        {
            id: 5,
            code: "SCH-MIT-05",
            name: "MIT Dean of Engineering International Merit Award",
            university: "MIT",
            country: "United States",
            flag: "https://flagcdn.com/w40/us.png",
            coverage: "Grant",
            amount: "$35,000 Annual Tuition Grant",
            level: "Undergraduate",
            field: "Engineering & Computer Science",
            minGpa: "3.9 / 4.0",
            deadline: "2027-01-05",
            quota: "30 Engineering Grants",
            category: "Merit-Based",
            eligibility: "First-year engineering admits with superior mathematical and physics competition honours or patent credits.",
            description: "Merit grant co-funded by MIT School of Engineering alumni foundation to attract top international inventors and computer scientists.",
            active: true
        },
        {
            id: 6,
            code: "SCH-STA-06",
            name: "Knight-Hennessy Global Scholars Program",
            university: "Stanford University",
            country: "United States",
            flag: "https://flagcdn.com/w40/us.png",
            coverage: "Full",
            amount: "100% Tuition + Living & Educational Travel Grant",
            level: "All Levels",
            field: "All Stanford Graduate Degrees (JD, MD, MBA, PhD)",
            minGpa: "3.7 / 4.0",
            deadline: "2026-10-08",
            quota: "85 Scholars",
            category: "Merit-Based",
            eligibility: "High-independence thinkers with purposeful leadership credentials applying to any graduate degree at Stanford University.",
            description: "A multicultural, multidisciplinary community of graduate students receiving experiential leadership training through the Denning House.",
            active: true
        },
        {
            id: 7,
            code: "SCH-NUS-07",
            name: "NUS Global Merit Scholarship",
            university: "National University of Singapore",
            country: "Singapore",
            flag: "https://flagcdn.com/w40/sg.png",
            coverage: "Full",
            amount: "100% Tuition Fee Subsidy + S$6,000 Annual Allowance",
            level: "Undergraduate",
            field: "Computing, Business & STEM",
            minGpa: "3.75 / 4.0 (Top 5%)",
            deadline: "2027-02-15",
            quota: "50 Awards",
            category: "Merit-Based",
            eligibility: "High school leavers with outstanding academic achievements, stellar co-curricular activities, and strong leadership.",
            description: "Includes subsidized accommodation allowance, one-time computer grant, and guaranteed overseas student exchange program placement.",
            active: true
        },
        {
            id: 8,
            code: "SCH-TUM-08",
            name: "DAAD Helmut-Schmidt Master's Grant",
            university: "Technical University of Munich",
            country: "Germany",
            flag: "https://flagcdn.com/w40/de.png",
            coverage: "Stipend",
            amount: "€934 Monthly Stipend + Travel Subsidy & Health Insurance",
            level: "Postgraduate",
            field: "Automotive, Mobility & Sustainable Governance",
            minGpa: "German Scale 2.0 or better (~85%)",
            deadline: "2026-11-15",
            quota: "40 International Fellows",
            category: "Government Grant",
            eligibility: "Graduates from developing and emerging nations pursuing governance, engineering, or sustainability master's degrees.",
            description: "Federal Foreign Office program supporting international leaders to acquire academic qualifications relevant to social development.",
            active: true
        },
        {
            id: 9,
            code: "SCH-HEI-09",
            name: "Heidelberg Excellence Research Fellowship",
            university: "Heidelberg University",
            country: "Germany",
            flag: "https://flagcdn.com/w40/de.png",
            coverage: "Stipend",
            amount: "€1,850 Monthly Fellowship + Research Consumables Grant",
            level: "PhD",
            field: "Molecular Biotechnology & Life Sciences",
            minGpa: "1.8 (German Scale)",
            deadline: "2027-01-30",
            quota: "15 Doctoral Researchers",
            category: "Research Fellowship",
            eligibility: "Applicants holding an outstanding M.Sc. in biochemistry or molecular medicine with primary authorship publications.",
            description: "Prestigious doctoral scholarship at Germany's oldest university, collaborating with the German Cancer Research Center (DKFZ).",
            active: true
        },
        {
            id: 10,
            code: "SCH-MEL-10",
            name: "Melbourne Chancellor's Scholarship",
            university: "University of Melbourne",
            country: "Australia",
            flag: "https://flagcdn.com/w40/au.png",
            coverage: "Full",
            amount: "100% Tuition Remission + A$10,000 Annual Living Allowance",
            level: "Undergraduate",
            field: "Commerce, Arts, Science & Biomedicine",
            minGpa: "ATAR 99.90 or equivalent international 98%+",
            deadline: "2026-11-20",
            quota: "20 International Scholars",
            category: "Merit-Based",
            eligibility: "Top-tier school leavers who have achieved an Australian Year 12 ATAR score of 99.90+ or equivalent international board credential.",
            description: "Guaranteed pathway to graduate study, Melbourne Global mobility grant of A$2,500, and comprehensive peer mentoring.",
            active: true
        },
        {
            id: 11,
            code: "SCH-SYD-11",
            name: "Sydney International Student Award",
            university: "University of Sydney",
            country: "Australia",
            flag: "https://flagcdn.com/w40/au.png",
            coverage: "Partial",
            amount: "20% Tuition Fee Reduction for Program Duration",
            level: "All Levels",
            field: "All Eligible Degrees",
            minGpa: "3.2 / 4.0 (80%)",
            deadline: "2027-01-15",
            quota: "Uncapped for qualifying nationalities",
            category: "Merit-Based",
            eligibility: "Eligible international citizens holding an unconditional offer for undergraduate or postgraduate coursework.",
            description: "Strategic contribution to tuition fees to support high-calibre global scholars pursuing degrees across Sydney faculties.",
            active: true
        },
        {
            id: 12,
            code: "SCH-TCD-12",
            name: "Trinity Global Excellence Postgraduate Scholarship",
            university: "Trinity College Dublin",
            country: "Ireland",
            flag: "https://flagcdn.com/w40/ie.png",
            coverage: "Grant",
            amount: "€5,000 Direct Tuition Fee Reduction",
            level: "Postgraduate",
            field: "Computer Science, Business & Humanities",
            minGpa: "2.1 Honors (75%+)",
            deadline: "2027-03-31",
            quota: "60 Awards annually",
            category: "Merit-Based",
            eligibility: "Non-EU fee status students holding an unconditional or conditional offer for full-time master's degree admission.",
            description: "Awarded based on academic excellence, applicant cover essay, and anticipated contributions to the Trinity College campus community.",
            active: true
        },
        {
            id: 13,
            code: "SCH-UBC-13",
            name: "UBC International Major Entrance Scholarship (IMES)",
            university: "University of British Columbia",
            country: "Canada",
            flag: "https://flagcdn.com/w40/ca.png",
            coverage: "Grant",
            amount: "$20,000 / year (Renewable for 4 Years = $80,000)",
            level: "Undergraduate",
            field: "All Undergraduate Faculties",
            minGpa: "3.7 / 4.0 (88%+)",
            deadline: "2027-01-15",
            quota: "50 Renewable Grants",
            category: "Merit-Based",
            eligibility: "Secondary school graduates applying directly to UBC Vancouver or Okanagan campuses with exceptional academic and extracurricular profile.",
            description: "Significant tuition assistance renewable across all four years of full-time undergraduate study provided academic standing is maintained.",
            active: true
        },
        {
            id: 14,
            code: "SCH-IMP-14",
            name: "Imperial College Future Leaders in AI Fellowship",
            university: "Imperial College London",
            country: "United Kingdom",
            flag: "https://flagcdn.com/w40/gb.png",
            coverage: "Grant",
            amount: "£25,000 Direct Tuition & Research Consumables Award",
            level: "Postgraduate",
            field: "Artificial Intelligence, Robotics & Machine Learning",
            minGpa: "3.6 / 4.0 (First Class Degree)",
            deadline: "2026-11-10",
            quota: "10 Industry Fellowships",
            category: "Research Fellowship",
            eligibility: "Accepted candidates in M.Sc. Computing (AI & Machine Learning) with proven software development or neural network experience.",
            description: "Sponsored by European AI innovation hubs offering direct mentor matching with London machine learning laboratory scientists.",
            active: true
        }
    ];

    // State Variables
    let currentView = 'table';
    let sortColumn = 'name';
    let sortDirection = 'asc';
    let currentPage = 1;
    let perPage = 20;
    let selectedScholarshipIds = new Set();
    let deletingScholarshipId = null;

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        populateUniversityDropdowns();
        renderScholarships();
        attachFilterListeners();
    });

    // Populate University Dropdown in Filter & Modal
    function populateUniversityDropdowns() {
        const uniFilter = document.getElementById('universityFilter');
        const uniSelect = document.getElementById('scholarshipUniversitySelect');

        uniFilter.innerHTML = '<option value="ALL">All Universities</option>';
        uniSelect.innerHTML = '<option value="">Select University...</option>';

        universityDirectory.forEach(u => {
            const opt1 = document.createElement('option');
            opt1.value = u.name;
            opt1.textContent = u.name + ' (' + u.country + ')';
            uniFilter.appendChild(opt1);

            const opt2 = document.createElement('option');
            opt2.value = u.name;
            opt2.textContent = u.name + ' (' + u.country + ')';
            uniSelect.appendChild(opt2);
        });
    }

    // Auto-sync Country when University is chosen in modal
    function syncCountryFromUniversity(uniName) {
        const found = universityDirectory.find(u => u.name === uniName);
        const countryInput = document.getElementById('scholarshipCountryInput');
        if (found) {
            countryInput.value = found.country;
        } else {
            countryInput.value = '';
        }
    }

    // Filter Listeners
    function attachFilterListeners() {
        document.getElementById('scholarshipSearchInput').addEventListener('input', () => {
            currentPage = 1;
            renderScholarships();
        });

        document.getElementById('topbarSearchInput').addEventListener('input', (e) => {
            document.getElementById('scholarshipSearchInput').value = e.target.value;
            currentPage = 1;
            renderScholarships();
        });

        document.getElementById('coverageFilter').addEventListener('change', () => {
            currentPage = 1;
            renderScholarships();
        });

        document.getElementById('universityFilter').addEventListener('change', () => {
            currentPage = 1;
            renderScholarships();
        });

        document.getElementById('countryFilter').addEventListener('change', () => {
            currentPage = 1;
            renderScholarships();
        });

        document.getElementById('levelFilter').addEventListener('change', () => {
            currentPage = 1;
            renderScholarships();
        });

        document.getElementById('statusFilter').addEventListener('change', () => {
            currentPage = 1;
            renderScholarships();
        });

        // Global hotkey Ctrl+/ for quick search
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === '/') {
                e.preventDefault();
                document.getElementById('scholarshipSearchInput').focus();
            }
            if (e.key === 'Escape') {
                closeModal('addEditScholarshipModal');
                closeModal('scholarshipDetailsModal');
                closeModal('deleteScholarshipModal');
            }
        });
    }

    // Filter and Sort Data
    function getFilteredScholarships() {
        const searchVal = (document.getElementById('scholarshipSearchInput').value || '').toLowerCase().trim();
        const coverageVal = document.getElementById('coverageFilter').value;
        const uniVal = document.getElementById('universityFilter').value;
        const countryVal = document.getElementById('countryFilter').value;
        const levelVal = document.getElementById('levelFilter').value;
        const statusVal = document.getElementById('statusFilter').value;

        return scholarshipsData.filter(s => {
            const matchesSearch = !searchVal ||
                s.name.toLowerCase().includes(searchVal) ||
                s.code.toLowerCase().includes(searchVal) ||
                s.university.toLowerCase().includes(searchVal) ||
                s.country.toLowerCase().includes(searchVal) ||
                (s.field && s.field.toLowerCase().includes(searchVal)) ||
                (s.eligibility && s.eligibility.toLowerCase().includes(searchVal));

            const matchesCoverage = (coverageVal === 'ALL') || (s.coverage === coverageVal);
            const matchesUni = (uniVal === 'ALL') || (s.university === uniVal);
            const matchesCountry = (countryVal === 'ALL') || (s.country === countryVal);
            const matchesLevel = (levelVal === 'ALL') || (s.level === levelVal) || (s.level === 'All Levels');
            const matchesStatus = (statusVal === 'ALL') ||
                (statusVal === 'Active' && s.active) ||
                (statusVal === 'Inactive' && !s.active);

            return matchesSearch && matchesCoverage && matchesUni && matchesCountry && matchesLevel && matchesStatus;
        }).sort((a, b) => {
            let valA, valB;
            if (sortColumn === 'name') {
                valA = a.name.toLowerCase();
                valB = b.name.toLowerCase();
            } else if (sortColumn === 'university') {
                valA = a.university.toLowerCase();
                valB = b.university.toLowerCase();
            } else if (sortColumn === 'value') {
                valA = a.amount.toLowerCase();
                valB = b.amount.toLowerCase();
            } else if (sortColumn === 'deadline') {
                valA = a.deadline || '9999';
                valB = b.deadline || '9999';
            } else {
                valA = a.id;
                valB = b.id;
            }

            if (valA < valB) return sortDirection === 'asc' ? -1 : 1;
            if (valA > valB) return sortDirection === 'asc' ? 1 : -1;
            return 0;
        });
    }

    // Render Master Method
    function renderScholarships() {
        const filtered = getFilteredScholarships();
        const total = filtered.length;

        // Update badges
        document.getElementById('totalScholarshipsBadge').textContent = total + ' Total Scholarships';
        document.getElementById('navScholarshipCountBadge').textContent = scholarshipsData.length;

        // Pagination calculation
        let displayList = filtered;
        let startIdx = 0;
        let endIdx = total;

        if (perPage !== 'ALL') {
            const pSize = parseInt(perPage, 10);
            const totalPages = Math.ceil(total / pSize) || 1;
            if (currentPage > totalPages) currentPage = totalPages;
            startIdx = (currentPage - 1) * pSize;
            endIdx = Math.min(startIdx + pSize, total);
            displayList = filtered.slice(startIdx, endIdx);
        }

        renderTable(displayList);
        renderGrid(displayList);
        renderPagination(total, startIdx, endIdx);
    }

    // Helper: Coverage Pill Class
    function getCoverageClass(coverage) {
        const c = (coverage || '').toLowerCase();
        if (c === 'full') return 'coverage-pill full';
        if (c === 'partial') return 'coverage-pill partial';
        if (c === 'grant') return 'coverage-pill grant';
        if (c === 'stipend') return 'coverage-pill stipend';
        return 'coverage-pill';
    }

    // Helper: Coverage Label
    function getCoverageLabel(coverage) {
        if (coverage === 'Full') return 'Full Tuition (100%)';
        if (coverage === 'Partial') return 'Partial Tuition';
        if (coverage === 'Grant') return 'Cash Grant';
        if (coverage === 'Stipend') return 'Living Stipend';
        return coverage;
    }

    // Helper: Deadline formatting
    function formatDeadline(dStr) {
        if (!dStr) return '<span style="color:#9ca3af;">Rolling Basis</span>';
        const d = new Date(dStr);
        const today = new Date();
        const diffDays = Math.ceil((d - today) / (1000 * 60 * 60 * 24));

        let badgeHtml = '';
        if (diffDays < 0) {
            badgeHtml = '<span class="deadline-badge" style="background:#fef2f2; color:#b91c1c; border:1px solid #fecaca;">Closed</span>';
        } else if (diffDays <= 45) {
            badgeHtml = '<span class="deadline-badge closing">Closing Soon</span>';
        } else {
            badgeHtml = '<span class="deadline-badge open">Open</span>';
        }

        return `${dStr} ${badgeHtml}`;
    }

    // Render Table View
    function renderTable(list) {
        const tbody = document.getElementById('scholarshipTableBody');
        tbody.innerHTML = '';

        if (list.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: #6b7280;">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" style="margin-bottom: 8px;">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <p style="font-size: 13px; font-weight: 500;">No scholarship opportunities match your filter criteria.</p>
                        <button class="btn-secondary" onclick="resetFilters()" style="margin: 10px auto 0;">Reset Filters</button>
                    </td>
                </tr>
            `;
            return;
        }

        list.forEach(s => {
            const tr = document.createElement('tr');

            tr.innerHTML = `
                <td>
                    <input type="checkbox" class="row-checkbox" value="${s.id}" ${selectedScholarshipIds.has(s.id) ? 'checked' : ''} onchange="toggleSelectRow(${s.id}, this.checked)" style="cursor: pointer;">
                </td>
                <td>
                    <div class="uni-identity">
                        <div class="scholarship-icon-thumb">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2l9 4.91V17L12 22 3 17V6.91L12 2z"/>
                                <path d="M12 12l9-4.91"/>
                                <path d="M12 12v10"/>
                                <path d="M12 12L3 7.09"/>
                            </svg>
                        </div>
                        <div>
                            <div class="uni-name-text">${escapeHtml(s.name)}</div>
                            <div class="uni-meta-text">Ref: <strong>${escapeHtml(s.code)}</strong> &bull; ${escapeHtml(s.category || 'Merit')}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="country-pill">
                        <img src="${s.flag}" alt="${s.country}" class="country-flag-icon" onerror="this.style.display='none'">
                        <span>${escapeHtml(s.university)}</span>
                    </div>
                    <div style="font-size: 10px; color: #8c96a8; margin-top: 2px;">${escapeHtml(s.country)}</div>
                </td>
                <td>
                    <span class="${getCoverageClass(s.coverage)}">${getCoverageLabel(s.coverage)}</span>
                    <div style="font-size: 11px; font-weight: 600; color: #111827; margin-top: 3px;">${escapeHtml(s.amount)}</div>
                </td>
                <td>
                    <div style="font-weight: 600; font-size: 11px; color: #1f2937;">${escapeHtml(s.level)}</div>
                    <div style="font-size: 10px; color: #6b7280; margin-top: 2px;">${escapeHtml(s.field)}</div>
                </td>
                <td>
                    ${formatDeadline(s.deadline)}
                    <div style="font-size: 10px; color: #6b7280; margin-top: 2px;">Min GPA: ${escapeHtml(s.minGpa)}</div>
                </td>
                <td>
                    <span class="status-badge ${s.active ? 'active' : 'inactive'}">
                        ${s.active ? 'Active' : 'Inactive'}
                    </span>
                </td>
                <td>
                    <div class="actions-cell">
                        <button class="btn-view-courses" onclick="viewScholarshipDetails(${s.id})" title="View Full Eligibility & Requirements">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            Eligibility
                        </button>
                        <button class="btn-icon-action" onclick="openEditScholarshipModal(${s.id})" title="Edit Scholarship">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </button>
                        <button class="btn-icon-action delete" onclick="openDeleteScholarshipModal(${s.id})" title="Deactivate">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                </td>
            `;

            tbody.appendChild(tr);
        });
    }

    // Render Grid Cards View
    function renderGrid(list) {
        const grid = document.getElementById('gridViewSection');
        grid.innerHTML = '';

        if (list.length === 0) {
            grid.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #6b7280;">No scholarship opportunities match your filter criteria.</div>';
            return;
        }

        list.forEach(s => {
            const card = document.createElement('div');
            card.className = 'uni-grid-card';

            card.innerHTML = `
                <div class="card-top">
                    <span class="${getCoverageClass(s.coverage)}">${getCoverageLabel(s.coverage)}</span>
                    <span class="status-badge ${s.active ? 'active' : 'inactive'}">
                        ${s.active ? 'Active' : 'Inactive'}
                    </span>
                </div>

                <div>
                    <div style="font-size: 14px; font-weight: 700; color: #111827; line-height: 1.4;">
                        ${escapeHtml(s.name)}
                    </div>
                    <div style="font-size: 11px; color: #ea580c; font-weight: 600; margin-top: 2px;">
                        Ref: ${escapeHtml(s.code)} &bull; ${escapeHtml(s.category)}
                    </div>
                </div>

                <div class="country-pill">
                    <img src="${s.flag}" alt="${s.country}" class="country-flag-icon" onerror="this.style.display='none'">
                    <div>
                        <div style="font-weight: 600; color: #172033; font-size: 12px;">${escapeHtml(s.university)}</div>
                        <div style="font-size: 10px; color: #8a93a3;">${escapeHtml(s.country)}</div>
                    </div>
                </div>

                <div class="card-metric-grid">
                    <div>
                        <div class="card-metric-label">Award Value</div>
                        <div class="card-metric-val" style="color: #047857;">${escapeHtml(s.amount)}</div>
                    </div>
                    <div>
                        <div class="card-metric-label">Target Level</div>
                        <div class="card-metric-val">${escapeHtml(s.level)}</div>
                    </div>
                    <div>
                        <div class="card-metric-label">Min GPA</div>
                        <div class="card-metric-val">${escapeHtml(s.minGpa)}</div>
                    </div>
                    <div>
                        <div class="card-metric-label">Deadline</div>
                        <div class="card-metric-val">${escapeHtml(s.deadline || 'Rolling')}</div>
                    </div>
                </div>

                <div style="font-size: 11px; color: #6b7280; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    ${escapeHtml(s.eligibility || s.description || 'Comprehensive merit-based scholarship award for international scholars.')}
                </div>

                <div class="card-actions">
                    <button class="btn-view-courses" onclick="viewScholarshipDetails(${s.id})" style="margin-right: auto;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        Eligibility
                    </button>
                    <button class="btn-icon-action" onclick="openEditScholarshipModal(${s.id})" title="Edit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </button>
                    <button class="btn-icon-action delete" onclick="openDeleteScholarshipModal(${s.id})" title="Deactivate">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    </button>
                </div>
            `;

            grid.appendChild(card);
        });
    }

    // Render Pagination
    function renderPagination(total, startIdx, endIdx) {
        const info = document.getElementById('paginationInfo');
        const controls = document.getElementById('paginationControls');

        if (total === 0) {
            info.textContent = 'Showing 0 to 0 of 0 scholarships';
            controls.innerHTML = '';
            return;
        }

        info.textContent = `Showing ${startIdx + 1} to ${endIdx} of ${total} scholarships`;

        if (perPage === 'ALL') {
            controls.innerHTML = '';
            return;
        }

        const pSize = parseInt(perPage, 10);
        const totalPages = Math.ceil(total / pSize);

        let html = '';
        html += `<button class="btn-secondary" style="height: 28px; padding: 0 8px; font-size: 11px;" ${currentPage === 1 ? 'disabled style="opacity: 0.5; cursor: default;"' : ''} onclick="gotoPage(${currentPage - 1})">Prev</button>`;

        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                html += `<button class="btn-secondary ${i === currentPage ? 'active' : ''}" style="height: 28px; width: 28px; padding: 0; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; ${i === currentPage ? 'background: #f58220; color: #fff; border-color: #f58220;' : ''}" onclick="gotoPage(${i})">${i}</button>`;
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                html += `<span style="padding: 0 4px; color: #9ca3af;">...</span>`;
            }
        }

        html += `<button class="btn-secondary" style="height: 28px; padding: 0 8px; font-size: 11px;" ${currentPage === totalPages ? 'disabled style="opacity: 0.5; cursor: default;"' : ''} onclick="gotoPage(${currentPage + 1})">Next</button>`;

        controls.innerHTML = html;
    }

    function gotoPage(p) {
        currentPage = p;
        renderScholarships();
    }

    function changePerPage(val) {
        perPage = val;
        currentPage = 1;
        renderScholarships();
    }

    // Switch View
    function switchView(view) {
        currentView = view;
        const tableSection = document.getElementById('tableViewSection');
        const gridSection = document.getElementById('gridViewSection');
        const tableBtn = document.getElementById('tableViewBtn');
        const gridBtn = document.getElementById('gridViewBtn');

        if (view === 'table') {
            tableSection.style.display = 'block';
            gridSection.style.display = 'none';
            tableBtn.classList.add('active');
            gridBtn.classList.remove('active');
        } else {
            tableSection.style.display = 'none';
            gridSection.style.display = 'grid';
            tableBtn.classList.remove('active');
            gridBtn.classList.add('active');
        }
    }

    // Sort Table
    function sortTable(col) {
        if (sortColumn === col) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortColumn = col;
            sortDirection = 'asc';
        }
        renderScholarships();
    }

    // Reset Filters
    function resetFilters() {
        document.getElementById('scholarshipSearchInput').value = '';
        document.getElementById('topbarSearchInput').value = '';
        document.getElementById('coverageFilter').value = 'ALL';
        document.getElementById('universityFilter').value = 'ALL';
        document.getElementById('countryFilter').value = 'ALL';
        document.getElementById('levelFilter').value = 'ALL';
        document.getElementById('statusFilter').value = 'ALL';
        currentPage = 1;
        renderScholarships();
    }

    // Modal Control Helpers
    function openModal(id) {
        document.getElementById(id).classList.add('open');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    // Open Add Scholarship Modal
    function openAddScholarshipModal() {
        document.getElementById('addEditModalTitle').textContent = 'Add New Scholarship Program';
        document.getElementById('scholarshipIdField').value = '';
        document.getElementById('scholarshipForm').reset();
        document.getElementById('scholarshipActiveCheckbox').checked = true;
        document.getElementById('scholarshipCountryInput').value = '';
        openModal('addEditScholarshipModal');
    }

    // Open Edit Scholarship Modal
    function openEditScholarshipModal(id) {
        const s = scholarshipsData.find(item => item.id === id);
        if (!s) return;

        document.getElementById('addEditModalTitle').textContent = 'Edit Scholarship Program';
        document.getElementById('scholarshipIdField').value = s.id;
        document.getElementById('scholarshipCodeInput').value = s.code || '';
        document.getElementById('scholarshipNameInput').value = s.name || '';
        document.getElementById('scholarshipUniversitySelect').value = s.university || '';
        document.getElementById('scholarshipCountryInput').value = s.country || '';
        document.getElementById('scholarshipCoverageSelect').value = s.coverage || 'Full';
        document.getElementById('scholarshipAmountInput').value = s.amount || '';
        document.getElementById('scholarshipLevelSelect').value = s.level || 'Undergraduate';
        document.getElementById('scholarshipFieldInput').value = s.field || '';
        document.getElementById('scholarshipGpaInput').value = s.minGpa || '';
        document.getElementById('scholarshipDeadlineInput').value = s.deadline || '';
        document.getElementById('scholarshipQuotaInput').value = s.quota || '';
        document.getElementById('scholarshipCategorySelect').value = s.category || 'Merit-Based';
        document.getElementById('scholarshipEligibilityInput').value = s.eligibility || '';
        document.getElementById('scholarshipDescInput').value = s.description || '';
        document.getElementById('scholarshipActiveCheckbox').checked = !!s.active;

        openModal('addEditScholarshipModal');
    }

    // Handle Save (Add or Update)
    function handleSaveScholarship(e) {
        e.preventDefault();

        const idVal = document.getElementById('scholarshipIdField').value;
        const code = document.getElementById('scholarshipCodeInput').value.trim();
        const name = document.getElementById('scholarshipNameInput').value.trim();
        const uni = document.getElementById('scholarshipUniversitySelect').value;
        const country = document.getElementById('scholarshipCountryInput').value;
        const coverage = document.getElementById('scholarshipCoverageSelect').value;
        const amount = document.getElementById('scholarshipAmountInput').value.trim();
        const level = document.getElementById('scholarshipLevelSelect').value;
        const field = document.getElementById('scholarshipFieldInput').value.trim();
        const minGpa = document.getElementById('scholarshipGpaInput').value.trim();
        const deadline = document.getElementById('scholarshipDeadlineInput').value;
        const quota = document.getElementById('scholarshipQuotaInput').value.trim();
        const category = document.getElementById('scholarshipCategorySelect').value;
        const eligibility = document.getElementById('scholarshipEligibilityInput').value.trim();
        const description = document.getElementById('scholarshipDescInput').value.trim();
        const active = document.getElementById('scholarshipActiveCheckbox').checked;

        const uniObj = universityDirectory.find(u => u.name === uni);
        const flag = uniObj ? uniObj.flag : 'https://flagcdn.com/w40/un.png';

        if (idVal) {
            // Update existing
            const idx = scholarshipsData.findIndex(s => s.id === parseInt(idVal, 10));
            if (idx !== -1) {
                scholarshipsData[idx] = {
                    ...scholarshipsData[idx],
                    code,
                    name,
                    university: uni,
                    country,
                    flag,
                    coverage,
                    amount,
                    level,
                    field: field || 'All Disciplines',
                    minGpa,
                    deadline,
                    quota,
                    category,
                    eligibility,
                    description,
                    active
                };
                showToast('Scholarship program updated successfully!');
            }
        } else {
            // Add new
            const newId = scholarshipsData.length > 0 ? Math.max(...scholarshipsData.map(s => s.id)) + 1 : 1;
            const newScholarship = {
                id: newId,
                code,
                name,
                university: uni,
                country,
                flag,
                coverage,
                amount,
                level,
                field: field || 'All Disciplines',
                minGpa,
                deadline,
                quota,
                category,
                eligibility,
                description,
                active
            };
            scholarshipsData.unshift(newScholarship);
            showToast('New scholarship program created successfully!');
        }

        closeModal('addEditScholarshipModal');
        renderScholarships();
    }

    // View Eligibility & Details Modal
    function viewScholarshipDetails(id) {
        const s = scholarshipsData.find(item => item.id === id);
        if (!s) return;

        document.getElementById('detailScholarshipName').textContent = s.name;
        document.getElementById('detailScholarshipSubtitle').textContent = s.code + ' • ' + s.university + ' (' + s.country + ')';

        const body = document.getElementById('detailModalBodyContent');
        body.innerHTML = `
            <div class="req-section">
                <div class="req-section-title">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#f58220" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="16" x2="12" y2="12"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>
                    </svg>
                    Award Value & Financial Coverage
                </div>
                <div class="req-grid">
                    <div class="req-item">
                        <strong>Coverage Type</strong>
                        <span class="${getCoverageClass(s.coverage)}">${getCoverageLabel(s.coverage)}</span>
                    </div>
                    <div class="req-item">
                        <strong>Total Award Value</strong>
                        <span style="color: #047857; font-weight: 700;">${escapeHtml(s.amount)}</span>
                    </div>
                    <div class="req-item">
                        <strong>Funding Category</strong>
                        <span>${escapeHtml(s.category || 'Merit-Based')}</span>
                    </div>
                    <div class="req-item">
                        <strong>Available Quota / Slots</strong>
                        <span>${escapeHtml(s.quota || 'Competitive Global Allocation')}</span>
                    </div>
                </div>
            </div>

            <div class="req-section">
                <div class="req-section-title">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                    Academic Prerequisites & Selection Criteria
                </div>
                <div class="req-grid">
                    <div class="req-item">
                        <strong>Target Degree Level</strong>
                        <span>${escapeHtml(s.level)}</span>
                    </div>
                    <div class="req-item">
                        <strong>Applicable Field</strong>
                        <span>${escapeHtml(s.field || 'All Eligible Programs')}</span>
                    </div>
                    <div class="req-item">
                        <strong>Minimum GPA / Academic Cutoff</strong>
                        <span style="font-weight: 700; color: #111827;">${escapeHtml(s.minGpa)}</span>
                    </div>
                    <div class="req-item">
                        <strong>Application Deadline</strong>
                        <span>${escapeHtml(s.deadline || 'Rolling Basis')}</span>
                    </div>
                    <div class="req-item" style="grid-column: 1 / -1;">
                        <strong>Eligibility Guidelines & Prerequisites</strong>
                        <span style="display: block; margin-top: 3px; line-height: 1.5;">${escapeHtml(s.eligibility || 'Applicants must possess strong academic standing and hold an offer of admission from the host institution.')}</span>
                    </div>
                </div>
            </div>

            <div class="req-section">
                <div class="req-section-title">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                    Overview & Application Procedures
                </div>
                <p style="font-size: 12px; color: #4b5565; line-height: 1.6;">
                    ${escapeHtml(s.description || 'Award decisions are made by the joint university scholarship committee. Shortlisted candidates may be invited for an interview. Renewals are subject to maintaining high academic performance.')}
                </p>
            </div>
        `;

        document.getElementById('detailEditBtn').onclick = function() {
            closeModal('scholarshipDetailsModal');
            openEditScholarshipModal(s.id);
        };

        openModal('scholarshipDetailsModal');
    }

    // Delete / Deactivate Scholarship Modal
    function openDeleteScholarshipModal(id) {
        const s = scholarshipsData.find(item => item.id === id);
        if (!s) return;

        deletingScholarshipId = id;
        document.getElementById('deleteScholarshipName').textContent = s.name + ' (' + s.code + ')';

        document.getElementById('confirmDeleteBtn').onclick = function() {
            scholarshipsData = scholarshipsData.filter(item => item.id !== deletingScholarshipId);
            selectedScholarshipIds.delete(deletingScholarshipId);
            closeModal('deleteScholarshipModal');
            showToast('Scholarship program deactivated and withdrawn.');
            renderScholarships();
        };

        openModal('deleteScholarshipModal');
    }

    // Checkbox Selections
    function toggleSelectAll(masterCheckbox) {
        const isChecked = masterCheckbox.checked;
        const visible = getFilteredScholarships();
        visible.forEach(s => {
            if (isChecked) selectedScholarshipIds.add(s.id);
            else selectedScholarshipIds.delete(s.id);
        });
        renderScholarships();
    }

    function toggleSelectRow(id, isChecked) {
        if (isChecked) selectedScholarshipIds.add(id);
        else selectedScholarshipIds.delete(id);
        renderScholarships();
    }

    // Export CSV
    function exportScholarshipsCSV() {
        const list = getFilteredScholarships();
        if (list.length === 0) {
            showToast('No scholarship data available to export.');
            return;
        }

        const headers = ["ID", "Code", "Scholarship Name", "University", "Country", "Coverage", "Award Value", "Level", "Field", "Min GPA", "Deadline", "Quota", "Category", "Status"];
        const rows = list.map(s => [
            s.id,
            '"' + (s.code || '').replace(/"/g, '""') + '"',
            '"' + (s.name || '').replace(/"/g, '""') + '"',
            '"' + (s.university || '').replace(/"/g, '""') + '"',
            '"' + (s.country || '').replace(/"/g, '""') + '"',
            '"' + (s.coverage || '').replace(/"/g, '""') + '"',
            '"' + (s.amount || '').replace(/"/g, '""') + '"',
            '"' + (s.level || '').replace(/"/g, '""') + '"',
            '"' + (s.field || '').replace(/"/g, '""') + '"',
            '"' + (s.minGpa || '').replace(/"/g, '""') + '"',
            '"' + (s.deadline || '').replace(/"/g, '""') + '"',
            '"' + (s.quota || '').replace(/"/g, '""') + '"',
            '"' + (s.category || '').replace(/"/g, '""') + '"',
            s.active ? 'Active' : 'Inactive'
        ]);

        const csvContent = "data:text/csv;charset=utf-8," + [headers.join(','), ...rows.map(r => r.join(','))].join('\n');
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "indic_rmc_scholarships_" + new Date().toISOString().slice(0, 10) + ".csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Exported ' + list.length + ' scholarships to CSV!');
    }

    // Toast Notification
    function showToast(msg) {
        const toast = document.getElementById('toast');
        const span = document.getElementById('toastMessage');
        span.textContent = msg;
        toast.style.display = 'flex';
        clearTimeout(toast._timeout);
        toast._timeout = setTimeout(() => {
            toast.style.display = 'none';
        }, 3200);
    }

    // XSS Sanitization Helper
    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }
</script>

</body>
</html>
