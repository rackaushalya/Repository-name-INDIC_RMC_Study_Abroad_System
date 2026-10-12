<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fund Requirement Report</title>
    <style>
        @page { margin: 32px 36px; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.6;
        }

        .header {
            border-bottom: 3px solid #f97316;
            padding-bottom: 14px;
            margin-bottom: 22px;
        }

        .header table { width: 100%; border-collapse: collapse; }
        .header td { border: 0; padding: 0; vertical-align: top; }

        .brand { font-size: 24px; font-weight: bold; color: #101a2b; }
        .brand span { color: #f97316; }
        .tagline { font-size: 9px; letter-spacing: 1px; color: #8a94a6; }

        .meta { text-align: right; font-size: 10px; color: #566176; }
        .meta strong { color: #101a2b; }

        h2 {
            font-size: 13px;
            margin: 24px 0 8px;
            color: #101a2b;
            border-left: 4px solid #f97316;
            padding-left: 8px;
        }

        .report-title { font-size: 16px; font-weight: bold; margin: 0 0 4px; }

        table.grid { width: 100%; border-collapse: collapse; }

        table.grid th,
        table.grid td {
            border: 1px solid #e3e6ec;
            padding: 8px 10px;
            text-align: left;
        }

        table.grid th { background: #fff4ea; color: #7c3a0c; font-size: 10px; }
        table.info th { width: 28%; }
        .right { text-align: right !important; }
        .deduction { color: #16803d; }

        .total-box {
            margin-top: 18px;
            background: #101a2b;
            color: #fff;
            padding: 14px 16px;
        }

        .total-box table { width: 100%; border-collapse: collapse; }
        .total-box td { border: 0; padding: 0; color: #fff; }
        .total-label { font-size: 11px; color: #cbd3df; }
        .total-value { text-align: right; font-size: 18px; font-weight: bold; color: #fb923c; }

        .notes {
            border: 1px solid #e3e6ec;
            background: #fafbfc;
            padding: 10px 12px;
        }

        .footer {
            margin-top: 34px;
            padding-top: 10px;
            border-top: 1px solid #e3e6ec;
            text-align: center;
            color: #8a94a6;
            font-size: 9px;
        }
    </style>
</head>
<body>

    <div class="header">
        <table>
            <tr>
                <td>
                    <div class="brand">INDIC <span>RMC</span></div>
                    <div class="tagline">STUDY ABROAD, BRIGHTER TOMORROWS</div>
                </td>
                <td class="meta">
                    <div><strong>Reference:</strong> FR-{{ $fundRequirement->fund_requirement_id }}</div>
                    <div>
                        <strong>Generated:</strong>
                        {{ optional($fundRequirement->generated_at)->format('d M Y') ?? now()->format('d M Y') }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="report-title">Study Abroad Fund Requirement Report</div>

    <h2>Study Information</h2>

    <table class="grid info">
        <tr>
            <th>Country</th>
            <td>{{ $fundRequirement->selectedCountry->country_name ?? 'Not selected' }}</td>
        </tr>
        <tr>
            <th>Course</th>
            <td>{{ $fundRequirement->selectedCourse->course_name ?? 'Not selected' }}</td>
        </tr>
        <tr>
            <th>University</th>
            <td>{{ $fundRequirement->selectedCourse->university->university_name ?? 'Not selected' }}</td>
        </tr>
        <tr>
            <th>Currency</th>
            <td>{{ $fundRequirement->currency }}</td>
        </tr>
    </table>

    <h2>Estimated Expenses</h2>

    <table class="grid">
        <thead>
            <tr>
                <th>Expense Category</th>
                <th>Description</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fundRequirement->details as $detail)
                @php($isScholarship = strtolower($detail->expense_category) === 'scholarship')
                <tr>
                    <td>{{ $detail->expense_category }}</td>
                    <td>{{ $detail->description }}</td>
                    <td class="right {{ $isScholarship ? 'deduction' : '' }}">
                        {{ $isScholarship ? '-' : '' }}{{ $fundRequirement->currency }}
                        {{ number_format((float) $detail->amount, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        <table>
            <tr>
                <td class="total-label">Total Required Amount (after scholarship)</td>
                <td class="total-value">
                    {{ $fundRequirement->currency }}
                    {{ number_format((float) $fundRequirement->total_required_amount, 2) }}
                </td>
            </tr>
        </table>
    </div>

    @if ($fundRequirement->notes)
        <h2>Additional Notes</h2>
        <div class="notes">{{ $fundRequirement->notes }}</div>
    @endif

    <div class="footer">
        This report contains estimated study-abroad expenses. Actual costs may vary.<br>
        INDIC RMC &middot; Study Abroad, Brighter Tomorrows
    </div>

</body>
</html>
