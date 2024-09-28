@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-user-plus fa-xl"></i>
@endsection

@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="py-4 px-6">
    <h2 class="text-2xl font-semibold mb-4">Add Barangay Official</h2>
    
    <form action="{{ route('barangay.officials.store') }}" method="POST">
        @csrf

        <!-- Resident Dropdown with Search -->
        <div class="mb-4">
            <label for="resident_id" class="block text-sm font-medium text-gray-700">Select Resident</label>
            <select name="resident_id" id="resident_id" class="official-select w-full p-2 border rounded-md">
                <option value="">Select a resident</option>
                @foreach($residents as $resident)
                    <option value="{{ $resident->id }}">{{ $resident->first_name }} {{ $resident->last_name }}</option>
                @endforeach
            </select>
            @error('resident_id')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Position -->
        <div class="mb-4">
            <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
            <input type="text" name="position" id="position" class="w-full p-2 border rounded-md" value="{{ old('position') }}">
            @error('position')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Committee -->
        <div class="mb-4">
            <label for="committee" class="block text-sm font-medium text-gray-700">Committee</label>
            <input type="text" name="committee" id="committee" class="w-full p-2 border rounded-md" value="{{ old('committee') }}">
            @error('committee')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Start of Service -->
        <div class="mb-4">
            <label for="start_of_service" class="block text-sm font-medium text-gray-700">Start of Service</label>
            <input type="date" name="start_of_service" id="start_of_service" class="w-full p-2 border rounded-md" value="{{ old('start_of_service') }}">
            @error('start_of_service')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- End of Service -->
        <div class="mb-4">
            <label for="end_of_service" class="block text-sm font-medium text-gray-700">End of Service</label>
            <input type="date" name="end_of_service" id="end_of_service" class="w-full p-2 border rounded-md" value="{{ old('end_of_service') }}">
            @error('end_of_service')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Purok -->
        <div class="mb-4">
            <label for="purok" class="block text-sm font-medium text-gray-700">Purok</label>
            <select name="purok" id="purok" class="w-full p-2 border rounded-md">
                <option value="">Select a Purok</option>
                @for($i = 1; $i <= 7; $i++)
                    <option value="{{ $i }}"> {{ $i }}</option>
                @endfor
            </select>
            @error('purok')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                Add Official
            </button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('.official-select').select2();
    });
</script>
@endsection
