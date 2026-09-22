<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDIC RMC | Consultant Management</title>

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
           SIDEBAR (Canonical Shell)
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
            z-index: 100;
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
            z-index: 90;
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
           CONTENT
        ===================================================== */
        .content {
            padding: 28px 30px 40px;
            flex: 1;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 23px;
            font-weight: 700;
            color: #111827;
            letter-spacing: -.4px;
        }

        .page-subtitle {
            margin-top: 5px;
            font-size: 12px;
            color: #737d8e;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-primary {
            background: #f97316;
            color: #ffffff;
            border: none;
            height: 40px;
            padding: 0 18px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background .2s ease;
            box-shadow: 0 1px 2px rgba(249, 115, 22, 0.2);
        }

        .btn-primary:hover {
            background: #e07116;
        }

        .btn-outline {
            background: #ffffff;
            color: #344054;
            border: 1px solid #d0d5dd;
            height: 40px;
            padding: 0 16px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .2s;
        }

        .btn-outline:hover {
            background: #f9fafb;
            border-color: #98a2b3;
        }

        /* =====================================================
           KPI STATS GRID
        ===================================================== */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 24px;
        }

        .kpi-card {
            background: #ffffff;
            border: 1px solid #e4e7ec;
            border-radius: 10px;
            padding: 18px;
            transition: transform .15s, box-shadow .15s;
        }

        .kpi-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            transform: translateY(-1px);
        }

        .kpi-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .kpi-title {
            color: #737d8e;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .kpi-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kpi-icon.orange {
            background: #fff3e9;
            color: #f97316;
        }

        .kpi-icon.green {
            background: #eefdf3;
            color: #16a34a;
        }

        .kpi-icon.blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .kpi-icon.purple {
            background: #faf5ff;
            color: #9333ea;
        }

        .kpi-value {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin: 10px 0 4px;
            letter-spacing: -.5px;
        }

        .kpi-footer {
            font-size: 11px;
            color: #8a93a3;
        }

        .kpi-footer .stat-highlight {
            color: #16a34a;
            font-weight: 600;
        }

        /* =====================================================
           CONTROLS & FILTERS BAR
        ===================================================== */
        .controls-card {
            background: #ffffff;
            border: 1px solid #e7e9ed;
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            flex: 1;
        }

        .filter-search {
            position: relative;
            min-width: 250px;
            flex: 1;
        }

        .filter-search input {
            width: 100%;
            height: 38px;
            border: 1px solid #d0d5dd;
            border-radius: 7px;
            padding: 0 12px 0 34px;
            font-size: 12px;
            outline: none;
            background: #fafbfc;
            transition: all .2s;
        }

        .filter-search input:focus {
            border-color: #f97316;
            background: #ffffff;
        }

        .filter-search svg {
            position: absolute;
            left: 10px;
            top: 11px;
            width: 15px;
            height: 15px;
            color: #98a2b3;
        }

        .filter-select {
            height: 38px;
            border: 1px solid #d0d5dd;
            border-radius: 7px;
            padding: 0 12px;
            font-size: 12px;
            color: #344054;
            background: #fafbfc;
            outline: none;
            cursor: pointer;
        }

        .filter-select:focus {
            border-color: #f97316;
            background: #ffffff;
        }

        .view-switcher {
            display: flex;
            align-items: center;
            gap: 4px;
            background: #f4f5f7;
            padding: 3px;
            border-radius: 7px;
        }

        .view-btn {
            border: none;
            background: transparent;
            width: 32px;
            height: 32px;
            border-radius: 5px;
            color: #697386;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .15s;
        }

        .view-btn.active {
            background: #ffffff;
            color: #f97316;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        /* =====================================================
           TABLE CONTAINER & STYLES
        ===================================================== */
        .table-container {
            background: #ffffff;
            border: 1px solid #e7e9ed;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        table.data-table th {
            background: #fafbfc;
            padding: 13px 16px;
            border-bottom: 1px solid #e7e9ed;
            color: #697386;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 600;
            user-select: none;
        }

        table.data-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f1f3;
            font-size: 12px;
            color: #4b5565;
            vertical-align: middle;
        }

        table.data-table tr:hover td {
            background: #fcfdfe;
        }

        .consultant-identity {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .consultant-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff3e9;
            color: #f97316;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            flex-shrink: 0;
            border: 1px solid #fed7aa;
        }

        .consultant-name {
            font-weight: 600;
            color: #172033;
            font-size: 13px;
        }

        .consultant-code {
            font-size: 11px;
            color: #8a93a3;
            margin-top: 2px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .code-tag {
            background: #f1f5f9;
            color: #475569;
            padding: 1px 6px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 10px;
        }

        .specialization-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #dbeafe;
        }

        .specialization-pill.usa {
            background: #fef2f2;
            color: #b91c1c;
            border-color: #fee2e2;
        }

        .specialization-pill.australia {
            background: #ecfdf5;
            color: #047857;
            border-color: #d1fae5;
        }

        .specialization-pill.canada {
            background: #fff7ed;
            color: #c2410c;
            border-color: #ffedd5;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-badge.active {
            background: #dcfce7;
            color: #15803d;
        }

        .status-badge.inactive {
            background: #f1f5f9;
            color: #64748b;
        }

        .status-badge.on_leave {
            background: #fef3c7;
            color: #b45309;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-badge.active .status-dot {
            background: #16a34a;
        }

        .status-badge.inactive .status-dot {
            background: #94a3b8;
        }

        .status-badge.on_leave .status-dot {
            background: #d97706;
        }

        .load-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .load-bar-wrap {
            width: 70px;
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }

        .load-bar {
            height: 100%;
            border-radius: 3px;
            background: #16a34a;
        }

        .load-bar.warning {
            background: #f97316;
        }

        .load-bar.danger {
            background: #dc2626;
        }

        .load-count {
            font-size: 11px;
            font-weight: 600;
            color: #334155;
        }

        .actions-cell {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        .action-icon-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .15s ease;
        }

        .action-icon-btn:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: #1e293b;
        }

        .action-icon-btn.btn-assign:hover {
            border-color: #f97316;
            color: #f97316;
            background: #fff8f1;
        }

        .action-icon-btn.btn-delete:hover {
            border-color: #fee2e2;
            color: #dc2626;
            background: #fef2f2;
        }

        /* =====================================================
           CARD / GRID VIEW
        ===================================================== */
        .cards-grid {
            display: none;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .consultant-card {
            background: #ffffff;
            border: 1px solid #e4e7ec;
            border-radius: 10px;
            padding: 20px;
            transition: all .2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            position: relative;
        }

        .consultant-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 6px 16px rgba(0,0,0,0.06);
            transform: translateY(-2px);
        }

        .card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .card-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #fff3e9;
            color: #f97316;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
            border: 2px solid #fed7aa;
        }

        .card-meta-list {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 12px;
            color: #64748b;
        }

        .card-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-meta-item svg {
            width: 14px;
            height: 14px;
            color: #94a3b8;
            flex-shrink: 0;
        }

        .card-stats-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: 14px 0;
            background: #fafbfc;
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #edf0f3;
        }

        .stat-box {
            text-align: center;
        }

        .stat-box-val {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
        }

        .stat-box-lbl {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-top: 2px;
        }

        .card-footer-actions {
            display: flex;
            gap: 8px;
            margin-top: 14px;
        }

        .card-footer-actions .btn-card-action {
            flex: 1;
            height: 34px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #334155;
            transition: all .15s;
        }

        .card-footer-actions .btn-card-action:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .card-footer-actions .btn-card-primary {
            background: #fff3e9;
            color: #ea580c;
            border-color: #fed7aa;
        }

        .card-footer-actions .btn-card-primary:hover {
            background: #f97316;
            color: #ffffff;
            border-color: #f97316;
        }

        /* =====================================================
           MODAL STYLES
        ===================================================== */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-box {
            background: #ffffff;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
            animation: modalFadeIn .2s ease-out;
        }

        .modal-box.wide {
            max-width: 740px;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.96) translateY(8px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
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
            color: #111827;
        }

        .modal-close-btn {
            background: transparent;
            border: none;
            color: #8c96a8;
            cursor: pointer;
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
            margin-bottom: 14px;
        }

        .form-group.full {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #344054;
            margin-bottom: 6px;
        }

        .form-input, .form-select-modal, .form-textarea {
            width: 100%;
            height: 38px;
            border: 1px solid #d0d5dd;
            border-radius: 7px;
            padding: 0 12px;
            font-size: 12px;
            color: #172033;
            outline: none;
            transition: border-color .15s;
            font-family: inherit;
        }

        .form-textarea {
            height: 76px;
            padding: 8px 12px;
            resize: vertical;
        }

        .form-input:focus, .form-select-modal:focus, .form-textarea:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        /* Schedule table in details modal */
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        }

        .schedule-table th {
            background: #f8fafc;
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            color: #475569;
            font-weight: 600;
            text-align: left;
        }

        .schedule-table td {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            color: #334155;
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
            font-size: 13px;
            font-weight: 500;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 2000;
            opacity: 0;
            transform: translateY(10px);
            transition: all .2s ease;
            pointer-events: none;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        .toast-icon {
            color: #10b981;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */
        @media (max-width: 1150px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }
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
                width: calc(100% - 70px);
            }
            .content {
                padding: 16px;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group.full {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>

<div class="app">

    <!-- =====================================================
         SIDEBAR (Canonical Shell)
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

            <a href="{{ route('admin.consultants') }}" class="menu-item active">
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

        <!-- CONTENT BODY -->
        <div class="content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Consultant Management & Assignments</h1>
                    <p class="page-subtitle">Oversee certified education advisors, student case assignments, active caseloads, and consulting schedules.</p>
                </div>

                <div class="header-actions">
                    <button class="btn-outline" id="btnExportConsultants">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Export CSV
                    </button>

                    <button class="btn-primary" id="btnOpenAddConsultant">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Add Consultant
                    </button>
                </div>
            </div>

            <!-- KPI STATS -->
            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">Total Consultants</span>
                        <div class="kpi-icon orange">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="7" r="4"/>
                                <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                            </svg>
                        </div>
                    </div>
                    <div class="kpi-value" id="kpiTotalConsultants">8</div>
                    <div class="kpi-footer"><span class="stat-highlight">100%</span> onboarded & certified</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">Active & Available</span>
                        <div class="kpi-icon green">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                        </div>
                    </div>
                    <div class="kpi-value" id="kpiActiveConsultants">6</div>
                    <div class="kpi-footer">2 on planned leave or training</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">Active Student Cases</span>
                        <div class="kpi-icon blue">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                    </div>
                    <div class="kpi-value" id="kpiTotalAssigned">64</div>
                    <div class="kpi-footer">Avg <span class="stat-highlight">8.0</span> students / advisor</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">Avg Success Rating</span>
                        <div class="kpi-icon purple">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                    </div>
                    <div class="kpi-value" id="kpiAvgRating">4.9 / 5.0</div>
                    <div class="kpi-footer">Based on 312 student reviews</div>
                </div>
            </div>

            <!-- CONTROLS & FILTER BAR -->
            <div class="controls-card">
                <div class="filter-group">
                    <div class="filter-search">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7"/>
                            <path d="m20 20-4-4"/>
                        </svg>
                        <input type="text" id="consultantSearchInput" placeholder="Search by name, employee ID, email, destination...">
                    </div>

                    <select class="filter-select" id="filterStatus">
                        <option value="all">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="on_leave">On Leave</option>
                        <option value="inactive">Inactive</option>
                    </select>

                    <select class="filter-select" id="filterSpecialization">
                        <option value="all">All Destinations / Specializations</option>
                        <option value="UK & Europe">UK & Europe</option>
                        <option value="USA & Canada">USA & Canada</option>
                        <option value="Australia & New Zealand">Australia & New Zealand</option>
                        <option value="Medicine & STEM">Medicine & STEM</option>
                        <option value="Visa & Compliance">Visa & Compliance</option>
                    </select>
                </div>

                <div class="view-switcher">
                    <button class="view-btn active" id="btnTableView" title="Table View">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="8" y1="6" x2="21" y2="6"/>
                            <line x1="8" y1="12" x2="21" y2="12"/>
                            <line x1="8" y1="18" x2="21" y2="18"/>
                            <line x1="3" y1="6" x2="3.01" y2="6"/>
                            <line x1="3" y1="12" x2="3.01" y2="12"/>
                            <line x1="3" y1="18" x2="3.01" y2="18"/>
                        </svg>
                    </button>
                    <button class="view-btn" id="btnCardView" title="Card View">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7"/>
                            <rect x="14" y="3" width="7" height="7"/>
                            <rect x="14" y="14" width="7" height="7"/>
                            <rect x="3" y="14" width="7" height="7"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- TABLE VIEW -->
            <div class="table-container" id="consultantsTableWrap">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Consultant Advisor</th>
                                <th>Specialization</th>
                                <th>Experience</th>
                                <th>Caseload / Students</th>
                                <th>Status</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="consultantsTableBody">
                            <!-- Populated dynamically via JS -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CARD VIEW -->
            <div class="cards-grid" id="consultantsCardsGrid">
                <!-- Populated dynamically via JS -->
            </div>

        </div>
    </main>

</div>

<!-- =====================================================
     MODAL: ADD / EDIT CONSULTANT
====================================================== -->
<div class="modal-backdrop" id="modalConsultantBackdrop">
    <div class="modal-box wide">
        <div class="modal-header">
            <h3 class="modal-title" id="modalConsultantTitle">Add New Consultant</h3>
            <button class="modal-close-btn" id="btnCloseConsultantModal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form id="formConsultant">
            <div class="modal-body">
                <input type="hidden" id="editConsultantId" value="">

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" class="form-input" id="cFullName" required placeholder="e.g. Dr. Eleanor Vance">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Employee Code *</label>
                        <input type="text" class="form-input" id="cEmpCode" required placeholder="e.g. RMC-CON-001">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" class="form-input" id="cEmail" required placeholder="e.g. eleanor.vance@indicrmc.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone Number *</label>
                        <input type="text" class="form-input" id="cPhone" required placeholder="e.g. +91 98450 12345">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Primary Destination / Specialization *</label>
                        <select class="form-select-modal" id="cSpecialization" required>
                            <option value="UK & Europe">UK & Europe</option>
                            <option value="USA & Canada">USA & Canada</option>
                            <option value="Australia & New Zealand">Australia & New Zealand</option>
                            <option value="Medicine & STEM">Medicine & STEM</option>
                            <option value="Visa & Compliance">Visa & Compliance</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Years of Experience *</label>
                        <input type="number" class="form-input" id="cExperience" min="1" max="40" required value="5">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Availability Status *</label>
                        <select class="form-select-modal" id="cStatus" required>
                            <option value="active">Active & Available</option>
                            <option value="on_leave">On Leave / Away</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Maximum Caseload Capacity</label>
                        <input type="number" class="form-input" id="cMaxCapacity" min="5" max="30" value="15">
                    </div>

                    <div class="form-group full">
                        <label class="form-label">Consultant Professional Bio & Credentials</label>
                        <textarea class="form-textarea" id="cBio" placeholder="Provide background on certifications (e.g. British Council Certified, ICEF Trained, US Education Counselor)..."></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" id="btnCancelConsultantModal">Cancel</button>
                <button type="submit" class="btn-primary" id="btnSaveConsultant">Save Consultant</button>
            </div>
        </form>
    </div>
</div>

<!-- =====================================================
     MODAL: ASSIGN STUDENT / APPLICATION
====================================================== -->
<div class="modal-backdrop" id="modalAssignBackdrop">
    <div class="modal-box">
        <div class="modal-header">
            <h3 class="modal-title">Assign Student to Consultant</h3>
            <button class="modal-close-btn" id="btnCloseAssignModal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form id="formAssign">
            <div class="modal-body">
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px; margin-bottom: 16px;">
                    <div style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600;">Assigning to Advisor</div>
                    <div style="font-size: 14px; font-weight: 700; color: #111827; margin-top: 2px;" id="assignConsultantName">Dr. Eleanor Vance</div>
                    <div style="font-size: 12px; color: #f97316; font-weight: 500;" id="assignConsultantSpec">UK & Europe Specialist</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Select Student / Application Case *</label>
                    <select class="form-select-modal" id="assignStudentSelect" required>
                        <option value="">-- Choose unassigned student application --</option>
                        <option value="APP-1024 - Rohan Sharma (MSc Advanced Computer Science - University of Oxford)">Rohan Sharma (Oxford - MSc Comp Sci) - Pending Advisor</option>
                        <option value="APP-1028 - Aanya Patel (BSc Biomedical Sciences - University of Melbourne)">Aanya Patel (Melbourne - Biomedical) - Newly Submitted</option>
                        <option value="APP-1031 - Devendra Verma (MBA Global Leadership - Harvard Business School)">Devendra Verma (Harvard - MBA) - Needs Strategic Guidance</option>
                        <option value="APP-1035 - Sneha Kulkarni (BEng Mechanical - University of Toronto)">Sneha Kulkarni (Toronto - Mechanical) - Priority Review</option>
                        <option value="APP-1040 - Kabir Mehta (LLM International Commercial Law - LSE)">Kabir Mehta (LSE - LLM) - Visa & Offer Stage</option>
                        <option value="APP-1044 - Meera Iyer (Master of Data Science - TU Munich)">Meera Iyer (TU Munich - Data Science) - Documentation Review</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Assignment Urgency / Priority</label>
                    <select class="form-select-modal" id="assignPriority">
                        <option value="Normal">Normal Priority</option>
                        <option value="High">High Priority (Upcoming Intake Deadline)</option>
                        <option value="Urgent">Urgent (Visa Processing Critical)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Instructions & Case Notes for Consultant</label>
                    <textarea class="form-textarea" id="assignNotes" placeholder="Provide background information, student target universities, English scores, and special handling instructions..."></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" id="btnCancelAssignModal">Cancel</button>
                <button type="submit" class="btn-primary" id="btnConfirmAssign">Confirm Assignment</button>
            </div>
        </form>
    </div>
</div>

<!-- =====================================================
     MODAL: VIEW CONSULTANT PROFILE & SCHEDULE
====================================================== -->
<div class="modal-backdrop" id="modalDetailsBackdrop">
    <div class="modal-box wide">
        <div class="modal-header">
            <h3 class="modal-title">Consultant Profile & Schedule</h3>
            <button class="modal-close-btn" id="btnCloseDetailsModal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="modal-body">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                <div class="card-avatar" style="width: 56px; height: 56px; font-size: 18px;" id="detAvatar">EV</div>
                <div>
                    <h2 style="font-size: 18px; font-weight: 700; color: #111827;" id="detName">Dr. Eleanor Vance</h2>
                    <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                        <span id="detCode" class="code-tag">RMC-CON-001</span> &bull; <span id="detEmail">eleanor.vance@indicrmc.com</span> &bull; <span id="detPhone">+91 98450 12345</span>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 18px;">
                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; margin-bottom: 4px;">Professional Biography</div>
                <p style="font-size: 12px; line-height: 1.6; color: #334155;" id="detBio"></p>
            </div>

            <div style="margin-bottom: 18px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b;">Weekly Consultation Hours & Availability</div>
                    <span style="font-size: 11px; color: #16a34a; font-weight: 600;">Timezone: IST (UTC +5:30)</span>
                </div>
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Working Hours</th>
                            <th>Mode</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="detScheduleBody">
                        <tr>
                            <td><strong>Monday – Friday</strong></td>
                            <td>10:00 AM – 06:00 PM</td>
                            <td>Online Video & Physical Clinic</td>
                            <td><span class="status-badge active"><span class="status-dot"></span> Available</span></td>
                        </tr>
                        <tr>
                            <td><strong>Saturday</strong></td>
                            <td>10:00 AM – 02:00 PM</td>
                            <td>Online Follow-ups only</td>
                            <td><span class="status-badge active"><span class="status-dot"></span> Available</span></td>
                        </tr>
                        <tr>
                            <td><strong>Sunday</strong></td>
                            <td>—</td>
                            <td>Off-duty</td>
                            <td><span class="status-badge inactive"><span class="status-dot"></span> Rest Day</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; margin-bottom: 8px;">Active Assigned Students (<span id="detStudentCount">0</span>)</div>
                <div id="detStudentList" style="display: flex; flex-direction: column; gap: 8px;">
                    <!-- Dynamically populated -->
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn-primary" id="btnCloseDetailsModalBtn">Close</button>
        </div>
    </div>
</div>

<!-- =====================================================
     MODAL: DELETE / DEACTIVATE CONFIRMATION
====================================================== -->
<div class="modal-backdrop" id="modalDeleteBackdrop">
    <div class="modal-box" style="max-width: 440px;">
        <div class="modal-header">
            <h3 class="modal-title" style="color: #dc2626;">Deactivate Consultant</h3>
            <button class="modal-close-btn" id="btnCloseDeleteModal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="modal-body">
            <p style="font-size: 13px; color: #334155; line-height: 1.5;">
                Are you sure you want to deactivate consultant <strong id="deleteConsultantName"></strong>?
            </p>
            <p style="font-size: 12px; color: #64748b; margin-top: 8px;">
                Active cases (<strong id="deleteStudentCount">0</strong> students) will remain preserved and can be reassigned to other advisors.
            </p>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn-secondary" id="btnCancelDeleteModal">Cancel</button>
            <button type="button" class="btn-danger" id="btnConfirmDelete">Deactivate Consultant</button>
        </div>
    </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast">
    <svg class="toast-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
        <polyline points="22 4 12 14.01 9 11.01"/>
    </svg>
    <span id="toastMessage">Operation completed successfully.</span>
</div>

<script>
// Mock initial data matching Indic RMC study abroad schema
let consultants = [
    {
        id: 1,
        code: "RMC-CON-001",
        name: "Dr. Eleanor Vance",
        email: "eleanor.vance@indicrmc.com",
        phone: "+91 98450 12345",
        specialization: "UK & Europe",
        experience: 11,
        status: "active",
        assignedStudents: [
            { name: "Aarav Sharma", app: "MSc AI - University of Edinburgh", stage: "Conditional Offer" },
            { name: "Priya Nair", app: "BSc Business Analytics - King's College London", stage: "CAS Issued" },
            { name: "Vikram Sen", app: "MA International Relations - LSE", stage: "Application Submitted" },
            { name: "Ananya Roy", app: "MSc Finance - Warwick University", stage: "Visa In-Progress" }
        ],
        maxCapacity: 15,
        rating: 4.95,
        bio: "Senior UK and European higher education counselor with 11+ years of advisory experience. British Council Certified Specialist with proven track record in Oxbridge, Russell Group, and TU9 European university admissions."
    },
    {
        id: 2,
        code: "RMC-CON-002",
        name: "Marcus Aurelius Thorne",
        email: "marcus.thorne@indicrmc.com",
        phone: "+91 98230 45678",
        specialization: "USA & Canada",
        experience: 9,
        assignedStudents: [
            { name: "Devendra Verma", app: "MBA - Harvard Business School", stage: "Interview Prep" },
            { name: "Sneha Kulkarni", app: "BEng Mechanical - Univ of Toronto", stage: "Offer Accepted" },
            { name: "Rishabh Goel", app: "MS Computer Science - Columbia University", stage: "I-20 Form Issued" }
        ],
        maxCapacity: 12,
        status: "active",
        rating: 4.9,
        bio: "North American admissions strategist specializing in Ivy League and Tier-1 Canadian U15 institutions. Expert in GRE/GMAT score contextualization, statement of purpose refinement, and F-1/Study Permit visa guidance."
    },
    {
        id: 3,
        code: "RMC-CON-003",
        name: "Aisha Al-Mansoor",
        email: "aisha.mansoor@indicrmc.com",
        phone: "+91 98111 87654",
        specialization: "Australia & New Zealand",
        experience: 7,
        assignedStudents: [
            { name: "Aanya Patel", app: "BSc Biomedical - Univ of Melbourne", stage: "GTE Approved" },
            { name: "Kavya Menon", app: "Master of Cyber Security - Univ of Sydney", stage: "Offer Received" }
        ],
        maxCapacity: 12,
        status: "active",
        rating: 4.88,
        bio: "QEAC Certified Australian Education Agent with deep specialization in Group of Eight (Go8) universities. Expert in genuine student (GS) visa requirement criteria and PR pathway course advisory."
    },
    {
        id: 4,
        code: "RMC-CON-004",
        name: "Rajeshwar Sengupta",
        email: "rajeshwar.s@indicrmc.com",
        phone: "+91 97345 67890",
        specialization: "Medicine & STEM",
        experience: 14,
        assignedStudents: [
            { name: "Dr. Tarun Saxena", app: "MD Internal Medicine - Heidelberg University", stage: "Document Verification" },
            { name: "Zoya Siddiqui", app: "Master of Robotics - ETH Zurich", stage: "Offer Confirmed" },
            { name: "Nikhil Joshi", app: "MSc Biotechnology - Karolinska Institute", stage: "Review Phase" },
            { name: "Simran Kaur", app: "MBBS Overseas - Charles University Prague", stage: "Interview Scheduled" }
        ],
        maxCapacity: 15,
        status: "active",
        rating: 4.98,
        bio: "Lead specialist for international healthcare, clinical residency, and advanced STEM pathways. Extensive direct relations with clinical faculties and research labs across Germany, Sweden, and Switzerland."
    },
    {
        id: 5,
        code: "RMC-CON-005",
        name: "Claire Dupont",
        email: "claire.dupont@indicrmc.com",
        phone: "+91 98765 43210",
        specialization: "UK & Europe",
        experience: 6,
        assignedStudents: [
            { name: "Meera Iyer", app: "Master of Data Science - TU Munich", stage: "Preliminary Evaluation" },
            { name: "Aditya Hegde", app: "MIM - HEC Paris", stage: "SOP Review" }
        ],
        maxCapacity: 10,
        status: "on_leave",
        rating: 4.82,
        bio: "French & Benelux higher education expert. Specializes in French Grandes Écoles, business schools (INSEAD/HEC), and low-tuition public university programs across Central Europe."
    },
    {
        id: 6,
        code: "RMC-CON-006",
        name: "Vikram Malhotra",
        email: "vikram.m@indicrmc.com",
        phone: "+91 99887 11223",
        specialization: "Visa & Compliance",
        experience: 12,
        assignedStudents: [
            { name: "Kabir Mehta", app: "LLM Law - LSE", stage: "Visa File Submission" },
            { name: "Ishaan Reddy", app: "MS Electrical - Purdue University", stage: "Mock Visa Interview" },
            { name: "Tanvi Deshmukh", app: "BBA - University of British Columbia", stage: "Financial Proof Audit" }
        ],
        maxCapacity: 18,
        status: "active",
        rating: 4.96,
        bio: "Senior Immigration & Visa Compliance Counsel. Former consular liaison with 10,000+ approved student visas across UK (Tier 4/Student), USA (F-1/J-1), Canada (SDS), and Australia (Subclass 500)."
    },
    {
        id: 7,
        code: "RMC-CON-007",
        name: "Samantha Brooks",
        email: "samantha.brooks@indicrmc.com",
        phone: "+91 98440 33445",
        specialization: "USA & Canada",
        experience: 8,
        assignedStudents: [
            { name: "Varun Bajaj", app: "Master of Public Policy - UC Berkeley", stage: "Waitlist Advisory" }
        ],
        maxCapacity: 12,
        status: "active",
        rating: 4.85,
        bio: "US State Department EducationUSA alumnus counselor. Specializes in liberal arts colleges, research fellowship scholarships, and financial aid grants for Indian undergraduate applicants."
    },
    {
        id: 8,
        code: "RMC-CON-008",
        name: "Hassan Farooq",
        email: "hassan.farooq@indicrmc.com",
        phone: "+91 97123 99887",
        specialization: "Australia & New Zealand",
        experience: 5,
        assignedStudents: [],
        maxCapacity: 10,
        status: "inactive",
        rating: 4.75,
        bio: "Specialist counselor for New Zealand universities and regional Australian institutions with scholarship access programs."
    }
];

let currentDeleteId = null;
let currentAssignId = null;

// DOM Elements
const consultantsTableBody = document.getElementById('consultantsTableBody');
const consultantsCardsGrid = document.getElementById('consultantsCardsGrid');
const searchInput = document.getElementById('consultantSearchInput');
const topbarSearch = document.getElementById('topbarSearchInput');
const filterStatus = document.getElementById('filterStatus');
const filterSpecialization = document.getElementById('filterSpecialization');
const btnTableView = document.getElementById('btnTableView');
const btnCardView = document.getElementById('btnCardView');
const tableWrap = document.getElementById('consultantsTableWrap');

// KPI elements
const kpiTotal = document.getElementById('kpiTotalConsultants');
const kpiActive = document.getElementById('kpiActiveConsultants');
const kpiAssigned = document.getElementById('kpiTotalAssigned');
const navBadge = document.getElementById('navConsultantCountBadge');

// Toast helper
function showToast(msg) {
    const toast = document.getElementById('toast');
    document.getElementById('toastMessage').innerText = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3500);
}

// Update KPI Stats
function updateKPIs() {
    const total = consultants.length;
    const active = consultants.filter(c => c.status === 'active').length;
    const totalStudents = consultants.reduce((sum, c) => sum + (c.assignedStudents ? c.assignedStudents.length : 0), 0);

    kpiTotal.innerText = total;
    kpiActive.innerText = active;
    kpiAssigned.innerText = totalStudents;
    if (navBadge) navBadge.innerText = total;
}

// Get initials
function getInitials(name) {
    const parts = name.replace(/^Dr.s+/i, '').split(' ');
    if (parts.length >= 2) {
        return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
    }
    return name.slice(0, 2).toUpperCase();
}

// Render Table Row
function renderTableRow(c) {
    const initials = getInitials(c.name);
    const studentCount = c.assignedStudents ? c.assignedStudents.length : 0;
    const maxCap = c.maxCapacity || 15;
    const percent = Math.min(100, Math.round((studentCount / maxCap) * 100));
    
    let loadClass = '';
    if (percent > 85) loadClass = 'danger';
    else if (percent > 65) loadClass = 'warning';

    let specClass = '';
    if (c.specialization.includes('USA')) specClass = 'usa';
    else if (c.specialization.includes('Australia')) specClass = 'australia';
    else if (c.specialization.includes('Canada')) specClass = 'canada';

    const statusMap = {
        active: { label: 'Active', cls: 'active' },
        on_leave: { label: 'On Leave', cls: 'on_leave' },
        inactive: { label: 'Inactive', cls: 'inactive' }
    };
    const s = statusMap[c.status] || { label: c.status, cls: 'inactive' };

    return `
    <tr data-id="${c.id}">
        <td>
            <div class="consultant-identity">
                <div class="consultant-avatar">${initials}</div>
                <div>
                    <div class="consultant-name">${c.name}</div>
                    <div class="consultant-code">
                        <span class="code-tag">${c.code}</span>
                        <span>${c.email}</span>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <span class="specialization-pill ${specClass}">${c.specialization}</span>
        </td>
        <td>
            <strong style="color: #172033;">${c.experience} yrs</strong>
            <div style="font-size: 11px; color: #8a93a3;">Advisory Track</div>
        </td>
        <td>
            <div class="load-indicator">
                <div class="load-bar-wrap" title="${studentCount} of ${maxCap} max cases (${percent}%)">
                    <div class="load-bar ${loadClass}" style="width: ${percent}%;"></div>
                </div>
                <span class="load-count">${studentCount} / ${maxCap}</span>
            </div>
        </td>
        <td>
            <span class="status-badge ${s.cls}">
                <span class="status-dot"></span>
                ${s.label}
            </span>
        </td>
        <td>
            <div class="actions-cell">
                <button class="action-icon-btn btn-assign" onclick="openAssignModal(${c.id})" title="Assign Student Case">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="19" y2="14"/>
                        <line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                </button>
                <button class="action-icon-btn" onclick="openDetailsModal(${c.id})" title="View Profile & Schedule">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="16" x2="12" y2="12"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>
                    </svg>
                </button>
                <button class="action-icon-btn" onclick="openEditModal(${c.id})" title="Edit Consultant">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </button>
                <button class="action-icon-btn btn-delete" onclick="openDeleteModal(${c.id})" title="Deactivate">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    </svg>
                </button>
            </div>
        </td>
    </tr>
    `;
}

// Render Card View
function renderCard(c) {
    const initials = getInitials(c.name);
    const studentCount = c.assignedStudents ? c.assignedStudents.length : 0;
    const maxCap = c.maxCapacity || 15;

    const statusMap = {
        active: { label: 'Active', cls: 'active' },
        on_leave: { label: 'On Leave', cls: 'on_leave' },
        inactive: { label: 'Inactive', cls: 'inactive' }
    };
    const s = statusMap[c.status] || { label: c.status, cls: 'inactive' };

    return `
    <div class="consultant-card" data-id="${c.id}">
        <div class="card-top">
            <div class="card-profile">
                <div class="card-avatar">${initials}</div>
                <div>
                    <div style="font-weight: 700; font-size: 14px; color: #111827;">${c.name}</div>
                    <div style="font-size: 11px; color: #64748b; margin-top: 1px;">
                        <span class="code-tag">${c.code}</span>
                    </div>
                </div>
            </div>
            <span class="status-badge ${s.cls}">
                <span class="status-dot"></span>
                ${s.label}
            </span>
        </div>

        <div style="margin: 8px 0;">
            <span class="specialization-pill">${c.specialization}</span>
        </div>

        <div class="card-stats-row">
            <div class="stat-box">
                <div class="stat-box-val">${c.experience} yrs</div>
                <div class="stat-box-lbl">Experience</div>
            </div>
            <div class="stat-box">
                <div class="stat-box-val">${studentCount} / ${maxCap}</div>
                <div class="stat-box-lbl">Active Cases</div>
            </div>
        </div>

        <div class="card-meta-list">
            <div class="card-meta-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                <span>${c.email}</span>
            </div>
            <div class="card-meta-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                <span>${c.phone}</span>
            </div>
        </div>

        <div class="card-footer-actions">
            <button class="btn-card-action btn-card-primary" onclick="openAssignModal(${c.id})">
                Assign Case
            </button>
            <button class="btn-card-action" onclick="openDetailsModal(${c.id})">
                Details
            </button>
            <button class="btn-card-action" onclick="openEditModal(${c.id})">
                Edit
            </button>
        </div>
    </div>
    `;
}

// Render Master
function renderConsultants() {
    const q = (searchInput.value || '').trim().toLowerCase();
    const st = filterStatus.value;
    const sp = filterSpecialization.value;

    const filtered = consultants.filter(c => {
        const matchesQuery = !q || 
            c.name.toLowerCase().includes(q) ||
            c.code.toLowerCase().includes(q) ||
            c.email.toLowerCase().includes(q) ||
            c.specialization.toLowerCase().includes(q);

        const matchesStatus = st === 'all' || c.status === st;
        const matchesSpec = sp === 'all' || c.specialization === sp;

        return matchesQuery && matchesStatus && matchesSpec;
    });

    if (filtered.length === 0) {
        consultantsTableBody.innerHTML = `
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: #8c96a8;">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 10px; display: block; color: #cbd5e1;">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                    </svg>
                    No consultants matched your search filters.
                </td>
            </tr>
        `;
        consultantsCardsGrid.innerHTML = `
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #8c96a8; background: #ffffff; border-radius: 10px; border: 1px dashed #cbd5e1;">
                No consultants found.
            </div>
        `;
        return;
    }

    consultantsTableBody.innerHTML = filtered.map(renderTableRow).join('');
    consultantsCardsGrid.innerHTML = filtered.map(renderCard).join('');
    updateKPIs();
}

// View Switching
btnTableView.addEventListener('click', () => {
    btnTableView.classList.add('active');
    btnCardView.classList.remove('active');
    tableWrap.style.display = 'block';
    consultantsCardsGrid.style.display = 'none';
});

btnCardView.addEventListener('click', () => {
    btnCardView.classList.add('active');
    btnTableView.classList.remove('active');
    tableWrap.style.display = 'none';
    consultantsCardsGrid.style.display = 'grid';
});

// Event Listeners for Filters
searchInput.addEventListener('input', renderConsultants);
if (topbarSearch) {
    topbarSearch.addEventListener('input', (e) => {
        searchInput.value = e.target.value;
        renderConsultants();
    });
}
filterStatus.addEventListener('change', renderConsultants);
filterSpecialization.addEventListener('change', renderConsultants);

// Modal Controls - Add / Edit
const modalConsultantBackdrop = document.getElementById('modalConsultantBackdrop');
const formConsultant = document.getElementById('formConsultant');

document.getElementById('btnOpenAddConsultant').addEventListener('click', () => {
    document.getElementById('modalConsultantTitle').innerText = 'Add New Consultant';
    document.getElementById('editConsultantId').value = '';
    formConsultant.reset();
    document.getElementById('cEmpCode').value = 'RMC-CON-00' + (consultants.length + 1);
    modalConsultantBackdrop.style.display = 'flex';
});

document.getElementById('btnCloseConsultantModal').addEventListener('click', () => {
    modalConsultantBackdrop.style.display = 'none';
});
document.getElementById('btnCancelConsultantModal').addEventListener('click', () => {
    modalConsultantBackdrop.style.display = 'none';
});

window.openEditModal = function(id) {
    const c = consultants.find(item => item.id === id);
    if (!c) return;

    document.getElementById('modalConsultantTitle').innerText = 'Edit Consultant Profile';
    document.getElementById('editConsultantId').value = c.id;
    document.getElementById('cFullName').value = c.name;
    document.getElementById('cEmpCode').value = c.code;
    document.getElementById('cEmail').value = c.email;
    document.getElementById('cPhone').value = c.phone;
    document.getElementById('cSpecialization').value = c.specialization;
    document.getElementById('cExperience').value = c.experience;
    document.getElementById('cStatus').value = c.status;
    document.getElementById('cMaxCapacity').value = c.maxCapacity || 15;
    document.getElementById('cBio').value = c.bio || '';

    modalConsultantBackdrop.style.display = 'flex';
};

formConsultant.addEventListener('submit', (e) => {
    e.preventDefault();
    const editId = document.getElementById('editConsultantId').value;
    
    const payload = {
        name: document.getElementById('cFullName').value.trim(),
        code: document.getElementById('cEmpCode').value.trim(),
        email: document.getElementById('cEmail').value.trim(),
        phone: document.getElementById('cPhone').value.trim(),
        specialization: document.getElementById('cSpecialization').value,
        experience: parseInt(document.getElementById('cExperience').value, 10),
        status: document.getElementById('cStatus').value,
        maxCapacity: parseInt(document.getElementById('cMaxCapacity').value, 10) || 15,
        bio: document.getElementById('cBio').value.trim()
    };

    if (editId) {
        const idx = consultants.findIndex(c => c.id === parseInt(editId, 10));
        if (idx !== -1) {
            consultants[idx] = { ...consultants[idx], ...payload };
            showToast(`Consultant "${payload.name}" updated successfully.`);
        }
    } else {
        const newId = consultants.length ? Math.max(...consultants.map(c => c.id)) + 1 : 1;
        consultants.unshift({
            id: newId,
            ...payload,
            assignedStudents: [],
            rating: 5.0
        });
        showToast(`Consultant "${payload.name}" added successfully.`);
    }

    modalConsultantBackdrop.style.display = 'none';
    renderConsultants();
});

// Modal Controls - Assign Student
const modalAssignBackdrop = document.getElementById('modalAssignBackdrop');
const formAssign = document.getElementById('formAssign');

window.openAssignModal = function(id) {
    const c = consultants.find(item => item.id === id);
    if (!c) return;
    currentAssignId = id;

    document.getElementById('assignConsultantName').innerText = c.name;
    document.getElementById('assignConsultantSpec').innerText = `${c.specialization} Specialist • Current: ${c.assignedStudents.length} Cases`;
    formAssign.reset();
    modalAssignBackdrop.style.display = 'flex';
};

document.getElementById('btnCloseAssignModal').addEventListener('click', () => {
    modalAssignBackdrop.style.display = 'none';
});
document.getElementById('btnCancelAssignModal').addEventListener('click', () => {
    modalAssignBackdrop.style.display = 'none';
});

formAssign.addEventListener('submit', (e) => {
    e.preventDefault();
    const select = document.getElementById('assignStudentSelect');
    const studentInfo = select.value;
    if (!studentInfo) return;

    const c = consultants.find(item => item.id === currentAssignId);
    if (!c) return;

    // Parse mock student
    const parts = studentInfo.split(' - ');
    const sName = parts[1] ? parts[1].split(' (')[0] : 'Student';
    const sApp = parts[1] ? parts[1].replace(/.*\((.*)\).*/, '$1') : 'Target Course';

    c.assignedStudents.unshift({
        name: sName,
        app: sApp,
        stage: 'Advisor Assigned'
    });

    modalAssignBackdrop.style.display = 'none';
    showToast(`Assigned case to ${c.name} successfully!`);
    renderConsultants();
});

// Modal Controls - Details & Schedule
const modalDetailsBackdrop = document.getElementById('modalDetailsBackdrop');

window.openDetailsModal = function(id) {
    const c = consultants.find(item => item.id === id);
    if (!c) return;

    document.getElementById('detAvatar').innerText = getInitials(c.name);
    document.getElementById('detName').innerText = c.name;
    document.getElementById('detCode').innerText = c.code;
    document.getElementById('detEmail').innerText = c.email;
    document.getElementById('detPhone').innerText = c.phone;
    document.getElementById('detBio').innerText = c.bio || 'Experienced international education counselor.';
    document.getElementById('detStudentCount').innerText = c.assignedStudents.length;

    const studentListEl = document.getElementById('detStudentList');
    if (!c.assignedStudents || c.assignedStudents.length === 0) {
        studentListEl.innerHTML = '<div style="font-size: 12px; color: #8a93a3; padding: 10px; background: #f8fafc; border-radius: 6px;">No active students assigned currently.</div>';
    } else {
        studentListEl.innerHTML = c.assignedStudents.map((s, idx) => `
            <div style="background: #fafbfc; border: 1px solid #e7e9ed; border-radius: 6px; padding: 10px 14px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong style="font-size: 12px; color: #172033;">${idx + 1}. ${s.name}</strong>
                    <div style="font-size: 11px; color: #64748b; margin-top: 2px;">${s.app}</div>
                </div>
                <span style="font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 4px; background: #e0f2fe; color: #0284c7;">${s.stage}</span>
            </div>
        `).join('');
    }

    modalDetailsBackdrop.style.display = 'flex';
};

document.getElementById('btnCloseDetailsModal').addEventListener('click', () => {
    modalDetailsBackdrop.style.display = 'none';
});
document.getElementById('btnCloseDetailsModalBtn').addEventListener('click', () => {
    modalDetailsBackdrop.style.display = 'none';
});

// Modal Controls - Deactivate
const modalDeleteBackdrop = document.getElementById('modalDeleteBackdrop');

window.openDeleteModal = function(id) {
    const c = consultants.find(item => item.id === id);
    if (!c) return;
    currentDeleteId = id;

    document.getElementById('deleteConsultantName').innerText = c.name;
    document.getElementById('deleteStudentCount').innerText = c.assignedStudents.length;
    modalDeleteBackdrop.style.display = 'flex';
};

document.getElementById('btnCloseDeleteModal').addEventListener('click', () => {
    modalDeleteBackdrop.style.display = 'none';
});
document.getElementById('btnCancelDeleteModal').addEventListener('click', () => {
    modalDeleteBackdrop.style.display = 'none';
});

document.getElementById('btnConfirmDelete').addEventListener('click', () => {
    if (!currentDeleteId) return;
    const idx = consultants.findIndex(c => c.id === currentDeleteId);
    if (idx !== -1) {
        consultants[idx].status = 'inactive';
        showToast(`Consultant "${consultants[idx].name}" marked as inactive.`);
    }
    modalDeleteBackdrop.style.display = 'none';
    renderConsultants();
});

// CSV Export
document.getElementById('btnExportConsultants').addEventListener('click', () => {
    let csv = "Employee Code,Full Name,Email,Phone,Specialization,Years Experience,Active Cases,Status\n";
    consultants.forEach(c => {
        const studentCount = c.assignedStudents ? c.assignedStudents.length : 0;
        csv += `"${c.code}","${c.name}","${c.email}","${c.phone}","${c.specialization}",${c.experience},${studentCount},"${c.status}"\n`;
    });

    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.setAttribute("href", url);
    link.setAttribute("download", "indic_rmc_consultants_" + new Date().toISOString().slice(0,10) + ".csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    showToast("Exported consultant records successfully!");
});

// Initial Render
renderConsultants();
</script>

</body>
</html>
