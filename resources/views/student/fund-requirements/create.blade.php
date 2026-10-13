<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Generate Fund Requirement | INDIC RMC</title>

    @include('components.page-style')

    <style>
        .pg-form-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 20px;
            align-items: start;
        }

        .pg-summary {
            position: sticky;
            top: 92px;
            background: #101a2b;
            color: #fff;
            border-radius: 14px;
            padding: 24px;
        }

        .pg-summary h3 { margin: 0 0 18px; font-size: 15px; color: #cbd3df; }

        .pg-summary-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 9px 0;
            font-size: 13px;
            color: #aeb7c7;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .pg-summary-row strong { color: #fff; white-space: nowrap; }
        .pg-summary-row.minus strong { color: #4ade80; }

        .pg-summary-total { margin-top: 20px; }
        .pg-summary-total span { font-size: 12px; color: #aeb7c7; }

        .pg-summary-total strong {
            display: block;
            margin-top: 6px;
            font-size: 28px;
            color: #fb923c;
            overflow-wrap: anywhere;
        }

        .pg-summary-note { margin-top: 14px; font-size: 11px; line-height: 1.6; color: #8a94a6; }

        @media (max-width: 1100px) {
            .pg-form-layout { grid-template-columns: 1fr; }
            .pg-summary { position: static; }
        }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

<main class="main">

    <x-student-topbar
        :crumbs="['Fund Requirements' => route('student.fund-requirements.index')]"
        current="Generate" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Generate Fund Requirement</h1>
                <p>Estimate the funds required for your study abroad journey.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('student.fund-requirements.index') }}" class="pg-btn">
                    <i class="bi bi-arrow-left"></i> My Fund Requirements
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="pg-alert error" style="align-items:flex-start;">
                <i class="bi bi-exclamation-circle-fill"></i>
                <div>
                    <strong>Please correct the following errors:</strong>
                    <ul style="margin:8px 0 0 18px;padding:0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('student.fund-requirements.store') }}" method="POST">
            @csrf

            <div class="pg-form-layout">

                <div>

                    <div class="pg-card">
                        <div class="pg-card-head">
                            <h2><i class="bi bi-mortarboard"></i> Study Information</h2>
                        </div>

                        <div class="pg-card-body">
                            <p class="pg-card-desc">
                                Select your intended study destination and course.
                            </p>

                            <div class="pg-form-grid">
                                <div class="pg-group">
                                    <label for="selected_country_id">Destination Country</label>

                                    <select id="selected_country_id" name="selected_country_id" class="pg-field">
                                        <option value="">Select a country</option>

                                        @foreach ($countries as $country)
                                            <option value="{{ $country->country_id }}"
                                                @selected(old('selected_country_id') == $country->country_id)>
                                                {{ $country->country_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('selected_country_id')
                                        <span class="pg-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="pg-group">
                                    <label for="selected_course_id">Course</label>

                                    <select id="selected_course_id" name="selected_course_id" class="pg-field">
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
                                        <span class="pg-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="pg-group full">
                                    <label for="application_id">Related Application (Optional)</label>

                                    <select id="application_id" name="application_id" class="pg-field">
                                        <option value="">Not linked to an application</option>

                                        @foreach ($applications as $application)
                                            <option value="{{ $application->application_id }}"
                                                @selected(old('application_id', request('application')) == $application->application_id)>
                                                {{ $application->application_reference ?? 'Application #' . $application->application_id }}
                                                @if ($application->preferredCourse)
                                                    — {{ $application->preferredCourse->course_name }}
                                                @endif
                                                @if ($application->preferredCountry)
                                                    ({{ $application->preferredCountry->country_name }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>

                                    <span class="pg-hint">
                                        @if ($applications->isEmpty())
                                            You have no applications yet, so this estimate will stand alone.
                                        @else
                                            Link this estimate to one of your applications, or leave it unlinked.
                                        @endif
                                    </span>

                                    @error('application_id')
                                        <span class="pg-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pg-card">
                        <div class="pg-card-head">
                            <h2><i class="bi bi-calculator"></i> Estimated Expenses</h2>
                        </div>

                        <div class="pg-card-body">
                            <p class="pg-card-desc">
                                Enter your estimated costs in the same currency. These figures
                                are estimates supplied by you, not automatically verified fees.
                            </p>

                            <div class="pg-form-grid">
                                <div class="pg-group full">
                                    <label for="currency">Currency</label>

                                    <select id="currency" name="currency" class="pg-field" required>
                                        @foreach (['USD', 'GBP', 'EUR', 'CAD', 'AUD', 'NZD', 'LKR', 'SGD'] as $currency)
                                            <option value="{{ $currency }}"
                                                @selected(old('currency', 'USD') === $currency)>
                                                {{ $currency }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('currency')
                                        <span class="pg-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                @php
                                    $moneyFields = [
                                        ['total_tuition', 'Total Tuition Fee *', true, null],
                                        ['total_living_cost', 'Total Living Expenses *', true, null],
                                        ['total_travel_cost', 'Total Travel Cost *', true, null],
                                        ['total_other_cost', 'Other Expenses', false, null],
                                        ['scholarship_amount', 'Scholarship Deduction', false, 'Amount deducted from the total, in the selected currency.'],
                                    ];
                                @endphp

                                @foreach ($moneyFields as [$name, $label, $required, $hint])
                                    <div class="pg-group">
                                        <label for="{{ $name }}">{{ $label }}</label>

                                        <div class="pg-input-money">
                                            <span class="currency-tag">USD</span>
                                            <input type="number"
                                                   id="{{ $name }}"
                                                   name="{{ $name }}"
                                                   class="pg-field"
                                                   min="0"
                                                   step="0.01"
                                                   @if ($required) required @endif
                                                   value="{{ old($name, '0') }}">
                                        </div>

                                        @if ($hint)
                                            <span class="pg-hint">{{ $hint }}</span>
                                        @endif

                                        @error($name)
                                            <span class="pg-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach

                                <div class="pg-group full">
                                    <label for="notes">Additional Notes (Optional)</label>

                                    <textarea id="notes"
                                              name="notes"
                                              rows="3"
                                              class="pg-field"
                                              placeholder="Add notes about your financial estimate...">{{ old('notes') }}</textarea>

                                    @error('notes')
                                        <span class="pg-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pg-actions" style="justify-content:flex-end;">
                        <a href="{{ route('student.fund-requirements.index') }}" class="pg-btn">Cancel</a>

                        <button type="submit" class="pg-btn pg-btn-primary">
                            <i class="bi bi-calculator"></i> Generate Fund Requirement
                        </button>
                    </div>

                </div>

                <aside class="pg-summary">
                    <h3>Live Summary</h3>

                    <div class="pg-summary-row"><span>Tuition</span><strong data-sum="total_tuition">0.00</strong></div>
                    <div class="pg-summary-row"><span>Living</span><strong data-sum="total_living_cost">0.00</strong></div>
                    <div class="pg-summary-row"><span>Travel</span><strong data-sum="total_travel_cost">0.00</strong></div>
                    <div class="pg-summary-row"><span>Other</span><strong data-sum="total_other_cost">0.00</strong></div>
                    <div class="pg-summary-row minus"><span>Scholarship</span><strong data-sum="scholarship_amount">0.00</strong></div>

                    <div class="pg-summary-total">
                        <span>Estimated total funds required</span>
                        <strong id="estimatedTotal">USD 0.00</strong>
                    </div>

                    <p class="pg-summary-note">
                        Tuition + living + travel + other expenses − scholarship.
                        The server calculates and saves the final total.
                    </p>
                </aside>

            </div>
        </form>

    </section>
</main>

<script>
    (function () {
        const names = ['total_tuition', 'total_living_cost', 'total_travel_cost', 'total_other_cost', 'scholarship_amount'];
        const currency = document.getElementById('currency');
        const total = document.getElementById('estimatedTotal');

        const inputs = {};
        names.forEach(function (name) { inputs[name] = document.getElementById(name); });

        function fmt(value) {
            return value.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function val(name) {
            return Math.max(0, Number(inputs[name].value || 0));
        }

        function update() {
            names.forEach(function (name) {
                document.querySelector('[data-sum="' + name + '"]').textContent = fmt(val(name));
            });

            document.querySelectorAll('.currency-tag').forEach(function (tag) {
                tag.textContent = currency.value;
            });

            const amount = val('total_tuition') + val('total_living_cost') +
                val('total_travel_cost') + val('total_other_cost') - val('scholarship_amount');

            total.textContent = currency.value + ' ' + fmt(Math.max(0, amount));
        }

        names.forEach(function (name) {
            inputs[name].addEventListener('input', update);
        });

        currency.addEventListener('change', update);
        update();
    })();
</script>

</body>
</html>
