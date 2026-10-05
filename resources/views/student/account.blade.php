<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC - Account Settings</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; background: #f5f7fb; color: #172033; }
        a { text-decoration: none; color: inherit; }

        .sidebar { position: fixed; left: 0; top: 0; width: 245px; height: 100vh; background: #101a2b; color: white; padding: 25px 15px; overflow-y: auto; }
        .logo { padding: 0 12px; margin-bottom: 35px; }
        .logo-main { font-size: 25px; font-weight: 700; color: #f97316; }
        .logo-main span { color: white; }
        .logo-subtitle { font-size: 8px; letter-spacing: 0.8px; color: #aeb7c7; margin-top: 4px; }
        .menu-section { margin-bottom: 25px; }
        .menu-title { color: #7e8ba1; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; margin: 0 12px 10px; }
        .menu-item { display: flex; align-items: center; gap: 12px; padding: 11px 12px; margin-bottom: 4px; border-radius: 7px; color: #cbd3df; font-size: 13px; transition: 0.2s; }
        .menu-item:hover { background: #1d2a40; color: white; }
        .menu-item.active { background: #f97316; color: white; }
        .menu-icon { width: 19px; height: 19px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }

        .main { margin-left: 245px; min-height: 100vh; }
        .topbar { height: 72px; background: white; border-bottom: 1px solid #e6e9ef; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; position: sticky; top: 0; z-index: 10; }
        .topbar h2 { font-size: 17px; color: #101a2b; }
        .user { display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 38px; height: 38px; border-radius: 50%; background: #f97316; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; }
        .user-info strong { display: block; font-size: 13px; color: #172033; }
        .user-info span { font-size: 11px; color: #8b95a5; }

        .content { padding: 30px; max-width: 760px; }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; color: #101a2b; margin-bottom: 4px; }
        .page-header p { font-size: 13px; color: #7c8493; }

        .alert { padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; }
        .alert-success { background: #eafaf0; color: #1b7a43; border: 1px solid #cdeed9; }
        .alert-error { background: #fff1f1; color: #c0362c; border: 1px solid #f6cfcc; }
        .alert ul { margin: 0; padding-left: 18px; }

        .card { background: white; border: 1px solid #e6e9ef; border-radius: 12px; padding: 24px 26px; margin-bottom: 22px; }
        .card.danger { border-color: #f6cfcc; background: #fffaf9; }
        .card-head { margin-bottom: 18px; }
        .card-head h3 { font-size: 15px; color: #101a2b; }
        .card.danger .card-head h3 { color: #c0362c; }
        .card-head p { font-size: 12px; color: #9aa2b0; margin-top: 3px; }

        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f1f3f7; font-size: 13px; }
        .info-row:last-child { border-bottom: none; }
        .info-row .label { color: #7c8493; }
        .info-row .value { color: #172033; font-weight: 600; }
        .status-pill { font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; text-transform: capitalize; }
        .status-active { background: #eafaf0; color: #1b7a43; }
        .status-inactive, .status-suspended { background: #fff1f1; color: #c0362c; }

        .field { margin-bottom: 16px; }
        .field label { display: block; font-size: 12.5px; font-weight: 600; color: #37415a; margin-bottom: 6px; }
        .field input { width: 100%; padding: 10px 13px; border: 1px solid #dfe4ec; border-radius: 8px; font-size: 13.5px; color: #172033; background: #f8fafc; font-family: inherit; }
        .field input:focus { outline: none; border-color: #f97316; background: white; }
        .field-error { color: #c0362c; font-size: 12px; margin-top: 5px; }

        .field-hint { display: block; color: #9aa2b0; font-size: 12px; margin-top: 5px; }
        .password-field { position: relative; }
        .password-field input { padding-right: 42px; }
        .password-toggle {
            position: absolute; right: 6px; top: 50%; transform: translateY(-50%);
            width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;
            background: none; border: none; color: #9aa2b0; font-size: 15px; cursor: pointer; border-radius: 6px;
        }
        .password-toggle:hover { color: #37415a; background: #eef0f4; }

        .btn-primary { padding: 10px 20px; background: #f97316; color: white; border: none; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; }
        .btn-primary:hover { background: #ea6a0f; }
        .btn-danger { padding: 10px 20px; background: white; color: #c0362c; border: 1px solid #f6cfcc; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; }
        .btn-danger:hover { background: #fff1f1; }

        @media (max-width: 900px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
        }

    </style>
</head>
<body>

<aside class="sidebar">
    <div class="logo">
        <div class="logo-main">INDIC <span>RMC</span></div>
        <div class="logo-subtitle">STUDY ABROAD, BRIGHTER TOMORROWS</div>
    </div>

    <div class="menu-section">
        <div class="menu-title">Main</div>
        <a href="{{ route('student.dashboard') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></div><span>Dashboard</span></a>
        <a href="{{ route('student.profile') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-person-fill"></i></div><span>My Profile</span></a>
        <a href="{{ route('student.qualifications') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-mortarboard-fill"></i></div><span>Qualifications</span></a>
        <a href="{{ route('student.preferences') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-sliders"></i></div><span>Study Preferences</span></a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Study Abroad</div>
        <a href="{{ route('student.applications.index') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></div><span>Consultancy Application</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-star-fill"></i></div><span>Recommendations</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-calendar2-check-fill"></i></div><span>Appointments</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-chat-dots-fill"></i></div><span>Consultations</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-arrow-repeat"></i></div><span>Follow-ups</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-cash-coin"></i></div><span>Fund Requirement</span></a>
        <a href="{{ route('student.documents') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-folder2-open"></i></div><span>Required Documents</span></a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Account</div>
        <a href="{{ route('student.account.edit') }}" class="menu-item active"><div class="menu-icon"><i class="bi bi-gear-fill"></i></div><span>Account Settings</span></a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-item" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;font-family:inherit;">
                <div class="menu-icon"><i class="bi bi-box-arrow-right"></i></div><span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<main class="main">

    <header class="topbar">
        <h2>Account Settings</h2>
        <a href="{{ route('student.account.edit') }}" class="user" style="text-decoration:none; color:inherit;">
            @if ($user->profile_image_url ?? null)
                <img src="{{ $user->profile_image_url }}" class="user-avatar" alt="" style="object-fit: cover;">
            @else
                <div class="user-avatar">{{ strtoupper(substr($user->first_name ?? 'S', 0, 1)) }}</div>
            @endif
            <div class="user-info">
                <strong>{{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'Student' }}</strong>
                <span>Student</span>
            </div>
        </a>
    </header>

    <section class="content">

        <div class="page-header">
            <h1>Account Settings</h1>
            <p>Manage your login credentials and account status.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-head">
                <h3>Account Overview</h3>
                <p>Basic information about your account</p>
            </div>

            <div class="info-row">
                <span class="label">Email address</span>
                <span class="value">{{ $user->email }}</span>
            </div>
            <div class="info-row">
                <span class="label">Phone number</span>
                <span class="value">{{ $user->phone ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="label">Account status</span>
                <span class="status-pill status-{{ $user->account_status }}">{{ $user->account_status }}</span>
            </div>
            <div class="info-row">
                <span class="label">Member since</span>
                <span class="value">{{ optional($user->created_at)->format('d M Y') ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="label">Last login</span>
                <span class="value">{{ optional($user->last_login_at)->format('d M Y, h:i A') ?? '—' }}</span>
            </div>
        </div>

        <div class="card">
            <div class="card-head">
                <h3>Change Password</h3>
                <p>Choose a strong password you don't use elsewhere</p>
            </div>

            <form method="POST" action="{{ route('student.account.password.update') }}">
                @csrf
                @method('PUT')

                <div class="field">
                    <label for="current_password">Current password</label>
                    <div class="password-field">
                        <input type="password" id="current_password" name="current_password" required maxlength="255" autocomplete="current-password">
                        <button type="button" class="password-toggle" data-target="current_password" aria-label="Show password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('current_password')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label for="password">New password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" required minlength="8" maxlength="72" autocomplete="new-password">
                        <button type="button" class="password-toggle" data-target="password" aria-label="Show password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <span class="field-hint">At least 8 characters with an uppercase letter, a lowercase letter and a number.</span>
                    @error('password')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm new password</label>
                    <div class="password-field">
                        <input type="password" id="password_confirmation" name="password_confirmation" required maxlength="72" autocomplete="new-password">
                        <button type="button" class="password-toggle" data-target="password_confirmation" aria-label="Show password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Update Password</button>
            </form>
        </div>

        <div class="card danger">
            <div class="card-head">
                <h3>Deactivate Account</h3>
                <p>Deactivating your account will sign you out and prevent you from logging back in until support reactivates it.</p>
            </div>

            <form method="POST" action="{{ route('student.account.deactivate') }}"
                onsubmit="return confirm('Are you sure you want to deactivate your account? You will be logged out immediately.');">
                @csrf

                <div class="field" style="max-width: 320px;">
                    <label for="confirm_password">Confirm your password</label>
                    <div class="password-field">
                        <input type="password" id="confirm_password" name="confirm_password" required maxlength="255" autocomplete="current-password">
                        <button type="button" class="password-toggle" data-target="confirm_password" aria-label="Show password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('confirm_password')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn-danger">Deactivate My Account</button>
            </form>
        </div>

    </section>

</main>

<script>
    document.querySelectorAll('.password-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = document.getElementById(btn.dataset.target);
            var icon = btn.querySelector('i');
            var isHidden = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isHidden);
            icon.classList.toggle('bi-eye-slash', isHidden);
            btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
        });
    });

    var passwordForm = document.getElementById('password').form;
    var curPw = document.getElementById('current_password');
    var newPw = document.getElementById('password');
    var confPw = document.getElementById('password_confirmation');

    function checkPasswordForm() {
        newPw.setCustomValidity('');
        confPw.setCustomValidity('');

        if (newPw.value && !(/[a-z]/.test(newPw.value) && /[A-Z]/.test(newPw.value) && /[0-9]/.test(newPw.value))) {
            newPw.setCustomValidity('Use at least one uppercase letter, one lowercase letter and one number.');
        } else if (newPw.value && newPw.value === curPw.value) {
            newPw.setCustomValidity('The new password must be different from your current password.');
        }

        if (confPw.value && confPw.value !== newPw.value) {
            confPw.setCustomValidity('The passwords do not match.');
        }
    }

    [curPw, newPw, confPw].forEach(function (el) { el.addEventListener('input', checkPasswordForm); });
    passwordForm.addEventListener('submit', checkPasswordForm);
</script>

</body>
</html>
