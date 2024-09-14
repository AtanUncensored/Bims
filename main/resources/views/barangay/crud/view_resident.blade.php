@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-users fa-xl"></i>
@endsection

@section('title', 'Residents')

@section('content')
<div class="py-6 px-8 bg-white rounded-lg shadow-lg">
    <h1 class="font-bold text-3xl text-blue-600 text-center mb-6">Resident Details</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg border border-green-300 text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded-lg border border-red-300 mb-4">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p class="text-blue-500 font-semibold text-2xl">{{ $resident->last_name}}, {{ $resident->first_name}}</p>
    <hr class="border-t-2 mt-3 mb-4 border-gray-300">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="info1 space-y-4">
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">First Name:</span>
                <span class="text-gray-800">{{ $resident->first_name }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Last Name:</span>
                <span class="text-gray-800">{{ $resident->last_name }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Middle Name:</span>
                <span class="text-gray-800">{{ $resident->middle_name }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Purok:</span>
                <span class="text-gray-800">{{ $resident->purok }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Birth Date:</span>
                <span class="text-gray-800">{{ $resident->birth_date }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Place of Birth:</span>
                <span class="text-gray-800">{{ $resident->place_of_birth }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Gender:</span>
                <span class="text-gray-800">{{ $resident->gender }}</span>
            </div>
        </div>

        <div class="info2 space-y-4">
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Civil Status:</span>
                <span class="text-gray-800">{{ $resident->civil_status }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Phone Number:</span>
                <span class="text-gray-800">{{ $resident->phone_number }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Citizenship:</span>
                <span class="text-gray-800">{{ $resident->citizenship }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Nickname:</span>
                <span class="text-gray-800">{{ $resident->nickname }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Email:</span>
                <span class="text-gray-800">{{ $resident->email }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Current Address:</span>
                <span class="text-gray-800">{{ $resident->current_address }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Permanent Address:</span>
                <span class="text-gray-800">{{ $resident->permanent_address }}</span>
            </div>
        </div>
    </div>

    <div class="flex justify-center mt-6">
        <a href="{{ route('barangay.residents.index') }}" class="py-2 px-6 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition ease-in-out duration-150">
            Back to List
        </a>
    </div>
</div>
@endsection
