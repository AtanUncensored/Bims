@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user-shield fa-2x text-black mr-3"></i>
@endsection

@section('title', 'Assign Barangay Admin')

@section('content')
<div class="p-4">
    <h2 class="text-2xl text-green-700 font-bold mb-4">Create Barangay Admin</h2>
    
    <!-- Success message ni dere -->
    @if(session('success'))
    <div class="bg-green-500 text-white py-2 px-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <!-- Create Form para sa admin sa kada barangay -->
    <form method="POST" action="{{ route('lgu.store-barangay-admin') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-4 w-full">
        @csrf

        <div class="mb-4">
            <label for="barangay_id" class="block text-sm font-medium text-gray-700">Select Barangay</label>
            <select name="barangay_id" id="barangay_id" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                @foreach($barangays as $barangay)
                    <option value="{{ $barangay->id }}">{{ $barangay->barangay_name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create Barangay</button>
        </div>
    </form>

    <!-- Route back to Barangay admin -->
    <div class="mt-6">
        <a href="{{ route('lgu.admins') }}" class="inline-block text-white bg-gray-600 hover:bg-gray-500 py-2 px-4 rounded font-semibold transition">
            Back to Admins
        </a>
    </div>
</div>
@endsection
