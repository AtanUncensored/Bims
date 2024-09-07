
@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-file-lines fa-xl"></i>
@endsection

@section('title', 'Budget Reports')

@section('content')

<div class="py-2 px-4">

    <div class="flex justify-end">
        <a href="#" class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-600 transition"><i class="fa-solid fa-download"></i> Export Data</a>
    </div>

    <h2 class="text-2xl font-semibold text-blue-600">Budget Logs</h2>

    <hr class="border-t-2 mt-3 mb-4 mr-4 border-gray-300">

    <div class="flex justify-end mb-4">
        <a href="{{ route('barangay.create-budgetReport') }}" class="py-2 px-4 bg-blue-500 text-white rounded flex items-center space-x-2 hover:bg-blue-600 transition">
            <span><i class="fa-solid fa-file-lines fa-xl"></i> Add New</span>
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($budgetReports->isEmpty())
        <p class="text-gray-500">-No budget reports available for this barangay-</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Cost</th>
                    <th>Period From</th>
                    <th>Period To</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($budgetReports as $report)
                    <tr>
                        <td>{{ $report->item }}</td>
                        <td>{{ $report->cost }}</td>
                        <td>{{ $report->period_from }}</td>
                        <td>{{ $report->period_to }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
