<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", sans-serif;
            background: #f2f4f8;
            color: #222;
            padding-top: 130px !important;
        }

        /* =====================================================
           NAVBAR
        ====================================================== */
        .custom-navbar {
            position: fixed;
            inset: 0 0 auto 0;
            height: 130px;
            padding: 0 50px;
            background: linear-gradient(135deg, #b30000, #e60000);
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            z-index: 1000;
        }

        /* Bagian kiri */
        .nav-left {
            min-width: 120px;
        }

        .nav-left .logo-pmi {
            width: 90px;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.4));
        }

        /* Bagian tengah */
        .nav-center {
            flex: 1;
            text-align: center;
        }

        .nav-center .judul {
            margin: 0;
            font-size: 32px;
            font-weight: 800;
            color: white;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        /* Bagian kanan */
        .nav-right {
            min-width: 120px;
            text-align: right;
            position: relative;
        }

        .ambulans {
            display: inline-block;
            font-size: 42px;
            position: relative;
            animation: jalan 4s linear infinite;
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

        /* Animasi ambulans */
        @keyframes jalan {
            0% {
                transform: translateX(120%);
            }

            50% {
                transform: translateX(-120%);
            }

            100% {
                transform: translateX(120%);
            }
        }

        /* Animasi sirine */
        @keyframes blink {
            0% {
                background: red;
                box-shadow: 0 0 12px red;
            }

            100% {
                background: blue;
                box-shadow: 0 0 12px blue;
            }
        }

        /* =====================================================
           CARD LOGIN
        ====================================================== */
        .container {
            display: flex;
            justify-content: center;
            margin-top: 35px;
            padding: 20px;
        }

        .card {
            width: 380px;
            background: #ffffffee;
            border-radius: 18px;
            border-top: 6px solid #e60000;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            padding-bottom: 25px;
            backdrop-filter: blur(6px);
        }

        .card-header {
            background: #e60000;
            padding: 16px;
            text-align: center;
            color: white;
            font-size: 19px;
            font-weight: 800;
            border-radius: 12px 12px 0 0;
        }

        .card-body {
            padding: 26px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 700;
            margin-bottom: 7px;
            display: block;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 11px 15px;
            border-radius: 12px;
            border: 1px solid #bbb;
            font-size: 15px;
            background: #fff;
            transition: 0.25s ease;
        }

        .form-group input:focus {
            border-color: #e60000;
            box-shadow: 0 0 8px rgba(230, 0, 0, 0.35);
            outline: none;
        }

        .error {
            color: #e60000;
            font-size: 13px;
            margin-top: 6px;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: #e60000;
            border: none;
            color: #fff;
            font-size: 17px;
            font-weight: 800;
            border-radius: 14px;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(230, 0, 0, 0.35);
            transition: 0.25s ease;
        }

        .btn:hover {
            background: #b30000;
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(179, 0, 0, 0.45);
        }

        .register-link {
            text-align: center;
            font-size: 14px;
            margin-top: 18px;
        }

        .register-link a {
            color: #e60000;
            font-weight: 800;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .nav-left img {
                width: 70px;
            }

            .ambulans {
                font-size: 32px;
            }

            .card {
                width: 92%;
            }
        }
    </style>
</head>

<body>

    <nav class="custom-navbar">
        <div class="nav-left">
            <img src="{{ asset('storage/logo-pmi.png') }}" alt="Logo PMI" class="logo-pmi">
        </div>

        <div class="nav-center">
            <h1 class="judul">Pemakaian Ambulans</h1>
        </div>

        <div class="nav-right">
            <div class="ambulans">
                <div class="sirine"></div>
                <span>🚑</span>
            </div>
        </div>
    </nav>

    <!-- LOGIN CARD -->
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
                        <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}"
                            required>
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
                    Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
                </div>

            </div>
        </div>
    </div>

</body>

</html>