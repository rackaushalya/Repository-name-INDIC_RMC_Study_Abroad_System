<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Student | INDIC RMC</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        /* =====================================
           MAIN
        ====================================== */

        .main {
            margin-left: 245px;
            min-height: 100vh;
        }

        /* =====================================
           TOPBAR
        ====================================== */

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e6e9ef;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .search-box {
            width: 330px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 11px 15px 11px 40px;
            border: 1px solid #dce1e8;
            border-radius: 7px;
            outline: none;
            font-size: 13px;
            background: #f8fafc;
        }

        .search-box input:focus {
            border-color: #f97316;
            background: white;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 11px;
            color: #8a94a6;
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

        /* =====================================
           CONTENT
        ====================================== */

        .content {
            padding: 28px;
        }

        .content-inner {
            max-width: 900px;
            margin: auto;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6b7280;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .back-link:hover {
            color: #172033;
        }

        .page-header {
            margin-bottom: 22px;
        }

        .page-header h1 {
            font-size: 25px;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #718096;
            font-size: 14px;
        }

        .alert {
            padding: 13px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-error {
            background: #fdecec;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .alert-error ul {
            margin: 6px 0 0 18px;
        }

        /* =====================================
           FORM CARD
        ====================================== */

        .card {
            background: white;
            border: 1px solid #e2e6ec;
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 22px;
        }

        .card h2 {
            font-size: 16px;
            margin-bottom: 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 12px;
            font-weight: 600;
            color: #475569;
        }

        .form-control {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #dce1e8;
            border-radius: 7px;
            background: #f8fafc;
            color: #172033;
            outline: none;
            font-size: 13px;
            font-family: inherit;
        }

        textarea.form-control {
            height: 80px;
            padding: 10px 12px;
            resize: vertical;
        }

        .form-control:focus {
            border-color: #f97316;
            background: white;
        }

        .form-hint {
            color: #8a94a6;
            font-size: 11px;
        }

        /* =====================================
           ACTIONS
        ====================================== */

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-primary {
            height: 42px;
            padding: 0 20px;
            border-radius: 7px;
            border: none;
            background: #f97316;
            color: white;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #ea670f;
        }

        .btn-outline {
            height: 42px;
            padding: 0 20px;
            border-radius: 7px;
            border: 1px solid #dce1e8;
            background: white;
            color: #172033;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }

        .btn-outline:hover {
            background: #f8fafc;
        }

        /* =====================================
           RESPONSIVE
        ====================================== */

        @media (max-width: 750px) {

            .main {
                margin-left: 70px;
            }

            .topbar {
                padding: 0 15px;
            }

            .search-box {
                width: 200px;
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: span 1;
            }
        }
    </style>
@include('components.sidebar-style')
</head>

<body>

<!-- =====================================
     SIDEBAR
====================================== -->

@include('components.admin-sidebar')

<!-- =====================================
     MAIN
====================================== -->

<main class="main">

    <header class="topbar">

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
        <div class="content-inner">

            <a href="{{ route('admin.students.show', $student) }}" class="back-link">&larr; Back to Student Profile</a>

            <div class="page-header">
                <h1>Edit Student</h1>
                <p>Update {{ trim(($student->user->first_name ?? '') . ' ' . ($student->user->last_name ?? '')) ?: 'this student' }}'s account and profile details.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <strong>Please fix the following:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.students.update', $student) }}">
                @csrf
                @method('PUT')

                <div class="card">
                    <h2>Account Details</h2>

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="first_name">First Name *</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" minlength="2" maxlength="100" pattern="[\p{L}][\p{L}\s.'\-]*" title="Letters, spaces and . ' - only" value="{{ old('first_name', $student->user->first_name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" maxlength="100" pattern="[\p{L}][\p{L}\s.'\-]*" title="Letters, spaces and . ' - only" value="{{ old('last_name', $student->user->last_name) }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" class="form-control" maxlength="255" pattern="[^@\s]+@[^@\s]+\.[A-Za-z]{2,}" title="Enter a valid email address" value="{{ old('email', $student->user->email) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                inputmode="numeric" pattern="[0-9]{10}" maxlength="10"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                                value="{{ old('phone', $student->user->phone) }}">
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password" class="form-control" minlength="8" maxlength="72" autocomplete="new-password">
                            <span class="form-hint">Leave blank to keep the current password. Otherwise use at least 8 characters with an uppercase letter, a lowercase letter and a number.</span>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" maxlength="72" autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label for="account_status">Account Status *</label>
                            <select id="account_status" name="account_status" class="form-control" required>
                                <option value="active" {{ old('account_status', $student->user->account_status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('account_status', $student->user->account_status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <h2>Personal Information</h2>

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" min="1900-01-01" max="{{ now()->subYears(16)->format('Y-m-d') }}" value="{{ old('date_of_birth', optional($student->date_of_birth)->format('Y-m-d')) }}">
                            <span class="form-hint">Student must be at least 16 years old.</span>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="">Select gender</option>
                                <option value="Male" {{ old('gender', $student->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $student->gender) === 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $student->gender) === 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" id="nationality" name="nationality" class="form-control" maxlength="100" pattern="[\p{L}][\p{L}\s.'\-]*" title="Letters, spaces and . ' - only" value="{{ old('nationality', $student->nationality) }}">
                        </div>

                        <div class="form-group">
                            <label for="passport_number">Passport Number</label>
                            <input type="text" id="passport_number" name="passport_number" class="form-control" maxlength="100" pattern="[A-Za-z0-9]+" title="Letters and numbers only" oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g, '')" value="{{ old('passport_number', $student->passport_number) }}">
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" maxlength="100" pattern="[\p{L}][\p{L}\s.'\-]*" title="Letters, spaces and . ' - only" value="{{ old('city', $student->city) }}">
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <select id="country" name="country" class="form-control">
                                <option value="">Select country</option>
                                @foreach($countries as $countryOption)
                                    <option value="{{ $countryOption->country_name }}" {{ old('country', $student->country) === $countryOption->country_name ? 'selected' : '' }}>
                                        {{ $countryOption->country_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group full">
                            <label for="current_address">Address</label>
                            <textarea id="current_address" name="current_address" class="form-control" maxlength="500" minlength="5">{{ old('current_address', $student->current_address) }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.students.show', $student) }}" class="btn-outline">Cancel</a>
                    <button type="submit" class="btn-primary">Save Changes</button>
                </div>

            </form>

        </div>
    </section>

</main>


<script>
    (function () {
        var pw = document.getElementById('password');
        var conf = document.getElementById('password_confirmation');

        function checkPasswords() {
            pw.setCustomValidity('');
            conf.setCustomValidity('');

            if (pw.value && !(/[a-z]/.test(pw.value) && /[A-Z]/.test(pw.value) && /[0-9]/.test(pw.value))) {
                pw.setCustomValidity('Use at least one uppercase letter, one lowercase letter and one number.');
            }
            if ((pw.value || conf.value) && conf.value !== pw.value) {
                conf.setCustomValidity('The passwords do not match.');
            }
        }

        pw.addEventListener('input', checkPasswords);
        conf.addEventListener('input', checkPasswords);
        pw.form.addEventListener('submit', checkPasswords);
    })();
</script>

</body>
</html>
