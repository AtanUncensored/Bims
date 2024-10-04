@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user fa-lg text-black mr-1"></i>
@endsection

@section('title', 'Edit Barangay')

@section('content')
<div class="py-2 px-4">
    <div id="title" class="py-2 px-4 mt-[15px]">
        <h1 class="text-2xl font-bold text-blue-600 text-center">Edit Barangay Details</h1>
    </div>

    <div class="my-4">
        <hr class="border-t-2 m-[15px] border-gray-300">
    </div>
    
    <!-- Edit Form -->
    <div class="mt-[20px] mb-6 max-w-lg mx-auto bg-white p-8 rounded shadow">
        <form action="{{ route('lgu.barangays-update', $barangay->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Logo:</label>
                <input type="file" id="logo" name="logo" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" accept="image/*">
                @error('logo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="barangay_name" class="block text-gray-700 text-sm font-bold mb-2">Barangay Name:</label>
                <input type="text" id="barangay_name" name="barangay_name" value="{{ old('barangay_name', $barangay->barangay_name) }}" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                @error('barangay_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="background_image" class="block text-gray-700 text-sm font-bold mb-2">Background Image:</label>
                <input type="file" id="background_image" name="background_image" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" accept="image/*">
                @error('background_image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-between">
                <div class="mb-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Barangay</button>
                </div>
        
                <div class="mb-4">
                    <a href="{{ route('lgu.barangays-list') }}" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                        Back to List
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
