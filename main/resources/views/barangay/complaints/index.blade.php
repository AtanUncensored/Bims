@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-regular fa-newspaper fa-xl"></i>
@endsection

@section('title', 'Complaints')

@section('content')

<div class="py-6 px-8 bg-gray-100 min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-3xl text-gray-800 font-semibold mb-6">Complaint Record</h2>

        <!-- Search bar -->
        <div class="flex justify-center mb-6">
            <form class="inline-flex items-center">
                <input type="text" name="search" placeholder="Search record..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500">
                <button type="submit" class="py-2 px-4 bg-gray-500 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <!-- Complaints Table -->
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300 text-gray-600">
                    <th class="py-3 px-6 text-left">Complain Type</th>
                    <th class="py-3 px-6 text-left">Date of Incident</th>
                    <th class="py-3 px-6 text-left">Details</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($complaints as $complaint)
                <tr class="border-b">
                    <td class="py-3 px-6">{{ $complaint->complain_type }}</td>
                    <td class="py-3 px-6">{{ $complaint->date_of_incident }}</td>
                    <td class="py-3 px-6">{{ Str::limit($complaint->details, 50) }}</td>
                    <td class="py-3 px-6 text-center">
                        <a href="{{ route('barangay.complaints.view', $complaint->id) }}" class="text-blue-500 hover:underline mx-2">View</a>
                        {{-- <a href="{{ route('complaints.reply', $complaint->id) }}" class="text-green-500 hover:underline mx-2">Reply</a> --}}
                        {{-- <form action="{{ route('complaints.delete', $complaint->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline mx-2" onclick="return confirm('Are you sure you want to delete this complaint?');">Delete</button>
                        </form> --}}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-4 text-center text-gray-500">No complaints have been filed yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
