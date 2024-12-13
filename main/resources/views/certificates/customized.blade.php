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
        <div class="info-heading font-bold flex justify-center items-center">
            <!-- Certificate Name as Text Field -->
            <input 
                type="text" 
                name="certificate_name" 
                value="{{ old('certificate_name', $certificateRequest->certificate_name) }}" 
                placeholder="Certificate Name (e.g., Business Certificate)" 
                class="info-title uppercase text-[20px]"
            >
            @error('certificate_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="line-break2"></div>
        </div>
        <br><br>

        <p class="ml-[15px]">TO WHOM IT MAY CONCERN:</p>
        <br><br>

        <!-- Certificate Content as Text Area -->
        <textarea 
            class="ml-[25px]"
            name="certificate_body" 
            rows="8" 
            cols="140" 
            placeholder="Enter the certificate details here..."
        >{{ old('certificate_body', $certificateRequest->body) }}</textarea>
        @error('certificate_body')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br><br>

        <p class="ml-[15px]">Issued this day of {{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }} at Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol, Philippines.</p>
        <br><br>

        <!-- Barangay Captain's Name -->
        @foreach ($barangayOfficials as $official)
            @if ($official->position === 'Barangay Captain')
                <p class="last-info">{{ $official->resident->first_name }} {{ $official->resident->middle_name }} {{ $official->resident->last_name }}</p>
            @endif
        @endforeach

    </div>

    <!-- Request Button -->
    <div class="form-group flex justify-center items-center">
        <button type="submit" class="btn btn-primary py-2 px-4 bg-blue-500 text-white rounded-lg">Request Certificate</button>
    </div>
</form>
    </div>
</div>
    
@endsection
