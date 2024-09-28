<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barangay Information Management System</title>
    <script src="{{ asset('/js/tailwind.min.js') }}"></script>
    <link rel="icon" href="{{ asset('images/bims-logo.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap" rel="stylesheet">
    <style>
        .new-amsterdam-regular {
            font-family: "New Amsterdam", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        }

        function toggleDropdown() {
            var dropdownContent = document.getElementById('dropdown-content');
            dropdownContent.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    <div id="main" class="flex h-screen">
       <!-- Sidebar -->
    <div id="sidebar" class="bg-blue-500 w-[250px] flex flex-col justify-between transition-transform transform md:translate-x-0 -translate-x-full hidden md:block h-auto md:h-screen">
        <div class="flex-grow">
            <!-- Title and Logo -->
            <div id="branding" class="flex flex-col items-center py-6 space-y-2 ml-3 md:flex-row md:space-y-0 md:space-x-4">
                <img class="w-[70px] h-[70px] rounded-full" src="{{asset('images/tubigon-logo.png')}}" alt="barangay/lgu logo">
                <h1 class="text-xl lg:text-3xl" style="font-family: 'Roboto', sans-serif; font-weight: 900; color: white;">
                    BIMS
                </h1> 
            </div>

            <nav id="main-nav" class="space-y-2">
                <hr class="border-t-2 ml-4 mr-4 border-gray-300">
                <a href="{{ url('/lgu') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('lgu*') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                    <i class="fas fa-house fa-lg text-blue-800"></i>
                    <span class="text-[13px] lg:text-[15px]">Dashboard</span>
                </a>
                <hr class="border-t-2 ml-4 mr-4 border-gray-300">
                <a href="{{ url('/barangays') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('barangays*') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                    <i class="fas fa-users fa-lg text-blue-800"></i>
                    <span class="text-[13px] lg:text-[15px]">Barangays</span>
                </a>
                <a href="{{ url('/admins') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('admins*') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                    <i class="fas fa-user-shield fa-lg text-blue-800"></i>
                    <span class="text-[13px] lg:text-[15px]">Barangay Admins</span>
                </a>
            </nav>
        </div>
    </div>


        <div class="flex-1 flex flex-col">

            <!-- Top Navigation Bar -->
            <nav id="top-nav" class="flex justify-between items-center bg-white shadow-md h-[60px] px-4">
                <button onclick="toggleSidebar()" class="md:hidden flex items-center text-blue-500">
                    <i class="fas fa-bars fa-lg mr-3"></i>
                </button>
                @yield('icon')
                <h1 class="text-1xl lg:text-xl text-gray-600">@yield('title', 'Dashboard')</h1>
    
                <div class="flex items-center ml-auto">
                    <h1 class="text-2xl font-bold transform scale-y-130">|</h1>    
                
                    <div id="user-dropdown" class="relative px-4 py-2 rounded-lg flex items-center">
                        <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
                            <span class="text-gray-600 font-semibold mr-3">{{ Auth::user()->name }}</span>
                            <div class="py-1 px-2 bg-black text-white rounded-full">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                        </button>
                
                        <div id="dropdown-content" class="hidden absolute right-0 mt-20 w-[100%] bg-white rounded-lg shadow-lg z-10">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-700 hover:bg-gray-100 rounded-lg">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
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
