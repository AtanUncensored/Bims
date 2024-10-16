@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-users fa-2x text-black mr-3"></i>
@endsection

@section('title', 'Barangays')

@section('content')
<div class="barangay-list p-6">
    <label class="text-2xl font-bold mb-4 block text-gray-600">Barangay List:</label>

    <hr class="border-t-2 border-gray-300">
    <br>

    <!-- Table ni record sa available barangay -->

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 text-center rounded-lg shadow-md">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-3 px-6 border-b text-center border-gray-300 text-left">Logo</th>
                    <th class="py-3 px-6 border-b text-center border-gray-300 text-left">Barangay Name</th>
                    <th class="py-3 px-6 border-b text-center border-gray-300 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangays as $barangay)
                <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                    <td class="py-3 px-6 flex justify-center text-gray-700">
                        @if ($barangay->logo)
                            <img src="{{ asset('images/' . $barangay->logo) }}" alt="Logo" class="w-12 h-12 object-cover rounded-full">
                        @else
                            <span>No Logo</span>
                        @endif
                    </td>

                    <!-- crud sa barangay -->
                    
                    <td class="py-3 px-6 text-gray-700 font-bold">{{ $barangay->barangay_name }}</td>
                    <td class="text-gray-700 flex justify-center space-x-2 items-center">
                        <a href="{{ route('lgu.barangays-show', $barangay->id) }}" class="text-white py-1 px-3 bg-gray-600 rounded hover:text-black hover:bg-gray-400"><i class="fa-regular fa-eye"></i></a>
                        <a href="{{ route('lgu.barangays-edit', $barangay->id) }}" class="text-black py-1 px-3 bg-blue-500 rounded hover:text-blue-700 hover:bg-gray-400"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('lgu.barangays-delete', $barangay->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this barangay?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-black py-1 px-3 bg-red-500 rounded hover:text-red-700 hover:bg-gray-400"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
