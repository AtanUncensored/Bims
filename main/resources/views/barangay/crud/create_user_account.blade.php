@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-users fa-lg"></i>
@endsection

@section('title', 'Residents')

@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="py-4 px-6">
    @if(session('success'))
        <div class="alert alert-success p-2 mb-2 bg-green-100 text-green-800 rounded border border-green-300 text-center">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="form-container max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg relative">
        <h1 class="text-2xl text-center font-semibold mb-6 text-gray-800">Add Resident Information</h1>

        <form method="POST" action="{{ route('barangay.store-user') }}">
            @csrf
            <div class=" grid grid-cols-1 md:grid-cols-2 gap-6 max-h-[50vh] overflow-y-auto">
                <div class="container">
                    <div class="form-group">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
                        <input type="text" name="first_name" id="first_name" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('first_name') }}">
                        @error('first_name')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400" value="{{ old('last_name') }}">
                        @error('last_name')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name:</label>
                        <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        @error('middle_name')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="purok" class="block text-sm font-medium text-gray-700">Purok:</label>
                        <select name="purok" id="purok" value="{{ old('purok') }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                            <option value="">Select Purok</option>
                            @foreach ($puroks as $purok)
                                <option value="{{ $purok->id }}">Purok {{ $purok->purok_number }}</option>
                            @endforeach
                        </select>
                        @error('purok')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
                    
    
                    <div class="form-group">
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date:</label>
                        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        @error('birth_date')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth:</label>
                        <input type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth') }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        @error('place_of_birth')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
                        <select name="gender" id="gender" value="{{ old('gender') }}"class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        @error('gender')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status:</label>
                        <input type="text" name="civil_status" id="civil_status" value="{{ old('civil_status') }}"class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        @error('civil_status')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number:</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        @error('phone_number')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="citizenship" class="block text-sm font-medium text-gray-700">Citizenship:</label>
                        <input type="text" name="citizenship" id="citizenship" value="{{ old('citizenship') }}"class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        @error('citizenship')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="nickname" class="block text-sm font-medium text-gray-700">Nickname:</label>
                        <input name="nickname" id="nickname" value="{{ old('nickname') }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        @error('nickname')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        @error('email')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="current_address" class="block text-sm font-medium text-gray-700">Current Address:</label>
                        <input type="text" name="current_address" id="current_address" value="{{ old('current_address') }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        @error('current_address')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="permanent_address" class="block text-sm font-medium text-gray-700">Permanent Address:</label>
                        <input type="text" name="permanent_address" id="permanent_address" value="{{ old('permanent_address') }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        @error('permanent_address')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>
                    <div class="button-group flex justify-between ">
                        <a href="/residents" class="inline-block text-white bg-gray-600 hover:bg-gray-500 py-2 px-4 rounded transition">
                            Return
                        </a>
                        <button type="submit" class="btn btn-primary bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Add Resident</button>
                    </div>
                </div>

                <div class="container2">
                    <!-- Household Dropdown -->
                    <div class="form-group mt-5 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        <label for="household" class="block text-sm font-medium text-gray-700">Household:</label>
                        <select name="household" id="household" value="{{ old('household') }}" class="barangay-select form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400 dropdown-with-scroll" onchange="toggleHouseholdForm()">
                            <option value="">Select Household</option>
                            @foreach($households as $household)
                                <option value="{{ $household->id }}">{{ $household->household_name }}</option>
                            @endforeach
                            <option value="new" data-search="false">Create a New Household</option>
                        </select>
                        @error('household')
                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                         @enderror
                    </div>

                    <!-- New Household Form -->
                    <div id="new-household-form" style="display:none;" class="md:col-span-2">
                        <div class="form-group">
                            <label for="new_household_name" class="block text-sm font-medium text-gray-700">New Household Name:</label>
                            <input type="text" name="new_household_name" id="new_household_name" value="{{ old('new_household_name') }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400" >
                            @error('new_household_name')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Assign to User:</label>
                            <select name="user_id" id="user_id" value="{{ old('user_id') }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400 dropdown-with-scroll">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
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
            document.getElementById('new_household_name');
            document.getElementById('user_id');
        } else {
            newHouseholdForm.style.display = 'none';
            document.getElementById('new_household_name');
            document.getElementById('user_id');
        }
    }

    $(document).ready(function () {
        $('#household').select2({
            placeholder: "Search Household",
            allowClear: true,
            minimumInputLength: 1,
            dropdownParent: $('.form-container'),
            width: '100%',
            matcher: function (params, data) {
                // If there is no search term, return all data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Exclude the "Create a New Household" option from search
                if ($(data.element).data('search') === false) {
                    return null;
                }

                // Use the default matcher for other options
                return $.fn.select2.defaults.defaults.matcher(params, data);
            },
            language: {
                noResults: function () {
                    return `
                        <div style="text-align: center;">
                            <span style="color: red">No results found. You can create a new one!</span>
                            <button id="create-new-household" class="p-2 bg-blue-300 rounded mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-add-fill" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 1 1-1 0v-1h-1a.5.5 0 1 1 0-1h1v-1a.5.5 0 0 1 1 0"/>
                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                                <path d="m8 3.293 4.712 4.712A4.5 4.5 0 0 0 8.758 15H3.5A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                                </svg>
                            </button>
                        </div>
                    `;
                },
            },
            escapeMarkup: function (markup) {
                return markup; // Allows HTML rendering in the dropdown
            },
        });

        // Handle the "Create a New Household" button click
        $(document).on('click', '#create-new-household', function () {
            // Select the "Create a New Household" option
            $('#household').val('new').trigger('change');
            // Display the form
            toggleHouseholdForm();
            // Close the Select2 dropdown
            $('#household').select2('close');
        });
    });

    $(document).ready(function() {
            $('#user_id').select2({
            placeholder: "Search User",
            allowClear: true,
            minimumInputLength: 1,
            width: '100%',
            });
        });   


</script>
<style>
    .dropdown-with-scroll {
        max-height: 150px; /* Adjust as needed */
    }

    .dropdown-with-scroll option {
        padding: 10px;
    }
</style>

@endsection

