@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-users fa-lg"></i>
@endsection

@section('title', 'Residents')

@section('content')
<div class="py-4 px-6">
    @if(session('success'))
        <div class="alert alert-success p-2 mb-2 bg-green-100 text-green-800 rounded border border-green-300 text-center">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl text-center font-semibold mb-6 text-gray-800">Add Resident Information</h1>

        <form method="POST" action="{{ route('barangay.store-user') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="form-group">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
                    <input type="text" name="first_name" id="first_name" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400" required>
                </div>

                <div class="form-group">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400" required>
                </div>

                <div class="form-group">
                    <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name:</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="form-group">
                    <label for="purok" class="block text-sm font-medium text-gray-700">Purok:</label>
                    <input type="text" name="purok" id="purok" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="form-group">
                    <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date:</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="form-group">
                    <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth:</label>
                    <input type="text" name="place_of_birth" id="place_of_birth" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="form-group">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
                    <select name="gender" id="gender" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status:</label>
                    <input type="text" name="civil_status" id="civil_status" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="form-group">
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number:</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="form-group">
                    <label for="citizenship" class="block text-sm font-medium text-gray-700">Citizenship:</label>
                    <input type="text" name="citizenship" id="citizenship" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="form-group">
                    <label for="nickname" class="block text-sm font-medium text-gray-700">Nickname:</label>
                    <input type="text" name="nickname" id="nickname" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="form-group">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" name="email" id="email" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="form-group">
                    <label for="current_address" class="block text-sm font-medium text-gray-700">Current Address:</label>
                    <input type="text" name="current_address" id="current_address" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <div class="form-group">
                    <label for="permanent_address" class="block text-sm font-medium text-gray-700">Permanent Address:</label>
                    <input type="text" name="permanent_address" id="permanent_address" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                </div>

                <!-- Household Dropdown -->
                <div class="form-group md:col-span-2">
                    <label for="household" class="block text-sm font-medium text-gray-700">Household:</label>
                    <select name="household" id="household" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400" onchange="toggleHouseholdForm()">
                        <option value="">Select Household</option>
                        @foreach($households as $household)
                            <option value="{{ $household->id }}">{{ $household->household_name }}</option>
                        @endforeach
                        <option value="new">Create a New Household</option>
                    </select>
                </div>

                <!-- New Household Form -->
                <div id="new-household-form" style="display:none;" class="md:col-span-2">
                    <div class="form-group">
                        <label for="new_household_name" class="block text-sm font-medium text-gray-700">New Household Name:</label>
                        <input type="text" name="new_household_name" id="new_household_name" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400" required>
                    </div>

                    <div class="form-group">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Assign to User:</label>
                        <select name="user_id" id="user_id" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <a href="/residents" class="inline-block text-white bg-gray-600 hover:bg-gray-500 py-2 px-4 rounded transition">
                    Return
                </a>
                <button type="submit" class="btn btn-primary bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Add Resident</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleHouseholdForm() {
        const householdSelect = document.getElementById('household');
        const newHouseholdForm = document.getElementById('new-household-form');

        if (householdSelect.value === 'new') {
            newHouseholdForm.style.display = 'block';
            document.getElementById('new_household_name').setAttribute('required', 'required');
            document.getElementById('user_id').setAttribute('required', 'required');
        } else {
            newHouseholdForm.style.display = 'none';
            document.getElementById('new_household_name').removeAttribute('required');
            document.getElementById('user_id').removeAttribute('required');
        }
    }
</script>
@endsection
