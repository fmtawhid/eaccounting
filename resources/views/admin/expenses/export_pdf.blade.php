<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expense Report</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
            color: #333;
        }

        .report-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 40px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            border-top: 6px solid #007bff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .company-name {
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
        }

        .report-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .info {
            margin-top: 20px;
            font-size: 14px;
        }

        .info p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            font-size: 13px;
        }

        table thead {
            background: #007bff;
            color: #fff;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #e0e0e0;
            text-align: center;
        }

        tfoot td {
            font-weight: bold;
            background: #f1f1f1;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="report-container">
    <div class="header">
        <div class="company-name">E - ACCOUNT</div>
        <div class="report-title">Expense Report</div>
    </div>

    <div class="info">
        <p><strong>From Date:</strong> {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d-m-Y') : 'N/A' }}</p>
        <p><strong>To Date:</strong> {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d-m-Y') : 'N/A' }}</p>
        <p><strong>Expense Head:</strong> {{ $expense_head_id ? \App\Models\ExpenseHead::find($expense_head_id)?->expense_head_name : 'All' }}</p>
        <p><strong>Branch:</strong> {{ $brance_id ? \App\Models\Brance::find($brance_id)?->name : 'All' }}</p>
        <p><strong>Account:</strong> {{ $account_id ? \App\Models\Account::find($account_id)?->name : 'All' }}</p>
    </div>

    @php $totalAmount = 0; @endphp

    <table>
        <thead>
            <tr>
                <th>Serial</th>
                <th>Expense Head</th>
                <th>Name</th>
                <th>Invoice No</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Note</th>
                <th>Branch</th>
                <th>Account</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $index => $expense)
                @php $totalAmount += $expense->amount; @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $expense->expense_head_name }}</td>
                    <td>{{ $expense->name }}</td>
                    <td>{{ $expense->invoice_no }}</td>
                    <td>{{ \Carbon\Carbon::parse($expense->date)->format('d-m-Y') }}</td>
                    <td>{{ number_format($expense->amount, 2) }} TK</td>
                    <td>{{ $expense->note }}</td>
                    <td>{{ optional($expense->brance)->name ?? 'N/A' }}</td>
                    <td>{{ optional($expense->account)->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($expense->created_at)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5"></td>
                <td>Total = {{ number_format($totalAmount, 2) }} TK</td>
                <td colspan="4"></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} E - ACCOUNT. All rights reserved.
    </div>
</div>
</body>
</html>
