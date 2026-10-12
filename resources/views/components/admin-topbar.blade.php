{{--
    Topbar for admin pages. Usage:
        <x-admin-topbar :crumbs="['Applications' => route('admin.applications-list')]" current="Details" />
--}}
@props(['crumbs' => [], 'current' => ''])

<header class="pg-topbar">

    <nav class="pg-crumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>

        @foreach ($crumbs as $label => $url)
            <i class="bi bi-chevron-right"></i>
            <a href="{{ $url }}">{{ $label }}</a>
        @endforeach

        <i class="bi bi-chevron-right"></i>
        <strong>{{ $current }}</strong>
    </nav>

    <div class="pg-user">
        <div class="pg-avatar">
            {{ strtoupper(substr(auth()->user()->first_name ?? 'A', 0, 1)) }}
        </div>

        <div class="pg-user-text">
            <strong>{{ trim((auth()->user()->first_name ?? '') . ' ' . (auth()->user()->last_name ?? '')) ?: 'Admin' }}</strong>
            <span>Administrator</span>
        </div>
    </div>

</header>
