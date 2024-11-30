@extends('barangay.templates.navigation-bar')

@section('title', 'Residents Account')

@section('content')

<div class="record px-4">

    <div class="bg-white py-2 px-4 rounded-lg shadow-lg mb-4 max-h-[15vh] overflow-y-auto">
        <h1 class="text-xl font-bold text-blue-500 mb-3 uppercase">look for a user account:</h1>

        @if(session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2 mt-2">
                    {{ session('success') }}
                </div>
            @endif

        <div class="flex justify-center items-center">
            <form class="inline-flex items-center justify-center" method="GET" action="{{ route('barangay.user.index') }}">
                <input type="text" name="search" placeholder="Search a user..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500">
                <button type="submit" class="py-2 px-4 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <div class="bg-white py-2 px-4 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">

            <div class="flex justify-start items-center">
                <h1 class="text-xl font-bold text-blue-500 mb-3 uppercase">residents account:</h1>
            </div>
        
                <div class="flex justify-end items-center">
                    <button class="relative text-red-600 hover:text-red-800 rounded-lg group">
                        <span class="font-bold">Caution <i class="fa-solid fa-triangle-exclamation"></i></span>
                        <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 hidden group-hover:block bg-white text-red-600 text-sm py-2 px-4 rounded shadow-lg w-64">
                            <strong>Reminder:</strong> You can only delete a user if there is a login-related issue. Please ensure that you have verified the problem before proceeding with the deletion.
                        </div>
                    </button> 
                    <a href="{{ route('barangay.user.createUser')}}" class="py-2 px-4 bg-blue-600 text-white ml-3 rounded hover:bg-blue-500">
                        <i class="fa-solid fa-plus"></i> User Account
                    </a>
                </div>
        </div>
    
        <div class="flex justify-center items-center bg-gray-600 py-3 shadow-xl px-6 font-semibold text-white uppercase mb-3 text-[12px]">
            List of available users from this barangay
        </div>
        <div class="mx-auto px-4 max-h-[43vh] overflow-y-auto">  
            <div class="flex flex-wrap -mx-4">
                @if($users->count() > 0)
                @foreach($users as $user)
                    <div class="w-full md:w-[330px] px-4 mb-4">
                        <div class="border border-gray-200 border-[2px] rounded-lg p-6"> 
                            <div class="mb-4">
                                <h2 class="text-[15px] font-bold text-gray-600">Name: {{ $user->name }}</h2>
                                <h2 class="text-[15px] font-bold text-gray-600">Email: <span class="text-blue-600">{{ $user->email }}</span> </h2>
                            </div>
                            <hr class="border-t-2 border-gray-300">
                            <div class="mt-4 flex justify-end items-center text-blue-600">
                                <div class="text-gray-600 font-semibold">
                                    <p>Actions:</p>
                                </div>                        
                                <div>
                                    <button onclick="toggleDeleteModal('{{ $user->id }}')" class="text-red-700 py-1 px-2 md:px-3 rounded hover:text-red-900">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    
                                     <!-- Delete Modal ni dere same sa log out nga layout -->
                                    <div id="delete-modal-{{ $user->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                                        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                            <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">User: <span class="text-blue-600">{{ $user->name}}</span></p>
                                            <hr class="border-t-2 mt-3 mb-4 border-gray-300">
    
                                            <p class="mb-5 mt-3 text-gray-600 text-left text-[17px]">Continue to delete this User?</p>
                                            
                                            <div class="flex justify-end space-x-4">
                                                <button onclick="toggleDeleteModal('{{ $user->id }}')" class="hover:text-gray-400">
                                                    Cancel
                                                </button>
                                    
                                                <form action="{{ route('barangay.user.index.delete', ['user_id' => $user->id]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="py-2 px-4 text-red-800 hover:text-red-400">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="w-full text-center text-gray-500">
                        <p>No users found for this barangay.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
        function toggleDeleteModal(userId) {
            const modal = document.getElementById(`delete-modal-${userId}`);
            modal.classList.toggle('hidden');
        }
</script>

@endsection
