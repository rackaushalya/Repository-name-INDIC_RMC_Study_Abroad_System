@php
    /*
    | One page serves both /login and /register ($mode).
    | After a failed submit, old('_form') tells us which form to reopen.
    */
    $formKey = old('_form', $mode ?? 'login');
    $isRegister = $formKey === 'register';

    /*
    | Rotating quote + portrait slides. A slide is only used when its
    | portrait file exists in public/images/login/, so to add Kennedy or Annan
    | just drop kennedy.png / annan.png into that folder.
    | glow = [x%, y%, opacity] of the orange light behind the portrait.
    */
    $allSlides = [
        ['file' => 'franklin', 'quote' => 'An investment in knowledge pays the best interest.', 'author' => 'Benjamin Franklin', 'glow' => [34, 44, 0.55]],
        ['file' => 'kennedy',  'quote' => 'The human mind is our fundamental resource.', 'author' => 'John F. Kennedy', 'glow' => [20, 46, 0.5]],
        ['file' => 'annan',    'quote' => 'Knowledge is power. Information is liberating. Education is the premise of progress.', 'author' => 'Kofi Annan', 'glow' => [48, 44, 0.5]],
        ['file' => 'einstein', 'quote' => 'The important thing is not to stop questioning. Curiosity has its own reason for existing.', 'author' => 'Albert Einstein', 'glow' => [6, 24, 0.28]],
        ['file' => 'malala',   'quote' => 'One child, one teacher, one book, and one pen can change the world.', 'author' => 'Malala Yousafzai', 'glow' => [92, 52, 0.28]],
    ];

    $slides = [];
    foreach ($allSlides as $slide) {
        if (file_exists(public_path('images/login/' . $slide['file'] . '.png'))) {
            $slide['image'] = asset('images/login/' . $slide['file'] . '.png');
            $slides[] = $slide;
        }
    }

    $first = $slides[0] ?? ['image' => null, 'quote' => 'Education is the passport to the future.', 'author' => 'Malcolm X', 'glow' => [34, 44, 0.5]];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $isRegister ? 'Sign Up' : 'Sign In' }} - INDIC RMC</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800&family=Archivo+Black&display=swap" rel="stylesheet">

    <style>

        /* =========================
           BASE
        ========================= */

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --orange: #ff6000;
            --orange-soft: #ff7a2e;
            --ink: #111418;
            --card-edge: rgba(255, 255, 255, 0.07);
            --field-bg: rgba(6, 8, 12, 0.72);
            --field-edge: rgba(255, 255, 255, 0.1);
            --display: 'Archivo Black', 'Arial Black', Arial, sans-serif;
            --text: 'Archivo', Arial, Helvetica, sans-serif;
        }

        html {
            -webkit-text-size-adjust: 100%;
        }

        body {
            min-height: 100vh;
            font-family: var(--text);
            color: var(--ink);
            background: #f4f6f9;
            overflow-x: hidden;
            position: relative;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button, input {
            font-family: inherit;
        }

        :focus-visible {
            outline: 2px solid var(--orange-soft);
            outline-offset: 3px;
        }


        /* =========================
           BACKGROUND (grid + moving glow)
        ========================= */

        .bg-grid {
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(17, 20, 24, 0.045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(17, 20, 24, 0.045) 1px, transparent 1px);
            background-size: 40px 40px;
            -webkit-mask-image: radial-gradient(ellipse at 40% 50%, #000 25%, transparent 78%);
            mask-image: radial-gradient(ellipse at 40% 50%, #000 25%, transparent 78%);
        }

        .bg-glow {
            position: fixed;
            left: calc(var(--gx, 34) * 1%);
            top: calc(var(--gy, 44) * 1%);
            width: min(1000px, 90vw);
            aspect-ratio: 1;
            transform: translate(-50%, -50%);
            pointer-events: none;
            opacity: var(--go, 0.5);
            background: radial-gradient(circle, rgba(255, 104, 20, 0.7) 0%, rgba(255, 150, 70, 0.3) 36%, transparent 66%);
            transition: left 1.4s ease, top 1.4s ease, opacity 1.4s ease;
        }


        /* cursor spotlight: soft orange light + brighter grid lines under the pointer */

        .bg-cursor,
        .bg-grid-hot {
            position: fixed;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.6s ease;
        }

        .bg-cursor {
            left: 0;
            top: 0;
            width: 760px;
            height: 760px;
            transform: translate3d(var(--mx, -999px), var(--my, -999px), 0) translate(-50%, -50%);
            background: radial-gradient(circle,
                rgba(255, 128, 48, 0.27) 0%,
                rgba(255, 145, 70, 0.15) 28%,
                rgba(255, 165, 100, 0.06) 52%,
                transparent 70%);
            will-change: transform;
        }

        .bg-grid-hot {
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 96, 0, 0.16) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 96, 0, 0.16) 1px, transparent 1px);
            background-size: 40px 40px;
            -webkit-mask-image: radial-gradient(circle 300px at var(--mx, -999px) var(--my, -999px), #000 0%, transparent 100%);
            mask-image: radial-gradient(circle 300px at var(--mx, -999px) var(--my, -999px), #000 0%, transparent 100%);
        }

        .spotlight-on .bg-cursor,
        .spotlight-on .bg-grid-hot {
            opacity: 1;
        }


        /* =========================
           LAYOUT
        ========================= */

        .stage {
            position: relative;
            z-index: 1;
            width: min(1560px, 100% - 64px);
            min-height: 100vh;
            margin: 0 auto;
            padding: 44px 0 40px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 625px;
            column-gap: 70px;
        }


        /* =========================
           LEFT: SHOWCASE
        ========================= */

        .showcase {
            position: relative;
            min-width: 0;
        }

        .showcase-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 28px;
        }

        .brand {
            flex-shrink: 0;
            margin-top: 18px;
            display: block;
        }

        .brand img {
            display: block;
            width: 220px;
            height: auto;
        }

        .headline {
            flex: 1;
            min-width: 0;
            text-align: right;
        }

        .headline h1 {
            font-family: var(--display);
            font-weight: 400;
            font-size: clamp(30px, 2.35vw, 45px);
            line-height: 1.08;
            letter-spacing: -0.02em;
            color: #0d0f12;
        }

        .headline h1 span {
            display: block;
            color: var(--orange);
        }

        .quote-wrap {
            margin-left: auto;
            max-width: 600px;
            margin-top: 8px;
            min-height: 90px;
            transition: opacity 0.35s ease, transform 0.35s ease;
        }

        .quote-wrap.swapping {
            opacity: 0;
            transform: translateY(8px);
        }

        .quote {
            font-size: clamp(16px, 1.1vw, 20px);
            line-height: 1.4;
            color: #3d434d;
        }

        .author {
            margin-top: 12px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 14px;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--orange);
        }

        .author::after {
            content: '';
            width: 24px;
            height: 1.5px;
            background: var(--orange);
        }

        .portrait {
            position: absolute;
            right: 0;
            bottom: -2px;
            height: clamp(360px, 65.5vh, 700px);
            aspect-ratio: 0.93;
            pointer-events: none;
        }

        .portrait img,
        .portrait canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .portrait img {
            object-fit: contain;
            object-position: right bottom;
        }

        .portrait canvas {
            visibility: hidden;
        }

        .portrait.animating canvas {
            visibility: visible;
        }

        .portrait.animating img {
            visibility: hidden;
        }


        /* =========================
           RIGHT: CARD
        ========================= */

        .card-col {
            position: relative;
            min-width: 0;
        }

        .back-link {
            position: absolute;
            top: 21px;
            left: calc(100% + 26px);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            font-size: 15px;
            font-weight: 600;
            color: #5b616b;
            transition: color 0.2s, gap 0.2s;
        }

        .back-link:hover {
            color: var(--orange);
            gap: 12px;
        }

        .back-link svg {
            width: 16px;
            height: 16px;
        }

        .card {
            position: relative;
            height: 100%;
            min-height: 640px;
            display: flex;
            flex-direction: column;
            padding: 17px 23px 29px;
            border-radius: 28px;
            border: 1px solid var(--card-edge);
            color: #fff;
            background:
                radial-gradient(circle at 94% 6%, rgba(255, 96, 0, 0.3), transparent 34%),
                radial-gradient(circle at 4% 100%, rgba(255, 96, 0, 0.06), transparent 40%),
                linear-gradient(180deg, #0e1014 0%, #13161b 55%, #181b21 100%);
            box-shadow: 0 30px 70px rgba(10, 14, 22, 0.28), 0 2px 0 rgba(255, 255, 255, 0.04) inset;
            overflow: hidden;
        }

        .tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .tab {
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            border: 1.5px solid rgba(255, 255, 255, 0.5);
            background: rgba(0, 0, 0, 0.55);
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            transition: background 0.25s, border-color 0.25s, box-shadow 0.25s, transform 0.15s;
        }

        .tab:hover {
            border-color: #fff;
        }

        .tab:active {
            transform: scale(0.985);
        }

        .tab[aria-selected="true"] {
            border-color: var(--orange);
            background: linear-gradient(180deg, #ff6c10, var(--orange));
            box-shadow: 0 8px 22px rgba(255, 96, 0, 0.38);
        }

        .panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            animation: panel-in 0.35s ease;
        }

        .panel[hidden] {
            display: none;
        }

        @keyframes panel-in {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: none; }
        }

        .panel h2 {
            margin-top: 14px;
            font-family: var(--display);
            font-weight: 400;
            font-size: 40px;
            line-height: 1.1;
            letter-spacing: -0.03em;
        }

        .panel .sub {
            margin-top: 4px;
            font-size: 16px;
            color: #e6e8ec;
        }

        .alert {
            margin-top: 18px;
            padding: 13px 15px;
            border-radius: 12px;
            border: 1px solid rgba(255, 96, 0, 0.55);
            background: linear-gradient(90deg, rgba(255, 96, 0, 0.18), rgba(255, 96, 0, 0.07));
            color: #ffe2d1;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.35;
        }

        .alert.info {
            border-color: rgba(120, 200, 140, 0.5);
            background: rgba(120, 200, 140, 0.1);
            color: #d6f5df;
        }

        .fields {
            margin-top: 16px;
            padding: 0 9px;
            display: grid;
            gap: 16px;
        }

        .row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 13.5px;
            font-weight: 800;
            letter-spacing: 0.01em;
        }

        .field label small {
            font-weight: 500;
            color: #9aa1ad;
        }

        .control {
            position: relative;
        }

        .control input {
            width: 100%;
            height: 44px;
            padding: 0 14px 0 44px;
            border-radius: 14px;
            border: 1px solid var(--field-edge);
            background: var(--field-bg);
            color: #fff;
            font-size: 15px;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .control input::placeholder {
            color: #6c7380;
        }

        .control input:hover {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .control input:focus {
            outline: none;
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(255, 96, 0, 0.22);
            background: rgba(6, 8, 12, 0.92);
        }

        .control.has-toggle input {
            padding-right: 46px;
        }

        .control.invalid input {
            border-color: #ff6b5e;
        }

        .control > svg {
            position: absolute;
            left: 15px;
            top: 50%;
            width: 18px;
            height: 18px;
            transform: translateY(-50%);
            color: #aab0bb;
            pointer-events: none;
            transition: color 0.2s;
        }

        .control:focus-within > svg {
            color: var(--orange-soft);
        }

        /* browsers' autofill paints white; keep it dark */
        .control input:-webkit-autofill {
            -webkit-text-fill-color: #fff;
            caret-color: #fff;
            box-shadow: 0 0 0 100px #12151b inset;
            -webkit-box-shadow: 0 0 0 100px #12151b inset;
            transition: background-color 9999s;
        }

        .eye {
            position: absolute;
            right: 6px;
            top: 50%;
            width: 36px;
            height: 36px;
            transform: translateY(-50%);
            display: grid;
            place-items: center;
            border: none;
            border-radius: 10px;
            background: none;
            color: #aab0bb;
            cursor: pointer;
            transition: color 0.2s, background 0.2s;
        }

        .eye:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.06);
        }

        .eye svg {
            width: 18px;
            height: 18px;
        }

        .eye .off { display: none; }
        .eye[aria-pressed="true"] .on { display: none; }
        .eye[aria-pressed="true"] .off { display: block; }

        .field-error {
            display: block;
            margin-top: 6px;
            font-size: 12.5px;
            font-weight: 600;
            color: #ff9a8e;
        }

        .links {
            margin-top: 18px;
            padding: 0 9px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            font-size: 13.5px;
            font-weight: 700;
        }

        .links a {
            color: #dfe2e8;
            transition: color 0.2s;
        }

        .links a:hover {
            color: var(--orange-soft);
        }

        .submit {
            margin: auto 19px 0;
            padding-top: 24px;
        }

        .submit button {
            width: 100%;
            height: 45px;
            border: none;
            border-radius: 999px;
            background: linear-gradient(180deg, #ff6c10, var(--orange));
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.02em;
            cursor: pointer;
            box-shadow: 0 10px 26px rgba(255, 96, 0, 0.35);
            transition: transform 0.15s, box-shadow 0.2s, filter 0.2s;
        }

        .submit button:hover {
            filter: brightness(1.07);
            box-shadow: 0 12px 30px rgba(255, 96, 0, 0.5);
        }

        .submit button:active {
            transform: scale(0.985);
        }

        .submit button[disabled] {
            cursor: progress;
            filter: grayscale(0.4) brightness(0.9);
        }


        /* =========================
           FOOTER
        ========================= */

        .auth-footer {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 12px;
            z-index: 1;
            width: min(1560px, 100% - 64px);
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            gap: 16px;
            font-size: 12.5px;
            color: #6b7280;
            pointer-events: none;
        }

        .auth-footer .regions {
            width: calc(100% - 625px - 70px);
            text-align: center;
        }

        .auth-footer .copy {
            width: 625px;
            text-align: center;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1880px) {

            /* not enough room beside the card: tuck the link into the top corner */
            .back-link {
                position: fixed;
                top: 13px;
                right: 28px;
                left: auto;
                font-size: 14px;
            }

        }

        @media (max-width: 1500px) {

            .showcase-top {
                flex-direction: column;
                align-items: stretch;
                gap: 0;
            }

            .brand {
                align-self: flex-start;
                margin-top: 10px;
            }

            .brand img {
                width: 190px;
            }

            .portrait {
                height: clamp(300px, min(65.5vh, 100vh - 400px), 700px);
            }

        }

        @media (max-width: 1180px) {

            .stage {
                grid-template-columns: 1fr;
                width: min(640px, 100% - 32px);
                min-height: 0;
                padding: 56px 0 56px;
                row-gap: 26px;
                align-content: start;
            }

            .showcase {
                min-height: 0;
            }

            .showcase-top {
                flex-direction: column;
                align-items: center;
                gap: 14px;
                text-align: center;
            }

            .brand {
                margin-top: 0;
            }

            .headline {
                text-align: center;
            }

            .headline h1 {
                font-size: 30px;
            }

            .quote-wrap,
            .portrait {
                display: none;
            }

            .card {
                height: auto;
                min-height: 0;
            }

            .auth-footer {
                position: static;
                width: min(640px, 100% - 32px);
                flex-direction: column;
                align-items: center;
                padding-bottom: 24px;
            }

            .auth-footer .regions,
            .auth-footer .copy {
                width: auto;
            }

            .back-link {
                right: 16px;
            }

        }

        @media (max-width: 520px) {

            .card {
                padding: 14px 14px 22px;
                border-radius: 22px;
            }

            .panel h2 {
                font-size: 32px;
            }

            .fields,
            .links {
                padding: 0 2px;
            }

            .submit {
                margin: auto 4px 0;
            }

            .row-2 {
                grid-template-columns: 1fr;
            }

        }

        @media (prefers-reduced-motion: reduce) {

            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
            }

        }

    </style>
