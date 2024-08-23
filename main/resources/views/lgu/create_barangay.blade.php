@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user-shield fa-2x text-black mr-3"></i>
@endsection

@section('title', 'Barangay Admins')

@section('content')
<div class="container">
    <h2>Create Barangay</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('lgu.store-barangay') }}">
        @csrf
        <div class="form-group">
            <select name="barangay_id" class="form-control">
                @foreach($barangays as $barangay)
                    <option value="{{ $barangay->id }}">{{ $barangay->barangay_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Barangay</button>
    </form>
</div>
@endsection
