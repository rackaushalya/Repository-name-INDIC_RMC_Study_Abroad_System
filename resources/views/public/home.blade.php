<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC | Study Abroad Consultancy</title>

    <meta name="description"
          content="INDIC RMC helps students discover international study opportunities, universities, courses and scholarships.">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #111827;
            background: #ffffff;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        .container {
            width: min(1180px, 92%);
            margin: 0 auto;
        }

        /* =========================================================
           NAVBAR
        ========================================================= */

        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 24px 0;
        }

        .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 23px;
            font-weight: 800;
            color: #111827;
            letter-spacing: -0.7px;
            white-space: nowrap;
        }

        .logo-mark {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #f7f5f5;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.25);
        }

        .logo-mark img {
            width: 34px;
            height: 34px;
            object-fit: contain;
            display: block;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links a {
            font-size: 14px;
            font-weight: 600;
            color: #30323b;
            transition: 0.25s ease;
        }

        .nav-links a:hover {
            color: #ff6b35;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .login-btn {
            font-size: 14px;
            font-weight: 700;
            padding: 11px 18px;
            color: #252630;
            transition: 0.25s ease;
        }

        .login-btn:hover {
            color: #ff6b35;
        }

        .register-btn {
            padding: 12px 21px;
            border-radius: 11px;
            background: #111827;
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            transition: 0.25s ease;
            box-shadow: 0 8px 20px rgba(17, 24, 39, 0.16);
        }

        .register-btn:hover {
            background: #ff6b35;
            transform: translateY(-2px);
        }

        .mobile-menu {
            display: none;
            border: none;
            background: #ffffff;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            font-size: 22px;
            cursor: pointer;
        }


        /* =========================================================
           HERO
        ========================================================= */

        .hero {
            min-height: 760px;
            padding: 155px 0 80px;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 85% 20%, rgba(255, 107, 53, 0.15), transparent 28%),
                radial-gradient(circle at 8% 80%, rgba(124, 92, 255, 0.14), transparent 30%),
                linear-gradient(135deg, #f3efff 0%, #eee9ff 50%, #f8f6ff 100%);
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.42);
            top: -240px;
            right: -150px;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 330px;
            height: 330px;
            border-radius: 50%;
            background: rgba(255, 107, 53, 0.06);
            bottom: -170px;
            left: -100px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1.02fr 0.98fr;
            align-items: center;
            gap: 55px;
        }

        .hero-left {
            max-width: 620px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.95);
            padding: 8px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 800;
            color: #5546a6;
            margin-bottom: 22px;
            box-shadow: 0 8px 25px rgba(74, 60, 140, 0.06);
        }

        .eyebrow-dot {
            width: 8px;
            height: 8px;
            background: #ff6b35;
            border-radius: 50%;
        }

        .hero-title {
            font-size: clamp(46px, 5.5vw, 76px);
            line-height: 1.03;
            letter-spacing: -3.5px;
            font-weight: 850;
            color: #151722;
            margin-bottom: 24px;
        }

        .hero-title .orange {
            color: #ff6b35;
        }

        .hero-title .purple {
            color: #6956c9;
        }

        .hero-description {
            max-width: 550px;
            color: #5f6370;
            font-size: 17px;
            line-height: 1.75;
            margin-bottom: 32px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
            margin-bottom: 35px;
        }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 15px 23px;
            background: #ff6b35;
            color: #ffffff;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 800;
            box-shadow: 0 12px 28px rgba(255, 107, 53, 0.25);
            transition: 0.25s ease;
        }

        .primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 30px rgba(255, 107, 53, 0.32);
        }

        .secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 14px 22px;
            background: #ffffff;
            color: #20222c;
            border: 1px solid #e5e1f5;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 800;
            transition: 0.25s ease;
        }

        .secondary-btn:hover {
            transform: translateY(-3px);
            border-color: #cfc8f2;
            box-shadow: 0 12px 25px rgba(50, 45, 90, 0.08);
        }

        .hero-proof {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .avatar-group {
            display: flex;
            align-items: center;
        }

        .avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 3px solid #f0ecff;
            margin-left: -8px;
            object-fit: cover;
        }

        .avatar:first-child {
            margin-left: 0;
        }

        .proof-text {
            font-size: 12px;
            color: #686b76;
        }

        .proof-text strong {
            display: block;
            color: #22242d;
            font-size: 13px;
            margin-bottom: 1px;
        }


        /* =========================================================
           HERO VISUAL
        ========================================================= */

        .hero-right {
            position: relative;
            min-height: 480px;
        }

        .hero-card-main {
            position: absolute;
            width: 82%;
            height: 440px;
            right: 0;
            top: 5px;
            border-radius: 35px;
            overflow: hidden;
            background:
                linear-gradient(
                    180deg,
                    rgba(18, 22, 40, 0.02),
                    rgba(18, 22, 40, 0.15)
                ),
                url("https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1000&q=85")
                center/cover no-repeat;
            box-shadow: 0 35px 70px rgba(50, 44, 100, 0.18);
            transform: rotate(2deg);
        }

        .hero-card-main::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(25, 22, 45, 0.02) 45%,
                rgba(25, 22, 45, 0.48) 100%
            );
        }

        .hero-image-label {
            position: absolute;
            z-index: 3;
            bottom: 25px;
            left: 25px;
            right: 25px;
            padding: 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            transform: rotate(-2deg);
        }

        .hero-image-label small {
            display: block;
            color: #777a84;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .hero-image-label strong {
            color: #171923;
            font-size: 18px;
        }

        .floating-card {
            position: absolute;
            z-index: 5;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 20px 45px rgba(38, 34, 75, 0.16);
        }

        .destination-card {
            left: -5px;
            top: 45px;
            width: 175px;
            padding: 15px;
        }

        .destination-card-icon {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: #fff0e9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 19px;
        }

        .destination-card small {
            color: #7a7d87;
            font-size: 10px;
            font-weight: 700;
        }

        .destination-card strong {
            display: block;
            color: #20222c;
            font-size: 14px;
            margin-top: 2px;
        }

        .success-card {
            right: -10px;
            bottom: 42px;
            padding: 16px 18px;
            width: 190px;
        }

        .success-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 9px;
        }

        .success-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #f0edff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .success-card small {
            color: #7c7f89;
            font-size: 10px;
        }

        .success-card strong {
            display: block;
            font-size: 21px;
            color: #181a23;
        }

        .stars {
            color: #ff9c35;
            font-size: 11px;
        }


        /* =========================================================
           QUICK STATS
        ========================================================= */

        .stats-strip {
            position: relative;
            z-index: 10;
            margin-top: -35px;
        }

        .stats-box {
            background: #111827;
            color: #ffffff;
            border-radius: 22px;
            padding: 28px 35px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.18);
        }

        .stat {
            text-align: center;
            padding: 7px 15px;
            border-right: 1px solid rgba(255, 255, 255, 0.12);
        }

        .stat:last-child {
            border-right: none;
        }

        .stat strong {
            display: block;
            font-size: 28px;
            line-height: 1.2;
            margin-bottom: 4px;
            color: #ffffff;
        }

        .stat span {
            font-size: 12px;
            color: #aeb4c2;
        }


        /* =========================================================
           SECTION COMMON
        ========================================================= */

        .section {
            padding: 100px 0;
        }

        .section-heading {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 55px;
        }

        .section-tag {
            display: inline-block;
            color: #ff6b35;
            font-size: 12px;
            font-weight: 850;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: clamp(32px, 4vw, 48px);
            line-height: 1.1;
            letter-spacing: -1.8px;
            color: #151722;
            margin-bottom: 15px;
        }

        .section-description {
            color: #70737e;
            font-size: 15px;
            line-height: 1.75;
        }


        /* =========================================================
           WHY SECTION
        ========================================================= */

        .why-section {
            background: #ffffff;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .feature-card {
            padding: 30px;
            border: 1px solid #eeeef3;
            border-radius: 22px;
            background: #ffffff;
            transition: 0.25s ease;
        }

        .feature-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 20px 40px rgba(32, 31, 50, 0.08);
            border-color: #e2dcff;
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: #f0edff;
            color: #6956c9;
            font-size: 22px;
            margin-bottom: 22px;
        }

        .feature-card:nth-child(2) .feature-icon {
            background: #fff0e9;
            color: #ff6b35;
        }

        .feature-card:nth-child(3) .feature-icon {
            background: #edf8f4;
            color: #2b9a74;
        }

        .feature-card h3 {
            font-size: 19px;
            margin-bottom: 9px;
            color: #191b25;
        }

        .feature-card p {
            color: #777a84;
            font-size: 13px;
            line-height: 1.75;
        }


        /* =========================================================
           HOW IT WORKS
        ========================================================= */

        .process-section {
            background: #f8f7fc;
        }

        .process-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .process-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 25px;
            border: 1px solid #ededf3;
            position: relative;
        }

        .process-number {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #111827;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .process-card h3 {
            font-size: 17px;
            margin-bottom: 8px;
        }

        .process-card p {
            font-size: 12px;
            color: #777a84;
            line-height: 1.7;
        }


        /* =========================================================
           DESTINATIONS
        ========================================================= */

        .destination-section {
            background: #ffffff;
        }

        .destination-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .country-card {
            height: 340px;
            border-radius: 25px;
            overflow: hidden;
            position: relative;
            background-size: cover;
            background-position: center;
            box-shadow: 0 15px 35px rgba(20, 20, 40, 0.08);
        }

        .country-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(0, 0, 0, 0.02) 35%,
                rgba(0, 0, 0, 0.7) 100%
            );
        }

        .country-card-content {
            position: absolute;
            z-index: 2;
            bottom: 22px;
            left: 22px;
            right: 22px;
            color: #ffffff;
        }

        .country-card-content span {
            font-size: 11px;
            opacity: 0.8;
        }

        .country-card-content h3 {
            font-size: 25px;
            margin-top: 3px;
        }

        .country-card-content a {
            display: inline-block;
            margin-top: 10px;
            font-size: 11px;
            font-weight: 800;
            color: #ffffff;
            border-bottom: 1px solid rgba(255,255,255,0.7);
        }

        .country-australia {
            background-image: url("https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?auto=format&fit=crop&w=900&q=80");
        }

        .country-uk {
            background-image: url("https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?auto=format&fit=crop&w=900&q=80");
        }

        .country-canada {
            background-image: url("https://images.unsplash.com/photo-1517935706615-2717063c2225?auto=format&fit=crop&w=900&q=80");
        }

        .country-newzealand {
            background-image: url("https://images.unsplash.com/photo-1469521669194-babb45599def?auto=format&fit=crop&w=900&q=80");
        }

        .country-usa {
            background-image: url("https://images.unsplash.com/photo-1485738422979-f5c462d49f74?auto=format&fit=crop&w=900&q=80");
        }

        .country-france {
            background-image: url("https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=900&q=80");
        }


        /* =========================================================
           CTA
        ========================================================= */

        .cta-section {
            padding: 35px 0 100px;
        }

        .cta-box {
            background:
                radial-gradient(circle at 90% 10%, rgba(255, 107, 53, 0.25), transparent 30%),
                linear-gradient(135deg, #171a27, #292345);
            border-radius: 28px;
            padding: 65px;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            overflow: hidden;
        }

        .cta-box h2 {
            font-size: clamp(30px, 4vw, 45px);
            line-height: 1.1;
            letter-spacing: -1.5px;
            margin-bottom: 12px;
        }

        .cta-box p {
            max-width: 580px;
            color: #b9bbc7;
            font-size: 14px;
        }

        .cta-button {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: #ff6b35;
            color: #ffffff;
            padding: 15px 23px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            transition: 0.25s ease;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            background: #ff7948;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {
            background: #0f1118;
            color: #ffffff;
            padding: 65px 0 25px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 45px;
            padding-bottom: 50px;
        }

        .footer-brand p {
            color: #8e929e;
            font-size: 13px;
            line-height: 1.8;
            max-width: 320px;
            margin-top: 18px;
        }

        .footer-logo {
            color: #ffffff;
        }

        .footer-column h4 {
            font-size: 13px;
            margin-bottom: 18px;
        }

        .footer-column a {
            display: block;
            color: #8e929e;
            font-size: 12px;
            margin-bottom: 11px;
            transition: 0.2s ease;
        }

        .footer-column a:hover {
            color: #ff6b35;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding-top: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            color: #777b87;
            font-size: 11px;
        }

        .footer-socials {
            display: flex;
            gap: 8px;
        }

        .social {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a6a9b3;
            font-size: 11px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1050px) {

            .nav-links {
                gap: 18px;
            }

            .hero-content {
                grid-template-columns: 1fr;
            }

            .hero-left {
                max-width: 750px;
                text-align: center;
                margin: 0 auto;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons,
            .hero-proof {
                justify-content: center;
            }

            .hero-right {
                width: min(650px, 100%);
                margin: 0 auto;
            }

            .why-grid {
                grid-template-columns: 1fr 1fr;
            }

            .process-grid {
                grid-template-columns: 1fr 1fr;
            }

            .destination-grid {
                grid-template-columns: 1fr 1fr;
            }

            .footer-grid {
                grid-template-columns: 1.5fr 1fr 1fr;
            }
        }

        @media (max-width: 800px) {

            .navbar {
                padding: 18px 0;
            }

            .nav-links,
            .nav-actions {
                display: none;
            }

            .mobile-menu {
                display: block;
            }

            .hero {
                padding-top: 120px;
            }

            .hero-title {
                letter-spacing: -2px;
            }

            .hero-right {
                min-height: 420px;
            }

            .hero-card-main {
                width: 86%;
                height: 390px;
            }

            .stats-box {
                grid-template-columns: 1fr 1fr;
                gap: 20px 0;
            }

            .stat:nth-child(2) {
                border-right: none;
            }

            .stat:nth-child(1),
            .stat:nth-child(2) {
                border-bottom: 1px solid rgba(255,255,255,0.12);
                padding-bottom: 18px;
            }

            .stat:nth-child(3),
            .stat:nth-child(4) {
                padding-top: 18px;
            }

            .why-grid,
            .destination-grid {
                grid-template-columns: 1fr;
            }

            .process-grid {
                grid-template-columns: 1fr 1fr;
            }

            .cta-box {
                padding: 45px 30px;
                flex-direction: column;
                align-items: flex-start;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 560px) {

            .logo {
                font-size: 19px;
            }

            .logo-mark {
                width: 35px;
                height: 35px;
            }

            .hero {
                min-height: auto;
                padding-bottom: 65px;
            }

            .hero-title {
                font-size: 43px;
            }

            .hero-description {
                font-size: 14px;
            }

            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }

            .primary-btn,
            .secondary-btn {
                width: 100%;
            }

            .hero-right {
                min-height: 350px;
            }

            .hero-card-main {
                height: 320px;
                width: 90%;
            }

            .destination-card {
                left: -5px;
                top: 25px;
                width: 145px;
            }

            .success-card {
                right: -5px;
                bottom: 20px;
                width: 155px;
            }

            .stats-strip {
                margin-top: -15px;
            }

            .stats-box {
                padding: 22px 10px;
            }

            .stat strong {
                font-size: 22px;
            }

            .stat span {
                font-size: 10px;
            }

            .section {
                padding: 70px 0;
            }

            .process-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>


<!-- ============================================================
     NAVBAR
============================================================= -->

<header class="navbar">

    <div class="container navbar-inner">

        <a href="{{ route('home') }}" class="logo">

            <span class="logo-mark">
                <img src="{{ asset('images/indic-rmc-mark.png') }}" alt="INDIC RMC logo">
            </span>

            <span>INDIC RMC</span>

        </a>


        <nav class="nav-links">

            <a href="{{ route('home') }}">Home</a>

            <a href="{{ route('about') }}">About</a>

            <a href="{{ route('countries') }}">Destinations</a>

            <a href="{{ route('universities') }}">Universities</a>

            <a href="{{ route('courses') }}">Courses</a>

            <a href="{{ route('scholarships') }}">Scholarships</a>

            <a href="{{ route('contact') }}">Contact</a>

        </nav>


        <div class="nav-actions">

            <a href="{{ route('login') }}" class="login-btn">
                Login
            </a>

            <a href="{{ route('register') }}" class="register-btn">
                Register
            </a>

        </div>


        <button class="mobile-menu" type="button">
            ☰
        </button>

    </div>

</header>



<!-- ============================================================
     HERO
============================================================= -->

<section class="hero">

    <div class="container hero-content">


        <!-- LEFT SIDE -->

        <div class="hero-left">

            <div class="eyebrow">

                <span class="eyebrow-dot"></span>

                Your journey to global education starts here

            </div>


            <h1 class="hero-title">

                Your Future

                <br>

                <span class="orange">Starts</span>

                <span>Beyond</span>

                <br>

                <span class="purple">Borders.</span>

            </h1>


            <p class="hero-description">

                Discover the right country, university and course
                for your future. INDIC RMC guides students through
                every step of their international education journey.

            </p>


            <div class="hero-buttons">

                <a href="{{ route('countries') }}" class="primary-btn">

                    Explore Destinations

                    <span>→</span>

                </a>


                <a href="{{ route('how.it.works') }}" class="secondary-btn">

                    How It Works

                    <span>↗</span>

                </a>

            </div>


            <div class="hero-proof">

                <div class="avatar-group">

                    <img
                        class="avatar"
                        src="https://i.pravatar.cc/80?img=12"
                        alt="Student"
                    >

                    <img
                        class="avatar"
                        src="https://i.pravatar.cc/80?img=32"
                        alt="Student"
                    >

                    <img
                        class="avatar"
                        src="https://i.pravatar.cc/80?img=47"
                        alt="Student"
                    >

                    <img
                        class="avatar"
                        src="https://i.pravatar.cc/80?img=49"
                        alt="Student"
                    >

                </div>


                <div class="proof-text">

                    <strong>Students planning their future</strong>

                    Guided by experienced education consultants

                </div>

            </div>

        </div>



        <!-- RIGHT SIDE -->

        <div class="hero-right">


            <div class="hero-card-main">

                <div class="hero-image-label">

                    <small>START YOUR JOURNEY</small>

                    <strong>
                        Study. Explore. Succeed.
                    </strong>

                </div>

            </div>


            <!-- Floating destination card -->

            <div class="floating-card destination-card">

                <div class="destination-card-icon">
                    ✈
                </div>

                <small>POPULAR DESTINATION</small>

                <strong>Australia</strong>

            </div>


            <!-- Floating success card -->

            <div class="floating-card success-card">

                <div class="success-top">

                    <div class="success-icon">
                        🎓
                    </div>

                    <span class="stars">
                        ★★★★★
                    </span>

                </div>

                <small>STUDENT EXPERIENCE</small>

                <strong>Global Opportunities</strong>

            </div>

        </div>

    </div>

</section>



<!-- ============================================================
     STATS
============================================================= -->

<section class="stats-strip">

    <div class="container">

        <div class="stats-box">

            <div class="stat">

                <strong>10+</strong>

                <span>Study Destinations</span>

            </div>


            <div class="stat">

                <strong>100+</strong>

                <span>University Opportunities</span>

            </div>


            <div class="stat">

                <strong>500+</strong>

                <span>Students Guided</span>

            </div>


            <div class="stat">

                <strong>10+</strong>

                <span>Years of Experience</span>

            </div>

        </div>

    </div>

</section>



<!-- ============================================================
     WHY INDIC RMC
============================================================= -->

<section class="section why-section">

    <div class="container">


        <div class="section-heading">

            <span class="section-tag">
                WHY INDIC RMC
            </span>

            <h2 class="section-title">
                More than consultancy.
                <br>
                We're your study partner.
            </h2>

            <p class="section-description">

                From choosing your destination to preparing
                your application, our goal is to make your
                international education journey simpler.

            </p>

        </div>


        <div class="why-grid">


            <div class="feature-card">

                <div class="feature-icon">
                    🎯
                </div>

                <h3>
                    Personalised Guidance
                </h3>

                <p>

                    Get guidance based on your academic background,
                    career goals, preferred destination and budget.

                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    🌍
                </div>

                <h3>
                    Global Opportunities
                </h3>

                <p>

                    Explore universities, courses and study
                    opportunities across popular international
                    destinations.

                </p>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    🤝
                </div>

                <h3>
                    Support Throughout
                </h3>

                <p>

                    Stay supported throughout your study abroad
                    journey with professional guidance and
                    application assistance.

                </p>

            </div>

        </div>

    </div>

</section>



<!-- ============================================================
     HOW IT WORKS
============================================================= -->

<section class="section process-section">

    <div class="container">


        <div class="section-heading">

            <span class="section-tag">
                HOW IT WORKS
            </span>

            <h2 class="section-title">
                Your journey in simple steps
            </h2>

            <p class="section-description">

                We've simplified the study abroad process so
                you can focus on preparing for your future.

            </p>

        </div>


        <div class="process-grid">


            <div class="process-card">

                <div class="process-number">
                    01
                </div>

                <h3>
                    Create Your Profile
                </h3>

                <p>

                    Tell us about your education,
                    interests and future goals.

                </p>

            </div>


            <div class="process-card">

                <div class="process-number">
                    02
                </div>

                <h3>
                    Explore Options
                </h3>

                <p>

                    Discover countries, universities
                    and courses that match your profile.

                </p>

            </div>


            <div class="process-card">

                <div class="process-number">
                    03
                </div>

                <h3>
                    Get Recommendations
                </h3>

                <p>

                    Receive guidance and recommendations
                    from our consultancy team.

                </p>

            </div>


            <div class="process-card">

                <div class="process-number">
                    04
                </div>

                <h3>
                    Apply & Move Forward
                </h3>

                <p>

                    Prepare your application and take
                    the next step toward your future.

                </p>

            </div>

        </div>

    </div>

</section>



<!-- ============================================================
     POPULAR DESTINATIONS
============================================================= -->

<section class="section destination-section">

    <div class="container">


        <div class="section-heading">

            <span class="section-tag">
                STUDY DESTINATIONS
            </span>

            <h2 class="section-title">
                Where will your journey take you?
            </h2>

            <p class="section-description">

                Explore some of the world's most popular
                destinations for international students.

            </p>

        </div>


        <div class="destination-grid">


            <div class="country-card country-australia">

                <div class="country-card-content">

                    <span>STUDY IN</span>

                    <h3>Australia</h3>

                    <a href="{{ route('countries') }}">
                        Explore destination →
                    </a>

                </div>

            </div>


            <div class="country-card country-uk">

                <div class="country-card-content">

                    <span>STUDY IN</span>

                    <h3>United Kingdom</h3>

                    <a href="{{ route('countries') }}">
                        Explore destination →
                    </a>

                </div>

            </div>


            <div class="country-card country-canada">

                <div class="country-card-content">

                    <span>STUDY IN</span>

                    <h3>Canada</h3>

                    <a href="{{ route('countries') }}">
                        Explore destination →
                    </a>

                </div>

            </div>


            <div class="country-card country-newzealand">

                <div class="country-card-content">

                    <span>STUDY IN</span>

                    <h3>New Zealand</h3>

                    <a href="{{ route('countries') }}">
                        Explore destination →
                    </a>

                </div>

            </div>


            <div class="country-card country-usa">

                <div class="country-card-content">

                    <span>STUDY IN</span>

                    <h3>United States</h3>

                    <a href="{{ route('countries') }}">
                        Explore destination →
                    </a>

                </div>

            </div>


            <div class="country-card country-france">

                <div class="country-card-content">

                    <span>STUDY IN</span>

                    <h3>France</h3>

                    <a href="{{ route('countries') }}">
                        Explore destination →
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- ============================================================
     CTA
============================================================= -->

<section class="cta-section">

    <div class="container">

        <div class="cta-box">

            <div>

                <h2>
                    Ready to start your
                    <br>
                    study abroad journey?
                </h2>

                <p>

                    Explore your options and take the first
                    step towards an international education.

                </p>

            </div>


            <a href="{{ route('register') }}" class="cta-button">

                Start Your Journey

                <span>→</span>

            </a>

        </div>

    </div>

</section>



<!-- ============================================================
     FOOTER
============================================================= -->

<footer class="footer">

    <div class="container">


        <div class="footer-grid">


            <div class="footer-brand">

                <a href="{{ route('home') }}" class="logo footer-logo">

                    <span class="logo-mark"></span>

                    <span>INDIC RMC</span>

                </a>

                <p>

                    Helping students discover international
                    education opportunities and build a better
                    future through global education.

                </p>

            </div>


            <div class="footer-column">

                <h4>Explore</h4>

                <a href="{{ route('countries') }}">
                    Destinations
                </a>

                <a href="{{ route('universities') }}">
                    Universities
                </a>

                <a href="{{ route('courses') }}">
                    Courses
                </a>

                <a href="{{ route('scholarships') }}">
                    Scholarships
                </a>

            </div>


            <div class="footer-column">

                <h4>Company</h4>

                <a href="{{ route('about') }}">
                    About Us
                </a>

                <a href="{{ route('how.it.works') }}">
                    How It Works
                </a>

                <a href="{{ route('contact') }}">
                    Contact
                </a>

            </div>


            <div class="footer-column">

                <h4>Student</h4>

                <a href="{{ route('login') }}">
                    Login
                </a>

                <a href="{{ route('register') }}">
                    Register
                </a>

                <a href="{{ route('contact') }}">
                    Get Support
                </a>

            </div>

        </div>


        <div class="footer-bottom">

            <span>
                © {{ date('Y') }} INDIC RMC. All rights reserved.
            </span>


            <div class="footer-socials">

                <span class="social">f</span>

                <span class="social">in</span>

                <span class="social">ig</span>

            </div>

        </div>

    </div>

</footer>


</body>
</html>