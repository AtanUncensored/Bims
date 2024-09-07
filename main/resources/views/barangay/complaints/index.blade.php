@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-regular fa-newspaper fa-xl"></i>
@endsection

@section('title', 'Complaints')

@section('content')

<div class="py-2 px-4">
    <h2 class="text-2xl text-gray-800 font-semibold">Complaint Record</h2>
<div class="text-center">
    <hr class="border-t-2 mt-3 mb-4 border-gray-300">

    <!-- Search bar -->
    <form class="inline-flex items-center justify-center">
        <input type="text" name="search" placeholder="Search record..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500">
        <button type="submit" class="py-2 px-4 bg-gray-500 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>

<h2 class="text-center text-gray-500 mt-8 mb-6 text-lg">-Recent Complaints-</h2>

<div class="container mx-auto px-4">

    {{-- @if(session('success'))
        <div class="alert alert-success mb-4 bg-green-100 text-green-800 border border-green-300 rounded-lg py-2 px-4">{{ session('success') }}</div>
    @endif --}}
    
    <div class="max-h-[40vh] overflow-y-auto">
        <table class="min-w-full divide-y divide-gray-200 bg-white shadow-lg rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-2 px-4 text-center text-xs font-medium text-gray-600 bg-blue-500 text-white uppercase tracking-wider">Date Recorded</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 bg-blue-500 text-white uppercase tracking-wider">Complaint Type</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 bg-blue-500 text-white uppercase tracking-wider">Details of Incident</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 bg-blue-500 text-white uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{-- @forelse ($residents as $resident) --}}
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-2 whitespace-nowrap">2023-11-02</td>
                        <td class="px-4 py-2 whitespace-nowrap">Long Queue</td>
                        <td class="px-4 py-2 whitespace-nowrap">The checking of attendance caused the long queue</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-center font-medium space-x-2">
                            <a href="#" class="py-2 px-4 text-white rounded bg-blue-500 hover:bg-blue-700 transition">View</a>
                            <a href="#" class="py-2 px-4 text-white rounded bg-red-500 hover:bg-red-700 transition">Delete</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-2 whitespace-nowrap">2023-11-02</td>
                        <td class="px-4 py-2 whitespace-nowrap">Long Queue</td>
                        <td class="px-4 py-2 whitespace-nowrap">The checking of attendance caused the long queue</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-center font-medium space-x-2">
                            <a href="#" class="py-2 px-4 text-white rounded bg-blue-500 hover:bg-blue-700 transition">View</a>
                            <a href="#" class="py-2 px-4 text-white rounded bg-red-500 hover:bg-red-700 transition">Delete</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-2 whitespace-nowrap">2023-11-02</td>
                        <td class="px-4 py-2 whitespace-nowrap">Long Queue</td>
                        <td class="px-4 py-2 whitespace-nowrap">The checking of attendance caused the long queue</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-center font-medium space-x-2">
                            <a href="#" class="py-2 px-4 text-white rounded bg-blue-500 hover:bg-blue-700 transition">View</a>
                            <a href="#" class="py-2 px-4 text-white rounded bg-red-500 hover:bg-red-700 transition">Delete</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-2 whitespace-nowrap">2023-11-02</td>
                        <td class="px-4 py-2 whitespace-nowrap">Long Queue</td>
                        <td class="px-4 py-2 whitespace-nowrap">The checking of attendance caused the long queue</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-center font-medium space-x-2">
                            <a href="#" class="py-2 px-4 text-white rounded bg-blue-500 hover:bg-blue-700 transition">View</a>
                            <a href="#" class="py-2 px-4 text-white rounded bg-red-500 hover:bg-red-700 transition">Delete</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-2 whitespace-nowrap">2023-11-02</td>
                        <td class="px-4 py-2 whitespace-nowrap">Long Queue</td>
                        <td class="px-4 py-2 whitespace-nowrap">The checking of attendance caused the long queue</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-center font-medium space-x-2">
                            <a href="#" class="py-2 px-4 text-white rounded bg-blue-500 hover:bg-blue-700 transition">View</a>
                            <a href="#" class="py-2 px-4 text-white rounded bg-red-500 hover:bg-red-700 transition">Delete</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-2 whitespace-nowrap">2023-11-02</td>
                        <td class="px-4 py-2 whitespace-nowrap">Long Queue</td>
                        <td class="px-4 py-2 whitespace-nowrap">The checking of attendance caused the long queue</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-center font-medium space-x-2">
                            <a href="#" class="py-2 px-4 text-white rounded bg-blue-500 hover:bg-blue-700 transition">View</a>
                            <a href="#" class="py-2 px-4 text-white rounded bg-red-500 hover:bg-red-700 transition">Delete</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-2 whitespace-nowrap">2023-11-02</td>
                        <td class="px-4 py-2 whitespace-nowrap">Long Queue</td>
                        <td class="px-4 py-2 whitespace-nowrap">The checking of attendance caused the long queue</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-center font-medium space-x-2">
                            <a href="#" class="py-2 px-4 text-white rounded bg-blue-500 hover:bg-blue-700 transition">View</a>
                            <a href="#" class="py-2 px-4 text-white rounded bg-red-500 hover:bg-red-700 transition">Delete</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-2 whitespace-nowrap">2023-11-02</td>
                        <td class="px-4 py-2 whitespace-nowrap">Long Queue</td>
                        <td class="px-4 py-2 whitespace-nowrap">The checking of attendance caused the long queue</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-center font-medium space-x-2">
                            <a href="#" class="py-2 px-4 text-white rounded bg-blue-500 hover:bg-blue-700 transition">View</a>
                            <a href="#" class="py-2 px-4 text-white rounded bg-red-500 hover:bg-red-700 transition">Delete</a>
                        </td>
                    </tr>
                {{-- @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No residents found for this barangay.</td>
                    </tr> --}}
                {{-- @endforelse --}}
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection