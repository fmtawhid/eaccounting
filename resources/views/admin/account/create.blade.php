@extends('layouts.admin_master')

@section('content')
<div class="row mb-3 mt-3">
    <div class="col-md-6">
        <h4>Create New Account</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="createAccountForm" action="{{ route('accounts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Account Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="number" class="form-label">Account Number <span class="text-danger">*</span></label>
                <input type="text" name="number" id="number" 
                       class="form-control @error('number') is-invalid @enderror" 
                       value="{{ old('number') }}" required>
                @error('number')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="brance_id" class="form-label">Branch <span class="text-danger">*</span></label>
                <select name="brance_id" id="brance_id" 
                        class="form-select @error('brance_id') is-invalid @enderror" required>
                    <option value="" selected disabled>Select Brance</option>
                    @foreach($brances as $brance)
                        <option value="{{ $brance->id }}" {{ old('brance_id') == $brance->id ? 'selected' : '' }}>
                            {{ $brance->name }}
                        </option>
                    @endforeach
                </select>
                @error('brance_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <!-- <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label> -->
                <input type="number" step="0.01" name="amount" id="amount" 
                       class="form-control @error('amount') is-invalid @enderror" 
                       value="{{ old('amount', 0) }}" required readonly hidden>
                @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Note (Optional)</label>
                <textarea name="note" id="note" class="form-control">{{ old('note') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(function() {
    $('#createAccountForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);

        // Clear previous errors
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                toastr.success(response.success || 'Account created successfully.');
                window.location.href = "{{ route('accounts.index') }}";
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        let input = $('[name="'+key+'"]');
                        input.addClass('is-invalid');
                        if(input.next('.invalid-feedback').length === 0) {
                            input.after('<div class="invalid-feedback">'+errors[key][0]+'</div>');
                        } else {
                            input.next('.invalid-feedback').text(errors[key][0]);
                        }
                    });
                } else {
                    console.error(xhr.responseText);
                    toastr.error('Something went wrong!');
                }
            }
        });
    });
});
</script>
@endsection
