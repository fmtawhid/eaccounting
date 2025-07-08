<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-ACCOUNT | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #fce3e3, #f8c3c3);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            display: flex;
            width: 90%;
            max-width: 1000px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        }

        .login-image {
            width: 50%;
            background: url('https://images.unsplash.com/photo-1557683304-673a23048d34') no-repeat center center;
            background-size: cover;
        }

        .login-form {
            width: 50%;
            padding: 50px 40px;
        }

        .login-form h4 {
            color: #b30000;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #b30000;
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #990000;
        }

        .form-check-label {
            font-size: 14px;
            color: #555;
        }

        .ip-box {
            font-size: 14px;
            margin-top: 15px;
            color: #666;
        }

        .register-footer {
            margin-top: 15px;
            font-size: 14px;
            color: #444;
        }

        .register-footer a {
            color: #b30000;
            text-decoration: none;
        }

        .errorServer .parsley-errors-list li {
            background: #ffe5e5;
            padding: 5px 10px;
            border-left: 4px solid #dc3545;
            color: #dc3545;
            border-radius: 5px;
            margin-top: 5px;
            list-style: none;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-image,
            .login-form {
                width: 100%;
            }

            .login-image {
                height: 200px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <!-- Left Side Image -->
        <div class="login-image">
            <div>
                <img src="{{asset('assets/admin/auth.jpg')}}" alt="" style="width: 100%; height: auto;">
            </div>
        </div>

        <!-- Right Side Form -->
        <div class="login-form">
            <h4>E-ACCOUNT Login</h4>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="login" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="login" placeholder="Enter email or ID" value="{{ old('login') }}">
                    </div>
                    @error('login')
                    <div class="errorServer">
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>
                    @error('password')
                    <div class="errorServer">
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                    </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-muted">Forgot Password?</a>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>

                <div class="ip-box text-center">
                    <strong>Your IP:</strong> <span id="user-ip">Loading...</span>
                </div>

                <div class="register-footer text-center">
                    Don’t have an account? <a href="{{ route('register') }}">Register here</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        fetch('https://api.ipify.org?format=json')
            .then(response => response.json())
            .then(data => {
                document.getElementById('user-ip').textContent = data.ip;
            })
            .catch(() => {
                document.getElementById('user-ip').textContent = 'Unavailable';
            });
    </script>

</body>

</html>