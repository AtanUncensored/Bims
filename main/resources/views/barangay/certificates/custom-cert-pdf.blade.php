<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="px-4 bg-white overflow-y-auto max-h-[500px]">
        <div class="header flex justify-start pt-[50px] ml-[300px] items-center mb-[25px]">
            <div class="logo">
                <img src="{{ public_path('storage/images/' . $barangay->logo) }}" style="width: 120px; height:auto" alt="">
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
    
        <div>
            <!-- Certificate Information Section -->
            <div class="information-detail">
                <h3 class="text-center font-bold uppercase mb-4">{{ $certificateName ?? 'Certificate' }}</h3>
    
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
                    This certification is being issued upon their request for their
                    application for 
                    <strong>{{ $purpose ?? 'Purpose not specified' }}</strong>.
                </p>
                <br>
                <p>Receipt Number: {{$or_number}}</p>
                <p class="text">
                    Issued this day of 
                    <strong>{{ \Carbon\Carbon::now()->format('F d, Y') }}</strong>
                    at Barangay {{ $barangay->barangay_name }},
                </p>
                <p class="text-last">Tubigon, Bohol, Philippines.</p>
            </div>
        </div>
        
    </div>
</body>
</html>

