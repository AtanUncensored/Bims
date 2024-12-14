@extends('user.templates.navigation-bar')

@section('title', 'Request Certificate')

@section('content')
<div class="px-4 bg-white overflow-y-auto max-h-[500px]">
    <div class="header flex justify-start pt-[50px] ml-[300px] items-center mb-[25px]">
        <div class="logo">
            <img style="width: 120px; height:auto"
                src="{{ asset('storage/' . (strpos(Auth::user()->barangay->logo, 'images/') === false ? 'images/' . Auth::user()->barangay->logo : Auth::user()->barangay->logo)) }}" 
                alt="barangay/lgu logo">
        </div>
    
        <!-- Certificate Header -->
        <div class="heading text-center mt-[50px]">
            <header>Republic of the Philippines</header>
            <header>Province of Bohol</header>
            <header>Municipality of Tubigon</header>
            <header class="barangay-name uppercase font-semibold">BARANGAY OF {{ $barangay->barangay_name }}</header>
            <br>
            <header class="font-semibold">OFFICE OF THE PUNONG BARANGAY</header>
        </div>
    </div>

    <div class="">
<!-- Certificate Information Section -->
<form action="{{ route('certificates.customized.submit') }}" method="POST">
    @csrf
    <div class="information-detail">

        <input type="hidden" name="resident_id" value="{{ $resident->id }}">

       <center> <input type="text" name="certificate_name" placeholder="certificate_name" required></center>


        <p class="ml-[15px]">TO WHOM IT MAY CONCERN:</p>
        <p class="text">
            This is to certify that 
            <span class="name">
                {{ $resident->first_name }} {{ $resident->last_name }} {{ $resident->suffix }}
            </span>, 
            {{ \Carbon\Carbon::parse($resident->birth_date)->age }} years old,
            {{ $resident->gender }}, {{ $resident->civil_status }} is a bona fide resident of 
            Purok {{ $resident->purok->purok_number }}, Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol.
        </p>
        <br>
        <p class="text">
            This certification is being issued upon her request for her
            application for 
            <input type="text" name="purpose" placeholder="Purpose" required>.
        </p>
        <br>
        <p class="text">
            Issued this day of 
            <input type="date" name="date_needed" value="{{ now()->format('Y-m-d') }}">
            at Barangay {{ $barangay->barangay_name }},
        </p>
        <p class="text-last">Tubigon, Bohol, Philippines.</p>

        <button type="submit" class="btn btn-success p-2 bg-blue-300 rounded">Submit</button>
</form>
    </div>
</div>
    
@endsection
