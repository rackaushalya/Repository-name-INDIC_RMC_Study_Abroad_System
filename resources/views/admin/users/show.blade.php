@extends('layouts.admin')

@section('title', 'View User')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">View User</h1>

            <p class="text-muted mb-0">
                View user account information and role.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.users') }}"
               class="btn btn-secondary">
                ← Back to Users
            </a>
        </div>

    </div>


    <!-- User Information Card -->
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                User Information
            </h5>
        </div>


        <div class="card-body">

            <div class="row">

                <!-- First Name -->
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">
                        First Name
                    </label>

                    <div class="form-control bg-light">
                        {{ $user->first_name }}
                    </div>

                </div>


                <!-- Last Name -->
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">
                        Last Name
                    </label>

                    <div class="form-control bg-light">
                        {{ $user->last_name }}
                    </div>

                </div>


                <!-- Email -->
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">
                        Email Address
                    </label>

                    <div class="form-control bg-light">
                        {{ $user->email }}
                    </div>

                </div>


                <!-- Phone -->
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">
                        Phone Number
                    </label>

                    <div class="form-control bg-light">
                        {{ $user->phone ?? 'Not provided' }}
                    </div>

                </div>


                <!-- Role -->
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">
                        Role
                    </label>

                    <div class="form-control bg-light">
                        {{ $user->role->role_name ?? 'Not assigned' }}
                    </div>

                </div>


                <!-- Account Status -->
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">
                        Account Status
                    </label>

                    <div>

                        @if($user->account_status === 'Active')

                            <span class="badge bg-success">
                                Active
                            </span>

                        @elseif($user->account_status === 'Inactive')

                            <span class="badge bg-secondary">
                                Inactive
                            </span>

                        @elseif($user->account_status === 'Suspended')

                            <span class="badge bg-danger">
                                Suspended
                            </span>

                        @else

                            <span class="badge bg-warning text-dark">
                                {{ $user->account_status ?? 'Unknown' }}
                            </span>

                        @endif

                    </div>

                </div>


                <!-- User ID -->
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">
                        User ID
                    </label>

                    <div class="form-control bg-light">
                        {{ $user->user_id }}
                    </div>

                </div>


                <!-- Created At -->
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">
                        Account Created
                    </label>

                    <div class="form-control bg-light">

                        @if($user->created_at)
                            {{ $user->created_at->format('d M Y, h:i A') }}
                        @else
                            Not available
                        @endif

                    </div>

                </div>

            </div>


            <!-- Actions -->
            <div class="d-flex justify-content-end gap-2 mt-3">

                <a href="{{ route('admin.users') }}"
                   class="btn btn-secondary">
                    Back
                </a>

                <a href="{{ route('admin.users.edit', $user) }}"
                   class="btn btn-warning">
                    Edit User
                </a>

            </div>

        </div>

    </div>

</div>

@endsection