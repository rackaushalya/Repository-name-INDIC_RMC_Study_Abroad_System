<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDIC RMC | Course Management</title>

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
           SIDEBAR (Exact match to Dashboard, Universities, Countries)
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
           TOPBAR (Exact match to Dashboard, Universities, Countries)
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
           CONTROLS CARD (Exact match to Universities & Countries)
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
            max-width: 340px;
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

        .course-icon-thumb {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fffaf5;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f58220;
            font-weight: 700;
            font-size: 13px;
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
            padding: 3px 9px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
        }

        .ranking-pill.bachelor {
            background: #eff6ff;
            color: #2563eb;
            border-color: #dbeafe;
        }

        .ranking-pill.master {
            background: #f5f3ff;
            color: #7c3aed;
            border-color: #ddd6fe;
        }

        .ranking-pill.mba {
            background: #fdf2f8;
            color: #be185d;
            border-color: #fbcfe8;
        }

        .ranking-pill.phd {
            background: #fefce8;
            color: #a16207;
            border-color: #fef08a;
        }

        .ranking-pill.diploma {
            background: #f0fdf4;
            color: #15803d;
            border-color: #bbf7d0;
        }

        .mode-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
        }

        .mode-pill.on-campus {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .mode-pill.online {
            background: #f0f9ff;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .mode-pill.hybrid {
            background: #faf5ff;
            color: #6b21a8;
            border: 1px solid #e9d5ff;
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
           CARDS GRID VIEW (Exact match to Universities & Countries)
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
           MODAL SYSTEM (Exact match to Universities & Countries)
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

        .form-grid.full {
            grid-template-columns: 1fr;
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

            <!-- ACTIVE ITEM: Courses -->
            <a href="{{ url('/admin/courses') }}" class="nav-link active">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M3 10l9-6 9 6"/>
                    <path d="M5 10v9h14v-9"/>
                    <path d="M9 19v-5h6v5"/>
                </svg>
                <span>Courses</span>
                <span class="nav-badge" id="navCourseCountBadge">18</span>
            </a>

            <a href="#" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 3v18"/>
                    <path d="M17 7H9.5a3 3 0 0 0 0 6H14.5a3 3 0 0 1 0 6H7"/>
                </svg>
                <span>Scholarships</span>
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
                <input type="text" id="topbarSearchInput" placeholder="Quick search courses, degrees, universities... (Ctrl+/)">
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
                        Course Management
                        <span class="title-badge" id="totalCoursesBadge">18 Total Courses</span>
                    </h1>
                    <p>Configure accredited academic degree programs, entry requirements, tuition fees, and partner university affiliations.</p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn-secondary" onclick="exportCoursesCSV()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Export CSV
                    </button>
                    <button class="btn-orange" onclick="openAddCourseModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Add New Course
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
                        <input type="text" id="courseSearchInput" placeholder="Search by course name, code, or field...">
                    </div>

                    <select class="filter-select" id="levelFilter">
                        <option value="ALL">All Degree Levels</option>
                        <option value="Bachelor">Bachelor</option>
                        <option value="Master">Master</option>
                        <option value="MBA">MBA</option>
                        <option value="PhD">PhD</option>
                        <option value="Diploma">Diploma</option>
                    </select>

                    <select class="filter-select" id="universityFilter">
                        <option value="ALL">All Universities</option>
                    </select>

                    <select class="filter-select" id="modeFilter">
                        <option value="ALL">All Study Modes</option>
                        <option value="On Campus">On Campus</option>
                        <option value="Online">Online</option>
                        <option value="Hybrid">Hybrid</option>
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
                                <th class="sortable" onclick="sortTable('name')">Course & Code ↕</th>
                                <th class="sortable" onclick="sortTable('university')">Partner University ↕</th>
                                <th class="sortable" onclick="sortTable('level')">Level & Field ↕</th>
                                <th>Duration & Mode</th>
                                <th class="sortable" onclick="sortTable('tuition')">Annual Tuition ↕</th>
                                <th>Status</th>
                                <th style="text-align: right; width: 170px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="courseTableBody">
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
                    <div id="paginationInfo">Showing 1 to 18 of 18 programs</div>
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
     MODAL 1: ADD / EDIT COURSE PROGRAM
====================================================== -->
<div class="modal-backdrop" id="addEditCourseModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <div class="modal-title" id="addEditModalTitle">Add New Degree Program</div>
                <div class="modal-subtitle">Define program curriculum, entry requirements, tuition, and university affiliation.</div>
            </div>
            <button class="modal-close-btn" onclick="closeModal('addEditCourseModal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <form id="courseForm" onsubmit="handleSaveCourse(event)">
            <input type="hidden" id="courseIdField" value="">
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Course Code <span class="req">*</span></label>
                        <input type="text" class="form-input" id="courseCodeInput" placeholder="e.g. CS-201" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Course Name <span class="req">*</span></label>
                        <input type="text" class="form-input" id="courseNameInput" placeholder="e.g. B.Sc. in Computer Science" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Partner University <span class="req">*</span></label>
                        <select class="form-select" id="courseUniversitySelect" onchange="syncCountryFromUniversity(this.value)" required>
                            <option value="">Select University...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Host Country <span class="req">*</span></label>
                        <input type="text" class="form-input" id="courseCountryInput" placeholder="Country" readonly style="background: #f9fafb;">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Degree Level <span class="req">*</span></label>
                        <select class="form-select" id="courseLevelSelect" required>
                            <option value="Bachelor">Bachelor</option>
                            <option value="Master">Master</option>
                            <option value="MBA">MBA</option>
                            <option value="PhD">PhD</option>
                            <option value="Diploma">Diploma</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Field of Study <span class="req">*</span></label>
                        <input type="text" class="form-input" id="courseFieldInput" placeholder="e.g. Computer Science & AI" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Study Mode <span class="req">*</span></label>
                        <select class="form-select" id="courseModeSelect" required>
                            <option value="On Campus">On Campus</option>
                            <option value="Online">Online</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Program Duration <span class="req">*</span></label>
                        <input type="text" class="form-input" id="courseDurationInput" placeholder="e.g. 4 Years or 2 Years" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Annual Tuition Fee <span class="req">*</span></label>
                        <input type="text" class="form-input" id="courseTuitionInput" placeholder="e.g. $38,500 / year" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Total Credits</label>
                        <input type="text" class="form-input" id="courseCreditsInput" placeholder="e.g. 120 ECTS or 180 Credits">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Semester Intakes</label>
                        <input type="text" class="form-input" id="courseIntakesInput" placeholder="e.g. September, January">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Minimum GPA / Score</label>
                        <input type="text" class="form-input" id="courseMinGpaInput" placeholder="e.g. 3.2 / 4.0 (80%)">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">English Requirements (IELTS/TOEFL)</label>
                        <input type="text" class="form-input" id="courseEnglishReqInput" placeholder="e.g. IELTS 6.5 (min 6.0) or TOEFL 90">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Academic Prerequisites</label>
                        <input type="text" class="form-input" id="coursePrereqInput" placeholder="e.g. High school math & physics">
                    </div>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Program Overview & Syllabus</label>
                    <textarea class="form-textarea" id="courseDescInput" placeholder="Provide course description, major modules, and career progression pathways..."></textarea>
                </div>

                <div class="form-group full-width">
                    <label class="form-checkbox-label">
                        <input type="checkbox" id="courseActiveCheckbox" checked>
                        <span>Active Course Program (visible to student applicants and consultants)</span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('addEditCourseModal')">Cancel</button>
                <button type="submit" class="btn-orange">Save Program</button>
            </div>
        </form>
    </div>
</div>

<!-- =====================================================
     MODAL 2: ENTRY REQUIREMENTS & OVERVIEW MODAL
====================================================== -->
<div class="modal-backdrop" id="courseDetailsModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <div class="modal-title" id="detailCourseName">Course Title</div>
                <div class="modal-subtitle" id="detailCourseSubtitle">Code & University</div>
            </div>
            <button class="modal-close-btn" onclick="closeModal('courseDetailsModal')">
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
            <button type="button" class="btn-secondary" id="detailEditBtn">Edit Program</button>
            <button type="button" class="btn-orange" onclick="closeModal('courseDetailsModal')">Close</button>
        </div>
    </div>
</div>

<!-- =====================================================
     MODAL 3: DELETE / DEACTIVATE CONFIRMATION
====================================================== -->
<div class="modal-backdrop" id="deleteCourseModal">
    <div class="modal-window" style="max-width: 440px;">
        <div class="modal-header">
            <div>
                <div class="modal-title" style="color: #dc2626;">Deactivate Course Program</div>
                <div class="modal-subtitle">Are you sure you want to deactivate this accredited course?</div>
            </div>
            <button class="modal-close-btn" onclick="closeModal('deleteCourseModal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <p style="font-size: 13px; color: #4b5565; line-height: 1.5;">
                Deactivating <strong id="deleteCourseName" style="color: #111827;"></strong> will unpublish it from student portal recommendations and active applications.
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" onclick="closeModal('deleteCourseModal')">Cancel</button>
            <button type="button" class="btn-danger" id="confirmDeleteBtn">Deactivate Program</button>
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
    // Initial Universities List with Country Mapping
    const universityDirectory = [
        { name: "University of Toronto", country: "Canada", flag: "https://flagcdn.com/w40/ca.png" },
        { name: "McGill University", country: "Canada", flag: "https://flagcdn.com/w40/ca.png" },
        { name: "University of British Columbia", country: "Canada", flag: "https://flagcdn.com/w40/ca.png" },
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

    // Initial Accredited Courses Dataset (18 Programs across 7 Countries)
    let coursesData = [
        {
            id: 1,
            code: "CS-101",
            name: "B.Sc. in Computer Science & Artificial Intelligence",
            university: "University of Toronto",
            country: "Canada",
            flag: "https://flagcdn.com/w40/ca.png",
            level: "Bachelor",
            field: "Computer Science & IT",
            duration: "4 Years",
            mode: "On Campus",
            tuition: "$42,500 / year",
            credits: "120 Credits",
            intakes: "September, January",
            minGpa: "3.5 / 4.0 (85%)",
            englishReq: "IELTS 6.5 (min 6.0 in bands) or TOEFL 92",
            prerequisites: "High school mathematics and computing fundamentals with Grade A/B.",
            description: "A premier honors program delivering rigorous instruction in machine learning, distributed software systems, algorithms, and applied robotics.",
            active: true
        },
        {
            id: 2,
            code: "DS-501",
            name: "Master of Science in Data Science & Big Data Analytics",
            university: "University of British Columbia",
            country: "Canada",
            flag: "https://flagcdn.com/w40/ca.png",
            level: "Master",
            field: "Data Science & Analytics",
            duration: "2 Years",
            mode: "Hybrid",
            tuition: "$34,000 / year",
            credits: "60 ECTS",
            intakes: "September, May",
            minGpa: "3.3 / 4.0 (82%)",
            englishReq: "IELTS 7.0 (min 6.5) or TOEFL 96",
            prerequisites: "Undergraduate degree in STEM field with proven linear algebra and Python fluency.",
            description: "Designed for industry leaders handling high-throughput big data pipelines, neural network architecture, and statistical inference.",
            active: true
        },
        {
            id: 3,
            code: "MBA-701",
            name: "Global Executive MBA in Strategic Innovation",
            university: "University of Oxford",
            country: "United Kingdom",
            flag: "https://flagcdn.com/w40/gb.png",
            level: "MBA",
            field: "Business & Management",
            duration: "1 Year",
            mode: "On Campus",
            tuition: "£58,000 / year",
            credits: "180 Credits",
            intakes: "September, January",
            minGpa: "3.4 / 4.0 or 1st Class Honors",
            englishReq: "IELTS 7.5 (min 7.0) or TOEFL 105",
            prerequisites: "At least 3 years of executive or management professional work experience.",
            description: "World-class business education focusing on disruptive enterprise leadership, global economics, and venture incubation.",
            active: true
        },
        {
            id: 4,
            code: "AI-602",
            name: "M.Sc. in Machine Learning & Robotics Engineering",
            university: "Imperial College London",
            country: "United Kingdom",
            flag: "https://flagcdn.com/w40/gb.png",
            level: "Master",
            field: "Artificial Intelligence",
            duration: "1 Year",
            mode: "On Campus",
            tuition: "£38,500 / year",
            credits: "90 ECTS",
            intakes: "October",
            minGpa: "3.6 / 4.0 (87%)",
            englishReq: "IELTS 7.0 (min 6.5) or TOEFL 100",
            prerequisites: "Bachelors in Computer Engineering, Electrical Engineering or Mathematics.",
            description: "Hands-on research degree combining perception, kinematics, deep reinforcement learning, and autonomous drone systems.",
            active: true
        },
        {
            id: 5,
            code: "ENG-104",
            name: "Bachelor of Science in Electrical Engineering & Computing",
            university: "MIT",
            country: "United States",
            flag: "https://flagcdn.com/w40/us.png",
            level: "Bachelor",
            field: "Engineering & Tech",
            duration: "4 Years",
            mode: "On Campus",
            tuition: "$57,500 / year",
            credits: "132 Credits",
            intakes: "September",
            minGpa: "3.8 / 4.0 (92%)",
            englishReq: "TOEFL 100 or IELTS 7.5",
            prerequisites: "SAT / ACT with advanced calculus and physics score.",
            description: "The gold standard undergraduate engineering degree encompassing microelectronics, computer architecture, and wireless systems.",
            active: true
        },
        {
            id: 6,
            code: "MED-801",
            name: "Master of Public Health & Global Epidemiology",
            university: "Harvard University",
            country: "United States",
            flag: "https://flagcdn.com/w40/us.png",
            level: "Master",
            field: "Medicine & Health",
            duration: "2 Years",
            mode: "Hybrid",
            tuition: "$49,800 / year",
            credits: "80 Credits",
            intakes: "September",
            minGpa: "3.5 / 4.0",
            englishReq: "IELTS 7.5 or TOEFL 102",
            prerequisites: "Undergraduate degree in biological sciences, medicine, or allied health professions.",
            description: "Prepares world healthcare analysts to monitor biosecurity, disease prevention mechanisms, and cross-border clinical trials.",
            active: true
        },
        {
            id: 7,
            code: "PHD-901",
            name: "Ph.D. in Quantum Computing & Applied Physics",
            university: "Stanford University",
            country: "United States",
            flag: "https://flagcdn.com/w40/us.png",
            level: "PhD",
            field: "Quantum Sciences",
            duration: "5 Years",
            mode: "On Campus",
            tuition: "Fully Funded (Stipend)",
            credits: "Doctoral Dissertation",
            intakes: "September",
            minGpa: "3.8 / 4.0",
            englishReq: "TOEFL 105 or IELTS 8.0",
            prerequisites: "Research publication track record in quantum mechanics or superconducting hardware.",
            description: "Doctoral research program supported by federal energy laboratories and Silicon Valley quantum hardware consortiums.",
            active: true
        },
        {
            id: 8,
            code: "FIN-302",
            name: "B.Sc. in Quantitative Finance & FinTech",
            university: "National University of Singapore",
            country: "Singapore",
            flag: "https://flagcdn.com/w40/sg.png",
            level: "Bachelor",
            field: "Finance & Economics",
            duration: "4 Years",
            mode: "On Campus",
            tuition: "S$38,000 / year",
            credits: "160 MCs",
            intakes: "August",
            minGpa: "3.6 / 4.0 (88%)",
            englishReq: "IELTS 6.5 or TOEFL 90",
            prerequisites: "Superior high school performance in advanced mathematics and statistics.",
            description: "High-demand Asian banking hub curriculum in algorithmic high-frequency trading, blockchain architecture, and risk modeling.",
            active: true
        },
        {
            id: 9,
            code: "CS-403",
            name: "Master in Cyber Security & Network Defense",
            university: "Nanyang Technological University",
            country: "Singapore",
            flag: "https://flagcdn.com/w40/sg.png",
            level: "Master",
            field: "Cyber Security",
            duration: "1.5 Years",
            mode: "Online",
            tuition: "S$32,000 / year",
            credits: "45 Credits",
            intakes: "August, January",
            minGpa: "3.2 / 4.0",
            englishReq: "IELTS 6.5 or TOEFL 90",
            prerequisites: "Bachelors in Computer Science, IT, or equivalent industry certifications (CISSP/CEH).",
            description: "Deep-dive program into penetration testing, threat hunting, zero-trust cloud infrastructure, and cryptography.",
            active: true
        },
        {
            id: 10,
            code: "ENG-502",
            name: "M.Sc. in Automotive & Sustainable Mobility",
            university: "Technical University of Munich",
            country: "Germany",
            flag: "https://flagcdn.com/w40/de.png",
            level: "Master",
            field: "Automotive Engineering",
            duration: "2 Years",
            mode: "On Campus",
            tuition: "€1,500 / semester",
            credits: "120 ECTS",
            intakes: "October, April",
            minGpa: "2.5 (German Scale ~ 80%)",
            englishReq: "IELTS 6.5 or German B2",
            prerequisites: "Undergraduate degree in Mechanical Engineering, Mechatronics, or Automotive systems.",
            description: "German automotive excellence focusing on battery cell chemistry, EV powertrains, and autonomous driving telemetry.",
            active: true
        },
        {
            id: 11,
            code: "BIO-601",
            name: "Master of Molecular Biotechnology & Genomics",
            university: "Heidelberg University",
            country: "Germany",
            flag: "https://flagcdn.com/w40/de.png",
            level: "Master",
            field: "Biotechnology & Life Sciences",
            duration: "2 Years",
            mode: "On Campus",
            tuition: "€1,500 / semester",
            credits: "120 ECTS",
            intakes: "October",
            minGpa: "2.3 (German Scale)",
            englishReq: "IELTS 7.0 or TOEFL 95",
            prerequisites: "Degree in Biochemistry, Molecular Biology, or Biotechnology.",
            description: "Translational research laboratory program covering CRISPR gene editing, immuno-oncology, and synthetic biology.",
            active: true
        },
        {
            id: 12,
            code: "MGT-201",
            name: "Bachelor of Commerce & International Business",
            university: "University of Melbourne",
            country: "Australia",
            flag: "https://flagcdn.com/w40/au.png",
            level: "Bachelor",
            field: "Business & Management",
            duration: "3 Years",
            mode: "On Campus",
            tuition: "A$44,500 / year",
            credits: "300 Points",
            intakes: "February, July",
            minGpa: "3.2 / 4.0 (80%)",
            englishReq: "IELTS 6.5 (no band below 6.0)",
            prerequisites: "Australian Year 12 or equivalent international senior high school certificate.",
            description: "Comprehensive commercial leadership degree accredited by CPA Australia and AACSB international.",
            active: true
        },
        {
            id: 13,
            code: "LAW-701",
            name: "Master of Laws (LL.M.) in International Trade Law",
            university: "University of Sydney",
            country: "Australia",
            flag: "https://flagcdn.com/w40/au.png",
            level: "Master",
            field: "Law & Jurisprudence",
            duration: "1 Year",
            mode: "Hybrid",
            tuition: "A$48,000 / year",
            credits: "48 Credit Points",
            intakes: "March, August",
            minGpa: "3.3 / 4.0",
            englishReq: "IELTS 7.0 (no band below 6.5)",
            prerequisites: "Bachelor of Laws (LL.B.) or Juris Doctor (J.D.) from recognized institution.",
            description: "Specialized postgraduate law curriculum covering cross-border arbitration, maritime agreements, and WTO regulatory policy.",
            active: true
        },
        {
            id: 14,
            code: "CS-305",
            name: "M.Sc. in Cloud Computing & DevOps Architecture",
            university: "Trinity College Dublin",
            country: "Ireland",
            flag: "https://flagcdn.com/w40/ie.png",
            level: "Master",
            field: "Computer Science & IT",
            duration: "1 Year",
            mode: "On Campus",
            tuition: "€24,500 / year",
            credits: "90 ECTS",
            intakes: "September",
            minGpa: "2.1 Honors (75%)",
            englishReq: "IELTS 6.5 (min 6.0 in writing)",
            prerequisites: "Bachelors in Computing or Software Development.",
            description: "Co-designed with Dublin tech multinationals (Google, AWS, Microsoft) emphasizing Kubernetes, multi-cloud resilience, and CI/CD.",
            active: true
        },
        {
            id: 15,
            code: "DIP-101",
            name: "Diploma in International Hospitality & Tourism Management",
            university: "McGill University",
            country: "Canada",
            flag: "https://flagcdn.com/w40/ca.png",
            level: "Diploma",
            field: "Hospitality & Tourism",
            duration: "1 Year",
            mode: "On Campus",
            tuition: "$18,500 / year",
            credits: "30 Credits",
            intakes: "September, January, May",
            minGpa: "2.8 / 4.0",
            englishReq: "IELTS 6.0 or TOEFL 80",
            prerequisites: "High school completion or 1 year of service sector experience.",
            description: "Professional accelerated diploma with paid Canadian hospitality co-op placement opportunities.",
            active: true
        },
        {
            id: 16,
            code: "ENV-202",
            name: "B.Sc. in Environmental Sciences & Sustainability",
            university: "University of Cambridge",
            country: "United Kingdom",
            flag: "https://flagcdn.com/w40/gb.png",
            level: "Bachelor",
            field: "Environmental Science",
            duration: "3 Years",
            mode: "On Campus",
            tuition: "£36,000 / year",
            credits: "180 Credits",
            intakes: "October",
            minGpa: "3.7 / 4.0",
            englishReq: "IELTS 7.5 (min 7.0 in all bands)",
            prerequisites: "A-Levels with Chemistry, Biology, and Geography.",
            description: "Interdisciplinary study of climate adaptation, renewable energy transitions, biodiversity preservation, and geological surveys.",
            active: true
        },
        {
            id: 17,
            code: "DIP-102",
            name: "Professional Diploma in Digital Marketing & Growth Hacking",
            university: "University of Melbourne",
            country: "Australia",
            flag: "https://flagcdn.com/w40/au.png",
            level: "Diploma",
            field: "Marketing & Media",
            duration: "1 Year",
            mode: "Online",
            tuition: "A$16,800 / year",
            credits: "50 Points",
            intakes: "Quarterly (Jan, Apr, Jul, Oct)",
            minGpa: "2.7 / 4.0",
            englishReq: "IELTS 6.0",
            prerequisites: "Secondary education completion.",
            description: "Practical online credential covering programmatic ad spending, conversion optimization, SEO, and omnichannel analytics.",
            active: true
        },
        {
            id: 18,
            code: "PHD-905",
            name: "Ph.D. in Artificial Intelligence for Healthcare & Diagnostics",
            university: "University of Toronto",
            country: "Canada",
            flag: "https://flagcdn.com/w40/ca.png",
            level: "PhD",
            field: "Health Informatics & AI",
            duration: "4 Years",
            mode: "On Campus",
            tuition: "Fully Funded (Fellowship)",
            credits: "Doctoral Thesis",
            intakes: "September",
            minGpa: "3.7 / 4.0",
            englishReq: "IELTS 7.5 or TOEFL 100",
            prerequisites: "M.Sc. in Computer Science or Biomedical Informatics.",
            description: "Pioneering doctoral fellowship at Vector Institute combining medical image segmentation, drug discovery ML, and patient EHR predictive modeling.",
            active: true
        }
    ];

    // State Variables
    let currentView = 'table';
    let sortColumn = 'name';
    let sortDirection = 'asc';
    let currentPage = 1;
    let perPage = 20;
    let selectedCourseIds = new Set();
    let deletingCourseId = null;

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        populateUniversityDropdowns();
        renderCourses();
        attachFilterListeners();
    });

    // Populate University Dropdown in Filter & Modal
    function populateUniversityDropdowns() {
        const uniFilter = document.getElementById('universityFilter');
        const uniSelect = document.getElementById('courseUniversitySelect');

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
        const countryInput = document.getElementById('courseCountryInput');
        if (found) {
            countryInput.value = found.country;
        } else {
            countryInput.value = '';
        }
    }

    // Filter listeners
    function attachFilterListeners() {
        document.getElementById('courseSearchInput').addEventListener('input', () => {
            currentPage = 1;
            renderCourses();
        });

        document.getElementById('topbarSearchInput').addEventListener('input', (e) => {
            document.getElementById('courseSearchInput').value = e.target.value;
            currentPage = 1;
            renderCourses();
        });

        document.getElementById('levelFilter').addEventListener('change', () => {
            currentPage = 1;
            renderCourses();
        });

        document.getElementById('universityFilter').addEventListener('change', () => {
            currentPage = 1;
            renderCourses();
        });

        document.getElementById('modeFilter').addEventListener('change', () => {
            currentPage = 1;
            renderCourses();
        });

        document.getElementById('statusFilter').addEventListener('change', () => {
            currentPage = 1;
            renderCourses();
        });

        // Global hotkey Ctrl+/ for quick search
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === '/') {
                e.preventDefault();
                document.getElementById('courseSearchInput').focus();
            }
            if (e.key === 'Escape') {
                closeModal('addEditCourseModal');
                closeModal('courseDetailsModal');
                closeModal('deleteCourseModal');
            }
        });
    }

    // Filter and Sort Data
    function getFilteredCourses() {
        const searchVal = (document.getElementById('courseSearchInput').value || '').toLowerCase().trim();
        const levelVal = document.getElementById('levelFilter').value;
        const uniVal = document.getElementById('universityFilter').value;
        const modeVal = document.getElementById('modeFilter').value;
        const statusVal = document.getElementById('statusFilter').value;

        return coursesData.filter(c => {
            const matchesSearch = !searchVal ||
                c.name.toLowerCase().includes(searchVal) ||
                c.code.toLowerCase().includes(searchVal) ||
                c.field.toLowerCase().includes(searchVal) ||
                c.university.toLowerCase().includes(searchVal) ||
                c.country.toLowerCase().includes(searchVal);

            const matchesLevel = (levelVal === 'ALL') || (c.level === levelVal);
            const matchesUni = (uniVal === 'ALL') || (c.university === uniVal);
            const matchesMode = (modeVal === 'ALL') || (c.mode === modeVal);
            const matchesStatus = (statusVal === 'ALL') ||
                (statusVal === 'Active' && c.active) ||
                (statusVal === 'Inactive' && !c.active);

            return matchesSearch && matchesLevel && matchesUni && matchesMode && matchesStatus;
        }).sort((a, b) => {
            let valA, valB;
            if (sortColumn === 'name') {
                valA = a.name.toLowerCase();
                valB = b.name.toLowerCase();
            } else if (sortColumn === 'university') {
                valA = a.university.toLowerCase();
                valB = b.university.toLowerCase();
            } else if (sortColumn === 'level') {
                valA = a.level.toLowerCase();
                valB = b.level.toLowerCase();
            } else if (sortColumn === 'tuition') {
                valA = a.tuition.toLowerCase();
                valB = b.tuition.toLowerCase();
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
    function renderCourses() {
        const filtered = getFilteredCourses();
        const total = filtered.length;

        // Update badges
        document.getElementById('totalCoursesBadge').textContent = total + ' Total Courses';
        document.getElementById('navCourseCountBadge').textContent = coursesData.length;

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

    // Helper: Level badge class
    function getLevelClass(level) {
        const l = (level || '').toLowerCase();
        if (l === 'bachelor') return 'ranking-pill bachelor';
        if (l === 'master') return 'ranking-pill master';
        if (l === 'mba') return 'ranking-pill mba';
        if (l === 'phd') return 'ranking-pill phd';
        if (l === 'diploma') return 'ranking-pill diploma';
        return 'ranking-pill';
    }

    // Helper: Mode pill class
    function getModeClass(mode) {
        const m = (mode || '').toLowerCase();
        if (m === 'on campus') return 'mode-pill on-campus';
        if (m === 'online') return 'mode-pill online';
        if (m === 'hybrid') return 'mode-pill hybrid';
        return 'mode-pill';
    }

    // Render Table View
    function renderTable(list) {
        const tbody = document.getElementById('courseTableBody');
        tbody.innerHTML = '';

        if (list.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: #6b7280;">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" style="margin-bottom: 8px;">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <p style="font-size: 13px; font-weight: 500;">No degree programs match your search or filter criteria.</p>
                        <button class="btn-secondary" onclick="resetFilters()" style="margin: 10px auto 0;">Reset Filters</button>
                    </td>
                </tr>
            `;
            return;
        }

        list.forEach(c => {
            const tr = document.createElement('tr');

            tr.innerHTML = `
                <td>
                    <input type="checkbox" class="row-checkbox" value="${c.id}" ${selectedCourseIds.has(c.id) ? 'checked' : ''} onchange="toggleSelectRow(${c.id}, this.checked)" style="cursor: pointer;">
                </td>
                <td>
                    <div class="uni-identity">
                        <div class="course-icon-thumb">
                            ${c.code.split('-')[0] || 'CR'}
                        </div>
                        <div>
                            <div class="uni-name-text">${escapeHtml(c.name)}</div>
                            <div class="uni-meta-text">Code: <strong>${escapeHtml(c.code)}</strong> &bull; ${escapeHtml(c.credits || '')}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="country-pill">
                        <img src="${c.flag}" alt="${c.country}" class="country-flag-icon" onerror="this.style.display='none'">
                        <span>${escapeHtml(c.university)}</span>
                    </div>
                    <div style="font-size: 10px; color: #8c96a8; margin-top: 2px;">${escapeHtml(c.country)}</div>
                </td>
                <td>
                    <span class="${getLevelClass(c.level)}">${escapeHtml(c.level)}</span>
                    <div style="font-size: 11px; color: #6b7280; margin-top: 3px;">${escapeHtml(c.field)}</div>
                </td>
                <td>
                    <span class="${getModeClass(c.mode)}">${escapeHtml(c.mode)}</span>
                    <div style="font-size: 11px; color: #8c96a8; margin-top: 3px;">${escapeHtml(c.duration)}</div>
                </td>
                <td>
                    <strong style="color: #111827; font-size: 12px;">${escapeHtml(c.tuition)}</strong>
                    <div style="font-size: 10px; color: #6b7280; margin-top: 2px;">Intakes: ${escapeHtml(c.intakes || 'Flexible')}</div>
                </td>
                <td>
                    <span class="status-badge ${c.active ? 'active' : 'inactive'}">
                        ${c.active ? 'Active' : 'Inactive'}
                    </span>
                </td>
                <td>
                    <div class="actions-cell">
                        <button class="btn-view-courses" onclick="viewCourseDetails(${c.id})" title="View Requirements & Intakes">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            Requirements
                        </button>
                        <button class="btn-icon-action" onclick="openEditCourseModal(${c.id})" title="Edit Program">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </button>
                        <button class="btn-icon-action delete" onclick="openDeleteCourseModal(${c.id})" title="Deactivate">
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
            grid.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #6b7280;">No degree programs match your filter criteria.</div>';
            return;
        }

        list.forEach(c => {
            const card = document.createElement('div');
            card.className = 'uni-grid-card';

            card.innerHTML = `
                <div class="card-top">
                    <span class="${getLevelClass(c.level)}">${escapeHtml(c.level)}</span>
                    <span class="status-badge ${c.active ? 'active' : 'inactive'}">
                        ${c.active ? 'Active' : 'Inactive'}
                    </span>
                </div>

                <div>
                    <div style="font-size: 14px; font-weight: 700; color: #111827; line-height: 1.4;">
                        ${escapeHtml(c.name)}
                    </div>
                    <div style="font-size: 11px; color: #f58220; font-weight: 600; margin-top: 2px;">
                        Code: ${escapeHtml(c.code)}
                    </div>
                </div>

                <div class="country-pill">
                    <img src="${c.flag}" alt="${c.country}" class="country-flag-icon" onerror="this.style.display='none'">
                    <div>
                        <div style="font-weight: 600; color: #172033; font-size: 12px;">${escapeHtml(c.university)}</div>
                        <div style="font-size: 10px; color: #8a93a3;">${escapeHtml(c.country)}</div>
                    </div>
                </div>

                <div class="card-metric-grid">
                    <div>
                        <div class="card-metric-label">Tuition</div>
                        <div class="card-metric-val">${escapeHtml(c.tuition)}</div>
                    </div>
                    <div>
                        <div class="card-metric-label">Duration</div>
                        <div class="card-metric-val">${escapeHtml(c.duration)}</div>
                    </div>
                    <div>
                        <div class="card-metric-label">Study Mode</div>
                        <div class="card-metric-val">${escapeHtml(c.mode)}</div>
                    </div>
                    <div>
                        <div class="card-metric-label">Credits</div>
                        <div class="card-metric-val">${escapeHtml(c.credits || 'N/A')}</div>
                    </div>
                </div>

                <div style="font-size: 11px; color: #6b7280; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    ${escapeHtml(c.description || 'Comprehensive curriculum with hands-on research and global employment pathways.')}
                </div>

                <div class="card-actions">
                    <button class="btn-view-courses" onclick="viewCourseDetails(${c.id})" style="margin-right: auto;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        Requirements
                    </button>
                    <button class="btn-icon-action" onclick="openEditCourseModal(${c.id})" title="Edit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </button>
                    <button class="btn-icon-action delete" onclick="openDeleteCourseModal(${c.id})" title="Deactivate">
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
            info.textContent = 'Showing 0 to 0 of 0 programs';
            controls.innerHTML = '';
            return;
        }

        info.textContent = `Showing ${startIdx + 1} to ${endIdx} of ${total} programs`;

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
        renderCourses();
    }

    function changePerPage(val) {
        perPage = val;
        currentPage = 1;
        renderCourses();
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
        renderCourses();
    }

    // Reset Filters
    function resetFilters() {
        document.getElementById('courseSearchInput').value = '';
        document.getElementById('topbarSearchInput').value = '';
        document.getElementById('levelFilter').value = 'ALL';
        document.getElementById('universityFilter').value = 'ALL';
        document.getElementById('modeFilter').value = 'ALL';
        document.getElementById('statusFilter').value = 'ALL';
        currentPage = 1;
        renderCourses();
    }

    // Modal Control Helpers
    function openModal(id) {
        document.getElementById(id).classList.add('open');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    // Open Add Course Modal
    function openAddCourseModal() {
        document.getElementById('addEditModalTitle').textContent = 'Add New Degree Program';
        document.getElementById('courseIdField').value = '';
        document.getElementById('courseForm').reset();
        document.getElementById('courseActiveCheckbox').checked = true;
        document.getElementById('courseCountryInput').value = '';
        openModal('addEditCourseModal');
    }

    // Open Edit Course Modal
    function openEditCourseModal(id) {
        const c = coursesData.find(item => item.id === id);
        if (!c) return;

        document.getElementById('addEditModalTitle').textContent = 'Edit Degree Program';
        document.getElementById('courseIdField').value = c.id;
        document.getElementById('courseCodeInput').value = c.code || '';
        document.getElementById('courseNameInput').value = c.name || '';
        document.getElementById('courseUniversitySelect').value = c.university || '';
        document.getElementById('courseCountryInput').value = c.country || '';
        document.getElementById('courseLevelSelect').value = c.level || 'Bachelor';
        document.getElementById('courseFieldInput').value = c.field || '';
        document.getElementById('courseModeSelect').value = c.mode || 'On Campus';
        document.getElementById('courseDurationInput').value = c.duration || '';
        document.getElementById('courseTuitionInput').value = c.tuition || '';
        document.getElementById('courseCreditsInput').value = c.credits || '';
        document.getElementById('courseIntakesInput').value = c.intakes || '';
        document.getElementById('courseMinGpaInput').value = c.minGpa || '';
        document.getElementById('courseEnglishReqInput').value = c.englishReq || '';
        document.getElementById('coursePrereqInput').value = c.prerequisites || '';
        document.getElementById('courseDescInput').value = c.description || '';
        document.getElementById('courseActiveCheckbox').checked = !!c.active;

        openModal('addEditCourseModal');
    }

    // Handle Save (Add or Update)
    function handleSaveCourse(e) {
        e.preventDefault();

        const idVal = document.getElementById('courseIdField').value;
        const code = document.getElementById('courseCodeInput').value.trim();
        const name = document.getElementById('courseNameInput').value.trim();
        const uni = document.getElementById('courseUniversitySelect').value;
        const country = document.getElementById('courseCountryInput').value;
        const level = document.getElementById('courseLevelSelect').value;
        const field = document.getElementById('courseFieldInput').value.trim();
        const mode = document.getElementById('courseModeSelect').value;
        const duration = document.getElementById('courseDurationInput').value.trim();
        const tuition = document.getElementById('courseTuitionInput').value.trim();
        const credits = document.getElementById('courseCreditsInput').value.trim();
        const intakes = document.getElementById('courseIntakesInput').value.trim();
        const minGpa = document.getElementById('courseMinGpaInput').value.trim();
        const englishReq = document.getElementById('courseEnglishReqInput').value.trim();
        const prerequisites = document.getElementById('coursePrereqInput').value.trim();
        const description = document.getElementById('courseDescInput').value.trim();
        const active = document.getElementById('courseActiveCheckbox').checked;

        const uniObj = universityDirectory.find(u => u.name === uni);
        const flag = uniObj ? uniObj.flag : 'https://flagcdn.com/w40/un.png';

        if (idVal) {
            // Edit existing
            const idx = coursesData.findIndex(c => c.id === parseInt(idVal, 10));
            if (idx !== -1) {
                coursesData[idx] = {
                    ...coursesData[idx],
                    code,
                    name,
                    university: uni,
                    country,
                    flag,
                    level,
                    field,
                    mode,
                    duration,
                    tuition,
                    credits,
                    intakes,
                    minGpa,
                    englishReq,
                    prerequisites,
                    description,
                    active
                };
                showToast('Degree program updated successfully!');
            }
        } else {
            // Create new
            const newId = coursesData.length > 0 ? Math.max(...coursesData.map(c => c.id)) + 1 : 1;
            const newCourse = {
                id: newId,
                code,
                name,
                university: uni,
                country,
                flag,
                level,
                field,
                mode,
                duration,
                tuition,
                credits,
                intakes,
                minGpa,
                englishReq,
                prerequisites,
                description,
                active
            };
            coursesData.unshift(newCourse);
            showToast('New degree program created successfully!');
        }

        closeModal('addEditCourseModal');
        renderCourses();
    }

    // View Requirements & Details Modal
    function viewCourseDetails(id) {
        const c = coursesData.find(item => item.id === id);
        if (!c) return;

        document.getElementById('detailCourseName').textContent = c.name;
        document.getElementById('detailCourseSubtitle').textContent = c.code + ' • ' + c.university + ' (' + c.country + ')';

        const body = document.getElementById('detailModalBodyContent');
        body.innerHTML = `
            <div class="req-section">
                <div class="req-section-title">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#f58220" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="16" x2="12" y2="12"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>
                    </svg>
                    Program Overview & Specifications
                </div>
                <div class="req-grid">
                    <div class="req-item">
                        <strong>Degree Level</strong>
                        <span class="${getLevelClass(c.level)}">${escapeHtml(c.level)}</span>
                    </div>
                    <div class="req-item">
                        <strong>Field of Study</strong>
                        <span>${escapeHtml(c.field)}</span>
                    </div>
                    <div class="req-item">
                        <strong>Annual Tuition Fee</strong>
                        <span style="color: #059669; font-weight: 700;">${escapeHtml(c.tuition)}</span>
                    </div>
                    <div class="req-item">
                        <strong>Duration & Mode</strong>
                        <span>${escapeHtml(c.duration)} (${escapeHtml(c.mode)})</span>
                    </div>
                    <div class="req-item">
                        <strong>Total Credits</strong>
                        <span>${escapeHtml(c.credits || 'Not specified')}</span>
                    </div>
                    <div class="req-item">
                        <strong>Semester Intakes</strong>
                        <span>${escapeHtml(c.intakes || 'September, January')}</span>
                    </div>
                </div>
            </div>

            <div class="req-section">
                <div class="req-section-title">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                    Academic & English Entry Requirements
                </div>
                <div class="req-grid">
                    <div class="req-item" style="grid-column: 1 / -1;">
                        <strong>Minimum GPA / Grade Requirement</strong>
                        <span style="font-size: 13px; font-weight: 600; color: #111827;">${escapeHtml(c.minGpa || '3.0 / 4.0 (75%) or equivalent')}</span>
                    </div>
                    <div class="req-item" style="grid-column: 1 / -1;">
                        <strong>English Language Proficiency</strong>
                        <span>${escapeHtml(c.englishReq || 'IELTS 6.5 (min 6.0 in bands) / TOEFL iBT 90+')}</span>
                    </div>
                    <div class="req-item" style="grid-column: 1 / -1;">
                        <strong>Prerequisites & Prior Qualifications</strong>
                        <span>${escapeHtml(c.prerequisites || 'Recognized high school certificate or undergraduate degree in aligned discipline.')}</span>
                    </div>
                </div>
            </div>

            <div class="req-section">
                <div class="req-section-title">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                    Curriculum & Career Outlook
                </div>
                <p style="font-size: 12px; color: #4b5565; line-height: 1.6;">
                    ${escapeHtml(c.description || 'Comprehensive curriculum preparing students for global industry certifications, advanced research fellowships, and high-impact international career trajectories.')}
                </p>
            </div>
        `;

        document.getElementById('detailEditBtn').onclick = function() {
            closeModal('courseDetailsModal');
            openEditCourseModal(c.id);
        };

        openModal('courseDetailsModal');
    }

    // Delete / Deactivate Course Modal
    function openDeleteCourseModal(id) {
        const c = coursesData.find(item => item.id === id);
        if (!c) return;

        deletingCourseId = id;
        document.getElementById('deleteCourseName').textContent = c.name + ' (' + c.code + ')';

        document.getElementById('confirmDeleteBtn').onclick = function() {
            coursesData = coursesData.filter(item => item.id !== deletingCourseId);
            selectedCourseIds.delete(deletingCourseId);
            closeModal('deleteCourseModal');
            showToast('Course program deactivated and removed from active listings.');
            renderCourses();
        };

        openModal('deleteCourseModal');
    }

    // Checkbox selections
    function toggleSelectAll(masterCheckbox) {
        const isChecked = masterCheckbox.checked;
        const visible = getFilteredCourses();
        visible.forEach(c => {
            if (isChecked) selectedCourseIds.add(c.id);
            else selectedCourseIds.delete(c.id);
        });
        renderCourses();
    }

    function toggleSelectRow(id, isChecked) {
        if (isChecked) selectedCourseIds.add(id);
        else selectedCourseIds.delete(id);
        renderCourses();
    }

    // Export CSV
    function exportCoursesCSV() {
        const list = getFilteredCourses();
        if (list.length === 0) {
            showToast('No course data available to export.');
            return;
        }

        const headers = ["ID", "Code", "Course Name", "University", "Country", "Level", "Field", "Duration", "Study Mode", "Tuition", "Intakes", "Min GPA", "Status"];
        const rows = list.map(c => [
            c.id,
            '"' + (c.code || '').replace(/"/g, '""') + '"',
            '"' + (c.name || '').replace(/"/g, '""') + '"',
            '"' + (c.university || '').replace(/"/g, '""') + '"',
            '"' + (c.country || '').replace(/"/g, '""') + '"',
            '"' + (c.level || '').replace(/"/g, '""') + '"',
            '"' + (c.field || '').replace(/"/g, '""') + '"',
            '"' + (c.duration || '').replace(/"/g, '""') + '"',
            '"' + (c.mode || '').replace(/"/g, '""') + '"',
            '"' + (c.tuition || '').replace(/"/g, '""') + '"',
            '"' + (c.intakes || '').replace(/"/g, '""') + '"',
            '"' + (c.minGpa || '').replace(/"/g, '""') + '"',
            c.active ? 'Active' : 'Inactive'
        ]);

        const csvContent = "data:text/csv;charset=utf-8," + [headers.join(','), ...rows.map(r => r.join(','))].join('\n');
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "indic_rmc_courses_" + new Date().toISOString().slice(0, 10) + ".csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        showToast('Exported ' + list.length + ' courses to CSV!');
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

    // XSS sanitization helper
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
