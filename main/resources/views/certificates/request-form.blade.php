@extends('user.templates.navigation-bar')

@section('title', 'Request Certificate')

@section('content')

<div class="py-2 px-4">
    <h2 class="text-2xl font-semibold text-gray-800">Request Certificate</h2>
    <hr class="border-t-2 mt-3 mb-6 border-gray-300">

    <form id="requestForm" action="{{ route('certificates.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="certificate_type_id" class="block text-gray-700">Certificate Type</label>
            <select name="certificate_type_id" id="certificate_type_id" class="w-full border-gray-300" required>
                @foreach ($certificateTypes as $certificateType)
                    <option value="{{ $certificateType->id }}" data-price="{{ $certificateType->price }}">
                        {{ $certificateType->certificate_name }}
                    </option>
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
            <label for="purpose" class="block text-gray-700">Purpose</label>
            <input type="text" id="purpose" name="purpose" class="w-full border-gray-300">
        </div>

        <div class="mb-4">
            <label for="date_needed" class="block text-gray-700">Date Needed</label>
            <input type="datetime-local" id="date_needed" name="date_needed" class="w-full border-gray-300">
        </div>

        <div class="mb-4">
            <button type="button" id="submitRequest" class="bg-blue-500 text-white px-4 py-2">Submit Request</button>
        </div>
    </form>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Confirm Your Request</h3>
        <p id="modalDetails" class="mb-4"></p>
        <div class="flex justify-end">
            <button id="cancelRequest" class="bg-gray-500 text-white px-4 py-2 mr-2">Cancel</button>
            <button id="confirmRequest" class="bg-blue-500 text-white px-4 py-2">Confirm</button>
        </div>
    </div>
</div>

<!-- Success Modal -->
@if(session('success'))
    @php
        $successData = session('success');
        $adjustedDate = \Carbon\Carbon::parse($successData['adjusted_date'])->format('M d, Y h:i A');
    @endphp
    <div id="successModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Request Submitted Successfully</h3>
            <p class="mb-4">
                {{ $successData['message'] }}<br>
                You can get it on: <strong>{{ $adjustedDate }}</strong>
            </p>
            <div class="flex justify-end">
                <button id="closeSuccessModal" class="bg-blue-500 text-white px-4 py-2">OK</button>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmationModal = document.getElementById('confirmationModal');
        const successModal = document.getElementById('successModal');

        // Submit Request Button
        document.getElementById('submitRequest').addEventListener('click', function () {
            const certificateSelect = document.getElementById('certificate_type_id');
            const selectedOption = certificateSelect.options[certificateSelect.selectedIndex];
            const certificateName = selectedOption.text;
            const price = selectedOption.getAttribute('data-price');
            const dateNeeded = document.getElementById('date_needed').value;

            let datePart = 'Not Specified';
            let timePart = 'Not Specified';

            if (dateNeeded) {
                // Split the date and time
                const dateTime = dateNeeded.split('T');
                datePart = dateTime[0]; // Date part
                timePart = dateTime[1] ? formatTo12Hour(dateTime[1]) : 'Not Specified'; // Time part
            }

            const modalDetails = document.getElementById('modalDetails');
            modalDetails.innerHTML = `
                You are about to request the <strong>${certificateName}</strong> certificate.<br>
                Price: <strong>${price ? '₱' + price : 'Free'}</strong><br>
                <strong>Date Needed:</strong> <strong>${datePart}</strong><br>
                <strong>Time:</strong> <strong>${timePart}</strong>
            `;

            confirmationModal.classList.remove('hidden');
        });

        // Cancel Request Button
        document.getElementById('cancelRequest').addEventListener('click', function () {
            confirmationModal.classList.add('hidden');
        });

        // Confirm Request Button
        document.getElementById('confirmRequest').addEventListener('click', function () {
            confirmationModal.classList.add('hidden');
            document.getElementById('requestForm').submit();
        });

        // Close Success Modal Button
        if (successModal) {
            document.getElementById('closeSuccessModal').addEventListener('click', function () {
                successModal.classList.add('hidden');
            });
        }
    });

    // Function to format time to 12-hour format
    function formatTo12Hour(timeString) {
        const [hour, minute] = timeString.split(':');
        const date = new Date();
        date.setHours(hour, minute);

        let hours = date.getHours();
        const minutes = date.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        const minutesStr = minutes < 10 ? '0' + minutes : minutes;

        return `${hours}:${minutesStr} ${ampm}`;
    }
</script>

@endsection
