@extends('user.templates.navigation-bar')

@section('icon')
<i class="fa-regular fa-newspaper fa-xl"></i>
@endsection

@section('title', 'Complaints')

@section('content')

  <div class="py-2 px-4">
    <h2 class="text-2xl font-semibold text-gray-800">Complaints</h2>
    <hr class="border-t-2 mt-3 mb-6 border-gray-300">

    <!-- Add Complaint Button -->
    <div class="mb-4">
        <a href="{{ route('user.complaint.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700">
            Add Complaint
        </a>
    </div>

    <!-- List of complaints (if needed) -->
    @foreach($complaints as $complaint)
      <div class="bg-white p-4 mb-4 rounded-lg shadow-lg">
          <h3 class="text-lg font-semibold">{{ $complaint->complain_type }}</h3>
          <p class="text-gray-700">{{ $complaint->details }}</p>
          <p class="text-gray-500 text-sm">Date: {{ $complaint->date_of_incident }}</p>

          <div class="border">
            <h5 class=text-blue-300>barangay reply:</h5>
            <p class=" px-4 py-2">
                @if($complaint->reply)
                    {{ $complaint->reply }}
                @else
                    <span class="text-gray-500">No reply yet</span>
                @endif
            </p>
          </div>
      </div>
    @endforeach

  </div>

@endsection
