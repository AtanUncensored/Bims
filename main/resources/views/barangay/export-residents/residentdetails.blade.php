<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <h1>Resident List</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Name</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Birth Place</th>
                <th>Phone Number</th>
                <th>Citizenship</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($residents as $resident)
                <tr>
                    <td>{{ $resident->first_name }}</td>
                    <td>{{ $resident->last_name }}</td>
                    <td>{{ $resident->middle_name }}</td>
                    <td>{{ $resident->gender }}</td>
                    <td>{{ $resident->birth_date }}</td>
                    <td>{{ $resident->place_of_birth }}</td>
                    <td>{{ $resident->phone_number }}</td>
                    <td>{{ $resident->citizenship }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
