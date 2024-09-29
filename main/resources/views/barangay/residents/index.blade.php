@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-users fa-lg"></i>
@endsection

@section('title', 'Residents')

@section('content')
<div class="py-2 px-4">
    <h2 class="text-2xl text-green-600 font-semibold">List of Residents Available</h2>
    
    <div class="text-center">
        <hr class="border-t-2 mt-3 mb-4 border-gray-300">
    </div>
    
    <div class="flex justify-between mb-4">
        <a href="#" class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-600 transition"><i class="fa-solid fa-download"></i> Export Data</a>

          <!-- Search bar -->
          <form class="inline-flex items-center justify-center">
            <input type="text" name="search" placeholder="Search..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-green-500">
            <button type="submit" class="py-2 px-4 bg-green-500 text-white rounded-r-md hover:bg-green-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <a href="{{ route('barangay.create-user') }}" class="py-2 px-4 bg-blue-500 text-white rounded flex items-center space-x-2 hover:bg-blue-600 transition">
            <i class="fa-solid fa-plus"></i>
            <span>Add Resident</span>
        </a>
    </div>
    
    <div class="container mx-auto px-4">
        @if(session('success'))
            <div class="alert alert-success mb-4 bg-green-100 text-green-800 border border-green-300 rounded-lg py-2 px-4">{{ session('success') }}</div>
        @endif
    
        <div class="max-h-[43vh] overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-lg rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 text-center text-xs font-medium text-gray-600 bg-blue-500 text-white uppercase tracking-wider">Last Name</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 bg-blue-500 text-white uppercase tracking-wider">First Name</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 bg-blue-500 text-white uppercase tracking-wider">Purok</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 bg-blue-500 text-white uppercase tracking-wider">Gender</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 bg-blue-500 text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($residents as $resident)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-4 py-2 whitespace-nowrap">{{ $resident->last_name }}</td>
                            <td class="px-4 py-2 text-center whitespace-nowrap">{{ $resident->first_name }}</td>
                            <td class="px-4 py-2 text-center whitespace-nowrap">{{ $resident->purok }}</td>
                            <td class="px-4 py-2 text-center whitespace-nowrap">{{ $resident->gender }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium space-x-2 text-center">
                                <a href="{{ route('barangay.residents.view', ['resident_id' => $resident->id]) }}" class="py-2 px-4 text-white rounded bg-blue-500 hover:bg-blue-700 transition">View</a>
                                <a href="{{ route('barangay.residents.edit', ['resident_id' => $resident->id]) }}" class="py-2 px-4 text-white rounded bg-green-500 hover:bg-green-700 transition">Edit</a>
                                <form action="{{ route('barangay.residents.delete', ['resident_id' => $resident->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="py-2 px-4 text-white rounded bg-red-500 hover:bg-red-700 transition" onclick="return confirm('Are you sure you want to delete this resident?');">Delete</button>
                                </form>
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

@endsection
