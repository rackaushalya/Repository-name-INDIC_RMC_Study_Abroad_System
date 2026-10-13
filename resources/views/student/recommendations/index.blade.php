<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recommendations | INDIC RMC</title>

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

        .page {
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: #ffffff;
            border-bottom: 1px solid #e8ebf1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
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
            color: white;
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
            max-width: 1400px;
            margin: 0 auto;
            padding: 34px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 28px;
        }

        .page-title {
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: #7c8799;
            font-size: 14px;
            line-height: 1.6;
        }

        .generate-button {
            border: none;
            background: #ff7417;
            color: #ffffff;
            padding: 13px 20px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .generate-button:hover {
            background: #e9650b;
        }

        .summary {
            background: #ffffff;
            border: 1px solid #e8ebf1;
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary-title {
            font-size: 15px;
            font-weight: 700;
        }

        .summary-text {
            color: #8992a3;
            font-size: 13px;
            margin-top: 5px;
        }

        .count {
            background: #fff1e8;
            color: #ff7417;
            padding: 9px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        .alert {
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #eaf9f0;
            color: #18864b;
            border: 1px solid #ccefdc;
        }

        .alert-error {
            background: #fff0f0;
            color: #c0392b;
            border: 1px solid #f3cccc;
        }

        .recommendations-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .recommendation-card {
            background: #ffffff;
            border: 1px solid #e7eaf0;
            border-radius: 16px;
            padding: 24px;
            transition: 0.2s;
        }

        .recommendation-card:hover {
            border-color: #d8dde7;
            box-shadow: 0 8px 24px rgba(23, 35, 60, 0.06);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
        }

        .university {
            font-size: 13px;
            color: #7d8797;
            margin-bottom: 7px;
        }

        .course-name {
            font-size: 21px;
            font-weight: 800;
            line-height: 1.3;
        }

        .match-box {
            min-width: 82px;
            text-align: center;
            border-radius: 12px;
            background: #eef7ff;
            padding: 10px 8px;
        }

        .match-number {
            color: #2777d4;
            font-size: 21px;
            font-weight: 800;
        }

        .match-label {
            color: #6f7d91;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .location {
            color: #667085;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-bottom: 20px;
        }

        .tag {
            background: #f5f7fa;
            border: 1px solid #e8ebf0;
            color: #596579;
            padding: 6px 9px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .progress-area {
            margin-bottom: 20px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .progress-title {
            font-weight: 700;
        }

        .progress-value {
            color: #7d8797;
        }

        .progress {
            height: 7px;
            background: #edf0f4;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: #ff7417;
            border-radius: 10px;
        }

        .factors {
            border-top: 1px solid #edf0f4;
            padding-top: 17px;
            margin-bottom: 20px;
        }

        .factor-title {
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .factor-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 9px;
        }

        .factor {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: #687386;
        }

        .factor-icon {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
        }

        .factor-pass .factor-icon {
            background: #dcf7e8;
            color: #159447;
        }

        .factor-fail .factor-icon {
            background: #ffe3e0;
            color: #d63d32;
        }

        .fee {
            background: #fafbfc;
            border-radius: 10px;
            padding: 13px 15px;
            margin-bottom: 18px;
        }

        .fee-label {
            font-size: 11px;
            color: #8a94a6;
            margin-bottom: 4px;
        }

        .fee-value {
            font-size: 15px;
            font-weight: 800;
        }

        .reason {
            color: #697588;
            font-size: 12px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .status {
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-recommended {
            background: #e8f8ef;
            color: #17864a;
        }

        .status-review {
            background: #fff4df;
            color: #a96b00;
        }

        .view-button {
            display: inline-block;
            text-decoration: none;
            background: #17233c;
            color: #ffffff;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
        }

        .view-button:hover {
            background: #263653;
        }

        .empty-state {
            background: #ffffff;
            border: 1px solid #e7eaf0;
            border-radius: 16px;
            padding: 70px 30px;
            text-align: center;
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #fff1e8;
            color: #ff7417;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .empty-title {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .empty-text {
            color: #8992a3;
            font-size: 13px;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .pagination {
            margin-top: 25px;
        }

        @media (max-width: 900px) {
            .recommendations-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
            }

            .generate-button {
                width: 100%;
            }
        }

        @media (max-width: 600px) {
            .content {
                padding: 20px 15px;
            }

            .topbar {
                padding: 0 15px;
            }

            .page-title {
                font-size: 24px;
            }

            .factor-list {
                grid-template-columns: 1fr;
            }

            .card-top {
                flex-direction: column;
            }

            .match-box {
                width: 90px;
            }
        }
    </style>
@include('components.sidebar-style')
</head>

<body>

@include('components.student-sidebar')

<div class="main">

<div class="page">

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

        <div class="page-header">

            <div>
                <h1 class="page-title">
                    Study Recommendations
                </h1>

                <p class="page-subtitle">
                    Find study options that match your qualifications,
                    English proficiency, preferences, budget and experience.
                </p>
            </div>

            <form
                action="{{ route('student.recommendations.generate') }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="generate-button"
                >
                    ↻ Generate Recommendations
                </button>
            </form>

        </div>


        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif


        @if($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif


        <div class="summary">

            <div>
                <div class="summary-title">
                    Recommended Study Options
                </div>

                <div class="summary-text">
                    These recommendations are generated from your existing
                    student profile and course requirements.
                </div>
            </div>

            <div class="count">
                {{ $recommendations->total() }}
                {{ $recommendations->total() === 1 ? 'Recommendation' : 'Recommendations' }}
            </div>

        </div>


        @if($recommendations->count() > 0)

            <div class="recommendations-grid">

                @foreach($recommendations as $recommendation)

                    @php
                        $course = $recommendation->course;
                        $university = $course?->university;

                        $match = (float) $recommendation->match_percentage;

                        $tuition = $course?->tuitionFees
                            ? $course->tuitionFees->sortBy('fee_amount')->first()
                            : null;

                        $statusClass =
                            strtolower($recommendation->recommendation_status ?? '') === 'recommended'
                            ? 'status-recommended'
                            : 'status-review';
                    @endphp


                    <article class="recommendation-card">

                        <div class="card-top">

                            <div>

                                <div class="university">
                                    {{ $university?->university_name ?? 'University not available' }}
                                </div>

                                <div class="course-name">
                                    {{ $course?->course_name ?? 'Course not available' }}
                                </div>

                            </div>

                            <div class="match-box">

                                <div class="match-number">
                                    {{ number_format($match, 0) }}%
                                </div>

                                <div class="match-label">
                                    Match
                                </div>

                            </div>

                        </div>


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


                        <div class="progress-area">

                            <div class="progress-header">

                                <span class="progress-title">
                                    Overall Match
                                </span>

                                <span class="progress-value">
                                    {{ number_format($match, 0) }}%
                                </span>

                            </div>

                            <div class="progress">

                                <div
                                    class="progress-bar"
                                    data-progress="{{ min(100, max(0, $match)) }}"
                                ></div>

                            </div>

                        </div>


                        <div class="factors">

                            <div class="factor-title">
                                Eligibility Factors
                            </div>

                            <div class="factor-list">


                                <div class="factor
                                    {{ $recommendation->qualification_match ? 'factor-pass' : 'factor-fail' }}"
                                >

                                    <span class="factor-icon">
                                        {{ $recommendation->qualification_match ? '✓' : '×' }}
                                    </span>

                                    Qualification
                                </div>


                                <div class="factor
                                    {{ $recommendation->english_match ? 'factor-pass' : 'factor-fail' }}"
                                >

                                    <span class="factor-icon">
                                        {{ $recommendation->english_match ? '✓' : '×' }}
                                    </span>

                                    English
                                </div>


                                <div class="factor
                                    {{ $recommendation->budget_match ? 'factor-pass' : 'factor-fail' }}"
                                >

                                    <span class="factor-icon">
                                        {{ $recommendation->budget_match ? '✓' : '×' }}
                                    </span>

                                    Budget
                                </div>


                                <div class="factor
                                    {{ $recommendation->preference_match ? 'factor-pass' : 'factor-fail' }}"
                                >

                                    <span class="factor-icon">
                                        {{ $recommendation->preference_match ? '✓' : '×' }}
                                    </span>

                                    Preferences
                                </div>


                                <div class="factor
                                    {{ $recommendation->work_experience_match ? 'factor-pass' : 'factor-fail' }}"
                                >

                                    <span class="factor-icon">
                                        {{ $recommendation->work_experience_match ? '✓' : '×' }}
                                    </span>

                                    Work Experience
                                </div>

                            </div>

                        </div>


                        @if($tuition)

                            <div class="fee">

                                <div class="fee-label">
                                    Tuition Fee
                                </div>

                                <div class="fee-value">

                                    {{ $tuition->currency }}
                                    {{ number_format((float) $tuition->fee_amount, 2) }}

                                    @if($tuition->fee_type)
                                        <span style="font-size:11px;color:#8992a3;font-weight:500;">
                                            · {{ $tuition->fee_type }}
                                        </span>
                                    @endif

                                </div>

                            </div>

                        @endif


                        @if($recommendation->recommendation_reason)

                            <div class="reason">
                                {{ $recommendation->recommendation_reason }}
                            </div>

                        @endif


                        <div class="card-actions">

                            <span class="status {{ $statusClass }}">
                                {{ $recommendation->recommendation_status ?? 'Under Review' }}
                            </span>

                            <span style="display:flex; gap:8px; flex-wrap:wrap;">
                                @if($recommendation->course)
                                    <a
                                        href="{{ route('student.roadmap.show', $recommendation->course) }}"
                                        class="view-button"
                                        style="background:#fff; color:#ff7417; border:1px solid #ffc89c;"
                                    >
                                        View Admission Roadmap
                                    </a>
                                @endif

                                <a
                                    href="{{ route('student.recommendations.show', $recommendation) }}"
                                    class="view-button"
                                >
                                    View Details
                                </a>
                            </span>

                        </div>

                    </article>

                @endforeach

            </div>


            <div class="pagination">
                {{ $recommendations->links() }}
            </div>


        @else

            <div class="empty-state">

                <div class="empty-icon">
                    ★
                </div>

                <div class="empty-title">
                    No recommendations yet
                </div>

                <p class="empty-text">
                    We can match your existing qualifications, English
                    results, study preferences, budget and work experience
                    against the available study options.
                    Click <strong>Generate Recommendations</strong> above
                    to start.
                </p>

            </div>

        @endif

    </main>

</div>


<script>
    document
        .querySelectorAll('.progress-bar[data-progress]')
        .forEach(function (element) {

            element.style.width =
                element.dataset.progress + '%';

        });
</script>

</div>

</body>
</html>