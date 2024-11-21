@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-users fa-lg text-black mr-1"></i>
@endsection

@section('title', 'Barangays')

@section('content')
<div class="barangay-list py-4 px-6 md:px-8">
    <label class="text-lg sm:text-2xl font-bold mb-4 block text-green-600">BARANGAY RECORD:</label>

    <hr class="border-t-2 border-gray-300 mb-4">

    <div class="flex items-center justify-center mt-3 mb-6"> 
        <form class="inline-flex w-[50%] sm:w-auto" method="GET" action="{{ route('lgu.barangays-list') }}">
            <input 
                type="text" 
                name="search" 
                placeholder="Search for a barangay" 
                class="px-3 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500 w-full sm:w-64 lg:py-2 lg:px-4 text-[7px] sm:text-base">
            <button 
                type="submit" 
                class="px-3 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition lg:py-2 lg:px-4">
                <i class="fa-solid fa-magnifying-glass fa-sm lg:fa-lg"></i>
            </button>
        </form>
    </div>
    

    <!-- Table ni record sa available barangay -->
    <div class="max-h-[60vh] overflow-y-auto">
        <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-600 text-white">
                <tr>
                    <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[13px] text-left">Barangay Logo</th>
                    <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[13px] text-left">Barangay Name</th>
                    <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[13px] text-left">View / Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangays as $barangay)
                <tr class="hover:bg-gray-300 transition duration-300 ease-in-out">
                    <td class="lg:py-2 lg:px-4 font-semibold border-b border-gray-200">
                        @if ($barangay->logo)
                            <img src="{{ asset('images/' . $barangay->logo) }}" alt="Logo" class="w-8 h-8 sm:w-10 sm:h-10 ml-6 object-cover rounded-full">
                        @else
                            <span class="text-sm text-gray-500">No Logo</span>
                        @endif
                    </td>

                    <td class="py-2 px-4 lg:py-2 lg:px-4 text-[7px] lg:text-[15px] font-semibold border-b border-gray-200">{{ $barangay->barangay_name }}</td>
                    <td class="py-2 px-4 sm:px-6 font-semibold border-b border-gray-200">
                        <a href="{{ route('lgu.barangays-show', $barangay->id) }}" class="text-gray-700 py-1 px-2 sm:px-3 rounded hover:text-gray-900 text-sm sm:text-base">
                            <i class="fa-solid fa-window-maximize"></i>
                        </a>
                        {{-- <a href="{{ route('lgu.barangays-edit', $barangay->id) }}" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                            <i class="fa-solid fa-pen"></i>
                        </a> --}}
                        <button onclick="toggleEditModal('{{ $barangay->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </td>
                </tr>
                <!-- Edit Modal -->
                <div id="edit-modal-{{ $barangay->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                    <div class="bg-white rounded-lg shadow-lg w-[80%] max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex justify-start items-center">
                                <img class="w-[25px] h-[25px] lg:w-[50px] lg:h-[50px] rounded-full" src="{{ asset('images/' . $barangay->logo) }}" alt="barangay logo">
                            <h3 class="text-sm lg:text-lg font-bold text-green-600 ml-3 uppercase">Brgy. {{ $barangay->barangay_name }}</h3>
                            </div>
                            <div class="flex justify-end items-center">
                                <button onclick="toggleEditModal('{{ $barangay->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                    <i class="fa-solid fa-xmark fa-2xl"></i>
                                </button>
                            </div>
                        </div>
                        <h3 class="text-sm lg:text-lg font-bold text-gray-600 mb-3">Edit Barangay Details</h3>
                        <hr class="border-t-2 border-gray-300 mb-4">

                        <form action="{{ route('lgu.barangays-update', $barangay->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                
                            <div class="mb-4">
                                <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Logo:</label>
                                <input type="file" id="logo" name="logo" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" accept="image/*">
                                @error('logo')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                
                            <div class="mb-4">
                                <label for="barangay_name" class="block text-gray-700 text-sm font-bold mb-2">Barangay Name:</label>
                                <input type="text" id="barangay_name" name="barangay_name" value="{{ old('barangay_name', $barangay->barangay_name) }}" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                @error('barangay_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                
                            <div class="mb-4">
                                <label for="background_image" class="block text-gray-700 text-sm font-bold mb-2">Background Image:</label>
                                <input type="file" id="background_image" name="background_image" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" accept="image/*">
                                @error('background_image')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex justify-end items-center">
                                    <button type="submit" class="bg-blue-600 text-[10px] lg:text-[15px] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-3">Update Barangay</button>  
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Pangpagawas sa modal
    function toggleEditModal(barangayId) {
        const modal = document.getElementById(`edit-modal-${barangayId}`);
        modal.classList.toggle('hidden');
    }
</script>
@endsection
