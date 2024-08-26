@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-house fa-2x text-black mr-3"></i>
@endsection

@section('content')
<div id="title" class="py-2 px-4 mt-[15px]">
    <h1 class="text-2xl font-bold text-green-600">AVAILABLE BARANGAYS:</h1>
</div>

<div class="my-4">
    <hr class="border-t-2 m-[15px] border-gray-300">
</div>
<div class="container mx-auto px-4">
    <div class="flex flex-wrap -mx-4">
        @foreach($barangays as $barangay)
            <div class="w-full md:w-1/3 px-4 mb-4">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <!-- Dynamic icon color based on index or other logic -->
                        @php
                            $iconColors = [
                                'text-blue-500', 'text-green-500', 'text-red-500', 
                                'text-yellow-500', 'text-purple-500', 'text-pink-500', 
                                'text-indigo-500', 'text-teal-500', 'text-orange-500', 
                                'text-cyan-500', 'text-amber-500', 'text-lime-500'
                            ];
                            $iconColor = $iconColors[$loop->index % count($iconColors)];
                        @endphp
                        <i class="fas fa-map-marker-alt {{ $iconColor }} text-3xl mr-3"></i>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $barangay->barangay_name }}</h2>
                    </div>
                    <div class="border-t-2 border-gray-300 my-4"></div>
                    <p class="text-gray-600"><i class="fas fa-house fa-lg text-blue-800"></i> No. of Residents</p>
                    <header class="flex justify-end text-green-600 text-xl">{{ $barangay->users_count }}</header>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
