@extends('layouts.admin_master')

@section('content')
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Permissions</h4>
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item">
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Permission
                        </a>
                    </li> -->
                </ol>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Permissions Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="permissions_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Permission Name</th>
                                <!-- <th>Actions</th> -->
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
        let table = $("#permissions_table").DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('permissions.index') }}",
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "name",
                    name: "name"
                },
                // {
                //     data: "actions",
                //     name: "actions",
                //     orderable: false,
                //     searchable: false
                // },
            ]
        });

        // Handle Delete Click
        $(document).on("click", ".delete-permission", function() {
            let id = $(this).data("id");

            if (confirm("Are you sure you want to delete this permission?")) {
                $.ajax({
                    url: "/permissions/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.success);
                        table.ajax.reload(); // Reload DataTable
                    },
                    error: function(xhr) {
                        alert("Error deleting permission. Please try again.");
                    }
                });
            }
        });
    });
</script>
@endsection
