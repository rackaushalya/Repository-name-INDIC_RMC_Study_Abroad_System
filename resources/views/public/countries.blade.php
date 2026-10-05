<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Study Destinations | INDIC RMC</title>

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

        /* NAVBAR */

        .navbar {
            width: 100%;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 55px;
            background: #f7f4ff;
            border-bottom: 1px solid #e8e2f5;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 16px;
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
            font-size: 30px;
            font-weight: 800;
            color: #101936;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
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

        .nav-button {
            background: #ff6633;
            color: white !important;
            padding: 13px 23px;
            border-radius: 25px;
        }

        /* HERO */

        .hero {
            text-align: center;
            padding: 80px 20px 55px;
        }

        .label {
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

        .dot {
            width: 12px;
            height: 12px;
            background: #ff6633;
            border-radius: 50%;
        }

        .hero h1 {
            font-size: 55px;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: #ff6633;
        }

        .hero p {
            max-width: 700px;
            margin: auto;
            color: #666879;
            font-size: 18px;
            line-height: 1.7;
        }

        /* COUNTRIES */

        .countries-section {
            padding: 40px 8% 90px;
        }

        .countries-grid {
            max-width: 1150px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .country-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            border: 1px solid #ebe6f7;
            transition: 0.3s;
        }

        .country-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 18px 40px rgba(45, 35, 90, 0.12);
        }

        .country-image {
            height: 190px;
            background: linear-gradient(135deg, #ff6633, #ff9975);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 70px;
        }

        .country-content {
            padding: 27px;
        }

        .country-content h2 {
            font-size: 24px;
            margin-bottom: 12px;
            color: #111936;
        }

        .country-content p {
            color: #6b6d7c;
            line-height: 1.7;
            font-size: 15px;
            margin-bottom: 20px;
        }

        .country-link {
            display: inline-block;
            color: #ff6633;
            text-decoration: none;
            font-weight: 700;
        }

        .country-link:hover {
            text-decoration: underline;
        }

        /* INFO SECTION */

        .info-section {
            background: white;
            padding: 80px 8%;
        }

        .info-content {
            max-width: 1050px;
            margin: auto;
            text-align: center;
        }

        .info-content h2 {
            font-size: 38px;
            margin-bottom: 18px;
        }

        .info-content p {
            max-width: 750px;
            margin: auto;
            color: #686a79;
            line-height: 1.8;
        }

        .benefits {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 45px;
        }

        .benefit {
            background: #f7f4ff;
            padding: 30px;
            border-radius: 22px;
        }

        .benefit-icon {
            font-size: 35px;
            margin-bottom: 15px;
        }

        .benefit h3 {
            margin-bottom: 10px;
        }

        .benefit p {
            font-size: 14px;
        }

        /* CTA */

        .cta {
            padding: 80px 8%;
            text-align: center;
            background: #f7f4ff;
        }

        .cta-box {
            max-width: 900px;
            margin: auto;
            padding: 55px 30px;
            border-radius: 30px;
            background: linear-gradient(135deg, #ff6633, #ff8055);
            color: white;
        }

        .cta-box h2 {
            font-size: 38px;
            margin-bottom: 15px;
        }

        .cta-box p {
            max-width: 650px;
            margin: auto auto 25px;
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

        /* FOOTER */

        footer {
            background: #0d132b;
            color: white;
            padding: 45px 8% 25px;
        }

        .footer-content {
            max-width: 1150px;
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
            max-width: 400px;
            line-height: 1.7;
        }

        .footer-links {
            display: flex;
            gap: 25px;
            align-items: flex-start;
        }

        .footer-links a {
            color: #d6d8e2;
            text-decoration: none;
        }

        .footer-links a:hover {
            color: #ff6633;
        }

        .copyright {
            max-width: 1150px;
            margin: 35px auto 0;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #85899b;
            font-size: 14px;
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {

            .navbar {
                padding: 20px 25px;
                flex-direction: column;
                gap: 20px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .countries-grid {
                grid-template-columns: 1fr 1fr;
            }

            .benefits {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {

            .brand-name {
                font-size: 25px;
            }

            .hero h1 {
                font-size: 40px;
            }

            .countries-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                flex-direction: column;
            }

            .footer-links {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar">

        <div class="logo-area">

            <div class="logo-circle">
                <img src="{{ asset('images/indic-rmc-mark.png') }}" alt="INDIC RMC Logo">
            </div>

            <div class="brand-name">
                INDIC RMC
            </div>

        </div>

        <div class="nav-links">

            <a href="{{ url('/') }}">Home</a>

            <a href="{{ url('/about') }}">About</a>

            <a href="{{ url('/countries') }}">Destinations</a>

            <a href="{{ url('/universities') }}">Universities</a>

            <a href="{{ url('/courses') }}">Courses</a>

            <a href="{{ url('/scholarships') }}">Scholarships</a>

            <a href="{{ url('/contact') }}" class="nav-button">
                Contact
            </a>

        </div>

    </nav>


    <!-- HERO -->

    <section class="hero">

        <div class="label">
            <span class="dot"></span>
            Explore Your Options
        </div>

        <h1>
            Study Around the
            <span>World</span>
        </h1>

        <p>
            Explore popular study destinations and discover opportunities
            to continue your education at leading international universities.
        </p>

    </section>


    <!-- COUNTRIES -->

    <section class="countries-section">

        <div class="countries-grid">

            <!-- UK -->

            <div class="country-card">

                <div class="country-image">
                    🇬🇧
                </div>

                <div class="country-content">

                    <h2>United Kingdom</h2>

                    <p>
                        Explore a wide range of undergraduate and postgraduate
                        study opportunities at universities across the UK.
                    </p>

                    <a href="{{ url('/universities') }}" class="country-link">
                        Explore Universities →
                    </a>

                </div>

            </div>


            <!-- Australia -->

            <div class="country-card">

                <div class="country-image">
                    🇦🇺
                </div>

                <div class="country-content">

                    <h2>Australia</h2>

                    <p>
                        Discover internationally recognised universities,
                        diverse courses and a welcoming environment for
                        international students.
                    </p>

                    <a href="{{ url('/universities') }}" class="country-link">
                        Explore Universities →
                    </a>

                </div>

            </div>


            <!-- Canada -->

            <div class="country-card">

                <div class="country-image">
                    🇨🇦
                </div>

                <div class="country-content">

                    <h2>Canada</h2>

                    <p>
                        Find education opportunities across Canadian
                        universities and colleges with a variety of study
                        programs.
                    </p>

                    <a href="{{ url('/universities') }}" class="country-link">
                        Explore Universities →
                    </a>

                </div>

            </div>


            <!-- New Zealand -->

            <div class="country-card">

                <div class="country-image">
                    🇳🇿
                </div>

                <div class="country-content">

                    <h2>New Zealand</h2>

                    <p>
                        Explore quality education opportunities in a country
                        known for its student-friendly environment.
                    </p>

                    <a href="{{ url('/universities') }}" class="country-link">
                        Explore Universities →
                    </a>

                </div>

            </div>


            <!-- Finland -->

            <div class="country-card">

                <div class="country-image">
                    🇫🇮
                </div>

                <div class="country-content">

                    <h2>Finland</h2>

                    <p>
                        Discover modern education opportunities and innovative
                        study programs offered by Finnish institutions.
                    </p>

                    <a href="{{ url('/universities') }}" class="country-link">
                        Explore Universities →
                    </a>

                </div>

            </div>


            <!-- France -->

            <div class="country-card">

                <div class="country-image">
                    🇫🇷
                </div>

                <div class="country-content">

                    <h2>France</h2>

                    <p>
                        Explore higher education opportunities across France,
                        including a variety of academic disciplines.
                    </p>

                    <a href="{{ url('/universities') }}" class="country-link">
                        Explore Universities →
                    </a>

                </div>

            </div>


            <!-- Singapore -->

            <div class="country-card">

                <div class="country-image">
                    🇸🇬
                </div>

                <div class="country-content">

                    <h2>Singapore</h2>

                    <p>
                        Discover internationally connected institutions and
                        study opportunities in one of Asia's major education
                        destinations.
                    </p>

                    <a href="{{ url('/universities') }}" class="country-link">
                        Explore Universities →
                    </a>

                </div>

            </div>


            <!-- USA -->

            <div class="country-card">

                <div class="country-image">
                    🇺🇸
                </div>

                <div class="country-content">

                    <h2>United States</h2>

                    <p>
                        Explore a broad range of academic programs and
                        institutions across the United States.
                    </p>

                    <a href="{{ url('/universities') }}" class="country-link">
                        Explore Universities →
                    </a>

                </div>

            </div>


            <!-- Germany -->

            <div class="country-card">

                <div class="country-image">
                    🇩🇪
                </div>

                <div class="country-content">

                    <h2>Germany</h2>

                    <p>
                        Discover study opportunities across German
                        universities and higher education institutions.
                    </p>

                    <a href="{{ url('/universities') }}" class="country-link">
                        Explore Universities →
                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- INFORMATION -->

    <section class="info-section">

        <div class="info-content">

            <h2>Find the Right Destination</h2>

            <p>
                Choosing the right country is an important part of planning
                your international education. Consider your preferred course,
                university, budget, lifestyle and future career goals before
                making a decision.
            </p>


            <div class="benefits">

                <div class="benefit">

                    <div class="benefit-icon">🎓</div>

                    <h3>Education</h3>

                    <p>
                        Compare education opportunities and study programs.
                    </p>

                </div>


                <div class="benefit">

                    <div class="benefit-icon">💰</div>

                    <h3>Budget</h3>

                    <p>
                        Consider tuition fees and other study-related costs.
                    </p>

                </div>


                <div class="benefit">

                    <div class="benefit-icon">🌏</div>

                    <h3>Lifestyle</h3>

                    <p>
                        Find a destination that matches your preferred
                        lifestyle and environment.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- CTA -->

    <section class="cta">

        <div class="cta-box">

            <h2>Ready to Find Your University?</h2>

            <p>
                Explore universities and discover programs that match
                your academic goals.
            </p>

            <a href="{{ url('/universities') }}" class="cta-button">
                View Universities
            </a>

        </div>

    </section>


    <!-- FOOTER -->

    <footer>

        <div class="footer-content">

            <div class="footer-brand">

                <h3>INDIC RMC</h3>

                <p>
                    Helping students explore international education
                    opportunities and plan their study-abroad journey.
                </p>

            </div>


            <div class="footer-links">

                <a href="{{ url('/') }}">Home</a>

                <a href="{{ url('/about') }}">About</a>

                <a href="{{ url('/universities') }}">Universities</a>

                <a href="{{ url('/contact') }}">Contact</a>

            </div>

        </div>


        <div class="copyright">

            © {{ date('Y') }} INDIC RMC. All rights reserved.

        </div>

    </footer>

</body>
</html>