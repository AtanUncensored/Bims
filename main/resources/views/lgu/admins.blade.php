@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user-shield fa-lg text-black mr-1"></i>
@endsection

@section('title', 'Barangay Admins')

@section('content')
<div class="barangay-admins py-2 px-4">
    <div id="title">
        <h1 class="text-2xl font-bold text-blue-600">BARANGAY ADMINISTRATORS:</h1>
    </div>
    <div class="my-6">
        <hr class="border-t-2 border-gray-300">
    </div>

    <!-- Filter Form using Select2 -->
    <div class="mt-2 mb-4">
        <h2 class="font-semibold mb-2">Filter by Barangay:</h2>
        <form action="{{ route('lgu.admins') }}" method="GET" id="filterForm">
            <div class="mb-2">
                <select name="barangay_ids[]" id="barangay_id" class="barangay-select w-full p-2 border rounded-md" multiple>
                    @foreach($barangays as $barangay)
                        <option value="{{ $barangay->id }}" {{ in_array($barangay->id, (array) request('barangay_ids', [])) ? 'selected' : '' }}>
                            {{ $barangay->barangay_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    @if(session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
        {{ session('success') }}
    </div>
    @endif

    <!-- Create -->
    <div class="mb-2 flex justify-end">
        <a href="{{ route('lgu.create-barangay') }}" class="py-2 px-4 bg-blue-600 text-white font-bold rounded hover:bg-blue-500"><i class="fa-solid fa-plus"></i> Add Barangay Admin</a>
    </div>

    <!-- Table for displaying Barangay Admins -->
    <div class="max-h-[40vh] overflow-y-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-sm text-left">Name</th>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-sm text-left">Email</th>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-sm text-left">Assigned Barangay</th>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-sm text-left">Edit / Delete</th>
                </tr>
            </thead>
            <tbody>
                @if($adminUsers->isEmpty())
                <tr>
                    <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                        No barangay administrators found.
                    </td>
                </tr>
                @else
                @foreach ($adminUsers as $admin)
                <tr class="hover:bg-gray-300 transition duration-300 ease-in-out">
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->name }}</td>
                    <td class="py-2 px-4 font-semibold border-b text-blue-600 border-gray-200">{{ $admin->email }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->barangay ? $admin->barangay->barangay_name : 'N/A' }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">
                        <a href="{{ route('lgu.admins-crud.edit-barangay-admin', $admin->id) }}" class="text-blue-600 py-1 px-3 rounded hover:text-blue-800"><i class="fa-solid fa-pen"></i></a>

                        <button onclick="toggleDeleteModal('{{ $admin->id }}')" class="text-left px-4 py-2 text-red-600 hover:text-red-800 rounded-lg">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <!-- Delete Modal ni dere same sa log out nga layout -->
                        <div id="delete-modal-{{ $admin->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                <div class="flex justify-start items-center mb-3">
                                    <img class="w-[50px] h-[50px] rounded-full" src="{{ asset('images/' . $admin->barangay->logo) }}" alt="barangay/lgu logo">
                                    <h3 class="text-lg font-bold text-green-600 ml-3 uppercase"> Brgy. {{ $admin->barangay ? $admin->barangay->barangay_name : 'N/A' }}</h3>
                                </div>
                                <h3 class="text-lg font-bold text-gray-600 mb-3">Admin user: <span class="text-blue-600">{{ $admin->name }}</span></h3>
                                <hr class="border-t-2 border-gray-300">

                                <p class="mb-6 mt-3 ml-4 text-gray-600">Continue to delete admin?</p>
                                <div class="flex justify-end space-x-4">
                                    <button onclick="toggleDeleteModal('{{ $admin->id }}')" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                                        Cancel
                                    </button>

                                    <form action="{{ route('lgu.admins-crud.delete-barangay-admin', $admin->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 px-3 py-2 rounded">
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

