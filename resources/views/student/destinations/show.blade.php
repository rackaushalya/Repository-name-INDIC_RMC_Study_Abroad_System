<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ ucfirst($country->country_name) }} | Explore Destinations | INDIC RMC</title>

    @include('components.page-style')

    <style>
        .cd-uni { padding: 22px; border-bottom: 1px solid #eef0f4; }
        .cd-uni:last-child { border-bottom: 0; }
        .cd-uni-head { display: flex; justify-content: space-between; gap: 12px; flex-wrap: wrap; margin-bottom: 14px; }
        .cd-uni-head h3 { margin: 0 0 3px; font-size: 16px; }
        .cd-uni-head span { font-size: 12px; color: #8791a1; }
        .cd-course { display: flex; justify-content: space-between; align-items: center; gap: 14px; flex-wrap: wrap; padding: 14px 16px; border: 1px solid #e7eaf0; border-radius: 12px; margin-bottom: 10px; }
        .cd-course:last-child { margin-bottom: 0; }
        .cd-course strong { display: block; font-size: 14px; text-transform: capitalize; }
        .cd-course small { color: #8791a1; font-size: 12px; }
        .cd-course-right { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .cd-list { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 10px; font-size: 13px; }
        .cd-list li { display: flex; justify-content: space-between; gap: 12px; padding-bottom: 10px; border-bottom: 1px solid #f0f2f5; }
        .cd-list li:last-child { border-bottom: 0; padding-bottom: 0; }
        .cd-cols { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
        .cd-chip-row { display: flex; gap: 8px; flex-wrap: wrap; }
        @media (max-width: 800px) { .cd-cols { grid-template-columns: 1fr; } }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

<main class="main">

    <x-student-topbar :crumbs="['Explore Destinations' => route('student.destinations.index')]" :current="ucfirst($country->country_name)" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1 style="text-transform:capitalize;">{{ $country->country_name }}</h1>
                <p>{{ $country->description ?: 'Universities, courses, costs and entry requirements for this destination.' }}</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('student.destinations.index') }}" class="pg-btn"><i class="bi bi-arrow-left"></i> All destinations</a>
                <a href="{{ route('student.applications.create', ['country' => $country->country_id]) }}" class="pg-btn pg-btn-primary">
                    <i class="bi bi-send"></i> Apply for guidance
                </a>
            </div>
        </div>

        <div class="pg-stats">
            <div class="pg-stat">
                <div class="pg-stat-icon blue"><i class="bi bi-building"></i></div>
                <div><span>Universities</span><strong>{{ $universities->count() }}</strong></div>
            </div>
            <div class="pg-stat">
                <div class="pg-stat-icon green"><i class="bi bi-journal-bookmark"></i></div>
                <div><span>Courses</span><strong>{{ $course_count }}</strong></div>
            </div>
            <div class="pg-stat">
                <div class="pg-stat-icon"><i class="bi bi-cash-coin"></i></div>
                <div>
                    <span>Tuition from</span>
                    <strong>{{ $cheapest_fee ? $cheapest_fee['currency'] . ' ' . number_format($cheapest_fee['amount']) : 'Not published' }}</strong>
                </div>
            </div>
            <div class="pg-stat">
                <div class="pg-stat-icon navy"><i class="bi bi-calendar-event"></i></div>
                <div>
                    <span>Next application deadline</span>
                    <strong>{{ $next_intake ? $next_intake->application_close_date->format('d M Y') : 'None listed' }}</strong>
                </div>
            </div>
        </div>

        {{-- Universities and courses --}}
        <div class="pg-card">
            <div class="pg-card-head">
                <h2><i class="bi bi-building"></i> Universities and courses</h2>
                <small>
                    <a href="{{ route('universities') }}" style="color:#f97316;">All universities</a> ·
                    <a href="{{ route('courses') }}" style="color:#f97316;">All courses</a>
                </small>
            </div>

            @forelse ($universities as $university)
                <div class="cd-uni">
                    <div class="cd-uni-head">
                        <div>
                            <h3>{{ $university->university_name }}</h3>
                            <span>
                                {{ $university->city ?: 'City not listed' }}
                                @if ($university->ranking) · Rank #{{ $university->ranking }} @endif
                            </span>
                        </div>

                        @if ($university->website)
                            <a href="{{ $university->website }}" target="_blank" rel="noopener noreferrer" class="pg-btn pg-btn-sm">
                                <i class="bi bi-box-arrow-up-right"></i> Website
                            </a>
                        @endif
                    </div>

                    @forelse ($university->courses as $course)
                        @php
                            $match = $fit[$course->course_id] ?? null;
                            $yearly = \App\Services\TuitionFees::yearly($course->tuitionFees)->sortBy('amount')->first();
                            $badge = ['eligible' => ['green', 'You qualify'], 'close' => ['amber', 'Almost there'], 'far' => ['red', 'Not yet']];
                        @endphp
                        <div class="cd-course">
                            <div>
                                <strong>{{ $course->course_name }}</strong>
                                <small>
                                    {{ $course->course_level }}
                                    @if ($course->field_of_study) · {{ $course->field_of_study }} @endif
                                    @if ($course->duration) · {{ $course->duration }} @endif
                                    @if ($yearly) · {{ $yearly['currency'] }} {{ number_format($yearly['amount']) }}/yr @endif
                                </small>
                            </div>

                            <div class="cd-course-right">
                                @if ($match && $match['total'] > 0)
                                    <span class="pg-badge {{ $badge[$match['status']][0] }}">{{ $badge[$match['status']][1] }} · {{ $match['passed'] }}/{{ $match['total'] }}</span>
                                @endif

                                <a href="{{ route('student.roadmap.show', $course) }}" class="pg-btn pg-btn-sm">
                                    <i class="bi bi-signpost-split"></i> Roadmap
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="pg-muted">No courses listed for this university yet.</p>
                    @endforelse
                </div>
            @empty
                <div class="pg-empty">
                    <div class="pg-empty-icon"><i class="bi bi-building"></i></div>
                    <h3>No universities yet</h3>
                    <p>Universities for this destination have not been added.</p>
                </div>
            @endforelse
        </div>

        <div class="cd-cols">
            <div class="pg-card">
                <div class="pg-card-head"><h2><i class="bi bi-award"></i> Scholarships</h2></div>
                <div class="pg-card-body">
                    @forelse ($scholarships as $scholarship)
                        @if ($loop->first) <ul class="cd-list"> @endif
                            <li>
                                <span>
                                    <strong>{{ $scholarship->scholarship_name }}</strong>
                                    <span class="pg-sub">
                                        @if ($scholarship->percentage) {{ rtrim(rtrim(number_format($scholarship->percentage, 2), '0'), '.') }}% off
                                        @elseif ($scholarship->amount) {{ number_format($scholarship->amount) }}
                                        @endif
                                    </span>
                                </span>
                                <span class="pg-muted">
                                    {{ $scholarship->application_deadline ? 'Closes ' . $scholarship->application_deadline->format('d M Y') : 'No deadline' }}
                                </span>
                            </li>
                        @if ($loop->last) </ul> @endif
                    @empty
                        <p class="pg-muted">No scholarships listed for this destination yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="pg-card">
                <div class="pg-card-head">
                    <h2><i class="bi bi-folder2-open"></i> Documents you will need</h2>
                    <small><a href="{{ route('student.documents') }}" style="color:#f97316;">My documents</a></small>
                </div>
                <div class="pg-card-body">
                    @forelse ($documents as $document)
                        @if ($loop->first) <ul class="cd-list"> @endif
                            <li>
                                <span>{{ $document->document_name }}</span>
                                <span class="pg-badge {{ $document->is_mandatory ? 'orange' : 'grey' }}">{{ $document->is_mandatory ? 'Required' : 'Optional' }}</span>
                            </li>
                        @if ($loop->last) </ul> @endif
                    @empty
                        <p class="pg-muted">No document checklist has been set for this destination yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        @if ($levels->isNotEmpty() || $fields->isNotEmpty())
            <div class="pg-card">
                <div class="pg-card-head"><h2><i class="bi bi-tags"></i> What you can study here</h2></div>
                <div class="pg-card-body">
                    <div class="cd-chip-row">
                        @foreach ($levels as $level)<span class="pg-badge blue">{{ $level }}</span>@endforeach
                        @foreach ($fields as $field)<span class="pg-badge grey">{{ $field }}</span>@endforeach
                    </div>
                </div>
            </div>
        @endif

    </section>
</main>

</body>
</html>
