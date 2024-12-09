<!DOCTYPE html>
<html>
<head>
    <title>{{ $company->name }} - Employees</title>
</head>
<body>
    <h1>Company: {{ $company->name }}</h1>
    <p>Email: {{ $company->email }}</p>

    <h2>Employees</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($company->employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
