@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-certificate fa-lg"></i>
@endsection

@section('title', 'Certificates')

@section('content')
    <div class="py-2 px-4">
        <h2 class="text-2xl font-semibold text-gray-800 text-center">Certificate Requests</h2>

        <hr class="border-t-2 mt-3 mb-4 border-gray-300">

        <h4 class="text-2xl font-semibold text-gray-800 text-center">Residency Records</h4>

        @if($certResidencies->isEmpty())
            <p class="text-gray-600 text-center">No Residency requests found.</p>
        @else
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="border-b border-gray-300 px-4 py-2">Name</th>
                        <th class="border-b border-gray-300 px-4 py-2">Age</th>
                        <th class="border-b border-gray-300 px-4 py-2">Gender</th>
                        <th class="border-b border-gray-300 px-4 py-2">Reason</th>
                        <th class="border-b border-gray-300 px-4 py-2">Date</th>
                        <th class="border-b border-gray-300 px-4 py-2">Punong Barangay</th>
                        <th class="border-b border-gray-300 px-4 py-2">Purok</th>
                        <th class="border-b border-gray-300 px-4 py-2">OR Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($certResidencies as $cert)
                        <tr>
                            <td class="border-b border-gray-300 px-4 py-2">{{ $cert->name }}</td>
                            <td class="border-b border-gray-300 px-4 py-2">{{ $cert->age }}</td>
                            <td class="border-b border-gray-300 px-4 py-2">{{ $cert->gender }}</td>
                            <td class="border-b border-gray-300 px-4 py-2">{{ $cert->reason }}</td>
                            <td class="border-b border-gray-300 px-4 py-2">{{ $cert->date }}</td>
                            <td class="border-b border-gray-300 px-4 py-2">{{ $cert->punongbarangay }}</td>
                            <td class="border-b border-gray-300 px-4 py-2">{{ $cert->purok->purok_name ?? 'N/A' }}</td>
                            <td class="border-b border-gray-300 px-4 py-2">{{ $cert->ORnumber }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr class="border-t-2 mt-6 mb-4 border-gray-300">

            <h4 class="text-2xl font-semibold text-gray-800 text-center">UNIFAST Records</h4>

            @if($unifastRecords->isEmpty())
                <p class="text-gray-600 text-center">No UNIFAST records found.</p>
            @else
                <table class="min-w-full border border-gray-300 mt-4">
                    <thead>
                        <tr>
                            <th class="border-b border-gray-300 px-4 py-2">Record ID</th>
                            <th class="border-b border-gray-300 px-4 py-2">Name</th>
                            <th class="border-b border-gray-300 px-4 py-2">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unifastRecords as $unifast)
                            <tr>
                                <td class="border-b border-gray-300 px-4 py-2">{{ $unifast->id }}</td>
                                <td class="border-b border-gray-300 px-4 py-2">{{ $unifast->name }}</td>
                                <td class="border-b border-gray-300 px-4 py-2">{{ $unifast->address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endif
    </div>
@endsection
