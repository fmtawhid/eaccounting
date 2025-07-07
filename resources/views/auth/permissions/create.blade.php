@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Add Permission</h4>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
            </div>
        </div>
    </div>

    <!-- Create Permission Form -->
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Create Permission</h4>
                    <form id="permissionForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Permission Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Permission Name">
                            <span class="text-danger error_name"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Permission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    <div id="successMessage" class="alert alert-success d-none text-center"></div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#permissionForm").submit(function(e) {
            e.preventDefault();

            let formData = {
                _token: "{{ csrf_token() }}",
                name: $("#name").val()
            };

            $.ajax({
                url: "{{ route('permissions.store') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.errors) {
                        $(".error_name").text(response.errors.name);
                    } else {
                        $(".error_name").text("");
                        $("#name").val("");
                        $("#successMessage").removeClass("d-none").text(response.success);
                        setTimeout(() => {
                            $("#successMessage").addClass("d-none");
                        }, 2000);
                    }
                }
            });
        });
    });
</script>
@endsection
