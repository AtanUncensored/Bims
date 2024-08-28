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
                    <th class="py-2 px-4 bg-gray-600 text-white font-bold uppercase text-sm text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($adminUsers as $admin)
                <tr>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->name }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->email }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $admin->barangay ? $admin->barangay->barangay_name : 'N/A' }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">
                        <a href="{{ route('lgu.admins-crud.edit-barangay-admin', $admin->id) }}" class="text-black py-1 px-3 bg-blue-500 rounded hover:text-blue-700 hover:bg-gray-400"><i class="fa-solid fa-pen"></i></a>

                        <form action="{{ route('lgu.admins-crud.delete-barangay-admin', $admin->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"class="text-black py-1 px-3 bg-red-500 rounded hover:text-red-700 hover:bg-gray-400" onclick="return confirm('Are you sure you want to delete this admin?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
