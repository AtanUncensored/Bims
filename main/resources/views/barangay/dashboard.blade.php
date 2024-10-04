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
                            <td class="py-2 px-4 border-b border-gray-200">{{ $official->purok }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $official->start_of_service }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $official->end_of_service }}</td>
                            <td>
                                <div class="flex py-4 gap-2">
                                    <a href="{{ route('barangay.officials.edit', $official) }}" class="text-blue-600 py-1 px-3 rounded hover:text-blue-800">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <button type="button" class="text-red-600 py-1 px-3 rounded hover:text-red-800" data-modal-target="#deleteModal" data-modal-toggle="deleteModal">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    
                                    <!-- Delete Confirmation Modal -->
                                    <div id="deleteModal" class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto inset-0 h-modal h-full bg-gray-900 bg-opacity-50">
                                        <div class="relative w-full max-w-md h-full md:h-auto mx-auto mt-20">
                                            <div class="relative bg-white rounded-lg shadow">
                                                <div class="p-4 border-b">
                                                    <h3 class="text-lg font-semibold text-gray-900">Delete Confirmation - <span class="text-blue-600">Barangay Official</span></h3>
                                                </div>
                                                <div class="p-6">
                                                    <p class="text-[15px] text-gray-600">Are you sure you want to delete this Barangay Official?</p>
                                                </div>
                                                <div class="p-4 border-t flex justify-end space-x-2">
                                                    <button type="button" class="text-gray-600 hover:text-gray-800 px-3 py-2 rounded" data-modal-hide="deleteModal">
                                                        Cancel
                                                    </button>
                                                    <form action="{{ route('barangay.officials.destroy', $official) }}" method="POST" onsubmit="return confirmDelete();">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 w-[70px]" onclick="return confirm('Are you sure you want to delete this Official?');">
                                                            Delete
                                                        </button>
                                                    </form> 
                                                </div>
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
    document.querySelectorAll('[data-modal-toggle]').forEach(button => {
        button.addEventListener('click', function () {
            const modalId = this.getAttribute('data-modal-target');
            document.querySelector(modalId).classList.toggle('hidden');
        });
    });
    //Hide ni sa delete modal
    document.querySelectorAll('[data-modal-hide]').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('.fixed').classList.add('hidden');
        });
    });
</script>
@endsection
