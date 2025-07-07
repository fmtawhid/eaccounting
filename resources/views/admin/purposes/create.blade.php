@extends('layouts.admin_master')

@section('styles')
    <!-- Include any additional CSS if needed -->
@endsection

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Add Purpose</h4>
                <a href="{{ route('purposes.index') }}" class="btn btn-primary">Purposes List</a>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Create Expense Head Form -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('purposes.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="purpose_name" class="form-label">Purposes Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="purpose_name" name="purpose_name" value="{{ old('purpose_name') }}" required>
                            @error('purpose_name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Create Purposes</button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('scripts')
    <!-- Include any additional JS if needed -->
@endsection
