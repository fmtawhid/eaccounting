@extends('layouts.admin_master')

@section('content')
<!-- Start Page Title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
            <h4 class="page-title">Notices</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('notices.list') }}" class="btn btn-primary">
                        <i class="ri-add-circle-line"></i> View Notice Table
                    </a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Notices Data Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="notice_table" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Section Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notices as $notice)
                        <tr>
                            <td>{{ $notice->id }}</td> <!-- Serial number -->
                            <td>{{ $notice->section_title }}</td> <!-- Section Title -->
                            <td>{{ Str::limit($notice->description, 50) }}</td> <!-- Description -->
                            <td>{{ \Carbon\Carbon::parse($notice->date)->format('d-m-Y')  }}</td> <!-- Date -->
                            <td>
                                <a href="{{ route('notices.restore', $notice->id) }}" class="btn btn-warning btn-sm">
                                    <i class="ri-edit-2-line"></i> Restore
                                </a>
                                <!-- Delete Button -->
                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                    data-id="{{ $notice->id }}"
                                    data-action="{{ route('notices.permanentDelete', $notice->id) }}">
                                    <i class="ri-delete-bin-6-line"></i> Permanent Delete
                                </button>
                            </td> <!-- Actions -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $notices->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Notices Data Table -->

<!-- Modal for Delete Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this notice?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form id="deleteForm" method="POST" action="" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Show the delete confirmation modal
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        var deleteUrl = this.getAttribute('data-action');
        document.getElementById('deleteForm').action = deleteUrl;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });
});
</script>
@endsection