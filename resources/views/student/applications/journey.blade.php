<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Application Journey | INDIC RMC</title>

    @include('components.page-style')

    <style>
        .jn-cols { display: grid; grid-template-columns: minmax(0, 1.3fr) minmax(0, 1fr); gap: 20px; align-items: start; }

        /* timeline: vertical on every screen so it never overflows on phones */
        .jn-line { list-style: none; margin: 0; padding: 22px 24px; }
        .jn-step { position: relative; display: flex; gap: 14px; padding-bottom: 22px; }
        .jn-step:last-child { padding-bottom: 0; }
        .jn-step::before { content: ""; position: absolute; left: 13px; top: 28px; bottom: -2px; width: 2px; background: #e3e7ee; }
        .jn-step:last-child::before { display: none; }
        .jn-step.done::before { background: #22a05a; }
        .jn-dot { width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; font-size: 13px; flex-shrink: 0; background: #eef0f4; color: #9aa2b0; position: relative; z-index: 1; }
        .jn-step.done .jn-dot { background: #22a05a; color: #fff; }
        .jn-step.current .jn-dot { background: #f97316; color: #fff; box-shadow: 0 0 0 5px rgba(249, 115, 22, .18); }
        .jn-step.failed .jn-dot { background: #dc2626; color: #fff; }
        .jn-step strong { display: block; font-size: 14px; margin-top: 3px; }
        .jn-step.upcoming strong { color: #9aa2b0; font-weight: 600; }
        .jn-step small { color: #8791a1; font-size: 12px; }

        .jn-next { display: flex; gap: 14px; align-items: center; padding: 18px 22px; flex-wrap: wrap; }
        .jn-next-icon { width: 44px; height: 44px; border-radius: 12px; background: #fff1e8; color: #f97316; display: grid; place-items: center; font-size: 20px; flex-shrink: 0; }
        .jn-next.calm .jn-next-icon { background: #e7f7ed; color: #198754; }
        .jn-next strong { display: block; font-size: 15px; }
        .jn-next span { font-size: 12.5px; color: #727c8d; }

        .jn-dl { display: flex; gap: 12px; align-items: center; padding: 13px 22px; border-bottom: 1px solid #f0f2f5; }
        .jn-dl:last-child { border-bottom: 0; }
        .jn-dl-days { width: 56px; text-align: center; flex-shrink: 0; }
        .jn-dl-days b { display: block; font-size: 20px; line-height: 1; }
        .jn-dl-days small { font-size: 10px; text-transform: uppercase; color: #8791a1; }
        .jn-dl.overdue .jn-dl-days b, .jn-dl.urgent .jn-dl-days b { color: #dc2626; }
        .jn-dl.soon .jn-dl-days b { color: #d9770a; }
        .jn-dl strong { display: block; font-size: 13.5px; }
        .jn-dl span.d { font-size: 12px; color: #8791a1; }

        .jn-out { display: flex; gap: 10px; align-items: flex-start; padding: 12px 22px; border-bottom: 1px solid #f0f2f5; }
        .jn-out:last-child { border-bottom: 0; }
        .jn-out i { color: #dc2626; margin-top: 2px; }
        .jn-out strong { display: block; font-size: 13.5px; }
        .jn-out span.d { font-size: 12px; color: #727c8d; }
        .jn-out a { margin-left: auto; flex-shrink: 0; }

        @media (max-width: 900px) { .jn-cols { grid-template-columns: 1fr; } }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

@php
    $application = $journey['application'];
    $next = $journey['next_action'];
    $status = $application->application_status ?? 'Submitted';
    $statusBadge = match ($status) {
        'Submitted', 'Consultation Completed' => 'blue',
        'Under Review' => 'amber',
        'Consultant Assigned', 'Consultation Scheduled' => 'purple',
        'Recommendation Provided', 'Completed' => 'green',
        'Follow-up Required' => 'orange',
        'Rejected' => 'red',
        default => 'grey',
    };
    $reference = $application->application_reference ?? '#' . $application->application_id;
@endphp

<main class="main">

    <x-student-topbar :crumbs="['Consultancy Applications' => route('student.applications.index')]" :current="'Journey ' . $reference" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Application Journey</h1>
                <p>
                    {{ $reference }} ·
                    {{ $application->preferredCourse?->course_name ?? 'No course chosen' }}
                    @if ($application->preferredCountry) · <span style="text-transform:capitalize;">{{ $application->preferredCountry->country_name }}</span> @endif
                </p>
            </div>

            <div class="pg-actions">
                <span class="pg-badge {{ $statusBadge }}" style="align-self:center;">{{ $status }}</span>
                <a href="{{ route('student.applications.show', $application) }}" class="pg-btn"><i class="bi bi-eye"></i> Full details</a>
                <a href="{{ route('student.applications.index') }}" class="pg-btn"><i class="bi bi-arrow-left"></i> My applications</a>
            </div>
        </div>

        {{-- Next action --}}
        <div class="pg-card">
            <div class="jn-next {{ $next['needs_action'] ? '' : 'calm' }}">
                <div class="jn-next-icon"><i class="bi {{ $next['needs_action'] ? 'bi-lightning-charge-fill' : 'bi-check2-circle' }}"></i></div>
                <div>
                    <span>{{ $next['needs_action'] ? 'Next action' : 'Status' }}</span>
                    <strong>{{ $next['label'] }}</strong>
                    @if ($next['detail'])<span>{{ $next['detail'] }}</span>@endif
                </div>

                @if ($next['url'])
                    <a href="{{ $next['url'] }}" class="pg-btn pg-btn-primary pg-btn-sm" style="margin-left:auto;">Go <i class="bi bi-arrow-right"></i></a>
                @endif
            </div>
        </div>

        <div class="jn-cols">

            {{-- Timeline --}}
            <div class="pg-card">
                <div class="pg-card-head"><h2><i class="bi bi-diagram-3"></i> Progress</h2></div>

                <ol class="jn-line">
                    @foreach ($journey['timeline'] as $step)
                        <li class="jn-step {{ $step['state'] }}">
                            <div class="jn-dot">
                                @if ($step['state'] === 'done')<i class="bi bi-check-lg"></i>
                                @elseif ($step['state'] === 'failed')<i class="bi bi-x-lg"></i>
                                @elseif ($step['state'] === 'current')<i class="bi bi-three-dots"></i>
                                @else<i class="bi bi-circle"></i>
                                @endif
                            </div>
                            <div>
                                <strong>{{ $step['label'] }}</strong>
                                <small>
                                    @if ($step['date']) {{ $step['date']->format('d M Y, h:i A') }}
                                    @elseif ($step['state'] === 'current') In progress
                                    @elseif ($step['state'] === 'upcoming') Not reached yet
                                    @endif
                                </small>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>

            <div>
                {{-- Deadlines --}}
                <div class="pg-card">
                    <div class="pg-card-head"><h2><i class="bi bi-alarm"></i> Deadlines</h2></div>

                    @forelse ($journey['deadlines'] as $deadline)
                        <div class="jn-dl {{ $deadline['urgency'] }}">
                            <div class="jn-dl-days">
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
                                <span class="d">{{ $deadline['date']->format('d M Y') }} · {{ $deadline['detail'] }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="pg-card-body"><p class="pg-muted">No deadlines for this application. Intake and scholarship dates will appear here when they are set.</p></div>
                    @endforelse
                </div>

                {{-- Outstanding --}}
                <div class="pg-card">
                    <div class="pg-card-head">
                        <h2><i class="bi bi-exclamation-triangle"></i> Outstanding requirements</h2>
                        @if ($journey['roadmap'])
                            <small><a href="{{ route('student.roadmap.show', $journey['roadmap']['course']) }}" style="color:#f97316;">Open roadmap</a></small>
                        @endif
                    </div>

                    @if (!$journey['roadmap'])
                        <div class="pg-card-body"><p class="pg-muted">Pick a course on this application to see what you still need.</p></div>
                    @else
                        @forelse ($journey['outstanding'] as $item)
                            <div class="jn-out">
                                <i class="bi bi-x-circle-fill"></i>
                                <div>
                                    <strong>{{ $item['label'] }}</strong>
                                    <span class="d">{{ $item['detail'] }}</span>
                                </div>
                                @if ($item['url'])<a href="{{ $item['url'] }}" class="pg-btn pg-btn-sm">Fix</a>@endif
                            </div>
                        @empty
                            <div class="pg-card-body"><p class="pg-muted"><i class="bi bi-check-circle-fill" style="color:#22a05a;"></i> Nothing outstanding. You meet every published requirement.</p></div>
                        @endforelse
                    @endif
                </div>
            </div>

        </div>

    </section>
</main>

</body>
</html>
