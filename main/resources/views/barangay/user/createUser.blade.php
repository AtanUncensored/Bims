@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-user fa-lg"></i>
@endsection

@section('title', 'Create Residents Account')

@section('content')

<div class="py-4 px-6">

    <h1 class="text-2xl font-bold text-blue-600 text-center">Create Resident Account</h1>

    <div class="max-h-[80vh] overflow-y-auto">
        @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-1 px-2 rounded mb-2 mt-2">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="mt-[20px] mb-4 max-w-lg mx-auto bg-white p-8 rounded shadow">
            <form action="{{ route('barangay.storeResidentUser') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('password') }}">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end items-center">
                    <div class="mb-4">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-3">Create Account</button>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('barangay.user.index') }}" class="inline-block align-baseline font-bold text-lg text-blue-600 hover:text-blue-800">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
