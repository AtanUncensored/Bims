@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-house fa-lg text-black mr-1"></i>
@endsection

@section('content')
<div id="title" class="py-2 px-4">
    <h1 class="text-2xl font-bold text-green-600">AVAILABLE BARANGAYS:</h1>
</div>

<div class="my-4">
    <hr class="border-t-2 m-[15px] border-gray-300">
</div>
<div class="container mx-auto px-4 max-h-[70vh] overflow-y-auto">
    <div class="flex flex-wrap -mx-4">
        @foreach($barangays as $barangay)
            <div class="w-full md:w-1/4 px-4 mb-4">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="flex mb-4">

                        <!-- para ni sa icon anang dashboard -->
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
                        <h2 class="text-[15px] font-bold text-gray-600">Brgy. <span class="text-blue-600">{{ $barangay->barangay_name }}</span>, Tubigon, Bohol, Philippines</h2>
                    </div>
                    <hr class="border-t-2 border-gray-300">
                    <div class="mt-4 flex justify-between">
                        <p class="text-gray-600"><i class="fas fa-user fa-lg mr-2 text-blue-500"></i> No. of Users:</p>
                        <header class="text-green-600 font-bold text-2xl">{{ $barangay->users_count }}</header>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
