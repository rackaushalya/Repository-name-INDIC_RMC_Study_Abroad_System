<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Fund Requirements | INDIC RMC</title>

    @include('components.page-style')
    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

<main class="main">

    <x-student-topbar current="Fund Requirements" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>My Fund Requirements</h1>
                <p>Review, download and manage your study abroad financial estimates.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('student.fund-requirements.create') }}" class="pg-btn pg-btn-primary">
                    <i class="bi bi-plus-lg"></i> Generate New Estimate
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="pg-alert success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="pg-alert error">
                <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
            </div>
        @endif

        @if ($fundRequirements->total() > 0)
            @php($latest = $fundRequirements->first())

            <div class="pg-stats">
                <div class="pg-stat">
                    <div class="pg-stat-icon"><i class="bi bi-calculator"></i></div>
                    <div>
                        <span>Total Estimates</span>
                        <strong>{{ $fundRequirements->total() }}</strong>
                    </div>
                </div>

                <div class="pg-stat">
                    <div class="pg-stat-icon blue"><i class="bi bi-clock-history"></i></div>
                    <div>
                        <span>Latest Estimate</span>
                        <strong>{{ $latest->currency }} {{ number_format((float) $latest->total_required_amount, 0) }}</strong>
                    </div>
                </div>

                <div class="pg-stat">
                    <div class="pg-stat-icon green"><i class="bi bi-globe-americas"></i></div>
                    <div>
                        <span>Latest Destination</span>
                        <strong style="font-size:16px;">{{ $latest->selectedCountry?->country_name ?? 'Not selected' }}</strong>
                    </div>
                </div>
            </div>
        @endif

        <div class="pg-card">

            @if ($fundRequirements->count())

                <div class="pg-card-head">
                    <h2><i class="bi bi-cash-coin"></i> Estimates</h2>
                    <small>{{ $fundRequirements->total() }} saved</small>
                </div>

                <div class="pg-table-wrap">
                    <table class="pg-table">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Destination / Course</th>
                                <th>Generated</th>
                                <th>Tuition</th>
                                <th>Scholarship</th>
                                <th>Total Required</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($fundRequirements as $fund)
                                <tr>
                                    <td>
                                        <a href="{{ route('student.fund-requirements.show', $fund) }}"
                                           class="pg-strong" style="color:#f97316;">
                                            FR-{{ $fund->fund_requirement_id }}
                                        </a>
                                    </td>

                                    <td>
                                        <div class="pg-strong">
                                            {{ $fund->selectedCountry?->country_name ?? 'Not selected' }}
                                        </div>
                                        <span class="pg-sub">
                                            {{ $fund->selectedCourse?->course_name ?? 'Course not selected' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $fund->generated_at?->format('d M Y') ?? $fund->created_at?->format('d M Y') ?? '—' }}
                                    </td>

                                    <td class="pg-amount">
                                        {{ $fund->currency }} {{ number_format((float) $fund->total_tuition, 2) }}
                                    </td>

                                    <td class="pg-amount" style="color:#16803d;">
                                        @if ((float) $fund->scholarship_amount > 0)
                                            − {{ $fund->currency }} {{ number_format((float) $fund->scholarship_amount, 2) }}
                                        @else
                                            <span class="pg-muted">None</span>
                                        @endif
                                    </td>

                                    <td class="pg-amount" style="color:#ea580c;">
                                        {{ $fund->currency }} {{ number_format((float) $fund->total_required_amount, 2) }}
                                    </td>

                                    <td>
                                        <div class="pg-row-actions">
                                            <a class="pg-icon-btn"
                                               href="{{ route('student.fund-requirements.show', $fund) }}"
                                               title="View details">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a class="pg-icon-btn"
                                               href="{{ route('student.fund-requirements.pdf', $fund) }}"
                                               title="Download PDF">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                            </a>

                                            <form action="{{ route('student.fund-requirements.destroy', $fund) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this fund requirement? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="pg-icon-btn danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($fundRequirements->hasPages())
                    <div class="pg-pagination">
                        {{ $fundRequirements->links('pagination.portal') }}
                    </div>
                @endif

            @else

                <div class="pg-empty">
                    <div class="pg-empty-icon"><i class="bi bi-calculator"></i></div>

                    <h3>No fund requirements yet</h3>
                    <p>
                        Create your first estimate to understand your expected<br>
                        study abroad expenses.
                    </p>

                    <a href="{{ route('student.fund-requirements.create') }}" class="pg-btn pg-btn-primary">
                        <i class="bi bi-plus-lg"></i> Generate Fund Requirement
                    </a>
                </div>

            @endif
        </div>

    </section>
</main>

</body>
</html>
