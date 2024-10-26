<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barangay Information Management System</title>
    <script src="{{ asset('/js/tailwind.min.js') }}"></script>
    <script src="{{ asset('/js/alpine.min.js') }}"></script>
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

        //Log out modal ni
        function toggleModal() {
        const modal = document.getElementById('logout-modal');
        modal.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    <div id="main" class="flex h-screen">
       <!-- Sidebar -->
    <div id="sidebar" class="bg-blue-500 w-[250px] flex flex-col justify-between transition-transform transform md:translate-x-0 -translate-x-full hidden md:block h-auto md:h-screen">
        <div class="flex-grow">
            <!-- Title and Logo -->
            <div id="branding" class="flex flex-col py-1 px-2 items-center space-y-2 ml-3 md:flex-row md:space-y-0 md:space-x-4">
                <img class="w-[50px] h-[50px] rounded-full" src="{{asset('images/tubigon-logo.png')}}" alt="barangay/lgu logo">
                <h1 class="text-xl lg:text-[25px]" style="font-family: 'Roboto', sans-serif; font-weight: 900; color: white;">
                    BIMS
                </h1> 
            </div>

            <nav id="main-nav" class="space-y-2">
                <hr class="border-t-2 border-gray-300">
                <a href="{{ url('/lgu') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('lgu*') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                    <i class="fas fa-house fa-lg text-blue-800"></i>
                    <span class="text-[13px] lg:text-[15px]">Dashboard</span>
                </a>
                
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
                <i class="fa-solid fa-id-card fa-xl"></i>
                <h1 class="text-xl ml-2 text-gray-600">Profile</h1>
    
                <div class="flex items-center ml-auto">
                    <h1 class="text-2xl font-bold transform scale-y-130">|</h1>    
                
                    <div id="user-dropdown" class="relative px-4 py-2 rounded-lg flex items-center">
                        <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
                            <span class="text-gray-600 font-bold mr-3">{{ Auth::user()->name }}</span>
                            <div>
                                @if(Auth::user()->user_image)
                                    <img src="{{ Storage::url(Auth::user()->user_image) }}" alt="Profile Image" class="w-[33px] h-[33px] rounded-full object-cover">
                                @else
                                    <img src="{{asset('images/profile.jpg')}}" alt="Default Profile Image" class="w-[33px] h-[33px] rounded-full object-cover">
                                @endif
                            </div>
                        </button>
                
                        <div id="dropdown-content" class="hidden absolute right-0 mt-[75px] w-[100%] bg-white rounded-lg shadow-lg z-10">
                            <button onclick="toggleModal()" class="w-full text-left px-4 py-2 text-red-700 hover:bg-gray-100 rounded-lg">
                                Log Out
                            </button>

                            <div id="logout-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                    <div class="flex justify-start items-center">
                                        <img class="w-[50px] h-[50px] rounded-full" src="{{ asset('images/bims-logo.png') }}" alt="barangay/lgu logo">
                                        <h3 class="text-lg font-bold text-center ml-3 text-red-500">Confirm Log Out</h3>
                                    </div>
                                    <p class="mb-6 mt-3 ml-4 text-gray-600">Are you sure you want to log out?</p>
                                    <div class="flex justify-end space-x-4">
                                        <button onclick="toggleModal()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                                            Cancel
                                        </button>
                            
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div id="content" class="flex-1 p-4">
                @include('lgu.profile.partials.update-profile-information-form') 
            </div>

            <footer>
                @include('templates.footer')
            </footer>
        </div>
    </div>
</body>
</html>
