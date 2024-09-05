
@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-bullhorn"></i>
@endsection

@section('title', 'Announcements')

@section('content')
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
