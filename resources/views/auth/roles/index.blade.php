@extends('layouts.admin_master')

@section('content')
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Roles</h4>
                <ol class="breadcrumb m-0">
                    @can('role_add')
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Role
                        </a>
                    </li>
                    @endcan
                </ol>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Roles Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="roles_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data is fetched via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        let table = $("#roles_table").DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('roles.index') }}",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                { data: "name", name: "name" },
                { data: "permissions", name: "permissions", orderable: false, searchable: false },
                { data: "actions", name: "actions", orderable: false, searchable: false }
            ]
        });

        // Handle Delete Click
        $(document).on("click", ".delete-role", function() {
            let id = $(this).data("id");

            if (confirm("Are you sure you want to delete this role?")) {
                $.ajax({
                    url: "/roles/" + id,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(response) {
                        alert(response.message);
                        table.ajax.reload(); // Reload DataTable
                    },
                    error: function(xhr) {
                        alert("Error deleting role. Please try again.");
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endsection
