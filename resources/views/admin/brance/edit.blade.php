@extends('layouts.admin_master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Brance</h4>
                </div>
                <div class="card-body">
                    <form id="editBranceForm" action="{{ route('brances.update', $brance) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Brance Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $brance->name }}" required />
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" value="{{ $brance->location }}" required />
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control">{{ $brance->description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Brance</button>
                        <a href="{{ route('brances.index') }}" class="btn btn-secondary">Back to List</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#editBranceForm').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                url: url,
                method: "POST",
                data: form.serialize(),
                success: function (response) {
                    toastr.success(response.success);
                    window.location.href = "{{ route('brances.index') }}";
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                }
            });
        });
    </script>
@endsection
