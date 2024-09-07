@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-list fa-xl"></i>
@endsection

@section('title', 'Logs')

@section('content')
    <div class="py-2 px-4">
        <h2 class="text-2xl font-semibold text-green-600">Activity Logs</h2>

        <hr class="border-t-2 mt-3 mb-6 mr-4 border-gray-300">

        <h2 class="text-center text-gray-500 mt-8 text-lg">-Recent Activities-</h2>
    </div>

    <div class="container mx-auto px-4">

        {{-- @if(session('success'))
            <div class="alert alert-success mb-4 bg-green-100 text-green-800 border border-green-300 rounded-lg py-2 px-4">{{ session('success') }}</div>
        @endif --}}
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-lg rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 text-center text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Activity Done</th>
                        <th class="px-6 py-3 text-center text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {{-- @forelse ($residents as $resident) --}}
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-4 py-2 whitespace-nowrap">Admin Deleted a resident with an ID of #2</td>
                            <td class="px-4 py-2 text-center  whitespace-nowrap">2023-11-02 17:45:30.005</td>
                        </tr>
                    {{-- @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No residents found for this barangay.</td>
                        </tr> --}}
                    {{-- @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection