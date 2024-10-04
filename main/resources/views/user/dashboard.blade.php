@extends('user.templates.navigation-bar')

@section('icon')
<i class="fas fa-house fa-xl"></i>
@endsection

@section('content')

<div class="records py-2 px-4">
    <h1 class="text-2xl font-bold text-green-600">BARANGAY RECORDS:</h1>

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
        <h1 class="text-2xl font-bold text-green-600">BARANGAY OFFICIALS:</h1>
    </div>

    <div class="max-h-[40vh] overflow-y-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Name</th>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Position</th>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Committee</th>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Purok</th>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Start of Service</th>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">End of Service</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if($barangayOfficials->isEmpty())
                <tr>
                    <td colspan="7" class="py-4 px-6 text-center text-gray-500">
                        Currently no barangay officials found.
                    </td>
                </tr>
                @else
                @foreach($barangayOfficials as $official)
                    <tr class="hover:bg-gray-200 transition">
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $official->resident->first_name }} {{ $official->resident->last_name }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $official->position }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $official->committee }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $official->purok }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $official->start_of_service }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $official->end_of_service }}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
