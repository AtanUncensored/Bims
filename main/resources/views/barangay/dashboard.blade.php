@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-house fa-lg"></i>
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
        <a href="{{ route('barangay.officials.create')}}" class="py-2 px-4 bg-blue-500 text-white rounded">Add Officials</a>
    </div>

    <div class="overflow-x-auto">
        <div class="max-h-[40vh] overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Position</th>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Committee</th>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Purok</th>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Start of Service</th>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">End of Service</th>
                        <th class="px-6 py-3 bg-gray-600 text-white text-center text-xs font-medium uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($barangayOfficials as $official)
                        <tr>
                            <td class="px-6 py-4 text-center">
                                {{ $official->resident->first_name }} {{ $official->resident->last_name }}
                            </td>
                            <td class="px-6 py-4 text-center">{{ $official->position }}</td>
                            <td class="px-6 py-4 text-center">{{ $official->committee }}</td>
                            <td class="px-6 py-4 text-center">{{ $official->purok }}</td>
                            <td class="px-6 py-4 text-center">{{ $official->start_of_service }}</td>
                            <td class="px-6 py-4 text-center">{{ $official->end_of_service }}</td>
                            <td>
                                <div class="flex py-4 gap-2">
                                    <a href="{{ route('barangay.officials.edit', $official) }}" class="py-2 px-4 bg-blue-500 text-white rounded flex items-center space-x-2 hover:bg-blue-600 transition w-[70px]">
                                        <span>Edit</span>
                                    </a>
    
                                    <form action="{{ route('barangay.officials.destroy', $official) }}" method="POST" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 w-[70px]" onclick="return confirm('Are you sure you want to delete this Official?');">
                                            Delete
                                        </button>
                                    </form> 
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
    
</div>

@endsection
