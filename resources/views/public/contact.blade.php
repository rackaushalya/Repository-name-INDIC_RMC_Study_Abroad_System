<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact | INDIC RMC</title>

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

            padding: 85px 8% 75px;

            overflow: hidden;
        }

        .hero::before {
            content: "";

            position: absolute;

            width: 430px;
            height: 430px;

            border-radius: 50%;

            background: #ddd4ff;

            right: -190px;
            top: -200px;

            opacity: 0.55;
        }

        .hero-content {
            max-width: 1200px;

            margin: auto;

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
            max-width: 850px;

            font-size: 62px;

            line-height: 1.05;

            letter-spacing: -2px;

            margin-bottom: 22px;
        }

        .hero h1 .orange {
            color: #ff6633;
        }

        .hero h1 .purple {
            color: #6654c7;
        }

        .hero p {
            max-width: 720px;

            color: #666879;

            font-size: 18px;

            line-height: 1.8;
        }


        /* =====================================================
           CONTACT MAIN
        ===================================================== */

        .contact-section {
            padding: 20px 8% 90px;
        }

        .contact-container {
            max-width: 1200px;

            margin: auto;

            display: grid;

            grid-template-columns: 0.8fr 1.2fr;

            gap: 30px;
        }


        /* =====================================================
           LEFT INFORMATION
        ===================================================== */

        .contact-info {
            background: #111936;

            color: white;

            border-radius: 30px;

            padding: 40px;

            position: relative;

            overflow: hidden;
        }

        .contact-info::after {
            content: "";

            position: absolute;

            width: 230px;
            height: 230px;

            border-radius: 50%;

            background: #292f57;

            right: -100px;
            bottom: -100px;
        }

        .contact-info h2 {
            font-size: 31px;

            margin-bottom: 15px;

            position: relative;

            z-index: 2;
        }

        .contact-info > p {
            color: #c4c7d3;

            line-height: 1.7;

            margin-bottom: 35px;

            position: relative;

            z-index: 2;
        }

        .info-item {
            display: flex;

            gap: 16px;

            align-items: flex-start;

            margin-bottom: 25px;

            position: relative;

            z-index: 2;
        }

        .info-icon {
            width: 48px;
            height: 48px;

            flex-shrink: 0;

            border-radius: 13px;

            background: rgba(255,255,255,0.10);

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 20px;
        }

        .info-item h3 {
            font-size: 16px;

            margin-bottom: 5px;
        }

        .info-item p {
            color: #b8bcc9;

            font-size: 14px;

            line-height: 1.6;
        }

        .social-row {
            display: flex;

            gap: 10px;

            margin-top: 35px;

            position: relative;

            z-index: 2;
        }

        .social {
            width: 40px;
            height: 40px;

            border-radius: 50%;

            background: rgba(255,255,255,0.10);

            color: white;

            display: flex;

            align-items: center;
            justify-content: center;

            text-decoration: none;

            font-size: 14px;
        }

        .social:hover {
            background: #ff6633;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .contact-form {
            background: white;

            border-radius: 30px;

            padding: 42px;

            box-shadow:
                0 15px 45px
                rgba(45,35,90,0.08);

            border: 1px solid #ebe6f7;
        }

        .form-heading {
            margin-bottom: 30px;
        }

        .form-heading h2 {
            font-size: 31px;

            margin-bottom: 8px;
        }

        .form-heading p {
            color: #707282;

            line-height: 1.6;

            font-size: 14px;
        }

        .form-row {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 18px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;

            font-size: 13px;

            font-weight: 700;

            margin-bottom: 8px;

            color: #252943;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;

            border: 1px solid #dedbea;

            background: #faf9ff;

            border-radius: 11px;

            padding: 14px 15px;

            font-family: inherit;

            font-size: 14px;

            color: #20243c;

            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #ff6633;

            box-shadow:
                0 0 0 3px
                rgba(255,102,51,0.08);
        }

        .form-group textarea {
            min-height: 130px;

            resize: vertical;
        }

        .submit-button {
            width: 100%;

            border: none;

            background: #ff6633;

            color: white;

            padding: 16px;

            border-radius: 12px;

            font-size: 15px;

            font-weight: 800;

            cursor: pointer;
        }

        .submit-button:hover {
            background: #f25525;
        }


        /* =====================================================
           CONTACT CARDS
        ===================================================== */

        .details-section {
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

        .details-grid {
            max-width: 1150px;

            margin: auto;

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 25px;
        }

        .detail-card {
            padding: 32px;

            border-radius: 22px;

            background: #f7f4ff;

            border: 1px solid #ebe6f7;

            transition: 0.3s;
        }

        .detail-card:hover {
            transform: translateY(-6px);

            box-shadow:
                0 18px 35px
                rgba(45,35,90,0.10);
        }

        .detail-card-icon {
            width: 58px;
            height: 58px;

            border-radius: 16px;

            background: white;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 25px;

            margin-bottom: 20px;
        }

        .detail-card h3 {
            font-size: 21px;

            margin-bottom: 10px;
        }

        .detail-card p {
            color: #707282;

            font-size: 14px;

            line-height: 1.7;
        }


        /* =====================================================
           CONSULTATION CTA
        ===================================================== */

        .cta-section {
            padding: 85px 8%;

            background: #f7f4ff;

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

            .contact-container {
                grid-template-columns: 1fr;
            }

            .details-grid {
                grid-template-columns: 1fr 1fr;
            }
        }


        @media (max-width: 650px) {

            .hero h1 {
                font-size: 43px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .contact-form,
            .contact-info {
                padding: 30px;
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

            <div class="hero-label">

                <span class="orange-dot"></span>

                Let's Start Your Journey

            </div>


            <h1>

                Have questions?

                <span class="orange">
                    Let's talk.
                </span>

                <span class="purple">
                    .
                </span>

            </h1>


            <p>
                Whether you need help choosing a destination, finding
                a university, selecting a course or understanding your
                study-abroad options, our team is here to help.
            </p>

        </div>

    </section>


    <!-- =====================================================
         CONTACT SECTION
    ===================================================== -->

    <section class="contact-section">

        <div class="contact-container">


            <!-- LEFT -->

            <div class="contact-info">

                <h2>
                    Get in touch
                </h2>

                <p>
                    Start a conversation with INDIC RMC and take the
                    next step toward your international education journey.
                </p>


                <div class="info-item">

                    <div class="info-icon">
                        📍
                    </div>

                    <div>

                        <h3>
                            Our Office
                        </h3>

                        <p>
                            Sri Lanka
                        </p>

                    </div>

                </div>


                <div class="info-item">

                    <div class="info-icon">
                        📞
                    </div>

                    <div>

                        <h3>
                            Phone
                        </h3>

                        <p>
                            Contact our education consultants
                            for more information.
                        </p>

                    </div>

                </div>


                <div class="info-item">

                    <div class="info-icon">
                        ✉️
                    </div>

                    <div>

                        <h3>
                            Email
                        </h3>

                        <p>
                            Send us your study-abroad questions
                            and we'll help you explore your options.
                        </p>

                    </div>

                </div>


                <div class="info-item">

                    <div class="info-icon">
                        🕒
                    </div>

                    <div>

                        <h3>
                            Consultation
                        </h3>

                        <p>
                            Speak with a consultant about your
                            education plans.
                        </p>

                    </div>

                </div>


                <div class="social-row">

                    <a href="#" class="social">
                        f
                    </a>

                    <a href="#" class="social">
                        in
                    </a>

                    <a href="#" class="social">
                        ig
                    </a>

                </div>

            </div>


            <!-- FORM -->

            <div class="contact-form">

                <div class="form-heading">

                    <h2>
                        Send us a message
                    </h2>

                    <p>
                        Tell us a little about what you're looking for
                        and our team can follow up with you.
                    </p>

                </div>


                <form>


                    <div class="form-row">

                        <div class="form-group">

                            <label>
                                First Name
                            </label>

                            <input
                                type="text"
                                placeholder="Your first name"
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                Last Name
                            </label>

                            <input
                                type="text"
                                placeholder="Your last name"
                            >

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>
                                Email Address
                            </label>

                            <input
                                type="email"
                                placeholder="you@example.com"
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                Phone Number
                            </label>

                            <input
                                type="tel"
                                placeholder="+94 XX XXX XXXX"
                            >

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>
                                Preferred Destination
                            </label>

                            <select>

                                <option>
                                    Select a destination
                                </option>

                                <option>
                                    Australia
                                </option>

                                <option>
                                    United Kingdom
                                </option>

                                <option>
                                    Canada
                                </option>

                                <option>
                                    New Zealand
                                </option>

                                <option>
                                    United States
                                </option>

                                <option>
                                    France
                                </option>

                                <option>
                                    Finland
                                </option>

                                <option>
                                    Singapore
                                </option>

                            </select>

                        </div>


                        <div class="form-group">

                            <label>
                                Area of Interest
                            </label>

                            <select>

                                <option>
                                    Select a field
                                </option>

                                <option>
                                    Computing & IT
                                </option>

                                <option>
                                    Business
                                </option>

                                <option>
                                    Engineering
                                </option>

                                <option>
                                    Health & Medicine
                                </option>

                                <option>
                                    Arts & Design
                                </option>

                                <option>
                                    Hospitality & Tourism
                                </option>

                            </select>

                        </div>

                    </div>


                    <div class="form-group">

                        <label>
                            Your Message
                        </label>

                        <textarea
                            placeholder="Tell us about your study plans..."
                        ></textarea>

                    </div>


                    <button
                        type="button"
                        class="submit-button"
                    >
                        Send Message →
                    </button>

                </form>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CONTACT DETAILS
    ===================================================== -->

    <section class="details-section">

        <div class="section-heading">

            <h2>
                How can we help?
            </h2>

            <p>
                Our platform is designed to support students through
                different stages of their international education journey.
            </p>

        </div>


        <div class="details-grid">


            <div class="detail-card">

                <div class="detail-card-icon">
                    🌍
                </div>

                <h3>
                    Choose a Destination
                </h3>

                <p>
                    Explore countries and compare study opportunities
                    based on your academic and career goals.
                </p>

            </div>


            <div class="detail-card">

                <div class="detail-card-icon">
                    🎓
                </div>

                <h3>
                    Find a University
                </h3>

                <p>
                    Explore universities and discover institutions
                    that offer programs relevant to your interests.
                </p>

            </div>


            <div class="detail-card">

                <div class="detail-card-icon">
                    📚
                </div>

                <h3>
                    Select a Course
                </h3>

                <p>
                    Explore different study fields and identify
                    potential academic pathways for your future.
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
                Your Future Starts With One Conversation
            </h2>

            <p>
                Not sure where to begin? Tell us what you want to study,
                where you want to go and what your goals are.
            </p>

            <a
                href="#"
                class="cta-button"
            >
                Start Your Journey →
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

                <a href="{{ url('/scholarships') }}">
                    Scholarships
                </a>

            </div>

        </div>


        <div class="copyright">

            © {{ date('Y') }} INDIC RMC. All rights reserved.

        </div>

    </footer>


</body>
</html>