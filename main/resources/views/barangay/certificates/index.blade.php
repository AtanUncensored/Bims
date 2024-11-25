@extends('barangay.templates.navigation-bar')

@section('title', 'Certificates')

@section('content')
<div class="container px-4">

    <div class="grid grid-rows-1 md:grid-rows-2 gap-4">
        
        <!-- Latest Requests Section -->
        <div class="bg-white shadow-lg rounded-lg py-2 px-4">
            <h2 class="text-xl font-bold text-blue-500 mb-3 uppercase">Latest Certificate Requests:</h2>
            @if($latestRequests->isEmpty())
                <div class="text-center py-16">
                    <i class="fa-solid fa-folder-open fa-3x text-muted"></i>
                    <p class="mt-3 text-muted text-gray-500">No recent certificate requests found.</p>
                </div>
            @else
                <div class="max-h-[30vh] overflow-y-auto">
                    <table class="w-full table-auto border border-[2px] border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Full Name</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Certificate Type</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Purpose</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Date Needed</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Actions</th>
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
                                            <button 
                                                onclick="printCertificate('{{ route('certificate.download', [
                                                    'certificateId' => $request->id,
                                                    'requesterName' => str_replace(' ', '_', $request->requester_name),
                                                    'certificateType' => str_replace(' ', '_', $request->certificate_type),
                                                    'date' => \Carbon\Carbon::parse($request->created_at)->format('Y-m-d'),
                                                ]) }}')"
                                                class="btn-print text-white hover:bg-green-200 px-6 py-2 rounded-full text-sm ml-2">
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
        <div class="bg-white shadow-lg rounded-lg py-2 px-4">
            <h2 class="text-xl font-bold text-blue-500 mb-3 uppercase">Downloaded Certificate Requests:</h2>
            @if($downloadedRequests->isEmpty())
                <div class="text-center py-16">
                    <i class="fa-solid fa-folder-open fa-3x text-muted"></i>
                    <p class="mt-3 text-muted text-gray-500">No downloaded certificate requests found.</p>
                </div>
            @else
                <div class="max-h-[30vh] overflow-y-auto">
                    <table class="w-full table-auto border border-[2px] border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Full Name</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Certificate Type</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Purpose</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Date Needed</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Actions</th>
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
                                            <button 
                                                onclick="printCertificate('{{ route('certificate.download', [
                                                    'certificateId' => $request->id,
                                                    'requesterName' => str_replace(' ', '_', $request->requester_name),
                                                    'certificateType' => str_replace(' ', '_', $request->certificate_type),
                                                    'date' => \Carbon\Carbon::parse($request->created_at)->format('Y-m-d'),
                                                ]) }}')"
                                                class="btn-print text-white hover:bg-green-200 px-6 py-2 rounded-full text-sm ml-2">
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
