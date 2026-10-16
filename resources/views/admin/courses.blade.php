<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDIC RMC | Course Management</title>

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
            color: #f97316;
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
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
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
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
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
            .main { margin-left: 70px; width: calc(100% - 70px); }
            .content { padding: 16px; }
            .form-grid { grid-template-columns: 1fr; }
        }

        /* Database-backed page additions */
        .form-errors { background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; border-radius: 8px; padding: 10px 14px; font-size: 12px; margin-bottom: 14px; }
        .form-errors ul { margin: 4px 0 0 16px; padding: 0; }
        .empty-state { text-align: center; padding: 40px; color: #6b7280; font-size: 13px; }
        .detail-row { display: flex; justify-content: space-between; gap: 16px; padding: 9px 0; border-bottom: 1px solid #f0f2f5; font-size: 12px; }
        .detail-row span:first-child { color: #6b7280; }
        .detail-row strong { color: #111827; text-align: right; }
        .table-footer .portal-pager { width: 100%; }
        .tuition-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 10px; }
        @media (max-width: 750px) { .tuition-grid { grid-template-columns: 1fr; } }
    </style>
@include('components.sidebar-style')
</head>
<body>

@php
    $allCourses = $courses->getCollection();
    // Load related data (works whichever admin URL showed this page).
    $allCourses->loadMissing(['university.country', 'tuitionFees', 'intakes']);
    $totalCourses = $courses->total();

    $universityOptions = \App\Models\University::with('country')->orderBy('university_name')->get();

    $levels = \App\Http\Controllers\CourseController::LEVELS;
    $modes = \App\Http\Controllers\CourseController::MODES;
    $feePeriods = \App\Http\Controllers\CourseController::FEE_PERIODS;

    $mainFee = fn ($course) => $course->tuitionFees->sortByDesc('tuition_fee_id')->first();
    $feeText = function ($fee) {
        if (!$fee) return null;
        $amount = (float) $fee->amount;
        $formatted = number_format($amount, fmod($amount, 1) ? 2 : 0);
        return trim($fee->currency . ' ' . $formatted) . ($fee->fee_period && $fee->fee_period !== 'Other' ? ' / ' . strtolower($fee->fee_period) : '');
    };
    $levelClass = fn ($level) => 'ranking-pill ' . strtolower((string) $level);
    $modeClass = fn ($mode) => 'mode-pill ' . str_replace(' ', '-', strtolower((string) $mode));

    $coursesForJs = $allCourses->map(function ($c) use ($mainFee, $feeText) {
        $fee = $mainFee($c);
        return [
            'id' => $c->course_id,
            'name' => $c->course_name,
            'universityId' => $c->university_id,
            'university' => $c->university?->university_name,
            'country' => $c->university?->country?->country_name,
            'level' => $c->course_level,
            'field' => $c->field_of_study,
            'duration' => $c->duration,
            'mode' => $c->study_mode,
            'description' => $c->description,
            'active' => (bool) $c->is_active,
            'feeAmount' => $fee ? (float) $fee->amount : null,
            'feeCurrency' => $fee?->currency,
            'feePeriod' => $fee?->fee_period,
            'feeText' => $feeText($fee),
            'intakes' => $c->intakeList()->map(fn ($i) => [
                'name' => $i->intake_name,
                'status' => $i->intake_status ?? null,
            ])->values(),
        ];
    })->values();
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

        <!-- PAGE CONTENT -->
        <div class="content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <div>
                    <h1>
                        Course Management
                        <span class="title-badge">{{ $totalCourses }} {{ Str::plural('Course', $totalCourses) }}</span>
                    </h1>
                    <p>Manage the degree programs offered by your partner universities.</p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="button" class="btn-secondary" onclick="exportCoursesCSV()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Export CSV
                    </button>
                    <button type="button" class="btn-orange" onclick="openAddCourseModal()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Add New Course
                    </button>
                </div>
            </div>

            @if ($universityOptions->isEmpty())
                <div class="form-errors" style="margin-bottom: 16px;">
                    You need at least one university before adding a course.
                    <a href="{{ route('admin.universities-list') }}" style="color: inherit; font-weight: 700;">Add a university first →</a>
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
                        <input type="text" id="courseSearchInput" placeholder="Search by course name, field or university...">
                    </div>

                    <select class="filter-select" id="levelFilter">
                        <option value="ALL">All Degree Levels</option>
                        @foreach ($levels as $level)
                            <option value="{{ $level }}">{{ $level }}</option>
                        @endforeach
                    </select>

                    <select class="filter-select" id="universityFilter">
                        <option value="ALL">All Universities</option>
                        @foreach ($universityOptions as $option)
                            <option value="{{ $option->university_id }}">{{ $option->university_name }}</option>
                        @endforeach
                    </select>

                    <select class="filter-select" id="modeFilter">
                        <option value="ALL">All Study Modes</option>
                        @foreach ($modes as $mode)
                            <option value="{{ $mode }}">{{ $mode }}</option>
                        @endforeach
                    </select>

                    <select class="filter-select" id="statusFilter">
                        <option value="ALL">All Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

                <div class="controls-right">
                    <div class="view-switcher">
                        <button type="button" class="view-btn active" id="tableViewBtn" onclick="switchView('table')">
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
                        <button type="button" class="view-btn" id="gridViewBtn" onclick="switchView('grid')">
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
                                <th>Course</th>
                                <th>Partner University</th>
                                <th>Level & Field</th>
                                <th>Duration & Mode</th>
                                <th>Tuition</th>
                                <th>Status</th>
                                <th style="text-align: right; width: 170px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allCourses as $course)
                                @php $fee = $feeText($mainFee($course)); @endphp
                                <tr class="course-item"
                                    data-search="{{ strtolower($course->course_name . ' ' . $course->field_of_study . ' ' . $course->university?->university_name . ' ' . $course->university?->country?->country_name) }}"
                                    data-level="{{ $course->course_level }}"
                                    data-university="{{ $course->university_id }}"
                                    data-mode="{{ $course->study_mode }}"
                                    data-status="{{ $course->is_active ? 'Active' : 'Inactive' }}">
                                    <td>
                                        <div class="uni-identity">
                                            <div class="course-icon-thumb">{{ strtoupper(substr($course->course_level ?? 'C', 0, 2)) }}</div>
                                            <div>
                                                <div class="uni-name-text">{{ $course->course_name }}</div>
                                                <div class="uni-meta-text">{{ $course->intakeList()->count() }} {{ Str::plural('intake', $course->intakeList()->count()) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="country-pill">
                                            <span>{{ $course->university?->university_name ?? 'Unknown university' }}</span>
                                        </div>
                                        <div style="font-size: 10px; color: #8c96a8; margin-top: 2px;">{{ $course->university?->country?->country_name }}</div>
                                    </td>
                                    <td>
                                        <span class="{{ $levelClass($course->course_level) }}">{{ $course->course_level }}</span>
                                        <div style="font-size: 11px; color: #6b7280; margin-top: 3px;">{{ $course->field_of_study ?: '—' }}</div>
                                    </td>
                                    <td>
                                        <span class="{{ $modeClass($course->study_mode) }}">{{ $course->study_mode ?: '—' }}</span>
                                        <div style="font-size: 11px; color: #8c96a8; margin-top: 3px;">{{ $course->duration ?: '—' }}</div>
                                    </td>
                                    <td>
                                        <strong style="color: #111827; font-size: 12px;">{{ $fee ?? 'Not set' }}</strong>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $course->is_active ? 'active' : 'inactive' }}">
                                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions-cell">
                                            <button type="button" class="btn-view-courses" onclick="viewCourseDetails({{ $course->course_id }})" title="View details">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                                    <circle cx="12" cy="12" r="3"/>
                                                </svg>
                                                Details
                                            </button>
                                            <button type="button" class="btn-icon-action" onclick="openEditCourseModal({{ $course->course_id }})" title="Edit course">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </button>
                                            @if ($course->is_active)
                                                <button type="button" class="btn-icon-action delete" onclick="openDeleteCourseModal({{ $course->course_id }})" title="Deactivate course">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6"/>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="empty-state">No courses yet. Click <strong>Add New Course</strong> to create the first one.</td></tr>
                            @endforelse
                            <tr id="noMatchRow" style="display: none;"><td colspan="7" class="empty-state">No courses match your search or filters.</td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- GRID CARDS VIEW -->
                <div class="cards-grid" id="gridViewSection" style="display: none;">
                    @foreach ($allCourses as $course)
                        @php $fee = $feeText($mainFee($course)); @endphp
                        <div class="uni-grid-card course-item"
                             data-search="{{ strtolower($course->course_name . ' ' . $course->field_of_study . ' ' . $course->university?->university_name . ' ' . $course->university?->country?->country_name) }}"
                             data-level="{{ $course->course_level }}"
                             data-university="{{ $course->university_id }}"
                             data-mode="{{ $course->study_mode }}"
                             data-status="{{ $course->is_active ? 'Active' : 'Inactive' }}">
                            <div class="card-top">
                                <span class="{{ $levelClass($course->course_level) }}">{{ $course->course_level }}</span>
                                <span class="status-badge {{ $course->is_active ? 'active' : 'inactive' }}">{{ $course->is_active ? 'Active' : 'Inactive' }}</span>
                            </div>

                            <div style="font-size: 14px; font-weight: 700; color: #111827; line-height: 1.4;">{{ $course->course_name }}</div>

                            <div class="country-pill">
                                <div>
                                    <div style="font-weight: 600; color: #172033; font-size: 12px;">{{ $course->university?->university_name }}</div>
                                    <div style="font-size: 10px; color: #8a93a3;">{{ $course->university?->country?->country_name }}</div>
                                </div>
                            </div>

                            <div class="card-metric-grid">
                                <div>
                                    <div class="card-metric-label">Tuition</div>
                                    <div class="card-metric-val">{{ $fee ?? 'Not set' }}</div>
                                </div>
                                <div>
                                    <div class="card-metric-label">Duration</div>
                                    <div class="card-metric-val">{{ $course->duration ?: '—' }}</div>
                                </div>
                                <div>
                                    <div class="card-metric-label">Study Mode</div>
                                    <div class="card-metric-val">{{ $course->study_mode ?: '—' }}</div>
                                </div>
                                <div>
                                    <div class="card-metric-label">Field</div>
                                    <div class="card-metric-val">{{ $course->field_of_study ?: '—' }}</div>
                                </div>
                            </div>

                            <div style="font-size: 11px; color: #6b7280; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $course->description ?: 'No description yet.' }}
                            </div>

                            <div class="card-actions">
                                <button type="button" class="btn-view-courses" onclick="viewCourseDetails({{ $course->course_id }})" style="margin-right: auto;">Details</button>
                                <button type="button" class="btn-icon-action" onclick="openEditCourseModal({{ $course->course_id }})" title="Edit course">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                @if ($course->is_active)
                                    <button type="button" class="btn-icon-action delete" onclick="openDeleteCourseModal({{ $course->course_id }})" title="Deactivate course">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- TABLE FOOTER -->
                <div class="table-footer">
                    @if ($courses->hasPages())
                        {{ $courses->links('pagination.portal') }}
                    @else
                        <div>Showing {{ $totalCourses }} {{ Str::plural('course', $totalCourses) }}</div>
                        <div>Click <strong>Details</strong> to see a course's description and intakes.</div>
                    @endif
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <footer class="footer">
            <div>&copy; 2026 INDIC RMC Study Abroad Platform. All rights reserved.</div>
        </footer>

    </main>

</div>

<!-- =====================================================
     MODAL 1: ADD / EDIT COURSE (saves to the database)
====================================================== -->
<div class="modal-backdrop" id="addEditCourseModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <div class="modal-title" id="addEditModalTitle">Add New Course</div>
                <div class="modal-subtitle">Add a degree program offered by a partner university.</div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('addEditCourseModal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <form id="courseForm" method="POST" action="{{ route('admin.courses.store') }}">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="edit_id" id="courseIdField" value="{{ old('edit_id') }}">
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

                <div class="form-group" style="margin-bottom: 14px;">
                    <label class="form-label" for="courseNameInput">Course Name *</label>
                    <input type="text" class="form-input" id="courseNameInput" name="course_name" placeholder="e.g. BSc in Computer Science"
                           maxlength="255" required value="{{ old('course_name') }}">
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="courseUniversitySelect">University *</label>
                        <select class="form-select" id="courseUniversitySelect" name="university_id" required>
                            <option value="">Choose a university...</option>
                            @foreach ($universityOptions as $option)
                                <option value="{{ $option->university_id }}" @selected(old('university_id') == $option->university_id)>
                                    {{ $option->university_name }}{{ $option->country ? ' (' . $option->country->country_name . ')' : '' }}{{ $option->is_active ? '' : ' – inactive' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="courseLevelSelect">Degree Level *</label>
                        <select class="form-select" id="courseLevelSelect" name="course_level" required>
                            @foreach ($levels as $level)
                                <option value="{{ $level }}" @selected(old('course_level', 'Bachelor') === $level)>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="courseFieldInput">Field of Study</label>
                        <input type="text" class="form-input" id="courseFieldInput" name="field_of_study" placeholder="e.g. Computer Science"
                               maxlength="150" value="{{ old('field_of_study') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="courseDurationInput">Duration</label>
                        <input type="text" class="form-input" id="courseDurationInput" name="duration" placeholder="e.g. 4 years"
                               maxlength="100" value="{{ old('duration') }}">
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="courseModeSelect">Study Mode *</label>
                        <select class="form-select" id="courseModeSelect" name="study_mode" required>
                            @foreach ($modes as $mode)
                                <option value="{{ $mode }}" @selected(old('study_mode', 'On Campus') === $mode)>{{ $mode }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="courseStatusSelect">Status *</label>
                        <select class="form-select" id="courseStatusSelect" name="is_active" required>
                            <option value="1" @selected(old('is_active', '1') == '1')>Active</option>
                            <option value="0" @selected(old('is_active') === '0')>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 14px;">
                    <label class="form-label">Tuition Fee (optional)</label>
                    <div class="tuition-grid">
                        <input type="number" class="form-input" id="courseTuitionInput" name="tuition_amount" placeholder="Amount, e.g. 38500"
                               min="0" step="0.01" value="{{ old('tuition_amount') }}">
                        <input type="text" class="form-input" id="courseCurrencyInput" name="tuition_currency" placeholder="USD"
                               maxlength="10" value="{{ old('tuition_currency') }}" style="text-transform: uppercase;">
                        <select class="form-select" id="coursePeriodSelect" name="tuition_period">
                            @foreach ($feePeriods as $period)
                                <option value="{{ $period }}" @selected(old('tuition_period', 'Year') === $period)>per {{ strtolower($period) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="courseDescInput">Description</label>
                    <textarea class="form-textarea" id="courseDescInput" name="description"
                              placeholder="What students will study and where it can lead...">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('addEditCourseModal')">Cancel</button>
                <button type="submit" class="btn-orange">Save Course</button>
            </div>
        </form>
    </div>
</div>

<!-- =====================================================
     MODAL 2: COURSE DETAILS
====================================================== -->
<div class="modal-backdrop" id="courseDetailsModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <div class="modal-title" id="detailCourseName"></div>
                <div class="modal-subtitle" id="detailCourseSubtitle"></div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('courseDetailsModal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" id="detailModalBodyContent"></div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" id="detailEditBtn">Edit Course</button>
            <button type="button" class="btn-orange" onclick="closeModal('courseDetailsModal')">Close</button>
        </div>
    </div>
</div>

<!-- =====================================================
     MODAL 3: DEACTIVATE CONFIRMATION
====================================================== -->
<div class="modal-backdrop" id="deleteCourseModal">
    <div class="modal-window" style="max-width: 440px;">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <div>
                    <div class="modal-title" style="color: #dc2626;">Deactivate Course</div>
                    <div class="modal-subtitle">The course will be hidden from the public website.</div>
                </div>
                <button type="button" class="modal-close-btn" onclick="closeModal('deleteCourseModal')">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 13px; color: #4b5565; line-height: 1.5;">
                    <strong id="deleteCourseName" style="color: #111827;"></strong> will be marked as inactive.
                    You can switch it back to Active later with Edit.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('deleteCourseModal')">Cancel</button>
                <button type="submit" class="btn-danger">Deactivate Course</button>
            </div>
        </form>
    </div>
</div>

<!-- TOAST NOTIFICATION -->
<div class="toast" id="toast">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
        <polyline points="20 6 9 17 4 12"/>
    </svg>
    <span id="toastMessage"></span>
</div>

<script>
    // Courses on this page, straight from the database.
    const courses = @json($coursesForJs);

    const coursesBaseUrl = @json(url('admin/courses'));
    const storeUrl = @json(route('admin.courses.store'));

    function findCourse(id) {
        return courses.find(c => c.id === id);
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.innerText = value ?? '';
        return div.innerHTML;
    }

    // ---- Search and filters (apply to the courses on this page) ----
    function applyFilters() {
        const query = document.getElementById('courseSearchInput').value.toLowerCase().trim();
        const level = document.getElementById('levelFilter').value;
        const university = document.getElementById('universityFilter').value;
        const mode = document.getElementById('modeFilter').value;
        const status = document.getElementById('statusFilter').value;
        let visibleRows = 0;

        document.querySelectorAll('.course-item').forEach(el => {
            const matches = (!query || el.dataset.search.includes(query))
                && (level === 'ALL' || el.dataset.level === level)
                && (university === 'ALL' || el.dataset.university === university)
                && (mode === 'ALL' || el.dataset.mode === mode)
                && (status === 'ALL' || el.dataset.status === status);
            el.style.display = matches ? '' : 'none';
            if (matches && el.tagName === 'TR') visibleRows++;
        });

        document.getElementById('noMatchRow').style.display =
            courses.length > 0 && visibleRows === 0 ? '' : 'none';
    }

    function switchView(mode) {
        const isTable = mode === 'table';
        document.getElementById('tableViewSection').style.display = isTable ? 'block' : 'none';
        document.getElementById('gridViewSection').style.display = isTable ? 'none' : 'grid';
        document.getElementById('tableViewBtn').classList.toggle('active', isTable);
        document.getElementById('gridViewBtn').classList.toggle('active', !isTable);
    }

    function exportCoursesCSV() {
        const q = v => '"' + String(v ?? '').replace(/"/g, '""') + '"';
        let csv = 'Course,University,Country,Level,Field,Duration,Study Mode,Tuition,Status\n';
        courses.forEach(c => {
            csv += [c.name, c.university, c.country, c.level, c.field, c.duration, c.mode,
                    c.feeText, c.active ? 'Active' : 'Inactive'].map(q).join(',') + '\n';
        });

        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = `INDIC_RMC_Courses_${new Date().toISOString().split('T')[0]}.csv`;
        link.click();
        showToast('Exported courses to CSV.');
    }

    // ---- Details ----
    function viewCourseDetails(id) {
        const c = findCourse(id);
        if (!c) return;

        document.getElementById('detailCourseName').innerText = c.name;
        document.getElementById('detailCourseSubtitle').innerText =
            [c.university, c.country].filter(Boolean).join(' • ');

        const row = (label, value) =>
            `<div class="detail-row"><span>${label}</span><strong>${escapeHtml(value || '—')}</strong></div>`;

        const intakes = c.intakes.length
            ? c.intakes.map(i => escapeHtml(i.name) + (i.status ? ` (${escapeHtml(i.status)})` : '')).join(', ')
            : 'None added yet';

        document.getElementById('detailModalBodyContent').innerHTML =
            row('Degree level', c.level) +
            row('Field of study', c.field) +
            row('Duration', c.duration) +
            row('Study mode', c.mode) +
            row('Tuition fee', c.feeText || 'Not set') +
            `<div class="detail-row"><span>Intakes</span><strong>${intakes}</strong></div>` +
            row('Status', c.active ? 'Active' : 'Inactive') +
            `<div style="font-size: 13px; color: #344054; line-height: 1.6; margin-top: 14px; white-space: pre-line;">${escapeHtml(c.description || 'No description yet.')}</div>`;

        document.getElementById('detailEditBtn').onclick = () => {
            closeModal('courseDetailsModal');
            openEditCourseModal(id);
        };

        openModal('courseDetailsModal');
    }

    // ---- Add / edit ----
    function clearFormErrors() {
        const box = document.querySelector('#courseForm .form-errors');
        if (box) box.remove();
    }

    function openAddCourseModal() {
        clearFormErrors();
        document.getElementById('courseForm').action = storeUrl;
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('courseIdField').value = '';
        document.getElementById('addEditModalTitle').innerText = 'Add New Course';

        ['courseNameInput', 'courseUniversitySelect', 'courseFieldInput', 'courseDurationInput',
         'courseTuitionInput', 'courseCurrencyInput', 'courseDescInput'].forEach(id => {
            document.getElementById(id).value = '';
        });
        document.getElementById('courseLevelSelect').value = 'Bachelor';
        document.getElementById('courseModeSelect').value = 'On Campus';
        document.getElementById('courseStatusSelect').value = '1';
        document.getElementById('coursePeriodSelect').value = 'Year';

        openModal('addEditCourseModal');
    }

    function setFormForEdit(id) {
        document.getElementById('courseForm').action = coursesBaseUrl + '/' + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('courseIdField').value = id;
        document.getElementById('addEditModalTitle').innerText = 'Edit Course';
    }

    function openEditCourseModal(id) {
        const c = findCourse(id);
        if (!c) return;

        clearFormErrors();
        setFormForEdit(id);
        document.getElementById('courseNameInput').value = c.name;
        document.getElementById('courseUniversitySelect').value = c.universityId;
        document.getElementById('courseLevelSelect').value = c.level;
        document.getElementById('courseFieldInput').value = c.field || '';
        document.getElementById('courseDurationInput').value = c.duration || '';
        document.getElementById('courseModeSelect').value = c.mode || 'On Campus';
        document.getElementById('courseStatusSelect').value = c.active ? '1' : '0';
        document.getElementById('courseTuitionInput').value = c.feeAmount ?? '';
        document.getElementById('courseCurrencyInput').value = c.feeCurrency || '';
        document.getElementById('coursePeriodSelect').value = c.feePeriod || 'Year';
        document.getElementById('courseDescInput').value = c.description || '';

        openModal('addEditCourseModal');
    }

    function openDeleteCourseModal(id) {
        const c = findCourse(id);
        if (!c) return;

        document.getElementById('deleteForm').action = coursesBaseUrl + '/' + id;
        document.getElementById('deleteCourseName').innerText = c.name;
        openModal('deleteCourseModal');
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
        ['courseSearchInput'].forEach(id => document.getElementById(id).addEventListener('input', applyFilters));
        ['levelFilter', 'universityFilter', 'modeFilter', 'statusFilter'].forEach(id =>
            document.getElementById(id).addEventListener('change', applyFilters));

        @if (session('success'))
            showToast(@json(session('success')));
        @endif

        // If saving failed validation, reopen the form with what was typed.
        @if ($errors->any())
            @if (old('edit_id'))
                setFormForEdit({{ (int) old('edit_id') }});
            @endif
            openModal('addEditCourseModal');
        @endif
    });
</script>

</body>
</html>