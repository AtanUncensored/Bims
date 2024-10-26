@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-house fa-lg"></i>
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
                    <i class="fa-solid fa-ring fa-lg"></i> Married
                </h5>
            </div>
        </div>
        <div class="card bg-purple-500 rounded-[10px] py-2 px-4 w-[20%]">
            <div class="card-body">
                <p class="card-text font-semibold text-2xl">{{ $seniorCitizensCount }}</p>
                <hr class="border-t-2 mt-2 mb-3 border-black">
                <h5 class="card-title text-purple-900 font-bold text-lg">
                    <i class="fa-solid fa-user-tie fa-lg"></i> Senior Citizen
                </h5>
            </div>
        </div>
        <div class="card bg-green-500 rounded-[10px] py-2 px-4 w-[20%]">
            <div class="card-body">
                <p class="card-text font-semibold text-2xl">{{ $youthCount }}</p>
                <hr class="border-t-2 mt-2 mb-3 border-black">
                <h5 class="card-title text-green-900 font-bold text-lg">
                    <i class="fa-solid fa-user-graduate fa-lg"></i> Youth
                </h5>
            </div>
        </div>
    </div>

    <hr class="border-t-2 mt-3 mb-6 mr-4 border-gray-300">

    <div class="flex items-center justify-between mt-[20px] mb-4">
        <h1 class="text-2xl font-bold text-green-600">BARANGAY OFFICIALS:</h1>
        <a href="{{ route('barangay.officials.create')}}" class="py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-500"><i class="fa-solid fa-plus"></i> Add Officials</a>
    </div>

    <div class="overflow-x-auto">
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
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-center">Action</th>
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
                            <td class="py-2 px-4 border-b border-gray-200">{{ $official->resident->purok->purok_number ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $official->start_of_service }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $official->end_of_service }}</td>
                            <td>
                                <div class="flex py-4 gap-2">
                                    <a href="{{ route('barangay.officials.edit', $official) }}" class="text-blue-600 py-1 px-3 rounded hover:text-blue-800">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <button onclick="toggleDeleteModal('{{ $official->id }}')" class="text-red-700 py-1 px-2 md:px-3 rounded hover:text-red-900">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                     <!-- Delete Modal ni dere same sa log out nga layout -->
                                    <div id="delete-modal-{{ $official->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                                        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                            <div class="flex justify-start items-center mb-3">
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-600 uppercase mb-3">Position: <span class="text-blue-600">{{ $official->position }}</span></h3>
                                            <h3 class="text-lg font-bold text-gray-600 uppercase mb-3">Official name: <span class="text-blue-600">{{ $official->resident->first_name }} {{ $official->resident->last_name }}</span></h3>
                                            <hr class="border-t-2 border-gray-300">

                                            <p class="mt-3 font-semibold text-gray-500">No longer available / Reached the end of term</p>
                                            <p class="mb-6 mt-3 text-left text-[17px] text-gray-600">Continue to delete this Official?</p>
                                            
                                            <div class="flex justify-end space-x-4">
                                                <button onclick="toggleDeleteModal('{{ $official->id }}')" class="hover:text-gray-400">
                                                    Cancel
                                                </button>

                                                <form action="{{ route('barangay.officials.destroy', $official) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="py-2 px-4 text-red-800 hover:text-red-400">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>          
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div> 
</div>
<script>
        //Show ni sa delete modal
        function toggleDeleteModal(adminId) {
            const modal = document.getElementById(`delete-modal-${adminId}`);
            modal.classList.toggle('hidden');
        }
</script>
@endsection
