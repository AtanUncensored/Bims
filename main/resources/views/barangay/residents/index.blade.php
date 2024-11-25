@extends('barangay.templates.navigation-bar')

@section('title', 'Residents')

@section('content')
<div class="px-4">
    <div class="flex justify-end items-center mb-4">
        <form action="{{ route('residents.download-excel')}}" method="POST" target="__blank">
            @csrf
            <div>
                <button class="py-2 px-3 text-white bg-green-500 rounded-lg  hover:bg-green-600 shadow-lg transition">
                    <i class="fa-solid fa-file-export"></i> Export
                </button>
            </div>
        </form>
    </div>

     <!-- Search bar -->
     <div class="bg-white py-2 px-4 rounded-lg shadow-lg mb-4 max-h-[15vh] overflow-y-auto">
        <h1 class="text-xl font-bold text-blue-500 mb-3">LOOK FOR A RESIDENT:</h1>

        @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
            {{ session('success') }}
        </div>
        @endif

        <form class="flex items-center justify-center" method="GET" action="{{ route('barangay.residents.index') }}">
            <input type="text" name="search" placeholder="Search a resident..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500">
            <button type="submit" class="py-2 px-4 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

     </div>
    
    <div class="bg-white py-2 px-4 rounded-lg shadow-lg">
        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-bold text-blue-500 mb-3">LIST OF AVAILABLE RESIDENTS:</h1>
    
            <a href="{{ route('barangay.create-user') }}" class="py-2 px-4 bg-blue-600 text-white rounded flex items-center space-x-2 hover:bg-blue-500 transition">
                <i class="fa-solid fa-plus"></i>
                <span>Add Resident</span>
            </a>
        </div>
        <div class="max-h-[50vh] overflow-y-auto">
            <table class="min-w-full bg-white border border-[2px] border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Last Name</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">First Name</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Purok</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Gender</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($residents as $resident)
                        <tr class="hover:bg-gray-200 transition">
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->last_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->first_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->purok->purok_number }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->gender }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium space-x-2 text-center">
                                <a href="{{ route('barangay.residents.view', ['resident_id' => $resident->id]) }}" class="text-gray-700 py-1 px-2 md:px-3 rounded hover:text-gray-900"><i class="fa-solid fa-window-maximize"></i></a>
                                <a href="{{ route('barangay.residents.edit', ['resident_id' => $resident->id]) }}" class="text-blue-600 py-1 px-3 rounded hover:text-blue-800"><i class="fa-solid fa-pen"></i></a>
                                <button onclick="toggleDeleteModal('{{ $resident->id }}')" class="text-red-700 py-1 px-2 md:px-3 rounded hover:text-red-900">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                    
                                <!-- Delete Modal ni dere same sa log out nga layout -->
                                <div id="delete-modal-{{ $resident->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                                    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                        <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">Name: <span class="text-blue-600">{{ $resident->last_name}}, {{ $resident->first_name}}</span></p>
                                        <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">From: <span class="text-blue-600">{{ $resident->current_address}}</span></p>
    
                                        <hr class="border-t-2 border-gray-300">
            
                                        <p class="mb-5 mt-3 text-gray-600 text-left text-[17px]">Continue to delete this Resident?</p>
                                            
                                        <div class="flex justify-end space-x-4">
                                            <button onclick="toggleDeleteModal('{{ $resident->id }}')" class="hover:text-gray-400">
                                                Cancel
                                            </button>
                                    
                                            <form action="{{ route('barangay.residents.delete', ['resident_id' => $resident->id]) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="py-2 px-4 text-red-800 hover:text-red-400">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No residents found for this barangay.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
       //Show ni sa delete modal
       function toggleDeleteModal(residentId) {
            const modal = document.getElementById(`delete-modal-${residentId}`);
            modal.classList.toggle('hidden');
        }
</script>

@endsection
