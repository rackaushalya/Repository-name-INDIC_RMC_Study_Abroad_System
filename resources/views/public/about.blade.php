<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About Us | INDIC RMC</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f4ff;
            color: #111827;
        }

        /* =========================
           NAVBAR
        ========================== */

        .navbar {
            width: 100%;
            height: 100px;
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
            letter-spacing: -1px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 35px;
        }

        .nav-links a {
            text-decoration: none;
            color: #151515;
            font-size: 17px;
            font-weight: 600;
            transition: 0.3s;
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

        .nav-button:hover {
            background: #e95425;
        }

        /* =========================
           HERO
        ========================== */

        .about-hero {
            min-height: 430px;
            padding: 80px 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
        }

        .hero-content {
            max-width: 650px;
        }

        .small-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 12px 20px;
            border-radius: 30px;
            color: #5543a5;
            font-weight: 700;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(70, 50, 120, 0.08);
        }

        .orange-dot {
            width: 12px;
            height: 12px;
            background: #ff6633;
            border-radius: 50%;
        }

        .hero-content h1 {
            font-size: 58px;
            line-height: 1.05;
            color: #111936;
            margin-bottom: 25px;
        }

        .hero-content h1 span {
            color: #ff6633;
        }

        .hero-content p {
            font-size: 18px;
            line-height: 1.8;
            color: #626477;
            max-width: 600px;
        }

        .hero-card {
            width: 360px;
            min-height: 300px;
            background: linear-gradient(145deg, #ff6633, #ff8a55);
            border-radius: 35px;
            padding: 40px;
            color: white;
            box-shadow: 0 25px 50px rgba(255, 102, 51, 0.20);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero-card h2 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .hero-card p {
            line-height: 1.7;
            font-size: 16px;
        }

        /* =========================
           ABOUT SECTION
        ========================== */

        .about-section {
            padding: 80px 8%;
            background: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 55px;
        }

        .section-title h2 {
            font-size: 40px;
            color: #111936;
            margin-bottom: 15px;
        }

        .section-title p {
            color: #6b6d7c;
            max-width: 650px;
            margin: auto;
            line-height: 1.7;
        }

        .about-grid {
            max-width: 1150px;
            margin: auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 35px;
        }

        .about-card {
            padding: 35px;
            border-radius: 25px;
            background: #f7f4ff;
            border: 1px solid #ebe6f7;
        }

        .about-card h3 {
            font-size: 25px;
            margin-bottom: 15px;
            color: #111936;
        }

        .about-card p {
            color: #666879;
            line-height: 1.8;
        }

        /* =========================
           SERVICES
        ========================== */

        .services-section {
            padding: 85px 8%;
            background: #f7f4ff;
        }

        .services-grid {
            max-width: 1150px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .service-card {
            background: white;
            padding: 32px;
            border-radius: 25px;
            border: 1px solid #ebe6f7;
            transition: 0.3s;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(45, 35, 90, 0.10);
        }

        .service-icon {
            width: 55px;
            height: 55px;
            border-radius: 16px;
            background: #fff0e9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ff6633;
            font-size: 25px;
            margin-bottom: 20px;
        }

        .service-card h3 {
            color: #111936;
            margin-bottom: 12px;
            font-size: 20px;
        }

        .service-card p {
            color: #707181;
            line-height: 1.7;
            font-size: 15px;
        }

        /* =========================
           WHY CHOOSE US
        ========================== */

        .why-section {
            padding: 85px 8%;
            background: white;
        }

        .why-grid {
            max-width: 1100px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .why-item {
            display: flex;
            gap: 18px;
            padding: 25px;
            background: #f7f4ff;
            border-radius: 20px;
        }

        .check {
            min-width: 38px;
            height: 38px;
            background: #ff6633;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .why-item h3 {
            color: #111936;
            margin-bottom: 8px;
        }

        .why-item p {
            color: #6d6f7d;
            line-height: 1.6;
        }

        /* =========================
           MISSION / VISION
        ========================== */

        .mission-section {
            padding: 80px 8%;
            background: #111936;
            color: white;
        }

        .mission-grid {
            max-width: 1100px;
            margin: auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .mission-card {
            padding: 40px;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255,255,255,0.12);
        }

        .mission-card h3 {
            color: #ff8055;
            font-size: 27px;
            margin-bottom: 15px;
        }

        .mission-card p {
            color: #d5d7e0;
            line-height: 1.8;
        }

        /* =========================
           CTA
        ========================== */

        .cta-section {
            padding: 75px 8%;
            background: #f7f4ff;
            text-align: center;
        }

        .cta-box {
            max-width: 900px;
            margin: auto;
            padding: 55px 35px;
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
            gap: 30px;
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

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 900px) {

            .navbar {
                padding: 0 25px;
            }

            .nav-links {
                gap: 15px;
            }

            .nav-links a {
                font-size: 14px;
            }

            .about-hero {
                flex-direction: column;
                text-align: center;
            }

            .hero-content p {
                margin: auto;
            }

            .services-grid {
                grid-template-columns: 1fr 1fr;
            }

            .about-grid,
            .why-grid,
            .mission-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {

            .navbar {
                height: auto;
                padding: 20px;
                flex-direction: column;
                gap: 20px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .brand-name {
                font-size: 25px;
            }

            .hero-content h1 {
                font-size: 42px;
            }

            .hero-card {
                width: 100%;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .section-title h2 {
                font-size: 32px;
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


    <!-- =========================
         HERO
    ========================== -->

    <section class="about-hero">

        <div class="hero-content">

            <div class="small-label">
                <span class="orange-dot"></span>
                About INDIC RMC
            </div>

            <h1>
                Your trusted partner for
                <span>global education.</span>
            </h1>

            <p>
                INDIC RMC helps students turn their international education
                goals into reality by providing guidance throughout their
                study-abroad journey.
            </p>

        </div>


        <div class="hero-card">

            <h2>Study Abroad With Confidence</h2>

            <p>
                From choosing the right destination and university to
                preparing applications, our platform helps students make
                informed decisions about their future.
            </p>

        </div>

    </section>


    <!-- =========================
         ABOUT
    ========================== -->

    <section class="about-section">

        <div class="section-title">

            <h2>Who We Are</h2>

            <p>
                INDIC RMC is a study-abroad consultancy platform designed
                to connect students with suitable international education
                opportunities.
            </p>

        </div>


        <div class="about-grid">

            <div class="about-card">

                <h3>Our Purpose</h3>

                <p>
                    We aim to simplify the study-abroad process by bringing
                    important information about countries, universities,
                    courses, scholarships and applications together in one
                    place.
                </p>

            </div>


            <div class="about-card">

                <h3>Our Approach</h3>

                <p>
                    We focus on understanding each student's academic
                    background, interests and preferences so that suitable
                    study opportunities can be identified.
                </p>

            </div>

        </div>

    </section>


    <!-- =========================
         SERVICES
    ========================== -->

    <section class="services-section">

        <div class="section-title">

            <h2>What We Do</h2>

            <p>
                Our services support students throughout the major stages
                of their international education journey.
            </p>

        </div>


        <div class="services-grid">

            <div class="service-card">

                <div class="service-icon">🌍</div>

                <h3>Study Destinations</h3>

                <p>
                    Explore international destinations and compare
                    opportunities available for students.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">🎓</div>

                <h3>University Selection</h3>

                <p>
                    Find universities that match your academic goals,
                    preferred destination and study requirements.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">📚</div>

                <h3>Course Guidance</h3>

                <p>
                    Discover courses and study programs that align with
                    your qualifications and career interests.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">💰</div>

                <h3>Scholarship Guidance</h3>

                <p>
                    Explore scholarship opportunities that can help reduce
                    the financial burden of studying abroad.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">📝</div>

                <h3>Application Support</h3>

                <p>
                    Receive guidance through the application process and
                    prepare the information required for applications.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">🤝</div>

                <h3>Student Support</h3>

                <p>
                    Get assistance and guidance throughout the different
                    stages of your study-abroad journey.
                </p>

            </div>

        </div>

    </section>


    <!-- =========================
         WHY CHOOSE US
    ========================== -->

    <section class="why-section">

        <div class="section-title">

            <h2>Why Choose INDIC RMC?</h2>

            <p>
                We aim to make the study-abroad planning process simpler,
                clearer and more convenient for students.
            </p>

        </div>


        <div class="why-grid">

            <div class="why-item">

                <div class="check">✓</div>

                <div>
                    <h3>Personalized Guidance</h3>

                    <p>
                        Recommendations can be based on individual student
                        qualifications and preferences.
                    </p>
                </div>

            </div>


            <div class="why-item">

                <div class="check">✓</div>

                <div>
                    <h3>Multiple Destinations</h3>

                    <p>
                        Students can explore education opportunities across
                        different countries.
                    </p>
                </div>

            </div>


            <div class="why-item">

                <div class="check">✓</div>

                <div>
                    <h3>Clear Information</h3>

                    <p>
                        Important information about courses, universities
                        and scholarships can be accessed more conveniently.
                    </p>
                </div>

            </div>


            <div class="why-item">

                <div class="check">✓</div>

                <div>
                    <h3>Student-Focused Service</h3>

                    <p>
                        The platform is designed around the needs of students
                        planning their international education.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <!-- =========================
         MISSION & VISION
    ========================== -->

    <section class="mission-section">

        <div class="section-title">

            <h2 style="color:white;">Our Mission & Vision</h2>

            <p style="color:#c9cbd5;">
                Building a better and more accessible study-abroad
                experience for students.
            </p>

        </div>


        <div class="mission-grid">

            <div class="mission-card">

                <h3>Our Mission</h3>

                <p>
                    To provide students with reliable guidance and convenient
                    access to information that helps them make confident
                    decisions about international education.
                </p>

            </div>


            <div class="mission-card">

                <h3>Our Vision</h3>

                <p>
                    To become a trusted platform for students seeking
                    international education opportunities and professional
                    guidance.
                </p>

            </div>

        </div>

    </section>


    <!-- =========================
         CTA
    ========================== -->

    <section class="cta-section">

        <div class="cta-box">

            <h2>Ready to Start Your Journey?</h2>

            <p>
                Explore destinations, universities, courses and scholarship
                opportunities and take the next step toward your international
                education.
            </p>

            <a href="{{ url('/countries') }}" class="cta-button">
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

                <h3>INDIC RMC</h3>

                <p>
                    Supporting students in finding suitable international
                    education opportunities and planning their study-abroad
                    journey.
                </p>

            </div>


            <div class="footer-links">

                <a href="{{ url('/') }}">Home</a>

                <a href="{{ url('/about') }}">About</a>

                <a href="{{ url('/countries') }}">Destinations</a>

                <a href="{{ url('/contact') }}">Contact</a>

            </div>

        </div>


        <div class="copyright">

            © {{ date('Y') }} INDIC RMC. All rights reserved.

        </div>

    </footer>

</body>
</html>