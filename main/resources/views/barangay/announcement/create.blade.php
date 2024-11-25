@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-bullhorn fa-lg"></i>
@endsection

@section('title', 'Announcements')

@section('content')
<div class="container">
    <h2 class="important-title text-center">Add New Announcement</h2>
    <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="max-h-[52vh] overflow-y-auto">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control border border-gray-600 rounded" value="{{ old('title') }}">
            @error('title')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="announcement_date">Announcement Date:</label>
            <input type="date" name="announcement_date" id="announcement_date" class="form-control border border-gray-600 rounded" value="{{ old('announcement_date') }}">
            @error('announcement_date')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for='expiration_date'>Expiration Date and Time:</label>
            <input type="datetime-local" id='expiration_date' name="expiration_date" class="border border-gray-600 focus:ring-blue-500 focus:border-blue-500 block w-full rounded-md" value="{{ old('expiration_date') }}">
            @error('expiration_date')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control border border-gray-600 rounded"rows="3">{{ old('content') }}</textarea>
            @error('content')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="imgUrl">Upload Image:</label>
            <input type="file" name="imgUrl" id="imgUrl" class="form-control-file">
            @error('imgUrl')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="flex justify-between mt-3">
        <a href="/announcements/show" class="py-2 px-4 bg-gray-600 text-white rounded">Return</a>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Create Announcement</button>
    </div>
    </form>
</div>
@endsection
