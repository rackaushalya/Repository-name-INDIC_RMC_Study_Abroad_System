<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Notifications | INDIC RMC</title>

    @include('components.page-style')

    <style>
        .nt-item { display: flex; gap: 14px; align-items: flex-start; padding: 16px 22px; border-bottom: 1px solid #f0f2f5; }
        .nt-item:last-child { border-bottom: 0; }
        .nt-item.unread { background: #fffaf5; }
        .nt-icon { width: 40px; height: 40px; border-radius: 12px; background: #e8f1ff; color: #2767b1; display: grid; place-items: center; font-size: 18px; flex-shrink: 0; }
        .nt-icon.deadline { background: #fff1e8; color: #f97316; }
        .nt-body { flex: 1; min-width: 0; }
        .nt-body strong { display: block; font-size: 14px; margin-bottom: 3px; overflow-wrap: anywhere; }
        .nt-body p { margin: 0 0 6px; font-size: 13px; color: #596579; overflow-wrap: anywhere; }
        .nt-body small { color: #8791a1; font-size: 11.5px; }
        .nt-body a { color: #f97316; font-size: 12.5px; font-weight: 600; margin-left: 10px; }
        .nt-actions { display: flex; gap: 8px; flex-shrink: 0; }
        .nt-dot { width: 8px; height: 8px; border-radius: 50%; background: #f97316; display: inline-block; margin-right: 6px; }
        @media (max-width: 560px) { .nt-item { flex-wrap: wrap; } .nt-actions { margin-left: 54px; } }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

<main class="main">

    <x-student-topbar current="Notifications" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Notifications</h1>
                <p>Status updates from your consultant and reminders for upcoming deadlines.</p>
            </div>

            <div class="pg-actions">
                @if ($counts['unread'] > 0)
                    <button type="button" class="pg-btn" id="markAll"><i class="bi bi-check2-all"></i> Mark all as read</button>
                @endif
                <a href="{{ route('student.applications.index') }}" class="pg-btn"><i class="bi bi-file-earmark-text"></i> My applications</a>
            </div>
        </div>

        @if (session('success'))
            <div class="pg-alert success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="pg-card">

            <div class="pg-chips">
                <a href="{{ route('student.notifications.index') }}" class="pg-chip {{ $filter === 'all' ? 'active' : '' }}">All <b>{{ $counts['all'] }}</b></a>
                <a href="{{ route('student.notifications.index', ['filter' => 'unread']) }}" class="pg-chip {{ $filter === 'unread' ? 'active' : '' }}">Unread <b>{{ $counts['unread'] }}</b></a>
                <a href="{{ route('student.notifications.index', ['filter' => 'deadlines']) }}" class="pg-chip {{ $filter === 'deadlines' ? 'active' : '' }}">Deadline reminders <b>{{ $counts['deadlines'] }}</b></a>
            </div>

            @forelse ($notifications as $notification)
                @php $isDeadline = str_starts_with((string) $notification->notification_type, \App\Services\DeadlineAlerts::TYPE_PREFIX); @endphp

                <div class="nt-item {{ $notification->is_read ? '' : 'unread' }}" data-id="{{ $notification->notification_id }}">
                    <div class="nt-icon {{ $isDeadline ? 'deadline' : '' }}">
                        <i class="bi {{ $isDeadline ? 'bi-alarm-fill' : 'bi-bell-fill' }}"></i>
                    </div>

                    <div class="nt-body">
                        <strong>
                            @unless ($notification->is_read)<span class="nt-dot"></span>@endunless
                            {{ $notification->title }}
                        </strong>
                        <p>{{ $notification->message }}</p>
                        <small>{{ $notification->created_at?->diffForHumans() }}</small>
                        @if ($notification->related_application_id)
                            <a href="{{ route('student.applications.journey', $notification->related_application_id) }}">View journey</a>
                        @endif
                    </div>

                    <div class="nt-actions">
                        @unless ($notification->is_read)
                            <button type="button" class="pg-icon-btn js-read" title="Mark as read"><i class="bi bi-check2"></i></button>
                        @endunless
                        <button type="button" class="pg-icon-btn danger js-delete" title="Remove"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            @empty
                <div class="pg-empty">
                    <div class="pg-empty-icon"><i class="bi bi-bell"></i></div>
                    <h3>{{ $filter === 'all' ? 'No notifications yet' : 'Nothing here' }}</h3>
                    <p>{{ $filter === 'deadlines' ? 'Reminders appear here when a deadline is within a week.' : 'You are all caught up.' }}</p>
                </div>
            @endforelse

            @if ($notifications->hasPages())
                <div class="pg-pagination">{{ $notifications->links('pagination.portal') }}</div>
            @endif
        </div>

    </section>
</main>

<script>
(function () {
    var token = document.querySelector('meta[name="csrf-token"]').content;
    var urls = {
        read: "{{ url('student/notifications') }}/__ID__/read",
        remove: "{{ url('student/notifications') }}/__ID__",
        all: "{{ route('student.notifications.read-all') }}"
    };

    function call(method, url) {
        return fetch(url, {
            method: method,
            headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        }).then(function (r) { if (!r.ok) { throw new Error(r.status); } return r.json(); });
    }

    document.querySelectorAll('.js-read').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var row = btn.closest('.nt-item');
            call('PATCH', urls.read.replace('__ID__', row.dataset.id)).then(function () { window.location.reload(); });
        });
    });

    document.querySelectorAll('.js-delete').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var row = btn.closest('.nt-item');
            call('DELETE', urls.remove.replace('__ID__', row.dataset.id)).then(function () { window.location.reload(); });
        });
    });

    var all = document.getElementById('markAll');
    if (all) {
        all.addEventListener('click', function () {
            call('POST', urls.all).then(function () { window.location.reload(); });
        });
    }
})();
</script>

</body>
</html>
