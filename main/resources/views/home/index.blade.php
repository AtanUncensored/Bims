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
        <img class="rounded-full" src="{{ asset('images/tubigon-logo.png') }}" alt="LGU logo">
    </div>
    <div class="bims">
        <header>B<span class="text-3xl text-black">ARAMGAY</span></header>
        <header>I<span class="text-3xl text-black">INFORMATION AND</span></header>
        <header>M<span class="text-3xl text-black">ANAGEMENT</span></header>
        <header>S<span class="text-3xl text-black">YSTEM</span></header>
    </div>
</div>
<div class="login-form">
    <label for="lgu">LGU Tubigon</label>
    <div>
        <a href="/lgu-login">Log in</a>
    </div>
</div>
@endsection