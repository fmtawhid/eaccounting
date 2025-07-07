<!DOCTYPE html>
<html>
<head>
    <title>Students Report</title>
    <style>
        /* Add any custom styles for the PDF here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Talimul Islam School and Madrashah</h2>
    <h2>Students Report</h2>
    <p>From Date: {{ $fromDate ?? 'N/A' }}</p>
    <p>To Date: {{ $toDate ?? 'N/A' }}</p>
    <table>
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Form Number</th>
                <th>User ID</th>
                <th>Student Registration Date</th>
                <th>Student Name</th>
                <th>Father Name</th>
                <th>Mobile</th>
                <th>Bibhag</th>
                <th>Academic Session</th>
                <th>Class</th>
                <th>Roll Number</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->form_number }}</td>
                <td>{{ $student->dhakila_number }}</td>
                <td>{{ $student->dhakila_date }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->father_name }}</td>
                <td>{{ $student->mobile }}</td>
                <td>{{ $student->bibag_name }}</td>
                <td>{{ $student->academic_session }}</td>
                <td>{{ $student->sreni_name }}</td>
                <td>{{ $student->roll_number }}</td>
                <td>{{ $student->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
