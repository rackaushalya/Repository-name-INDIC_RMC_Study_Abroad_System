{{--
    Shared sidebar design for the student and admin portals.

    Include this LAST inside <head> of every page that uses the sidebar:
        @include('components.sidebar-style')

    The markup lives in components/student-sidebar.blade.php and
    components/admin-sidebar.blade.php. The page content must sit inside
    <div class="main"> so it is offset by the sidebar width.
--}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script>
    try {
        if (localStorage.getItem('sidebarCollapsed') === '1') {
            document.documentElement.classList.add('sidebar-collapsed');
        }
    } catch (e) {}
</script>

<style>

    /* =========================
       SIDEBAR
    ========================= */

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: auto;
        display: block;
        width: 245px;
        height: 100vh;
        background: #101a2b;
        color: white;
        padding: 28px 0;
        overflow-y: auto;
        overflow-x: hidden;
        border-radius: 0 45px 45px 0;
        box-shadow: 4px 0 18px rgba(16, 26, 43, 0.12);
        z-index: 20;
        transition: width 0.3s ease;
        font-family: Arial, Helvetica, sans-serif;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .sidebar::-webkit-scrollbar {
        display: none;
    }

    .sidebar *,
    .sidebar *::before,
    .sidebar *::after {
        box-sizing: border-box;
    }

    .sidebar a {
        text-decoration: none;
    }

    .sidebar .logo {
        padding: 0 28px 24px;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        text-align: left;
    }

    .sidebar .logo-main {
        font-size: 25px;
        font-weight: 700;
        color: #f97316;
        white-space: nowrap;
    }

    .sidebar .logo-main span {
        color: white;
    }

    .sidebar .logo-subtitle {
        font-size: 8px;
        letter-spacing: 0.8px;
        color: #aeb7c7;
        margin-top: 4px;
    }

    .sidebar .menu-section {
        margin-bottom: 25px;
    }

    .sidebar .menu-title {
        color: #7e8ba1;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0 28px 10px;
    }

    .sidebar .menu-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 13px 20px 13px 28px;
        margin: 0 14px 6px 0;
        border-radius: 0 30px 30px 0;
        color: #cbd3df;
        font-size: 14px;
        line-height: normal;
        transition: 0.2s;
    }

    .sidebar .menu-item:hover {
        background: #1d2a40;
        color: white;
    }

    .sidebar .menu-item.active {
        background: #f97316;
        color: white;
    }

    .sidebar .menu-item .menu-label {
        white-space: nowrap;
    }

    .sidebar .menu-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .sidebar .menu-button {
        width: calc(100% - 14px);
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
        font-family: inherit;
    }


    /* TOGGLE ARROW */

    .sidebar-toggle {
        position: fixed;
        top: 122px;
        left: 229px;
        width: 30px;
        height: 30px;
        padding: 0;
        border: none;
        border-radius: 50%;
        background: #f97316;
        color: white;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 30;
        box-shadow: 0 3px 10px rgba(249, 115, 22, 0.45);
        transition: left 0.3s ease, transform 0.2s ease;
    }

    .sidebar-toggle:hover {
        transform: scale(1.12);
    }

    .sidebar-toggle i {
        transition: transform 0.3s ease;
    }


    /* =========================
       MAIN (offset by sidebar)
    ========================= */

    .main {
        margin-left: 245px;
        width: calc(100% - 245px);
        min-height: 100vh;
        transition: margin-left 0.3s ease, width 0.3s ease;
    }


    /* =========================
       COLLAPSED
    ========================= */

    .sidebar-collapsed .sidebar {
        width: 84px;
        border-radius: 0 32px 32px 0;
    }

    .sidebar-collapsed .sidebar .logo-subtitle,
    .sidebar-collapsed .sidebar .logo-main span,
    .sidebar-collapsed .sidebar .menu-title,
    .sidebar-collapsed .sidebar .menu-label {
        display: none;
    }

    .sidebar-collapsed .sidebar .logo {
        text-align: center;
        padding: 0 0 20px;
    }

    .sidebar-collapsed .sidebar .logo-main {
        font-size: 17px;
    }

    .sidebar-collapsed .sidebar .menu-item {
        justify-content: center;
        padding: 13px 0;
        margin-right: 10px;
    }

    .sidebar-collapsed .sidebar .menu-button {
        width: calc(100% - 10px);
    }

    .sidebar-collapsed .main {
        margin-left: 84px;
        width: calc(100% - 84px);
    }

    .sidebar-collapsed .sidebar-toggle {
        left: 68px;
    }

    .sidebar-collapsed .sidebar-toggle i {
        transform: rotate(180deg);
    }


    /* =========================
       SMALL SCREENS (always icons only)
    ========================= */

    @media (max-width: 900px) {

        .sidebar-toggle {
            display: none;
        }

        .sidebar,
        .sidebar-collapsed .sidebar {
            display: block;
            width: 70px;
            border-radius: 0 28px 28px 0;
        }

        .sidebar .logo-subtitle,
        .sidebar .logo-main span,
        .sidebar .menu-title,
        .sidebar .menu-label {
            display: none;
        }

        .sidebar .logo {
            text-align: center;
            padding: 0 0 20px;
        }

        .sidebar .logo-main {
            font-size: 17px;
        }

        .sidebar .menu-item {
            justify-content: center;
            padding: 13px 0;
            margin-right: 8px;
        }

        .sidebar .menu-button {
            width: calc(100% - 8px);
        }

        .main,
        .sidebar-collapsed .main {
            margin-left: 70px;
            width: calc(100% - 70px);
        }

    }

</style>
