@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-users fa-lg text-black mr-1"></i>
@endsection

@section('title', 'Barangays')

@section('content')
<div class="barangay-list py-2 px-4">
    <label class="text-2xl font-bold mb-6 block text-green-600">BARANGAY RECORD:</label>

    <hr class="border-t-2 border-gray-300">

    <div class="flex items-center justify-center mt-3 mb-3"> 
        <form class="inline-flex" method="GET" action="{{ route('lgu.barangays-list') }}">
            <input type="text" name="search" placeholder="Search for a barangay" class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500">
            <button type="submit" class="py-2 px-4 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <!-- Table ni record sa available barangay -->
    <div class="max-h-[50vh] overflow-y-auto">
        <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-600 text-white">
                <tr>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-sm text-left">Barangay Logo</th>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-sm text-left">Barangay Name</th>
                    <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-sm text-left">View / Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangays as $barangay)
                <tr class="hover:bg-gray-300 transition duration-300 ease-in-out">
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">
                        @if ($barangay->logo)
                            <img src="{{ asset('images/' . $barangay->logo) }}" alt="Logo" class="w-10 h-10 object-cover ml-[40px] rounded-full">
                        @else
                            <span>No Logo</span>
                        @endif
                    </td>

                    <!-- crud sa barangay -->
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">{{ $barangay->barangay_name }}</td>
                    <td class="py-2 px-4 font-semibold border-b border-gray-200">
                        <a href="{{ route('lgu.barangays-show', $barangay->id) }}" class="text-gray-700 py-1 px-2 md:px-3 rounded hover:text-gray-900">
                            <i class="fa-solid fa-window-maximize"></i>
                        </a>
                        <a href="{{ route('lgu.barangays-edit', $barangay->id) }}" class="text-blue-600 py-1 px-2 md:px-3 rounded hover:text-blue-800">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
