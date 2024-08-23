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
</div>
<div class="login-form">
    <label for="lgu">LGU Tubigon</label>
    <div>
        <a href="/lgu-login">Log in</a>
    </div>
</div>
@endsection