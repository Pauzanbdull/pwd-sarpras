<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin - Sarpras</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #005f73, #0a9396);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            animation: fadeInBackground 1s ease-in-out;
        }

        @keyframes fadeInBackground {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .register-container {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInContainer 0.8s ease-out forwards;
            animation-delay: 0.2s;
        }

        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #027c7c, #03a9a9);
        }

        @keyframes fadeInContainer {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
            animation: fadeInLogo 1s ease-out;
        }

        .logo {
            width: 200px;
            height: auto;
            display: block;
            margin: 0 auto 20px;
            animation: fadeInLogo 1s ease-out;
        }

        @keyframes fadeInLogo {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
            position: relative;
            animation: slideIn 0.8s ease-out;
        }

        h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, #027c7c, #03a9a9);
            margin: 0.5rem auto 0;
            border-radius: 3px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        form {
            display: grid;
            gap: 1.8rem;
        }

        .form-group {
            opacity: 0;
            transform: translateX(-20px);
            animation: fadeInStagger 0.6s ease forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.4s; }
        .form-group:nth-child(2) { animation-delay: 0.5s; }
        .form-group:nth-child(3) { animation-delay: 0.6s; }
        .form-group:nth-child(4) { animation-delay: 0.7s; }

        @keyframes fadeInStagger {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 600;
            color: #555;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #027c7c;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(2, 124, 124, 0.2);
            outline: none;
        }

        button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(to right, #027c7c, #03a9a9);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: bounceIn 0.8s ease-out forwards;
            animation-delay: 0.8s;
        }

        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.95); }
            60% { opacity: 1; transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        button:hover {
            background: linear-gradient(to right, #027c7c, #04a5a5);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        button:active {
            transform: scale(0.98);
            background: linear-gradient(to right, #015e5e, #038f8f);
        }

        .message {
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            opacity: 0;
            transform: scale(0.9) translateY(-10px);
            animation: showMessage 0.6s ease-out forwards;
        }

        .verified-message {
            background-color: rgba(46, 204, 113, 0.15);
            color: #27ae60;
            border: 1px solid #2ecc71;
        }

        .verified-message::before {
            content: "✓";
            margin-right: 8px;
            font-weight: bold;
        }

        .error-message {
            background-color: rgba(231, 76, 60, 0.15);
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }

        @keyframes showMessage {
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.95rem;
            color: #555;
        }

        .login-link a {
            color: #027c7c;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #04a5a5;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .register-container {
                padding: 1.8rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                padding: 0.8rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-container">
            <img src="{{ asset('assets/logotb.jpg') }}" alt="Logo Sarpras" class="logo">
        </div>

        <h2>REGISTER ADMIN</h2>

        <!-- Pesan sukses -->
        @if(session('success'))
            <div class="message verified-message">
                {{ session('success') }}
            </div>
        @endif

        <!-- Pesan error -->
        @if ($errors->any())
            <div class="message error-message">
                <ul style="list-style: none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form register -->
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap">
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="Masukkan alamat email">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Buat password">
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi password">
            </div>

            <input type="hidden" name="role" value="admin">

            <button type="submit">DAFTAR SEKARANG</button>
        </form>

        <p class="login-link">Sudah punya akun? <a href="{{ route('login') }}">LOGIN </a></p>
    </div>
</body>
</html>
