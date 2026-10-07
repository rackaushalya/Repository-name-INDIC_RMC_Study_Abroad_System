<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recommendation Details | INDIC RMC</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #17233c;
        }

        .topbar {
            height: 72px;
            background: #ffffff;
            border-bottom: 1px solid #e8ebf1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 34px;
        }

        .brand {
            font-size: 24px;
            font-weight: 800;
            color: #17233c;
        }

        .brand span {
            color: #ff7417;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ff7417;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .user-name {
            font-size: 14px;
            font-weight: 700;
        }

        .user-role {
            font-size: 12px;
            color: #8992a3;
            margin-top: 3px;
        }

        .content {
            max-width: 1250px;
            margin: 0 auto;
            padding: 34px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            color: #687386;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .back-link:hover {
            color: #ff7417;
        }

        .hero {
            background: #ffffff;
            border: 1px solid #e7eaf0;
            border-radius: 16px;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 22px;
        }

        .university {
            color: #7c8799;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .course-title {
            font-size: 30px;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 12px;
        }

        .location {
            color: #687386;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag {
            background: #f5f7fa;
            border: 1px solid #e7eaf0;
            color: #596579;
            padding: 7px 11px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
        }

        .match-card {
            min-width: 190px;
            background: #eef7ff;
            border-radius: 14px;
            padding: 22px;
            text-align: center;
        }

        .match-number {
            color: #2777d4;
            font-size: 42px;
            font-weight: 800;
        }

        .match-label {
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .status {
            display: inline-block;
            margin-top: 13px;
            padding: 7px 12px;
            border-radius: 20px;
            background: #e8f8ef;
            color: #17864a;
            font-size: 11px;
            font-weight: 700;
        }

        .grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 22px;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e7eaf0;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 22px;
        }

        .card-title {
            font-size: 17px;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .factor {
            border: 1px solid #e8ebf0;
            border-radius: 11px;
            padding: 14px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .factor-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .factor-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .pass .factor-icon {
            background: #dcf7e8;
            color: #159447;
        }

        .fail .factor-icon {
            background: #ffe3e0;
            color: #d63d32;
        }

        .factor-name {
            font-size: 13px;
            font-weight: 700;
        }

        .factor-description {
            font-size: 11px;
            color: #8992a3;
            margin-top: 3px;
        }

        .factor-result {
            font-size: 12px;
            font-weight: 700;
        }

        .pass .factor-result {
            color: #159447;
        }

        .fail .factor-result {
            color: #d63d32;
        }

        .reason {
            color: #697588;
            font-size: 13px;
            line-height: 1.7;
            background: #fafbfc;
            border-radius: 10px;
            padding: 15px;
        }

        .info-row {
            padding: 13px 0;
            border-bottom: 1px solid #edf0f4;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #8992a3;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 13px;
            font-weight: 700;
        }

        .fee-card {
            background: #fff7f1;
            border: 1px solid #ffe3d0;
            border-radius: 12px;
            padding: 18px;
        }

        .fee-label {
            color: #9a765e;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .fee-value {
            color: #17233c;
            font-size: 21px;
            font-weight: 800;
        }

        .note {
            color: #8992a3;
            font-size: 11px;
            line-height: 1.6;
            margin-top: 8px;
        }

        .action {
            display: block;
            text-align: center;
            text-decoration: none;
            background: #ff7417;
            color: #ffffff;
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            margin-top: 18px;
        }

        .action:hover {
            background: #e9650b;
        }

        .disclaimer {
            color: #8992a3;
            font-size: 11px;
            line-height: 1.6;
            text-align: center;
            margin-top: 8px;
        }

        @media (max-width: 900px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .hero {
                flex-direction: column;
            }

            .match-card {
                min-width: 100%;
            }
        }

        @media (max-width: 600px) {
            .content {
                padding: 20px 15px;
            }

            .topbar {
                padding: 0 15px;
            }

            .course-title {
                font-size: 24px;
            }

            .factor {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

<header class="topbar">

    <div class="brand">
        INDIC <span>RMC</span>
    </div>

    <div class="user-area">

        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->first_name ?? 'S', 0, 1)) }}
        </div>

        <div>
            <div class="user-name">
                {{ auth()->user()->first_name ?? 'Student' }}
                {{ auth()->user()->last_name ?? '' }}
            </div>

            <div class="user-role">
                Student
            </div>
        </div>

    </div>