</head>

<body>

<div class="bg-grid" aria-hidden="true"></div>
<div class="bg-grid-hot" aria-hidden="true"></div>
<div class="bg-cursor" aria-hidden="true"></div>
<div class="bg-glow" id="glow" aria-hidden="true"
     style="--gx: {{ $first['glow'][0] }}; --gy: {{ $first['glow'][1] }}; --go: {{ $first['glow'][2] }};"></div>

<main class="stage">

    <!-- LEFT: logo, headline, rotating quote + portrait -->

    <section class="showcase">

        <header class="showcase-top">

            <a href="{{ route('home') }}" class="brand" aria-label="INDIC RMC - The Study Abroad Company">
                <img src="{{ asset('images/login/logo.png') }}" alt="INDIC RMC - The Study Abroad Company">
            </a>

            <div class="headline">

                <h1>
                    Broadening Dreams.
                    <span>Connecting Destinations.</span>
                </h1>

                <div class="quote-wrap" id="quoteWrap" aria-live="polite">
                    <p class="quote" id="quote">&ldquo;{{ $first['quote'] }}&rdquo;</p>
                    <p class="author" id="author">{{ $first['author'] }}</p>
                </div>

            </div>

        </header>

        @if ($first['image'])
            <div class="portrait" id="portrait">
                <img id="portraitImg" src="{{ $first['image'] }}" alt="">
                <canvas id="portraitCanvas" aria-hidden="true"></canvas>
            </div>
        @endif

    </section>


    <!-- RIGHT: sign in / sign up card -->

    <div class="card-col">

        <a href="{{ route('home') }}" class="back-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
            Back to Website
        </a>

        <section class="card">

            <div class="tabs" role="tablist" aria-label="Account">
                <a href="{{ route('login') }}" class="tab" id="tab-login" role="tab" data-tab="login"
                   aria-controls="panel-login" aria-selected="{{ $isRegister ? 'false' : 'true' }}">Sign In</a>
                <a href="{{ route('register') }}" class="tab" id="tab-register" role="tab" data-tab="register"
                   aria-controls="panel-register" aria-selected="{{ $isRegister ? 'true' : 'false' }}">Sign Up</a>
            </div>


            <!-- SIGN IN -->

            <form method="POST" action="{{ route('login.submit') }}" class="panel" id="panel-login"
                  role="tabpanel" aria-labelledby="tab-login" {{ $isRegister ? 'hidden' : '' }} novalidate>
                @csrf
                <input type="hidden" name="_form" value="login">

                <h2>Welcome!</h2>
                <p class="sub">Sign in with your approved email address.</p>

                @if (!$isRegister && $errors->any())
                    <div class="alert" role="alert">{{ $errors->first() }}</div>
                @elseif (session('status'))
                    <div class="alert info" role="status">{{ session('status') }}</div>
                @endif

                <div class="fields">

                    <div class="field">
                        <label for="login-email">Email Address</label>
                        <div class="control {{ !$isRegister && $errors->has('email') ? 'invalid' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3.6"/><path d="M5 20c.7-3.6 3.6-5.6 7-5.6s6.3 2 7 5.6"/></svg>
                            <input type="email" id="login-email" name="email" value="{{ $isRegister ? '' : old('email') }}"
                                   placeholder="name@example.com" autocomplete="off" autocapitalize="none" spellcheck="false"
                                   data-no-autofill required>
                        </div>
                    </div>

                    <div class="field">
                        <label for="login-password">Password</label>
                        <div class="control has-toggle {{ !$isRegister && $errors->has('password') ? 'invalid' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="10.5" width="14" height="9.5" rx="2.5"/><path d="M8 10.5V8a4 4 0 0 1 8 0v2.5"/></svg>
                            <input type="password" id="login-password" name="password" placeholder="Enter your password"
                                   autocomplete="new-password" data-no-autofill required>
                            <button type="button" class="eye" aria-label="Show password" aria-pressed="false" data-target="login-password">
                                <svg class="on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.6-6.5 10-6.5S22 12 22 12s-3.6 6.5-10 6.5S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg class="off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3l18 18"/><path d="M10.6 5.6A10.6 10.6 0 0 1 12 5.5C18.4 5.5 22 12 22 12a17 17 0 0 1-3.2 4"/><path d="M6.5 7.2C3.8 9 2 12 2 12s3.6 6.5 10 6.5c1.5 0 2.8-.3 4-.8"/><path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/></svg>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="links">
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                </div>

                <div class="submit">
                    <button type="submit">Sign In</button>
                </div>
            </form>


            <!-- SIGN UP -->

            <form method="POST" action="{{ route('register.submit') }}" class="panel" id="panel-register"
                  role="tabpanel" aria-labelledby="tab-register" {{ $isRegister ? '' : 'hidden' }} novalidate>
                @csrf
                <input type="hidden" name="_form" value="register">

                <h2>Get started!</h2>
                <p class="sub">Create your student account to begin your journey.</p>

                @if ($isRegister && $errors->any())
                    <div class="alert" role="alert">{{ $errors->count() > 1 ? 'Please check the highlighted fields.' : $errors->first() }}</div>
                @endif

                <div class="fields">

                    <div class="row-2">
                        <div class="field">
                            <label for="reg-first">First Name</label>
                            <div class="control {{ $isRegister && $errors->has('first_name') ? 'invalid' : '' }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3.6"/><path d="M5 20c.7-3.6 3.6-5.6 7-5.6s6.3 2 7 5.6"/></svg>
                                <input type="text" id="reg-first" name="first_name" value="{{ $isRegister ? old('first_name') : '' }}"
                                       autocomplete="given-name" maxlength="100" required>
                            </div>
                            @if ($isRegister) @error('first_name') <span class="field-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="field">
                            <label for="reg-last">Last Name</label>
                            <div class="control {{ $isRegister && $errors->has('last_name') ? 'invalid' : '' }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3.6"/><path d="M5 20c.7-3.6 3.6-5.6 7-5.6s6.3 2 7 5.6"/></svg>
                                <input type="text" id="reg-last" name="last_name" value="{{ $isRegister ? old('last_name') : '' }}"
                                       autocomplete="family-name" maxlength="100">
                            </div>
                            @if ($isRegister) @error('last_name') <span class="field-error">{{ $message }}</span> @enderror @endif
                        </div>
                    </div>

                    <div class="field">
                        <label for="reg-email">Email Address</label>
                        <div class="control {{ $isRegister && $errors->has('email') ? 'invalid' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5.5" width="18" height="13" rx="2.5"/><path d="m4 8 8 5.5L20 8"/></svg>
                            <input type="email" id="reg-email" name="email" value="{{ $isRegister ? old('email') : '' }}"
                                   placeholder="name@example.com" autocomplete="email" maxlength="150" required>
                        </div>
                        @if ($isRegister) @error('email') <span class="field-error">{{ $message }}</span> @enderror @endif
                    </div>

                    <div class="field">
                        <label for="reg-phone">Phone Number <small>(optional)</small></label>
                        <div class="control {{ $isRegister && $errors->has('phone') ? 'invalid' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A15 15 0 0 1 3 6a2 2 0 0 1 2-2Z"/></svg>
                            <input type="tel" id="reg-phone" name="phone" value="{{ $isRegister ? old('phone') : '' }}"
                                   placeholder="+94 77 123 4567" autocomplete="tel" maxlength="30">
                        </div>
                        @if ($isRegister) @error('phone') <span class="field-error">{{ $message }}</span> @enderror @endif
                    </div>

                    <div class="field">
                        <label for="reg-password">Password</label>
                        <div class="control has-toggle {{ $isRegister && $errors->has('password') ? 'invalid' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="10.5" width="14" height="9.5" rx="2.5"/><path d="M8 10.5V8a4 4 0 0 1 8 0v2.5"/></svg>
                            <input type="password" id="reg-password" name="password" placeholder="At least 8 characters"
                                   autocomplete="new-password" minlength="8" required>
                            <button type="button" class="eye" aria-label="Show password" aria-pressed="false" data-target="reg-password">
                                <svg class="on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.6-6.5 10-6.5S22 12 22 12s-3.6 6.5-10 6.5S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg class="off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3l18 18"/><path d="M10.6 5.6A10.6 10.6 0 0 1 12 5.5C18.4 5.5 22 12 22 12a17 17 0 0 1-3.2 4"/><path d="M6.5 7.2C3.8 9 2 12 2 12s3.6 6.5 10 6.5c1.5 0 2.8-.3 4-.8"/><path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/></svg>
                            </button>
                        </div>
                        @if ($isRegister) @error('password') <span class="field-error">{{ $message }}</span> @enderror @endif
                    </div>

                    <div class="field">
                        <label for="reg-confirm">Confirm Password</label>
                        <div class="control has-toggle">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="10.5" width="14" height="9.5" rx="2.5"/><path d="M8 10.5V8a4 4 0 0 1 8 0v2.5"/></svg>
                            <input type="password" id="reg-confirm" name="password_confirmation" placeholder="Re-enter your password"
                                   autocomplete="new-password" required>
                            <button type="button" class="eye" aria-label="Show password" aria-pressed="false" data-target="reg-confirm">
                                <svg class="on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.6-6.5 10-6.5S22 12 22 12s-3.6 6.5-10 6.5S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg class="off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3l18 18"/><path d="M10.6 5.6A10.6 10.6 0 0 1 12 5.5C18.4 5.5 22 12 22 12a17 17 0 0 1-3.2 4"/><path d="M6.5 7.2C3.8 9 2 12 2 12s3.6 6.5 10 6.5c1.5 0 2.8-.3 4-.8"/><path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/></svg>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="submit">
                    <button type="submit">Create Account</button>
                </div>
            </form>

        </section>

    </div>

