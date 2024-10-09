@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-file-lines fa-lg"></i>
@endsection

@section('title', 'Budget Reports')

@section('content')

<div class="py-2 px-4">

    <h2 class="text-2xl font-semibold text-green-600">BUDGET LOGS:</h2>

    <hr class="border-t-2 mt-3 mb-4 border-gray-300">

    <div class="flex justify-between mb-4">
        <a href="#" class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-600 transition"><i class="fa-solid fa-download"></i> Export Data</a>

        <a href="{{ route('barangay.create-budgetReport') }}" class="py-2 px-4 bg-blue-500 text-white rounded flex items-center space-x-2 hover:bg-blue-600 transition">
            <span><i class="fa-solid fa-plus"></i> Add Expense</span>
        </a>
    </div>
        @if(session('success'))
            <div class="alert alert-success mb-4 bg-green-100 text-green-800 border border-green-300 rounded-lg py-2 px-4">{{ session('success') }}</div>
        @endif
    
        <div class="max-h-[45vh] overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-lg rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 text-start text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Expense Used</th>
                        <th class="px-6 py-3 text-start text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Cost</th>
                        <th class="px-6 py-3 text-start text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">DateTime</th>
                        <th class="px-6 py-3 text-center text-xs font-medium bg-gray-600 text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($budgetReports->isEmpty())
                    <tr>
                        <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                            Currently no budget reports available yet.
                        </td>
                    </tr>
                    @else
                    @foreach ($budgetReports as $report)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-2 whitespace-nowrap">{{ $report->item }}</td>
                        <td class="px-4 py-2 text-center whitespace-nowrap">{{ $report->cost }}</td>
                        <td class="px-4 py-2 text-center whitespace-nowrap">{{ $report->period_from }} | {{ $report->period_to }}</td>
                        <td class="px-4 py-2 text-right whitespace-nowrap">
                            <div class="flex gap-2 justify-end">
                                <a href="{{ route('barangay.budget-report.edit', $report->id) }}" class="w-24 py-1 px-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition text-center">
                                    Edit
                                </a>
                
                                <form action="{{ route('barangay.budget-report.delete', $report->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this budget report?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-24 py-1 px-3 bg-red-500 text-white rounded hover:bg-red-600 transition text-center">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                
                    @endif
                </tbody>
            </table>
        </div>     
        <div class="text-end mt-3">
            <p class="font-semibold text-gray-700">Total Expenses:<span class="text-red-500">₱{{ number_format($totalExpenses, 2) }}</span></p>
        </div>
</div>

@endsection
