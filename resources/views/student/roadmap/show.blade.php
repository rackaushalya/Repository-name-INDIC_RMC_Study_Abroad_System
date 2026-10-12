<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admission Roadmap | INDIC RMC</title>

    @include('components.page-style')

    <style>
        .rm-hero { display: grid; grid-template-columns: 170px 1fr; gap: 26px; align-items: center; padding: 24px; }
        .rm-ring {
            width: 150px; height: 150px; border-radius: 50%;
            background: conic-gradient(var(--rm-color, #f97316) calc(var(--rm-pct) * 1%), #eef0f4 0);
            display: grid; place-items: center;
        }
        .rm-ring > div { width: 112px; height: 112px; border-radius: 50%; background: #fff; display: grid; place-items: center; text-align: center; }
        .rm-ring strong { font-size: 30px; display: block; line-height: 1; }
        .rm-ring span { font-size: 11px; color: #8791a1; }
        .rm-hero h2 { margin: 0 0 6px; font-size: 20px; text-transform: capitalize; }
        .rm-hero p { margin: 0 0 12px; font-size: 13px; color: #727c8d; }
        .rm-meta { display: flex; gap: 8px; flex-wrap: wrap; }

        .rm-cols { display: grid; grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr); gap: 20px; align-items: start; }

        .rm-group { padding: 6px 22px 18px; }
        .rm-group h3 { font-size: 12px; text-transform: uppercase; letter-spacing: .4px; color: #8791a1; margin: 16px 0 10px; }
        .rm-item { display: flex; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f0f2f5; align-items: flex-start; }
        .rm-item:last-child { border-bottom: 0; }
        .rm-item > i { font-size: 18px; margin-top: 1px; flex-shrink: 0; }
        .rm-item.met > i { color: #22a05a; }
        .rm-item.missing > i { color: #dc2626; }
        .rm-item strong { display: block; font-size: 14px; }
        .rm-item span.d { font-size: 12.5px; color: #727c8d; }
        .rm-item a.fix { margin-left: auto; flex-shrink: 0; }

        .rm-steps { counter-reset: step; list-style: none; margin: 0; padding: 18px 22px; display: flex; flex-direction: column; gap: 14px; }
        .rm-step { display: flex; gap: 12px; }
        .rm-step::before {
            counter-increment: step; content: counter(step);
            width: 28px; height: 28px; border-radius: 50%; background: #fff1e8; color: #f97316;
            display: grid; place-items: center; font-size: 13px; font-weight: 700; flex-shrink: 0;
        }
        .rm-step strong { display: block; font-size: 14px; }
        .rm-step span { font-size: 12.5px; color: #727c8d; display: block; margin-bottom: 6px; }
        .rm-step.urgent::before { background: #fde8e8; color: #c62828; }

        .rm-note { padding: 14px 22px 20px; font-size: 12.5px; color: #596579; line-height: 1.6; }

        @media (max-width: 900px) {
            .rm-cols { grid-template-columns: 1fr; }
            .rm-hero { grid-template-columns: 1fr; justify-items: center; text-align: center; }
            .rm-meta { justify-content: center; }
        }
        @media (max-width: 560px) { .rm-item { flex-wrap: wrap; } .rm-item a.fix { margin-left: 30px; } }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

@php
    $course = $plan['course'];
    $color = $plan['percent'] >= 100 ? '#22a05a' : ($plan['percent'] >= 50 ? '#f97316' : '#dc2626');
    $grouped = collect($plan['requirements'])->groupBy('group');
    $intake = $plan['intake'];
@endphp

<main class="main">

    <x-student-topbar :crumbs="['Admission Roadmap' => route('student.roadmap.index')]" :current="ucfirst($course->course_name)" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Admission Roadmap</h1>
                <p>Your personal path to this course, based on the entry requirements published for it.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('student.roadmap.index') }}" class="pg-btn"><i class="bi bi-arrow-left"></i> All courses</a>
                @if ($course->university?->country)
                    <a href="{{ route('student.destinations.show', $course->university->country) }}" class="pg-btn">
                        <i class="bi bi-globe-europe-africa"></i> {{ ucfirst($course->university->country->country_name) }}
                    </a>
                @endif
            </div>
        </div>

        {{-- Readiness --}}
        <div class="pg-card">
            <div class="rm-hero">
                <div class="rm-ring" style="--rm-pct: {{ $plan['percent'] }}; --rm-color: {{ $color }};">
                    <div>
                        <div>
                            <strong>{{ $plan['percent'] }}%</strong>
                            <span>ready</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>{{ $course->course_name }}</h2>
                    <p>
                        {{ $course->university?->university_name ?? 'University' }}
                        @if ($course->university?->country) · <span style="text-transform:capitalize;">{{ $course->university->country->country_name }}</span> @endif
                    </p>

                    <div class="rm-meta">
                        <span class="pg-badge {{ $plan['percent'] >= 100 ? 'green' : ($plan['percent'] >= 50 ? 'amber' : 'red') }}">{{ $plan['label'] }}</span>
                        @if ($plan['has_published_requirements'])
                            <span class="pg-badge grey">{{ $plan['met'] }} of {{ $plan['total'] }} met</span>
                        @endif
                        @if ($course->course_level)<span class="pg-badge blue">{{ $course->course_level }}</span>@endif
                        @if ($course->duration)<span class="pg-badge grey">{{ $course->duration }}</span>@endif
                        @if ($intake)
                            <span class="pg-badge {{ $intake['days'] !== null && $intake['days'] <= 14 ? 'red' : 'purple' }}">
                                {{ $intake['name'] }}@if ($intake['closes']) · closes {{ $intake['closes']->format('d M Y') }}@if ($intake['days'] !== null) ({{ $intake['days'] }} {{ \Illuminate\Support\Str::plural('day', $intake['days']) }})@endif @endif
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="rm-cols">

            {{-- Requirement statuses --}}
            <div class="pg-card">
                <div class="pg-card-head"><h2><i class="bi bi-list-check"></i> Requirements</h2></div>

                @if (!$plan['has_published_requirements'])
                    <div class="pg-empty">
                        <div class="pg-empty-icon"><i class="bi bi-info-circle"></i></div>
                        <h3>Nothing to check yet</h3>
                        <p>This course has not published entry requirements. Ask your consultant what the university expects.</p>
                        <a href="{{ route('contact') }}" class="pg-btn pg-btn-primary">Contact us</a>
                    </div>
                @else
                    @foreach ($grouped as $group => $items)
                        <div class="rm-group">
                            <h3>{{ $group }}</h3>

                            @foreach ($items as $item)
                                <div class="rm-item {{ $item['status'] }}">
                                    <i class="bi {{ $item['status'] === 'met' ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }}"></i>
                                    <div>
                                        <strong>{{ $item['label'] }}</strong>
                                        <span class="d">{{ $item['detail'] }}</span>
                                    </div>

                                    @if ($item['status'] !== 'met' && $item['url'])
                                        <a href="{{ $item['url'] }}" class="pg-btn pg-btn-sm fix">Fix this</a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif

                @if ($plan['other_requirements'])
                    <div class="rm-note"><strong>Other requirements:</strong> {{ $plan['other_requirements'] }}</div>
                @endif
            </div>

            {{-- Next steps --}}
            <div class="pg-card">
                <div class="pg-card-head"><h2><i class="bi bi-signpost-split"></i> Your next steps</h2></div>

                @if ($plan['has_published_requirements'] || !empty($plan['steps']))
                    <ol class="rm-steps">
                        @foreach ($plan['steps'] as $step)
                            <li class="rm-step {{ $step['urgent'] ? 'urgent' : '' }}">
                                <div>
                                    <strong>{{ $step['title'] }}</strong>
                                    <span>{{ $step['detail'] }}</span>
                                    @if ($step['url'])
                                        <a href="{{ $step['url'] }}" class="pg-btn pg-btn-sm {{ $loop->first ? 'pg-btn-primary' : '' }}">Go there <i class="bi bi-arrow-right"></i></a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endif

                <div class="rm-note" style="border-top:1px solid #eef0f4;">
                    This is guidance based on published requirements. The university makes the final decision.
                    <a href="{{ route('student.applications.create', ['country' => $course->university?->country_id, 'course' => $course->course_id]) }}" style="color:#f97316; font-weight:600;">Ask a consultant about this course</a>.
                </div>
            </div>

        </div>

    </section>
</main>

</body>
</html>
