<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Scholarships | INDIC RMC</title>

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
            top: -190px;

            opacity: 0.55;
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

            box-shadow:
                0 8px 25px
                rgba(70, 50, 120, 0.08);

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

            box-shadow:
                0 12px 25px
                rgba(255, 102, 51, 0.20);
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


        /* =====================================================
           HERO SCHOLARSHIP VISUAL
        ===================================================== */

        .scholarship-visual {
            min-height: 390px;

            position: relative;
        }

        .scholarship-image {
            position: absolute;

            right: 20px;
            top: 10px;

            width: 390px;
            height: 350px;

            border-radius: 35px;

            background-image:
                linear-gradient(
                    to bottom,
                    rgba(17,25,54,0.05),
                    rgba(17,25,54,0.55)
                ),
                url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1200&q=85");

            background-size: cover;

            background-position: center;

            box-shadow:
                0 30px 60px
                rgba(40, 30, 90, 0.18);
        }

        .award-card {
            position: absolute;

            left: 0;

            top: 65px;

            background: white;

            padding: 22px;

            border-radius: 20px;

            box-shadow:
                0 18px 45px
                rgba(30, 25, 60, 0.14);

            z-index: 3;
        }

        .award-icon {
            width: 50px;
            height: 50px;

            border-radius: 14px;

            background: #fff0e9;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 25px;

            margin-bottom: 12px;
        }

        .award-card small {
            display: block;

            color: #77798a;

            font-size: 11px;

            margin-bottom: 6px;
        }

        .award-card strong {
            font-size: 18px;
        }

        .amount-card {
            position: absolute;

            right: -5px;

            bottom: 20px;

            background: #111936;

            color: white;

            padding: 20px 24px;

            border-radius: 18px;

            z-index: 3;

            box-shadow:
                0 18px 40px
                rgba(17,25,54,0.2);
        }

        .amount-card small {
            display: block;

            color: #bfc3d2;

            font-size: 11px;

            margin-bottom: 7px;
        }

        .amount-card strong {
            font-size: 22px;

            color: #ff8055;
        }


        /* =====================================================
           INTRO STATS
        ===================================================== */

        .stats-section {
            padding: 0 8% 75px;
        }

        .stats {
            max-width: 1150px;

            margin: auto;

            display: grid;

            grid-template-columns: repeat(4, 1fr);

            background: #111936;

            border-radius: 25px;

            overflow: hidden;

            box-shadow:
                0 20px 45px
                rgba(20, 25, 55, 0.12);
        }

        .stat {
            padding: 30px 20px;

            text-align: center;

            border-right:
                1px solid
                rgba(255,255,255,0.12);
        }

        .stat:last-child {
            border-right: none;
        }

        .stat h2 {
            color: #ff6633;

            font-size: 31px;

            margin-bottom: 8px;
        }

        .stat p {
            color: #c5c8d4;

            font-size: 13px;
        }


        /* =====================================================
           FEATURED SCHOLARSHIP
        ===================================================== */

        .featured-section {
            padding: 30px 8% 90px;
        }

        .featured {
            max-width: 1200px;

            min-height: 390px;

            margin: auto;

            display: grid;

            grid-template-columns: 0.85fr 1.15fr;

            border-radius: 32px;

            overflow: hidden;

            background: white;

            box-shadow:
                0 20px 50px
                rgba(50,40,90,0.10);
        }

        .featured-image {
            min-height: 390px;

            background-image:
                linear-gradient(
                    rgba(17,25,54,0.15),
                    rgba(17,25,54,0.15)
                ),
                url("https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=1200&q=85");

            background-size: cover;

            background-position: center;
        }

        .featured-content {
            padding: 55px;
        }

        .featured-label {
            display: inline-block;

            background: #fff0e9;

            color: #ff6633;

            padding: 8px 14px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 800;

            margin-bottom: 20px;
        }

        .featured-content h2 {
            font-size: 39px;

            line-height: 1.12;

            margin-bottom: 18px;
        }

        .featured-content p {
            color: #707282;

            line-height: 1.75;

            margin-bottom: 22px;
        }

        .featured-details {
            display: flex;

            flex-wrap: wrap;

            gap: 10px;

            margin-bottom: 25px;
        }

        .detail {
            padding: 9px 12px;

            background: #f7f4ff;

            color: #55586b;

            border-radius: 9px;

            font-size: 12px;

            font-weight: 700;
        }

        .featured-button {
            display: inline-block;

            background: #ff6633;

            color: white;

            text-decoration: none;

            padding: 14px 22px;

            border-radius: 11px;

            font-weight: 700;
        }


        /* =====================================================
           SCHOLARSHIP CARDS
        ===================================================== */

        .scholarships-section {
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

            max-width: 700px;
        }

        .scholarships-grid {
            max-width: 1150px;

            margin: auto;

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 25px;
        }

        .scholarship-card {
            background: #f7f4ff;

            border: 1px solid #ebe6f7;

            border-radius: 25px;

            overflow: hidden;

            transition: 0.3s;
        }

        .scholarship-card:hover {
            transform: translateY(-7px);

            box-shadow:
                0 20px 40px
                rgba(45,35,90,0.12);
        }

        .card-image {
            height: 190px;

            background-size: cover;

            background-position: center;

            position: relative;
        }

        .card-image::after {
            content: "";

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    to top,
                    rgba(17,25,54,0.6),
                    transparent
                );
        }

        .funding-badge {
            position: absolute;

            z-index: 2;

            left: 20px;

            bottom: 17px;

            background: #ff6633;

            color: white;

            padding: 7px 11px;

            border-radius: 8px;

            font-size: 12px;

            font-weight: 800;
        }

        .scholarship-content {
            padding: 27px;
        }

        .destination {
            color: #ff6633;

            font-size: 12px;

            font-weight: 800;

            text-transform: uppercase;

            margin-bottom: 10px;
        }

        .scholarship-content h3 {
            font-size: 21px;

            line-height: 1.25;

            margin-bottom: 12px;
        }

        .scholarship-content p {
            color: #707282;

            line-height: 1.65;

            font-size: 14px;

            margin-bottom: 20px;
        }

        .card-meta {
            display: flex;

            gap: 8px;

            flex-wrap: wrap;
        }

        .meta-pill {
            background: white;

            padding: 7px 10px;

            border-radius: 8px;

            color: #5d5f70;

            font-size: 11px;

            font-weight: 700;
        }


        /* =====================================================
           HOW IT WORKS
        ===================================================== */

        .process-section {
            padding: 90px 8%;

            background: #f7f4ff;
        }

        .process-grid {
            max-width: 1150px;

            margin: auto;

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 25px;
        }

        .process-card {
            background: white;

            padding: 30px;

            border-radius: 22px;

            border: 1px solid #ebe6f7;
        }

        .process-number {
            width: 45px;
            height: 45px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #111936;

            color: white;

            font-weight: 800;

            margin-bottom: 20px;
        }

        .process-card h3 {
            font-size: 21px;

            margin-bottom: 10px;
        }

        .process-card p {
            color: #707282;

            line-height: 1.7;

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
            max-width: 680px;

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

            border-top:
                1px solid
                rgba(255,255,255,0.1);

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

            .scholarship-visual {
                display: none;
            }

            .featured {
                grid-template-columns: 1fr;
            }

            .featured-image {
                min-height: 300px;
            }

            .scholarships-grid {
                grid-template-columns: 1fr 1fr;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
            }

            .stat:nth-child(2) {
                border-right: none;
            }

            .stat:nth-child(1),
            .stat:nth-child(2) {
                border-bottom:
                    1px solid
                    rgba(255,255,255,0.12);
            }
        }


        @media (max-width: 650px) {

            .hero h1 {
                font-size: 43px;
            }

            .scholarships-grid {
                grid-template-columns: 1fr;
            }

            .process-grid {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .stat {
                border-right: none;

                border-bottom:
                    1px solid
                    rgba(255,255,255,0.12);
            }

            .stat:last-child {
                border-bottom: none;
            }

            .featured-content {
                padding: 35px;
            }

            .featured-content h2 {
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

                    Fund Your Future

                </div>


                <h1>

                    Turn your dreams
                    into

                    <span class="orange">
                        opportunities.
                    </span>

                    <span class="purple">
                        .
                    </span>

                </h1>


                <p class="hero-description">

                    Explore scholarship opportunities that can help
                    reduce your study costs and make your international
                    education journey more achievable.

                </p>


                <div class="hero-buttons">

                    <a
                        href="#scholarships"
                        class="primary-button"
                    >
                        Explore Scholarships →
                    </a>

                    <a
                        href="{{ url('/contact') }}"
                        class="secondary-button"
                    >
                        Talk to a Consultant
                    </a>

                </div>

            </div>


            <!-- HERO VISUAL -->

            <div class="scholarship-visual">

                <div class="scholarship-image"></div>


                <div class="award-card">

                    <div class="award-icon">
                        🎓
                    </div>

                    <small>
                        SCHOLARSHIP OPPORTUNITY
                    </small>

                    <strong>
                        Your Future Starts Here
                    </strong>

                </div>


                <div class="amount-card">

                    <small>
                        FUNDING OPPORTUNITIES
                    </small>

                    <strong>
                        Tuition Support
                    </strong>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         STATS
    ===================================================== -->

    <section class="stats-section">

        <div class="stats">

            <div class="stat">

                <h2>
                    100+
                </h2>

                <p>
                    Scholarship Opportunities
                </p>

            </div>


            <div class="stat">

                <h2>
                    10+
                </h2>

                <p>
                    Study Destinations
                </p>

            </div>


            <div class="stat">

                <h2>
                    500+
                </h2>

                <p>
                    Students Guided
                </p>

            </div>


            <div class="stat">

                <h2>
                    1:1
                </h2>

                <p>
                    Consultant Guidance
                </p>

            </div>

        </div>

    </section>


    <!-- =====================================================
         FEATURED SCHOLARSHIP
    ===================================================== -->

    <section class="featured-section">

        <div class="featured">


            <div class="featured-image"></div>


            <div class="featured-content">

                <div class="featured-label">
                    FEATURED OPPORTUNITY
                </div>


                <h2>
                    Study Abroad With
                    Financial Support
                </h2>


                <p>
                    Scholarships may be available based on academic
                    performance, financial circumstances, country,
                    institution and selected study program.
                </p>


                <div class="featured-details">

                    <span class="detail">
                        🎓 Merit Based
                    </span>

                    <span class="detail">
                        🌍 International
                    </span>

                    <span class="detail">
                        💰 Tuition Support
                    </span>

                    <span class="detail">
                        📚 Multiple Fields
                    </span>

                </div>


                <a
                    href="{{ url('/contact') }}"
                    class="featured-button"
                >
                    Check Your Options →
                </a>

            </div>

        </div>

    </section>


    <!-- =====================================================
         SCHOLARSHIP CARDS
    ===================================================== -->

    <section
        class="scholarships-section"
        id="scholarships"
    >

        <div class="section-heading">

            <h2>
                Explore Scholarship Opportunities
            </h2>

            <p>
                Explore different types of funding opportunities
                available across popular international study destinations.
            </p>

        </div>


        <div class="scholarships-grid">

            @php
                // Pictures for the top of each card when no course/university image exists.
                $scholarshipPhotos = [
                    'https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1469521669194-babb45599def?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1485738422979-f5c462d49f74?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1503614472-8c93d56c8c5b?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1529655683826-aba9b3e77383?auto=format&fit=crop&w=1000&q=85',
                ];
            @endphp

            @forelse ($scholarships as $scholarship)
                @php
                    $photo = $scholarship->course?->image_url
                        ?: $scholarship->university?->logo_url
                        ?: $scholarshipPhotos[$scholarship->scholarship_id % count($scholarshipPhotos)];

                    // The award type chosen in the admin portal, and the award value.
                    $badge = strtoupper($scholarship->award_type_label);
                    $award = $scholarship->award_text;
                @endphp

                <div class="scholarship-card">

                    <div class="card-image" style="background-image: url('{{ $photo }}');">
                        <div class="funding-badge">
                            {{ $badge }}
                        </div>
                    </div>

                    <div class="scholarship-content">

                        <div class="destination">
                            {{ $scholarship->university?->country?->country_name ?? 'Any destination' }}
                        </div>

                        <h3>
                            {{ $scholarship->scholarship_name }}
                        </h3>

                        <p>
                            <strong>{{ $scholarship->university?->university_name ?? 'Open to all partner universities' }}</strong>{{ $scholarship->course ? ' – ' . $scholarship->course->course_name : '' }}.
                            {{ Str::limit($scholarship->description ?: $scholarship->eligibility ?: '', 120) }}
                        </p>

                        <div class="card-meta">

                            @if ($award)
                                <span class="meta-pill">{{ $award }}</span>
                            @endif

                            @if ($scholarship->application_deadline)
                                <span class="meta-pill">Apply by {{ $scholarship->application_deadline->format('d M Y') }}</span>
                            @endif

                            @if ($scholarship->course?->course_level)
                                <span class="meta-pill">{{ $scholarship->course->course_level }}</span>
                            @endif

                        </div>

                    </div>

                </div>
            @empty
                <p style="grid-column: 1 / -1; text-align: center; color: #6b6d7c; padding: 40px 0;">
                    New scholarship opportunities are coming soon.
                </p>
            @endforelse

        </div>

    </section>


    <!-- =====================================================
         HOW IT WORKS
    ===================================================== -->

    <section class="process-section">

        <div class="section-heading">

            <h2>
                How INDIC RMC Can Help
            </h2>

            <p>
                Finding a suitable scholarship starts with understanding
                your academic background and study plans.
            </p>

        </div>


        <div class="process-grid">


            <div class="process-card">

                <div class="process-number">
                    01
                </div>

                <h3>
                    Understand Your Profile
                </h3>

                <p>
                    We consider your qualifications, academic background,
                    preferred destination and intended course.
                </p>

            </div>


            <div class="process-card">

                <div class="process-number">
                    02
                </div>

                <h3>
                    Explore Opportunities
                </h3>

                <p>
                    Suitable scholarship and funding opportunities can
                    then be identified based on your study pathway.
                </p>

            </div>


            <div class="process-card">

                <div class="process-number">
                    03
                </div>

                <h3>
                    Prepare Your Application
                </h3>

                <p>
                    Get guidance on preparing the documents and
                    information required for your application.
                </p>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CTA
    ===================================================== -->

    <section class="cta-section">

        <div class="cta-box">

            <h2>
                Looking for Financial Support?
            </h2>

            <p>
                Tell us where you want to study and what you want to
                study. Our consultants can help you explore suitable
                scholarship and funding pathways.
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

                <a href="{{ url('/courses') }}">
                    Courses
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