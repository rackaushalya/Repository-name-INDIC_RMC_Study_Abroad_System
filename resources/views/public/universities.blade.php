<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Universities | INDIC RMC</title>

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

        /* =========================
           NAVBAR
        ========================== */

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


        /* =========================
           HERO
        ========================== */

        .hero {
            text-align: center;
            padding: 70px 20px 45px;
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
            font-size: 52px;
            line-height: 1.1;

            margin-bottom: 18px;
        }

        .hero h1 span {
            color: #ff6633;
        }

        .hero p {
            max-width: 720px;
            margin: auto;

            color: #686a7b;
            font-size: 18px;
            line-height: 1.7;
        }


        /* =========================
           UNIVERSITY GRID
        ========================== */

        .universities-section {
            padding: 20px 7% 90px;
        }

        .university-grid {
            max-width: 1400px;
            margin: auto;

            display: grid;
            grid-template-columns: repeat(3, 1fr);

            gap: 28px;
        }


        /* =========================
           UNIVERSITY CARD
        ========================== */

        .university-card {
            height: 410px;

            position: relative;

            border-radius: 30px;
            overflow: hidden;

            background-size: cover;
            background-position: center;

            display: flex;
            align-items: flex-end;

            box-shadow: 0 10px 25px rgba(25, 20, 50, 0.08);

            transition: transform 0.3s ease,
                        box-shadow 0.3s ease;
        }

        .university-card:hover {
            transform: translateY(-7px);

            box-shadow: 0 20px 40px rgba(25, 20, 50, 0.18);
        }


        /* Dark image gradient */

        .university-card::after {
            content: "";

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    to top,
                    rgba(0, 0, 0, 0.85) 0%,
                    rgba(0, 0, 0, 0.45) 45%,
                    rgba(0, 0, 0, 0.05) 100%
                );
        }


        /* Card content */

        .university-content {
            position: relative;

            z-index: 2;

            width: 100%;

            padding: 32px 30px;
            color: white;
        }

        .university-content .country {
            font-size: 13px;

            text-transform: uppercase;

            letter-spacing: 1px;

            margin-bottom: 12px;

            color: #eeeeee;
        }

        .university-content h2 {
            font-size: 27px;

            line-height: 1.15;

            margin-bottom: 18px;
        }

        .explore-link {
            display: inline-block;

            color: white;

            font-size: 15px;

            font-weight: 700;

            text-decoration: none;

            padding-bottom: 5px;

            border-bottom: 1px solid white;
        }

        .explore-link:hover {
            color: #ff8055;
            border-color: #ff8055;
        }


        /* =========================
           CTA
        ========================== */

        .cta-section {
            padding: 80px 8%;

            background: white;

            text-align: center;
        }

        .cta-box {
            max-width: 900px;

            margin: auto;

            padding: 55px 30px;

            border-radius: 30px;

            background: linear-gradient(
                135deg,
                #ff6633,
                #ff8055
            );

            color: white;
        }

        .cta-box h2 {
            font-size: 38px;
            margin-bottom: 15px;
        }

        .cta-box p {
            max-width: 650px;

            margin: 0 auto 25px;

            line-height: 1.7;
        }

        .cta-button {
            display: inline-block;

            padding: 14px 28px;

            background: white;

            color: #ff6633;

            text-decoration: none;

            font-weight: 700;

            border-radius: 25px;
        }


        /* =========================
           FOOTER
        ========================== */

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
            max-width: 400px;

            color: #aeb2c2;

            line-height: 1.7;
        }

        .footer-links {
            display: flex;

            gap: 25px;

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


        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 1000px) {

            .navbar {
                padding: 20px 25px;

                flex-direction: column;

                gap: 20px;
            }

            .nav-links {
                flex-wrap: wrap;

                justify-content: center;
            }

            .university-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }


        @media (max-width: 650px) {

            .hero h1 {
                font-size: 40px;
            }

            .university-grid {
                grid-template-columns: 1fr;
            }

            .university-card {
                height: 380px;
            }

            .footer-content {
                flex-direction: column;
            }
        }
    </style>
</head>


<body>


    <!-- =========================
         NAVBAR
    ========================== -->

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


    <!-- =========================
         HERO
    ========================== -->

    <section class="hero">

        <div class="hero-label">

            <span class="orange-dot"></span>

            Explore Universities

        </div>


        <h1>
            Discover Your
            <span>Future University.</span>
        </h1>


        <p>
            Explore leading universities across popular study destinations
            and find the right institution for your academic journey.
        </p>

    </section>


    <!-- =========================
         UNIVERSITY CARDS
    ========================== -->

    <section class="universities-section">

        <div class="university-grid">

            @php
                // Campus photos used as card backgrounds, picked by university.
                $campusPhotos = [
                    'https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1592280771190-3e2e4d571952?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1599458252573-56ae36120de1?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1568792923760-d70635a89fdc?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1606761568499-6d2451b23c66?auto=format&fit=crop&w=1200&q=85',
                ];
            @endphp

            @forelse ($universities as $university)
                @php
                    // Use the image uploaded in the admin portal as the card background;
                    // otherwise fall back to one of the campus photos.
                    $photo = $university->logo_url
                        ?: $campusPhotos[$university->university_id % count($campusPhotos)];
                @endphp

                <div class="university-card" style="background-image: url('{{ $photo }}');">

                    <div class="university-content">

                        <div class="country">
                            STUDY IN {{ strtoupper($university->country?->country_name ?? 'ABROAD') }}{{ $university->city ? ' • ' . strtoupper($university->city) : '' }}
                        </div>

                        <h2>
                            {{ $university->university_name }}
                        </h2>

                        @if ($university->ranking)
                            <p style="margin: -6px 0 16px; font-size: 14px; color: #eeeeee;">
                                World ranking #{{ $university->ranking }}
                            </p>
                        @endif

                        @if ($university->website)
                            <a href="{{ $university->website }}" target="_blank" rel="noopener" class="explore-link">
                                Visit university website →
                            </a>
                        @else
                            <a href="{{ url('/courses') }}" class="explore-link">
                                Explore courses →
                            </a>
                        @endif

                    </div>

                </div>
            @empty
                <p style="grid-column: 1 / -1; text-align: center; color: #6b6d7c; padding: 40px 0;">
                    New partner universities are coming soon.
                </p>
            @endforelse

        </div>

    </section>


    <!-- =========================
         CTA
    ========================== -->

    <section class="cta-section">

        <div class="cta-box">

            <h2>
                Find the Right University for You
            </h2>

            <p>
                Explore destinations, compare opportunities and take the
                next step toward your international education journey.
            </p>

            <a
                href="{{ url('/countries') }}"
                class="cta-button"
            >
                Explore Destinations
            </a>

        </div>

    </section>


    <!-- =========================
         FOOTER
    ========================== -->

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

                <a href="{{ url('/courses') }}">
                    Courses
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