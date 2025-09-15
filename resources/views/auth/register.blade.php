<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pengguna</title>

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
        }

        .header i {
            font-size: 40px;
            margin-bottom: 10px;
            display: block;
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
        <i>🚑</i>
        Pemakaian Ambulans
    </div>

    <!-- Container -->
    <div class="container">
        <div class="card">
            <div class="card-header">Register Pengguna</div>
            <div class="card-body">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
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

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>

                    <button type="submit" class="btn">📝 REGISTER</button>
                </form>

                <div class="register-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>