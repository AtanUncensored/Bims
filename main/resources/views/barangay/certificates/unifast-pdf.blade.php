<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate Request ( Unifast Certificate )</title>
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
         

        .information-detail {
            margin-left: 100px;
        }

        .info-heading {
            text-align: center;
            width: 500px;    
            margin-top: -500px;
            margin-left: 80px;
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
            
            <div class="information-detail">
                <div class="background-logo">
                    <img src="{{ public_path('storage/images/' . $barangay->logo) }}" style="width: 500px; height:auto" alt="">
                </div>
                <div class="info-heading">
                    <h2 class="info-title">Certificate of Residency</h2>
                </div>
                <br>
                <br>
                <p>TO WHOM IT MAY CONCERN:</p>
                <br>
                <br>
                <p class="text">This is to certify that <span class="name">{{ $certificateRequest->resident->first_name }} {{ $certificateRequest->resident->last_name }} {{ $certificateRequest->resident->suffix }}</span> , {{ $certificateRequest->resident->citizenship }} ,  {{ \Carbon\Carbon::parse($certificateRequest->resident->birth_date)->age }}</p>
                <p>years old, {{ $certificateRequest->resident->gender }}, {{ $certificateRequest->resident->civil_status }} is a bona fide resident of Purok {{ $certificateRequest->resident->purok->purok_number}} {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                <p>
                    She is the daughter of 
                    <b>
                      @if($certificateRequest->resident->father_id && $certificateRequest->resident->mother_id)
                        {{ $certificateRequest->resident->father->first_name }} {{ $certificateRequest->resident->father->last_name }} 
                        @if($certificateRequest->resident->father->suffix) 
                          {{ $certificateRequest->resident->father->suffix }} 
                        @endif
                        and 
                        {{ $certificateRequest->resident->mother->first_name }} {{ $certificateRequest->resident->mother->last_name }} 
                        @if($certificateRequest->resident->mother->suffix) 
                          {{ $certificateRequest->resident->mother->suffix }} 
                        @endif</b>
                        .Both are residents of the afore-mentioned barangay.
                        <b>
                      @elseif($certificateRequest->resident->father_id)
                        {{ $certificateRequest->resident->father->first_name }} {{ $certificateRequest->resident->father->last_name }} 
                        @if($certificateRequest->resident->father->suffix) 
                          {{ $certificateRequest->resident->father->suffix }} 
                        @endif</b>
                        , resident of the afore-mentioned barangay.
                        <b>
                      @elseif($certificateRequest->resident->mother_id)
                        {{ $certificateRequest->resident->mother->first_name }} {{ $certificateRequest->resident->mother->last_name }} 
                        @if($certificateRequest->resident->mother->suffix) 
                          {{ $certificateRequest->resident->mother->suffix }} 
                        @endif</b>
                        , resident of the afore-mentioned barangay.
                      @else
                        The parents are not available.
                      @endif

                  </p>
                  

                <br>
                <p class="text">This certification is being issued upon request of {{ $certificateRequest->requester_name }} </p>
                <p> for <span class="purpose">{{ $certificateRequest->purpose }}</span>  and for whatever purpose this may serve her </p>
                <br>
                <p class="text">Given this day of {{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }}
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
                <p>Receipt No: {{$certificateRequest->or_number}} </p>
                <p>Date: {{ \Carbon\Carbon::parse($certificateRequest->date_needed)->format('F j, Y') }}</p>
                <p>Place Issued: {{ $barangay->barangay_name }}, Tubigon, Bohol</p>
            </div>
        </div>
    </div>
</body>
</html>
