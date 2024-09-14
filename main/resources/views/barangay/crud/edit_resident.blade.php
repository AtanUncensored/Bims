@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-users fa-xl"></i>
@endsection

@section('title', 'Residents')

@section('content')
<div class="py-2 px-4 bg-white rounded">
    <h1 class="text-center font-semibold text-2xl text-blue-600">Edit Resident</h1>

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

    <form action="{{ route('barangay.residents.update', $resident->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="first_name" name="first_name" value="{{ old('first_name', $resident->first_name) }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="last_name" name="last_name" value="{{ old('last_name', $resident->last_name) }}" required>
        </div>

        <div class="form-group">
            <label for="middle_name">Middle Name:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="middle_name" name="middle_name" value="{{ old('middle_name', $resident->middle_name) }}">
        </div>

        <div class="form-group">
            <label for="purok">Purok:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="purok" name="purok" value="{{ old('purok', $resident->purok) }}">
        </div>

        <div class="form-group">
            <label for="birth_date">Birth Date:</label>
            <input type="date" class="form-control border border-gray-600 rounded" id="birth_date" name="birth_date" value="{{ old('birth_date', $resident->birth_date) }}">
        </div>

        <div class="form-group">
            <label for="place_of_birth">Place of Birth:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth', $resident->place_of_birth) }}">
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="gender" name="gender" value="{{ old('gender', $resident->gender) }}">
        </div>

        <div class="form-group">
            <label for="civil_status">Civil Status:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="civil_status" name="civil_status" value="{{ old('civil_status', $resident->civil_status) }}">
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="phone_number" name="phone_number" value="{{ old('phone_number', $resident->phone_number) }}">
        </div>

        <div class="form-group">
            <label for="citizenship">Citizenship:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="citizenship" name="citizenship" value="{{ old('citizenship', $resident->citizenship) }}">
        </div>

        <div class="form-group">
            <label for="nickname">Nickname:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="nickname" name="nickname" value="{{ old('nickname', $resident->nickname) }}">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control border border-gray-600 rounded" id="email" name="email" value="{{ old('email', $resident->email) }}">
        </div>

        <div class="form-group">
            <label for="current_address">Current Address:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="current_address" name="current_address" value="{{ old('current_address', $resident->current_address) }}">
        </div>

        <div class="form-group">
            <label for="permanent_address">Permanent Address:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="permanent_address" name="permanent_address" value="{{ old('permanent_address', $resident->permanent_address) }}">
        </div>

        <div class="flex justify-between mt-3">
            <a href="{{ route('barangay.residents.index') }}" class="py-2 px-4 bg-gray-600 text-white rounded">Return</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@endsection