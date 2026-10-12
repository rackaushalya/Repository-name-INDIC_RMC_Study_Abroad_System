<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fund Requirement Details | INDIC RMC</title>

    @include('components.page-style')

    <style>
        .pg-hero {
            background: linear-gradient(135deg, #101a2b 0%, #1d2a40 100%);
            color: #fff;
            border-radius: 14px;
            padding: 26px 28px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .pg-hero span { font-size: 12px; color: #aeb7c7; }

        .pg-hero strong {
            display: block;
            margin-top: 6px;
            font-size: 34px;
            color: #fb923c;
            overflow-wrap: anywhere;
        }

        .pg-hero small { display: block; margin-top: 8px; font-size: 12px; color: #8a94a6; }
        .pg-hero .pg-badge { background: rgba(255, 255, 255, .1); color: #fff; }

        .pg-breakdown-bar {
            display: flex;
            height: 10px;
            border-radius: 10px;
            overflow: hidden;
            background: #eef0f4;
            margin: 4px 0 20px;
        }

        .pg-breakdown-bar i { display: block; height: 100%; }

        .pg-dot {
            display: inline-block;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .pg-deduction { color: #16803d; }

        .pg-total-row td {
            background: #fff7f1;
            border-top: 2px solid #fed7aa;
            font-weight: 700;
            font-size: 14px;
        }

        .pg-notes { font-size: 13px; line-height: 1.7; color: #4b5563; white-space: pre-line; overflow-wrap: anywhere; }
        .pg-disclaimer { font-size: 11px; color: #8791a1; line-height: 1.6; }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

@php
    $fr = $fundRequirement;

    $palette = [
        'tuition' => '#f97316',
        'living' => '#2767b1',
        'travel' => '#198754',
        'other' => '#8b5cf6',
        'scholarship' => '#16a34a',
    ];

    $costs = $fr->details->filter(fn ($d) => strtolower($d->expense_category) !== 'scholarship' && (float) $d->amount > 0);
    $costTotal = (float) $costs->sum('amount');
@endphp

<main class="main">

    <x-student-topbar
        :crumbs="['Fund Requirements' => route('student.fund-requirements.index')]"
        current="FR-{{ $fr->fund_requirement_id }}" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Fund Requirement Details</h1>
                <p>Review the financial estimate for your study abroad plan.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('student.fund-requirements.index') }}" class="pg-btn">
                    <i class="bi bi-arrow-left"></i> Back to My Estimates
                </a>

                <button type="button" onclick="window.print()" class="pg-btn">
                    <i class="bi bi-printer"></i> Print
                </button>

                <a href="{{ route('student.fund-requirements.pdf', $fr) }}" class="pg-btn pg-btn-primary">
                    <i class="bi bi-file-earmark-pdf"></i> Download PDF
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="pg-alert success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <div class="pg-hero">
            <div>
                <span>Total funds required after scholarship</span>
                <strong>{{ $fr->currency }} {{ number_format((float) $fr->total_required_amount, 2) }}</strong>
                <small>
                    Reference FR-{{ $fr->fund_requirement_id }} ·
                    Generated {{ $fr->generated_at?->format('d M Y') ?? $fr->created_at?->format('d M Y') ?? '—' }}
                </small>
            </div>

            <span class="pg-badge">{{ $fr->selectedCountry?->country_name ?? 'No destination selected' }}</span>
        </div>

        <div class="pg-card">
            <div class="pg-card-head">
                <h2><i class="bi bi-mortarboard"></i> Study Information</h2>
            </div>

            <div class="pg-card-body">
                <div class="pg-detail-grid">
                    <div>
                        <span class="pg-detail-label">Destination Country</span>
                        <div class="pg-detail-value">{{ $fr->selectedCountry?->country_name ?? 'Not selected' }}</div>
                    </div>

                    <div>
                        <span class="pg-detail-label">Selected Course</span>
                        <div class="pg-detail-value">{{ $fr->selectedCourse?->course_name ?? 'Not selected' }}</div>
                    </div>

                    <div>
                        <span class="pg-detail-label">University</span>
                        <div class="pg-detail-value">{{ $fr->selectedCourse?->university?->university_name ?? 'Not specified' }}</div>
                    </div>

                    <div>
                        <span class="pg-detail-label">Related Application</span>
                        <div class="pg-detail-value">
                            @if ($fr->application_id)
                                <a href="{{ route('student.applications.show', $fr->application_id) }}" style="color:#f97316;">
                                    {{ $fr->application?->application_reference ?? 'Application #' . $fr->application_id }}
                                </a>
                            @else
                                Not linked
                            @endif
                        </div>
                    </div>

                    <div>
                        <span class="pg-detail-label">Generated</span>
                        <div class="pg-detail-value">
                            {{ $fr->generated_at?->format('d F Y, h:i A') ?? $fr->created_at?->format('d F Y, h:i A') ?? '—' }}
                        </div>
                    </div>

                    <div>
                        <span class="pg-detail-label">Currency</span>
                        <div class="pg-detail-value">{{ $fr->currency }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pg-card">
            <div class="pg-card-head">
                <h2><i class="bi bi-receipt"></i> Expense Breakdown</h2>
            </div>

            <div class="pg-card-body" style="padding-bottom:6px;">
                @if ($costTotal > 0)
                    <div class="pg-breakdown-bar" title="Share of each cost">
                        @foreach ($costs as $detail)
                            <i style="width: {{ round(((float) $detail->amount / $costTotal) * 100, 2) }}%; background: {{ $palette[strtolower($detail->expense_category)] ?? '#94a3b8' }};"></i>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="pg-table-wrap">
                <table class="pg-table" style="min-width:480px;">
                    <thead>
                        <tr>
                            <th>Expense Category</th>
                            <th>Description</th>
                            <th style="text-align:right;">Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($fr->details as $detail)
                            @php($isScholarship = strtolower($detail->expense_category) === 'scholarship')

                            <tr>
                                <td class="pg-strong">
                                    <span class="pg-dot" style="background: {{ $palette[strtolower($detail->expense_category)] ?? '#94a3b8' }};"></span>{{ $detail->expense_category }}
                                </td>
                                <td>{{ $detail->description ?? '—' }}</td>
                                <td class="pg-amount {{ $isScholarship ? 'pg-deduction' : '' }}" style="text-align:right;">
                                    {{ $isScholarship ? '−' : '' }}
                                    {{ $detail->currency }} {{ number_format((float) $detail->amount, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="pg-muted" style="text-align:center;">No expense details are available.</td>
                            </tr>
                        @endforelse

                        <tr class="pg-total-row">
                            <td colspan="2">Total funds required</td>
                            <td style="text-align:right;color:#ea580c;">
                                {{ $fr->currency }} {{ number_format((float) $fr->total_required_amount, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @if ($fr->notes)
            <div class="pg-card">
                <div class="pg-card-head">
                    <h2><i class="bi bi-sticky"></i> Additional Notes</h2>
                </div>

                <div class="pg-card-body">
                    <div class="pg-notes">{{ $fr->notes }}</div>
                </div>
            </div>
        @endif

        <p class="pg-disclaimer">
            This report is an estimate for planning purposes only. Confirm tuition,
            living costs, travel expenses, scholarship eligibility, and any financial
            evidence requirements with the relevant university and immigration authority.
        </p>

    </section>
</main>

</body>
</html>
