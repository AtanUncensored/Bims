@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fas fa-house fa-lg"></i>
@endsection

@section('title', 'Puroks')

@section('content')
    <div class="py-2 px-4">

        <a href="{{ route('barangay.purok.createPurok') }}" class="py-2 px-4 bg-blue-600 text-white rounded items-center space-x-2 hover:bg-blue-500 transition">
            <i class="fa-solid fa-plus"></i>
            <span>Add Purok</span>
        </a>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">
            @foreach ($puroks as $purok)
                <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800">Purok {{ $purok->purok_number }}</h3>

                    <div class="mt-6 float-right">
                        <a href="{{ route('purok.residents', $purok->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            View
                        </a>
                    </div>

                </div>
                
            @endforeach
        </div>

    </div>
@endsection
