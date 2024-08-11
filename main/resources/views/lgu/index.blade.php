@extends('layout')

@section('content')

<h1>LGU Dashboard</h1>
<div>
    <a href="{{ route('lgu.create-barangay') }}" class="barangay-button">Add Barangay</a>
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

