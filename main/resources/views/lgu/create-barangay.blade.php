@extends('lgu.lgu-template.navigation-bar')

@section('title', 'Create Barangay')

@section('content')
<div class="px-4 py-6">
    <h2 class="text-2xl font-bold text-blue-500 mb-4">Create New Barangay</h2>
    <form action="{{ route('lgu.store-barangay') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <!-- Barangay Name -->
        <div class="mb-4">
            <label for="barangay_name" class="block text-gray-700 font-bold">Barangay Name</label>
            <input type="text" id="barangay_name" name="barangay_name" 
                   class="w-full mt-2 p-2 border rounded focus:outline-blue-500" 
                   value="{{ old('barangay_name') }}" required>
            @error('barangay_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Logo -->
        <div class="mb-4">
            <label for="logo" class="block text-gray-700 font-bold">Barangay Logo</label>
            <input type="file" id="logo" name="logo" 
                   class="w-full mt-2 p-2 border rounded focus:outline-blue-500">
            @error('logo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Background Image -->
        <div class="mb-4">
            <label for="background_image" class="block text-gray-700 font-bold">Background Image</label>
            <input type="file" id="background_image" name="background_image" 
                   class="w-full mt-2 p-2 border rounded focus:outline-blue-500">
            @error('background_image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none">
                Create Barangay
            </button>
        </div>
    </form>
</div>
@endsection
