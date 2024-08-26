<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LGU Login</title>
    <link rel="icon" href="{{ asset('images/tubigon-logo.png') }}">
    <script src="{{ asset('/js/tailwind.min.js') }}"></script>
    <style>
        body {
            background-image: url('{{ asset('/images/lgu-building.jpg') }}');
            background-size: cover;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .top-nav {
            padding: 10px 20px;
            text-align: center;
            font-size: 1.5rem;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
        }
        .content {
            display: flex;
            align-items: center;
            min-height: 94vh;
            padding: 60px 20px 20px;
            gap: 20px;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .logo {
            flex: 1;
            max-width: 300px;
            display: flex;
            justify-content: center;
        }
        .logo img {
            width: 100%;
            height: auto;
            max-height: 300px;
            border-radius: 50%;
        }
        .info-login {
            flex: 2;
            max-width: 500px;
        }
        .info-login .bims {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            margin-bottom: 20px;
        }
        .info-login .bims header {
            font-size: 3rem;
            font-family:'Times New Roman', Times, serif;
            font-weight: bold;
            margin: 0;
            line-height: 0;
            text-align: center;
        }
        .login-form {
            margin-top: 20px;
            padding: 25px;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.8);
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            position: relative;
        }
        .form-group label {
            font-size: 1rem;
            font-weight: bold;
            width: 100px;
            margin-right: 10px;
        }
        .form-group input {
            flex: 1;
            padding: 4px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .password-toggle svg {
            width: 20px;
            height: 20px;
        }
        .login-form a {
            display: block;
            text-align: center;
            margin-top: 10px;
            padding: 10px;
            background-color: #1d4ed8;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .login-form a:hover {
            background-color: #2563eb;
        }
    
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }

        .admin-notice {
            background-color: #e96a6a;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border-radius: 8px;
            margin-bottom: 15px;
            animation: blink 1s infinite; 
        }

    </style>
</head>
<body>
<div class="top-nav bg-blue-500 text-white">
    <a href="/" class="ml-4 text-center">Barangay Information Management System</a>
</div>
<div class="content">
    <div class="logo">
        <img src="{{ asset('images/tubigon-logo.png') }}" alt="LGU logo">
    </div>
    <div class="info-login">
        <!-- Admin Notice -->
        <div class="admin-notice">
            NOTICE: This is an Admin Login
        </div>
        <div class="login-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    @error('email')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" />
                    <span class="password-toggle" onclick="togglePasswordVisibility()">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>                    
                        <svg id="eye-slash-icon" class="hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>                          
                    </span>
                    @error('password')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="inline-flex items-center font-bold px-4 py-2 bg-blue-600 text-white rounded">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('templates.footer')

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeSlashIcon = document.getElementById('eye-slash-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeSlashIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeSlashIcon.classList.add('hidden');
        }
    }
</script>
</body>
</html>
