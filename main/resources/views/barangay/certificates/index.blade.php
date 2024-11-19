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
                                <th class="px-4 py-2 text-center text-gray-600">Actions</th>
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
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('certificate.download', ['certificateId' => $request->id, 'action' => 'download']) }}" 
                                            class="btn-download text-white hover:bg-blue-200 px-6 py-2 rounded-full text-sm">
                                                @if(is_null($request->downloaded_at))
                                                <!-- download sa pdf -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="black" class="bi bi-download" viewBox="0 0 18 18">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                                    </svg>
                                                @else
                                                <!-- download again button -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="black" class="bi bi-download" viewBox="0 0 18 18">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                                    </svg>
                                                @endif
                                            </a>
                                            <button onclick="printCertificate('{{ route('certificate.download', ['certificateId' => $request->id, 'action' => 'print']) }}')" 
                                                    class="btn-print text-white hover:bg-green-200 px-6 py-2 rounded-full text-sm ml-2">
                                                    <!-- print button -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="black" class="bi bi-printer" viewBox="0 0 18 18">
                                                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                                        </svg>
                                            </button>
                                        </div>
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
                                <th class="px-4 py-2 text-center text-gray-600">Actions</th>
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
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('certificate.download', ['certificateId' => $request->id, 'action' => 'download']) }}" 
                                            class="btn-download text-white hover:bg-blue-200 px-6 py-2 rounded-full text-sm">
                                            <!-- download again button  -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="black" class="bi bi-download" viewBox="0 0 18 18">
                                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                                </svg>
                                            </a>
                                            <button onclick="printCertificate('{{ route('certificate.download', ['certificateId' => $request->id, 'action' => 'print']) }}')" 
                                                    class="btn-print text-white hover:bg-green-200 px-6 py-2 rounded-full text-sm ml-2">
                                                    <!-- print -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="black" class="bi bi-printer" viewBox="0 0 18 18">
                                                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                                        </svg>
                                            </button>
                                        </div>
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

<script>
    function printCertificate(url) {
        const printWindow = window.open(url, '_blank');
        printWindow.onload = () => {
            printWindow.print();
        };
    }
</script>
@endsection
