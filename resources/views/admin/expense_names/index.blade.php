{{-- resources/views/expensename/index.blade.php --}}
@extends('layouts.admin_master')

@section('styles')
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/css/jquery-confirm.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Expense Names</h4>
    <a href="{{ route('expense_names.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Expense Name
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped" id="expenseNameTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/js/jquery-confirm.min.js"></script>
<script>
    $(document).ready(function () {
        let table = $('#expenseNameTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('expense_names.index') }}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'note', name: 'note'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <a href="/expense-names/${row.id}/edit" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="/expense-names/${row.id}" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </form>
                        `;
                    }
                }
            ]
        });

        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();
            let form = $(this).closest('form');
            $.confirm({
                icon: 'fa fa-warning',
                title: 'Confirm Deletion',
                content: 'Are you sure you want to delete this item?',
                type: 'red',
                buttons: {
                    confirm: {
                        btnClass: 'btn-red',
                        action: function () {
                            form.submit();
                        }
                    },
                    cancel: function () {}
                }
            });
        });
    });
</script>
@endsection
