@extends('user.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-bullhorn fa-lg"></i>
@endsection

@section('title', 'Expired Announcements')

@section('content')
<div class="py-2 px-4">
    <h2 class="text-2xl font-bold mb-4 text-red-600 uppercase">Expired Announcements:</h2>

    <hr class="border-t-2 mb-4 border-gray-300">

    <div class="max-h-[60vh] overflow-y-auto">
        @if($announcements->count())
            <div class="space-y-6"> 
                @foreach($announcements as $announcement)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden w-full mt-4 max-w-4xl mx-auto">
                        @if($announcement->imgUrl)
                            <img src="{{ asset('storage/' . $announcement->imgUrl) }}" alt="Announcement Image" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4 flex">
                            <div>
                                <h3 class="text-2xl font-semibold mb-2 text-red-600">{{ $announcement->title }}</h3>
                            </div>
                            <a href="{{ route('user.announcement.show', $announcement->id) }}" class="ml-auto bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">View details</a>
                        </div>
                    </div>
                @endforeach        
            </div>

            <div class="pagination mt-6">
                {{ $announcements->links() }}
            </div>
        @else
            <p class="text-center text-gray-500 mt-10">No expired announcements found.</p>
        @endif
    </div>
    <div class="flex justify-end mt-3 mr-8">
        <a href="{{ url('/announcements') }}" class="inline-block font-semibold text-blue-600 hover:text-blue-800 transition-all duration-300 text-lg">
            Return to Announcements
        </a>
    </div>
</div>
@endsection
