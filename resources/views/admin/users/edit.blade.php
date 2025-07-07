@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit User</h4>
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- User Name Field -->
                            <div class="mb-3 col-md-4">
                                <label class="form-label">User Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        
                            <!-- Employee (Teacher) Dropdown -->
                            <div class="mb-3 col-md-4">
                                <label for="employee_id" class="form-label">Select Teacher (Employee)</label>
                                <select name="employee_id" id="employee_id" class="form-select">
                                    <option value="">-- Select Teacher --</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->user_id }}" {{ old('employee_id', $user->employee_id) == $teacher->user_id ? 'selected' : '' }}>
                                            {{ $teacher->name }} - {{ $teacher->user_id }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        
                            <!-- Email Field -->
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        
                            <!-- Password Field (Optional in Edit) -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Password (Leave blank if not changing)</label>
                                <input type="password" class="form-control" name="password">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        
                            <!-- Confirm Password Field -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        
                            <!-- Role Permissions -->
                            <div class="mb-3 col-md-6" id="role_permissions" style="display: block;">
                                <label class="form-label">Assign Permissions (Roles)</label><br>
                                @foreach($roles as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"
                                               {{ in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role_{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        

                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleRoleFields() {
            var role = document.getElementById('role').value;
            if (role == 'student') {
                document.getElementById('student_fields').style.display = 'block';
                document.getElementById('admin_fields').style.display = 'none';
                document.getElementById('role_permissions').style.display = 'none';
            } else if (role == 'admin') {
                document.getElementById('student_fields').style.display = 'none';
                document.getElementById('admin_fields').style.display = 'block';
                document.getElementById('role_permissions').style.display = 'block';
            }
        }

        // Call toggleRoleFields on page load to check the current role
        window.onload = toggleRoleFields;
    </script>
@endsection
