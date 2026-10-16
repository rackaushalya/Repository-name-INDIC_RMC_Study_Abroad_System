<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Courses | INDIC RMC</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f4ff;
            color: #111936;
        }

        /* =====================================================
           NAVBAR
        ===================================================== */

        .navbar {
            width: 100%;
            min-height: 100px;
            padding: 0 55px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            background: #f7f4ff;
            border-bottom: 1px solid #e8e2f5;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #ff6633;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;
        }

        .logo-circle img {
            width: 52px;
            height: 52px;
            object-fit: contain;
        }

        .brand-name {
            font-size: 29px;
            font-weight: 800;
            color: #101936;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links a {
            text-decoration: none;
            color: #151515;
            font-size: 16px;
            font-weight: 600;
        }

        .nav-links a:hover {
            color: #ff6633;
        }

        .register-button {
            background: #101827;
            color: white !important;
            padding: 14px 24px;
            border-radius: 12px;
        }

        .register-button:hover {
            background: #ff6633;
        }


        /* =====================================================
           HERO
        ===================================================== */

        .hero {
            position: relative;
            padding: 85px 8% 80px;
            overflow: hidden;
        }

        .hero::before {
            content: "";

            position: absolute;

            width: 420px;
            height: 420px;

            background: #ddd4ff;

            border-radius: 50%;

            right: -180px;
            top: -200px;

            opacity: 0.5;
        }

        .hero-content {
            max-width: 1200px;
            margin: auto;

            display: grid;
            grid-template-columns: 1.1fr 0.9fr;

            gap: 60px;
            align-items: center;

            position: relative;
            z-index: 2;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;

            background: white;

            padding: 12px 20px;

            border-radius: 30px;

            color: #5543a5;
            font-weight: 700;

            box-shadow: 0 8px 25px rgba(70, 50, 120, 0.08);

            margin-bottom: 25px;
        }

        .orange-dot {
            width: 12px;
            height: 12px;

            border-radius: 50%;
            background: #ff6633;
        }

        .hero h1 {
            font-size: 64px;
            line-height: 1.03;

            letter-spacing: -2px;

            margin-bottom: 25px;
        }

        .hero h1 .orange {
            color: #ff6633;
        }

        .hero h1 .purple {
            color: #6654c7;
        }

        .hero-description {
            max-width: 650px;

            color: #666879;

            font-size: 18px;
            line-height: 1.8;

            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .primary-button {
            display: inline-block;

            background: #ff6633;
            color: white;

            padding: 15px 25px;

            border-radius: 12px;

            text-decoration: none;

            font-weight: 700;

            box-shadow: 0 12px 25px rgba(255, 102, 51, 0.20);
        }

        .secondary-button {
            display: inline-block;

            background: white;
            color: #111936;

            padding: 15px 25px;

            border-radius: 12px;

            text-decoration: none;

            font-weight: 700;
        }


        /* HERO VISUAL */

        .hero-visual {
            position: relative;
            min-height: 390px;
        }

        .orbit {
            width: 330px;
            height: 330px;

            border-radius: 50%;

            background: linear-gradient(
                145deg,
                #ff6633,
                #ff9676
            );

            position: absolute;

            right: 30px;
            top: 20px;

            box-shadow: 0 30px 60px rgba(255, 102, 51, 0.18);
        }

        .orbit-inner {
            width: 230px;
            height: 230px;

            border-radius: 50%;

            background: #111936;

            position: absolute;

            top: 50px;
            left: 50px;

            display: flex;
            align-items: center;
            justify-content: center;

            text-align: center;

            color: white;
        }

        .orbit-inner h2 {
            font-size: 28px;
            line-height: 1.15;
        }

        .floating-card {
            position: absolute;

            background: white;

            border-radius: 18px;

            padding: 20px;

            box-shadow: 0 18px 45px rgba(30, 25, 60, 0.14);
        }

        .floating-card.one {
            top: 35px;
            left: 0;
        }

        .floating-card.two {
            bottom: 35px;
            right: 0;
        }

        .floating-card small {
            display: block;

            color: #77798a;

            font-size: 12px;

            margin-bottom: 7px;
        }

        .floating-card strong {
            font-size: 17px;
        }


        /* =====================================================
           FEATURED COURSE
        ===================================================== */

        .featured-section {
            padding: 20px 8% 90px;
        }

        .featured {
            max-width: 1200px;
            min-height: 390px;

            margin: auto;

            border-radius: 32px;

            overflow: hidden;

            background: #111936;

            display: grid;

            grid-template-columns: 1fr 0.8fr;

            color: white;
        }

        .featured-content {
            padding: 55px;
        }

        .featured-tag {
            display: inline-block;

            background: rgba(255,255,255,0.12);

            color: #ff9b7b;

            padding: 8px 14px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 700;

            margin-bottom: 20px;
        }

        .featured h2 {
            font-size: 40px;
            line-height: 1.1;

            margin-bottom: 18px;
        }

        .featured p {
            color: #c8cad5;

            line-height: 1.7;

            max-width: 560px;

            margin-bottom: 25px;
        }

        .featured-meta {
            display: flex;

            gap: 20px;

            flex-wrap: wrap;

            color: #e1e2e8;

            font-size: 14px;

            margin-bottom: 25px;
        }

        .featured-button {
            display: inline-block;

            padding: 13px 22px;

            background: #ff6633;

            color: white;

            border-radius: 10px;

            text-decoration: none;

            font-weight: 700;
        }

        .featured-image {
            min-height: 390px;

            background-image:
                linear-gradient(
                    to right,
                    rgba(17,25,54,0.15),
                    rgba(17,25,54,0)
                ),
                url("https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1200&q=85");

            background-size: cover;

            background-position: center;
        }


        /* =====================================================
           COURSES
        ===================================================== */

        .courses-section {
            background: white;

            padding: 90px 8%;
        }

        .section-heading {
            max-width: 1150px;

            margin: auto auto 45px;
        }

        .section-heading h2 {
            font-size: 40px;
            margin-bottom: 12px;
        }

        .section-heading p {
            color: #707282;
            line-height: 1.7;
        }

        .courses-grid {
            max-width: 1150px;

            margin: auto;

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 25px;
        }


        /* =====================================================
           COURSE CARD
        ===================================================== */

        .course-card {
            background: #f7f4ff;

            border: 1px solid #ebe6f7;

            border-radius: 25px;

            overflow: hidden;

            transition: 0.3s;
        }

        .course-card:hover {
            transform: translateY(-7px);

            box-shadow:
                0 20px 40px
                rgba(45, 35, 90, 0.12);
        }

        .course-image {
            height: 190px;

            background-size: cover;
            background-position: center;

            position: relative;
        }

        .course-image::after {
            content: "";

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    to top,
                    rgba(17,25,54,0.65),
                    rgba(17,25,54,0)
                );
        }

        .course-number {
            position: absolute;

            z-index: 2;

            left: 20px;
            bottom: 18px;

            color: white;

            font-size: 13px;

            font-weight: 800;
        }

        .course-content {
            padding: 27px;
        }

        .course-content h3 {
            font-size: 22px;

            margin-bottom: 12px;
        }

        .course-content p {
            color: #707282;

            line-height: 1.7;

            font-size: 15px;

            margin-bottom: 22px;
        }

        .course-info {
            display: flex;

            gap: 8px;

            flex-wrap: wrap;
        }

        .info-pill {
            background: white;

            padding: 7px 11px;

            border-radius: 8px;

            color: #5d5f70;

            font-size: 12px;

            font-weight: 700;
        }


        /* =====================================================
           POPULAR AREAS
        ===================================================== */

        .popular-section {
            padding: 90px 8%;

            background: #f7f4ff;
        }

        .popular-grid {
            max-width: 1150px;

            margin: auto;

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 25px;
        }

        .popular-item {
            background: white;

            border-radius: 20px;

            padding: 25px;

            display: flex;

            align-items: center;

            gap: 20px;

            border: 1px solid #ebe6f7;
        }

        .rank {
            width: 45px;
            height: 45px;

            flex-shrink: 0;

            border-radius: 50%;

            background: #111936;

            color: white;

            display: flex;

            align-items: center;
            justify-content: center;

            font-weight: 800;
        }

        .popular-item h3 {
            margin-bottom: 6px;
        }

        .popular-item p {
            color: #747686;
            font-size: 14px;
        }


        /* =====================================================
           CTA
        ===================================================== */

        .cta-section {
            padding: 85px 8%;

            background: white;

            text-align: center;
        }

        .cta-box {
            max-width: 950px;

            margin: auto;

            padding: 60px 30px;

            border-radius: 32px;

            background:
                linear-gradient(
                    135deg,
                    #ff6633,
                    #ff8055
                );

            color: white;
        }

        .cta-box h2 {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .cta-box p {
            max-width: 650px;

            margin: 0 auto 28px;

            line-height: 1.7;
        }

        .cta-button {
            display: inline-block;

            padding: 15px 28px;

            background: white;

            color: #ff6633;

            text-decoration: none;

            font-weight: 800;

            border-radius: 25px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        footer {
            background: #0d132b;

            color: white;

            padding: 45px 8% 25px;
        }

        .footer-content {
            max-width: 1200px;

            margin: auto;

            display: flex;

            justify-content: space-between;

            gap: 40px;
        }

        .footer-brand h3 {
            font-size: 25px;
            margin-bottom: 12px;
        }

        .footer-brand p {
            color: #aeb2c2;

            max-width: 420px;

            line-height: 1.7;
        }

        .footer-links {
            display: flex;

            gap: 24px;

            flex-wrap: wrap;
        }

        .footer-links a {
            color: #d6d8e2;

            text-decoration: none;
        }

        .footer-links a:hover {
            color: #ff6633;
        }

        .copyright {
            max-width: 1200px;

            margin: 35px auto 0;

            padding-top: 20px;

            border-top: 1px solid rgba(255,255,255,0.1);

            color: #85899b;

            font-size: 14px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1050px) {

            .navbar {
                padding: 20px 25px;

                flex-direction: column;

                gap: 20px;
            }

            .nav-links {
                flex-wrap: wrap;

                justify-content: center;
            }

            .hero-content {
                grid-template-columns: 1fr;
            }

            .hero-visual {
                display: none;
            }

            .featured {
                grid-template-columns: 1fr;
            }

            .featured-image {
                min-height: 300px;
            }

            .courses-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 650px) {

            .hero h1 {
                font-size: 43px;
            }

            .courses-grid {
                grid-template-columns: 1fr;
            }

            .popular-grid {
                grid-template-columns: 1fr;
            }

            .featured-content {
                padding: 35px;
            }

            .featured h2 {
                font-size: 31px;
            }

            .footer-content {
                flex-direction: column;
            }
        }

    </style>
</head>


<body>


    <!-- =====================================================
         NAVBAR
    ===================================================== -->

    <nav class="navbar">

        <div class="logo-area">

            <div class="logo-circle">

                <img
                    src="{{ asset('images/indic-rmc-mark.png') }}"
                    alt="INDIC RMC Logo"
                >

            </div>

            <div class="brand-name">
                INDIC RMC
            </div>

        </div>


        <div class="nav-links">

            <a href="{{ url('/') }}">
                Home
            </a>

            <a href="{{ url('/about') }}">
                About
            </a>

            <a href="{{ url('/countries') }}">
                Destinations
            </a>

            <a href="{{ url('/universities') }}">
                Universities
            </a>

            <a href="{{ url('/courses') }}">
                Courses
            </a>

            <a href="{{ url('/scholarships') }}">
                Scholarships
            </a>

            <a href="{{ url('/contact') }}">
                Contact
            </a>

            <a href="{{ url('/login') }}">
                Login
            </a>

            <a
                href="{{ url('/register') }}"
                class="register-button"
            >
                Register
            </a>

        </div>

    </nav>


    <!-- =====================================================
         HERO
    ===================================================== -->

    <section class="hero">

        <div class="hero-content">

            <div>

                <div class="hero-label">

                    <span class="orange-dot"></span>

                    Discover Your Future

                </div>


                <h1>

                    Find a course that

                    <span class="orange">
                        fits
                    </span>

                    <span class="purple">
                        your future.
                    </span>

                </h1>


                <p class="hero-description">

                    Explore study programs across the world's leading
                    education destinations. Find the right subject,
                    qualification and pathway for your career goals.

                </p>


                <div class="hero-buttons">

                    <a
                        href="#courses"
                        class="primary-button"
                    >
                        Explore Courses →
                    </a>

                    <a
                        href="{{ url('/countries') }}"
                        class="secondary-button"
                    >
                        View Destinations
                    </a>

                </div>

            </div>


            <div class="hero-visual">

                <div class="orbit">

                    <div class="orbit-inner">

                        <h2>
                            Your<br>
                            Future<br>
                            Starts<br>
                            Here.
                        </h2>

                    </div>

                </div>


                <div class="floating-card one">

                    <small>
                        POPULAR FIELD
                    </small>

                    <strong>
                        Computing & IT
                    </strong>

                </div>


                <div class="floating-card two">

                    <small>
                        STUDY LEVEL
                    </small>

                    <strong>
                        Undergraduate
                    </strong>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         FEATURED COURSE
    ===================================================== -->

    <section class="featured-section">

        <div class="featured">

            <div class="featured-content">

                <div class="featured-tag">
                    FEATURED STUDY PATHWAY
                </div>


                <h2>
                    Computer Science &
                    Software Engineering
                </h2>


                <p>
                    Build your future in technology through software
                    development, artificial intelligence, cybersecurity,
                    data science and modern computing.
                </p>


                <div class="featured-meta">

                    <span>
                        🎓 Undergraduate / Postgraduate
                    </span>

                    <span>
                        ⏱ 2–4 Years
                    </span>

                    <span>
                        🌍 Multiple Destinations
                    </span>

                </div>


                <a
                    href="#courses"
                    class="featured-button"
                >
                    Explore This Pathway →
                </a>

            </div>


            <div class="featured-image"></div>

        </div>

    </section>


    <!-- =====================================================
         COURSES
    ===================================================== -->

    <section
        class="courses-section"
        id="courses"
    >

        <div class="section-heading">

            <h2>
                Explore Available Courses
            </h2>

            <p>
                Browse the courses offered by our partner universities
                around the world.
            </p>

        </div>


        <div class="courses-grid">

            @php
                // Pictures used at the top of each course card, picked by course.
                $coursePhotos = [
                    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1561214115-f2f134cc4912?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=85',
                ];
            @endphp

            @forelse ($courses as $course)
                @php
                    $photo = $course->university?->logo_url
                        ?: $coursePhotos[$course->course_id % count($coursePhotos)];

                    $fee = $course->tuitionFees->sortByDesc('tuition_fee_id')->first();
                    $feeLabel = null;
                    if ($fee) {
                        $amount = (float) $fee->amount;
                        $feeLabel = trim($fee->currency . ' ' . number_format($amount, fmod($amount, 1) ? 2 : 0))
                            . ($fee->fee_period && $fee->fee_period !== 'Other' ? ' / ' . strtolower($fee->fee_period) : '');
                    }
                @endphp

                <div class="course-card">

                    <div class="course-image" style="background-image: url('{{ $photo }}');">
                        <div class="course-number">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ strtoupper($course->field_of_study ?: $course->course_level) }}
                        </div>
                    </div>

                    <div class="course-content">

                        <h3>
                            {{ $course->course_name }}
                        </h3>

                        <p>
                            <strong>{{ $course->university?->university_name }}</strong>{{ $course->university?->country ? ', ' . $course->university->country->country_name : '' }}.
                            {{ $course->description ? Str::limit($course->description, 120) : '' }}
                        </p>

                        <div class="course-info">

                            <span class="info-pill">{{ $course->course_level }}</span>

                            @if ($course->duration)
                                <span class="info-pill">{{ $course->duration }}</span>
                            @endif

                            @if ($course->study_mode)
                                <span class="info-pill">{{ $course->study_mode }}</span>
                            @endif

                            @if ($feeLabel)
                                <span class="info-pill">{{ $feeLabel }}</span>
                            @endif

                        </div>

                    </div>

                </div>
            @empty
                <p style="grid-column: 1 / -1; text-align: center; color: #6b6d7c; padding: 40px 0;">
                    New courses are coming soon.
                </p>
            @endforelse

        </div>

    </section>


    <!-- =====================================================
         POPULAR STUDY AREAS
    ===================================================== -->

    <section class="popular-section">

        <div class="section-heading">

            <h2>
                Popular Study Areas
            </h2>

            <p>
                Start exploring the fields students are most interested in.
            </p>

        </div>


        <div class="popular-grid">


            <div class="popular-item">

                <div class="rank">
                    01
                </div>

                <div>

                    <h3>
                        Information Technology
                    </h3>

                    <p>
                        Software • AI • Cybersecurity • Data
                    </p>

                </div>

            </div>


            <div class="popular-item">

                <div class="rank">
                    02
                </div>

                <div>

                    <h3>
                        Business & Management
                    </h3>

                    <p>
                        Management • Finance • Marketing
                    </p>

                </div>

            </div>


            <div class="popular-item">

                <div class="rank">
                    03
                </div>

                <div>

                    <h3>
                        Engineering
                    </h3>

                    <p>
                        Civil • Mechanical • Electrical
                    </p>

                </div>

            </div>


            <div class="popular-item">

                <div class="rank">
                    04
                </div>

                <div>

                    <h3>
                        Health Sciences
                    </h3>

                    <p>
                        Nursing • Biomedical • Healthcare
                    </p>

                </div>

            </div>


            <div class="popular-item">

                <div class="rank">
                    05
                </div>

                <div>

                    <h3>
                        Architecture & Design
                    </h3>

                    <p>
                        Architecture • Interior • Graphic Design
                    </p>

                </div>

            </div>


            <div class="popular-item">

                <div class="rank">
                    06
                </div>

                <div>

                    <h3>
                        Hospitality & Tourism
                    </h3>

                    <p>
                        Hotels • Tourism • Events
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CTA
    ===================================================== -->

    <section class="cta-section">

        <div class="cta-box">

            <h2>
                Still Not Sure What to Study?
            </h2>

            <p>
                Tell us about your qualifications, interests and career
                goals. INDIC RMC can help you explore suitable study
                pathways.
            </p>

            <a
                href="{{ url('/contact') }}"
                class="cta-button"
            >
                Talk to a Consultant →
            </a>

        </div>

    </section>


    <!-- =====================================================
         FOOTER
    ===================================================== -->

    <footer>

        <div class="footer-content">

            <div class="footer-brand">

                <h3>
                    INDIC RMC
                </h3>

                <p>
                    Helping students explore international education
                    opportunities and plan their study-abroad journey.
                </p>

            </div>


            <div class="footer-links">

                <a href="{{ url('/') }}">
                    Home
                </a>

                <a href="{{ url('/about') }}">
                    About
                </a>

                <a href="{{ url('/countries') }}">
                    Destinations
                </a>

                <a href="{{ url('/universities') }}">
                    Universities
                </a>

                <a href="{{ url('/scholarships') }}">
                    Scholarships
                </a>

                <a href="{{ url('/contact') }}">
                    Contact
                </a>

            </div>

        </div>


        <div class="copyright">

            © {{ date('Y') }} INDIC RMC. All rights reserved.

        </div>

    </footer>

</body>
</html>