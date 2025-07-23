<!DOCTYPE html>
<html>
<head>
    <title>Payroll PDF</title>
    <style>
        body {
            font-family: "Helvetica", sans-serif;
            margin: 40px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
        }

        .payroll-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .payroll-table th,
        .payroll-table td {
            border: 1px solid #ccc;
            padding: 12px 16px;
            text-align: left;
        }

        .payroll-table th {
            background-color: #2c3e50;
            color: #fff;
        }

        .section {
            margin-bottom: 30px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 50px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Payroll Detail</h2>

    <table class="payroll-table">
        <tr>
            <th>Employee Name</th>
            <td>{{ $payroll->employee->fullname }}</td>
        </tr>
        <tr>
            <th>Salary</th>
            <td>Rp {{ number_format($payroll->salary, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Bonuses</th>
            <td>Rp {{ number_format($payroll->bonuses, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Deductions</th>
            <td>Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Net Salary</th>
            <td>Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Payroll Date</th>
            <td>{{ \Carbon\Carbon::parse($payroll->pay_date)->translatedFormat('d F Y') }}</td>
        </tr>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} Payroll System — Generated automatically.
    </div>
</body>
</html>
