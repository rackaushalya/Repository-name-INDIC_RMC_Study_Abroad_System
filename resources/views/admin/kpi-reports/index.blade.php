<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | KPI Reports</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a { text-decoration: none; color: inherit; }

        .app { display: flex; min-height: 100vh; }

        .main { margin-left: 245px; min-height: 100vh; }

        .topbar {
            height: 72px; background: white; border-bottom: 1px solid #e6e9ef;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px; position: sticky; top: 0; z-index: 10;
        }

        .admin-profile { display: flex; align-items: center; gap: 12px; }

        .profile-circle {
            width: 38px; height: 38px; border-radius: 50%;
            background: #f97316; color: white;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; font-size: 13px;
        }

        .profile-info strong { display: block; font-size: 13px; }
        .profile-info span { display: block; font-size: 11px; color: #8a94a6; margin-top: 3px; }

        .content { padding: 28px 30px 40px; }

        .page-header {
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: 24px;
        }

        .page-header h1 { font-size: 23px; font-weight: 700; color: #111827; letter-spacing: -.4px; }
        .page-header p { margin-top: 5px; font-size: 12px; color: #737d8e; }

        .btn-primary {
            background: #f97316; color: #fff; border: none;
            padding: 11px 18px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer;
        }

        .btn-primary:hover { background: #e07116; }

        .kpi-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px; margin-bottom: 24px;
        }

        .kpi-card { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 20px; }
        .kpi-card .kpi-label { font-size: 11px; color: #8a93a3; font-weight: 600; text-transform: uppercase; letter-spacing: .4px; }
        .kpi-card .kpi-value { font-size: 26px; font-weight: 700; color: #172033; margin-top: 4px; }
        .kpi-card .kpi-sub { font-size: 11px; color: #8a93a3; margin-top: 4px; }

        .panel { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 20px; }
        .panel h2 { font-size: 15px; font-weight: 700; margin-bottom: 16px; color: #111827; }

        .consultant-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 10px 0; border-bottom: 1px solid #f0f1f3; font-size: 12px;
        }

        .consultant-row:last-child { border-bottom: none; }

        .consultant-row .name { color: #172033; font-weight: 600; }
        .consultant-row .count { color: #f97316; font-weight: 700; }

        .empty-state { text-align: center; padding: 30px 0; color: #8a93a3; font-size: 12px; }

        @media (max-width: 750px) {
            .main { margin-left: 70px; }
            .topbar { padding: 0 15px; }
        }

    </style>

@include('components.sidebar-style')
</head>
<body>

<div class="app">

    @include('components.admin-sidebar')

    <main class="main">

        <header class="topbar">
            <div></div>
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

            <div class="page-header">
                <div>
                    <h1>KPI Reports</h1>
                    <p>Key performance indicators for the lead pipeline, as of {{ $generatedAt->format('d M Y, h:i A') }}.</p>
                </div>
                <a href="{{ route('admin.kpi-reports.export') }}" class="btn-primary">Export PDF</a>
            </div>

            <div class="kpi-grid">

                <div class="kpi-card">
                    <div class="kpi-label">Conversion Rate</div>
                    <div class="kpi-value">{{ $conversionRate }}%</div>
                    <div class="kpi-sub">{{ $convertedLeads }} of {{ $totalLeads }} leads</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-label">Loss Rate</div>
                    <div class="kpi-value">{{ $lossRate }}%</div>
                    <div class="kpi-sub">{{ $lostLeads }} of {{ $totalLeads }} leads</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-label">Avg. Response Time</div>
                    <div class="kpi-value">{{ $avgResponseTimeHours !== null ? $avgResponseTimeHours . ' hrs' : '—' }}</div>
                    <div class="kpi-sub">Lead created → first contact</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-label">Avg. Leads / Consultant</div>
                    <div class="kpi-value">{{ $avgLeadsPerConsultant }}</div>
                    <div class="kpi-sub">{{ $activeConsultants }} active consultants</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-label">Total Inquiries</div>
                    <div class="kpi-value">{{ $totalInquiries }}</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-label">Total Communications</div>
                    <div class="kpi-value">{{ $totalCommunications }}</div>
                </div>

            </div>

            <div class="panel">
                <h2>Leads Handled per Consultant</h2>

                @forelse ($leadsPerConsultant as $row)
                    <div class="consultant-row">
                        <span class="name">{{ $row['name'] }}</span>
                        <span class="count">{{ $row['total'] }}</span>
                    </div>
                @empty
                    <div class="empty-state">No leads assigned to consultants yet.</div>
                @endforelse
            </div>

        </section>

    </main>

</div>

</body>
</html>
