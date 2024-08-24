@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user fa-2x text-black mr-3"></i>
@endsection

@section('title', 'Edit Barangay')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Barangay Details</h2>
    
    <!-- Edit Form -->
    <form action="{{ route('lgu.barangays-update', $barangay->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
            <input type="file" id="logo" name="logo" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" accept="image/*">
            @error('logo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="barangay_name" class="block text-sm font-medium text-gray-700">Barangay Name</label>
            <input type="text" id="barangay_name" name="barangay_name" value="{{ old('barangay_name', $barangay->barangay_name) }}" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            @error('barangay_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="background_image" class="block text-sm font-medium text-gray-700">Background Image</label>
            <input type="file" id="background_image" name="background_image" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" accept="image/*">
            @error('background_image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Update Barangay</button>
        </div>
    </form>
</div>
@endsection
