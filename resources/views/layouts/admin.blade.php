<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin | INDIC RMC')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            margin: 0;
            background: #f5f7fb;
            color: #172033;
            font-family: Arial, Helvetica, sans-serif;
        }

        .admin-topbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }

        .admin-logo {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .admin-logo .indic {
            color: #172033;
        }

        .admin-logo .rmc {
            color: #f58220;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #ffefe3;
            color: #f58220;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .admin-user-name {
            font-weight: 700;
            font-size: 14px;
        }

        .admin-user-role {
            color: #8a94a6;
            font-size: 12px;
        }

        .admin-content {
            min-height: calc(100vh - 72px);
            padding: 30px;
        }
    </style>

    @stack('styles')
</head>

<body>

    <header class="admin-topbar">

        <a
            href="{{ route('admin.dashboard') }}"
            style="text-decoration: none;"
        >
            <div class="admin-logo">
                <span class="indic">INDIC</span>
                <span class="rmc">RMC</span>
            </div>
        </a>

        @auth
            <div class="admin-user">

                <div class="admin-avatar">
                    {{ strtoupper(substr(Auth::user()->first_name ?? 'A', 0, 1)) }}
                </div>

                <div>
                    <div class="admin-user-name">
                        {{ Auth::user()->first_name ?? 'Admin' }}
                        {{ Auth::user()->last_name ?? '' }}
                    </div>

                    <div class="admin-user-role">
                        {{ Auth::user()->role->role_name ?? 'Administrator' }}
                    </div>
                </div>

            </div>
        @endauth

    </header>


    <main class="admin-content">

        @yield('content')

    </main>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    @stack('scripts')

</body>

</html>