@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user-shield fa-2x text-black mr-3"></i>
@endsection

@section('title', 'Barangay Admins')

@section('content')
<div class="barangay-admins py-2 px-4">
    <div id="title" class="py-2 px-4 mt-[15px]">
        <h1 class="text-2xl font-bold text-blue-600 text-center">Barangay Administrators</h1>
    </div>

    <!-- Separator -->
    <div class="my-4">
        <hr class="border-t-2 m-[15px] border-gray-300">
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
                    <th class="py-2 px-4 bg-gray-600 text-white font-bold uppercase text-sm text-left">Name</th>
                    <th class="py-2 px-4 bg-gray-600 text-white font-bold uppercase text-sm text-left">Email</th>
                    <th class="py-2 px-4 bg-gray-600 text-white font-bold uppercase text-sm text-left">Assigned Barangay</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($adminUsers as $admin)
                <tr>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->name }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->email }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->barangay ? $admin->barangay->barangay_name : 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
