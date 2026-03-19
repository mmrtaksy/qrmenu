<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş - Raqoon Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .login-card {
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 3rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0,0,0,.3);
        }
        .login-card .brand {
            font-size: 2rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-card .brand span { color: #ff9e81; }
        .form-control {
            border-radius: 10px;
            padding: .75rem 1rem;
            border: 2px solid #e5e7eb;
        }
        .form-control:focus {
            border-color: #ff9e81;
            box-shadow: 0 0 0 3px rgba(255,158,129,.15);
        }
        .btn-login {
            background: #ff9e81;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: .75rem;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
        }
        .btn-login:hover { background: #f0896c; color: #fff; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand"><span>Raqoon</span> Cafe</div>
        <p class="text-center text-muted mb-4">Yönetim Paneline Giriş Yapın</p>

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">E-posta</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="admin@raqooncafe.com">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Şifre</label>
                <input type="password" name="password" class="form-control" required placeholder="Şifrenizi girin">
            </div>
            <div class="mb-4 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Beni hatırla</label>
            </div>
            <button type="submit" class="btn btn-login">Giriş Yap</button>
        </form>
    </div>
</body>
</html>
