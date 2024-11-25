@extends('user.templates.navigation-bar')

@section('title', 'Request Certificate')

@section('content')

<div class="py-2 px-4">
    <h2 class="text-2xl font-semibold text-gray-800">Request Certificate</h2>
    <hr class="border-t-2 mt-3 mb-6 border-gray-300">

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('certificates.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="certificate_type_id" class="block text-gray-700">Certificate Type</label>
            <select name="certificate_type_id" id="certificate_type_id" class="w-full border-gray-300" required>
                @foreach ($certificateTypes as $certificateType)
                    <option value="{{ $certificateType->id }}">{{ $certificateType->certificate_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="resident_id" class="block text-gray-700">Select Resident</label>
            <select id="resident_id" name="resident_id" class="w-full border-gray-300" required>
                @foreach($residents as $resident)
                    <option value="{{ $resident->id }}">{{ $resident->first_name }}</option>
                @endforeach
            </select>
        </div>
        
        

        <div class="mb-4">
            <label for="requester_name" class="block text-gray-700">Requester Name</label>
            <input type="text" id="requester_name" name="requester_name" class="w-full border-gray-300" required>
        </div>

        <div class="mb-4">
            <label for="purpose" class="block text-gray-700">Purpose (Optional)</label>
            <input type="text" id="purpose" name="purpose" class="w-full border-gray-300">
        </div>

        <div class="mb-4">
            <label for="date_needed" class="block text-gray-700">Date Needed (Optional)</label>
            <input type="date" id="date_needed" name="date_needed" class="w-full border-gray-300">
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Submit Request</button>
        </div>
    </form>
</div>

@endsection
