@forelse($notifications->take(4) as $notification)

    <div class="notification-item {{ $notification->is_read ? 'read' : '' }}" data-notif-id="{{ $notification->notification_id }}">

        <div class="notification-dot {{ $notification->is_read ? 'read' : '' }}"></div>

        <div>

            <div class="notification-text">
                <div class="notification-title">{{ $notification->title }}</div>
                {{ $notification->message }}
            </div>

            <div class="notification-time">
                {{ $notification->created_at?->diffForHumans() }}
            </div>

        </div>

    </div>

@empty

    <div class="empty-card-state">
        <p>No new notifications.</p>
    </div>

@endforelse
