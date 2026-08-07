<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - POS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
    html, body {
        height: 100%;
        margin: 0;
    }
    body {
        background-color: #f8f9fa;
        font-family: -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
        display: flex;
        flex-direction: column;
    }
    /* Notifikasi full-width di atas halaman, seperti pada screenshot */
    .status-banner {
        width: 100%;
        padding: 16px 24px;
        margin: 0;
        border-radius: 0;
        border: none;
        border-bottom: 1px solid #badbcc;
    }
    .login-wrapper {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    /* Kartu form login, solid putih (tidak transparan) */
    .login-card {
        width: 100%;
        max-width: 400px;
        border-radius: 12px;
        overflow: hidden;
        border: none;
        background-color: #ffffff;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.2) !important;
    }
    .login-card .card-header {
        background: #ffffff;
        color: #2b2440;
        font-weight: 700;
        font-size: 20px;
        text-align: center;
        border-bottom: none;
        padding: 24px 24px 8px;
    }
    .form-label {
        color: #212529;
        font-weight: 600;
    }
    .form-control {
        background-color: #ffffff;
        border: 1px solid #e2e6ee;
        border-radius: 8px;
    }
    .form-control:focus {
        border-color: #7c6fe0;
        box-shadow: 0 0 0 0.25rem rgba(124, 111, 224, 0.25);
    }
    .form-check-label,
    .forgot-link {
        font-size: 13px;
        font-weight: 600;
    }
    .forgot-link {
        color: #7c6fe0;
        text-decoration: none;
    }
    .forgot-link:hover {
        text-decoration: underline;
    }
    .btn-indigo {
        background-color: #6a5ae0;
        border-color: #6a5ae0;
        color: #ffffff;
    }
    .btn-indigo:hover {
        background-color: #5849d6;
        border-color: #5849d6;
        color: #ffffff;
    }
    .alert-success-custom {
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }
    .alert-danger-custom {
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
    }
</style>

</head>

<body>

@if (session('status'))
    <!-- Notifikasi full-width, tampil di paling atas halaman -->
    <div class="alert alert-success-custom status-banner small mb-0">
        {{ session('status') }}
    </div>
@endif

<div class="login-wrapper">

    <div class="login-card card">

        <div class="card-header">Login</div>
        <div class="card-body p-4 pt-2">

            @if ($errors->any())
                <div class="alert alert-danger-custom py-2 mb-3 small rounded-3">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('auth') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email ID</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-link">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-indigo w-100 rounded-2 py-2 fw-semibold">Login</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>