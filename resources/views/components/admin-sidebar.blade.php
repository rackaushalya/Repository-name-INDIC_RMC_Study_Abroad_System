{{-- Admin portal sidebar. The active item is detected from the current URL. --}}

<aside class="sidebar">

    <div class="logo">
        <div class="logo-main">INDIC <span>RMC</span></div>
        <div class="logo-subtitle">ADMINISTRATION PORTAL</div>
    </div>


    <div class="menu-section">

        <div class="menu-title">OVERVIEW</div>

        <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></div>
            <span class="menu-label">Dashboard</span>
        </a>

    </div>


    <div class="menu-section">

        <div class="menu-title">MANAGEMENT</div>

        <a href="{{ route('admin.users') }}" class="menu-item {{ request()->is('admin/users*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-people-fill"></i></div>
            <span class="menu-label">Users</span>
        </a>

        <a href="{{ route('admin.students') }}" class="menu-item {{ request()->is('admin/students*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-person-fill"></i></div>
            <span class="menu-label">Students</span>
        </a>

        <a href="{{ route('admin.consultants') }}" class="menu-item {{ request()->is('admin/consultants*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-person-badge-fill"></i></div>
            <span class="menu-label">Consultants</span>
        </a>

        <a href="{{ route('admin.applications-list') }}" class="menu-item {{ request()->is('admin/applications-list*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
            <span class="menu-label">Applications</span>
        </a>

        <a href="{{ route('admin.appointments-list') }}" class="menu-item {{ request()->is('admin/appointments*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-calendar2-check-fill"></i></div>
            <span class="menu-label">Appointments</span>
        </a>

    </div>


    <div class="menu-section">

        <div class="menu-title">STUDY ABROAD</div>

        <a href="{{ route('admin.countries-list') }}" class="menu-item {{ request()->is('admin/countries*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-globe-americas"></i></div>
            <span class="menu-label">Countries</span>
        </a>

        <a href="{{ route('admin.universities-list') }}" class="menu-item {{ request()->is('admin/universities*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-bank"></i></div>
            <span class="menu-label">Universities</span>
        </a>

        <a href="{{ route('admin.courses-list') }}" class="menu-item {{ request()->is('admin/courses*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <span class="menu-label">Courses</span>
        </a>

    </div>


    <div class="menu-section">

        <div class="menu-title">SYSTEM</div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-item menu-button">
                <div class="menu-icon"><i class="bi bi-box-arrow-right"></i></div>
                <span class="menu-label">Logout</span>
            </button>
        </form>

    </div>

</aside>

@include('components.sidebar-toggle')
