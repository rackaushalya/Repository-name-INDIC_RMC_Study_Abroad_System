<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Send Notification</title>

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

        .content { padding: 28px 30px 40px; max-width: 640px; }

        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 23px; font-weight: 700; color: #111827; letter-spacing: -.4px; }
        .page-header p { margin-top: 5px; font-size: 12px; color: #737d8e; }

        .panel { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 26px; }

        .form-group { margin-bottom: 18px; }

        label { display: block; font-size: 12px; font-weight: 600; color: #4b5565; margin-bottom: 6px; }

        select, input[type="text"], textarea {
            width: 100%; padding: 10px 12px; border: 1px solid #dce1e8; border-radius: 7px;
            font-size: 13px; color: #172033; background: #f8fafc; outline: none;
        }

        select:focus, input:focus, textarea:focus { border-color: #f97316; background: white; }

        textarea { resize: vertical; min-height: 100px; font-family: inherit; }

        .error-text { color: #c0392b; font-size: 11px; margin-top: 5px; }

        .btn-primary {
            background: #f97316; color: #fff; border: none;
            padding: 11px 20px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer;
        }

        .btn-primary:hover { background: #e07116; }

        .btn-cancel {
            padding: 11px 20px; border-radius: 7px; border: 1px solid #dce1e8;
            background: white; font-size: 12px; font-weight: 600; color: #4b5565; cursor: pointer;
        }

        .form-actions { display: flex; gap: 10px; margin-top: 22px; }

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
                <h1>Send Notification</h1>
                <p>The recipient sees this instantly in their own notification bell.</p>
            </div>

            <div class="panel">

                <form method="POST" action="{{ route('admin.notifications.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="user_id">Recipient</label>
                        <select name="user_id" id="user_id" required>
                            <option value="">Select a user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                    {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="e.g. Your application was updated">
                        @error('title')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" required placeholder="Notification content...">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="notification_type">Type (optional)</label>
                        <input type="text" name="notification_type" id="notification_type" value="{{ old('notification_type') }}" placeholder="e.g. CRM, Lead Update">
                        @error('notification_type')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Send Notification</button>
                        <a href="{{ route('admin.notifications.index') }}" class="btn-cancel" style="display:inline-block; text-align:center;">Cancel</a>
                    </div>

                </form>

            </div>

        </section>

    </main>

</div>

</body>
</html>
