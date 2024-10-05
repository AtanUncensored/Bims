@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-bullhorn fa-lg"></i>
@endsection

@section('title', 'Announcements Details')

@section('content')

    <div class="py-2 px-4">
        <div class="image-area">
            @if($announcement->imgUrl)
            <img src="{{ asset('storage/' . $announcement->imgUrl) }}" alt="Announcement Image" class="w-full h-48 object-cover">
            @endif
        </div>
        <div class="title-area mt-3">
            <h3 class="text-2xl font-semibold text-center mb-2 text-blue-600">{{ $announcement->title }}</h3>
        </div>
        <div class="content-area mt-3 bg-white rounded-lg py-2 px-4">
            <div class="flex justify-between items-center">
                <p class="font-semibold text-gray-600 py-2 px-4 uppercase">Content :</p>
                <p class="text-[15px] font-semibold mr-3">Date Scheduled: <span class="text-red-600">{{ $announcement->announcement_date }}</span></p>
            </div>
            <div class="max-h-[27vh] overflow-y-auto bg-gray-200 py-2 px-4"> 
                <p class="rounded-lg">{{ $announcement->content }}</p>
           
            </div> 
            <div class="flex justify-end mt-3">
                <a href="{{ url('/announcements/show') }}"  class="inline-block align-baseline font-bold text-[15px] text-blue-600 hover:text-blue-800">
                    Return to Announcements
                </a>
            </div>
        </div>
    </div>

@endsection