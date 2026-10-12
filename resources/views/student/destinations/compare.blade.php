<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Compare Destinations | INDIC RMC</title>

    @include('components.page-style')

    <style>
        .cmp-table th, .cmp-table td { vertical-align: top; }
        .cmp-table th.cmp-row { width: 190px; background: #fcfcfd; font-size: 12px; text-transform: uppercase; letter-spacing: .3px; color: #727c8d; }
        .cmp-table td ul { margin: 0; padding-left: 16px; font-size: 13px; }
        .cmp-table td li { margin-bottom: 4px; }
        .cmp-name { font-size: 17px; font-weight: 700; text-transform: capitalize; }
        .cmp-best { color: #198754; font-weight: 700; }
        .cmp-chips { display: flex; gap: 6px; flex-wrap: wrap; }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

@php
    $cheapest = $columns->filter(fn ($c) => $c['cheapest_fee'])->sortBy(fn ($c) => $c['cheapest_fee']['amount'])->first();
    $mostCourses = $columns->sortByDesc('course_count')->first();
@endphp

<main class="main">

    <x-student-topbar :crumbs="['Explore Destinations' => route('student.destinations.index')]" current="Compare" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Compare Destinations</h1>
                <p>Side by side view of {{ $columns->count() }} countries.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('student.destinations.index') }}" class="pg-btn"><i class="bi bi-arrow-left"></i> Back to explorer</a>
            </div>
        </div>

        <div class="pg-card">
            <div class="pg-table-wrap">
                <table class="pg-table cmp-table" style="min-width:{{ 190 + $columns->count() * 240 }}px;">
                    <thead>
                        <tr>
                            <th class="cmp-row"></th>
                            @foreach ($columns as $c)
                                <th>
                                    <div class="cmp-name">{{ $c['country']->country_name }}</div>
                                    <a href="{{ route('student.destinations.show', $c['country']) }}" style="color:#f97316; font-size:12px; text-transform:none;">View details</a>
                                </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <th class="cmp-row">Universities</th>
                            @foreach ($columns as $c)<td>{{ $c['universities']->count() }}</td>@endforeach
                        </tr>

                        <tr>
                            <th class="cmp-row">Courses</th>
                            @foreach ($columns as $c)
                                <td class="{{ $mostCourses && $c['country']->country_id === $mostCourses['country']->country_id && $columns->count() > 1 && $c['course_count'] > 0 ? 'cmp-best' : '' }}">{{ $c['course_count'] }}</td>
                            @endforeach
                        </tr>

                        <tr>
                            <th class="cmp-row">Tuition from (per year)</th>
                            @foreach ($columns as $c)
                                <td class="{{ $cheapest && $c['country']->country_id === $cheapest['country']->country_id ? 'cmp-best' : '' }}">
                                    {{ $c['cheapest_fee'] ? $c['cheapest_fee']['currency'] . ' ' . number_format($c['cheapest_fee']['amount']) : 'Not published' }}
                                </td>
                            @endforeach
                        </tr>

                        <tr>
                            <th class="cmp-row">Course levels</th>
                            @foreach ($columns as $c)
                                <td>
                                    <div class="cmp-chips">
                                        @forelse ($c['levels'] as $level)<span class="pg-badge blue">{{ $level }}</span>@empty<span class="pg-muted">None listed</span>@endforelse
                                    </div>
                                </td>
                            @endforeach
                        </tr>

                        <tr>
                            <th class="cmp-row">Fields of study</th>
                            @foreach ($columns as $c)
                                <td>
                                    <div class="cmp-chips">
                                        @forelse ($c['fields']->take(8) as $field)<span class="pg-badge grey">{{ $field }}</span>@empty<span class="pg-muted">None listed</span>@endforelse
                                    </div>
                                </td>
                            @endforeach
                        </tr>

                        <tr>
                            <th class="cmp-row">Scholarships</th>
                            @foreach ($columns as $c)<td>{{ $c['scholarships']->count() ?: 'None listed' }}</td>@endforeach
                        </tr>

                        <tr>
                            <th class="cmp-row">Next application deadline</th>
                            @foreach ($columns as $c)
                                <td>{{ $c['next_intake'] ? $c['next_intake']->application_close_date->format('d M Y') : 'None listed' }}</td>
                            @endforeach
                        </tr>

                        <tr>
                            <th class="cmp-row">Required documents</th>
                            @foreach ($columns as $c)
                                <td>
                                    @if ($c['documents']->isEmpty())
                                        <span class="pg-muted">No checklist yet</span>
                                    @else
                                        <ul>
                                            @foreach ($c['documents'] as $document)<li>{{ $document->document_name }}</li>@endforeach
                                        </ul>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <tr>
                            <th class="cmp-row">Universities</th>
                            @foreach ($columns as $c)
                                <td>
                                    @if ($c['universities']->isEmpty())
                                        <span class="pg-muted">None listed</span>
                                    @else
                                        <ul>
                                            @foreach ($c['universities']->take(6) as $university)<li>{{ $university->university_name }}</li>@endforeach
                                        </ul>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</main>

</body>
</html>
