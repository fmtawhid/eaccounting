<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Report</title>
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

        .company {
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

        .total-row td {
            font-weight: bold;
            background: #f1f1f1;
        }

        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: flex-end;
        }

        .signature-box {
            text-align: right;
        }

        .signature-box p {
            margin: 3px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="report-container">
    <div class="header">
        <div class="company">E - Accounting</div>
        <div class="report-title">Payment Report</div>
    </div>

    <div class="info">
        <p>From Date: {{ $fromDate ? $fromDate->format('d-m-Y') : 'N/A' }}</p>
        <p>To Date: {{ $toDate ? $toDate->format('d-m-Y') : 'N/A' }}</p>
        @if($purposeName)
            <p><strong>Purpose:</strong> {{ $purposeName }}</p>
        @endif
        @if($branceName)
            <p><strong>Branch:</strong> {{ $branceName }}</p>
        @endif
        @if($accountName)
            <p><strong>Account:</strong> {{ $accountName }}</p>
        @endif
    </div>

    <table>
        <thead>
        <tr>
            <th>SL</th>
            <th>Receipt No</th>
            <th>Date</th>
            <th>Name</th>
            <th>Purpose</th>
            <th>Branch</th>
            <th>Account</th>
            <th>Amount</th>
            <th>Amount in Words</th>
            <th>Note</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($payments as $index => $payment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $payment->reciept_no }}</td>
                <td>{{ $payment->date }}</td>
                <td>{{ $payment->name }}</td>
                <td>{{ $payment->purpose->purpose_name ?? 'N/A' }}</td>
                <td>{{ $payment->brance->name ?? 'N/A' }}</td>
                <td>{{ $payment->account->name ?? 'N/A' }}</td>
                <td>{{ number_format($payment->amount, 2) }} TK</td>
                <td>{{ $payment->amount_in_words }}</td>
                <td>{{ $payment->note }}</td>
                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
        <tr class="total-row">
            <td colspan="7" style="text-align: right;">Total</td>
            <td>{{ number_format($totalAmount, 2) }} TK</td>
            <td colspan="3"></td>
        </tr>
        </tbody>
    </table>

    <div class="signature">
        <div class="signature-box">
            <p>Authorized Signature</p>
            <p>_______________________</p>
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} E - Accounting. All rights reserved.
    </div>
</div>
</body>
</html>
