<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>New Application | INDIC RMC</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6fa;
            color: #17233c;
        }

        a {
            text-decoration: none;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 35px 20px;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 28px;
            margin-bottom: 7px;
        }

        .page-header p {
            color: #718096;
            font-size: 14px;
        }

        .card {
            background: white;
            border: 1px solid #e2e6ec;
            border-radius: 10px;
            padding: 30px;
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #edf0f4;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #344054;
        }

        .required {
            color: #e53e3e;
        }

        select,
        textarea {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #d5dbe5;
            border-radius: 7px;
            background: white;
            color: #17233c;
            font-size: 13px;
            outline: none;
        }

        select:focus,
        textarea:focus {
            border-color: #ff7a18;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        .help-text {
            margin-top: 6px;
            font-size: 11px;
            color: #8a94a6;
        }

        .error {
            margin-top: 6px;
            color: #c62828;
            font-size: 12px;
        }

        .error-summary {
            background: #fde8e8;
            border: 1px solid #f3b8b8;
            color: #c62828;
            padding: 14px 16px;
            border-radius: 7px;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #edf0f4;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: #ff7a18;
            color: white;
        }

        .btn-primary:hover {
            background: #e96b0d;
        }

        .btn-secondary {
            background: #17233c;
            color: white;
        }

        .btn-secondary:hover {
            background: #263550;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e6ec;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 25px;
        }

        .info-box h3 {
            font-size: 14px;
            margin-bottom: 7px;
        }

        .info-box p {
            color: #718096;
            font-size: 12px;
            line-height: 1.6;
        }

        @media (max-width: 700px) {
            .container {
                padding: 20px 15px;
            }

            .card {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                text-align: center;
                width: 100%;
            }
        }
    </style>
@include('components.sidebar-style')
</head>

<body>

@include('components.student-sidebar')

<div class="main">

<div class="container">

    <!-- PAGE HEADER -->

    <div class="page-header">

        <h1>New Application</h1>

        <p>
            Submit a new study abroad application to INDIC RMC.
        </p>

    </div>


    <!-- APPLICATION FORM CARD -->

    <div class="card">

        <div class="info-box">

            <h3>Application Information</h3>

            <p>
                Please select your preferred country, course and intake.
                Provide the required application type and any additional
                message that will help our consultants understand your request.
            </p>

        </div>


        <!-- VALIDATION ERRORS -->

        @if($errors->any())

            <div class="error-summary">

                <strong>
                    Please correct the following errors:
                </strong>

                <ul style="margin-top: 8px; padding-left: 20px;">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <h2 class="section-title">
            Application Details
        </h2>


        <form
            action="{{ route('student.applications.store') }}"
            method="POST"
        >

            @csrf


            <!-- COUNTRY + COURSE -->

            <div class="form-row">

                <!-- COUNTRY -->

                <div class="form-group">

                    <label for="preferred_country_id">

                        Preferred Country

                    </label>

                    <select
                        name="preferred_country_id"
                        id="preferred_country_id"
                    >

                        <option value="">
                            -- Select Country --
                        </option>

                        @foreach($countries as $country)

                            <option
                                value="{{ $country->country_id }}"
                                {{ old('preferred_country_id', request('country')) == $country->country_id ? 'selected' : '' }}
                            >

                                {{ $country->country_name }}

                            </option>

                        @endforeach

                    </select>

                    @error('preferred_country_id')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- COURSE -->

                <div class="form-group">

                    <label for="preferred_course_id">

                        Preferred Course

                    </label>

                    <select
                        name="preferred_course_id"
                        id="preferred_course_id"
                    >

                        <option value="">
                            -- Select Course --
                        </option>

                        @foreach($courses as $course)

                            <option
                                value="{{ $course->course_id }}"
                                {{ old('preferred_course_id', request('course')) == $course->course_id ? 'selected' : '' }}
                            >

                                {{ $course->course_name }}

                                @if($course->university)

                                    - {{ $course->university->university_name }}

                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('preferred_course_id')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            <!-- INTAKE + APPLICATION TYPE -->

            <div class="form-row">

                <!-- INTAKE -->

                <div class="form-group">

                    <label for="preferred_intake_id">

                        Preferred Intake

                    </label>

                    <select
                        name="preferred_intake_id"
                        id="preferred_intake_id"
                    >

                        <option value="">
                            -- Select Intake --
                        </option>

                        @foreach($intakes as $intake)

                            <option
                                value="{{ $intake->intake_id }}"
                                {{ old('preferred_intake_id') == $intake->intake_id ? 'selected' : '' }}
                            >

                                {{ $intake->intake_name }}

                                @if($intake->start_date)

                                    - Starts
                                    {{ $intake->start_date->format('d M Y') }}

                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('preferred_intake_id')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- APPLICATION TYPE -->

                <div class="form-group">

                    <label for="application_type">

                        Application Type
                        <span class="required">*</span>

                    </label>

                    <select
                        name="application_type"
                        id="application_type"
                        required
                    >

                        <option value="">
                            -- Select Application Type --
                        </option>

                        <option
                            value="Consultation Request"
                            {{ old('application_type') == 'Consultation Request' ? 'selected' : '' }}
                        >
                            Consultation Request
                        </option>

                        <option
                            value="Study Abroad Guidance"
                            {{ old('application_type') == 'Study Abroad Guidance' ? 'selected' : '' }}
                        >
                            Study Abroad Guidance
                        </option>

                        <option
                            value="General Request"
                            {{ old('application_type') == 'General Request' ? 'selected' : '' }}
                        >
                            General Request
                        </option>

                    </select>

                    @error('application_type')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            <!-- MESSAGE -->

            <div class="form-group">

                <label for="student_message">

                    Additional Message

                </label>

                <textarea
                    name="student_message"
                    id="student_message"
                    placeholder="Tell us about your study plans, preferred university, career goals or any questions you have..."
                >{{ old('student_message') }}</textarea>

                <div class="help-text">

                    Optional. You can provide additional information for our consultants.

                </div>

                @error('student_message')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- ACTION BUTTONS -->

            <div class="actions">

                <a
                    href="{{ route('student.applications.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Submit Application
                </button>

            </div>

        </form>

    </div>

</div>

</div>

</body>
</html>