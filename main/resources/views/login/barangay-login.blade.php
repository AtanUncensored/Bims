@extends('templates.top-nav')

@section('content')
<style>
    body {
        background-image: url('{{ asset('images/' . ($barangay->background_image ?? 'default-bg.jpg')) }}');
        background-size: cover;
        background-position: center;
    }
</style>
     <div class="flex items-center justify-center mt-[100px]">
        <div class="bg-gray-300 p-4 rounded-lg shadow-lg bg-opacity-60 w-full max-w-md">
            <div class="flex items-center justify-center mb-6">
                <div class="logo mr-4">
                    <img src="{{ asset('images/' . ($barangay->logo)) }}" alt="{{ $barangay->barangay_name}} logo" class="w-[50px] h-[50px] rounded-full">
                </div>
                <h2 class="text-xl font-bold text-blue-600">
                    Brgy. {{ $barangay->barangay_name}}, Tubigon, Bohol
                </h2>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mt-4 flex items-center">
                    <label for="email" class="text-sm font-bold text-start text-gray-700 mb-1 w-1/3 rounded">Email: </label>
                    <input id="email" class="block w-full border-gray-300 dark:border-gray-700 text-black py-1 px-2 shadow-sm" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    @error('email')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4 flex items-center">
                    <label for="password" class="text-sm font-bold text-start text-gray-700 mb-1 w-1/3 rounded">Password: </label>
                    <input id="password" class="block w-full border-gray-300 dark:border-gray-700 text-black py-1 px-2 shadow-sm" type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-center justify-center mt-6">
                    <button type="submit" class="inline-flex items-center font-bold px-4 py-2 bg-blue-600 rounded">
                        Login
                    </button>
                </div>
            </form>        
        </div>
    </div>
@endsection