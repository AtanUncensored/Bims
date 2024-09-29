
@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-file-lines fa-lg"></i>
@endsection

@section('title', 'Budget Reports')

@section('content')

<div class="py-2 px-4 bg-white rounded">
    <h1 class="text-center font-semibold text-2xl text-blue-600">Add New Expense</h1>

    @if (session('success'))
        <div class="alert alert-success p-2 mt-2 mb-2 bg-green-100 text-green-800 rounded border border-green-300 text-center">
            {{ session('success') }}
        </div>
    @endif

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
        <div class="form-group">
            <label for="item">Item:</label>
            <input type="text" class="form-control border border-gray-600 rounded" id="item" name="item" value="{{ old('item') }}" required>
        </div>
        <div class="form-group">
            <label for="cost">Cost:</label>
            <input type="number" step="0.01" class="form-control border border-gray-600 rounded" id="cost" name="cost" value="{{ old('cost') }}" required>
        </div>
        <div class="form-group">
            <label for="period_from">Period From:</label>
            <input type="date" class="form-control border border-gray-600 rounded" id="period_from" name="period_from" value="{{ old('period_from') }}" required>
        </div>
        <div class="form-group">
            <label for="period_to">Period To:</label>
            <input type="date" class="form-control border border-gray-600 rounded" id="period_to" name="period_to" value="{{ old('period_to') }}" required>
        </div>

        <div class="flex justify-between mt-3">
            <a href="/reports" class="py-2 px-4 bg-gray-600 text-white rounded">Return</a>
             <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection