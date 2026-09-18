<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management - INDIC RMC</title>

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
            max-width: 1450px;
            margin: 35px auto;
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

        .add-btn {
            background: #ff851b;
            color: white;
            text-decoration: none;
            padding: 13px 22px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            transition: 0.2s;
        }

        .add-btn:hover {
            background: #e96f08;
        }

        /* Alerts */
        .alert {
            padding: 15px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #e7f8ee;
            color: #177245;
            border: 1px solid #c6ecd7;
        }

        .alert-error {
            background: #fdeaea;
            color: #a32929;
            border: 1px solid #f3c8c8;
        }

        /* Search */
        .search-card {
            background: white;
            border: 1px solid #e0e5ed;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 25px;
        }

        .search-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto auto;
            gap: 12px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #26334b;
        }

        .form-control {
            width: 100%;
            height: 42px;
            border: 1px solid #d8dee8;
            border-radius: 7px;
            padding: 0 12px;
            font-size: 14px;
            background: white;
            outline: none;
        }

        .form-control:focus {
            border-color: #ff851b;
        }

        .search-btn,
        .reset-btn {
            height: 42px;
            padding: 0 20px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .search-btn {
            background: #17233c;
            color: white;
        }

        .search-btn:hover {
            background: #0f192d;
        }

        .reset-btn {
            background: #edf0f5;
            color: #26334b;
        }

        .reset-btn:hover {
            background: #e0e5ed;
        }

        /* Users card */
        .users-card {
            background: white;
            border: 1px solid #e0e5ed;
            border-radius: 12px;
            overflow: hidden;
        }

        .users-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px;
            border-bottom: 1px solid #e5e9ef;
        }

        .users-header h2 {
            margin: 0;
            font-size: 19px;
        }

        .user-count {
            color: #68758a;
            font-size: 14px;
        }

        /* Table */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8fafc;
        }

        th {
            text-align: left;
            padding: 15px 18px;
            font-size: 12px;
            color: #536078;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-bottom: 1px solid #e5e9ef;
        }

        td {
            padding: 16px 18px;
            border-bottom: 1px solid #edf0f4;
            font-size: 14px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fafbfd;
        }

        /* User */
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff0e2;
            color: #ff851b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 15px;
        }

        .user-name {
            font-weight: bold;
            color: #17233c;
            margin-bottom: 4px;
        }

        .user-id {
            color: #8994a7;
            font-size: 12px;
        }

        /* Role badge */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .role-student {
            background: #e4f6ec;
            color: #16804a;
        }

        .role-consultant {
            background: #e6f0ff;
            color: #2467b8;
        }

        .role-admin {
            background: #eee7ff;
            color: #7041c6;
        }

        .role-super-admin {
            background: #ffe8e8;
            color: #c52f2f;
        }

        .role-default {
            background: #edf0f4;
            color: #586579;
        }

        /* Status */
        .status {
            display: inline-flex;
            align-items: center;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-active {
            background: #e4f7ec;
            color: #18804b;
        }

        .status-inactive {
            background: #fde8e8;
            color: #c43333;
        }

        /* Actions */
        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .action-btn {
            border: none;
            text-decoration: none;
            padding: 7px 11px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-view {
            background: #e9f1ff;
            color: #2864b4;
        }

        .btn-view:hover {
            background: #dce9ff;
        }

        .btn-edit {
            background: #fff0df;
            color: #d66a0b;
        }

        .btn-edit:hover {
            background: #ffe5c9;
        }

        .btn-status {
            background: #edf1f5;
            color: #45546a;
        }

        .btn-status:hover {
            background: #e0e6ed;
        }

        .btn-delete {
            background: #fde7e7;
            color: #c33131;
        }

        .btn-delete:hover {
            background: #fbd8d8;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper nav {
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper svg {
            width: 18px;
            height: 18px;
        }

        /* Empty */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #7b8799;
        }

        .empty-state h3 {
            margin-bottom: 8px;
            color: #26334b;
        }

        /* Responsive */
        @media (max-width: 1000px) {
            .search-grid {
                grid-template-columns: 1fr 1fr;
            }

            .search-grid .form-group:first-child {
                grid-column: span 2;
            }
        }

        @media (max-width: 700px) {
            .container {
                width: 95%;
                margin: 20px auto;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 18px;
            }

            .search-grid {
                grid-template-columns: 1fr;
            }

            .search-grid .form-group:first-child {
                grid-column: auto;
            }

            .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .action-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container">

    {{-- Page Header --}}
    <div class="page-header">

        <div class="title-section">
            <h1>User Management</h1>
            <p>Manage system users, roles and account status.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="add-btn">
            + Add New User
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif


    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-error">
            <strong>Please fix the following:</strong>

            <ul style="margin: 8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- Search and Filter --}}
    <div class="search-card">

        <form method="GET" action="{{ route('admin.users') }}">

            <div class="search-grid">

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


                <div class="form-group">
                    <label for="role_id">
                        Role
                    </label>

                    <select
                        name="role_id"
                        id="role_id"
                        class="form-control"
                    >

                        <option value="">
                            All Roles
                        </option>

                        @isset($roles)

                            @foreach($roles as $role)

                                <option
                                    value="{{ $role->role_id }}"
                                    {{ request('role_id') == $role->role_id ? 'selected' : '' }}
                                >
                                    {{ $role->role_name }}
                                </option>

                            @endforeach

                        @endisset

                    </select>
                </div>


                <div class="form-group">
                    <label for="account_status">
                        Account Status
                    </label>

                    <select
                        name="account_status"
                        id="account_status"
                        class="form-control"
                    >

                        <option value="">
                            All Statuses
                        </option>

                        <option
                            value="Active"
                            {{ request('account_status') == 'Active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="Inactive"
                            {{ request('account_status') == 'Inactive' ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>
                </div>


                <button
                    type="submit"
                    class="search-btn"
                >
                    Search
                </button>


                <a
                    href="{{ route('admin.users') }}"
                    class="reset-btn"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- Users Table --}}
    <div class="users-card">

        <div class="users-header">

            <h2>
                System Users
            </h2>

            <span class="user-count">
                {{ $users->total() }} users
            </span>

        </div>


        <div class="table-wrapper">

            @if($users->count())

                <table>

                    <thead>

                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach($users as $user)

                            @php

                                $roleName = $user->role->role_name ?? 'Unknown';

                                $roleClass = match(strtolower($roleName)) {
                                    'student' => 'role-student',
                                    'consultant' => 'role-consultant',
                                    'admin' => 'role-admin',
                                    'super admin',
                                    'super_admin' => 'role-super-admin',
                                    default => 'role-default'
                                };

                                $status = $user->account_status ?? 'Inactive';

                                $statusClass = strtolower($status) === 'active'
                                    ? 'status-active'
                                    : 'status-inactive';

                                $initial = strtoupper(
                                    substr($user->first_name ?? 'U', 0, 1)
                                );

                            @endphp


                            <tr>

                                {{-- User --}}
                                <td>

                                    <div class="user-info">

                                        <div class="avatar">
                                            {{ $initial }}
                                        </div>

                                        <div>

                                            <div class="user-name">

                                                {{ $user->first_name }}
                                                {{ $user->last_name }}

                                            </div>

                                            <div class="user-id">

                                                ID:
                                                {{ $user->user_id }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Email --}}
                                <td>
                                    {{ $user->email }}
                                </td>


                                {{-- Phone --}}
                                <td>
                                    {{ $user->phone ?? '—' }}
                                </td>


                                {{-- Role --}}
                                <td>

                                    <span class="badge {{ $roleClass }}">

                                        {{ $roleName }}

                                    </span>

                                </td>


                                {{-- Status --}}
                                <td>

                                    <span class="status {{ $statusClass }}">

                                        {{ $status }}

                                    </span>

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="actions">


                                        {{-- View --}}
                                        <a
                                            href="{{ route('admin.users.show', $user) }}"
                                            class="action-btn btn-view"
                                        >
                                            View
                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.users.edit', $user) }}"
                                            class="action-btn btn-edit"
                                        >
                                            Edit
                                        </a>


                                        {{-- Activate / Deactivate --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.users.status', $user) }}"
                                            style="display:inline;"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="account_status"
                                                value="{{ strtolower($status) === 'active' ? 'Inactive' : 'Active' }}"
                                            >

                                            <button
                                                type="submit"
                                                class="action-btn btn-status"
                                            >

                                                {{ strtolower($status) === 'active'
                                                    ? 'Deactivate'
                                                    : 'Activate'
                                                }}

                                            </button>

                                        </form>


                                        {{-- Delete --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.users.destroy', $user) }}"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn btn-delete"
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
                        There are currently no users matching your search.
                    </p>

                </div>

            @endif

        </div>


        {{-- Pagination --}}
        @if($users->hasPages())

            <div class="pagination-wrapper">

                {{ $users->links() }}

            </div>

        @endif

    </div>

</div>

</body>
</html>