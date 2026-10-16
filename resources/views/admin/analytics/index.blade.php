<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Analytics Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

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

        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 23px; font-weight: 700; color: #111827; letter-spacing: -.4px; }
        .page-header p { margin-top: 5px; font-size: 12px; color: #737d8e; }

        .stats-row {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px; margin-bottom: 24px;
        }

        .stat-card { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 20px; }
        .stat-card .stat-label { font-size: 11px; color: #8a93a3; font-weight: 600; text-transform: uppercase; letter-spacing: .4px; }
        .stat-card .stat-value { font-size: 26px; font-weight: 700; color: #172033; margin-top: 4px; }

        .grid-2 { display: grid; grid-template-columns: 1.3fr 1fr; gap: 20px; margin-bottom: 20px; }

        .panel { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 20px; }
        .panel h2 { font-size: 15px; font-weight: 700; margin-bottom: 16px; color: #111827; }

        .chart-wrap { position: relative; height: 260px; }

        .consultant-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 10px 0; border-bottom: 1px solid #f0f1f3; font-size: 12px;
        }

        .consultant-row:last-child { border-bottom: none; }

        .consultant-row .name { color: #172033; font-weight: 600; }
        .consultant-row .count { color: #f97316; font-weight: 700; }

        .empty-state { text-align: center; padding: 30px 0; color: #8a93a3; font-size: 12px; }

        @media (max-width: 900px) {
            .grid-2 { grid-template-columns: 1fr; }
        }

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
                <h1>Analytics Dashboard</h1>
                <p>Trends and breakdowns across the lead pipeline.</p>
            </div>

            <div class="stats-row">

                <div class="stat-card">
                    <div class="stat-label">Total Leads</div>
                    <div class="stat-value">{{ $totalLeads }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Conversion Rate</div>
                    <div class="stat-value">{{ $conversionRate }}%</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Loss Rate</div>
                    <div class="stat-value">{{ $lossRate }}%</div>
                </div>

            </div>

            <div class="grid-2">

                <div class="panel">
                    <h2>Leads Over Time (Last 14 Days)</h2>
                    <div class="chart-wrap">
                        <canvas id="leadsTimelineChart"></canvas>
                    </div>
                </div>

                <div class="panel">
                    <h2>Leads by Source</h2>
                    <div class="chart-wrap">
                        <canvas id="leadsSourceChart"></canvas>
                    </div>
                </div>

            </div>

            <div class="grid-2">

                <div class="panel">
                    <h2>Status Funnel</h2>
                    <div class="chart-wrap">
                        <canvas id="funnelChart"></canvas>
                    </div>
                </div>

                <div class="panel">
                    <h2>Leads per Consultant</h2>

                    @forelse ($leadsPerConsultant as $row)
                        <div class="consultant-row">
                            <span class="name">{{ $row['name'] }}</span>
                            <span class="count">{{ $row['total'] }}</span>
                        </div>
                    @empty
                        <div class="empty-state">No leads assigned to consultants yet.</div>
                    @endforelse
                </div>

            </div>

        </section>

    </main>

</div>

<script>
    const orange = '#f97316';
    const blue = '#416dc0';
    const green = '#32815a';
    const gray = '#8a93a3';
    const red = '#c0392b';

    new Chart(document.getElementById('leadsTimelineChart'), {
        type: 'line',
        data: {
            labels: @json($leadsTimelineLabels),
            datasets: [{
                label: 'Leads',
                data: @json($leadsTimelineValues),
                borderColor: orange,
                backgroundColor: 'rgba(249, 115, 22, 0.1)',
                fill: true,
                tension: 0.3,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
        }
    });

    new Chart(document.getElementById('leadsSourceChart'), {
        type: 'doughnut',
        data: {
            labels: @json($leadsBySource->pluck('source')),
            datasets: [{
                data: @json($leadsBySource->pluck('total')),
                backgroundColor: [orange, blue, green, gray, red, '#9b59b6', '#16a085'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { font: { size: 10 } } } }
        }
    });

    new Chart(document.getElementById('funnelChart'), {
        type: 'bar',
        data: {
            labels: @json($funnelLabels),
            datasets: [{
                label: 'Leads',
                data: @json($funnelValues),
                backgroundColor: [blue, orange, '#9b59b6', green, red],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
        }
    });
</script>

</body>
</html>
