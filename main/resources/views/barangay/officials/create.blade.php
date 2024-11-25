@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-user-plus fa-lg"></i>
@endsection

@section('title', 'Barangay Official')

@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<h1 class="text-2xl font-bold text-blue-600 text-center mb-3">Add Barangay Official</h1>
<div class="max-h-[70vh] overflow-y-auto">

    <div class="mb-4 max-w-lg mx-auto bg-white p-8 rounded shadow">
        <form action="{{ route('barangay.officials.store') }}" method="POST">
            @csrf
              <!-- Resident Dropdown with Search -->
              <div class="mb-4">
                @if(session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-1 px-2 rounded mt-2">
                    {{ session('success') }}
                </div>
                @endif
              </div>
              <div class="mb-4">
                <label for="resident_id" class="block text-gray-700 text-sm font-bold mb-2">Select Resident</label>
                <select name="resident_id" id="resident_id" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="">Select a resident</option>
                    @foreach($residents as $resident)
                        <option value="{{ $resident->id }}">{{ $resident->first_name }} {{ $resident->last_name }}</option>
                    @endforeach
                </select>
                @error('resident_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Position</label>
                <input type="text" id="position" name="position" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" >
                @error('position')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="committee" class="block text-gray-700 text-sm font-bold mb-2">Committee</label>
                <input type="text" id="committee" name="committee" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" >
                @error('committee')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="start_of_service" class="block text-gray-700 text-sm font-bold mb-2">Start of Service</label>
                <input type="date" id="start_of_service" name="start_of_service" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" >
                @error('start_of_service')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="end_of_service" class="block text-gray-700 text-sm font-bold mb-2">End of Service</label>
                <input type="date" id="end_of_service" name="end_of_service" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" >
                @error('end_of_service')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end items-center">
                <div class="mb-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-3">Add Official</button>
                </div>
                <div class="mb-4">
                    <a href="{{ route('barangay.dashboard') }}" class="inline-block align-baseline font-bold text-lg text-blue-600 hover:text-blue-800">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.barangay-select').select2();
        });
    </script>
</div>

<script>
    $(document).ready(function() {
        $('.official-select').select2();
    });
</script>
@endsection
