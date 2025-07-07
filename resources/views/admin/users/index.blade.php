@extends('layouts.admin_master')

@section('content')
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                <h4 class="page-title">Users</h4>
                <ol class="breadcrumb m-0">
                    @can('user_add')
                    <li class="breadcrumb-item">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="ri-add-circle-line"></i> Add Administration
                        </a>
                    </li>

                    @endcan
                </ol>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Users Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="user_table" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data is fetched by AJAX DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let table = $("#user_table").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "name", name: "name" },
                    { data: "email", name: "email" },
                    // { data: "role", name: "role" },
                    { data: "roles", name: "roles" }, // Updated this line
                    { data: "created_at_read", name: "created_at_read" },
                    { data: "actions", name: "actions", orderable: false, searchable: false }
                ]
            });

            // Delete Confirmation
            $(document).on("click", ".delete", function(e) {
                e.preventDefault();
                let that = $(this);
                if (confirm("Are you sure you want to delete this user?")) {
                    $.ajax({
                        url: that.closest("form").attr("action"),
                        type: "POST",
                        data: { _method: "DELETE", _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            alert(response.success);
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            alert("Error: " + xhr.responseJSON.message);
                        }
                    });
                }
            });
        });
    </script>
@endsection
