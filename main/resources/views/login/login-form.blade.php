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
            background-color: #f1f5f9;
            color: #1d4ed8;
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
        .login-form label {
            display: block;
            font-size: 1rem;
            margin-bottom: 10px;
            font-weight: bold;
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
    </style>
</head>
<body>
<div class="top-nav">
    <a href="/" class="ml-4 text-center">Barangay Information Management System</a>
</div>
<div class="content">
    <div class="logo">
        <img src="{{ asset('images/tubigon-logo.png') }}" alt="LGU logo">
    </div>
    <div class="info-login">
        <div class="bims">
            <header>B<span class="text-3xl">ARANGAY</span></header>
            <header>I<span class="text-3xl">NFORMATION AND</span></header>
            <header>M<span class="text-3xl">ANAGEMENT</span></header>
            <header>S<span class="text-3xl">YSTEM</span></header>
        </div>
        <div class="login-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mt-4 flex items-center">
                    <label for="email" class="text-sm font-bold text-start text-gray-700 mb-1">Email:</label>
                    <input id="email" class="block w-full border-gray-300 dark:border-gray-700 text-black py-1 px-2 shadow-sm" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    @error('email')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4 flex items-center">
                    <label for="password" class="text-sm font-bold text-start text-gray-700 mb-1">Password:</label>
                    <input id="password" class="block w-full border-gray-300 dark:border-gray-700 text-black py-1 px-2 shadow-sm" type="password" name="password" required autocomplete="current-password" />
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
</body>
</html>