</main>

<footer class="auth-footer">
    <span class="regions">UK &middot; Australia &middot; Canada &middot; New Zealand &middot; USA &middot; Europe</span>
    <span class="copy">&copy; {{ date('Y') }} INDIC RMC (PVT) LTD</span>
</footer>


<script>
(function () {

    var slides = @json($slides);
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;


    /* ---------- Sign in / Sign up tabs ---------- */

    var tabs = document.querySelectorAll('.tab');
    var panels = { login: document.getElementById('panel-login'), register: document.getElementById('panel-register') };

    function showTab(name, pushUrl) {
        tabs.forEach(function (tab) {
            tab.setAttribute('aria-selected', tab.dataset.tab === name ? 'true' : 'false');
        });

        Object.keys(panels).forEach(function (key) {
            panels[key].hidden = key !== name;
        });

        document.title = (name === 'register' ? 'Sign Up' : 'Sign In') + ' - INDIC RMC';

        if (pushUrl) {
            history.replaceState(null, '', pushUrl);
        }
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function (event) {
            event.preventDefault();
            showTab(tab.dataset.tab, tab.href);

            var first = panels[tab.dataset.tab].querySelector('input:not([type=hidden])');
            if (first) { first.focus({ preventScroll: true }); }
        });
    });


    /* ---------- Keep the sign-in fields empty ----------
       Browsers auto-fill saved logins on page load. The fields start read-only
       (autofill skips them) and become editable as soon as the visitor uses them. */

    document.querySelectorAll('[data-no-autofill]').forEach(function (input) {
        input.setAttribute('readonly', '');

        function unlock() {
            input.removeAttribute('readonly');
        }

        input.addEventListener('focus', unlock);
        input.addEventListener('pointerdown', unlock);
        input.addEventListener('keydown', unlock);
    });


    /* ---------- Show / hide password ---------- */

    document.querySelectorAll('.eye').forEach(function (button) {
        button.addEventListener('click', function () {
            var input = document.getElementById(button.dataset.target);
            var show = input.type === 'password';

            input.type = show ? 'text' : 'password';
            button.setAttribute('aria-pressed', show ? 'true' : 'false');
            button.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        });
    });


    /* ---------- Prevent double submit ---------- */

    document.querySelectorAll('form.panel').forEach(function (form) {
        form.addEventListener('submit', function () {
            var button = form.querySelector('.submit button');
            if (button) {
                setTimeout(function () { button.disabled = true; }, 0);
            }
        });
    });


    /* ---------- Cursor spotlight ---------- */

    if (!reduceMotion && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {

        var root = document.documentElement;
        var target = { x: 0, y: 0 };
        var pos = { x: 0, y: 0 };
        var seen = false;
        var running = false;

        function glide() {
            pos.x += (target.x - pos.x) * 0.14;
            pos.y += (target.y - pos.y) * 0.14;

            root.style.setProperty('--mx', pos.x.toFixed(1) + 'px');
            root.style.setProperty('--my', pos.y.toFixed(1) + 'px');

            if (Math.abs(target.x - pos.x) > 0.4 || Math.abs(target.y - pos.y) > 0.4) {
                requestAnimationFrame(glide);
            } else {
                running = false;
            }
        }

        document.addEventListener('pointermove', function (event) {
            if (event.pointerType === 'touch') { return; }

            target.x = event.clientX;
            target.y = event.clientY;

            if (!seen) {
                seen = true;
                pos.x = target.x;
                pos.y = target.y;
            }

            root.classList.add('spotlight-on');

            if (!running) {
                running = true;
                requestAnimationFrame(glide);
            }
        }, { passive: true });

        root.addEventListener('mouseleave', function () {
            root.classList.remove('spotlight-on');
        });

    }


    /* ---------- Quote + portrait slideshow (mosaic dissolve) ---------- */

    if (slides.length < 2) { return; }

    var portrait = document.getElementById('portrait');
    var img = document.getElementById('portraitImg');
    var canvas = document.getElementById('portraitCanvas');
    var ctx = canvas.getContext('2d');
    var quoteWrap = document.getElementById('quoteWrap');
    var quoteEl = document.getElementById('quote');
    var authorEl = document.getElementById('author');
    var glow = document.getElementById('glow');

    var images = slides.map(function (slide) {
        var image = new Image();
        image.src = slide.image;
        return image;
    });

    var current = 0;
    var busy = false;

    function setText(slide) {
        quoteEl.textContent = '“' + slide.quote + '”';
        authorEl.textContent = slide.author;
    }

    function setGlow(slide) {
        glow.style.setProperty('--gx', slide.glow[0]);
        glow.style.setProperty('--gy', slide.glow[1]);
        glow.style.setProperty('--go', slide.glow[2]);
    }

    /* same placement as CSS object-fit: contain + object-position: right bottom */
    function place(image, w, h) {
        var scale = Math.min(w / image.naturalWidth, h / image.naturalHeight);
        var dw = image.naturalWidth * scale;
        var dh = image.naturalHeight * scale;
        return { x: w - dw, y: h - dh, w: dw, h: dh };
    }

    function ease(t) {
        return t < 0.5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
    }

    function mosaic(from, to, done) {
        var dpr = window.devicePixelRatio || 1;
        var w = portrait.clientWidth;
        var h = portrait.clientHeight;

        canvas.width = Math.round(w * dpr);
        canvas.height = Math.round(h * dpr);
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

        var a = place(from, w, h);
        var b = place(to, w, h);
        var size = Math.max(26, Math.round(w / 15));
        var cols = Math.ceil(w / size);
        var rows = Math.ceil(h / size);
        var delays = [];

        for (var i = 0; i < cols * rows; i++) {
            delays.push(Math.random() * 0.5);
        }

        var duration = 1500;
        var span = 0.5;
        var start = null;

        portrait.classList.add('animating');

        function frame(now) {
            if (start === null) { start = now; }
            var t = (now - start) / duration;

            ctx.clearRect(0, 0, w, h);

            for (var r = 0; r < rows; r++) {
                for (var c = 0; c < cols; c++) {
                    var p = ease(Math.min(1, Math.max(0, (t - delays[r * cols + c]) / span)));
                    var x = c * size;
                    var y = r * size;

                    ctx.save();
                    ctx.beginPath();
                    ctx.rect(x, y, size, size);
                    ctx.clip();
                    if (p < 1) {
                        ctx.globalAlpha = 1 - p;
                        ctx.drawImage(from, a.x, a.y, a.w, a.h);
                    }
                    if (p > 0) {
                        ctx.globalAlpha = p;
                        ctx.drawImage(to, b.x, b.y, b.w, b.h);
                    }
                    ctx.restore();
                }
            }

            if (t < 1 + span) {
                requestAnimationFrame(frame);
            } else {
                done();
            }
        }

        requestAnimationFrame(frame);
    }

    function goTo(index) {
        if (busy || index === current) { return; }

        var next = slides[index];
        var from = images[current];
        var to = images[index];

        if (!to.complete || !to.naturalWidth) { return; }

        busy = true;
        quoteWrap.classList.add('swapping');
        setGlow(next);

        setTimeout(function () {
            setText(next);
            quoteWrap.classList.remove('swapping');
        }, 380);

        function finish() {
            img.src = next.image;
            portrait.classList.remove('animating');
            current = index;
            busy = false;
        }

        if (reduceMotion) {
            finish();
        } else {
            mosaic(from, to, finish);
        }
    }

    setInterval(function () {
        if (!document.hidden) {
            goTo((current + 1) % slides.length);
        }
    }, 7000);

})();
</script>

</body>
</html>
