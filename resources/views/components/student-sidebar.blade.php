{{-- Student portal sidebar. The active item is detected from the current route. --}}

<aside class="sidebar">

    <div class="logo">
        <div class="logo-main">INDIC <span>RMC</span></div>
        <div class="logo-subtitle">STUDY ABROAD, BRIGHTER TOMORROWS</div>
    </div>


    <div class="menu-section">

        <div class="menu-title">Main</div>

        <a href="{{ route('student.dashboard') }}" class="menu-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></div>
            <span class="menu-label">Dashboard</span>
        </a>

        <a href="{{ route('student.profile') }}" class="menu-item {{ request()->routeIs('student.profile*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-person-fill"></i></div>
            <span class="menu-label">My Profile</span>
        </a>

        <a href="{{ route('student.qualifications') }}" class="menu-item {{ request()->routeIs('student.qualifications*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <span class="menu-label">Qualifications</span>
        </a>

        <a href="{{ route('student.preferences') }}" class="menu-item {{ request()->routeIs('student.preferences*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-sliders"></i></div>
            <span class="menu-label">Study Preferences</span>
        </a>

    </div>


    <div class="menu-section">

        <div class="menu-title">Study Abroad</div>

        <a href="{{ route('student.applications.index') }}" class="menu-item {{ request()->routeIs('student.applications.*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
            <span class="menu-label">Consultancy Application</span>
        </a>

        <a href="{{ route('student.recommendations.index') }}" class="menu-item {{ request()->routeIs('student.recommendations.*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-star-fill"></i></div>
            <span class="menu-label">Recommendations</span>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-calendar2-check-fill"></i></div>
            <span class="menu-label">Appointments</span>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-chat-dots-fill"></i></div>
            <span class="menu-label">Consultations</span>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-arrow-repeat"></i></div>
            <span class="menu-label">Follow-ups</span>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-cash-coin"></i></div>
            <span class="menu-label">Fund Requirement</span>
        </a>

        <a href="{{ route('student.documents') }}" class="menu-item {{ request()->routeIs('student.documents*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-folder2-open"></i></div>
            <span class="menu-label">Required Documents</span>
        </a>

    </div>


    <div class="menu-section">

        <div class="menu-title">Account</div>

        <a href="{{ route('student.account.edit') }}" class="menu-item {{ request()->routeIs('student.account.*') ? 'active' : '' }}">
            <div class="menu-icon"><i class="bi bi-gear-fill"></i></div>
            <span class="menu-label">Account Settings</span>
        </a>

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
