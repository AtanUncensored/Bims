@extends('barangay.templates.navigation-bar')

@section('content')

<h1>Budget Reports for {{ Auth::user()->barangay->barangay_name }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($budgetReports->isEmpty())
        <p>No budget reports available for your barangay.</p>
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

@endsection
