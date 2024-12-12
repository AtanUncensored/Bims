@extends('user.templates.navigation-bar')

@section('title', 'Request Certificate')

@section('content')
    <div class="logo">
        <img src="{{ public_path('storage/images/' . $barangay->logo) }}" style="width: 120px; height:auto" alt="Barangay Logo">
    </div>

    <!-- Certificate Header -->
    <div class="heading">
        <header>Republic of the Philippines</header>
        <header>Province of Bohol</header>
        <header>Municipality of Tubigon</header>
        <header class="barangay-name">BARANGAY OF {{ $barangay->barangay_name }}</header>
        <br>
        <header>OFFICE OF THE PUNONG BARANGAY</header>
        <div class="line-break"></div>
    </div>

    <!-- Officials Section -->
    <div class="content">
        <div class="officials">
            <div class="line"></div>
            @foreach ($barangayOfficials as $official)
                @if ($official->position === 'Barangay Captain')
                    <p class="captain-name">{{ $official->resident->first_name }} {{ $official->resident->middle_name }} {{ $official->resident->last_name }}</p>
                    <p class="details">Punong Barangay</p>
                @endif
            @endforeach

            <p class="details">BARANGAY KAGAWAD</p>
            @foreach ($barangayOfficials as $official)
                @if ($official->position === 'Barangay Kagawad')
                    <p class="details">{{ $official->resident->first_name }} {{ $official->resident->middle_name }} {{ $official->resident->last_name }}</p>
                @endif
            @endforeach

            @foreach ($barangayOfficials as $official)
                @if ($official->position === 'Sk Chairperson')
                    <p class="details">{{ $official->resident->first_name }} {{ $official->resident->middle_name }} {{ $official->resident->last_name }}</p>
                    <p class="details">SK Chairperson</p>
                @endif
            @endforeach

            @foreach ($barangayOfficials as $official)
                @if ($official->position === 'Secretary')
                    <p class="details">{{ $official->resident->first_name }} {{ $official->resident->middle_name }} {{ $official->resident->last_name }}</p>
                    <p class="details">Barangay Secretary</p>
                @endif
            @endforeach

            @foreach ($barangayOfficials as $official)
                @if ($official->position === 'Treasurer')
                    <p class="details">{{ $official->resident->first_name }} {{ $official->resident->middle_name }} {{ $official->resident->last_name }}</p>
                    <p class="last-title">Barangay Treasurer</p>
                @endif
            @endforeach
            <div class="line"></div>
        </div>

        <!-- Certificate Information Section -->
        <form action="{{ route('certificates.customized.submit') }}" method="POST">
            @csrf
            <div class="information-detail">
                <div class="info-heading">
                    <!-- Certificate Name as Text Field -->
                    <input 
                        type="text" 
                        name="certificate_name" 
                        value="{{ old('certificate_name', $certificateRequest->certificate_name) }}" 
                        placeholder="Certificate Name (e.g., Business Certificate)" 
                        class="info-title"
                    >
                    @error('certificate_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="line-break2"></div>
                </div>
                <br><br>

                <p>TO WHOM IT MAY CONCERN:</p>
                <br><br>

                <!-- Certificate Content as Text Area -->
                <textarea 
                    name="certificate_body" 
                    rows="8" 
                    cols="50" 
                    placeholder="Enter the certificate details here..."
                >{{ old('certificate_body', $certificateRequest->body) }}</textarea>
                @error('certificate_body')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br><br>

                <p>Issued this day of {{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }} at Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol, Philippines.</p>
                <br><br>

                <!-- Barangay Captain's Name -->
                @foreach ($barangayOfficials as $official)
                    @if ($official->position === 'Barangay Captain')
                        <p class="last-info">{{ $official->resident->first_name }} {{ $official->resident->middle_name }} {{ $official->resident->last_name }}</p>
                    @endif
                @endforeach

                <div class="line-break-last"></div>
                <p class="last-info2">PUNONG BARANGAY</p>
            </div>

            <!-- Request Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Request Certificate</button>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
@endsection

<style>
    * {
        padding: 0;
        margin: 0;
    }

    .heading {
        text-align: center;
        margin-top: -80px;
        font-weight: bold;
    }

    .line-break {
        border-top: 2px solid black;
        margin: 15px 70px;
    }

    .line-break2 {
        border-top: 2px solid black;
    }

    .line {
        border-top: 5px solid rgb(22, 92, 150);
        margin: 10px 10px;
    }

    .last-title {
        padding-bottom: 40px;
    }

    .details {
        margin: 15px;
    }

    .content {
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        align-items: flex-start;
    }

    .officials {
        margin-left: 25px;
        width: 230px;
        font-style: italic;
        text-align: center;
        padding: 15px;
        border: 2px solid rgb(102, 178, 250);
        border-radius: 5px;
    }

    .information-detail {
        width: 650px;  /* Increased width */
        margin-left: 100px;  /* Shifted the form to the left */
        margin-top: 40px;
    }

    .info-heading {
        text-align: center;
        width: 100%;
        margin-top: 20px;
    }

    .info-title {
        font-weight: bold;
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
    }

    .name, .purpose {
        font-weight: bold;
        text-transform: uppercase;
    }

    .text {
        margin-left: 50px;
    }

    .text-last {
        margin-bottom: 15px;
    }

    .last-info {
        font-weight: bold;
        text-align: right;
        text-transform: uppercase;
        margin-right: 45px;
    }

    .last-info2 {
        font-weight: bold;
        text-align: right;
        margin-right: 60px;
    }

    .line-break-last {
        border-top: 2px solid black;
        margin-left: 230px;
        margin-right: 45px;
    }

    .logo {
        margin-left: 150px;
        margin-top: 30px;
    }

    .background-logo {
        margin-top: 10px;
        margin-left: -150px;
        opacity: 0.1;
    }

    .barangay-name, .captain-name {
        text-transform: uppercase;
    }
</style>
