<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BoardingPH</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background: #f3f4f6;
            color: #1f2937;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .auth-container {
            background: white;
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        }

        .brand-logo {
            color: #111827;
            font-size: 24px;
            font-weight: 800;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .brand-logo svg {
            width: 32px;
            height: 32px;
            fill: #22c77a;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .auth-header h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 8px;
        }

        .auth-header p {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 0.85rem;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-family: 'Manrope', sans-serif;
            font-size: 0.95rem;
            transition: all 0.2s;
            outline: none;
        }

        .form-group input:focus {
            border-color: #22c77a;
            box-shadow: 0 0 0 4px rgba(34, 199, 122, 0.12);
        }

        .remember-forgot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 0.88rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #4b5563;
            cursor: pointer;
        }

        .remember-me input {
            accent-color: #22c77a;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .btn-auth {
            width: 100%;
            background: linear-gradient(135deg, #22c77a 0%, #16a34a 100%);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(34, 199, 122, 0.2);
            text-align: center;
        }

        .btn-auth:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(34, 199, 122, 0.3);
        }

        .auth-footer {
            text-align: center;
            margin-top: 32px;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .auth-footer a {
            color: #16a34a;
            text-decoration: none;
            font-weight: 700;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .alert-error {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.88rem;
            margin-bottom: 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <a href="/" class="brand-logo">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
            BoardingPH
        </a>

        <div class="auth-header">
            <h2>Welcome Back</h2>
            <p>Log in to your account to continue</p>
        </div>

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Enter your password">
            </div>

            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    Remember me
                </label>
            </div>

            <button type="submit" class="btn-auth">Log In</button>
        </form>

        <div class="auth-footer">
            Don't have an account? <a href="{{ route('register') }}">Register here</a>
        </div>
    </div>

</body>
</html>
