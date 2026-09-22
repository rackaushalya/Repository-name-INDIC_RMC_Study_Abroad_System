<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC - My Profile</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a { text-decoration: none; color: inherit; }

        /* SIDEBAR */
        .sidebar {
            position: fixed; left: 0; top: 0; width: 245px; height: 100vh;
            background: #101a2b; color: white; padding: 25px 15px; overflow-y: auto;
        }
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

        /* MAIN */
        .main { margin-left: 245px; min-height: 100vh; }
        .topbar {
            height: 72px; background: white; border-bottom: 1px solid #e6e9ef;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 30px; position: sticky; top: 0; z-index: 10;
        }
        .topbar h2 { font-size: 17px; color: #101a2b; }
        .top-right { display: flex; align-items: center; gap: 18px; }
        .user { display: flex; align-items: center; gap: 10px; }
        .user-avatar {
            width: 38px; height: 38px; border-radius: 50%; background: #f97316; color: white;
            display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px;
        }
        .user-info strong { display: block; font-size: 13px; color: #172033; }
        .user-info span { font-size: 11px; color: #8b95a5; }

        .content { padding: 30px; max-width: 980px; }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; color: #101a2b; margin-bottom: 4px; }
        .page-header p { font-size: 13px; color: #7c8493; }

        .alert { padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; }
        .alert-success { background: #eafaf0; color: #1b7a43; border: 1px solid #cdeed9; }
        .alert-error { background: #fff1f1; color: #c0362c; border: 1px solid #f6cfcc; }
        .alert ul { margin: 0; padding-left: 18px; }

        .card {
            background: white; border: 1px solid #e6e9ef; border-radius: 12px;
            padding: 26px 28px; margin-bottom: 24px;
        }
        .card-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .card-head h3 { font-size: 15px; color: #101a2b; }
        .card-head p { font-size: 12px; color: #9aa2b0; margin-top: 3px; }

        .profile-banner {
            display: flex; align-items: center; gap: 18px; margin-bottom: 8px;
        }
        .profile-avatar {
            width: 68px; height: 68px; border-radius: 50%; background: #fff1e8; color: #f97316;
            display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 24px;
            border: 2px solid #ffd9bd;
        }
        .profile-banner h2 { font-size: 19px; color: #101a2b; }
        .profile-banner .email { font-size: 13px; color: #7c8493; margin-top: 3px; }
        .photo-actions { display: flex; align-items: center; gap: 10px; margin-top: 16px; }
        .btn-secondary {
            display: inline-block; padding: 9px 16px; background: white; color: #37415a;
            border: 1px solid #dfe4ec; border-radius: 8px; font-size: 12.5px; font-weight: 700;
            cursor: pointer; font-family: inherit;
        }
        .btn-secondary:hover { background: #f8fafc; }
        .btn-remove-photo { color: #c0362c; }
        .btn-remove-photo:hover { background: #fff1f1; }
        .badge {
            display: inline-block; margin-top: 6px; font-size: 11px; font-weight: 700;
            padding: 3px 10px; border-radius: 20px; background: #eafaf0; color: #1b7a43; text-transform: capitalize;
        }

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }

        .field { margin-bottom: 18px; }
        .field label { display: block; font-size: 12.5px; font-weight: 600; color: #37415a; margin-bottom: 6px; }
        .field input, .field select, .field textarea {
            width: 100%; padding: 10px 13px; border: 1px solid #dfe4ec; border-radius: 8px;
            font-size: 13.5px; color: #172033; background: #f8fafc; font-family: inherit;
        }
        .field input:focus, .field select:focus, .field textarea:focus {
            outline: none; border-color: #f97316; background: white;
        }
        .field textarea { resize: vertical; min-height: 80px; }
        .field-error { color: #c0362c; font-size: 12px; margin-top: 5px; }
        .field-hint { display: block; color: #9aa2b0; font-size: 12px; margin-top: 5px; }

        .btn-primary {
            padding: 11px 22px; background: #f97316; color: white; border: none; border-radius: 8px;
            font-size: 13.5px; font-weight: 700; cursor: pointer;
        }
        .btn-primary:hover { background: #ea6a0f; }

        @media (max-width: 900px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .grid-2 { grid-template-columns: 1fr; }
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
        <a href="{{ route('student.dashboard') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></div><span>Dashboard</span>
        </a>
        <a href="{{ route('student.profile') }}" class="menu-item active">
            <div class="menu-icon"><i class="bi bi-person-fill"></i></div><span>My Profile</span>
        </a>
        <a href="{{ route('student.qualifications') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-mortarboard-fill"></i></div><span>Qualifications</span>
        </a>
        <a href="{{ route('student.preferences') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-sliders"></i></div><span>Study Preferences</span>
        </a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Study Abroad</div>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></div><span>Consultancy Application</span>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-star-fill"></i></div><span>Recommendations</span>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-calendar2-check-fill"></i></div><span>Appointments</span>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-chat-dots-fill"></i></div><span>Consultations</span>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-arrow-repeat"></i></div><span>Follow-ups</span>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="bi bi-cash-coin"></i></div><span>Fund Requirement</span>
        </a>
        <a href="{{ route('student.documents') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-folder2-open"></i></div><span>Required Documents</span>
        </a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Account</div>
        <a href="{{ route('student.account.edit') }}" class="menu-item">
            <div class="menu-icon"><i class="bi bi-gear-fill"></i></div><span>Account Settings</span>
        </a>
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
        <h2>My Profile</h2>
        <div class="top-right">
            <a href="{{ route('student.account.edit') }}" class="user" style="text-decoration:none; color:inherit;">
                @if ($user->profile_image_url ?? null)
                    <img src="{{ $user->profile_image_url }}" class="user-avatar" alt="" style="object-fit: cover;">
                @else
                    <div class="user-avatar">{{ strtoupper(substr($user->first_name ?? 'S', 0, 1) . substr($user->last_name ?? '', 0, 1)) }}</div>
                @endif
                <div class="user-info">
                    <strong>{{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'Student' }}</strong>
                    <span>Student</span>
                </div>
            </a>
        </div>
    </header>

    <section class="content">

        <div class="page-header">
            <h1>My Profile</h1>
            <p>Keep your personal details up to date for a smoother consultancy experience.</p>
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

        @if ($student)

            <div class="card">
                <div class="profile-banner">
                    @if ($student->user->profile_image_url ?? null)
                        <img src="{{ $student->user->profile_image_url }}" class="profile-avatar" alt="Profile photo" style="object-fit: cover;">
                    @else
                        <div class="profile-avatar">
                            {{ strtoupper(substr($student->user->first_name ?? 'S', 0, 1) . substr($student->user->last_name ?? '', 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <h2>{{ trim(($student->user->first_name ?? '') . ' ' . ($student->user->last_name ?? '')) }}</h2>
                        <div class="email">{{ $student->user->email ?? '' }}</div>
                        <span class="badge">{{ $student->user->account_status ?? 'active' }}</span>
                    </div>
                </div>

                <div class="photo-actions">
                    <form method="POST" action="{{ route('student.account.photo.update') }}" enctype="multipart/form-data" id="photo-upload-form">
                        @csrf
                        <input type="file" id="profile_image" name="profile_image" accept=".jpg,.jpeg,.png,.webp" style="display:none;" onchange="document.getElementById('photo-upload-form').submit();">
                        <label for="profile_image" class="btn-secondary" style="cursor:pointer;">Change Photo</label>
                        @error('profile_image')<div class="field-error">{{ $message }}</div>@enderror
                    </form>

                    @if ($student->user->profile_image ?? null)
                        <form method="POST" action="{{ route('student.account.photo.destroy') }}" onsubmit="return confirm('Remove your profile photo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-secondary btn-remove-photo">Remove Photo</button>
                        </form>
                    @endif
                </div>
            </div>

            <form method="POST" action="{{ route('student.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-head">
                        <div>
                            <h3>Personal Information</h3>
                            <p>Your name and contact details</p>
                        </div>
                    </div>

                    <div class="grid-2">
                        <div class="field">
                            <label for="first_name">First name</label>
                            <input type="text" id="first_name" name="first_name"
                                value="{{ old('first_name', $student->user->first_name ?? '') }}" required>
                            @error('first_name')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="last_name">Last name</label>
                            <input type="text" id="last_name" name="last_name"
                                value="{{ old('last_name', $student->user->last_name ?? '') }}">
                            @error('last_name')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="phone">Phone number</label>
                            <input type="tel" id="phone" name="phone"
                                inputmode="numeric" pattern="[0-9]{10}" maxlength="10"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                                value="{{ old('phone', $student->user->phone ?? '') }}" placeholder="07XXXXXXXX">
                            @error('phone')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label>Email address</label>
                            <input type="email" value="{{ $student->user->email ?? '' }}" disabled style="background:#eef0f4;color:#8b95a5;">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <div>
                            <h3>Personal Details</h3>
                            <p>Used to match you with the right universities and requirements</p>
                        </div>
                    </div>

                    <div class="grid-2">
                        <div class="field">
                            <label for="date_of_birth">Date of birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth"
                                max="{{ now()->subYears(16)->format('Y-m-d') }}"
                                value="{{ old('date_of_birth', optional($student->date_of_birth)->format('Y-m-d')) }}">
                            <span class="field-hint">You must be at least 16 years old.</span>
                            @error('date_of_birth')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender">
                                <option value="">Select gender</option>
                                @foreach (['Male', 'Female', 'Other'] as $g)
                                    <option value="{{ $g }}" @selected(old('gender', $student->gender) === $g)>{{ $g }}</option>
                                @endforeach
                            </select>
                            @error('gender')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="nationality">Nationality</label>
                            <input type="text" id="nationality" name="nationality"
                                value="{{ old('nationality', $student->nationality) }}">
                            @error('nationality')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="passport_number">Passport number</label>
                            <input type="text" id="passport_number" name="passport_number"
                                value="{{ old('passport_number', $student->passport_number) }}">
                            @error('passport_number')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city"
                                value="{{ old('city', $student->city) }}">
                            @error('city')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country"
                                value="{{ old('country', $student->country) }}">
                            @error('country')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="current_address">Current address</label>
                        <textarea id="current_address" name="current_address" maxlength="500">{{ old('current_address', $student->current_address) }}</textarea>
                        @error('current_address')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn-primary">Save Changes</button>
                </div>

            </form>

        @else

            <div class="card">
                <p>We couldn't find a student profile linked to your account. Please contact support.</p>
            </div>

        @endif

    </section>

</main>

</body>
</html>
