@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Edit User</h1>
            <p class="text-muted mb-0">
                Update user account information and role.
            </p>
        </div>

        <a href="{{ route('admin.users') }}" class="btn btn-secondary">
            ← Back to Users
        </a>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit User Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                User Information
            </h5>
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('admin.users.update', $user) }}">

                @csrf
                @method('PUT')

                <div class="row">

                    <!-- First Name -->
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">
                            First Name <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="first_name"
                            id="first_name"
                            class="form-control @error('first_name') is-invalid @enderror"
                            value="{{ old('first_name', $user->first_name) }}"
                            required
                        >

                        @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">
                            Last Name <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="last_name"
                            id="last_name"
                            class="form-control @error('last_name') is-invalid @enderror"
                            value="{{ old('last_name', $user->last_name) }}"
                            required
                        >

                        @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">
                            Email Address <span class="text-danger">*</span>
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}"
                            required
                        >

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">
                            Phone Number
                        </label>

                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $user->phone) }}"
                        >

                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="col-md-6 mb-3">
                        <label for="role_id" class="form-label">
                            Role <span class="text-danger">*</span>
                        </label>

                        <select
                            name="role_id"
                            id="role_id"
                            class="form-select @error('role_id') is-invalid @enderror"
                            required
                        >
                            <option value="">Select Role</option>

                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->role_id }}"
                                    {{ old('role_id', $user->role_id) == $role->role_id ? 'selected' : '' }}
                                >
                                    {{ $role->role_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('role_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Account Status -->
                    <div class="col-md-6 mb-3">
                        <label for="account_status" class="form-label">
                            Account Status <span class="text-danger">*</span>
                        </label>

                        <select
                            name="account_status"
                            id="account_status"
                            class="form-select @error('account_status') is-invalid @enderror"
                            required
                        >
                            <option value="Active"
                                {{ old('account_status', $user->account_status) === 'Active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="Inactive"
                                {{ old('account_status', $user->account_status) === 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>

                            <option value="Suspended"
                                {{ old('account_status', $user->account_status) === 'Suspended' ? 'selected' : '' }}>
                                Suspended
                            </option>
                        </select>

                        @error('account_status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">
                            New Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Leave blank to keep current password"
                        >

                        <small class="text-muted">
                            Leave this field empty if you do not want to change the password.
                        </small>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">
                            Confirm New Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control"
                            placeholder="Confirm new password"
                        >
                    </div>

                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="{{ route('admin.users') }}"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Update User
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection