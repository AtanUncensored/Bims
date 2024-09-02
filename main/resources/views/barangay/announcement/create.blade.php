

@extends('barangay.templates.navigation-bar')

@section('content')
<div class="container">
    <h2 class="important-title">Create New Announcement</h2>

    <!-- Form to create a new announcement -->
    <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="announcement_date">Date</label>
            <input type="date" name="announcement_date" id="announcement_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="imgUrl">Upload Image</label>
            <input type="file" name="imgUrl" id="imgUrl" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Create Announcement</button>
    </form>
</div>
@endsection
