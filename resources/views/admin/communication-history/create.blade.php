<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Log Communication</title>

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

        .main {
            margin-left: 245px;
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e6e9ef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f97316;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 13px;
        }

        .profile-info strong {
            display: block;
            font-size: 13px;
        }

        .profile-info span {
            display: block;
            font-size: 11px;
            color: #8a94a6;
            margin-top: 3px;
        }

        .content { padding: 28px 30px 40px; max-width: 720px; }

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

        textarea { resize: vertical; min-height: 110px; font-family: inherit; }

        .error-text { color: #c0392b; font-size: 11px; margin-top: 5px; }

        .form-row { display: flex; gap: 16px; }
        .form-row .form-group { flex: 1; }

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

        .hint { font-size: 11px; color: #8a94a6; margin-top: 6px; }

        @media (max-width: 750px) {
            .main { margin-left: 70px; }
            .topbar { padding: 0 15px; }
            .form-row { flex-direction: column; }
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
                <h1>Log Communication</h1>
                <p>Record a call, email, message, or note against a lead or inquiry.</p>
            </div>

            <div class="panel">

                <form method="POST" action="{{ route('admin.communication-history.store') }}">
                    @csrf

                    <div class="form-row">

                        <div class="form-group">
                            <label for="lead_id">Lead</label>
                            <select name="lead_id" id="lead_id">
                                <option value="">— None —</option>
                                @foreach ($leads as $lead)
                                    <option value="{{ $lead->lead_id }}" {{ (old('lead_id', $selectedLeadId)) == $lead->lead_id ? 'selected' : '' }}>
                                        {{ $lead->first_name }} {{ $lead->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lead_id')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inquiry_id">Inquiry</label>
                            <select name="inquiry_id" id="inquiry_id">
                                <option value="">— None —</option>
                                @foreach ($inquiries as $inquiry)
                                    <option value="{{ $inquiry->inquiry_id }}" {{ (old('inquiry_id', $selectedInquiryId)) == $inquiry->inquiry_id ? 'selected' : '' }}>
                                        #{{ $inquiry->inquiry_id }} — {{ $inquiry->inquiry_subject }}
                                    </option>
                                @endforeach
                            </select>
                            @error('inquiry_id')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <p class="hint">Select a Lead or an Inquiry (or both) to tie this entry to — at least one is recommended.</p>

                    <div class="form-group" style="margin-top: 18px;">
                        <label for="communication_type">Type</label>
                        <select name="communication_type" id="communication_type" required>
                            <option value="">Select type</option>
                            @foreach (['Message', 'Email', 'Phone', 'Note'] as $type)
                                <option value="{{ $type }}" {{ old('communication_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('communication_type')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" placeholder="e.g. Follow-up about UK scholarship">
                        @error('subject')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Message / Notes</label>
                        <textarea name="message" id="message" required placeholder="What was discussed or sent...">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Save Entry</button>
                        <a href="{{ route('admin.communication-history.index') }}" class="btn-cancel" style="display:inline-block; text-align:center;">Cancel</a>
                    </div>

                </form>

            </div>

        </section>

    </main>

</div>

</body>
</html>
