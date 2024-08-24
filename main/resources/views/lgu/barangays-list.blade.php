@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-users fa-2x text-black mr-3"></i>
@endsection

@section('title', 'Barangays')

@section('content')
<div class="barangay-list p-6">
    <label class="text-2xl font-bold mb-4 block">Barangay List</label>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-6 border-b border-gray-300 text-left text-gray-700">Logo</th>
                    <th class="py-3 px-6 border-b border-gray-300 text-left text-gray-700">Barangay Name</th>
                    <th class="py-3 px-6 border-b border-gray-300 text-left text-gray-700">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangays as $barangay)
                <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                    <td class="py-3 px-6 border-b border-gray-300 text-gray-700">
                        @if ($barangay->logo)
                            <img src="{{ asset('images/' . $barangay->logo) }}" alt="Logo" class="w-12 h-12 object-cover rounded">
                        @else
                            <span>No Logo</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 border-b border-gray-300 text-gray-700">{{ $barangay->barangay_name }}</td>
                    <td class="py-3 px-6 border-b border-gray-300 text-gray-700 flex space-x-4">
                        <a href="{{ route('lgu.barangays-show', $barangay->id) }}" class="text-blue-500 hover:text-blue-700">Show</a>
                        <a href="{{ route('lgu.barangays-edit', $barangay->id) }}" class="text-green-500 hover:text-green-700">Edit</a>
                        <form action="{{ route('lgu.barangays-delete', $barangay->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this barangay?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
