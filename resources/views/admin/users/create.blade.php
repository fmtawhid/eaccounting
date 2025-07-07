@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Create User</h4>
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- User Name Field -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">User Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>

                            <!-- Remove Role Field (since it's hardcoded to admin now) -->
                            <!-- Role Permissions (Only visible if admin is selected) -->
                            <div class="mb-3 col-md-6" id="role_permissions" style="display: block;">
                                <label class="form-label">Assign Permissions (Roles)</label><br>
                                @foreach($roles as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                               {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role_{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Create User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
