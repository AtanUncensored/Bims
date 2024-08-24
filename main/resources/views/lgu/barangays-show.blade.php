@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user fa-2x text-black mr-3"></i>
@endsection

@section('title', 'Barangay Details')

@section('content')
<div class="p-6">
    <h1>{{ $barangay->id}}</h1>
    <h2 class="text-2xl font-bold mb-4">{{ $barangay->barangay_name }}</h2>

    
    <div class="mt-4">
        <a href="{{ route('lgu.barangays-list') }}" class="text-blue-500 hover:text-blue-700">Back to List</a>
    </div>
</div>
@endsection
