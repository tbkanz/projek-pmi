<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            font-family: Arial, sans-serif;
        }

        .logo-pmi {
            width: 150px;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 380px;
            padding: 30px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .card h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #e43d3d;
            border: none;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn:hover {
            background: #c73232;
        }
    </style>
</head>

<body>

    <!-- Logo -->
    <div class="logo">
        <img class="logo-pmi" src="{{ asset('storage/logo-pmi.png') }}" alt="Logo PMI">
    </div>

    <!-- Container -->
    <div class="container">
        <div class="card">
            <h2>Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div style="color:red; font-size:12px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div style="color:red; font-size:12px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                    @error('password')
                        <div style="color:red; font-size:12px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn">Register</button>
            </form>
        </div>
    </div>

</body>

</html>