{{-- Application overview, upcoming deadlines and quick links to the explorer / roadmap (dashboard). --}}
<style>
    .ao-card { background: #fff; border: 1px solid #e6e9ef; border-radius: 14px; padding: 24px 26px; margin-bottom: 24px; }
    .ao-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; flex-wrap: wrap; margin-bottom: 18px; }
    .ao-head h3 { font-size: 16px; color: #101a2b; }
    .ao-head p { font-size: 12px; color: #9aa2b0; margin-top: 3px; }
    .ao-head a.ao-link { font-size: 12.5px; font-weight: 700; color: #f97316; }

    .ao-quick { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 14px; margin-bottom: 22px; }
    .ao-quick a { display: flex; gap: 12px; align-items: center; padding: 14px 16px; border: 1px solid #e6e9ef; border-radius: 12px; transition: .15s; }
    .ao-quick a:hover { border-color: #fdba74; background: #fffaf5; }
    .ao-quick i { width: 40px; height: 40px; border-radius: 11px; background: #fff1e8; color: #f97316; display: grid; place-items: center; font-size: 18px; flex-shrink: 0; }
    .ao-quick strong { display: block; font-size: 13.5px; color: #172033; }
    .ao-quick span { font-size: 11.5px; color: #8791a1; }

    .ao-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 12px; margin-bottom: 22px; }
    .ao-stat { background: #f8fafc; border-radius: 12px; padding: 14px; text-align: center; }
    .ao-stat strong { display: block; font-size: 24px; color: #101a2b; line-height: 1.1; }
    .ao-stat span { font-size: 11px; color: #8791a1; text-transform: uppercase; letter-spacing: .3px; }
    .ao-stat.warn strong { color: #d9560a; }

    .ao-cols { display: grid; grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr); gap: 22px; }
    .ao-cols h4 { font-size: 12px; text-transform: uppercase; letter-spacing: .4px; color: #8791a1; margin-bottom: 10px; }

    .ao-app { display: flex; gap: 12px; align-items: center; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f0f2f5; flex-wrap: wrap; }
    .ao-app:last-child { border-bottom: 0; }
    .ao-app strong { display: block; font-size: 13.5px; color: #172033; text-transform: capitalize; }
    .ao-app span { font-size: 12px; color: #7c8493; }
    .ao-app .act { color: #d9560a; font-weight: 600; }

    .ao-dl { display: flex; gap: 12px; align-items: center; padding: 10px 0; border-bottom: 1px solid #f0f2f5; }
    .ao-dl:last-child { border-bottom: 0; }
    .ao-dl-days { width: 52px; text-align: center; flex-shrink: 0; }
    .ao-dl-days b { display: block; font-size: 19px; line-height: 1; color: #101a2b; }
    .ao-dl-days small { font-size: 10px; text-transform: uppercase; color: #8791a1; }
    .ao-dl.overdue .ao-dl-days b, .ao-dl.urgent .ao-dl-days b { color: #dc2626; }
    .ao-dl.soon .ao-dl-days b { color: #d9770a; }
    .ao-dl strong { display: block; font-size: 13px; color: #172033; }
    .ao-dl span { font-size: 11.5px; color: #8791a1; }

    .ao-pill { display: inline-block; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px; background: #eef0f4; color: #596579; white-space: nowrap; }
    .ao-pill.green { background: #e7f7ed; color: #198754; }
    .ao-pill.amber { background: #fff3df; color: #c46b00; }
    .ao-pill.red { background: #fde8e8; color: #c62828; }
    .ao-pill.blue { background: #e8f1ff; color: #2767b1; }
    .ao-pill.purple { background: #f1e9ff; color: #6b3fc4; }

    .ao-empty { font-size: 13px; color: #9aa2b0; padding: 8px 0; }
    .ao-empty a { color: #f97316; font-weight: 600; }

    @media (max-width: 900px) { .ao-cols { grid-template-columns: 1fr; } }
</style>

@php
    $ov = $journeyOverview;
    $statusPill = fn (string $s) => match ($s) {
        'Submitted', 'Consultation Completed' => 'blue',
        'Under Review' => 'amber',
        'Consultant Assigned', 'Consultation Scheduled' => 'purple',
        'Recommendation Provided', 'Completed' => 'green',
        'Rejected' => 'red',
        default => '',
    };
@endphp

<div class="ao-card">

    <div class="ao-head">
        <div>
            <h3><i class="bi bi-signpost-split" style="color:#f97316;"></i> My Applications &amp; Deadlines</h3>
            <p>Where each application stands, what needs you, and what is due next.</p>
        </div>

        <a href="{{ route('student.applications.index') }}" class="ao-link">View all applications</a>
    </div>

    <div class="ao-quick">
        <a href="{{ route('student.destinations.index') }}">
            <i class="bi bi-globe-europe-africa"></i>
            <div><strong>Explore Destinations</strong><span>Map, filters and comparison</span></div>
        </a>
        <a href="{{ route('student.roadmap.index') }}">
            <i class="bi bi-signpost-split-fill"></i>
            <div><strong>Admission Roadmap</strong><span>What you still need, step by step</span></div>
        </a>
        <a href="{{ route('student.notifications.index', ['filter' => 'deadlines']) }}">
            <i class="bi bi-alarm"></i>
            <div><strong>Deadline Reminders</strong><span>{{ $unreadNotificationCount }} unread {{ \Illuminate\Support\Str::plural('notification', $unreadNotificationCount) }}</span></div>
        </a>
    </div>

    @if (!$ov || $ov['counts']['total'] === 0)
        <div class="ao-empty">
            You have no applications yet.
            <a href="{{ route('student.applications.create') }}">Start your first application</a>
            or <a href="{{ route('student.destinations.index') }}">explore destinations</a> first.
        </div>
    @else
        <div class="ao-stats">
            <div class="ao-stat"><strong>{{ $ov['counts']['active'] }}</strong><span>In progress</span></div>
            <div class="ao-stat {{ $ov['counts']['needs_action'] ? 'warn' : '' }}"><strong>{{ $ov['counts']['needs_action'] }}</strong><span>Need action</span></div>
            <div class="ao-stat {{ $ov['overdue'] ? 'warn' : '' }}"><strong>{{ $ov['due_soon'] + $ov['overdue'] }}</strong><span>Deadlines soon</span></div>
            <div class="ao-stat"><strong>{{ $ov['counts']['completed'] }}</strong><span>Completed</span></div>
        </div>

        <div class="ao-cols">
            <div>
                <h4>Applications</h4>

                @foreach ($ov['journeys']->take(4) as $journey)
                    @php $app = $journey['application']; @endphp
                    <div class="ao-app">
                        <div>
                            <strong>{{ $app->preferredCourse?->course_name ?? ($app->application_reference ?? 'Application') }}</strong>
                            <span class="{{ $journey['next_action']['needs_action'] ? 'act' : '' }}">{{ $journey['next_action']['label'] }}</span>
                        </div>

                        <div style="display:flex; gap:10px; align-items:center;">
                            <span class="ao-pill {{ $statusPill($app->application_status ?? '') }}">{{ $app->application_status }}</span>
                            <a href="{{ route('student.applications.journey', $app) }}" class="ao-link" style="font-size:12px; font-weight:700; color:#f97316;">Journey</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div>
                <h4>Upcoming deadlines</h4>

                @forelse ($ov['deadlines']->take(5) as $deadline)
                    <a href="{{ $deadline['url'] }}" class="ao-dl {{ $deadline['urgency'] }}">
                        <div class="ao-dl-days">
                            @if ($deadline['days'] < 0)
                                <b>{{ abs($deadline['days']) }}</b><small>days late</small>
                            @elseif ($deadline['days'] === 0)
                                <b>0</b><small>today</small>
                            @else
                                <b>{{ $deadline['days'] }}</b><small>{{ \Illuminate\Support\Str::plural('day', $deadline['days']) }}</small>
                            @endif
                        </div>
                        <div>
                            <strong>{{ $deadline['title'] }}</strong>
                            <span>{{ $deadline['date']->format('d M Y') }}</span>
                        </div>
                    </a>
                @empty
                    <div class="ao-empty">No deadlines coming up. Intake and scholarship dates show here once they are set.</div>
                @endforelse
            </div>
        </div>
    @endif

</div>
