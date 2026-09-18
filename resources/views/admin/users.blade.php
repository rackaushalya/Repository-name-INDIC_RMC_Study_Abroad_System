<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management | INDIC RMC</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        /* -------------------------------------------------
           Layout
        ------------------------------------------------- */

        .page {
            min-height: 100vh;
        }

        .content {
            padding: 35px;
            max-width: 1500px;
            margin: auto;
        }

        /* -------------------------------------------------
           Header
        ------------------------------------------------- */

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .title-section h1 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .title-section p {
            color: #6b7280;
            font-size: 15px;
        }

        .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f58220;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .add-btn:hover {
            background: #df7015;
        }

        /* -------------------------------------------------
           Alerts
        ------------------------------------------------- */

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #e8f7ee;
            color: #176b3a;
            border: 1px solid #b8e5c8;
        }

        .alert-error {
            background: #fdecec;
            color: #a32222;
            border: 1px solid #f3bcbc;
        }

        /* -------------------------------------------------
           Filters
        ------------------------------------------------- */

        .filter-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr 220px 220px auto auto;
            gap: 12px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            background: white;
            color: #111827;
            outline: none;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #f58220;
            box-shadow: 0 0 0 2px rgba(245, 130, 32, 0.12);
        }

        .btn {
            height: 42px;
            padding: 0 18px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-search {
            background: #172033;
            color: white;
        }

        .btn-search:hover {
            background: #0f172a;
        }

        .btn-reset {
            background: #eef1f5;
            color: #374151;
        }

        .btn-reset:hover {
            background: #e2e6ec;
        }

        /* -------------------------------------------------
           Table Card
        ------------------------------------------------- */

        .table-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
        }

        .table-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            font-size: 18px;
            font-weight: 700;
        }

        .user-count {
            color: #6b7280;
            font-size: 13px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        thead {
            background: #f8fafc;
        }

        th {
            text-align: left;
            padding: 14px 18px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #6b7280;
            font-weight: 700;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 16px 18px;
            border-bottom: 1px solid #edf0f3;
            font-size: 14px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fafbfc;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* -------------------------------------------------
           User
        ------------------------------------------------- */

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff1e6;
            color: #f58220;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-name {
            font-weight: 600;
            color: #172033;
            margin-bottom: 3px;
        }

        .user-id {
            font-size: 12px;
            color: #9ca3af;
        }

        .email {
            color: #4b5563;
        }

        .phone {
            color: #6b7280;
        }

        /* -------------------------------------------------
           Badges
        ------------------------------------------------- */

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .role-admin {
            background: #eee8ff;
            color: #6341a5;
        }

        .role-consultant {
            background: #e7f1ff;
            color: #2563a8;
        }

        .role-student {
            background: #e8f7ee;
            color: #187044;
        }

        .role-default {
            background: #eef1f5;
            color: #4b5563;
        }

        .status-active {
            background: #e8f7ee;
            color: #176b3a;
        }

        .status-inactive {
            background: #fdecec;
            color: #a32222;
        }

        /* -------------------------------------------------
           Actions
        ------------------------------------------------- */

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 7px 11px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            background: none;
        }

        .view-btn {
            background: #eef4ff;
            color: #285da8;
        }

        .view-btn:hover {
            background: #dfeaff;
        }

        .edit-btn {
            background: #fff4e8;
            color: #b85b0a;
        }

        .edit-btn:hover {
            background: #ffe9d0;
        }

        .delete-btn {
            background: #fdecec;
            color: #a32222;
        }

        .delete-btn:hover {
            background: #f9dada;
        }

        .status-btn {
            background: #f1f5f9;
            color: #475569;
        }

        .status-btn:hover {
            background: #e2e8f0;
        }

        .inline-form {
            display: inline;
        }

        /* -------------------------------------------------
           Empty State
        ------------------------------------------------- */

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-state h3 {
            color: #374151;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* -------------------------------------------------
           Pagination
        ------------------------------------------------- */

        .pagination-section {
            padding: 18px 22px;
            border-top: 1px solid #e5e7eb;
        }

        .pagination-section nav {
            display: flex;
            justify-content: center;
        }

        .pagination-section svg {
            width: 18px;
            height: 18px;
        }

        /* -------------------------------------------------
           Responsive
        ------------------------------------------------- */

        @media (max-width: 1000px) {
            .filter-form {
                grid-template-columns: 1fr 1fr;
            }

            .top-section {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 650px) {
            .content {
                padding: 20px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .title-section h1 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <main class="content">

        {{-- -------------------------------------------------
             Header
        ------------------------------------------------- --}}

        <div class="top-section">

            <div class="title-section">

                <h1>User Management</h1>

                <p>
                    Manage system users, roles and account status.
                </p>

            </div>

            <a href="{{ route('admin.users.create') }}" class="add-btn">
                + Add New User
            </a>

        </div>


        {{-- -------------------------------------------------
             Success Message
        ------------------------------------------------- --}}

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- -------------------------------------------------
             Error Message
        ------------------------------------------------- --}}

        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
            </div>

        @endif


        {{-- -------------------------------------------------
             Validation Errors
        ------------------------------------------------- --}}

        @if($errors->any())

            <div class="alert alert-error">

                <strong>Please check the following:</strong>

                <ul style="margin-top: 8px; padding-left: 20px;">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- -------------------------------------------------
             Search & Filters
        ------------------------------------------------- --}}

        <div class="filter-card">

            <form
                method="GET"
                action="{{ route('admin.users') }}"
                class="filter-form"
            >

                {{-- Search --}}

                <div class="form-group">

                    <label for="search">
                        Search
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        class="form-control"
                        placeholder="Name, email or phone..."
                        value="{{ request('search') }}"
                    >

                </div>


                {{-- Role --}}

                <div class="form-group">

                    <label for="role_id">
                        Role
                    </label>

                    <select
                        id="role_id"
                        name="role_id"
                        class="form-control"
                    >

                        <option value="">
                            All Roles
                        </option>

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->role_id }}"
                                {{ request('role_id') == $role->role_id ? 'selected' : '' }}
                            >
                                {{ $role->role_name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Account Status --}}

                <div class="form-group">

                    <label for="account_status">
                        Account Status
                    </label>

                    <select
                        id="account_status"
                        name="account_status"
                        class="form-control"
                    >

                        <option value="">
                            All Statuses
                        </option>

                        <option
                            value="Active"
                            {{ request('account_status') === 'Active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="Inactive"
                            {{ request('account_status') === 'Inactive' ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- Search Button --}}

                <button
                    type="submit"
                    class="btn btn-search"
                >
                    Search
                </button>


                {{-- Reset --}}

                <a
                    href="{{ route('admin.users') }}"
                    class="btn btn-reset"
                >
                    Reset
                </a>

            </form>

        </div>


        {{-- -------------------------------------------------
             Users Table
        ------------------------------------------------- --}}

        <div class="table-card">

            <div class="table-header">

                <h2>
                    System Users
                </h2>

                <span class="user-count">

                    {{ $users->total() }}
                    {{ $users->total() === 1 ? 'user' : 'users' }}

                </span>

            </div>


            <div class="table-wrapper">

                @if($users->count() > 0)

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    User
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Phone
                                </th>

                                <th>
                                    Role
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($users as $user)

                                <tr>

                                    {{-- User --}}

                                    <td>

                                        <div class="user-info">

                                            <div class="avatar">

                                                {{ strtoupper(substr($user->first_name ?? 'U', 0, 1)) }}

                                            </div>

                                            <div>

                                                <div class="user-name">

                                                    {{ $user->first_name }}
                                                    {{ $user->last_name }}

                                                </div>

                                                <div class="user-id">

                                                    ID: {{ $user->user_id }}

                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Email --}}

                                    <td>

                                        <span class="email">

                                            {{ $user->email }}

                                        </span>

                                    </td>


                                    {{-- Phone --}}

                                    <td>

                                        <span class="phone">

                                            {{ $user->phone ?: 'Not provided' }}

                                        </span>

                                    </td>


                                    {{-- Role --}}

                                    <td>

                                        @php

                                            $roleName = $user->role->role_name ?? 'No Role';

                                            $roleClass = match(strtolower($roleName)) {
                                                'admin' => 'role-admin',
                                                'consultant' => 'role-consultant',
                                                'student' => 'role-student',
                                                default => 'role-default',
                                            };

                                        @endphp

                                        <span class="badge {{ $roleClass }}">

                                            {{ $roleName }}

                                        </span>

                                    </td>


                                    {{-- Status --}}

                                    <td>

                                        @if($user->account_status === 'Active')

                                            <span class="badge status-active">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge status-inactive">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}

                                    <td>

                                        <div class="actions">

                                            {{-- View --}}

                                            <a
                                                href="{{ route('admin.users.show', $user) }}"
                                                class="action-btn view-btn"
                                            >
                                                View
                                            </a>


                                            {{-- Edit --}}

                                            <a
                                                href="{{ route('admin.users.edit', $user) }}"
                                                class="action-btn edit-btn"
                                            >
                                                Edit
                                            </a>


                                            {{-- Activate / Deactivate --}}

                                            <form
                                                method="POST"
                                                action="{{ route('admin.users.status', $user) }}"
                                                class="inline-form"
                                            >

                                                @csrf

                                                @method('PATCH')

                                                @if($user->account_status === 'Active')

                                                    <input
                                                        type="hidden"
                                                        name="account_status"
                                                        value="Inactive"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="action-btn status-btn"
                                                        onclick="return confirm('Deactivate this user account?')"
                                                    >
                                                        Deactivate
                                                    </button>

                                                @else

                                                    <input
                                                        type="hidden"
                                                        name="account_status"
                                                        value="Active"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="action-btn status-btn"
                                                        onclick="return confirm('Activate this user account?')"
                                                    >
                                                        Activate
                                                    </button>

                                                @endif

                                            </form>


                                            {{-- Delete --}}

                                            <form
                                                method="POST"
                                                action="{{ route('admin.users.destroy', $user) }}"
                                                class="inline-form"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-btn delete-btn"
                                                    onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                @else

                    <div class="empty-state">

                        <h3>
                            No Users Found
                        </h3>

                        <p>
                            There are no users matching your current search or filters.
                        </p>

                    </div>

                @endif

            </div>


            {{-- -------------------------------------------------
                 Pagination
            ------------------------------------------------- --}}

            @if($users->hasPages())

                <div class="pagination-section">

                    {{ $users->links() }}

                </div>

            @endif

        </div>

    </main>

</div>

</body>
</html>