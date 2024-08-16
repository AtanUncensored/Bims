<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('/js/tailwind.min.js') }}"></script>
    <title>@yield('title', 'Barangay Information Management System')</title>
    <link rel="icon" href="{{ asset('images/tubigon-logo.png') }}">
    <style>
        body {
            background-attachment: fixed;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .top-nav {
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .title {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .img-logo img {
            max-width: 300px;
            max-height: 300px;
        }
        .bims {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }
        .bims header {
            font-size: 2.5rem;
            font-weight: bold;
            font-family:'Times New Roman', Times, serif;
            margin: 0;
            line-height: 1.2; 
        }
        .login-form {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: 20px auto;
        }
        .login-form label {
            display: block;
            font-size: 1.5rem;
            margin-bottom: 15px;
            text-align: center;
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
    <div class="top-nav bg-blue-500 text-white py-2 px-4 text-xl flex items-center justify-between">
        <div class="flex items-center">
            <div class="img-logo">
                <img class="w-[60px] h-[60px] rounded-full" src="{{ asset('images/tubigon-logo.png') }}" alt="LGU logo">
            </div>
            <a href="/" class="ml-4">Barangay Information Management System</a>
        </div>
        <div class="relative">
            <button class="hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded inline-flex items-center">
                <span>Barangay</span>
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <ul class="dropdown-menu absolute right-0 hidden text-gray-700 pt-1 bg-white shadow-lg rounded w-full">
                {{-- <li><a class="rounded-t bg-white hover:bg-gray-200 py-2 px-4 block whitespace-no-wrap" href="/cabulijan-login">Cabulijan</a></li>
                <li><a class="bg-white hover:bg-gray-200 py-2 px-4 block whitespace-no-wrap" href="/bosongon-login">Bosongon</a></li>
                <li><a class="rounded-b bg-white hover:bg-gray-200 py-2 px-4 block whitespace-no-wrap" href="#">Tinangnan</a></li>
                <li><a class="bg-white hover:bg-gray-200 py-2 px-4 block whitespace-no-wrap" href="#">Macaas</a></li>
                <li><a class="rounded-b bg-white hover:bg-gray-200 py-2 px-4 block whitespace-no-wrap" href="#">Talenceras</a></li> --}}
            </ul>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>
    
    @include('templates.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.querySelector('.relative > button');
            const dropdown = document.querySelector('.dropdown-menu');

            button.addEventListener('click', function() {
                dropdown.classList.toggle('hidden');
                dropdown.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
