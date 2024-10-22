<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barangay Information Management System</title>
    <script src="{{ asset('/js/tailwind.min.js') }}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="{{ asset('images/bims-logo.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap" rel="stylesheet">
    
    <style>
        .new-amsterdam-regular {
            font-family: "New Amsterdam", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        header {
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        header nav ul {
            list-style: none;
            padding: 0;
        }
        header nav ul li {
            display: inline;
            margin: 0 10px;
        }
        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
    <script>
        function toggleModal() {
            const modal = document.getElementById('logout-modal');
            modal.classList.toggle('hidden');
        }

        function toggleDropdown() {
            var dropdownContent = document.getElementById('dropdown-content');
            dropdownContent.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    <div id="main" class="flex flex-col md:flex-row h-screen">
        <div class="flex-1 flex flex-col">

            <!-- Top Navigation Bar -->
            <nav id="top-nav" class="flex justify-between items-center bg-white shadow-md h-[60px] px-4">
                <div class="flex items-center">
                    <img class="w-[50px] h-[50px] rounded-full" src="{{asset('images/bims-logo.png')}}" alt="BIMS logo">
                    <h1 class="text-center text-[25px] text-blue-400 ml-3 font-bold">
                        BIMS
                    </h1>
                </div>

                <!-- Logout Dropdown -->
                <div id="user-dropdown" class="relative px-4 py-2 rounded-lg flex items-center">
                    <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
                        <span class="text-gray-600 font-semibold mr-3">{{ Auth::user()->name }}</span>
                        <div class="py-1 px-2 bg-black text-white rounded-full">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                    </button>

                    <div id="dropdown-content" class="hidden absolute right-0 mt-[77px] w-[100%] bg-white rounded-lg shadow-lg z-10">
                        <button onclick="toggleModal()" class="w-full text-left px-4 py-2 text-red-700 hover:bg-gray-100 rounded-lg">
                            Log Out
                        </button>

                        <div id="logout-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                <div class="flex items-center">
                                    <img class="w-[50px] h-[50px] rounded-full" src="{{ asset('images/bims-logo.png') }}" alt="barangay/lgu logo">
                                    <h3 class="text-lg font-bold text-center mt-3 ml-3 text-red-500">Confirm Log Out</h3>
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
            </nav>

            <!-- Main Content -->
            <div id="content" class="flex flex-col md:flex-row flex-1">
                <div id="sidebar" class="bg-gray-100 w-full md:w-[250px] mt-5 flex flex-col justify-between">
                    <nav id="main-nav" class="space-y-2 py-2 px-4">
                        <a href="{{ url('/lgu') }}" class="flex rounded-[25px] font-bold text-xl items-center space-x-2 px-4 py-2 {{ Request::is('user-dashboard*') ? 'bg-blue-200 text-blue-900' : 'text-gray-800' }} hover:bg-blue-200 hover:text-blue-900">
                            <span><i class="fa-solid fa-arrow-left"></i> Dashboard</span>
                        </a>
                        <hr class="border-t-2 mt-3 mb-4 border-gray-300">
                        <p class="flex rounded-[25px] font-bold items-center space-x-2 px-4 py-3 text-blue-900">
                            <span>Profile Information</span>
                        </p>
                        <p class="flex rounded-[25px] font-bold items-center space-x-2 px-4 py-3 text-blue-900">
                            <span>Password Change</span>
                        </p>
                        <p class="flex rounded-[25px] font-bold items-center space-x-2 px-4 py-3 text-blue-900">
                            <span>Account Management</span>
                        </p>
                    </nav>                
                </div>
                <div class="flex-1 py-2 px-4 mt-3">
                    <div class="py-4 px-6 rounded-lg shadow-lg bg-white">
                        @include('lgu.profile.partials.update-profile-information-form') 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
