
@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-file-lines fa-lg"></i>
@endsection

@section('title', 'Budget Reports')

@section('content')

<div class="container">
    <h2>Edit Budget Report</h2>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Display validation errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barangay.budget-report.update', $budgetReport->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="item" class="form-label">Item</label>
            <input type="text" class="form-control" id="item" name="item" value="{{ old('item', $budgetReport->item) }}" required>
        </div>

        <div class="mb-3">
            <label for="cost" class="form-label">Cost</label>
            <input type="text" class="form-control" id="cost" name="cost" value="{{ old('cost', $budgetReport->cost) }}" required>
        </div>

        <div class="mb-3">
            <label for="period_from" class="form-label">Period From</label>
            <input type="date" class="form-control" id="period_from" name="period_from" value="{{ old('period_from', $budgetReport->period_from) }}" required>
        </div>

        <div class="mb-3">
            <label for="period_to" class="form-label">Period To</label>
            <input type="date" class="form-control" id="period_to" name="period_to" value="{{ old('period_to', $budgetReport->period_to) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Budget Report</button>
    </form>
</div>
@endsection