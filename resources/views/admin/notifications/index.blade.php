<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Email Notifications</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a { text-decoration: none; color: inherit; }

        .app { display: flex; min-height: 100vh; }

        .main { margin-left: 245px; min-height: 100vh; }

        .topbar {
            height: 72px; background: white; border-bottom: 1px solid #e6e9ef;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px; position: sticky; top: 0; z-index: 10;
        }

        .admin-profile { display: flex; align-items: center; gap: 12px; }

        .profile-circle {
            width: 38px; height: 38px; border-radius: 50%;
            background: #f97316; color: white;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; font-size: 13px;
        }

        .profile-info strong { display: block; font-size: 13px; }
        .profile-info span { display: block; font-size: 11px; color: #8a94a6; margin-top: 3px; }

        .content { padding: 28px 30px 40px; }

        .page-header {
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: 10px;
        }

        .page-header h1 { font-size: 23px; font-weight: 700; color: #111827; letter-spacing: -.4px; }
        .page-header p { margin-top: 5px; font-size: 12px; color: #737d8e; }

        .info-note {
            background: #edf3ff; color: #416dc0; border: 1px solid #d6e4fb;
            border-radius: 7px; padding: 10px 14px; font-size: 11px; margin-bottom: 18px;
        }

        .btn-primary {
            background: #f97316; color: #fff; border: none;
            padding: 11px 18px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer;
        }

        .btn-primary:hover { background: #e07116; }

        .alert-success {
            background: #edf8f2; color: #32815a;
            border: 1px solid #c9ead9; border-radius: 7px;
            padding: 12px 16px; font-size: 12px; margin-bottom: 18px;
        }

        .panel { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 20px; }

        .table-container { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        th {
            text-align: left; padding: 10px 8px;
            border-bottom: 1px solid #e7e9ed;
            color: #8a93a3; font-size: 9px;
            text-transform: uppercase; letter-spacing: .5px; font-weight: 600;
        }

        td {
            padding: 13px 8px; border-bottom: 1px solid #f0f1f3;
            font-size: 11px; color: #4b5565;
        }

        td:first-child { color: #172033; font-weight: 600; }

        .badge { display: inline-block; padding: 5px 8px; border-radius: 5px; font-size: 9px; font-weight: 600; }
        .badge-green { background: #edf8f2; color: #32815a; }
        .badge-gray { background: #f0f1f3; color: #697386; }

        .row-actions button { background: none; border: none; color: #c0392b; font-size: 10px; font-weight: 600; cursor: pointer; padding: 0; }

        .empty-state { text-align: center; padding: 40px 0; color: #8a93a3; font-size: 12px; }

        .pagination-wrap { margin-top: 18px; }

        @media (max-width: 750px) {
            .main { margin-left: 70px; }
            .topbar { padding: 0 15px; }
        }

    </style>

@include('components.sidebar-style')
</head>
<body>

<div class="app">

    @include('components.admin-sidebar')

    <main class="main">

        <header class="topbar">
            <div></div>
            <div class="admin-profile">
                <div class="profile-circle">
                    {{ strtoupper(substr(auth()->user()->first_name ?? 'A', 0, 1)) }}
                </div>
                <div class="profile-info">
                    <strong>{{ auth()->user()->first_name ?? 'Admin' }} {{ auth()->user()->last_name ?? 'User' }}</strong>
                    <span>Administrator</span>
                </div>
            </div>
        </header>

        <section class="content">

            <div class="page-header">
                <div>
                    <h1>Email Notifications</h1>
                    <p>Notifications sent to users — visible instantly in their own notification bell.</p>
                </div>
                <a href="{{ route('admin.notifications.create') }}" class="btn-primary">+ Send Notification</a>
            </div>

            <div class="info-note">
                Each notification is delivered two ways: instantly in the recipient's dashboard, and as a real email. During development, outgoing emails are caught by Mailpit instead of the live internet — view them at <code>http://127.0.0.1:8025</code>.
            </div>

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="panel">

                <div class="table-container">

                    <table>
                        <thead>
                            <tr>
                                <th>Recipient</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Sent At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->user->first_name ?? '—' }} {{ $notification->user->last_name ?? '' }}</td>
                                    <td>{{ $notification->title }}</td>
                                    <td style="max-width: 260px;">{{ \Illuminate\Support\Str::limit($notification->message, 70) }}</td>
                                    <td>{{ $notification->notification_type ?? '—' }}</td>
                                    <td>
                                        @if ($notification->is_read)
                                            <span class="badge badge-green">Read</span>
                                        @else
                                            <span class="badge badge-gray">Unread</span>
                                        @endif
                                    </td>
                                    <td>{{ $notification->created_at?->format('d M Y, h:i A') }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <form action="{{ route('admin.notifications.destroy', $notification->notification_id) }}" method="POST" onsubmit="return confirm('Delete this notification?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="empty-state">No notifications sent yet. Click "Send Notification" to send one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <div class="pagination-wrap">
                    {{ $notifications->links() }}
                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>
