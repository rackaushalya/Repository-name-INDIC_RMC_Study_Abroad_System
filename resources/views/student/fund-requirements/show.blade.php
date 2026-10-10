```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fund Requirement Details | INDIC RMC</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        .main { margin-left: 245px; min-height: 100vh; }

        .topbar {
            height: 72px;
            padding: 0 30px;
            background: white;
            border-bottom: 1px solid #e6e9ef;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            color: inherit;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f97316;
            color: white;
            display: grid;
            place-items: center;
        }

        .content { max-width: 1200px; margin: auto; padding: 30px; }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 25px;
        }

        h1 { font-size: 25px; margin: 0 0 8px; }

        .subtitle { font-size: 13px; color: #727c8d; margin: 0; }

        .actions { display: flex; gap: 10px; flex-wrap: wrap; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 15px;
            border: 1px solid #e1e5ed;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary { background: #f97316; border-color: #f97316; color: white; }
        .btn-primary:hover { background: #ea580c; }
        .btn-light { background: white; color: #374151; }

        .alert {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .success { background: #ecfdf3; color: #166534; border: 1px solid #bbf7d0; }

        .card {
            background: white;
            border: 1px solid #e7eaf0;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .card h2 { font-size: 16px; margin: 0 0 20px; }

        .study-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .detail-label {
            display: block;
            color: #7b8494;
            font-size: 11px;
            margin-bottom: 7px;
        }

        .detail-value {
            font-size: 13px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; min-width: 400px; }

        th, td {
            text-align: left;
            padding: 15px 12px;
            border-bottom: 1px solid #eef0f4;
            font-size: 12px;
        }

        th {
            background: #fafbfc;
            color: #727c8d;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: .4px;
        }

        td:last-child, th:last-child { text-align: right; }
        .amount { white-space: nowrap; font-weight: 600; }

        .deduction { color: #16803d; }

        .total-box {
            background: #fff7f1;
            border: 1px solid #fed7aa;
            border-radius: 10px;
            padding: 24px;
            margin-top: 22px;
        }

        .total-label { color: #9a5a2b; font-size: 12px; }

        .total-value {
            color: #ea580c;
            font-size: 30px;
            font-weight: 700;
            margin-top: 8px;
            overflow-wrap: anywhere;
        }

        .total-note {
            color: #8a6b58;
            font-size: 11px;
            margin-top: 8px;
        }

        .notes {
            color: #4b5563;
            font-size: 13px;
            line-height: 1.7;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .footer-note {
            font-size: 11px;
            color: #8791a1;
            line-height: 1.6;
            margin-top: 20px;
        }

        @media (max-width: 900px) {
            .main { margin-left: 70px; }
        }

        @media (max-width: 650px) {
            .main { margin-left: 0; }
            .content { padding: 20px 15px; }
            .topbar { padding: 0 15px; }
            .heading { flex-direction: column; }
            .study-grid { grid-template-columns: 1fr; }
            .card { padding: 18px; }
            .total-value { font-size: 23px; }
        }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

<main class="main">
    <header class="topbar">
        <a href="{{ route('student.account.edit') }}" class="user">
            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->first_name ?? 'S', 0, 1)) }}
            </div>
            {{ trim((auth()->user()->first_name ?? '') . ' ' .
                (auth()->user()->last_name ?? '')) ?: 'Student' }}
        </a>
    </header>

    <section class="content">

        <div class="heading">
            <div>
                <h1>Fund Requirement Details</h1>
                <p class="subtitle">
                    Review the financial estimate for your study abroad plan.
                </p>
            </div>

            <div class="actions">
                <a href="{{ route('student.fund-requirements.index') }}"
                   class="btn btn-light">
                    <i class="bi bi-arrow-left"></i> Back to My Estimates
                </a>

                <button type="button" onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer"></i> Print
                </button>

                <a href="{{ route('student.fund-requirements.pdf', $fundRequirement) }}"
                class="btn-download"
                style="display:inline-block; padding:10px 18px; background:#f97316; color:white; text-decoration:none; border-radius:6px; margin-right:8px;">
                    <i class="bi bi-file-earmark-pdf"></i>Download PDF
                </a>

            </div>
        </div>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <h2><i class="bi bi-mortarboard"></i> Study Information</h2>

            <div class="study-grid">
                <div>
                    <span class="detail-label">Destination Country</span>
                    <div class="detail-value">
                        {{ $fundRequirement->selectedCountry?->country_name ?? 'Not selected' }}
                    </div>
                </div>

                <div>
                    <span class="detail-label">Selected Course</span>
                    <div class="detail-value">
                        {{ $fundRequirement->selectedCourse?->course_name ?? 'Not selected' }}
                    </div>
                </div>

                <div>
                    <span class="detail-label">University</span>
                    <div class="detail-value">
                        {{ $fundRequirement->selectedCourse?->university?->university_name ?? 'Not specified' }}
                    </div>
                </div>

                <div>
                    <span class="detail-label">Related Application ID</span>
                    <div class="detail-value">
                        {{ $fundRequirement->application_id ?? 'Not linked' }}
                    </div>
                </div>

                <div>
                    <span class="detail-label">Generated Date</span>
                    <div class="detail-value">
                        {{ $fundRequirement->generated_at?->format('d F Y, h:i A') ?? $fundRequirement->created_at?->format('d F Y, h:i A') ?? '—' }}
                    </div>
                </div>

                <div>
                    <span class="detail-label">Currency</span>
                    <div class="detail-value">{{ $fundRequirement->currency }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <h2><i class="bi bi-receipt"></i> Expense Breakdown</h2>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Expense Category</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($fundRequirement->details as $detail)
                            <tr>
                                <td>{{ $detail->expense_category }}</td>
                                <td>{{ $detail->description ?? '—' }}</td>
                                <td class="amount {{ strtolower($detail->expense_category) === 'scholarship' ? 'deduction' : '' }}">
                                    @if (strtolower($detail->expense_category) === 'scholarship')
                                        −
                                    @endif
                                    {{ $detail->currency }} {{ number_format((float) $detail->amount, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No expense details are available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="total-box">
                <div class="total-label">Total Funds Required After Scholarship</div>
                <div class="total-value">
                    {{ $fundRequirement->currency }}
                    {{ number_format((float) $fundRequirement->total_required_amount, 2) }}
                </div>
                <div class="total-note">
                    This is an estimate based on the costs entered. Actual expenses may vary.
                </div>
            </div>
        </div>

        @if ($fundRequirement->notes)
            <div class="card">
                <h2><i class="bi bi-sticky"></i> Additional Notes</h2>
                <div class="notes">{{ $fundRequirement->notes }}</div>
            </div>
        @endif

        <p class="footer-note">
            This report is an estimate for planning purposes only. Confirm tuition,
            living costs, travel expenses, scholarship eligibility, and any financial
            evidence requirements with the relevant university and immigration authority.
        </p>

    </section>
</main>

</body>
</html>