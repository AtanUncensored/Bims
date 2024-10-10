@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-user fa-lg"></i>
@endsection

@section('title', 'Update Residents Account')

@section('content')

<div class="edit-user-account py-2 px-4">
        <h1 class="text-2xl font-bold text-blue-600 text-center">Edit Resident Account</h1>
    
        <!-- Edit Form -->
        <div class="mt-[20px] mb-6 max-w-lg mx-auto bg-white p-8 rounded shadow">
            <form action="{{ route('barangay.user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
    
               <!-- Name -->
               <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border rounded-md" value="{{ old('name', $user->name) }}">
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="email" id="email" class="w-full p-2 border rounded-md" value="{{ old('email', $user->email) }}">
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-3">
                        Update User
                    </button>
                    <a href="{{ route('barangay.user.index') }}" class="inline-block align-baseline font-bold text-lg text-blue-600 hover:text-blue-800">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
</div>

@endsection