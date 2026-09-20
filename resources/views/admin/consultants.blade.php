<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>INDIC RMC | Consultant Management</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
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
           SIDEBAR (Standard Dark #111827)
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
            font-weight: 600;
            font-size: 13px;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 600;
            color: #172033;
        }

        .profile-role {
            font-size: 10px;
            color: #8a93a3;
            margin-top: 2px;
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
            background: #f58220;
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
            box-shadow: 0 1px 2px rgba(245, 130, 32, 0.2);
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
            color: #f58220;
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
            border-color: #f58220;
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
            border-color: #f58220;
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
            color: #f58220;
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
            color: #f58220;
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
            background: #f58220;
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
            border-color: #f58220;
            color: #f58220;
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
            color: #f58220;
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
            background: #f58220;
            color: #ffffff;
            border-color: #f58220;
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
            border-color: #f58220;
            box-shadow: 0 0 0 3px rgba(245, 130, 32, 0.1);
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

        .toast.error .toast-icon {
            color: #f87171;
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
            .form-group.full {
                grid-column: span 1;
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
            <a href="{{ url('/admin/students') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <span>Students</span>
            </a>

            <!-- ACTIVE ITEM: Consultants -->
            <a href="{{ url('/admin/consultants') }}" class="nav-link active">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                </svg>
                <span>Consultants</span>
                <span class="nav-badge" id="navConsultantCountBadge">{{ $consultants->count() }}</span>
            </a>

            <a href="{{ url('/admin/applications') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M6 2h12v20H6z"/>
                    <path d="M9 6h6"/>
                    <path d="M9 10h6"/>
                    <path d="M9 14h4"/>
                </svg>
                <span>Applications</span>
            </a>

            <a href="{{ url('/admin/appointments') }}" class="nav-link">
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
                    <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.5 1.5-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1 1.55V20h-2v-.41a1.7 1.7 0 0 0-1-1.55 1.7 1.7 0 0 0-1.88.34l-.06.06-1.5-1.5.06-.06A1.7 1.7 0 0 0 7.4 15a1.7 1.7 0 0 0-1.55-1H5v-2h.85a1.7 1.7 0 0 0 1.55-1 1.7 1.7 0 0 0-.34-1.88L7 9.06l1.5-1.5.06.06a1.7 1.7 0 0 0 1.88.34 1.7 1.7 0 0 0 1.55 1H20v2h-.41a1.7 1.7 0 0 0-1.55 1z"/>
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
                <input type="text" id="topbarSearchInput" placeholder="Quick search consultants, specialization...">
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
                    <div class="kpi-value" id="kpiTotalConsultants">0</div>
                    <div class="kpi-footer" id="kpiTotalFooter">Registered advisors</div>
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
                    <div class="kpi-value" id="kpiActiveConsultants">0</div>
                    <div class="kpi-footer" id="kpiActiveFooter">On leave or inactive: 0</div>
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
                    <div class="kpi-value" id="kpiTotalAssigned">0</div>
                    <div class="kpi-footer" id="kpiAssignedFooter">Avg <span class="stat-highlight">0</span> students / active advisor</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-header">
                        <span class="kpi-title">Caseload Utilization</span>
                        <div class="kpi-icon purple">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21.21 15.89A10 10 0 1 1 8 2.83"/>
                                <path d="M22 12A10 10 0 0 0 12 2v10z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="kpi-value" id="kpiUtilization">0%</div>
                    <div class="kpi-footer" id="kpiUtilizationFooter">Of active advisors' case capacity</div>
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
                        <label class="form-label">First Name *</label>
                        <input type="text" class="form-input" id="cFirstName" required maxlength="100" placeholder="e.g. Eleanor">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-input" id="cLastName" maxlength="100" placeholder="e.g. Vance">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Employee Code *</label>
                        <input type="text" class="form-input" id="cEmpCode" required maxlength="50" placeholder="e.g. RMC-CON-001">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" class="form-input" id="cEmail" required maxlength="150" placeholder="e.g. eleanor.vance@indicrmc.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-input" id="cPhone" maxlength="30" placeholder="e.g. +91 98450 12345">
                    </div>

                    <div class="form-group">
                        <label class="form-label" id="cPasswordLabel">Login Password *</label>
                        <input type="password" class="form-input" id="cPassword" minlength="8" autocomplete="new-password" placeholder="At least 8 characters">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Primary Destination / Specialization *</label>
                        <select class="form-select-modal" id="cSpecialization" required></select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Years of Experience *</label>
                        <input type="number" class="form-input" id="cExperience" min="0" max="60" required value="5">
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
                        <label class="form-label">Maximum Caseload Capacity *</label>
                        <input type="number" class="form-input" id="cMaxCapacity" min="1" max="100" required value="15">
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
                    <div style="font-size: 14px; font-weight: 700; color: #111827; margin-top: 2px;" id="assignConsultantName"></div>
                    <div style="font-size: 12px; color: #f58220; font-weight: 500;" id="assignConsultantSpec"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Select Student / Application Case *</label>
                    <select class="form-select-modal" id="assignStudentSelect" required></select>
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
                <div class="card-avatar" style="width: 56px; height: 56px; font-size: 18px;" id="detAvatar"></div>
                <div>
                    <h2 style="font-size: 18px; font-weight: 700; color: #111827;" id="detName"></h2>
                    <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                        <span id="detCode" class="code-tag"></span> &bull; <span id="detEmail"></span> &bull; <span id="detPhone"></span>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 18px;">
                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; margin-bottom: 4px;">Professional Biography</div>
                <p style="font-size: 12px; line-height: 1.6; color: #334155;" id="detBio"></p>
            </div>

            <div style="margin-bottom: 18px;">
                <div style="margin-bottom: 6px;">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b;">Weekly Consultation Hours & Availability</div>
                </div>
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Working Hours</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="detScheduleBody"></tbody>
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
    const CONSULTANTS_URL = @json(url('/admin/consultants'));
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
    const DEFAULT_SPECIALIZATIONS = [
        'UK & Europe',
        'USA & Canada',
        'Australia & New Zealand',
        'Medicine & STEM',
        'Visa & Compliance'
    ];

    // Consultants and open applications loaded from the database
    let consultants = @json($consultants->map->toAdminArray()->values());
    let unassignedApplications = @json($unassignedApplications);

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
    const navBadge = document.getElementById('navConsultantCountBadge');

    // XSS sanitization helper (values come from the database)
    function escapeHtml(str) {
        if (str === null || str === undefined) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // JSON request helper for the consultant endpoints
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

    // Toast helper
    function showToast(msg, isError = false) {
        const toast = document.getElementById('toast');
        document.getElementById('toastMessage').innerText = msg;
        toast.classList.toggle('error', isError);
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3500);
    }

    // Insert or replace a consultant returned by the server
    function upsertConsultant(saved) {
        const index = consultants.findIndex(c => c.id === saved.id);
        if (index !== -1) {
            consultants[index] = saved;
        } else {
            consultants.unshift(saved);
        }
    }

    // Specializations: the standard list plus anything already stored in the database
    function specializationChoices(extra = null) {
        const set = new Set(DEFAULT_SPECIALIZATIONS);
        consultants.forEach(c => { if (c.specialization) set.add(c.specialization); });
        if (extra) set.add(extra);
        return Array.from(set);
    }

    function populateSpecializations(selected = null) {
        const modalSelect = document.getElementById('cSpecialization');
        modalSelect.innerHTML = specializationChoices(selected)
            .map(s => `<option value="${escapeHtml(s)}">${escapeHtml(s)}</option>`)
            .join('');
        if (selected) modalSelect.value = selected;

        const current = filterSpecialization.value || 'all';
        const choices = specializationChoices();
        filterSpecialization.innerHTML = '<option value="all">All Destinations / Specializations</option>' +
            choices.map(s => `<option value="${escapeHtml(s)}">${escapeHtml(s)}</option>`).join('');
        filterSpecialization.value = choices.includes(current) ? current : 'all';
    }

    // Next free employee code, e.g. RMC-CON-009
    function nextEmployeeCode() {
        const highest = consultants.reduce((max, c) => {
            const n = parseInt((c.code || '').replace(/\D/g, ''), 10);
            return Number.isNaN(n) ? max : Math.max(max, n);
        }, 0);
        return 'RMC-CON-' + String(highest + 1).padStart(3, '0');
    }

    // Update KPI Stats
    function updateKPIs() {
        const total = consultants.length;
        const activeList = consultants.filter(c => c.status === 'active');
        const active = activeList.length;
        const totalCases = consultants.reduce((sum, c) => sum + c.assignedStudents.length, 0);
        const activeCases = activeList.reduce((sum, c) => sum + c.assignedStudents.length, 0);
        const activeCapacity = activeList.reduce((sum, c) => sum + (c.maxCapacity || 15), 0);
        const utilization = activeCapacity ? Math.round((activeCases / activeCapacity) * 100) : 0;
        const avg = active ? (totalCases / active).toFixed(1) : '0.0';

        document.getElementById('kpiTotalConsultants').innerText = total;
        document.getElementById('kpiActiveConsultants').innerText = active;
        document.getElementById('kpiActiveFooter').innerText = (total - active) + ' on leave or inactive';
        document.getElementById('kpiTotalAssigned').innerText = totalCases;
        document.getElementById('kpiAssignedFooter').innerHTML = 'Avg <span class="stat-highlight">' + avg + '</span> students / active advisor';
        document.getElementById('kpiUtilization').innerText = utilization + '%';
        document.getElementById('kpiUtilizationFooter').innerText = activeCases + ' of ' + activeCapacity + ' case slots in use';
        if (navBadge) navBadge.innerText = total;
    }

    // Get initials
    function getInitials(name) {
        const parts = (name || '').replace(/^Dr\.?\s+/i, '').trim().split(/\s+/).filter(Boolean);
        if (parts.length >= 2) {
            return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
        }
        return (parts[0] || '?').slice(0, 2).toUpperCase();
    }

    const statusMap = {
        active: { label: 'Active', cls: 'active' },
        on_leave: { label: 'On Leave', cls: 'on_leave' },
        inactive: { label: 'Inactive', cls: 'inactive' }
    };

    // Render Table Row
    function renderTableRow(c) {
        const initials = getInitials(c.name);
        const studentCount = c.assignedStudents.length;
        const maxCap = c.maxCapacity || 15;
        const percent = Math.min(100, Math.round((studentCount / maxCap) * 100));

        let loadClass = '';
        if (percent > 85) loadClass = 'danger';
        else if (percent > 65) loadClass = 'warning';

        let specClass = '';
        if (c.specialization.includes('USA')) specClass = 'usa';
        else if (c.specialization.includes('Australia')) specClass = 'australia';
        else if (c.specialization.includes('Canada')) specClass = 'canada';

        const s = statusMap[c.status] || { label: c.status, cls: 'inactive' };

        return `
        <tr data-id="${c.id}">
            <td>
                <div class="consultant-identity">
                    <div class="consultant-avatar">${escapeHtml(initials)}</div>
                    <div>
                        <div class="consultant-name">${escapeHtml(c.name)}</div>
                        <div class="consultant-code">
                            <span class="code-tag">${escapeHtml(c.code)}</span>
                            <span>${escapeHtml(c.email)}</span>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <span class="specialization-pill ${specClass}">${escapeHtml(c.specialization)}</span>
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
        const studentCount = c.assignedStudents.length;
        const maxCap = c.maxCapacity || 15;
        const s = statusMap[c.status] || { label: c.status, cls: 'inactive' };

        return `
        <div class="consultant-card" data-id="${c.id}">
            <div class="card-top">
                <div class="card-profile">
                    <div class="card-avatar">${escapeHtml(initials)}</div>
                    <div>
                        <div style="font-weight: 700; font-size: 14px; color: #111827;">${escapeHtml(c.name)}</div>
                        <div style="font-size: 11px; color: #64748b; margin-top: 1px;">
                            <span class="code-tag">${escapeHtml(c.code)}</span>
                        </div>
                    </div>
                </div>
                <span class="status-badge ${s.cls}">
                    <span class="status-dot"></span>
                    ${s.label}
                </span>
            </div>

            <div style="margin: 8px 0;">
                <span class="specialization-pill">${escapeHtml(c.specialization)}</span>
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
                    <span>${escapeHtml(c.email)}</span>
                </div>
                <div class="card-meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <span>${escapeHtml(c.phone || '—')}</span>
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
        updateKPIs();

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
            const message = consultants.length === 0
                ? 'No consultants yet. Use "Add Consultant" to create the first one.'
                : 'No consultants matched your search filters.';

            consultantsTableBody.innerHTML = `
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: #8c96a8;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 10px; display: block; color: #cbd5e1;">
                            <circle cx="12" cy="7" r="4"/>
                            <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                        </svg>
                        ${message}
                    </td>
                </tr>
            `;
            consultantsCardsGrid.innerHTML = `
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #8c96a8; background: #ffffff; border-radius: 10px; border: 1px dashed #cbd5e1;">
                    ${message}
                </div>
            `;
            return;
        }

        consultantsTableBody.innerHTML = filtered.map(renderTableRow).join('');
        consultantsCardsGrid.innerHTML = filtered.map(renderCard).join('');
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
    const btnSaveConsultant = document.getElementById('btnSaveConsultant');

    function setPasswordMode(isEdit) {
        const password = document.getElementById('cPassword');
        password.required = !isEdit;
        password.value = '';
        document.getElementById('cPasswordLabel').innerText = isEdit
            ? 'New Password (leave blank to keep current)'
            : 'Login Password *';
    }

    document.getElementById('btnOpenAddConsultant').addEventListener('click', () => {
        document.getElementById('modalConsultantTitle').innerText = 'Add New Consultant';
        document.getElementById('editConsultantId').value = '';
        formConsultant.reset();
        populateSpecializations();
        setPasswordMode(false);
        document.getElementById('cEmpCode').value = nextEmployeeCode();
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

        formConsultant.reset();
        populateSpecializations(c.specialization);
        setPasswordMode(true);

        document.getElementById('modalConsultantTitle').innerText = 'Edit Consultant Profile';
        document.getElementById('editConsultantId').value = c.id;
        document.getElementById('cFirstName').value = c.firstName;
        document.getElementById('cLastName').value = c.lastName;
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

    formConsultant.addEventListener('submit', async (e) => {
        e.preventDefault();
        const editId = document.getElementById('editConsultantId').value;

        const payload = {
            first_name: document.getElementById('cFirstName').value.trim(),
            last_name: document.getElementById('cLastName').value.trim(),
            employee_code: document.getElementById('cEmpCode').value.trim(),
            email: document.getElementById('cEmail').value.trim(),
            phone: document.getElementById('cPhone').value.trim(),
            password: document.getElementById('cPassword').value,
            specialization: document.getElementById('cSpecialization').value,
            years_of_experience: parseInt(document.getElementById('cExperience').value, 10),
            consultant_status: document.getElementById('cStatus').value,
            max_caseload: parseInt(document.getElementById('cMaxCapacity').value, 10),
            bio: document.getElementById('cBio').value.trim()
        };

        btnSaveConsultant.disabled = true;
        try {
            const result = await apiRequest(
                editId ? CONSULTANTS_URL + '/' + editId : CONSULTANTS_URL,
                editId ? 'PUT' : 'POST',
                payload
            );

            upsertConsultant(result.consultant);
            modalConsultantBackdrop.style.display = 'none';
            showToast(`Consultant "${result.consultant.name}" ${editId ? 'updated' : 'added'} successfully.`);
            populateSpecializations();
            renderConsultants();
        } catch (err) {
            showToast(err.message, true);
        } finally {
            btnSaveConsultant.disabled = false;
        }
    });

    // Modal Controls - Assign Student
    const modalAssignBackdrop = document.getElementById('modalAssignBackdrop');
    const formAssign = document.getElementById('formAssign');
    const btnConfirmAssign = document.getElementById('btnConfirmAssign');

    function populateAssignSelect() {
        const select = document.getElementById('assignStudentSelect');
        const placeholder = unassignedApplications.length
            ? '-- Choose unassigned student application --'
            : 'No unassigned applications available';

        select.innerHTML = `<option value="">${placeholder}</option>` +
            unassignedApplications.map(a => `
                <option value="${a.id}">${escapeHtml(a.reference)} - ${escapeHtml(a.student)} (${escapeHtml(a.target)}) - ${escapeHtml(a.status)}</option>
            `).join('');
    }

    window.openAssignModal = function(id) {
        const c = consultants.find(item => item.id === id);
        if (!c) return;
        currentAssignId = id;

        document.getElementById('assignConsultantName').innerText = c.name;
        document.getElementById('assignConsultantSpec').innerText = `${c.specialization} Specialist • Current: ${c.assignedStudents.length} / ${c.maxCapacity} Cases`;
        formAssign.reset();
        populateAssignSelect();
        modalAssignBackdrop.style.display = 'flex';
    };

    document.getElementById('btnCloseAssignModal').addEventListener('click', () => {
        modalAssignBackdrop.style.display = 'none';
    });
    document.getElementById('btnCancelAssignModal').addEventListener('click', () => {
        modalAssignBackdrop.style.display = 'none';
    });

    formAssign.addEventListener('submit', async (e) => {
        e.preventDefault();
        const applicationId = parseInt(document.getElementById('assignStudentSelect').value, 10);
        if (!applicationId || !currentAssignId) return;

        btnConfirmAssign.disabled = true;
        try {
            const result = await apiRequest(
                CONSULTANTS_URL + '/' + currentAssignId + '/assignments',
                'POST',
                {
                    application_id: applicationId,
                    priority: document.getElementById('assignPriority').value,
                    notes: document.getElementById('assignNotes').value.trim()
                }
            );

            upsertConsultant(result.consultant);
            unassignedApplications = unassignedApplications.filter(a => a.id !== applicationId);
            modalAssignBackdrop.style.display = 'none';
            showToast(`Assigned case to ${result.consultant.name} successfully!`);
            renderConsultants();
        } catch (err) {
            showToast(err.message, true);
        } finally {
            btnConfirmAssign.disabled = false;
        }
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
        document.getElementById('detPhone').innerText = c.phone || '—';
        document.getElementById('detBio').innerText = c.bio || 'Experienced international education counselor.';
        document.getElementById('detStudentCount').innerText = c.assignedStudents.length;

        const scheduleEl = document.getElementById('detScheduleBody');
        if (!c.schedule || c.schedule.length === 0) {
            scheduleEl.innerHTML = '<tr><td colspan="3" style="color: #8a93a3;">No weekly availability has been set for this consultant.</td></tr>';
        } else {
            scheduleEl.innerHTML = c.schedule.map(s => `
                <tr>
                    <td><strong>${escapeHtml(s.day)}</strong></td>
                    <td>${escapeHtml(s.hours)}</td>
                    <td><span class="status-badge ${s.available ? 'active' : 'inactive'}"><span class="status-dot"></span> ${s.available ? 'Available' : 'Unavailable'}</span></td>
                </tr>
            `).join('');
        }

        const studentListEl = document.getElementById('detStudentList');
        if (c.assignedStudents.length === 0) {
            studentListEl.innerHTML = '<div style="font-size: 12px; color: #8a93a3; padding: 10px; background: #f8fafc; border-radius: 6px;">No active students assigned currently.</div>';
        } else {
            studentListEl.innerHTML = c.assignedStudents.map((s, idx) => `
                <div style="background: #fafbfc; border: 1px solid #e7e9ed; border-radius: 6px; padding: 10px 14px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <strong style="font-size: 12px; color: #172033;">${idx + 1}. ${escapeHtml(s.name)}</strong>
                        <div style="font-size: 11px; color: #64748b; margin-top: 2px;">${escapeHtml(s.app)}</div>
                    </div>
                    <span style="font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 4px; background: #e0f2fe; color: #0284c7;">${escapeHtml(s.stage)}</span>
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
    const btnConfirmDelete = document.getElementById('btnConfirmDelete');

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

    btnConfirmDelete.addEventListener('click', async () => {
        if (!currentDeleteId) return;

        btnConfirmDelete.disabled = true;
        try {
            const result = await apiRequest(CONSULTANTS_URL + '/' + currentDeleteId, 'DELETE');
            upsertConsultant(result.consultant);
            showToast(`Consultant "${result.consultant.name}" marked as inactive.`);
            modalDeleteBackdrop.style.display = 'none';
            renderConsultants();
        } catch (err) {
            showToast(err.message, true);
        } finally {
            btnConfirmDelete.disabled = false;
        }
    });

    // CSV Export
    function csvCell(value) {
        return '"' + String(value === null || value === undefined ? '' : value).replace(/"/g, '""') + '"';
    }

    document.getElementById('btnExportConsultants').addEventListener('click', () => {
        let csv = "Employee Code,Full Name,Email,Phone,Specialization,Years Experience,Active Cases,Status\n";
        consultants.forEach(c => {
            csv += [
                csvCell(c.code),
                csvCell(c.name),
                csvCell(c.email),
                csvCell(c.phone),
                csvCell(c.specialization),
                c.experience,
                c.assignedStudents.length,
                csvCell(c.status)
            ].join(',') + "\n";
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
    populateSpecializations();
    renderConsultants();
</script>

</body>
</html>
