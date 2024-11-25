@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-house fa-lg"></i>
@endsection

@section('title', 'Puroks')

@section('content')

<form action="{{ route('barangay.purok.storePurok') }}" method="POST">
    @csrf

    <div class="py-4 px-4 bg-white rounded w-80 mx-auto">
        
        <h1 class="text-center font-semibold text-2xl text-blue-600">Add New Purok</h1>
        @if (session('success'))
            <div class="alert alert-success p-2 mt-2 mb-2 bg-green-100 text-green-800 rounded border border-green-300 text-center">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->has('error'))
        <div class="alert alert-danger p-2 mt-2 mb-2 bg-red-100 text-red-800 rounded border border-red-300 text-center">
            {{ $errors->first('error') }}
        </div>
    @endif
    
        <br>
        <div class="form-group">
            <label for="purok_name">Purok_Name:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="purok_name" name="purok_name" value="{{ old('purok_name')}}">
            @error('purok_name')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="purok_number">Purok_Number:</label>
            <input type="number" class="form-control border border-gray-600 rounded" id="purok_number" name="purok_number" value="{{ old('purok_number')}}">
            @error('purok_number')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="flex justify-between mt-3">
            <a href="/puroks" class="py-2 px-4 bg-gray-600 text-white rounded">Return</a>
             <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection