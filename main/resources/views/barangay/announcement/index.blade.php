@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-bullhorn fa-lg"></i>
@endsection

@section('title', 'Announcements')

@section('content')
<div class="py-2 px-4">
    <h2 class="important-title text-2xl font-bold mb-3">IMPORTANT ANNOUNCEMENTS:</h2>

    <hr class="border-t-2 mb-4 border-gray-300">

    <!-- Link to create a new announcement (only for admins) -->
    @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('announcements.create') }}" class="btn btn-primary mb-6 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Post event details here</a>
    @endif

    <h2 class="text-center text-gray-500 mb-2 text-lg">-Recently Announced-</h2>

    <!-- Display announcements -->
    <div class="max-h-[55vh] overflow-y-auto">
        @if($announcements->count())
        <div class="space-y-6"> <!-- Use space-y to add vertical spacing between cards -->
            @foreach($announcements as $announcement)
                <div class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-4xl mx-auto"> <!-- Max width set to large and centered -->
                    @if($announcement->imgUrl)
                        <img src="{{ asset('storage/' . $announcement->imgUrl) }}" alt="Announcement Image" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4 flex">
                        <div>
                            <h3 class="text-2xl font-semibold mb-2 text-blue-600">{{ $announcement->title }}</h3>
                            {{-- <p class="text-gray-500 mb-4">{{ \Carbon\Carbon::parse($announcement->announcement_date)->format('F d, Y') }}</p>
                            <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($announcement->content, 150, '...') }}</p> --}}
                        </div>
                        <a href="#" class="ml-auto bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">View details</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination links -->
        <div class="pagination mt-6">
            {{ $announcements->links() }}
        </div>
        @else
            <p class="text-center text-gray-500 mt-10">No announcements found.</p>
        @endif
    </div>
</div>
@endsection
