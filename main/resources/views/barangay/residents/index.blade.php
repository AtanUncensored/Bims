
@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-users fa-xl"></i>
@endsection

@section('title', 'Residents')

@section('content')

<div class="add-button py-2 px-4 bg-blue-500 text-white rounded">
    <a href="{{ route('barangay.create-user') }}" class="barangay-button">Add Resident</a>
</div>

<div class="container">
    <h1>Residents of {{ Auth::user()->barangay->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Purok</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($residents as $resident)
                <tr>
                    <td>{{ $resident->first_name }}</td>
                    <td>{{ $resident->last_name }}</td>
                    <td>{{ $resident->purok }}</td>
                    <td>{{ $resident->gender }}</td>
                    <td>
                        <!-- Add actions for edit or delete if needed -->
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No residents found for this barangay.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
