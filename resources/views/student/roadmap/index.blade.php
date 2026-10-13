<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admission Roadmap | INDIC RMC</title>

    @include('components.page-style')

    <style>
        .rm-bar { height: 7px; border-radius: 10px; background: #eef0f4; overflow: hidden; min-width: 110px; }
        .rm-bar > div { height: 100%; background: #f97316; border-radius: 10px; }
        .rm-bar.full > div { background: #22a05a; }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

@php
    $badge = ['eligible' => ['green', 'You qualify'], 'close' => ['amber', 'Almost there'], 'far' => ['red', 'Not yet']];
@endphp

<main class="main">

    <x-student-topbar current="Admission Roadmap" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Admission Roadmap</h1>
                <p>Choose a course to see what you meet, what is missing, and exactly what to do next.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('student.destinations.index') }}" class="pg-btn"><i class="bi bi-globe-europe-africa"></i> Explore destinations</a>
            </div>
        </div>

        <div class="pg-card">
            <div class="pg-card-head">
                <h2><i class="bi bi-signpost-split"></i> Courses</h2>
                <small>Closest matches first</small>
            </div>

            @if ($matches->isEmpty())
                <div class="pg-empty">
                    <div class="pg-empty-icon"><i class="bi bi-signpost-split"></i></div>
                    <h3>No courses yet</h3>
                    <p>Courses will show up here once they are added.</p>
                </div>
            @else
                <div class="pg-table-wrap">
                    <table class="pg-table" style="min-width:760px;">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>University</th>
                                <th>Requirements met</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matches as $match)
                                @php $course = $match['course']; @endphp
                                <tr>
                                    <td>
                                        <span class="pg-strong" style="text-transform:capitalize;">{{ $course->course_name }}</span>
                                        <span class="pg-sub">{{ $course->course_level }}</span>
                                    </td>
                                    <td>
                                        {{ $course->university?->university_name ?? '—' }}
                                        <span class="pg-sub" style="text-transform:capitalize;">{{ $course->university?->country?->country_name }}</span>
                                    </td>
                                    <td>
                                        @if ($match['total'] > 0)
                                            <div class="rm-bar {{ $match['percent'] >= 100 ? 'full' : '' }}"><div style="width: {{ $match['percent'] }}%;"></div></div>
                                            <span class="pg-sub">{{ $match['passed'] }} of {{ $match['total'] }}</span>
                                        @else
                                            <span class="pg-muted">No published requirements</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($match['total'] > 0)
                                            <span class="pg-badge {{ $badge[$match['status']][0] }}">{{ $badge[$match['status']][1] }}</span>
                                        @else
                                            <span class="pg-badge grey">Unknown</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('student.roadmap.show', $course) }}" class="pg-btn pg-btn-sm pg-btn-primary">
                                            View Admission Roadmap
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </section>
</main>

</body>
</html>
