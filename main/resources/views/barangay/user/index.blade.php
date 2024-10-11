@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-user fa-lg"></i>
@endsection

@section('title', 'Residents Account')

@section('content')

<div class="records py-2 px-4 max-h-[80vh] overflow-y-auto">
    <h1 class="text-2xl font-bold text-green-600 uppercase">Head residents account:</h1>

    <hr class="border-t-2 mt-3 mb-4 border-gray-300">

    @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-1 px-2 rounded mb-2 mt-2">
            {{ session('success') }}
        </div>
        @endif

    <div class="flex justify-between items-center mb-4">
        <div class="text-gray-500 font-semibold my-2 mx-[65px]">
        </div>
        <form class="inline-flex items-center justify-center" method="GET" action="{{ route('barangay.user.index') }}">
            <input type="text" name="search" placeholder="Search a user..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500">
            <button type="submit" class="py-2 px-4 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <a href="{{ route('barangay.user.createUser')}}" class="py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-500">
            <i class="fa-solid fa-plus"></i> Add New User
        </a>
    </div>

    <div class="flex justify-center items-center bg-gray-600 py-3 shadow-xl px-6 font-semibold text-white uppercase mb-3  text-[12px]">
        List of users
    </div>
    <div class="mx-auto px-4 max-h-[50vh] overflow-y-auto">
        <div class="flex flex-wrap -mx-4">
            @foreach($users as $user)
                <div class="w-full md:w-[330px] px-4 mb-4">
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <div class="mb-4">
                            <h2 class="text-[15px] font-bold text-gray-600">Name: {{ $user->name }}</h2>
                            <h2 class="text-[15px] font-bold text-gray-600">Email: <span class="text-blue-600">{{ $user->email }}</span> </h2>
                        </div>
                        <hr class="border-t-2 border-gray-400">
                        <div class="mt-4 flex justify-end items-center text-blue-600">
                            <div class="text-gray-600 font-semibold">
                                <p>Actions:</p>
                            </div>
                            <div class="py-2 px-4 rounded-lg">
                                <a href="{{ route('barangay.user.edit', $user) }}"><i class="fas fa-pen fa-lg text-blue-600"></i></a> 
                            </div>
                            <div>
                                <button type="submit"><i class="fas fa-trash fa-lg text-red-600"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
