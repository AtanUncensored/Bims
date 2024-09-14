@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-users fa-xl"></i>
@endsection

@section('title', 'Residents')

@section('content')
<div class="py-2 px-4 bg-white rounded">
    <h1 class="text-center font-semibold text-2xl text-blue-600">Resident Details</h1>

    @if (session('success'))
        <div class="alert alert-success p-2 mt-2 mb-2 bg-green-100 text-green-800 rounded border border-green-300 text-center">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="space-y-4">
        <div>
            <strong>First Name:</strong> {{ $resident->first_name }}
        </div>
        <div>
            <strong>Last Name:</strong> {{ $resident->last_name }}
        </div>
        <div>
            <strong>Middle Name:</strong> {{ $resident->middle_name }}
        </div>
        <div>
            <strong>Purok:</strong> {{ $resident->purok }}
        </div>
        <div>
            <strong>Birth Date:</strong> {{ $resident->birth_date }}
        </div>
        <div>
            <strong>Place of Birth:</strong> {{ $resident->place_of_birth }}
        </div>
        <div>
            <strong>Gender:</strong> {{ $resident->gender }}
        </div>
        <div>
            <strong>Civil Status:</strong> {{ $resident->civil_status }}
        </div>
        <div>
            <strong>Phone Number:</strong> {{ $resident->phone_number }}
        </div>
        <div>
            <strong>Citizenship:</strong> {{ $resident->citizenship }}
        </div>
        <div>
            <strong>Nickname:</strong> {{ $resident->nickname }}
        </div>
        <div>
            <strong>Email:</strong> {{ $resident->email }}
        </div>
        <div>
            <strong>Current Address:</strong> {{ $resident->current_address }}
        </div>
        <div>
            <strong>Permanent Address:</strong> {{ $resident->permanent_address }}
        </div>
    </div>

    <div class="flex justify-between mt-4">
        <a href="{{ route('barangay.residents.index') }}" class="py-2 px-4 bg-gray-600 text-white rounded">Back to List</a>
    </div>
</div>
@endsection