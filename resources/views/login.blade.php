<!DOCTYPE html>
<html>
<head>
    <title>Login - Boutique 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #9bc4e8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }


        .login-box {
            background-color: #5583ab;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            color: #fff;
            text-align: center;
        }

        .login-box img {
            max-width: 300px;
            /*margin-bottom: 10px;*/
        }

        .login-box input.form-control {
            background-color: #d1e0f0;
            color: #000;
            border: 1px solid #273e52;
            border-radius: 5px;
            padding: 8px;
        }

        .login-box input.form-control:focus {
            background-color: #e4f0fb;
            border-color: #18466b;
            box-shadow: none;
        }

        .login-box button {
            background-color: #273e52;
            color: #fff;
            width: 100%;
            font-weight: bold;
        }

        .alert {
            margin-top: 15px;
        }
    </style>
</head>
<body style="background-color: #9bc4e8;">
    <div class="login-box">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Boutique 2025">
        
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3 text-start">
                <label>Usuario</label>
                <input type="text" name="nombre" class="form-control" value="" autocomplete="off" required>
            </div>
            <div class="mb-3 text-start">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" value="" autocomplete="off" required>
            </div>
            <button type="submit" class="btn mt-3">Ingresar</button>
        </form>

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
    </div>
</body>

</html>
