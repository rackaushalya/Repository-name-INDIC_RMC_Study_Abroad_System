<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>INDIC RMC | University Management</title>

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
           SIDEBAR
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
           TOPBAR
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
            color: #f58220;
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
            border-color: #f58220;
            box-shadow: 0 0 0 3px rgba(245, 130, 32, 0.1);
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
            border-color: #f58220;
            background: #fffaf5;
        }

        .country-img-dropzone {
            transition: all .2s ease;
        }

        .country-img-dropzone:hover, .country-img-dropzone.dragover {
            border-color: #f58220 !important;
            box-shadow: 0 0 0 3px rgba(245, 130, 32, 0.15) !important;
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
            .sidebar {
                width: 70px;
            }
            .brand {
                justify-content: center;
                padding: 0;
            }
            .brand-mark {
                margin: 0;
            }
            .brand-name, .brand-subtitle, .nav-section, .nav-link span, .nav-badge {
                display: none;
            }
            .nav-link {
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
        }
    </style>
</head>
<body>

<div class="app">

    <!-- =====================================================
         SIDEBAR (Group Repo Layout Standard)
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

            <!-- ACTIVE ITEM -->
            <a href="{{ url('/admin/universities') }}" class="nav-link active">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M3 21h18"/>
                    <path d="M5 21V8l7-5 7 5v13"/>
                    <path d="M9 21v-6h6v6"/>
                </svg>
                <span>Universities</span>
                <span class="nav-badge" id="navUniCountBadge">7</span>
            </a>

            <a href="#" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M3 10l9-6 9 6"/>
                    <path d="M5 10v9h14v-9"/>
                    <path d="M9 19v-5h6v5"/>
                </svg>
                <span>Courses</span>
            </a>

            <a href="{{ url('/admin/scholarships') }}" class="nav-link">
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

            <div class="nav-section">System</div>
            <a href="#" class="nav-link">
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
                <input type="text" id="topbarSearchInput" placeholder="Quick search universities, courses...">
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
                         Add New University
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
                        <label class="form-label">Country Destination *</label>
                        <select id="uniCountryInput" class="form-select-modal" required></select>
                        <div style="font-size: 10px; color: #697386; margin-top: 4px;">
                            Countries are managed on the <a href="{{ url('/admin/countries') }}" style="color: #f58220; font-weight: 600;">Countries</a> page.
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
                        <input type="number" min="1" step="1" id="uniRankingInput" class="form-input" placeholder="e.g. 21" required>
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

                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 500; color: #374151; cursor: pointer;">
                        <input type="checkbox" id="uniActiveCheckbox" checked>
                        <span>Active partner (visible to student applicants and consultants)</span>
                    </label>
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
            <h3 class="modal-title" style="margin-bottom: 8px;">Deactivate University</h3>
            <p style="font-size: 12px; color: #697386;" id="deleteConfirmText">Are you sure you want to deactivate this university?</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
            <button type="button" class="btn-danger" id="confirmDeleteBtn" onclick="confirmDelete()">Deactivate</button>
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
    @php
        $countryDirectory = $countries->map(fn ($c) => [
            'id' => $c->country_id,
            'name' => $c->country_name,
            'flag' => $c->flag_image,
            'active' => (bool) $c->is_active,
        ])->values();
    @endphp

    const UNIVERSITIES_URL = @json(url('/admin/universities'));
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
    const DEFAULT_LOGO = 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=100&auto=format&fit=crop&q=80';

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
        return 'https://flagcdn.com/w80/un.png';
    }

    // XSS sanitization helper (values now come from the database)
    function escapeHtml(str) {
        if (str === null || str === undefined) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // JSON request helper for the university resource endpoints
    async function apiRequest(url, method, body) {
        const response = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin',
            body: body ? JSON.stringify(body) : undefined
        });

        let data = null;
        try { data = await response.json(); } catch (err) { /* non-JSON response */ }

        if (!response.ok) {
            let message = (data && data.message) || ('Request failed (' + response.status + ').');
            if (data && data.errors) {
                message = Object.values(data.errors)[0][0];
            }
            throw new Error(message);
        }
        return data;
    }

    // Countries and universities loaded from the database
    const countryDirectory = @json($countryDirectory);

    function prepareUniversity(u) {
        return {
            ...u,
            flag: u.flag || getCountryFlag(u.country),
            ranking: u.ranking ? '#' + u.ranking + ' QS World' : 'Unranked',
            rankingNum: u.ranking || 999
        };
    }

    let universities = @json($universities->map->toAdminArray()->values()).map(prepareUniversity);
    let activeSort = { column: 'ranking', ascending: true };
    let deleteTargetId = null;
    let currentLogoDataUrl = null;

    // Populate the modal country select and the top filter from the countries table
    function populateCountryDropdowns(selectedId = null) {
        const modalSelect = document.getElementById('uniCountryInput');
        modalSelect.innerHTML = '';

        // New universities can only be attached to active countries; keep the current one when editing
        const choices = countryDirectory.filter(c => c.active || String(c.id) === String(selectedId));
        if (choices.length === 0) {
            const opt = document.createElement('option');
            opt.value = '';
            opt.textContent = 'No countries available';
            modalSelect.appendChild(opt);
        }
        choices.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c.id;
            opt.textContent = c.name + (c.active ? '' : ' (inactive)');
            modalSelect.appendChild(opt);
        });
        if (selectedId) {
            modalSelect.value = selectedId;
        }

        const filterSelect = document.getElementById('countryFilterSelect');
        const curFilter = filterSelect.value || 'ALL';
        filterSelect.innerHTML = '<option value="ALL">Filter by Country</option>';
        countryDirectory.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c.name;
            opt.textContent = c.name;
            filterSelect.appendChild(opt);
        });
        filterSelect.value = countryDirectory.some(c => c.name === curFilter) ? curFilter : 'ALL';
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
        sortUniversities();
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
    });

    function inactiveBadge(uni) {
        return uni.active ? '' : ' <span style="font-size: 10px; font-weight: 600; padding: 1px 6px; border-radius: 4px; background: #f3f4f6; color: #6b7280;">Inactive</span>';
    }

    // Render Table
    function renderTable(data = universities) {
        const tbody = document.getElementById('uniTableBody');
        tbody.innerHTML = '';

        if (data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" style="text-align: center; padding: 40px; color: #8a93a3;">No universities match your search or country criteria.</td></tr>`;
            updateStats(0);
            return;
        }

        data.forEach(uni => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <img src="${escapeHtml(uni.logo || DEFAULT_LOGO)}" alt="${escapeHtml(uni.name)}" class="uni-logo-thumb">
                </td>
                <td>
                    <div class="uni-identity">
                        <div>
                            <div class="uni-name-text">${escapeHtml(uni.name)}${inactiveBadge(uni)}</div>
                            <div class="uni-meta-text">${escapeHtml(uni.shortCode)} • ${escapeHtml(uni.type || 'University')}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="country-pill">
                        <img src="${escapeHtml(uni.flag)}" class="country-flag-icon" alt="${escapeHtml(uni.country)}">
                        ${escapeHtml(uni.country)}
                    </span>
                    <div class="uni-meta-text">${escapeHtml(uni.city)}</div>
                </td>
                <td>
                    <span class="ranking-pill">${escapeHtml(uni.ranking)}</span>
                </td>
                <td>
                    ${uni.email ? `
                    <span class="email-chip" data-email="${escapeHtml(uni.email)}" onclick="copyEmail(this.dataset.email)" title="Click to copy email">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                        ${escapeHtml(uni.email)}
                    </span>` : '&mdash;'}
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
                        <button class="btn-icon-action delete" onclick="openDeleteModal('${uni.id}')" title="Deactivate university">
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
                    <img src="${escapeHtml(uni.logo || DEFAULT_LOGO)}" class="uni-logo-thumb" style="width: 48px; height: 48px;" alt="${escapeHtml(uni.name)}">
                    <div class="card-details">
                        <div class="uni-name-text">${escapeHtml(uni.name)}${inactiveBadge(uni)}</div>
                        <div class="uni-meta-text" style="display: flex; align-items: center; gap: 6px; margin-top: 2px;">
                            <img src="${escapeHtml(uni.flag)}" class="country-flag-icon" alt="${escapeHtml(uni.country)}">
                            <span>${escapeHtml([uni.city, uni.country].filter(Boolean).join(', '))}</span>
                        </div>
                        <div style="margin-top: 8px;">
                            <span class="ranking-pill">${escapeHtml(uni.ranking)}</span>
                        </div>
                    </div>
                </div>
                <div style="font-size: 11px; color: #4b5565;">
                    <div><strong>Email:</strong> ${escapeHtml(uni.email) || 'N/A'}</div>
                    <div style="margin-top: 3px;"><strong>Programs:</strong> ${uni.courses ? uni.courses.length : 0} accredited courses</div>
                </div>
                <div class="card-actions">
                    <button class="btn-view-courses" onclick="viewCourses('${uni.id}')">View Courses</button>
                    <div style="display: flex; gap: 6px;">
                        <button class="btn-icon-action" onclick="openEditModal('${uni.id}')"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>
                        <button class="btn-icon-action delete" onclick="openDeleteModal('${uni.id}')" title="Deactivate university"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>
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

    // Sort the in-memory list by the active column
    function sortUniversities() {
        const column = activeSort.column;
        universities.sort((a, b) => {
            let valA, valB;
            if (column === 'ranking') {
                valA = a.rankingNum;
                valB = b.rankingNum;
            } else {
                valA = (a[column] || '').toLowerCase();
                valB = (b[column] || '').toLowerCase();
            }

            if (valA < valB) return activeSort.ascending ? -1 : 1;
            if (valA > valB) return activeSort.ascending ? 1 : -1;
            return 0;
        });
    }

    // Sort Table
    function sortTable(column) {
        if (activeSort.column === column) {
            activeSort.ascending = !activeSort.ascending;
        } else {
            activeSort.column = column;
            activeSort.ascending = true;
        }

        sortUniversities();
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
        document.getElementById('courseModalSubtitle').innerText = `${[uni.city, uni.country].filter(Boolean).join(', ')} • ${uni.ranking}`;

        const container = document.getElementById('coursesListContainer');
        container.innerHTML = '';

        if (!uni.courses || uni.courses.length === 0) {
            container.innerHTML = `<div style="text-align:center; padding:20px; color:#8a93a3;">No courses registered yet.</div>`;
        } else {
            uni.courses.forEach(c => {
                const level = (c.degreeLevel || '').toLowerCase();
                const badgeClass = level.includes('mba') ? 'degree-badge mba' : (level.includes('bachelor') ? 'degree-badge bachelor' : 'degree-badge');
                const card = document.createElement('div');
                card.className = 'course-card';
                card.innerHTML = `
                    <div class="course-header">
                        <span class="course-title">${escapeHtml(c.name)}${c.active ? '' : ' (inactive)'}</span>
                        <span class="${badgeClass}">${escapeHtml(c.degreeLevel)}</span>
                    </div>
                    <div class="course-meta-grid">
                        <div class="meta-item"><span>Duration:</span> <strong>${escapeHtml(c.duration) || '&mdash;'}</strong></div>
                        <div class="meta-item"><span>Estimated Tuition:</span> <strong>${escapeHtml(c.tuition) || '&mdash;'}</strong></div>
                        <div class="meta-item"><span>English Requirement:</span> <strong>${escapeHtml(c.ielts) || '&mdash;'}</strong></div>
                    </div>
                    <div style="font-size: 11px; color: #697386; margin-top: 6px;">
                        <span>Intakes: <strong>${escapeHtml(c.intakes) || '&mdash;'}</strong></span>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        openModal('viewCoursesModal');
    }

    // Add University
    function openAddModal() {
        if (countryDirectory.filter(c => c.active).length === 0) {
            showToast('Add an active country first — every university must belong to a country.');
            return;
        }

        document.getElementById('uniForm').reset();
        document.getElementById('editUniId').value = '';
        removeUploadedLogo();
        populateCountryDropdowns();
        document.getElementById('uniActiveCheckbox').checked = true;
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

        populateCountryDropdowns(uni.countryId);
        document.getElementById('uniCountryInput').value = uni.countryId;

        document.getElementById('uniCityInput').value = uni.city;
        document.getElementById('uniRankingInput').value = uni.rankingNum === 999 ? '' : uni.rankingNum;
        document.getElementById('uniEmailInput').value = uni.email;
        document.getElementById('uniCategoryInput').value = uni.type || '';
        document.getElementById('uniWebsiteInput').value = uni.website || '';
        document.getElementById('uniActiveCheckbox').checked = !!uni.active;

        // Load existing logo
        currentLogoDataUrl = uni.logo || null;
        setLogoPreview(currentLogoDataUrl);
        const fileInput = document.getElementById('uniLogoFile');
        if (fileInput) fileInput.value = '';

        document.getElementById('addEditModalTitle').innerText = 'Edit University Details';
        openModal('addEditModal');
    }

    // Save University (persists to the database)
    async function saveUniversity(e) {
        e.preventDefault();
        const editId = document.getElementById('editUniId').value;
        const ranking = parseInt(document.getElementById('uniRankingInput').value, 10);

        const payload = {
            country_id: document.getElementById('uniCountryInput').value,
            university_name: document.getElementById('uniNameInput').value.trim(),
            university_code: document.getElementById('uniCodeInput').value.trim() || null,
            city: document.getElementById('uniCityInput').value.trim() || null,
            ranking: Number.isNaN(ranking) ? null : ranking,
            contact_email: document.getElementById('uniEmailInput').value.trim() || null,
            category: document.getElementById('uniCategoryInput').value.trim() || null,
            website: document.getElementById('uniWebsiteInput').value.trim() || null,
            logo_image: currentLogoDataUrl,
            is_active: document.getElementById('uniActiveCheckbox').checked
        };

        const submitBtn = document.querySelector('#uniForm button[type="submit"]');
        submitBtn.disabled = true;

        try {
            const result = await apiRequest(
                editId ? UNIVERSITIES_URL + '/' + editId : UNIVERSITIES_URL,
                editId ? 'PUT' : 'POST',
                payload
            );
            const saved = prepareUniversity(result.university);

            if (editId) {
                const index = universities.findIndex(u => u.id === editId);
                if (index !== -1) universities[index] = saved;
                showToast('University updated successfully!');
            } else {
                universities.unshift(saved);
                showToast('New university partner registered successfully!');
            }

            closeModal('addEditModal');
            applyFilters();
        } catch (err) {
            showToast(err.message);
        } finally {
            submitBtn.disabled = false;
        }
    }

    // Deactivate Modal
    function openDeleteModal(id) {
        deleteTargetId = id;
        const uni = universities.find(u => u.id === id);
        if (uni) {
            document.getElementById('deleteConfirmText').innerText = `Are you sure you want to deactivate "${uni.name}"? It will be marked Inactive.`;
        }
        openModal('deleteModal');
    }

    async function confirmDelete() {
        if (!deleteTargetId) return;
        const targetId = deleteTargetId;

        try {
            const result = await apiRequest(UNIVERSITIES_URL + '/' + targetId, 'DELETE');
            const index = universities.findIndex(u => u.id === targetId);
            if (index !== -1) universities[index] = prepareUniversity(result.university);

            deleteTargetId = null;
            closeModal('deleteModal');
            applyFilters();
            showToast('University deactivated.');
        } catch (err) {
            showToast(err.message);
        }
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
