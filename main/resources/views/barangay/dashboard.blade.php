@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-house fa-xl"></i>
@endsection

@section('content')

<div class="records py-2 px-4">
    <h1 class="text-2xl font-bold text-gray-800">Barangay Records</h1>
    <hr class="border-t-2 mt-3 mb-4 border-gray-300">

    <div class="flex justify-between mb-4">
        <div class="card bg-yellow-400 rounded-[10px] py-2 px-4 w-[20%]">
            <div class="card-body">
                <p class="card-text font-semibold text-2xl">{{ $totalResidents }}</p>
                <hr class="border-t-2 mt-2 mb-3 border-black">
                <h5 class="card-title text-yellow-900 font-bold text-lg">
                    <i class="fas fa-users fa-md"></i> Total Residents
                </h5>
            </div>
        </div>
        <div class="card bg-red-500 rounded-[10px] py-2 px-4 w-[20%]">
            <div class="card-body">
                <p class="card-text font-semibold text-2xl">{{ $marriedCount }}</p>
                <hr class="border-t-2 mt-2 mb-3 border-black">
                <h5 class="card-title text-red-900 font-bold text-lg">
                    <i class="fas fa-users fa-md"></i> Married
                </h5>
            </div>
        </div>
        <div class="card bg-purple-500 rounded-[10px] py-2 px-4 w-[20%]">
            <div class="card-body">
                <p class="card-text font-semibold text-2xl">{{ $seniorCitizensCount }}</p>
                <hr class="border-t-2 mt-2 mb-3 border-black">
                <h5 class="card-title text-purple-900 font-bold text-lg">
                    <i class="fas fa-users fa-md"></i> Senior Citizen
                </h5>
            </div>
        </div>
        <div class="card bg-green-500 rounded-[10px] py-2 px-4 w-[20%]">
            <div class="card-body">
                <p class="card-text font-semibold text-2xl">{{ $youthCount }}</p>
                <hr class="border-t-2 mt-2 mb-3 border-black">
                <h5 class="card-title text-green-900 font-bold text-lg">
                    <i class="fas fa-users fa-md"></i> Youth
                </h5>
            </div>
        </div>
    </div>

    <hr class="border-t-2 mt-3 mb-6 mr-4 border-gray-300">

    <div class="flex items-center justify-between mt-[20px] mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Barangay Officials</h1>
        <div class="py-2 px-4 bg-blue-500 text-white rounded">
            <button><i class="fa-solid fa-plus"></i> Add Officials</button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <div class="max-h-[40vh] overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Position</th>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Committee</th>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Start of Service</th>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">End of Service</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Static data for officials -->
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 whitespace-nowrap">John Doe</td>
                        <td class="px-4 py-2 whitespace-nowrap">Chairman</td>
                        <td class="px-4 py-2 whitespace-nowrap">Health and Sanitation</td>
                        <td class="px-4 py-2 whitespace-nowrap">2022-01-01</td>
                        <td class="px-4 py-2 whitespace-nowrap">2025-12-31</td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 whitespace-nowrap">Jane Smith</td>
                        <td class="px-4 py-2 whitespace-nowrap">Councilor</td>
                        <td class="px-4 py-2 whitespace-nowrap">Public Safety</td>
                        <td class="px-4 py-2 whitespace-nowrap">2021-06-01</td>
                        <td class="px-4 py-2 whitespace-nowrap">2024-05-31</td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 whitespace-nowrap">Mark Johnson</td>
                        <td class="px-4 py-2 whitespace-nowrap">Treasurer</td>
                        <td class="px-4 py-2 whitespace-nowrap">Finance</td>
                        <td class="px-4 py-2 whitespace-nowrap">2023-02-15</td>
                        <td class="px-4 py-2 whitespace-nowrap">2026-02-14</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
