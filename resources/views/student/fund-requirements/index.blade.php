```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Fund Requirements | INDIC RMC</title>

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

        .content { max-width: 1400px; margin: auto; padding: 30px; }

        .heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 25px;
        }

        h1 { font-size: 25px; margin: 0 0 8px; }

        .subtitle { color: #727c8d; font-size: 13px; margin: 0; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 15px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid #e1e5ed;
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
        .error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        .card {
            background: white;
            border: 1px solid #e7eaf0;
            border-radius: 12px;
            overflow: hidden;
        }

        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; min-width: 750px; }

        th, td {
            text-align: left;
            padding: 16px 18px;
            border-bottom: 1px solid #eef0f4;
            font-size: 12px;
        }

        th {
            background: #fafbfc;
            color: #727c8d;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        tbody tr:hover { background: #fffaf6; }
        tbody tr:last-child td { border-bottom: 0; }

        .country { font-weight: 600; margin-bottom: 5px; }
        .muted { color: #8791a1; font-size: 11px; }

        .amount { font-weight: 700; white-space: nowrap; }

        .actions { display: flex; gap: 8px; align-items: center; }

        .icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border: 1px solid #e1e5ed;
            border-radius: 7px;
            background: white;
            color: #374151;
            cursor: pointer;
            text-decoration: none;
        }

        .icon-btn:hover { color: #f97316; border-color: #fdba74; }
        .delete-btn { color: #dc2626; }

        .empty {
            text-align: center;
            padding: 65px 20px;
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: #fff1e8;
            color: #f97316;
            display: grid;
            place-items: center;
            font-size: 25px;
            margin: 0 auto 18px;
        }

        .empty h2 { font-size: 18px; margin-bottom: 8px; }
        .empty p { color: #727c8d; font-size: 13px; margin-bottom: 20px; }

        .pagination {
            padding: 18px;
            border-top: 1px solid #eef0f4;
        }

        .pagination nav { display: flex; justify-content: center; }

        @media (max-width: 900px) {
            .main { margin-left: 70px; }
        }

        @media (max-width: 650px) {
            .main { margin-left: 0; }
            .content { padding: 20px 15px; }
            .topbar { padding: 0 15px; }
            .heading { align-items: flex-start; flex-direction: column; }
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
                <h1>My Fund Requirements</h1>
                <p class="subtitle">
                    Review your study abroad financial estimates.
                </p>
            </div>

            <a href="{{ route('student.fund-requirements.create') }}"
               class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Generate New Estimate
            </a>
        </div>

        @if (session('success'))
            <div class="alert success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        <div class="card">
            @if ($fundRequirements->count())
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Destination / Course</th>
                                <th>Generated Date</th>
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
                                        <div class="country">
                                            {{ $fund->selectedCountry?->country_name ?? 'Not selected' }}
                                        </div>
                                        <div class="muted">
                                            {{ $fund->selectedCourse?->course_name ?? 'Course not selected' }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ $fund->generated_at?->format('d M Y') ?? $fund->created_at?->format('d M Y') ?? '—' }}
                                    </td>
                                    <td class="amount">
                                        {{ $fund->currency }} {{ number_format((float) $fund->total_tuition, 2) }}
                                    </td>
                                    <td class="amount">
                                        {{ $fund->currency }} {{ number_format((float) $fund->scholarship_amount, 2) }}
                                    </td>
                                    <td class="amount">
                                        {{ $fund->currency }} {{ number_format((float) $fund->total_required_amount, 2) }}
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a class="icon-btn"
                                               href="{{ route('student.fund-requirements.show', $fund) }}"
                                               title="View details">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <form action="{{ route('student.fund-requirements.destroy', $fund) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this fund requirement? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="icon-btn delete-btn"
                                                        title="Delete">
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

                <div class="pagination">
                    {{ $fundRequirements->links() }}
                </div>
            @else
                <div class="empty">
                    <div class="empty-icon">
                        <i class="bi bi-calculator"></i>
                    </div>

                    <h2>No fund requirements yet</h2>
                    <p>
                        Create your first estimate to understand your expected
                        study abroad expenses.
                    </p>

                    <a href="{{ route('student.fund-requirements.create') }}"
                       class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        Generate Fund Requirement
                    </a>
                </div>
            @endif
        </div>
    </section>
</main>

</body>
</html>