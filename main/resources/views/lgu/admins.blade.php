@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-user-shield fa-2x text-black mr-3"></i>
@endsection

@section('title', 'Barangay Admins')

@section('content')
<div class="barangay-admins">
    <div id="title" class="py-2 px-4 mt-[15px]">
        <h1 class="text-2xl font-bold text-blue-600">Barangay Administrators</h1>
    </div>
    <div class="my-4">
        <hr class="border-t-2 m-[15px] border-gray-300">
    </div>
    <div class="mt-[20px]">
        <a href="{{ route('lgu.create-barangay') }}" class="py-2 px-4 bg-blue-600 text-white rounded">Add Barangay</a>
    </div>

</div>

@endsection