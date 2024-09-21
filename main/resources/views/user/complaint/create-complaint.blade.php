@extends('user.templates.navigation-bar')

@section('icon')
<i class="fa-regular fa-newspaper fa-xl"></i>
@endsection

@section('title', 'Complaints')

@section('content')

  <div class="py-2 px-4">
    <h2 class="text-2xl font-semibold text-gray-800">Submit a Complaint</h2>
    <hr class="border-t-2 mt-3 mb-6 border-gray-300">
    
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold text-gray-800">How can we help?</h1>
        <hr class="border-t-2 my-4 border-gray-700">

        <form action="{{ route('user.complaint.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="complain_type" class="block text-lg font-semibold text-gray-700">Type of Concern</label>
                <input type="text" name="complain_type" id="complain_type" class="py-2 px-4 w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="date_of_incident" class="block text-lg font-semibold text-gray-700">Date of Incident</label>
                <input type="date" name="date_of_incident" id="date_of_incident" class="py-2 px-4 w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="details" class="block text-lg font-medium text-gray-700">Details</label>
                <textarea name="details" id="details" cols="10" rows="4" placeholder="Details here..." class="py-2 px-4 w-full border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700">
                    Submit
                </button>
            </div>
        </form>
    </div>
  </div>

@endsection
