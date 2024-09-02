

@extends('barangay.templates.navigation-bar')

@section('content')
<div class="container">
    <h2 class="important-title">Important Announcements</h2>

    <!-- Link to create a new announcement (only for admins) -->
    @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('announcements.create') }}" class="btn btn-primary mb-3">Post event details here</a>
    @endif

    <!-- Display announcements -->
    @if($announcements->count())
        <div class="announcement-list">
            @foreach($announcements as $announcement)
                <div class="announcement-item">
                    <div class="announcement-image">
                        @if($announcement->imgUrl)
                            <img src="{{ asset('storage/' . $announcement->imgUrl) }}" alt="Announcement Image">
                        @endif
                    </div>
                    <div class="announcement-content">
                        <h3>{{ $announcement->title }}</h3>
                        <p>{{ \Carbon\Carbon::parse($announcement->announcement_date)->format('F d, Y') }}</p>
                        <p>{{ \Illuminate\Support\Str::limit($announcement->content, 150, '...') }}</p>
                        {{-- <a href="{{ route('announcements.show', $announcement->id) }}" class="btn btn-info">View details</a> --}}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination links -->
        <div class="pagination">
            {{ $announcements->links() }}
        </div>
    @else
        <p>No announcements found.</p>
    @endif
</div>
@endsection
