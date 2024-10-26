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
                <th>Item</th>
                <th>Cost</th>
                <th>Period From</th>
                <th>Period To</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($budgets as $budget)
                <tr>
                    <td>{{ $budget->item }}</td>
                    <td>{{ $budget->cost }}</td>
                    <td>{{ $budget->period_from }}</td>
                    <td>{{ $budget->period_to }}</td>
                </tr>
            @endforeach

            <tr>
                <td><strong>Total Expenses - ₱{{ number_format($totalExpenses, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
