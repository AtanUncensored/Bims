@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-list fa-lg"></i>
@endsection

@section('title', 'Logs')

@section('content')
    <div class="py-2 px-4">
        <h2 class="text-2xl font-semibold text-green-600">ACTIVITY LOGS:</h2>

        <hr class="border-t-2 mt-3 mb-6 border-gray-300">

        <h2 class="text-center text-gray-500 mt-8 text-lg">-Recent Activities-</h2>
    </div>

    <div class="container mx-auto px-4">
        
        <div class="max-h-[50vh] overflow-y-auto">
            @if($logs->isEmpty())
                <p class="text-center text-gray-500 py-4">Currently no Admin activity logs available yet.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200 bg-white shadow-lg rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-2 px-4 text-center text-[12px] font-medium bg-gray-600 text-white uppercase tracking-wider">Activity Done</th>
                            <th class="px-6 py-3 text-center text-[12px] font-medium bg-gray-600 text-white uppercase tracking-wider">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($logs as $log)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-4 py-2 text-green-800 whitespace-nowrap">{{$log->log_entry}}</td>
                            <td class="px-4 py-2 text-red-800 text-center whitespace-nowrap">{{$log->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
