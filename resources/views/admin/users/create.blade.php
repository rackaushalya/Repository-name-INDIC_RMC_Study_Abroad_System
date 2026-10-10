<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add New User - INDIC RMC</title>

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
            justify-content: space-between;
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

        .container {
            width: 92%;
            max-width: 1100px;
            margin: 40px auto;
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .title-section h1 {
            margin: 0 0 8px;
            font-size: 30px;
            color: #172033;
        }

        .title-section p {
            margin: 0;
            color: #68758a;
            font-size: 15px;
        }

        .back-btn {
            text-decoration: none;
            background: #edf0f5;
            color: #26334b;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        .back-btn:hover {
            background: #e0e5ed;
        }

        /* Card */
        .form-card {
            background: white;
            border: 1px solid #e0e5ed;
            border-radius: 12px;
            padding: 30px;
        }

        .form-card h2 {
            margin: 0 0 6px;
            font-size: 20px;
        }

        .form-description {
            margin: 0 0 25px;
            color: #68758a;
            font-size: 14px;
        }

        /* Alerts */
        .alert {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: #fdeaea;
            color: #a32929;
            border: 1px solid #f3c8c8;
        }

        /* Form */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .full-width {
            grid-column: span 2;
        }

        label {
            font-size: 13px;
            font-weight: bold;
            color: #26334b;
            margin-bottom: 8px;
        }

        .required {
            color: #d83a3a;
        }

        .form-control {
            width: 100%;
            height: 45px;
            border: 1px solid #d8dee8;
            border-radius: 7px;
            padding: 0 13px;
            font-size: 14px;
            background: white;
            color: #172033;
            outline: none;
        }

        textarea.form-control {
            height: 110px;
            padding-top: 12px;
            resize: vertical;
        }

        .form-control:focus {
            border-color: #f97316;
        }

        .error-message {
            color: #c43333;
            font-size: 12px;
            margin-top: 6px;
        }

        .help-text {
            color: #8994a7;
            font-size: 12px;
            margin-top: 6px;
        }

        /* Section */
        .section-title {
            grid-column: span 2;
            padding-bottom: 10px;
            margin-top: 5px;
            border-bottom: 1px solid #edf0f4;
            font-size: 16px;
            font-weight: bold;
            color: #172033;
        }

        /* Buttons */
        .form-actions {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #edf0f4;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            border: none;
            border-radius: 7px;
            padding: 12px 22px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-cancel {
            background: #edf0f5;
            color: #26334b;
        }

        .btn-cancel:hover {
            background: #e0e5ed;
        }

        .btn-save {
            background: #f97316;
            color: white;
        }

        .btn-save:hover {
            background: #ea670f;
        }

        @media (max-width: 700px) {

            .container {
                width: 95%;
                margin: 20px auto;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width,
            .section-title {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 750px) {

            .main {
                margin-left: 70px;
            }

            .content {
                padding: 15px;
            }

            .topbar {
                padding: 0 15px;
            }

            .search-box {
                width: 200px;
            }
        }
    </style>
@include('components.sidebar-style')
</head>

<body>

@include('components.admin-sidebar')

<main class="main">

    <header class="topbar">

        <div class="search-box">
            <span class="search-icon"><i class="bi bi-search"></i></span>
            <input type="text" placeholder="Search students, applications...">
        </div>

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
    <div class="container">

    {{-- Page Header --}}
    <div class="page-header">

        <div class="title-section">
            <h1>Add New User</h1>
            <p>Create a new system user and assign a role.</p>
        </div>

        <a
            href="{{ route('admin.users') }}"
            class="back-btn"
        >
            ← Back to Users
        </a>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="alert alert-error">

            <strong>Please fix the following errors:</strong>

            <ul style="margin: 8px 0 0 18px;">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Create User Form --}}
    <div class="form-card">

        <h2>User Information</h2>

        <p class="form-description">
            Enter the user's personal information, login details and system role.
        </p>


        <form
            method="POST"
            action="{{ route('admin.users.store') }}"
        >

            @csrf


            <div class="form-grid">


                {{-- Personal Information --}}
                <div class="section-title">
                    Personal Information
                </div>


                {{-- First Name --}}
                <div class="form-group">

                    <label for="first_name">
                        First Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        class="form-control"
                        value="{{ old('first_name') }}"
                        placeholder="Enter first name"
                        required
                    >

                    @error('first_name')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Last Name --}}
                <div class="form-group">

                    <label for="last_name">
                        Last Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        class="form-control"
                        value="{{ old('last_name') }}"
                        placeholder="Enter last name"
                        required
                    >

                    @error('last_name')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Phone --}}
                <div class="form-group">

                    <label for="phone">
                        Phone Number
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        placeholder="Enter phone number"
                    >

                    @error('phone')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Email --}}
                <div class="form-group">

                    <label for="email">
                        Email Address <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Enter email address"
                        required
                    >

                    @error('email')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Account Information --}}
                <div class="section-title">
                    Account Information
                </div>


                {{-- Role --}}
                <div class="form-group">

                    <label for="role_id">
                        Role <span class="required">*</span>
                    </label>

                    <select
                        id="role_id"
                        name="role_id"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Select Role
                        </option>

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->role_id }}"
                                {{ old('role_id') == $role->role_id ? 'selected' : '' }}
                            >
                                {{ $role->role_name }}
                            </option>

                        @endforeach

                    </select>

                    @error('role_id')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Account Status --}}
                <div class="form-group">

                    <label for="account_status">
                        Account Status <span class="required">*</span>
                    </label>

                    <select
                        id="account_status"
                        name="account_status"
                        class="form-control"
                        required
                    >

                        <option
                            value="active"
                            {{ old('account_status', 'active') === 'active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            {{ old('account_status') === 'inactive' ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                    @error('account_status')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Password --}}
                <div class="form-group">

                    <label for="password">
                        Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter password"
                        required
                    >

                    <div class="help-text">
                        Use at least 8 characters.
                    </div>

                    @error('password')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Confirm Password --}}
                <div class="form-group">

                    <label for="password_confirmation">
                        Confirm Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Confirm password"
                        required
                    >

                    @error('password_confirmation')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


            </div>


            {{-- Form Actions --}}
            <div class="form-actions">

                <a
                    href="{{ route('admin.users') }}"
                    class="btn btn-cancel"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-save"
                >
                    Create User
                </button>

            </div>

        </form>

    </div>

    </div>
    </section>

</main>

</body>
</html>