@extends('layout')

@section('content')

<h1>Barangay Dashboard</h1>
<div>
    <a href="{{ route('barangay.create-user') }}" class="barangay-button">Add Resident</a>
</div>


<style>
    .barangay-button {
        padding: 10px;
        border-radius: 9px;
        background-color: black;
        text-decoration: none;
        color:white;
    }
</style>
@endsection
