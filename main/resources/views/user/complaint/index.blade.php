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

        <form>
            @csrf
            <div class="mb-4">
                <label for="concern" class="block text-lg font-semibold text-gray-700">Type of concern</label>
                <select name="concern" id="concern" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Long Queue</option>
                    <option value="">Loud Neighbors</option>
                    <option value="">Water Shortage</option>
                    <option value="">Power Outage</option>
                    <option value="">Contribution Concern</option>
                </select>
            </div>

            <label for="details" class="block text-lg font-medium text-gray-700">Kindly provide the details here:</label>
            <div class="mb-4 max-h-[25vh] overflow-y-auto border border-gray-300 rounded">
                <textarea name="details" id="details" cols="10" rows="10" placeholder="Details here..." class="py-2 px-4 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
