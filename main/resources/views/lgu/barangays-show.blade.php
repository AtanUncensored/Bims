@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user fa-lg text-black mr-1"></i>
@endsection

@section('title', 'Barangay Details')

@section('content')
<div class="px-4">
    <div class="flex justify-start items-center mb-2">
        @if ($barangay->logo)
            <img src="{{ asset('images/' . $barangay->logo) }}" alt="Logo" class="w-[50px] h-[50px] object-cover rounded-full">
        @else
            <span>No Logo</span>
        @endif
        <h2 class="text-2xl text-blue-500 font-bold ml-2">Brgy. {{ $barangay->barangay_name }}, Tubigon, Bohol, Philippines</h2>
    </div>
    <hr class="border-t-2 border-gray-300">
    <div class="flex justify-between item-center mb-3 mt-5">
        <h2 class="font-semibold mb-2">Current record of this barangay:</h2>
        <a href="{{ route('lgu.barangays-list') }}" class="inline-block text-white bg-blue-600 hover:bg-blue-500 py-2 px-4 rounded font-semibold transition">
            Back to List
        </a>
    </div>
    
    <!-- Dynamic Residents Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Residents Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <i class="fa-solid fa-user fa-lg text-blue-500"></i>
                <h3 class="text-lg font-semibold ml-4">Residents</h3>
            </div>
            <p class="text-2xl font-semibold text-right text-green-600 mt-4"><span class="text-gray-500 text-[15px]">Total:</span> {{ $totalUsers }}</p>
        </div>

        <!-- Males Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <i class="fa-solid fa-person fa-2xl text-blue-500"></i>
                <h3 class="text-lg font-semibold ml-4">Males</h3>
            </div>
            <p class="text-2xl font-semibold text-right text-green-600 mt-4"><span class="text-gray-500 text-[15px]">Total:</span> {{ $totalMales }}</p>
        </div>

        <!-- Females Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <i class="fa-solid fa-person-dress fa-2xl text-blue-500"></i>
                <h3 class="text-lg font-semibold ml-4">Females</h3>
            </div>
            <p class="text-2xl font-semibold text-right text-green-600 mt-4"><span class="text-gray-500 text-[15px]">Total:</span> {{ $totalFemales }}</p>
        </div>

        <!-- Adults Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <i class="fa-solid fa-user-tie fa-xl text-blue-500"></i>
                <h3 class="text-lg font-semibold ml-4">Adults</h3>
            </div>
            <p class="text-2xl font-semibold text-right text-green-600 mt-4"><span class="text-gray-500 text-[15px]">Total:</span> {{ $totalAdults }}</p>
        </div>

        <!-- Seniors Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <i class="fa-solid fa-user-tie fa-xl text-blue-500"></i>
                <h3 class="text-lg font-semibold ml-4">Seniors</h3>
            </div>
            <p class="text-2xl font-semibold text-right text-green-600 mt-4"><span class="text-gray-500 text-[15px]">Total:</span> {{ $totalSeniors }}</p>
        </div>

        <!-- Youth Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <i class="fa-solid fa-user fa-lg text-blue-500"></i>
                <h3 class="text-lg font-semibold ml-4">Youth</h3>
            </div>
            <p class="text-2xl font-semibold text-right text-green-600 mt-4"><span class="text-gray-500 text-[15px]">Total:</span> {{ $totalYouth }}</p>
        </div>

        <!-- Children Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <i class="fa-solid fa-user fa-lg text-blue-500"></i>
                <h3 class="text-lg font-semibold ml-4">Children</h3>
            </div>
            <p class="text-2xl font-semibold text-right text-green-600 mt-4"><span class="text-gray-500 text-[15px]">Total:</span> {{ $totalChildren }}</p>
        </div>

        <!-- Households Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <i class="fa-solid fa-house-chimney-user fa-lg text-blue-500"></i>
                <h3 class="text-lg font-semibold ml-4">Households</h3>
            </div>
            <p class="text-2xl font-semibold text-right text-green-600 mt-4"><span class="text-gray-500 text-[15px]">Total:</span> {{ $totalUsers }}</p>
        </div>

         <!-- Married Card -->
         <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <i class="fa-solid fa-person fa-2xl text-blue-500"></i>
                <i class="fa-solid fa-person-dress fa-2xl text-blue-500"></i>
                <h3 class="text-lg font-semibold ml-4">Married</h3>
            </div>
            <p class="text-2xl font-semibold text-right text-green-600 mt-4"><span class="text-gray-500 text-[15px]">Total:</span> 0</p>
        </div>
    </div>
</div>
@endsection
