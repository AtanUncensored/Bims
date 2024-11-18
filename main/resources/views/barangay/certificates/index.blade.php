@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-certificate fa-lg"></i>
@endsection

@section('title', 'Certificates')

@section('content')
<div class="py-2 px-4">
    <h2 class="text-2xl font-semibold text-gray-800 text-center">Certificate Requests</h2>

    <hr class="border-t-2 mt-3 mb-4 border-gray-300">

    @if($certResidencies->isEmpty() && $certIndigencies->isEmpty() && $certJobSeekers->isEmpty())
        <p class="text-gray-600 text-center">No certificate requests found.</p>
    @else
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr>
                    <th class="border-b border-gray-300 px-4 py-2">Download</th>
                    <th class="border-b border-gray-300 px-4 py-2">Certificate Type</th>
                    <th class="border-b border-gray-300 px-4 py-2">Name</th>
                    <th class="border-b border-gray-300 px-4 py-2">Age</th>
                    <th class="border-b border-gray-300 px-4 py-2">Gender</th>
                    <th class="border-b border-gray-300 px-4 py-2">Reason</th>
                    <th class="border-b border-gray-300 px-4 py-2">Date Needed</th>
                    <th class="border-b border-gray-300 px-4 py-2">OR Number</th>
                    <th class="border-b border-gray-300 px-4 py-2">Requester</th>
                    <th class="border-b border-gray-300 px-4 py-2">Purpose</th>
                </tr>
            </thead>
            <tbody>
                {{-- CertResidencies --}}
                @foreach($certResidencies as $cert)
                    <tr>
                        <td class="border-b border-gray-300 px-4 py-2">
                            <a href="{{ route('certificate.download', ['certificateId' => $cert->id]) }}" target="_blank">
                                <i class="fa-solid fa-download"></i>
                            </a>
                        </td>
                        <td class="border-b border-gray-300 px-4 py-2">Residency</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->name ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->age ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->gender ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->reason ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->date_needed ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->ORnumber ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->requester_name ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->purpose ?? 'N/A' }}</td>
                    </tr>
                @endforeach

                {{-- CertIndigencies --}}
                @foreach($certIndigencies as $cert)
                    <tr>
                        <td class="border-b border-gray-300 px-4 py-2">
                            <a href="{{ route('certificate.download', ['certificateId' => $cert->id]) }}" target="_blank">
                                <i class="fa-solid fa-download"></i>
                            </a>
                        </td>
                        <td class="border-b border-gray-300 px-4 py-2">Indigency</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->name ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->age ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->gender ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->reason ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->date_needed ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->ORnumber ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->requester_name ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->purpose ?? 'N/A' }}</td>
                    </tr>
                @endforeach

                {{-- CertJobSeekers --}}
                @foreach($certJobSeekers as $cert)
                    <tr>
                        <td class="border-b border-gray-300 px-4 py-2">
                            <a href="{{ route('certificate.download', ['certificateId' => $cert->id]) }}" target="_blank">
                                <i class="fa-solid fa-download"></i>
                            </a>
                        </td>
                        <td class="border-b border-gray-300 px-4 py-2">Job Seeker</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->name ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->age ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->gender ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->reason ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->date_needed ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->ORnumber ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->requester_name ?? 'N/A' }}</td>
                        <td class="border-b border-gray-300 px-4 py-2">{{ $cert->requests->purpose ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
