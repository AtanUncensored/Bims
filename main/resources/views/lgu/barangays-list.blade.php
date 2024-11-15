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
        <form class="inline-flex w-full sm:w-auto" method="GET" action="{{ route('lgu.barangays-list') }}">
            <input type="text" name="search" placeholder="Search for a barangay" class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500 w-full sm:w-64">
            <button type="submit" class="py-2 px-4 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <!-- Table ni record sa available barangay -->
    <div class="max-h-[60vh] overflow-y-auto">
        <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-600 text-white">
                <tr>
                    <th class="py-3 px-4 sm:px-6 bg-gray-600 text-white font-bold uppercase text-xs sm:text-sm text-left">Barangay Logo</th>
                    <th class="py-3 px-4 sm:px-6 bg-gray-600 text-white font-bold uppercase text-xs sm:text-sm text-left">Barangay Name</th>
                    <th class="py-3 px-4 sm:px-6 bg-gray-600 text-white font-bold uppercase text-xs sm:text-sm text-left">View / Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangays as $barangay)
                <tr class="hover:bg-gray-300 transition duration-300 ease-in-out">
                    <td class="py-2 px-4 sm:px-6 font-semibold border-b border-gray-200">
                        @if ($barangay->logo)
                            <img src="{{ asset('images/' . $barangay->logo) }}" alt="Logo" class="w-8 h-8 sm:w-10 sm:h-10 object-cover rounded-full">
                        @else
                            <span class="text-sm text-gray-500">No Logo</span>
                        @endif
                    </td>

                    <td class="py-2 px-4 sm:px-6 font-semibold border-b border-gray-200">{{ $barangay->barangay_name }}</td>
                    <td class="py-2 px-4 sm:px-6 font-semibold border-b border-gray-200">
                        <a href="{{ route('lgu.barangays-show', $barangay->id) }}" class="text-gray-700 py-1 px-2 sm:px-3 rounded hover:text-gray-900 text-sm sm:text-base">
                            <i class="fa-solid fa-window-maximize"></i>
                        </a>
                        <a href="{{ route('lgu.barangays-edit', $barangay->id) }}" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
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
