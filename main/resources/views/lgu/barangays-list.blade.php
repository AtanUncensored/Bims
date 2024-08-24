@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-users fa-2x text-black mr-3"></i>
@endsection

@section('title', 'Barangays')

@section('content')
<div class="barangay-list p-6">
    <label class="text-2xl font-bold mb-4 block">Barangay List</label>

    <table class="min-w-full bg-white border border-gray-300 rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 border-b border-gray-300 text-left">Barangay Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangays as $barangay)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b border-gray-300">{{ $barangay->barangay_name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
