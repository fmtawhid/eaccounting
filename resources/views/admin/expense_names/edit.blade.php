@extends('layouts.admin_master')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Expense Name</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('expense_names.update', $expense_name) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Expense Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $expense_name->name) }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea name="note" class="form-control" rows="3">{{ old('note', $expense_name->note) }}</textarea>
                        @error('note') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="text-end">
                        <a href="{{ route('expense_names.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
