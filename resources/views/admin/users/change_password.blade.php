@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Change Password</h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('users.update-password') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Current Password Field -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" name="current_password" required>
                                @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- New Password Field -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" required>
                                @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Confirm New Password Field -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" name="new_password_confirmation" required>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
