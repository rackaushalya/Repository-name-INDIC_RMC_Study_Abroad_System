<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Helvetica, Arial, sans-serif; color: #172033; font-size: 12px; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        .subtitle { color: #737d8e; font-size: 11px; margin-bottom: 24px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        th, td { text-align: left; padding: 8px 10px; border-bottom: 1px solid #e7e9ed; font-size: 11px; }
        th { background: #f5f7fb; color: #4b5565; text-transform: uppercase; font-size: 9px; letter-spacing: .4px; }
        .section-title { font-size: 14px; font-weight: bold; margin: 18px 0 10px; color: #111827; }
    </style>
</head>
<body>

    <h1>CRM KPI Report — INDIC RMC</h1>
    <div class="subtitle">Generated {{ $generatedAt->format('d M Y, h:i A') }}</div>

    <table>
        <thead>
            <tr>
                <th>Metric</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Total Leads</td><td>{{ $totalLeads }}</td></tr>
            <tr><td>Total Inquiries</td><td>{{ $totalInquiries }}</td></tr>
            <tr><td>Converted Leads</td><td>{{ $convertedLeads }}</td></tr>
            <tr><td>Lost Leads</td><td>{{ $lostLeads }}</td></tr>
            <tr><td>Conversion Rate</td><td>{{ $conversionRate }}%</td></tr>
            <tr><td>Loss Rate</td><td>{{ $lossRate }}%</td></tr>
            <tr><td>Avg. Response Time (Lead → First Contact)</td><td>{{ $avgResponseTimeHours !== null ? $avgResponseTimeHours . ' hours' : 'N/A' }}</td></tr>
            <tr><td>Active Consultants</td><td>{{ $activeConsultants }}</td></tr>
            <tr><td>Avg. Leads per Consultant</td><td>{{ $avgLeadsPerConsultant }}</td></tr>
            <tr><td>Total Communications Logged</td><td>{{ $totalCommunications }}</td></tr>
        </tbody>
    </table>

    <div class="section-title">Leads Handled per Consultant</div>

    <table>
        <thead>
            <tr>
                <th>Consultant</th>
                <th>Leads Handled</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($leadsPerConsultant as $row)
                <tr>
                    <td>{{ $row['name'] }}</td>
                    <td>{{ $row['total'] }}</td>
                </tr>
            @empty
                <tr><td colspan="2">No leads assigned to consultants yet.</td></tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
