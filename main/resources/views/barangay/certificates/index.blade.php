@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-certificate fa-lg"></i>
@endsection

@section('title', 'Certificates')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- Latest Requests Section -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Latest Certificate Requests</h2>
            @if($latestRequests->isEmpty())
                <div class="text-center py-16">
                    <i class="fa-solid fa-folder-open fa-3x text-muted"></i>
                    <p class="mt-3 text-muted text-gray-500">No recent certificate requests found.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-gray-600">Full Name</th>
                                <th class="px-4 py-2 text-left text-gray-600">Certificate Type</th>
                                <th class="px-4 py-2 text-left text-gray-600">Purpose</th>
                                <th class="px-4 py-2 text-left text-gray-600">Date Needed</th>
                                <th class="px-4 py-2 text-center text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestRequests as $request)
                                <tr class="border-b hover:bg-gray-50 transition duration-200">
                                    <td class="px-4 py-2">{{ $request->full_name }}</td>
                                    <td class="px-4 py-2">{{ $request->certificate_type }}</td>
                                    <td class="px-4 py-2">{{ $request->purpose }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($request->date_needed)->format('F j, Y') }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="{{ route('certificate.download', $request->id) }}" class="btn-download text-white bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-full text-sm">
                                            @if(is_null($request->downloaded_at))
                                                Download
                                            @else
                                                Download Again
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Downloaded Requests Section -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Downloaded Certificate Requests</h2>
            @if($downloadedRequests->isEmpty())
                <div class="text-center py-16">
                    <i class="fa-solid fa-folder-open fa-3x text-muted"></i>
                    <p class="mt-3 text-muted text-gray-500">No downloaded certificate requests found.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-gray-600">Full Name</th>
                                <th class="px-4 py-2 text-left text-gray-600">Certificate Type</th>
                                <th class="px-4 py-2 text-left text-gray-600">Purpose</th>
                                <th class="px-4 py-2 text-left text-gray-600">Date Needed</th>
                                <th class="px-4 py-2 text-center text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($downloadedRequests as $request)
                                <tr class="border-b hover:bg-gray-50 transition duration-200">
                                    <td class="px-4 py-2">{{ $request->full_name }}</td>
                                    <td class="px-4 py-2">{{ $request->certificate_type }}</td>
                                    <td class="px-4 py-2">{{ $request->purpose }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($request->date_needed)->format('F j, Y') }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="{{ route('certificate.download', $request->id) }}" class="btn-download text-white bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-full text-sm">
                                            Download Again
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
