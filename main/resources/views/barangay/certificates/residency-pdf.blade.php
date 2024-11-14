<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>    
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Resident Name</th>
                <th>Certificate Type</th>
                <th>Requester Name</th>
                <th>Purpose</th>
                <th>Date Needed</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $certificateRequest->resident->first_name }} {{ $certificateRequest->resident->last_name }}</td>
                <td>{{ $certificateRequest->certificateType->name }}</td>
                <td>{{ $certificateRequest->requester_name }}</td>
                <td>{{ $certificateRequest->purpose }}</td>
                <td>{{ $certificateRequest->date_needed }}</td>
                <td>{{ \Carbon\Carbon::parse($certificateRequest->resident->birth_date)->age }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
