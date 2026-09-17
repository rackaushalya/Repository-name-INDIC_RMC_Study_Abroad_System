<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Add Lead</title>

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI",
                         Roboto, Arial, sans-serif;
            background: #f7f8fa;
            color: #172033;
        }

        a { text-decoration: none; color: inherit; }

        .app { display: flex; min-height: 100vh; }

        .sidebar {
            width: 250px;
            background: #111827;
            color: #ffffff;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            overflow-y: auto;
            z-index: 100;
        }

        .brand {
            height: 76px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid #252d3b;
        }

        .brand-mark {
            width: 38px; height: 38px;
            border-radius: 8px;
            background: #f58220;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
            margin-right: 11px;
        }

        .brand-name { font-size: 17px; font-weight: 700; letter-spacing: -.3px; }
        .brand-subtitle { font-size: 10px; color: #8c96a8; margin-top: 2px; }

        .nav { padding: 20px 12px; }

        .nav-section {
            font-size: 10px; text-transform: uppercase;
            color: #697386; font-weight: 700; letter-spacing: .8px;
            padding: 0 12px; margin: 18px 0 8px;
        }

        .nav-section:first-child { margin-top: 0; }

        .nav-link {
            height: 42px; display: flex; align-items: center; gap: 12px;
            padding: 0 12px; border-radius: 7px;
            color: #b9c0cc; font-size: 13px; margin-bottom: 3px;
            transition: all .2s ease;
        }

        .nav-link:hover { background: #1c2534; color: #ffffff; }
        .nav-link.active { background: #f58220; color: #ffffff; }
        .nav-icon { width: 18px; height: 18px; flex-shrink: 0; }

        .main { margin-left: 250px; width: calc(100% - 250px); min-height: 100vh; }

        .topbar {
            height: 76px; background: #ffffff;
            border-bottom: 1px solid #e7e9ee;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 30px;
        }

        .profile { display: flex; align-items: center; gap: 10px; padding-left: 18px; border-left: 1px solid #e5e7eb; }
        .profile-avatar { width: 36px; height: 36px; border-radius: 50%; background: #f58220; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; }
        .profile-name { font-size: 12px; font-weight: 600; }
        .profile-role { font-size: 10px; color: #8a93a3; margin-top: 2px; }

        .content { padding: 28px 30px 40px; max-width: 700px; }

        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 23px; font-weight: 700; color: #111827; letter-spacing: -.4px; }
        .page-header p { margin-top: 5px; font-size: 12px; color: #737d8e; }

        .panel { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 24px; }

        .form-group { margin-bottom: 18px; }

        .form-group label {
            display: block; font-size: 11px; font-weight: 600;
            color: #4b5565; margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%; padding: 10px 12px;
            border: 1px solid #dde1e7; border-radius: 7px;
            font-size: 13px; color: #172033;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none; border-color: #f58220;
        }

        .error { display: block; color: #c0392b; font-size: 11px; margin-top: 4px; }

        .form-actions {
            display: flex; gap: 10px; margin-top: 24px;
            padding-top: 20px; border-top: 1px solid #f0f1f3;
        }

        .btn-primary {
            background: #f58220; color: #fff; border: none;
            padding: 11px 20px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer;
        }

        .btn-primary:hover { background: #de7213; }

        .btn-secondary {
            background: #ffffff; color: #4b5565;
            border: 1px solid #dde1e7;
            padding: 11px 20px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer;
        }

    </style>

</head>
<body>

<div class="app">

    <aside class="sidebar">

        <div class="brand">
            <div class="brand-mark">IR</div>
            <div>
                <div class="brand-name">INDIC RMC</div>
                <div class="brand-subtitle">Administration Portal</div>
            </div>
        </div>

        <nav class="nav">

            <div class="nav-section">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <div class="nav-section">CRM &amp; Intelligence</div>

            <a href="{{ route('admin.leads.index') }}" class="nav-link active">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M3 12h18"/>
                </svg>
                <span>Leads</span>
            </a>

            <a href="{{ route('admin.inquiries.index') }}" class="nav-link">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 19V5"/><path d="M4 19h17"/><path d="M7 15l4-5 3 3 5-7"/>
                </svg>
                <span>Inquiries</span>
            </a>

        </nav>

    </aside>

    <main class="main">

        <header class="topbar">
            <div></div>
            <div class="profile">
                <div class="profile-avatar">A</div>
                <div>
                    <div class="profile-name">Admin User</div>
                    <div class="profile-role">Administrator</div>
                </div>
            </div>
        </header>

        <section class="content">

            <div class="page-header">
                <h1>Add Lead</h1>
                <p>Create a new lead record.</p>
            </div>

            <div class="panel">

                <form action="{{ route('admin.leads.store') }}" method="POST">
                    @csrf

                    @include('admin.leads.form')

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Save Lead</button>
                        <a href="{{ route('admin.leads.index') }}" class="btn-secondary">Cancel</a>
                    </div>

                </form>

            </div>

        </section>

    </main>

</div>

</body>
</html>