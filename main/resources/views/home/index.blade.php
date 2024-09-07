@extends('templates.top-nav')

@section('content')

<style>
    body {
        background-image: url('{{ asset('/images/lgu-building.jpg') }}');
        background-size: cover;
    }
</style>

<div class="title">
    <div class="img-logo">
        <img class="rounded-full" src="{{ asset('images/bims-logo.png') }}" alt="LGU logo">
    </div>
    <div class="logo-title font-bold text-start">
        <header class="text-4xl">B<span class="text-2xl text-blue-300">ARANGAY</span></header>
        <header class="text-4xl">I<span class="text-2xl text-blue-300">NFORMATION</span></header>
        <header class="text-4xl">M<span class="text-2xl text-blue-300">ANAGEMENT</span></header>
        <header class="text-4xl">S<span class="text-2xl text-blue-300">YSTEM</span></header>
    </div>
</div>
<div class="login-form">
    <label for="lgu">LGU Tubigon</label>
    <div>
        <a href="/lgu-login">Log in</a>
    </div>
</div>
@endsection