</header>


<main class="content">

    <a
        href="{{ route('student.recommendations.index') }}"
        class="back-link"
    >
        ← Back to Recommendations
    </a>


    @php
        $course = $recommendation->course;
        $university = $course?->university;

        $tuition = $course?->tuitionFees
            ? $course->tuitionFees->sortBy('fee_amount')->first()
            : null;

        $match = (float) $recommendation->match_percentage;
    @endphp


    <section class="hero">

        <div>

            <div class="university">
                {{ $university?->university_name ?? 'University not available' }}
            </div>

            <h1 class="course-title">
                {{ $course?->course_name ?? 'Course not available' }}
            </h1>

            <div class="location">

                {{ $university?->city ?? 'Location unavailable' }}

                @if($university?->country)
                    · {{ $university->country->country_name }}
                @endif

            </div>


            <div class="tags">

                @if($course?->field_of_study)
                    <span class="tag">
                        {{ $course->field_of_study }}
                    </span>
                @endif

                @if($course?->course_level)
                    <span class="tag">
                        {{ $course->course_level }}
                    </span>
                @endif

                @if($course?->duration)
                    <span class="tag">
                        {{ $course->duration }}
                    </span>
                @endif

                @if($course?->study_mode)
                    <span class="tag">
                        {{ $course->study_mode }}
                    </span>
                @endif

            </div>

        </div>


        <div class="match-card">

            <div class="match-number">
                {{ number_format($match, 0) }}%
            </div>

            <div class="match-label">
                Overall Match
            </div>

            <div class="status">
                {{ $recommendation->recommendation_status ?? 'Recommended' }}
            </div>

        </div>

    </section>


    <div class="grid">


        <div>


            <section class="card">

                <h2 class="card-title">
                    Eligibility & Matching Factors
                </h2>


                <div class="factor {{ $recommendation->qualification_match ? 'pass' : 'fail' }}">

                    <div class="factor-left">

                        <div class="factor-icon">
                            {{ $recommendation->qualification_match ? '✓' : '×' }}
                        </div>

                        <div>

                            <div class="factor-name">
                                Qualification Match
                            </div>

                            <div class="factor-description">
                                Your academic qualification compared with the course requirement.
                            </div>

                        </div>

                    </div>

                    <div class="factor-result">
                        {{ $recommendation->qualification_match ? 'Matched' : 'Not Matched' }}
                    </div>

                </div>


                <div class="factor {{ $recommendation->english_match ? 'pass' : 'fail' }}">

                    <div class="factor-left">

                        <div class="factor-icon">
                            {{ $recommendation->english_match ? '✓' : '×' }}
                        </div>

                        <div>

                            <div class="factor-name">
                                English Requirement
                            </div>

                            <div class="factor-description">
                                Your English qualification compared with the required score.
                            </div>

                        </div>

                    </div>

                    <div class="factor-result">
                        {{ $recommendation->english_match ? 'Matched' : 'Not Matched' }}
                    </div>

                </div>


                <div class="factor {{ $recommendation->preference_match ? 'pass' : 'fail' }}">

                    <div class="factor-left">

                        <div class="factor-icon">
                            {{ $recommendation->preference_match ? '✓' : '×' }}
                        </div>

                        <div>

                            <div class="factor-name">
                                Study Preferences
                            </div>

                            <div class="factor-description">
                                Course field, level, study mode and preferred destination.
                            </div>

                        </div>

                    </div>

                    <div class="factor-result">
                        {{ $recommendation->preference_match ? 'Matched' : 'Not Matched' }}
                    </div>

                </div>


                <div class="factor {{ $recommendation->budget_match ? 'pass' : 'fail' }}">

                    <div class="factor-left">

                        <div class="factor-icon">
                            {{ $recommendation->budget_match ? '✓' : '×' }}
                        </div>

                        <div>

                            <div class="factor-name">
                                Budget
                            </div>

                            <div class="factor-description">
                                Available tuition information compared with your stated budget.
                            </div>

                        </div>

                    </div>

                    <div class="factor-result">
                        {{ $recommendation->budget_match ? 'Matched' : 'Not Matched' }}
                    </div>

                </div>


                <div class="factor {{ $recommendation->work_experience_match ? 'pass' : 'fail' }}">

                    <div class="factor-left">

                        <div class="factor-icon">
                            {{ $recommendation->work_experience_match ? '✓' : '×' }}
                        </div>

                        <div>

                            <div class="factor-name">
                                Work Experience
                            </div>

                            <div class="factor-description">
                                Your work experience compared with the course requirement.
                            </div>

                        </div>

                    </div>

                    <div class="factor-result">
                        {{ $recommendation->work_experience_match ? 'Matched' : 'Not Matched' }}
                    </div>

                </div>

            </section>


            @if($recommendation->recommendation_reason)

                <section class="card">

                    <h2 class="card-title">
                        Why This Course Was Recommended
                    </h2>

                    <div class="reason">
                        {{ $recommendation->recommendation_reason }}
                    </div>

                </section>

            @endif


            @if($course?->description)

                <section class="card">

                    <h2 class="card-title">
                        About the Course
                    </h2>

                    <div class="reason">
                        {{ $course->description }}
                    </div>

                </section>

            @endif


        </div>


        <div>


            <section class="card">

                <h2 class="card-title">
                    Course Information
                </h2>


                @if($course?->course_level)

                    <div class="info-row">

                        <div class="info-label">
                            Course Level
                        </div>

                        <div class="info-value">
                            {{ $course->course_level }}
                        </div>

                    </div>

                @endif


                @if($course?->duration)

                    <div class="info-row">

                        <div class="info-label">
                            Duration
                        </div>

                        <div class="info-value">
                            {{ $course->duration }}
                        </div>

                    </div>

                @endif


                @if($course?->study_mode)

                    <div class="info-row">

                        <div class="info-label">
                            Study Mode
                        </div>

                        <div class="info-value">
                            {{ $course->study_mode }}
                        </div>

                    </div>

                @endif


                @if($course?->field_of_study)

                    <div class="info-row">

                        <div class="info-label">
                            Field of Study
                        </div>

                        <div class="info-value">
                            {{ $course->field_of_study }}
                        </div>

                    </div>

                @endif


                @if($course?->application_deadline)

                    <div class="info-row">

                        <div class="info-label">
                            Application Deadline
                        </div>

                        <div class="info-value">
                            {{ $course->application_deadline->format('d M Y') }}
                        </div>

                    </div>

                @endif

            </section>


            @if($tuition)

                <section class="card">

                    <h2 class="card-title">
                        Tuition Fee
                    </h2>

                    <div class="fee-card">

                        <div class="fee-label">
                            {{ $tuition->fee_type ?? 'Tuition Fee' }}
                        </div>

                        <div class="fee-value">

                            {{ $tuition->currency }}
                            {{ number_format((float) $tuition->fee_amount, 2) }}

                        </div>

                        <div class="note">
                            Tuition fees are displayed based on the
                            information currently available in the system.
                        </div>

                    </div>

                </section>

            @endif


            @if($university)

                <section class="card">

                    <h2 class="card-title">
                        University
                    </h2>


                    <div class="info-row">

                        <div class="info-label">
                            University
                        </div>

                        <div class="info-value">
                            {{ $university->university_name }}
                        </div>

                    </div>


                    @if($university->city)

                        <div class="info-row">

                            <div class="info-label">
                                City
                            </div>

                            <div class="info-value">
                                {{ $university->city }}
                            </div>

                        </div>

                    @endif


                    @if($university->website)

                        <a
                            href="{{ $university->website }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="action"
                        >
                            Visit University Website
                        </a>

                    @endif

                </section>

            @endif


        </div>

    </div>


    <div class="disclaimer">
        Recommendations are based on the information currently available
        in your profile and the course requirements stored in INDIC RMC.
        Final admission decisions are made by the relevant university.
    </div>

</main>

</body>
</html>