@extends('user.templates.navigation-bar')

@section('title', 'Request Certificate')

@section('content')
<div class="flex justify-center items-center">
    <div class="px-4 bg-white overflow-y-auto max-h-[500px] w-[900px]">
        <div class="flex justify-center pt-[50px] items-center mb-[25px]">
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
        <!-- Certificate Information Section -->
        <div class="custom-form-container bg-white p-6 rounded-lg shadow-md mx-auto w-full max-w-3xl">
            <form action="{{ route('certificates.customized.submit') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="resident_id" value="{{ $resident->id }}">
        
                <!-- Certificate Name Input -->
                <div class="flex justify-center">
                    <input type="text" 
                           name="certificate_name" 
                           class="border border-gray-300 rounded-md py-2 px-4 font-bold uppercase text-xl w-full max-w-md" 
                           placeholder="Certificate Name" 
                           required>
                </div>
        
                <!-- TO WHOM IT MAY CONCERN -->
                <p class="font-semibold text-lg">TO WHOM IT MAY CONCERN:</p>
        
                <!-- Certification Details -->
                <div class="text-gray-800 leading-relaxed">
                    <p>
                        This is to certify that 
                        <span class="font-semibold uppercase">
                            {{ $resident->first_name }} {{ $resident->last_name }} {{ $resident->suffix }}
                        </span>, 
                        {{ \Carbon\Carbon::parse($resident->birth_date)->age }} years old,
                        {{ $resident->gender }}, {{ $resident->civil_status }}, is a bona fide 
                    </p>
                    <p>resident of Purok {{ $resident->purok->purok_number }}, Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                </div>
        
                <!-- Purpose -->
                <div>
                    <p class="text-gray-800">
                        This certification is being issued upon 
                        <span class="font-semibold">
                            @if($resident->gender == 'male') his @else her @endif
                        </span> 
                        request for 
                        <span class="font-semibold">
                            @if($resident->gender == 'male') his @else her @endif
                        </span> 
                        application for:
                    </p>
                    <input type="text" 
                           name="purpose" 
                           placeholder="Purpose" 
                           class="border border-gray-300 rounded-md py-2 px-4 w-full max-w-md mt-2" 
                           required>
                </div>
        
                <!-- Date -->
                <div class="text-gray-800">
                    <p>
                        Issued this day of 
                        <input type="date" 
                               name="date_needed" 
                               class="border border-gray-300 rounded-md py-1 px-2" 
                               value="{{ now()->format('Y-m-d') }}" 
                               required>
                        at Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol, Philippines.
                    </p>
                </div>
        
                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg">
                        Submit
                    </button>
                </div>
            </form>
        </div>        
    </div>
</div>
    
@endsection
