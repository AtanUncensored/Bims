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

    <!-- Filter Form -->
    <div class="mt-4 mb-6">
        <h2 class="font-semibold mb-2">Filter by Barangay:</h2>
        <form action="{{ route('lgu.admins') }}" method="GET" id="filterForm">
            @foreach ($barangays as $barangay)
                <div>
                    <input type="checkbox" id="barangay{{ $barangay->id }}" name="barangay_ids[]" value="{{ $barangay->id }}" {{ in_array($barangay->id, (array) request('barangay_ids', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                    <label for="barangay{{ $barangay->id }}" class="ml-2">{{ $barangay->barangay_name }}</label>
                </div>
            @endforeach
        </form>
    </div>

    <!-- Create -->
    <div class="mt-[20px] mb-6 flex justify-end">
        <a href="{{ route('lgu.create-barangay') }}" class="py-2 px-4 bg-blue-600 text-white font-bold rounded hover:bg-blue-500">Add Barangay Admin</a>
    </div>

    <!-- Table nga gi displayhan sa data sa admin -->
    <div class="overflow-x-auto">
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
                @foreach ($adminUsers as $admin)
                <tr>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->name }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->email }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->barangay ? $admin->barangay->barangay_name : 'N/A' }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">
                        <a href="{{ route('lgu.admins-crud.edit-barangay-admin', $admin->id) }}" class="text-blue-600 py-1 px-3 rounded hover:text-blue-800"><i class="fa-solid fa-pen"></i></a>

                        <form action="{{ route('lgu.admins-crud.delete-barangay-admin', $admin->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 py-1 px-3  rounded hover:text-red-800" onclick="return confirm('Are you sure you want to delete this admin?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
