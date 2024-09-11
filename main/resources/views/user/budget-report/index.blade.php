@extends('user.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-file-lines fa-xl"></i>
@endsection

@section('title', 'Budget Reports')

@section('content')

<div class="py-2 px-4">

    <h2 class="text-2xl font-semibold text-blue-600">Budget Logs</h2>

    <hr class="border-t-2 mt-3 mb-4 border-gray-300">

    <div class="flex justify-between">
        <a href="#" class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-600 transition"><i class="fa-solid fa-download"></i> Export Data</a>
    </div>

    <div class="container mx-auto px-4">
        @if(session('success'))
            <div class="alert alert-success mb-4 bg-green-100 text-green-800 border border-green-300 rounded-lg py-2 px-4">{{ session('success') }}</div>
        @endif
    
        <div class="max-h-[45vh] overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-lg rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 text-center text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Expense used</th>
                        <th class="px-6 py-3 text-center text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Cost</th>
                        <th class="px-6 py-3 text-center text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">DateTime</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($budgetReports as $report)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-4 py-2 whitespace-nowrap">{{ $report->item }}</td>
                            <td class="px-4 py-2 text-center whitespace-nowrap">{{ $report->cost }}</td>
                            <td class="px-4 py-2 text-center whitespace-nowrap">{{ $report->period_from }} | {{ $report->period_to }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>     
        <div class="text-end mt-3">
            <p class="font-semibold text-gray-700">Total Expenses:<span class="text-red-500">₱----</span></p>
        </div>
    </div>
</div>

@endsection
