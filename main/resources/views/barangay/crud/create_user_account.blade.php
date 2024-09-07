@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-users fa-xl"></i>
@endsection

@section('title', 'Residents')

@section('content')
<div class="py-2 px-4">

    @if(session('success'))
        <div class="alert alert-success p-2 mb-2 bg-green-100 text-green-800 rounded border border-green-300 text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-4 border border-gray-200 rounded-lg shadow-md">
        <form method="POST" action="{{ route('barangay.store-user') }}">
            @csrf
            <h1 class="text-xl text-center font-semibold mb-4">Resident Information</h1>

        <div class="max-h-[50vh] overflow-y-auto">
            <div class="form-group mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm" required>
            </div>

            <div class="form-group mb-4">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm" required>
            </div>

            <div class="form-group mb-4">
                <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name:</label>
                <input type="text" name="middle_name" id="middle_name" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
            </div>

            <div class="form-group mb-4">
                <label for="purok" class="block text-sm font-medium text-gray-700">Purok:</label>
                <input type="text" name="purok" id="purok" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
            </div>

            <div class="form-group mb-4">
                <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date:</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
            </div>

            <div class="form-group mb-4">
                <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth:</label>
                <input type="text" name="place_of_birth" id="place_of_birth" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
            </div>

            <div class="form-group mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
                <select name="gender" id="gender" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status:</label>
                <select name="civil_status" id="civil_status" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
                    <option value="">Select Civil Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Divorced">Divorced</option>
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
            </div>

            <div class="form-group mb-4">
                <label for="citizenship" class="block text-sm font-medium text-gray-700">Citizenship:</label>
                <input type="text" name="citizenship" id="citizenship" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
            </div>

            <div class="form-group mb-4">
                <label for="nickname" class="block text-sm font-medium text-gray-700">Nickname:</label>
                <input type="text" name="nickname" id="nickname" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
            </div>

            <div class="form-group mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" id="email" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
            </div>

            <div class="form-group mb-4">
                <label for="current_address" class="block text-sm font-medium text-gray-700">Current Address:</label>
                <input type="text" name="current_address" id="current_address" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
            </div>

            <div class="form-group mb-4">
                <label for="permanent_address" class="block text-sm font-medium text-gray-700">Permanent Address:</label>
                <input type="text" name="permanent_address" id="permanent_address" class="form-control mt-1 block w-full border border-gray-600 rounded-md shadow-sm">
            </div>
        </div>
        <div class="flex justify-between mt-3">
            <a href="/residents" class="inline-block text-white bg-gray-600 hover:bg-gray-500 py-2 px-4 rounded transition">
                Return
            </a>
            <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Resident</button>
        </div>
        </form>
    </div>
</div>
@endsection
