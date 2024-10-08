@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user-shield fa-lg text-black mr-1"></i>
@endsection

@section('title', 'Edit Barangay Admin')

@section('content')
<div class="edit-barangay-admin py-2 px-4">
    <div id="title" class="py-2 px-4 mt-[15px]">
        <h1 class="text-2xl font-bold text-blue-600 text-center">Edit Barangay Administrator</h1>
    </div>

    <div class="my-4">
        <hr class="border-t-2 m-[15px] border-gray-300">
    </div>

    <!-- Edit Form -->
    <div class="mt-[20px] mb-6 max-w-lg mx-auto bg-white p-8 rounded shadow">
        <form action="{{ route('lgu.admins-crud.update-barangay-admin', $adminUser) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $adminUser->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $adminUser->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="barangay_id" class="block text-gray-700 text-sm font-bold mb-2">Assigned Barangay:</label>
                <select name="barangay_id" id="barangay_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('barangay_id') border-red-500 @enderror">
                    <option value="">Select a Barangay</option>
                    @foreach ($barangays as $barangay)
                        <option value="{{ $barangay->id }}" {{ old('barangay_id', $adminUser->barangay_id) == $barangay->id ? 'selected' : '' }}>
                            {{ $barangay->barangay_name }}
                        </option>
                    @endforeach
                </select>
                @error('barangay_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-3">
                    Update Admin
                </button>
                <a href="{{ route('lgu.admins') }}" class="inline-block align-baseline font-bold text-lg text-blue-600 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
