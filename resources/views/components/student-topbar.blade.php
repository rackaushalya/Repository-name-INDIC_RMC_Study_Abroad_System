{{--
    Topbar for student pages. Usage:
        <x-student-topbar :crumbs="['Fund Requirements' => route('student.fund-requirements.index')]" current="Details" />
    $crumbs is an optional label => url map shown before the current page.
--}}
@props(['crumbs' => [], 'current' => ''])

<header class="pg-topbar">

    <nav class="pg-crumbs">
        <a href="{{ route('student.dashboard') }}">Dashboard</a>

        @foreach ($crumbs as $label => $url)
            <i class="bi bi-chevron-right"></i>
            <a href="{{ $url }}">{{ $label }}</a>
        @endforeach

        <i class="bi bi-chevron-right"></i>
        <strong>{{ $current }}</strong>
    </nav>

    <a href="{{ route('student.account.edit') }}" class="pg-user">
        <div class="pg-avatar">
            {{ strtoupper(substr(auth()->user()->first_name ?? 'S', 0, 1)) }}
        </div>

        <div class="pg-user-text">
            <strong>{{ trim((auth()->user()->first_name ?? '') . ' ' . (auth()->user()->last_name ?? '')) ?: 'Student' }}</strong>
            <span>Student</span>
        </div>
    </a>

</header>
