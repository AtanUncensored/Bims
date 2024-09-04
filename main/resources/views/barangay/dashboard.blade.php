@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-house fa-xl"></i>
@endsection

@section('content')

<div class="records py-5 px-5">
    <h1 class="text-2xl font-bold text-gray-800">Barangay Records</h1>

    <hr class="border-t-2 mt-3 mb-4 mr-4 border-gray-300">

    <div class="flex justify-between mb-4">
     
        <div class="card bg-yellow-400 rounded-[10px] py-4 px-6 w-[30%]">
            <div class="card-body">
                <p class="card-text font-semibold text-3xl">1,295</p>
                <hr class="border-t-2 mt-3 mb-4 border-black">
                <h5 class="card-title text-yellow-900 font-bold text-xl">
                    <i class="fas fa-users fa-lg"></i> People
                </h5>
            </div>
        </div>
       
        <div class="card bg-red-500 rounded-[10px] py-4 px-6 w-[30%]">
            <div class="card-body">
                <p class="card-text font-semibold text-3xl">307</p>
                <hr class="border-t-2 mt-3 mb-4 border-black">
                <h5 class="card-title text-red-900 font-bold text-xl">
                    <i class="fas fa-user fa-lg"></i> Married
                </h5>
            </div>
        </div>
       
        <div class="card bg-purple-500 rounded-[10px] py-4 px-6 w-[30%]">
            <div class="card-body">
                <p class="card-text font-semibold text-3xl">162</p>
                <hr class="border-t-2 mt-3 mb-4 border-black">
                <h5 class="card-title text-purple-900 font-bold text-xl">
                    <i class="fas fa-users fa-lg"></i> Senior Citizen
                </h5>
            </div>
        </div>
    </div>

    <div class="table-responsive mt-[70px]">
        <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Name</th>
                    <th class="px-4 py-2 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Position</th>
                    <th class="px-4 py-2 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Committee</th>
                    <th class="px-4 py-2 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Start of Service</th>
                    <th class="px-4 py-2 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">End of Service</th>
                    <th class="px-4 py-2 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 whitespace-nowrap">Juan Dela Cruz</td>
                    <td class="px-4 py-2 whitespace-nowrap">Chairperson</td>
                    <td class="px-4 py-2 whitespace-nowrap">Finance</td>
                    <td class="px-4 py-2 whitespace-nowrap">January 1, 2023</td>
                    <td class="px-4 py-2 whitespace-nowrap">December 31, 2025</td>
                    <td class="px-4 py-2 whitespace-nowrap space-x-2">
                        <a href="#" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700 text-sm">View</a>
                        <a href="#" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-700 text-sm">Update</a>
                        <a href="#" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700 text-sm">Delete</a>
                    </td>
                </tr>
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 whitespace-nowrap">Maria Clara</td>
                    <td class="px-4 py-2 whitespace-nowrap">Secretary</td>
                    <td class="px-4 py-2 whitespace-nowrap">Events</td>
                    <td class="px-4 py-2 whitespace-nowrap">March 15, 2022</td>
                    <td class="px-4 py-2 whitespace-nowrap">March 14, 2024</td>
                    <td class="px-4 py-2 whitespace-nowrap space-x-2">
                        <a href="#" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700 text-sm">View</a>
                        <a href="#" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-700 text-sm">Update</a>
                        <a href="#" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700 text-sm">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
