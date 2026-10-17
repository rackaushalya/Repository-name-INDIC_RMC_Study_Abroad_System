<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDIC RMC | Scholarship Management</title>

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
            .main { margin-left: 70px; }
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
        .detail-heading { font-size: 12px; font-weight: 700; color: #111827; margin: 16px 0 6px; }
        .detail-text { font-size: 13px; color: #344054; line-height: 1.6; white-space: pre-line; }
        .table-footer .portal-pager { width: 100%; }
        .amount-grid { display: grid; grid-template-columns: 1.3fr 1.6fr 1.2fr; gap: 10px; }
        @media (max-width: 750px) { .amount-grid { grid-template-columns: 1fr; } }
    </style>
@include('components.sidebar-style')
</head>
<body>

@php
    $allScholarships = $scholarships->getCollection();
    $allScholarships->loadMissing(['university.country', 'course']);
    $totalScholarships = $scholarships->total();

    $universityOptions = \App\Models\University::with('country')->orderBy('university_name')->get();
    $courseOptions = \App\Models\Course::orderBy('course_name')->get();

    $awardTypes = \App\Models\Scholarship::AWARD_TYPES;
    $popularCurrencies = \App\Support\CurrencyCodes::POPULAR;
    $allCurrencies = \App\Support\CurrencyCodes::ALL;

    // Award value shown to people, e.g. "USD 10,000 + 50% tuition" (see the Scholarship model).
    $awardText = fn ($s) => $s->award_text;

    // Award type chosen in the form: [badge CSS class, label].
    $coverage = fn ($s) => [$s->award_type_key, $s->award_type_label];

    // Deadline badge: Closed, Closing Soon (45 days) or Open.
    $deadlineState = function ($s) {
        if (!$s->application_deadline) return null;
        $days = now()->startOfDay()->diffInDays($s->application_deadline->copy()->startOfDay(), false);
        if ($days < 0) return 'closed';
        if ($days <= 45) return 'closing';
        return 'open';
    };

    $scholarshipsForJs = $allScholarships->map(function ($s) use ($awardText) {
        return [
            'id' => $s->scholarship_id,
            'name' => $s->scholarship_name,
            'universityId' => $s->university_id,
            'university' => $s->university?->university_name,
            'country' => $s->university?->country?->country_name,
            'courseId' => $s->course_id,
            'course' => $s->course?->course_name,
            'amount' => $s->amount !== null ? (float) $s->amount : null,
            'currency' => $s->currency,
            'percentage' => $s->percentage !== null ? (float) $s->percentage : null,
            'award' => $awardText($s),
            'awardType' => $s->award_type_label,
            'deadline' => $s->application_deadline?->format('Y-m-d'),
            'deadlineText' => $s->application_deadline?->format('d M Y'),
            'eligibility' => $s->eligibility,
            'description' => $s->description,
            'active' => (bool) $s->is_active,
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
                <input type="text" id="topbarSearchInput" placeholder="Quick search scholarships, universities...">
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

        <div class="content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <div>
                    <h1>
                        Scholarship Management
                        <span class="title-badge">{{ $totalScholarships }} {{ Str::plural('Scholarship', $totalScholarships) }}</span>
                    </h1>
                    <p>Manage scholarships, grants and tuition discounts offered to students.</p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="button" class="btn-secondary" onclick="exportScholarshipsCSV()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Export CSV
                    </button>
                    <button type="button" class="btn-orange" onclick="openAddScholarshipModal()">
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
                        <input type="text" id="scholarshipSearchInput" placeholder="Search by name, university, course or eligibility...">
                    </div>

                    <select class="filter-select" id="coverageFilter">
                        <option value="ALL">All Coverage Types</option>
                        <option value="full">Full Tuition</option>
                        <option value="partial">Partial Tuition</option>
                        <option value="grant">Cash Award</option>
                        <option value="stipend">Living Stipend</option>
                    </select>

                    <select class="filter-select" id="universityFilter">
                        <option value="ALL">All Universities</option>
                        <option value="NONE">Open to all universities</option>
                        @foreach ($universityOptions as $option)
                            <option value="{{ $option->university_id }}">{{ $option->university_name }}</option>
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
                                <th>Scholarship</th>
                                <th>University / Course</th>
                                <th>Award</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th style="text-align: right; width: 170px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allScholarships as $s)
                                @php
                                    [$coverageKey, $coverageLabel] = $coverage($s);
                                    $award = $awardText($s);
                                    $state = $deadlineState($s);
                                @endphp
                                <tr class="sch-item"
                                    data-search="{{ strtolower($s->scholarship_name . ' ' . $s->university?->university_name . ' ' . $s->course?->course_name . ' ' . $s->eligibility) }}"
                                    data-coverage="{{ $coverageKey }}"
                                    data-university="{{ $s->university_id ?? 'NONE' }}"
                                    data-status="{{ $s->is_active ? 'Active' : 'Inactive' }}">
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
                                                <div class="uni-name-text">{{ $s->scholarship_name }}</div>
                                                <div class="uni-meta-text">{{ Str::limit($s->eligibility ?: 'No eligibility details yet', 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="country-pill">
                                            <span>{{ $s->university?->university_name ?? 'Open to all universities' }}</span>
                                        </div>
                                        <div style="font-size: 10px; color: #8c96a8; margin-top: 2px;">
                                            {{ $s->course?->course_name ?? 'All courses' }}{{ $s->university?->country ? ' • ' . $s->university->country->country_name : '' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="coverage-pill {{ $coverageKey }}">{{ $coverageLabel }}</span>
                                        <div style="font-size: 11px; font-weight: 600; color: #111827; margin-top: 3px;">{{ $award ?? '—' }}</div>
                                    </td>
                                    <td style="font-size: 12px;">
                                        @if ($s->application_deadline)
                                            {{ $s->application_deadline->format('d M Y') }}
                                            @if ($state === 'closed')
                                                <span class="deadline-badge" style="background:#fef2f2; color:#b91c1c; border:1px solid #fecaca;">Closed</span>
                                            @elseif ($state === 'closing')
                                                <span class="deadline-badge closing">Closing Soon</span>
                                            @else
                                                <span class="deadline-badge open">Open</span>
                                            @endif
                                        @else
                                            <span style="color:#9ca3af;">No deadline</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $s->is_active ? 'active' : 'inactive' }}">
                                            {{ $s->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions-cell">
                                            <button type="button" class="btn-view-courses" onclick="viewScholarshipDetails({{ $s->scholarship_id }})" title="View details">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                                    <circle cx="12" cy="12" r="3"/>
                                                </svg>
                                                Details
                                            </button>
                                            <button type="button" class="btn-icon-action" onclick="openEditScholarshipModal({{ $s->scholarship_id }})" title="Edit scholarship">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </button>
                                            <button type="button" class="btn-icon-action delete" onclick="openDeleteScholarshipModal({{ $s->scholarship_id }})" title="Delete scholarship">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"/>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="empty-state">No scholarships yet. Click <strong>Add New Scholarship</strong> to create the first one.</td></tr>
                            @endforelse
                            <tr id="noMatchRow" style="display: none;"><td colspan="6" class="empty-state">No scholarships match your search or filters.</td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- GRID CARDS VIEW -->
                <div class="cards-grid" id="gridViewSection" style="display: none;">
                    @foreach ($allScholarships as $s)
                        @php
                            [$coverageKey, $coverageLabel] = $coverage($s);
                            $award = $awardText($s);
                        @endphp
                        <div class="uni-grid-card sch-item"
                             data-search="{{ strtolower($s->scholarship_name . ' ' . $s->university?->university_name . ' ' . $s->course?->course_name . ' ' . $s->eligibility) }}"
                             data-coverage="{{ $coverageKey }}"
                             data-university="{{ $s->university_id ?? 'NONE' }}"
                             data-status="{{ $s->is_active ? 'Active' : 'Inactive' }}">
                            <div class="card-top">
                                <span class="coverage-pill {{ $coverageKey }}">{{ $coverageLabel }}</span>
                                <span class="status-badge {{ $s->is_active ? 'active' : 'inactive' }}">{{ $s->is_active ? 'Active' : 'Inactive' }}</span>
                            </div>

                            <div style="font-size: 14px; font-weight: 700; color: #111827; line-height: 1.4;">{{ $s->scholarship_name }}</div>

                            <div style="font-size: 12px; color: #172033;">
                                <div style="font-weight: 600;">{{ $s->university?->university_name ?? 'Open to all universities' }}</div>
                                <div style="font-size: 10px; color: #8a93a3;">{{ $s->course?->course_name ?? 'All courses' }}</div>
                            </div>

                            <div class="card-metric-grid">
                                <div>
                                    <div class="card-metric-label">Award</div>
                                    <div class="card-metric-val">{{ $award ?? '—' }}</div>
                                </div>
                                <div>
                                    <div class="card-metric-label">Deadline</div>
                                    <div class="card-metric-val">{{ $s->application_deadline?->format('d M Y') ?? 'None' }}</div>
                                </div>
                            </div>

                            <div class="card-actions">
                                <button type="button" class="btn-view-courses" onclick="viewScholarshipDetails({{ $s->scholarship_id }})" style="margin-right: auto;">Details</button>
                                <button type="button" class="btn-icon-action" onclick="openEditScholarshipModal({{ $s->scholarship_id }})" title="Edit scholarship">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button type="button" class="btn-icon-action delete" onclick="openDeleteScholarshipModal({{ $s->scholarship_id }})" title="Delete scholarship">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- TABLE FOOTER -->
                <div class="table-footer">
                    @if ($scholarships->hasPages())
                        {{ $scholarships->links('pagination.portal') }}
                    @else
                        <div>Showing {{ $totalScholarships }} {{ Str::plural('scholarship', $totalScholarships) }}</div>
                        <div>Click <strong>Details</strong> to see eligibility and the full description.</div>
                    @endif
                </div>
            </div>

        </div>

        <footer class="footer">
            <div>&copy; 2026 INDIC RMC Study Abroad Platform. All rights reserved.</div>
        </footer>

    </main>

</div>

<!-- =====================================================
     MODAL 1: ADD / EDIT SCHOLARSHIP (saves to the database)
====================================================== -->
<div class="modal-backdrop" id="addEditScholarshipModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <div class="modal-title" id="addEditModalTitle">Add New Scholarship</div>
                <div class="modal-subtitle">Add a scholarship, grant or tuition discount for students.</div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('addEditScholarshipModal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <form id="scholarshipForm" method="POST" action="{{ route('admin.scholarships.store') }}">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="edit_id" id="scholarshipIdField" value="{{ old('edit_id') }}">
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
                    <label class="form-label" for="scholarshipNameInput">Scholarship Name *</label>
                    <input type="text" class="form-input" id="scholarshipNameInput" name="scholarship_name"
                           placeholder="e.g. International Merit Scholarship" maxlength="255" required value="{{ old('scholarship_name') }}">
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="scholarshipUniversitySelect">University</label>
                        <select class="form-select" id="scholarshipUniversitySelect" name="university_id" onchange="filterCourseOptions()">
                            <option value="">Open to all universities</option>
                            @foreach ($universityOptions as $option)
                                <option value="{{ $option->university_id }}" @selected(old('university_id') == $option->university_id)>
                                    {{ $option->university_name }}{{ $option->country ? ' (' . $option->country->country_name . ')' : '' }}{{ $option->is_active ? '' : ' – inactive' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="scholarshipCourseSelect">Course</label>
                        <select class="form-select" id="scholarshipCourseSelect" name="course_id">
                            <option value="">All courses</option>
                            @foreach ($courseOptions as $option)
                                <option value="{{ $option->course_id }}" data-university="{{ $option->university_id }}" @selected(old('course_id') == $option->course_id)>
                                    {{ $option->course_name }}{{ $option->is_active ? '' : ' – inactive' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 14px;">
                    <label class="form-label" for="scholarshipAwardTypeSelect">Award Type *</label>
                    <select class="form-select" id="scholarshipAwardTypeSelect" name="award_type" required>
                        <option value="">Choose the type of award...</option>
                        @foreach ($awardTypes as $typeLabel => $typeKey)
                            <option value="{{ $typeLabel }}" @selected(old('award_type') === $typeLabel)>{{ $typeLabel }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 14px;">
                    <label class="form-label">Award Value (optional)</label>
                    <div class="amount-grid">
                        <input type="number" class="form-input" id="scholarshipAmountInput" name="amount" placeholder="Amount, e.g. 10000"
                               min="0" step="0.01" value="{{ old('amount') }}">
                        <select class="form-select" id="scholarshipCurrencyInput" name="currency">
                            <option value="">Currency...</option>
                            <optgroup label="Common">
                                @foreach ($popularCurrencies as $code)
                                    <option value="{{ $code }}" @selected(old('currency') === $code)>{{ $code }} – {{ $allCurrencies[$code] }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="All currencies">
                                @foreach ($allCurrencies as $code => $currencyName)
                                    @continue(in_array($code, $popularCurrencies, true))
                                    <option value="{{ $code }}" @selected(old('currency') === $code)>{{ $code }} – {{ $currencyName }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <input type="number" class="form-input" id="scholarshipPercentInput" name="percentage" placeholder="Tuition % (e.g. 50)"
                               min="0" max="100" step="0.01" value="{{ old('percentage') }}">
                    </div>
                    <div style="font-size: 11px; color: #697386; margin-top: 4px;">
                        Fill in a money amount, a percentage of tuition, or both. The award type above is what students see as the label.
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="scholarshipDeadlineInput">Application Deadline</label>
                        <input type="date" class="form-input" id="scholarshipDeadlineInput" name="application_deadline" value="{{ old('application_deadline') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="scholarshipStatusSelect">Status *</label>
                        <select class="form-select" id="scholarshipStatusSelect" name="is_active" required>
                            <option value="1" @selected(old('is_active', '1') == '1')>Active</option>
                            <option value="0" @selected(old('is_active') === '0')>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 14px;">
                    <label class="form-label" for="scholarshipEligibilityInput">Eligibility</label>
                    <textarea class="form-textarea" id="scholarshipEligibilityInput" name="eligibility"
                              placeholder="Who can apply: grades, English scores, nationality...">{{ old('eligibility') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="scholarshipDescInput">Description</label>
                    <textarea class="form-textarea" id="scholarshipDescInput" name="description"
                              placeholder="What the scholarship covers and how to apply...">{{ old('description') }}</textarea>
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
     MODAL 2: SCHOLARSHIP DETAILS
====================================================== -->
<div class="modal-backdrop" id="scholarshipDetailsModal">
    <div class="modal-window">
        <div class="modal-header">
            <div>
                <div class="modal-title" id="detailScholarshipName"></div>
                <div class="modal-subtitle" id="detailScholarshipSubtitle"></div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('scholarshipDetailsModal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" id="detailModalBodyContent"></div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" id="detailEditBtn">Edit Scholarship</button>
            <button type="button" class="btn-orange" onclick="closeModal('scholarshipDetailsModal')">Close</button>
        </div>
    </div>
</div>

<!-- =====================================================
     MODAL 3: DEACTIVATE CONFIRMATION
====================================================== -->
<div class="modal-backdrop" id="deleteScholarshipModal">
    <div class="modal-window" style="max-width: 440px;">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <div>
                    <div class="modal-title" style="color: #dc2626;">Delete Scholarship</div>
                    <div class="modal-subtitle">This permanently removes it and cannot be undone.</div>
                </div>
                <button type="button" class="modal-close-btn" onclick="closeModal('deleteScholarshipModal')">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 13px; color: #4b5565; line-height: 1.5;">
                    Are you sure you want to delete <strong id="deleteScholarshipName" style="color: #111827;"></strong>?
                    If you only want to hide it from students, click Cancel and set its Status to Inactive with Edit instead.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('deleteScholarshipModal')">Cancel</button>
                <button type="submit" class="btn-danger">Delete Permanently</button>
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
    // Scholarships on this page, straight from the database.
    const scholarships = @json($scholarshipsForJs);

    const scholarshipsBaseUrl = @json(url('admin/scholarships'));
    const storeUrl = @json(route('admin.scholarships.store'));

    function findScholarship(id) {
        return scholarships.find(s => s.id === id);
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.innerText = value ?? '';
        return div.innerHTML;
    }

    // ---- Search and filters (apply to the scholarships on this page) ----
    function applyFilters() {
        const query = document.getElementById('scholarshipSearchInput').value.toLowerCase().trim();
        const coverage = document.getElementById('coverageFilter').value;
        const university = document.getElementById('universityFilter').value;
        const status = document.getElementById('statusFilter').value;
        let visibleRows = 0;

        document.querySelectorAll('.sch-item').forEach(el => {
            const matches = (!query || el.dataset.search.includes(query))
                && (coverage === 'ALL' || el.dataset.coverage === coverage)
                && (university === 'ALL' || el.dataset.university === university)
                && (status === 'ALL' || el.dataset.status === status);
            el.style.display = matches ? '' : 'none';
            if (matches && el.tagName === 'TR') visibleRows++;
        });

        document.getElementById('noMatchRow').style.display =
            scholarships.length > 0 && visibleRows === 0 ? '' : 'none';
    }

    function switchView(mode) {
        const isTable = mode === 'table';
        document.getElementById('tableViewSection').style.display = isTable ? 'block' : 'none';
        document.getElementById('gridViewSection').style.display = isTable ? 'none' : 'grid';
        document.getElementById('tableViewBtn').classList.toggle('active', isTable);
        document.getElementById('gridViewBtn').classList.toggle('active', !isTable);
    }

    function exportScholarshipsCSV() {
        const q = v => '"' + String(v ?? '').replace(/"/g, '""') + '"';
        let csv = 'Scholarship,University,Course,Award Type,Award Value,Deadline,Eligibility,Status\n';
        scholarships.forEach(s => {
            csv += [s.name, s.university || 'All universities', s.course || 'All courses', s.awardType, s.award,
                    s.deadline, s.eligibility, s.active ? 'Active' : 'Inactive'].map(q).join(',') + '\n';
        });

        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = `INDIC_RMC_Scholarships_${new Date().toISOString().split('T')[0]}.csv`;
        link.click();
        showToast('Exported scholarships to CSV.');
    }

    // ---- Details ----
    function viewScholarshipDetails(id) {
        const s = findScholarship(id);
        if (!s) return;

        document.getElementById('detailScholarshipName').innerText = s.name;
        document.getElementById('detailScholarshipSubtitle').innerText =
            [s.university || 'Open to all universities', s.country].filter(Boolean).join(' • ');

        const row = (label, value) =>
            `<div class="detail-row"><span>${label}</span><strong>${escapeHtml(value || '—')}</strong></div>`;

        document.getElementById('detailModalBodyContent').innerHTML =
            row('Course', s.course || 'All courses') +
            row('Award type', s.awardType) +
            row('Award value', s.award || 'Not set') +
            row('Application deadline', s.deadlineText || 'No deadline') +
            row('Status', s.active ? 'Active' : 'Inactive') +
            `<div class="detail-heading">Eligibility</div><div class="detail-text">${escapeHtml(s.eligibility || 'No eligibility details yet.')}</div>` +
            `<div class="detail-heading">Description</div><div class="detail-text">${escapeHtml(s.description || 'No description yet.')}</div>`;

        document.getElementById('detailEditBtn').onclick = () => {
            closeModal('scholarshipDetailsModal');
            openEditScholarshipModal(id);
        };

        openModal('scholarshipDetailsModal');
    }

    // ---- Only show courses from the chosen university ----
    function filterCourseOptions() {
        const universityId = document.getElementById('scholarshipUniversitySelect').value;
        const courseSelect = document.getElementById('scholarshipCourseSelect');

        Array.from(courseSelect.options).forEach(option => {
            if (!option.value) return; // "All courses"
            const show = !universityId || option.dataset.university === universityId;
            option.hidden = !show;
            option.disabled = !show;
        });

        const selected = courseSelect.selectedOptions[0];
        if (selected && selected.disabled) {
            courseSelect.value = '';
        }
    }

    // ---- Add / edit ----
    function clearFormErrors() {
        const box = document.querySelector('#scholarshipForm .form-errors');
        if (box) box.remove();
    }

    function openAddScholarshipModal() {
        clearFormErrors();
        document.getElementById('scholarshipForm').action = storeUrl;
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('scholarshipIdField').value = '';
        document.getElementById('addEditModalTitle').innerText = 'Add New Scholarship';

        ['scholarshipNameInput', 'scholarshipUniversitySelect', 'scholarshipCourseSelect', 'scholarshipAmountInput',
         'scholarshipCurrencyInput', 'scholarshipPercentInput', 'scholarshipDeadlineInput',
         'scholarshipEligibilityInput', 'scholarshipDescInput'].forEach(id => {
            document.getElementById(id).value = '';
        });
        document.getElementById('scholarshipStatusSelect').value = '1';
        document.getElementById('scholarshipAwardTypeSelect').value = '';

        filterCourseOptions();
        openModal('addEditScholarshipModal');
    }

    function setFormForEdit(id) {
        document.getElementById('scholarshipForm').action = scholarshipsBaseUrl + '/' + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('scholarshipIdField').value = id;
        document.getElementById('addEditModalTitle').innerText = 'Edit Scholarship';
    }

    function openEditScholarshipModal(id) {
        const s = findScholarship(id);
        if (!s) return;

        clearFormErrors();
        setFormForEdit(id);
        document.getElementById('scholarshipNameInput').value = s.name;
        document.getElementById('scholarshipAwardTypeSelect').value = s.awardType || '';
        document.getElementById('scholarshipUniversitySelect').value = s.universityId || '';
        filterCourseOptions();
        document.getElementById('scholarshipCourseSelect').value = s.courseId || '';
        document.getElementById('scholarshipAmountInput').value = s.amount ?? '';
        // Older invalid codes (e.g. "5657786") leave the menu empty so a real currency must be chosen.
        const currencySelect = document.getElementById('scholarshipCurrencyInput');
        const savedCurrency = (s.currency || '').toUpperCase();
        currencySelect.value = Array.from(currencySelect.options).some(o => o.value === savedCurrency) ? savedCurrency : '';
        document.getElementById('scholarshipPercentInput').value = s.percentage ?? '';
        document.getElementById('scholarshipDeadlineInput').value = s.deadline || '';
        document.getElementById('scholarshipStatusSelect').value = s.active ? '1' : '0';
        document.getElementById('scholarshipEligibilityInput').value = s.eligibility || '';
        document.getElementById('scholarshipDescInput').value = s.description || '';

        openModal('addEditScholarshipModal');
    }

    function openDeleteScholarshipModal(id) {
        const s = findScholarship(id);
        if (!s) return;

        document.getElementById('deleteForm').action = scholarshipsBaseUrl + '/' + id;
        document.getElementById('deleteScholarshipName').innerText = s.name;
        openModal('deleteScholarshipModal');
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
        document.getElementById('scholarshipSearchInput').addEventListener('input', applyFilters);
        ['coverageFilter', 'universityFilter', 'statusFilter'].forEach(id =>
            document.getElementById(id).addEventListener('change', applyFilters));

        @if (session('success'))
            showToast(@json(session('success')));
        @endif

        // If saving failed validation, reopen the form with what was typed.
        @if ($errors->any())
            @if (old('edit_id'))
                setFormForEdit({{ (int) old('edit_id') }});
            @endif
            filterCourseOptions();
            document.getElementById('scholarshipCourseSelect').value = @json((string) old('course_id', ''));
            openModal('addEditScholarshipModal');
        @endif
    });
</script>

</body>
</html>