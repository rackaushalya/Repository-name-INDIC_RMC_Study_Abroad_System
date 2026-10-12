{{--
    Shared page design for the fund requirement, audit log and application
    pages (student + admin). Include inside <head>, BEFORE sidebar-style:

        @include('components.page-style')
        @include('components.sidebar-style')

    Pair it with components/student-topbar or components/admin-topbar and put
    the page body inside <section class="pg"> within <main class="main">.
--}}

<style>

    * { box-sizing: border-box; }

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: #f5f7fb;
        color: #172033;
    }

    a { text-decoration: none; }

    /* ---------- topbar ---------- */

    .pg-topbar {
        height: 72px;
        padding: 0 30px;
        background: #fff;
        border-bottom: 1px solid #e6e9ef;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .pg-crumbs {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #8a94a6;
        min-width: 0;
    }

    .pg-crumbs a { color: #8a94a6; }
    .pg-crumbs a:hover { color: #f97316; }
    .pg-crumbs strong { color: #172033; font-weight: 600; white-space: nowrap; }

    .pg-user {
        display: flex;
        align-items: center;
        gap: 10px;
        color: inherit;
    }

    .pg-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #f97316;
        color: #fff;
        display: grid;
        place-items: center;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }

    .pg-user-text strong { display: block; font-size: 13px; }
    .pg-user-text span { display: block; font-size: 11px; color: #8a94a6; margin-top: 2px; }

    /* ---------- page ---------- */

    .pg { max-width: 1400px; margin: 0 auto; padding: 30px; }

    .pg-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .pg-head h1 { font-size: 26px; margin: 0 0 6px; letter-spacing: -.3px; }
    .pg-head p { margin: 0; font-size: 13px; color: #727c8d; line-height: 1.5; }

    .pg-actions { display: flex; gap: 10px; flex-wrap: wrap; }

    /* ---------- buttons ---------- */

    .pg-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 16px;
        border: 1px solid #e1e5ed;
        border-radius: 8px;
        background: #fff;
        color: #374151;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .15s;
    }

    .pg-btn:hover { border-color: #fdba74; color: #f97316; }

    .pg-btn-primary { background: #f97316; border-color: #f97316; color: #fff; }
    .pg-btn-primary:hover { background: #ea580c; border-color: #ea580c; color: #fff; }

    .pg-btn-dark { background: #101a2b; border-color: #101a2b; color: #fff; }
    .pg-btn-dark:hover { background: #1d2a40; border-color: #1d2a40; color: #fff; }

    .pg-btn-sm { padding: 7px 12px; font-size: 12px; }

    .pg-icon-btn {
        width: 34px;
        height: 34px;
        display: inline-grid;
        place-items: center;
        border: 1px solid #e1e5ed;
        border-radius: 8px;
        background: #fff;
        color: #374151;
        cursor: pointer;
        transition: .15s;
    }

    .pg-icon-btn:hover { color: #f97316; border-color: #fdba74; background: #fff7f1; }
    .pg-icon-btn.danger { color: #dc2626; }
    .pg-icon-btn.danger:hover { background: #fef2f2; border-color: #fecaca; color: #dc2626; }

    /* ---------- alerts ---------- */

    .pg-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .pg-alert.success { background: #ecfdf3; color: #166534; border: 1px solid #bbf7d0; }
    .pg-alert.error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    /* ---------- stat cards ---------- */

    .pg-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 16px;
        margin-bottom: 22px;
    }

    .pg-stat {
        background: #fff;
        border: 1px solid #e7eaf0;
        border-radius: 14px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .pg-stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: #fff1e8;
        color: #f97316;
        display: grid;
        place-items: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .pg-stat-icon.blue { background: #e8f1ff; color: #2767b1; }
    .pg-stat-icon.green { background: #e7f7ed; color: #198754; }
    .pg-stat-icon.navy { background: #e9edf5; color: #101a2b; }

    .pg-stat span { display: block; font-size: 12px; color: #727c8d; margin-bottom: 4px; }
    .pg-stat strong { display: block; font-size: 21px; overflow-wrap: anywhere; }

    /* ---------- cards ---------- */

    .pg-card {
        background: #fff;
        border: 1px solid #e7eaf0;
        border-radius: 14px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .pg-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        padding: 18px 22px;
        border-bottom: 1px solid #eef0f4;
    }

    .pg-card-head h2 {
        margin: 0;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .pg-card-head h2 i { color: #f97316; }
    .pg-card-head small { color: #8a94a6; font-size: 12px; }
    .pg-card-body { padding: 22px; }
    .pg-card-desc { margin: -4px 0 20px; font-size: 12px; color: #788294; line-height: 1.6; }

    /* ---------- toolbar / filters ---------- */

    .pg-toolbar {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        padding: 16px 22px;
        border-bottom: 1px solid #eef0f4;
        background: #fcfcfd;
    }

    .pg-search { position: relative; flex: 1 1 260px; min-width: 200px; }
    .pg-search i { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: #8a94a6; }

    .pg-search input,
    .pg-field,
    .pg-toolbar select,
    .pg-toolbar input[type="date"] {
        width: 100%;
        padding: 10px 13px;
        border: 1px solid #dce1e9;
        border-radius: 8px;
        background: #fff;
        color: #172033;
        font-family: inherit;
        font-size: 13px;
    }

    .pg-search input { padding-left: 38px; }
    .pg-toolbar select, .pg-toolbar input[type="date"] { width: auto; }

    .pg-search input:focus,
    .pg-field:focus,
    .pg-toolbar select:focus,
    .pg-toolbar input[type="date"]:focus {
        outline: none;
        border-color: #f97316;
        box-shadow: 0 0 0 3px rgba(249, 115, 22, .12);
    }

    /* status chips */

    .pg-chips { display: flex; gap: 8px; flex-wrap: wrap; padding: 14px 22px; border-bottom: 1px solid #eef0f4; }

    .pg-chip {
        padding: 6px 12px;
        border-radius: 20px;
        border: 1px solid #e1e5ed;
        background: #fff;
        color: #566176;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .pg-chip b { margin-left: 4px; color: #8a94a6; font-weight: 600; }
    .pg-chip:hover { border-color: #fdba74; color: #f97316; }
    .pg-chip.active { background: #f97316; border-color: #f97316; color: #fff; }
    .pg-chip.active b { color: #ffe7d3; }

    /* ---------- table ---------- */

    .pg-table-wrap { overflow-x: auto; }

    .pg-table { width: 100%; border-collapse: collapse; min-width: 760px; }

    .pg-table th {
        text-align: left;
        padding: 13px 18px;
        background: #fafbfc;
        color: #727c8d;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        white-space: nowrap;
        border-bottom: 1px solid #eef0f4;
    }

    .pg-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #eef0f4;
        font-size: 13px;
        vertical-align: middle;
    }

    .pg-table tbody tr:hover { background: #fffaf6; }
    .pg-table tbody tr:last-child td { border-bottom: 0; }

    .pg-strong { font-weight: 700; }
    .pg-muted { color: #8791a1; font-size: 12px; }
    .pg-sub { display: block; margin-top: 3px; color: #8791a1; font-size: 11px; }
    .pg-amount { font-weight: 700; white-space: nowrap; }
    .pg-row-actions { display: flex; gap: 8px; align-items: center; }
    .pg-row-actions form { margin: 0; }

    .pg-person { display: flex; align-items: center; gap: 11px; }

    .pg-person-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #fff1e8;
        color: #f97316;
        display: grid;
        place-items: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .pg-pagination { padding: 16px 22px; border-top: 1px solid #eef0f4; }
    .pg-pagination nav { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
    .pg-pagination svg { width: 18px; height: 18px; }
    .pg-pagination p { margin: 0; font-size: 12px; color: #727c8d; }

    /* ---------- badges ---------- */

    .pg-badge {
        display: inline-block;
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        background: #f0f2f5;
        color: #596579;
    }

    .pg-badge.blue { background: #e8f1ff; color: #2767b1; }
    .pg-badge.amber { background: #fff3df; color: #c46b00; }
    .pg-badge.green { background: #e7f7ed; color: #198754; }
    .pg-badge.red { background: #fde8e8; color: #c62828; }
    .pg-badge.purple { background: #f1e9ff; color: #6b3fc4; }
    .pg-badge.orange { background: #fff1e8; color: #d9560a; }
    .pg-badge.grey { background: #eeeeee; color: #666; }

    /* ---------- empty ---------- */

    .pg-empty { text-align: center; padding: 60px 20px; }

    .pg-empty-icon {
        width: 66px;
        height: 66px;
        border-radius: 50%;
        background: #fff1e8;
        color: #f97316;
        display: grid;
        place-items: center;
        font-size: 26px;
        margin: 0 auto 16px;
    }

    .pg-empty h3 { margin: 0 0 8px; font-size: 18px; }
    .pg-empty p { margin: 0 0 20px; font-size: 13px; color: #727c8d; line-height: 1.6; }

    /* ---------- forms ---------- */

    .pg-form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
    .pg-group { display: flex; flex-direction: column; gap: 7px; }
    .pg-group.full { grid-column: 1 / -1; }
    .pg-group label { font-size: 12px; font-weight: 700; color: #374151; }
    .pg-hint { font-size: 11px; color: #8791a1; line-height: 1.5; }
    .pg-error { font-size: 11px; color: #dc2626; }
    textarea.pg-field { resize: vertical; }

    .pg-input-money { position: relative; }
    .pg-input-money span {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        font-weight: 700;
        color: #8a94a6;
        pointer-events: none;
    }
    .pg-input-money .pg-field { padding-left: 52px; }

    /* ---------- detail grid ---------- */

    .pg-detail-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 22px; }
    .pg-detail-label { display: block; font-size: 11px; color: #7b8494; margin-bottom: 6px; text-transform: uppercase; letter-spacing: .4px; }
    .pg-detail-value { font-size: 14px; font-weight: 600; overflow-wrap: anywhere; }

    /* ---------- responsive ---------- */

    @media (max-width: 900px) {
        .pg-detail-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 650px) {
        .pg { padding: 20px 15px; }
        .pg-topbar { padding: 0 15px; }
        .pg-user-text { display: none; }
        .pg-form-grid, .pg-detail-grid { grid-template-columns: 1fr; }
        .pg-head h1 { font-size: 22px; }
        .pg-card-body { padding: 18px; }
    }

    @media print {
        .sidebar, .sidebar-toggle, .pg-topbar, .pg-actions, .no-print { display: none !important; }
        .main { margin: 0 !important; width: 100% !important; }
        body { background: #fff; }
        .pg-card { break-inside: avoid; }
    }

</style>
