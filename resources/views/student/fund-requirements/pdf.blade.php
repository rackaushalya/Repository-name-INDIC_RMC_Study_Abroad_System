```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fund Requirement Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #f97316;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }

        h1 {
            color: #f97316;
            margin-bottom: 5px;
        }

        h2 {
            font-size: 15px;
            margin-top: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 9px;
            text-align: left;
        }

        th {
            background-color: #fff0e5;
        }

        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #f97316;
            margin-top: 20px;
        }

        .notes {
            margin-top: 20px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #777;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>INDIC RMC</h1>
        <h3>Study Abroad Fund Requirement Report</h3>
        <p>Generated on: {{ optional($fundRequirement->generated_at)->format('d M Y') ?? now()->format('d M Y') }}</p>
        <p>Reference No: FR-{{ $fundRequirement->fund_requirement_id }}</p>
    </div>

    <h2>Study Information</h2>

    <table>
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

    <table>
        <thead>
            <tr>
                <th>Expense Category</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fundRequirement->details as $detail)
                <tr>
                    <td>{{ $detail->expense_category }}</td>
                    <td>{{ $detail->description }}</td>
                    <td>
                        {{ $fundRequirement->currency }}
                        {{ number_format((float) $detail->amount, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Required Amount:
        {{ $fundRequirement->currency }}
        {{ number_format((float) $fundRequirement->total_required_amount, 2) }}
    </div>

    @if ($fundRequirement->notes)
        <div class="notes">
            <h2>Additional Notes</h2>
            <p>{{ $fundRequirement->notes }}</p>
        </div>
    @endif

    <div class="footer">
        This report contains estimated study-abroad expenses.
        Actual costs may vary.
    </div>
</body>
</html>