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
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .important-title {
            color: #ff3d00; 
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .post-event {
            margin-bottom: 15px;
            font-size: 16px;
        }
        .post-event a {
            color: #007bff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .post-event-icon {
            margin-left: 5px;
            width: 24px;
            height: 24px;
        }
        .recently-announced {
            font-size: 14px;
            margin-bottom: 20px;
            font-style: italic;
            color: #888;
            text-align: center;
        }
        .announcements-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .announcement-card {
            display: flex;
            overflow: hidden;
            border-radius: 8px;
            background-color: #f0f0f0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .announcement-image img {
            width: 200px;
            height: auto;
            object-fit: cover;
        }
        .announcement-details {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
        }
        .announcement-details h3 {
            margin: 0;
            font-size: 18px;
        }
        .btn-details {
            align-self: flex-end;
            padding: 6px 12px;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 10px;
        }
        .btn-details:hover {
            background-color: #0056b3;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-control,
        .form-control-file {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        //Log out modal ni
        function toggleModal() {
        const modal = document.getElementById('logout-modal');
        modal.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    <div id="main" class="flex h-screen">
        <!-- Sidebar ni -->
        <div id="sidebar" class="bg-blue-500 w-[250px] flex flex-col justify-between">
            <div>
                <!-- title ug logo -->
                <div id="branding" class="flex items-center py-1 px-2 space-x-4 ml-4">
                    <img class="w-[50px] h-[50px] rounded-full" src="{{ asset('images/' . Auth::user()->barangay->logo) }}" alt="barangay/lgu logo">

                    <div class="flex flex-col">
                        <h1 class="text-center text-[25px]" style="font-family: 'Roboto', sans-serif; font-weight: 900; color: white;">
                            BIMS
                        </h1>
                    </div>
                </div>
    
                <nav id="main-nav" class="space-y-2">
                    <hr class="border-t-2 border-gray-300">
                    <a href="{{ url('/barangay-dashboard') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('barangay-dashboard*') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-house fa-lg text-blue-800"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ url('/announcements/show') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('announcements/show') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-solid fa-bullhorn text-blue-800"></i>
                        <span>Announcements</span>
                    </a>
                    <a href="{{ url('/residents') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('residents') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-users fa-lg text-blue-800"></i>
                        <span>Residents</span>
                    </a>
                    <a href="{{ url('/residentUser') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('residentUser') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-user fa-lg text-blue-800"></i>
                        <span>Users</span>
                    </a>
                    <a href="{{ url('/complaints') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('complaints') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-regular fa-newspaper text-blue-800 font-bold"></i>
                        <span>Complaints</span>
                    </a>
                    <a href="{{ url('/logs') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('logs') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-solid fa-list text-blue-800 font-bold"></i>
                        <span>Logs</span>
                    </a>
                    <a href="{{ url('/reports') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('reports') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-solid fa-file-lines text-blue-800"></i>
                        <span>Budget Reports</span>
                    </a>
                    <a href="{{ url('/certificates') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('certificates') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-solid fa-certificate text-blue-800"></i>
                        <span>Certificates</span>
                    </a>
                    <a href="{{ url('/puroks') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('puroks') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-house fa-lg text-blue-800"></i>
                        <span>Puroks</span>
                    </a>
                </nav>                
            </div>
        </div>

        <div class="flex-1 flex flex-col">

            <!-- para sa Top Navigation Bar  -->
            <nav id="top-nav" class="flex justify-end items-center bg-white shadow-md h-[60px] px-4">
                @yield('icon')
                <h1 class="text-xl ml-2 text-gray-600"> @yield('title', 'Dashboard')</h1>
    
                <!--mau nig Logout Form -->
                <div class="flex items-center ml-auto">
                    <h1 class="mr-2 text-2xl font-bold transform scale-y-130">|</h1>    
                
                    <div id="user-dropdown" class="relative px-4 py-2 rounded-lg flex items-center">
                        <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
                            <span class="text-gray-600 font-semibold mr-3">{{ Auth::user()->name }}</span>
                            <div class="py-1 px-2 bg-black text-white rounded-full">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            
                        </button>
                
                        <div id="dropdown-content" class="hidden absolute right-0 mt-20 w-[100%] bg-white rounded-lg shadow-lg z-10">
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

<script>
    function toggleDropdown() {
    var dropdownContent = document.getElementById('dropdown-content');
    dropdownContent.classList.toggle('hidden');
}

</script>
