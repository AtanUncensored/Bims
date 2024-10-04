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
        <a href="{{ route('lgu.create-barangay') }}" class="py-2 px-4 bg-blue-600 text-white font-bold rounded hover:bg-blue-500">Add Barangay Admin</a>
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

                        <button type="button" class="text-red-600 py-1 px-3 rounded hover:text-red-800" data-modal-target="#deleteModal" data-modal-toggle="deleteModal">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        
                        <!-- Delete Confirmation Modal -->
                        <div id="deleteModal" class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto inset-0 h-modal h-full bg-gray-900 bg-opacity-50">
                            <div class="relative w-full max-w-md h-full md:h-auto mx-auto mt-20">
                                <div class="relative bg-white rounded-lg shadow">
                                    <div class="p-4 border-b">
                                        <h3 class="text-lg font-semibold text-gray-900">Delete Confirmation - <span class="text-blue-600">Admin</span></h3>
                                    </div>
                                    <div class="p-6">
                                        <p class="text-[15px] text-gray-600">Are you sure you want to delete this admin?</p>
                                    </div>
                                    <div class="p-4 border-t flex justify-end space-x-2">
                                        <button type="button" class="text-gray-600 hover:text-gray-800 px-3 py-2 rounded" data-modal-hide="deleteModal">
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

