<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | CRM Dashboard</title>

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

        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 23px; font-weight: 700; color: #111827; letter-spacing: -.4px; }
        .page-header p { margin-top: 5px; font-size: 12px; color: #737d8e; }

        .stats-row {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px; margin-bottom: 24px;
        }

        .stat-card {
            background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 20px;
        }

        .stat-card .stat-icon {
            width: 38px; height: 38px; border-radius: 9px;
            background: #fff2e8; color: #f97316;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px; margin-bottom: 12px;
        }

        .stat-card .stat-label { font-size: 11px; color: #8a93a3; font-weight: 600; text-transform: uppercase; letter-spacing: .4px; }
        .stat-card .stat-value { font-size: 26px; font-weight: 700; color: #172033; margin-top: 4px; }

        .grid-2 { display: grid; grid-template-columns: 1.1fr 1fr; gap: 20px; }

        .panel { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 20px; }

        .panel h2 { font-size: 15px; font-weight: 700; margin-bottom: 16px; color: #111827; }

        .status-bar-row { margin-bottom: 14px; }

        .status-bar-row .status-label-row {
            display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 6px;
            color: #4b5565; font-weight: 600;
        }

        .status-bar-track { background: #f0f1f3; border-radius: 6px; height: 8px; overflow: hidden; }
        .status-bar-fill { height: 100%; border-radius: 6px; background: #f97316; }

        .activity-item {
            display: flex; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f0f1f3;
        }

        .activity-item:last-child { border-bottom: none; }

        .activity-icon {
            width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
            background: #edf3ff; color: #416dc0;
            display: flex; align-items: center; justify-content: center; font-size: 13px;
        }

        .activity-body { font-size: 12px; color: #4b5565; }
        .activity-body strong { color: #172033; }
        .activity-time { font-size: 10px; color: #8a93a3; margin-top: 2px; }

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
                <h1>CRM Dashboard</h1>
                <p>Live overview of leads, inquiries, and communication activity.</p>
            </div>

            <div class="stats-row">

                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-person-lines-fill"></i></div>
                    <div class="stat-label">Total Leads</div>
                    <div class="stat-value">{{ $totalLeads }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-question-circle-fill"></i></div>
                    <div class="stat-label">Total Inquiries</div>
                    <div class="stat-value">{{ $totalInquiries }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-chat-dots-fill"></i></div>
                    <div class="stat-label">Communications Logged</div>
                    <div class="stat-value">{{ $totalCommunications }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <div class="stat-label">Conversion Rate</div>
                    <div class="stat-value">{{ $conversionRate }}%</div>
                </div>

            </div>

            <div class="grid-2">

                <div class="panel">
                    <h2>Leads by Status</h2>

                    @forelse (['New', 'Contacted', 'Qualified', 'Converted', 'Lost'] as $status)
                        @php $count = $leadsByStatus[$status] ?? 0; @endphp
                        <div class="status-bar-row">
                            <div class="status-label-row">
                                <span>{{ $status }}</span>
                                <span>{{ $count }}</span>
                            </div>
                            <div class="status-bar-track">
                                <div class="status-bar-fill" style="width: {{ $totalLeads > 0 ? ($count / $totalLeads * 100) : 0 }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">No leads yet.</div>
                    @endforelse

                    @if ($inquiriesByStatus->count())
                        <h2 style="margin-top: 22px;">Inquiries by Status</h2>
                        @foreach ($inquiriesByStatus as $status => $count)
                            <div class="status-bar-row">
                                <div class="status-label-row">
                                    <span>{{ $status }}</span>
                                    <span>{{ $count }}</span>
                                </div>
                                <div class="status-bar-track">
                                    <div class="status-bar-fill" style="width: {{ $totalInquiries > 0 ? ($count / $totalInquiries * 100) : 0 }}%;"></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="panel">
                    <h2>Recent Communication Activity</h2>

                    @forelse ($recentCommunications as $entry)
                        <div class="activity-item">
                            <div class="activity-icon"><i class="bi bi-chat-left-text-fill"></i></div>
                            <div>
                                <div class="activity-body">
                                    <strong>{{ $entry->communication_type }}</strong>
                                    @if ($entry->lead)
                                        with {{ $entry->lead->first_name }} {{ $entry->lead->last_name }}
                                    @elseif ($entry->inquiry)
                                        on Inquiry #{{ $entry->inquiry->inquiry_id }}
                                    @endif
                                    — {{ \Illuminate\Support\Str::limit($entry->message, 60) }}
                                </div>
                                <div class="activity-time">{{ $entry->created_at?->diffForHumans() }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">No communication logged yet.</div>
                    @endforelse
                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>
