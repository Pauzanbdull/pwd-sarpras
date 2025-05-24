<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #005f73, #0a9396);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            animation: fadeInBackground 1s ease-in-out;
        }

        @keyframes fadeInBackground {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .login-container {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            animation: fadeInContainer 0.8s ease forwards;
            opacity: 0;
            transform: translateY(20px);
            z-index: 1;
        }

        @keyframes fadeInContainer {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #2c3e50;
            font-weight: 600;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            0% {
                transform: translateY(-30px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        form div {
            margin-bottom: 1.5rem;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
            opacity: 0;
            animation: fadeInLabel 0.5s ease-out forwards;
        }

        @keyframes fadeInLabel {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #f9f9f9;
            animation: fadeInInput 0.6s ease-out;
        }

        @keyframes fadeInInput {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        input:focus {
            border-color: #027c7c;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
            outline: none;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(to right, #027c7c, #03a9a9);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.4s ease, transform 0.3s ease;
            animation: fadeInButton 0.8s ease-out;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes fadeInButton {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        button:hover {
            background: linear-gradient(to right, #027c7c, #04a5a5);
            transform: translateY(-3px);
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 0.25rem;
            animation: fadeInErrorMessage 0.5s ease-out forwards;
        }

        @keyframes fadeInErrorMessage {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        p {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.95rem;
            color: #555;
        }

        a {
            color: #027c7c;
            text-decoration: none;
        }

        a:hover {
            color: #04a5a5;
            text-decoration: underline;
        }

        .logo {
            width: 200px;
            height: auto;
            display: block;
            margin: 0 auto 20px;
            animation: fadeInLogo 1s ease-out;
        }

        @keyframes fadeInLogo {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Overlay loading style */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 6px solid white;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
    </style>
</head>

<body>
    <!-- Overlay Spinner -->
    <div class="overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <div class="login-container">
        <img src="{{ asset('assets/logotb.jpg') }}" alt="Logo Sarpras" class="logo">
        <h2>LOGIN</h2>

        @if (session('error'))
        <p class="error-message">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" id="loginButton"><span id="buttonText">LOGIN</span></button>
        </form>

        <p>Belum punya akun? <a href="{{ route('register') }}">REGISTER</a></p>
    </div>

    <script>
    const form = document.querySelector('form');
    const loginButton = document.getElementById('loginButton');
    const buttonText = document.getElementById('buttonText');
    const overlay = document.getElementById('loadingOverlay');

    form.addEventListener('submit', function () {
        loginButton.disabled = true;
        overlay.style.display = 'flex';
        buttonText.textContent = "Memproses...";
    });
</script>

</body>

</html>
