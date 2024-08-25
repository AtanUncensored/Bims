<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barangay Information Management System</title>
    <script src="{{ asset('/js/tailwind.min.js') }}"></script>
    <link rel="icon" href="{{ asset('images/tubigon-logo.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap" rel="stylesheet">
    <style>
        .new-amsterdam-regular {
            font-family: "New Amsterdam", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div id="main" class="flex h-screen">
        <!-- Sidebar ni -->
        <div id="sidebar" class="bg-blue-500 w-[250px] flex flex-col justify-between">
            <div>
                <!-- title ug logo -->
                <div id="branding" class="flex items-center py-6 space-x-4 ml-4">
                    <img class="w-[70px] h-[70px] rounded-full" src="{{asset('images/tubigon-logo.png')}}" alt="barangay/lgu logo">
                    <h1 class="new-amsterdam-regular text-white text-4xl">BIMS</h1>
                </div>
    
                <nav id="main-nav" class="mt-6 space-y-2">
                    <hr class="border-t-2 ml-4 mr-4 border-gray-300">
                    <a href="{{ url('/lgu') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('lgu*') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-house fa-lg text-blue-800"></i>
                        <span>Dashboard</span>
                    </a>
                    <hr class="border-t-2 ml-4 mr-4 border-gray-300">
                    <a href="{{ url('/barangays') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('barangays*') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-users fa-lg text-blue-800"></i>
                        <span>Barangays</span>
                    </a>
                    <a href="{{ url('/admins') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('admins*') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-user-shield fa-lg text-blue-800"></i>
                        <span>Barangay Admins</span>
                    </a>
                </nav>                
            </div>
        </div>

        <div class="flex-1 flex flex-col">
            <!-- para sa Top Navigation Bar  -->
            <nav id="top-nav" class="flex justify-end items-center bg-white shadow-md h-[60px] px-4">
                @yield('icon')
                <h1 class="text-xl text-gray-600">@yield('title', 'Dashboard')</h1>
    
                <!--mau nig Logout Form -->
                <div id="logout-form" class="ml-auto">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-blue-500 hover:text-blue-700">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </nav>

            <!-- Main Content ni dere -->
            <div id="content" class="flex-1 p-4">
                @yield('content')
            </div>

            <footer>
                @include('templates.footer')
            </footer>
        </div>
    </div>
</body>
</html>
