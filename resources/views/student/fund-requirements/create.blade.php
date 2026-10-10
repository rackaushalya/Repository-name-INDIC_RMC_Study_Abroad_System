```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Generate Fund Requirement | INDIC RMC</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        .main {
            margin-left: 245px;
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: #fff;
            border-bottom: 1px solid #e6e9ef;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f97316;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .content {
            max-width: 1200px;
            margin: auto;
            padding: 30px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 25px;
            margin-bottom: 8px;
        }

        .page-heading p {
            color: #727c8d;
            font-size: 13px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            border: none;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-orange {
            background: #f97316;
            color: #fff;
        }

        .btn-orange:hover {
            background: #ea580c;
        }

        .btn-light {
            background: #fff;
            border: 1px solid #e1e5ed;
            color: #374151;
        }

        .card {
            background: white;
            border: 1px solid #e7eaf0;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .card h2 {
            font-size: 17px;
            margin-bottom: 8px;
        }

        .card-description {
            color: #788294;
            font-size: 12px;
            margin-bottom: 22px;
            line-height: 1.6;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #dce1e9;
            border-radius: 7px;
            background: #fff;
            color: #172033;
            font-family: inherit;
            font-size: 13px;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, .10);
        }

        .hint {
            font-size: 11px;
            color: #8791a1;
            line-height: 1.5;
        }

        .error {
            color: #dc2626;
            font-size: 11px;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .total-box {
            background: #fff7f1;
            border: 1px solid #fed7aa;
            border-radius: 10px;
            padding: 22px;
            margin-top: 22px;
        }

        .total-label {
            color: #9a5a2b;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .total-value {
            color: #ea580c;
            font-size: 28px;
            font-weight: 700;
        }

        .total-note {
            color: #8a6b58;
            font-size: 11px;
            margin-top: 8px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 25px;
        }

        @media (max-width: 900px) {
            .main {
                margin-left: 70px;
            }
        }

        @media (max-width: 650px) {
            .main {
                margin-left: 0;
            }

            .topbar {
                padding: 0 15px;
            }

            .content {
                padding: 20px 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .card {
                padding: 18px;
            }

            .total-value {
                font-size: 23px;
            }
        }
    </style>

    @include('components.sidebar-style')
</head>

<body>

@include('components.student-sidebar')

<main class="main">

    <header class="topbar">
        <a href="{{ route('student.account.edit') }}" class="user"
           style="text-decoration:none;color:inherit;">
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->first_name ?? 'S', 0, 1)) }}
            </div>

            <span>
                {{ trim((auth()->user()->first_name ?? '') . ' ' .
                    (auth()->user()->last_name ?? '')) ?: 'Student' }}
            </span>
        </a>
    </header>

    <section class="content">

        <div class="page-heading">
            <div>
                <h1>Generate Fund Requirement</h1>
                <p>Estimate the funds required for your study abroad journey.</p>
            </div>

            <a href="{{ route('student.fund-requirements.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left"></i>
                My Fund Requirements
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Please correct the following errors:</strong>
                <ul style="margin:10px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('student.fund-requirements.store') }}" method="POST">
            @csrf

            <div class="card">
                <h2><i class="bi bi-mortarboard"></i> Study Information</h2>
                <p class="card-description">
                    Select your intended study destination and course.
                </p>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="selected_country_id">Destination Country</label>

                        <select id="selected_country_id" name="selected_country_id">
                            <option value="">Select a country</option>

                            @foreach ($countries as $country)
                                <option value="{{ $country->country_id }}"
                                    @selected(old('selected_country_id') == $country->country_id)>
                                    {{ $country->country_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('selected_country_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="selected_course_id">Course</label>

                        <select id="selected_course_id" name="selected_course_id">
                            <option value="">Select a course</option>

                            @foreach ($courses as $course)
                                <option value="{{ $course->course_id }}"
                                    @selected(old('selected_course_id') == $course->course_id)>
                                    {{ $course->course_name }}
                                    @if ($course->university)
                                        — {{ $course->university->university_name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>

                        @error('selected_course_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="application_id">Related Application (Optional)</label>

                        <input type="number"
                               id="application_id"
                               name="application_id"
                               min="1"
                               value="{{ old('application_id') }}"
                               placeholder="Enter your application ID if applicable">

                        <span class="hint">
                            Leave blank if this estimate is not linked to a specific application.
                        </span>

                        @error('application_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card">
                <h2><i class="bi bi-calculator"></i> Estimated Expenses</h2>
                <p class="card-description">
                    Enter your estimated costs in the same currency. These figures
                    are estimates supplied by you, not automatically verified fees.
                </p>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="currency">Currency</label>

                        <select id="currency" name="currency" required>
                            @foreach (['USD', 'GBP', 'EUR', 'CAD', 'AUD', 'NZD', 'LKR', 'SGD'] as $currency)
                                <option value="{{ $currency }}"
                                    @selected(old('currency', 'USD') === $currency)>
                                    {{ $currency }}
                                </option>
                            @endforeach
                        </select>

                        @error('currency')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_tuition">Total Tuition Fee *</label>

                        <input type="number"
                               id="total_tuition"
                               name="total_tuition"
                               min="0"
                               step="0.01"
                               required
                               value="{{ old('total_tuition', '0') }}">

                        @error('total_tuition')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_living_cost">Total Living Expenses *</label>

                        <input type="number"
                               id="total_living_cost"
                               name="total_living_cost"
                               min="0"
                               step="0.01"
                               required
                               value="{{ old('total_living_cost', '0') }}">

                        @error('total_living_cost')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_travel_cost">Total Travel Cost *</label>

                        <input type="number"
                               id="total_travel_cost"
                               name="total_travel_cost"
                               min="0"
                               step="0.01"
                               required
                               value="{{ old('total_travel_cost', '0') }}">

                        @error('total_travel_cost')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_other_cost">Other Expenses</label>

                        <input type="number"
                               id="total_other_cost"
                               name="total_other_cost"
                               min="0"
                               step="0.01"
                               value="{{ old('total_other_cost', '0') }}">

                        @error('total_other_cost')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="scholarship_amount">Scholarship Deduction</label>

                        <input type="number"
                               id="scholarship_amount"
                               name="scholarship_amount"
                               min="0"
                               step="0.01"
                               value="{{ old('scholarship_amount', '0') }}">

                        <span class="hint">
                            Enter the scholarship amount in the selected currency.
                        </span>

                        @error('scholarship_amount')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="notes">Additional Notes (Optional)</label>

                        <textarea id="notes"
                                  name="notes"
                                  rows="3"
                                  placeholder="Add notes about your financial estimate...">{{ old('notes') }}</textarea>

                        @error('notes')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="total-box">
                    <div class="total-label">Estimated Total Funds Required</div>
                    <div class="total-value" id="estimatedTotal">USD 0.00</div>
                    <div class="total-note">
                        Tuition + living + travel + other expenses − scholarship.
                        The server calculates and saves the final total.
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('student.fund-requirements.index') }}" class="btn btn-light">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-orange">
                        <i class="bi bi-calculator"></i>
                        Generate Fund Requirement
                    </button>
                </div>
            </div>
        </form>

    </section>
</main>

<script>
    (function () {
        const currency = document.getElementById('currency');
        const tuition = document.getElementById('total_tuition');
        const living = document.getElementById('total_living_cost');
        const travel = document.getElementById('total_travel_cost');
        const other = document.getElementById('total_other_cost');
        const scholarship = document.getElementById('scholarship_amount');
        const total = document.getElementById('estimatedTotal');

        function updateTotal() {
            const amount =
                Math.max(0, Number(tuition.value || 0)) +
                Math.max(0, Number(living.value || 0)) +
                Math.max(0, Number(travel.value || 0)) +
                Math.max(0, Number(other.value || 0)) -
                Math.max(0, Number(scholarship.value || 0));

            total.textContent =
                currency.value + ' ' +
                Math.max(0, amount).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
        }

        [currency, tuition, living, travel, other, scholarship].forEach(function (input) {
            input.addEventListener('input', updateTotal);
            input.addEventListener('change', updateTotal);
        });

        updateTotal();
    })();
</script>

</body>
</html>