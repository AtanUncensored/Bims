@extends('barangay.templates.navigation-bar')

@section('title', 'Request Certificate')

@section('content')

<div class="container px-4 py-8">
    <!-- Latest Requests Section -->
    <div class="bg-white shadow-lg rounded-lg py-4 px-6 mb-6">
        <h2 class="text-xl font-bold text-blue-500 mb-3 uppercase">Latest Custom Certificate Requests</h2>

        @if ($latestRequests->isNotEmpty())
            <div class="max-h-[70vh] overflow-y-auto">
                <table class="w-full table-auto border border-gray-200 rounded-md">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Certificate Name</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Full Name</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Gender</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Purpose</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Date Needed</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestRequests as $cusCert)
                            <tr class="border-b hover:bg-gray-50 transition duration-200">
                                <td class="px-4 py-2">{{ $cusCert->certificate_name }}</td>
                                <td class="px-4 py-2">{{ $cusCert->resident->first_name }}</td>
                                <td class="px-4 py-2">{{ $cusCert->resident->gender }}</td>
                                <td class="px-4 py-2">{{ $cusCert->purpose }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($cusCert->date_needed)->format('F j, Y') }}</td>
                                <td class="px-4 py-2">
                                    <button 
                                        onclick="printCertificate('{{ route('custom-certificate.download', [
                                            'certificateId' => $cusCert->id,
                                            'requesterName' => str_replace(' ', '_', $cusCert->resident->first_name),
                                            'certificateType' => str_replace(' ', '_', $cusCert->certificate_name),
                                            'date' => \Carbon\Carbon::parse($cusCert->created_at)->format('Y-m-d'),
                                        ]) }}')"
                                        class="btn-print bg-green-500 text-white hover:bg-green-700 px-6 py-2 rounded-full text-sm">
                                        Download
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-500 mt-4">No new custom certificate requests found.</p>
        @endif
    </div>

    <!-- Downloaded Requests Section -->
    <div class="bg-white shadow-lg rounded-lg py-4 px-6">
        <h2 class="text-xl font-bold text-gray-600 mb-3 uppercase">Downloaded Custom Certificate Requests</h2>

        @if ($downloadedRequests->isNotEmpty())
            <div class="max-h-[70vh] overflow-y-auto">
                <table class="w-full table-auto border border-gray-200 rounded-md">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Certificate Name</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Full Name</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Gender</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Purpose</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Date Needed</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Downloaded At</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($downloadedRequests as $cusCert)
                            <tr class="border-b hover:bg-gray-50 transition duration-200">
                                <td class="px-4 py-2">{{ $cusCert->certificate_name }}</td>
                                <td class="px-4 py-2">{{ $cusCert->resident->first_name }}</td>
                                <td class="px-4 py-2">{{ $cusCert->resident->gender }}</td>
                                <td class="px-4 py-2">{{ $cusCert->purpose }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($cusCert->date_needed)->format('F j, Y') }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($cusCert->downloaded_at)->format('F j, Y') }}</td>
                                <td class="px-4 py-2">
                                    <button 
                                        onclick="printCertificate('{{ route('custom-certificate.download', [
                                            'certificateId' => $cusCert->id,
                                            'requesterName' => str_replace(' ', '_', $cusCert->resident->first_name),
                                            'certificateType' => str_replace(' ', '_', $cusCert->certificate_name),
                                            'date' => \Carbon\Carbon::parse($cusCert->downloaded_at)->format('Y-m-d'),
                                        ]) }}')"
                                        class="bg-blue-500 text-white hover:bg-blue-700 px-6 py-2 rounded-full text-sm">
                                        Redownload
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-500 mt-4">No downloaded custom certificate requests found.</p>
        @endif
    </div>
</div>

<script>
    function printCertificate(url) {
        window.open(url, '_blank');
    }
</script>

@endsection
