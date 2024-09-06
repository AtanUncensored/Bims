@extends('barangay.templates.navigation-bar')

@section('content')
<div class="container">
    <h2>Create Resident</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('barangay.store-user') }}">
        @csrf
        <div class="container">
            <h1>Add New Resident</h1>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                </div>
        
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                </div>
        
                <div class="form-group">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="purok">Purok:</label>
                    <input type="text" name="purok" id="purok" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="birth_date">Birth Date:</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="place_of_birth">Place of Birth:</label>
                    <input type="text" name="place_of_birth" id="place_of_birth" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <label for="civil_status">Civil Status:</label>
                    <select name="civil_status" id="civil_status" class="form-control">
                        <option value="">Select Civil Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="citizenship">Citizenship:</label>
                    <input type="text" name="citizenship" id="citizenship" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="nickname">Nickname:</label>
                    <input type="text" name="nickname" id="nickname" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="current_address">Current Address:</label>
                    <input type="text" name="current_address" id="current_address" class="form-control">
                </div>
        
                <div class="form-group">
                    <label for="permanent_address">Permanent Address:</label>
                    <input type="text" name="permanent_address" id="permanent_address" class="form-control">
                </div>
        
                <button type="submit" class="btn btn-primary">Add Resident</button>
        </div>
    </form>
</div>
@endsection
