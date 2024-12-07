<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Request ( Job Seeker Certificate )</title>
    <style>

        * {
            padding: 0;
            margin: 0;
        }

        .heading {
            text-align: center;
            margin-top: -100px;
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
            width: 470px;
            margin-left: 300px;
            margin-top: -750px;
        }

        .info-heading {
            text-align: center;
            width: 160px;    
            margin-top: -500px;
            margin-left: 130px;
        }

        .info-title {
            font-weight: bold;
        }

        .name, .purpose {
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .text {
            margin-left: 50px;
        }

        .text-last {
            margin-bottom: 
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

        .barangay-name , .captain-name {
            text-transform: uppercase;
        }
    </style>
</head>
<body> 
    <div class="container">
        <div class="logo">
            <img src="{{ public_path('storage/images/' . $barangay->logo) }}" style="width: 120px; height:auto" alt="">
        </div>
        <div class="heading">
            <header>Republic of the Philippines</header>
            <header>Province of Bohol</header>
            <header>Municipality of Tubigon</header>
            <header class="barangay-name">BARANGAY OF {{ $barangay->barangay_name }}</header>
            <br>
            <header>OFFICE OF THE PUNONG BARANGAY</header>
            <div class="line-break"></div>
        </div>
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
                    @if ($official->position === 'Kagawad')
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
            
            <div class="information-detail">
                <div class="background-logo">
                    <img src="{{ public_path('storage/images/' . $barangay->logo) }}" style="width: 500px; height:auto" alt="">
                </div>
                <div class="info-heading">
                    <header class="info-title">CERTIFICATION</header>
                    <div class="line-break2"></div>
                    <p>(Job Seeker Certificate)</p>
                </div>
                <br>
                <br>
                <p>TO WHOM IT MAY CONCERN:</p>
                <br>
                <br>
                <p class="text">This is to certify that <span class="name">{{ $certificateRequest->resident->first_name }} {{ $certificateRequest->resident->last_name }} {{ $certificateRequest->resident->suffix }}</span> , {{ \Carbon\Carbon::parse($certificateRequest->resident->birth_date)->age }}</p>
                <p>years old, {{ $certificateRequest->resident->gender }}, {{ $certificateRequest->resident->civil_status }} is a bona fide resident of Purok {{ $certificateRequest->resident->purok->purok_number}} {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                <br>
                <p class="text">This certification is being issued upon her request for her</p>
                <p>application for <span class="purpose">{{ $certificateRequest->purpose }} purposes</span>.</p>
                <br>
                <p class="text">Issued this day of {{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }}
                    at Barangay {{ $barangay->barangay_name }},</p>
                <p class="text-last">Tubigon, Bohol, Philippines.</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                @foreach ($barangayOfficials as $official)
                    @if ($official->position === 'Barangay Captain')
                        <p class="last-info">{{ $official->resident->first_name }} {{ $official->resident->middle_name }} {{ $official->resident->last_name }}</p>
                    @endif
                @endforeach
                <div class="line-break-last"></div>
                <p class="last-info2">PUNONG BARANGAY</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p>Receipt No: </p>
                <p>Date: {{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }}</p>
                <p>Place Issued: {{ $barangay->barangay_name }}, Tubigon, Bohol</p>
            </div>
        </div>
    </div>
</body>
</html>
