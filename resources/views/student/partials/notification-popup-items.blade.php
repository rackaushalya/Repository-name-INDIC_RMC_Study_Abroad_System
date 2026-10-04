@forelse($notifications as $notification)

    <div
        class="notification-item popup-item {{ $notification->is_read ? 'read' : '' }}"
        data-notif-id="{{ $notification->notification_id }}"
        data-read-url="{{ route('student.notifications.read', $notification->notification_id) }}"
    >
        <div class="notification-dot {{ $notification->is_read ? 'read' : '' }}"></div>

        <div>
            <div class="notification-text">
                <div class="notification-title">{{ $notification->title }}</div>
                {{ $notification->message }}
            </div>

            <div class="notification-time">
                {{ $notification->created_at?->diffForHumans() }}
            </div>

            @if($notification->related_application_id)
                <a href="{{ route('student.applications.show', $notification->related_application_id) }}">
                    View application
                </a>
            @endif
        </div>
    </div>

@empty

    <div class="popup-empty">No notifications yet.</div>

@endforelse
