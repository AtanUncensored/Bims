@extends('lgu.lgu-template.navigation-bar')

@section('title', 'Barangay Admins')

@section('content')
<div class="barangay-admins px-4">
    <div class="bg-white rounded-lg shadow-lg py-2 px-4 mb-5">
        <div id="title">
            <h1 class="text-xl font-bold text-blue-500 mb-3">FILTER BARANGAYS:</h1>
        </div>
    
        @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
            {{ session('success') }}
        </div>
        @endif
    
    <!-- Filter Form using Select2 -->
        <div class="mb-4"> 
          <form action="{{ route('lgu.admins') }}" method="GET" id="filterForm">
            <p class="mb-2 text-gray-600 text-[13px] lg:text-[15px] font-semibold">Filter here:</p>
                <select name="barangay_ids[]" id="barangay_id" class="barangay-select w-full p-2 border rounded-md" multiple>
                    @foreach($barangays as $barangay)
                        <option value="{{ $barangay->id }}" {{ in_array($barangay->id, (array) request('barangay_ids', [])) ? 'selected' : '' }}>
                            {{ $barangay->barangay_name }}
                        </option>
                    @endforeach
                </select>
          </form>
        </div>
    </div>


    <!-- Table for displaying Barangay Admins -->
    <div class="max-h-[40vh] overflow-y-auto bg-white rounded-lg shadow-lg py-2 px-4">

        <h1 class="text-xl font-bold text-blue-500 mb-3">ADMINISTRATORS:</h1>

        <div class="mb-2 flex justify-end ">

            <!-- Caution before proceding to delete an admin -->
            <button class="relative text-left px-4 py-2 text-red-600 text-[10px] lg:text-[15px] hover:text-red-800 rounded-lg group">
                <span class="font-bold">Caution <i class="fa-solid fa-triangle-exclamation"></i></span>
                <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 hidden group-hover:block bg-white text-red-600 text-[10px] lg:text-[15px] p-4 rounded shadow-lg w-64">
                    <strong>Warning!</strong> Beware when deleting a single admin from a specific barangay. Please Proceed with caution and read the confirmation before continuing.
                </div>
            </button>        
    
             <!-- Create -->
            <a href="{{ route('lgu.create-barangay') }}" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500"><i class="fa-solid fa-plus"></i> Add Barangay Admin</a>
        </div>
        
        <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-600 text-white">
                <tr>
                    <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-left">Name</th>
                    <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-left">Email</th>
                    <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-left">Barangay</th>
                    <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-left">Update</th>
                </tr>
            </thead>
            <tbody>
                @if($adminUsers->isEmpty())
                <tr class="hover:bg-gray-300 transition duration-300 ease-in-out">
                    <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                        No barangay administrators found.
                    </td>
                </tr>
                @else
                @foreach ($adminUsers as $admin)
                <tr class="hover:bg-gray-300 transition duration-300 ease-in-out">
                    <td class="py-2 px-4 font-semibold border-b text-[10px] lg:text-[15px] border-gray-200">{{ $admin->name }}</td>
                    <td class="py-2 px-4 font-semibold border-b text-[8px] lg:text-[15px] text-blue-600 border-gray-200">{{ $admin->email }}</td>
                    <td class="py-2 px-4 font-semibold border-b text-[10px] lg:text-[15px] border-gray-200">{{ $admin->barangay ? $admin->barangay->barangay_name : 'N/A' }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">
                        <a href="{{ route('lgu.admins-crud.edit-barangay-admin', $admin->id) }}" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base"><i class="fa-solid fa-pen"></i></a>

                        <button onclick="toggleDeleteModal('{{ $admin->id }}')" class="text-red-600 py-1 px-2 sm:px-3 rounded hover:text-red-800 text-sm sm:text-base">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <!-- Delete Modal ni dere same sa log out nga layout -->
                        <div id="delete-modal-{{ $admin->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                            <div class="bg-white rounded-lg shadow-lg w-[80%] max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                <div class="flex justify-start items-center mb-3">
                                    <img class="w-[25px] h-[25px] lg:w-[50px] lg:h-[50px] rounded-full" src="{{ asset('images/' . $admin->barangay->logo) }}" alt="barangay/lgu logo">
                                    <h3 class="text-sm lg:text-lg font-bold text-green-600 ml-3 uppercase"> Brgy. {{ $admin->barangay ? $admin->barangay->barangay_name : 'N/A' }}</h3>
                                </div>
                                <h3 class="text-sm lg:text-lg font-bold text-gray-600 mb-3">Admin user: <span class="text-blue-600">{{ $admin->name }}</span></h3>
                                <hr class="border-t-2 border-gray-300">
                                <p class="mb-3 mt-3 text-sm lg:text-lg text-red-500"><i class="fa-solid fa-triangle-exclamation"></i> Records added by this admin will also be deleted.</p>

                                <p class="mb-6 ml-4 text-sm lg:text-lg text-gray-600">Continue to delete admin?</p>
                                
                                <div class="flex justify-end space-x-4">
                                    <button onclick="toggleDeleteModal('{{ $admin->id }}')" class="hover:text-gray-400 text-[10px] lg:text-[15px]">
                                        Cancel
                                    </button>

                                    <form action="{{ route('lgu.admins-crud.delete-barangay-admin', $admin->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="py-2 px-4 text-[10px] lg:text-[15px] text-red-800 hover:text-red-400">
                                            Delete
                                        </button>
                                    </form>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Search para sa barangay nga filter
        $('.barangay-select').select2({
            placeholder: 'Select Barangay',
            allowClear: true
        });

        // Submit form kung maka select na ug barangay
        $('#barangay_id').on('change', function() {
            $('#filterForm').submit();
        });
    });
        //Show ni sa delete modal
        function toggleDeleteModal(adminId) {
            const modal = document.getElementById(`delete-modal-${adminId}`);
            modal.classList.toggle('hidden');
        }
</script>

@endsection