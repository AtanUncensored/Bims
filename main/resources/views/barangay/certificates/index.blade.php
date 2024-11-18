@extends('barangay.templates.navigation-bar')

@section('icon')
<i class="fa-solid fa-certificate fa-lg"></i>
@endsection

@section('title', 'Certificates')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h3>Certificate Requests</h3>
        </div>
        <div class="card-body">
            @if($certificateRequests->isEmpty())
                <div class="text-center">
                    <p class="text-muted">No certificate requests found.</p>
                </div>
            @else
                <table class="table table-bordered table-striped text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Certificate Type</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Date Needed</th>
                            <th>OR Number</th>
                            <th>Requester</th>
                            <th>Purpose</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certificateRequests as $request)
                            <tr>
                                <td>{{ $request->certificate_type ?? 'N/A' }}</td>
                                <td>{{ $request->full_name ?? 'N/A' }}</td>
                                <td>{{ $request->age ?? 'N/A' }}</td>
                                <td>{{ ucfirst($request->gender ?? 'N/A') }}</td>
                                <td>{{ $request->date_needed ?? 'N/A' }}</td>@extends('barangay.templates.navigation-bar')

                                @section('icon')
                                <i class="fa-solid fa-certificate fa-lg"></i>
                                @endsection
                                
                                @section('title', 'Certificates')
                                
                                @section('content')
                                <div class="container mt-4">
                                    <div class="card shadow">
                                        <div class="card-header bg-primary text-white text-center">
                                            <h3 class="mb-0">Certificate Requests</h3>
                                        </div>
                                        <div class="card-body">
                                            @if($certificateRequests->isEmpty())
                                                <div class="text-center my-5">
                                                    <i class="fa-solid fa-folder-open fa-3x text-muted"></i>
                                                    <p class="mt-3 text-muted">No certificate requests found.</p>
                                                </div>
                                            @else
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-striped align-middle">
                                                        <thead class="table-dark text-center">
                                                            <tr>
                                                                <th>Certificate Type</th>
                                                                <th>Name</th>
                                                                <th>Age</th>
                                                                <th>Gender</th>
                                                                <th>Date Needed</th>
                                                                <th>OR Number</th>
                                                                <th>Requester</th>
                                                                <th>Purpose</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($certificateRequests as $request)
                                                                <tr>
                                                                    <td class="text-center">{{ $request->certificate_type ?? 'N/A' }}</td>
                                                                    <td>{{ $request->full_name ?? 'N/A' }}</td>
                                                                    <td class="text-center">{{ $request->age ?? 'N/A' }}</td>
                                                                    <td class="text-center">{{ ucfirst($request->gender ?? 'N/A') }}</td>
                                                                    <td class="text-center">{{ $request->date_needed ?? 'N/A' }}</td>
                                                                    <td class="text-center">{{ $request->or_number ?? 'N/A' }}</td>
                                                                    <td>{{ $request->requester_name ?? 'N/A' }}</td>
                                                                    <td>{{ $request->purpose ?? 'N/A' }}</td>
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
                                <td>{{ $request->or_number ?? 'N/A' }}</td>
                                <td>{{ $request->requester_name ?? 'N/A' }}</td>
                                <td>{{ $request->purpose ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection