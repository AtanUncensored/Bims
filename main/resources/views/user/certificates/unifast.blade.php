@extends('user.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-certificate fa-xl"></i>
@endsection

@section('title', 'Unifast')

@section('content')

<div class="py-2 px-4">
    <h2 class="text-2xl font-semibold text-gray-800">Request Certificate of Unifast</h2>
    <hr class="border-t-2 mt-3 mb-6 border-gray-300">

    <!-- Form to submit data to the cert_unifasts table -->
    <form action="{{ route('unifast.store') }}" method="POST">
        @csrf <!-- Include CSRF token for security -->

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" name="address" id="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="parent_name" class="block text-sm font-medium text-gray-700">Parent Name</label>
            <input type="text" name="parent_name" id="parent_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="punong_barangay" class="block text-sm font-medium text-gray-700">Punong Barangay</label>
            <input type="text" name="punong_barangay" id="punong_barangay" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="secretary" class="block text-sm font-medium text-gray-700">Secretary</label>
            <input type="text" name="secretary" id="secretary" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="treasurer" class="block text-sm font-medium text-gray-700">Treasurer</label>
            <input type="text" name="treasurer" id="treasurer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
            <input type="text" name="purpose" id="purpose" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
            <input type="text" name="age" id="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="purok_name" class="block text-sm font-medium text-gray-700">Purok Name</label>
            <input type="text" name="purok_name" id="purok_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
        </div>
    </form>
</div>

@endsection
