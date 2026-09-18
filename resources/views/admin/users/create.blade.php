<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add New User - INDIC RMC</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #17233c;
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
            color: #17233c;
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
            color: #17233c;
            outline: none;
        }

        textarea.form-control {
            height: 110px;
            padding-top: 12px;
            resize: vertical;
        }

        .form-control:focus {
            border-color: #ff851b;
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
            color: #17233c;
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
            background: #ff851b;
            color: white;
        }

        .btn-save:hover {
            background: #e96f08;
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
    </style>
</head>

<body>

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
                            value="Active"
                            {{ old('account_status', 'Active') === 'Active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="Inactive"
                            {{ old('account_status') === 'Inactive' ? 'selected' : '' }}
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

</body>
</html>