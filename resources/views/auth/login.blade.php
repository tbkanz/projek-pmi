<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f7f7f7;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #c62828;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
            font-size: 24px;
            font-weight: bold;
            position: relative;
            overflow: hidden;
        }

        /* Logo PMI */
        .logo-pmi {
            position: absolute;
            top: 15px;
            right: 20px;
            width: 60px;
            height: auto;
        }

        /* Bungkus ambulans + sirine */
        .ambulans {
            display: inline-block;
            position: relative;
            font-size: 40px;
            animation: jalan 4s linear infinite;
        }

        .ambulans span {
            display: inline-block;
        }

        .sirine {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 14px;
            height: 14px;
            border-radius: 50%;
            animation: blink 0.6s infinite alternate;
        }

        @keyframes jalan {
            0% {
                transform: translateX(-120%);
            }
            50% {
                transform: translateX(120%);
            }
            100% {
                transform: translateX(-120%);
            }
        }

        @keyframes blink {
            0% {
                background: red;
                box-shadow: 0 0 10px red;
            }
            100% {
                background: blue;
                box-shadow: 0 0 10px blue;
            }
        }

        .container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .card {
            width: 380px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .card-header {
            background: #c62828;
            color: #fff;
            text-align: center;
            padding: 15px;
            font-weight: bold;
            font-size: 18px;
        }

        .card-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #d32f2f;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 6px;
        }

        .btn:hover {
            background: #b71c1c;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: #d32f2f;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 6px;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <!-- Logo PMI -->
<img src="{{ asset('images/logo-pmi.png') }}" alt="Logo PMI" class="logo-pmi">


        <!-- Ambulans -->
        <div class="ambulans">
            <div class="sirine"></div>
            <span>🚑</span>
        </div>

        <div>Pemakaian Ambulans</div>
    </div>

    <!-- Container -->
    <div class="container">
        <div class="card">
            <div class="card-header">Login Pengguna</div>
            <div class="card-body">

                @if (session('error'))
                    <div class="error">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn">🔑 MASUK</button>
                </form>

                <div class="register-link">
                    Belum punya akun? <a href="{{ route('register') }}">Register</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>