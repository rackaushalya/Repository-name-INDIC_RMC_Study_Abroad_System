<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - INDIC RMC</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f5f7fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .login-container {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12);
        }

        /* LEFT SIDE */

        .login-left {
            width: 48%;
            background: #101b2d;
            color: white;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .logo .orange {
            color: #ff7417;
        }

        .logo .white {
            color: white;
        }

        .tagline {
            color: #aeb8c7;
            font-size: 12px;
            letter-spacing: 2px;
            margin-bottom: 55px;
        }

        .login-left h1 {
            font-size: 40px;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .login-left p {
            color: #c6ceda;
            font-size: 16px;
            line-height: 1.7;
            max-width: 420px;
        }

        .features {
            margin-top: 40px;
        }

        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            color: #dce2ea;
            font-size: 14px;
        }

        .feature-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255, 116, 23, 0.15);
            color: #ff7417;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-weight: bold;
        }

        /* RIGHT SIDE */

        .login-right {
            width: 52%;
            padding: 60px 65px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-title {
            font-size: 30px;
            color: #172033;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: #7b8494;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            color: #273247;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .form-control {
            width: 100%;
            height: 50px;
            border: 1px solid #dce1e8;
            border-radius: 9px;
            padding: 0 15px;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #ff7417;
            box-shadow: 0 0 0 3px rgba(255, 116, 23, 0.10);
        }

        .password-row {
            position: relative;
        }

        .password-row .form-control {
            padding-right: 45px;
        }

        .show-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            cursor: pointer;
            color: #7b8494;
            font-size: 13px;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #687386;
            font-size: 13px;
        }

        .remember input {
            accent-color: #ff7417;
        }

        .forgot {
            color: #ff7417;
            font-size: 13px;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 9px;
            background: #ff7417;
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-btn:hover {
            background: #e9630b;
            transform: translateY(-1px);
        }

        .error-box {
            background: #fff1f1;
            border: 1px solid #ffcaca;
            color: #c62828;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .register-text {
            text-align: center;
            margin-top: 25px;
            color: #7b8494;
            font-size: 14px;
        }

        .register-text a {
            color: #ff7417;
            font-weight: 700;
            text-decoration: none;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 800px) {
            .login-container {
                flex-direction: column;
            }

            .login-left,
            .login-right {
                width: 100%;
            }

            .login-left {
                padding: 40px 30px;
            }

            .login-left h1 {
                font-size: 30px;
            }

            .login-right {
                padding: 40px 30px;
            }

            .features {
                margin-top: 25px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <!-- LEFT SIDE -->
    <div class="login-left">

        <div class="logo">
            <span class="orange">INDIC</span>
            <span class="white"> RMC</span>
        </div>

        <div class="tagline">
            STUDY ABROAD, BRIGHTER TOMORROWS
        </div>

        <h1>
            Your journey<br>
            starts here.
        </h1>

        <p>
            Access your INDIC RMC account and manage your study
            abroad journey, applications, recommendations and
            consultations in one place.
        </p>

        <div class="features">

            <div class="feature">
                <div class="feature-icon">✓</div>
                Explore universities and courses
            </div>

            <div class="feature">
                <div class="feature-icon">✓</div>
                Track your consultancy application
            </div>

            <div class="feature">
                <div class="feature-icon">✓</div>
                Manage consultations and appointments
            </div>

        </div>

    </div>


    <!-- RIGHT SIDE -->
    <div class="login-right">

        <h2 class="login-title">Welcome back</h2>

        <p class="login-subtitle">
            Sign in to continue to your INDIC RMC account.
        </p>


        @if ($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif


        <form method="POST" action="{{ route('login.submit') }}">

            @csrf

            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    placeholder="Enter your email address"
                    required
                    autofocus
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <div class="password-row">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        required
                    >

                    <button
                        type="button"
                        class="show-password"
                        onclick="togglePassword()"
                    >
                        Show
                    </button>

                </div>

            </div>


            <div class="options">

                <label class="remember">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>

                <a href="{{ route('password.request') }}" class="forgot">
                     Forgot password?
                </a>

            </div>


            <button type="submit" class="login-btn">
                Sign In
            </button>

        </form>


        <div class="register-text">

            Don't have an account?

            <a href="{{ route('register') }}">
                Create an account
            </a>

        </div>

    </div>

</div>


<script>

function togglePassword() {

    const password = document.getElementById('password');
    const button = document.querySelector('.show-password');

    if (password.type === 'password') {

        password.type = 'text';
        button.textContent = 'Hide';

    } else {

        password.type = 'password';
        button.textContent = 'Show';

    }

}

</script>

</body>
</html>