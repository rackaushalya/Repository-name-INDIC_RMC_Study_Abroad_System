<aside class="sidebar">

    <div class="brand">
        <div class="brand-mark">IR</div>
        <div>
            <div class="brand-name">INDIC RMC</div>
            <div class="brand-subtitle">Consultant Portal</div>
        </div>
    </div>

    <nav class="nav">

        <div class="nav-section">Overview</div>
            <a href="{{ route('consultant.dashboard') }}"
               class="nav-link {{ request()->routeIs('consultant.dashboard') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                <span>Dashboard</span>
            </a>

        <div class="nav-section">Students</div>
            <a href="{{ route('consultant.students') }}"
               class="nav-link {{ request()->routeIs('consultant.students*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8" r="4"/><path d="M2 21a7 7 0 0 1 14 0"/><path d="M17 11a4 4 0 1 0 0-6"/><path d="M22 21a6 6 0 0 0-5-5.9"/></svg>
                <span>Assigned Students</span>
            </a>

        <div class="nav-section">Schedule</div>
            <a href="{{ route('consultant.appointments') }}"
               class="nav-link {{ request()->routeIs('consultant.appointments*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
                <span>Appointments</span>
            </a>
            <a href="{{ route('consultant.calendar') }}"
               class="nav-link {{ request()->routeIs('consultant.calendar') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/><path d="M8 14h2"/><path d="M14 14h2"/><path d="M8 18h2"/></svg>
                <span>Calendar</span>
            </a>

        <div class="nav-section">Consultation</div>
            <a href="{{ route('consultant.consultations') }}"
               class="nav-link {{ request()->routeIs('consultant.consultations*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 8h8"/><path d="M8 12h8"/><path d="M8 16h5"/></svg>
                <span>Consultations</span>
            </a>

        <div class="nav-section">Account</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link" style="width:100%;border:0;background:transparent;cursor:pointer;font-family:inherit;">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/><path d="M21 4v16"/></svg>
                <span>Logout</span>
            </button>
        </form>

    </nav>
</aside>
