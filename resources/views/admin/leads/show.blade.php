<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | {{ $lead->first_name }} {{ $lead->last_name }}</title>

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

        .content { padding: 28px 30px 40px; max-width: 760px; }

        .page-header {
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: 24px;
        }

        .page-header h1 { font-size: 23px; font-weight: 700; color: #111827; letter-spacing: -.4px; }
        .page-header p { margin-top: 5px; font-size: 12px; color: #737d8e; }

        .header-actions { display: flex; gap: 10px; }

        .btn-primary {
            background: #f97316; color: #fff; border: none;
            padding: 10px 16px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer; display: inline-block;
        }

        .btn-secondary {
            background: #ffffff; color: #4b5565; border: 1px solid #dde1e7;
            padding: 10px 16px; border-radius: 7px;
            font-size: 12px; font-weight: 600; cursor: pointer; display: inline-block;
        }

        .panel { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 24px; margin-bottom: 20px; }

        .panel h2 { font-size: 14px; font-weight: 700; margin-bottom: 16px; color: #111827; }

        .detail-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
        }

        .detail-item .label { font-size: 10px; text-transform: uppercase; letter-spacing: .5px; color: #8a93a3; font-weight: 600; }
        .detail-item .value { font-size: 13px; color: #172033; font-weight: 600; margin-top: 4px; }

        .badge { display: inline-block; padding: 5px 8px; border-radius: 5px; font-size: 9px; font-weight: 600; }
        .badge-orange { background: #fff2e8; color: #d9650b; }
        .badge-blue { background: #edf3ff; color: #416dc0; }
        .badge-green { background: #edf8f2; color: #32815a; }
        .badge-red { background: #fdecec; color: #c0392b; }
        .badge-gray { background: #f0f1f3; color: #697386; }

        .notes-box {
            background: #f8fafc; border: 1px solid #eceff3; border-radius: 7px;
            padding: 14px; font-size: 12px; color: #4b5565; margin-top: 18px; white-space: pre-wrap;
        }

        .comm-item {
            display: flex; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f0f1f3;
        }

        .comm-item:last-child { border-bottom: none; }

        .comm-icon {
            width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
            background: #edf3ff; color: #416dc0;
            display: flex; align-items: center; justify-content: center; font-size: 13px;
        }

        .comm-body { font-size: 12px; color: #4b5565; }
        .comm-body strong { color: #172033; }
        .comm-time { font-size: 10px; color: #8a93a3; margin-top: 2px; }

        .empty-state { text-align: center; padding: 20px 0; color: #8a93a3; font-size: 12px; }

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
                    <h1>{{ $lead->first_name }} {{ $lead->last_name }}</h1>
                    <p>Lead details and communication history.</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('admin.leads.edit', $lead->lead_id) }}" class="btn-secondary">Edit</a>
                    <a href="{{ route('admin.leads.index') }}" class="btn-secondary">Back to Leads</a>
                </div>
            </div>

            <div class="panel">
                <h2>Lead Details</h2>

                <div class="detail-grid">

                    <div class="detail-item">
                        <div class="label">Email</div>
                        <div class="value">{{ $lead->email ?? '—' }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="label">Phone</div>
                        <div class="value">{{ $lead->phone ?? '—' }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="label">Source</div>
                        <div class="value">{{ $lead->source ?? '—' }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="label">Interested Country</div>
                        <div class="value">{{ $lead->interestedCountry->country_name ?? '—' }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="label">Interested Course</div>
                        <div class="value">{{ $lead->interested_course ?? '—' }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="label">Status</div>
                        <div class="value">
                            @php
                                $statusClass = match($lead->lead_status) {
                                    'New' => 'badge-blue',
                                    'Contacted' => 'badge-orange',
                                    'Qualified' => 'badge-green',
                                    'Converted' => 'badge-green',
                                    'Lost' => 'badge-red',
                                    default => 'badge-gray',
                                };
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $lead->lead_status }}</span>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="label">Assigned Consultant</div>
                        <div class="value">{{ $lead->assignedConsultant->user->first_name ?? '—' }} {{ $lead->assignedConsultant->user->last_name ?? '' }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="label">Created</div>
                        <div class="value">{{ $lead->created_at?->format('d M Y, h:i A') }}</div>
                    </div>

                </div>

                @if ($lead->notes)
                    <div class="notes-box">{{ $lead->notes }}</div>
                @endif
            </div>

            <div class="panel">
                <h2>
                    Communication History
                    <a href="{{ route('admin.communication-history.create', ['lead_id' => $lead->lead_id]) }}" class="btn-primary" style="float: right; padding: 6px 12px;">+ Log</a>
                </h2>

                @forelse ($lead->communicationHistory->sortByDesc('created_at') as $entry)
                    <div class="comm-item">
                        <div class="comm-icon"><i class="bi bi-chat-left-text-fill"></i></div>
                        <div>
                            <div class="comm-body">
                                <strong>{{ $entry->communication_type }}</strong>
                                @if ($entry->subject)
                                    — {{ $entry->subject }}
                                @endif
                                <br>{{ $entry->message }}
                            </div>
                            <div class="comm-time">{{ $entry->created_at?->format('d M Y, h:i A') }} by {{ $entry->sender->first_name ?? '—' }} {{ $entry->sender->last_name ?? '' }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">No communication logged for this lead yet.</div>
                @endforelse
            </div>

        </section>

    </main>

</div>

</body>
</html>
