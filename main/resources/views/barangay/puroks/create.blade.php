@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-house fa-lg"></i>
@endsection

@section('title', 'Puroks')

@section('content')
<h1 class="text-center font-semibold text-2xl text-blue-600">Add New Purok</h1>

<form action="{{ route('barangay.purok.storePurok') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="purok_name">Purok_Name:</label>
        <input type="text" class="form-control border border-gray-600 rounded" id="purok_name" name="purok_name" required>
    </div>
    <div class="form-group">
        <label for="purok_number">Purok_Number:</label>
        <input type="number" class="form-control border border-gray-600 rounded" id="purok_number" name="purok_number" required>
    </div>

    <div class="flex justify-between mt-3">
        <a href="/puroks" class="py-2 px-4 bg-gray-600 text-white rounded">Return</a>
         <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection