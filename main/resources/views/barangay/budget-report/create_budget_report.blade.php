
@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-bullhorn"></i>
@endsection

@section('title', 'Budget Report')

@section('content')

<h1>Create New Budget Report</h1>

    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barangay.store-budgetReport') }}" method="POST">
        @csrf

        <!-- Item -->
        <div class="form-group">
            <label for="item">Item</label>
            <input type="text" class="form-control" id="item" name="item" value="{{ old('item') }}" required>
        </div>

        <!-- Cost -->
        <div class="form-group">
            <label for="cost">Cost</label>
            <input type="number" step="0.01" class="form-control" id="cost" name="cost" value="{{ old('cost') }}" required>
        </div>

        <!-- Period From -->
        <div class="form-group">
            <label for="period_from">Period From</label>
            <input type="date" class="form-control" id="period_from" name="period_from" value="{{ old('period_from') }}" required>
        </div>

        <!-- Period To -->
        <div class="form-group">
            <label for="period_to">Period To</label>
            <input type="date" class="form-control" id="period_to" name="period_to" value="{{ old('period_to') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection