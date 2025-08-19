<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
            top: 10px;
            left: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 350px;
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

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
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
            <h2>Login</h2>

            @if (session('success'))
                <div id="notif-success"
                    style="position: fixed; top: 20px; left: 20px; background-color: #28a745; color: white; padding: 15px 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); z-index: 9999;">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(() => {
                        const notif = document.getElementById('notif-success');
                        if (notif) {
                            notif.style.transition = "opacity 0.5s ease";
                            notif.style.opacity = "0";
                            setTimeout(() => notif.remove(), 500);
                        }
                    }, 3000);
                </script>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>

                    {{-- tampilkan error kalau gagal login --}}
                    @if ($errors->has('email'))
                        <div class="error">Email atau password salah</div>
                    @endif
                </div>

                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

</body>

</html>