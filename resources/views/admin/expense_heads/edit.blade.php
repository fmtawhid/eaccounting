@extends('layouts.admin_master')

@section('styles')
    <!-- Include any additional CSS if needed -->
@endsection

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Edit Expense Head</h4>
                <a href="{{ route('expense_heads.index') }}" class="btn btn-primary">Expense Heads List</a>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Edit Expense Head Form -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('expense_heads.update', $expense_head->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="expense_head_name" class="form-label">Expense Head Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="expense_head_name" name="expense_head_name" value="{{ old('expense_head_name', $expense_head->expense_head_name) }}" required>
                            @error('expense_head_name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $expense_head->description) }}</textarea>
                            @error('description')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Update Expense Head</button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('scripts')
    <!-- Include any additional JS if needed -->
@endsection
