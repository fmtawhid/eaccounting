@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Role</h4>
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}" placeholder="Enter Role Name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assign Permissions</label>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Permission Name</th>
                                        <th scope="col">Add</th>
                                        <th scope="col">View</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $permission_groups = [];
                                    @endphp

                                    @foreach($permissions as $permission)
                                        @php
                                            // Extract the base name before the suffix (_add, _view, _edit, _delete)
                                            $base_name = preg_replace('/_(add|view|edit|delete)$/', '', $permission->name);

                                            // Group permissions by base name
                                            if (!isset($permission_groups[$base_name])) {
                                                $permission_groups[$base_name] = [];
                                            }
                                            $permission_groups[$base_name][] = $permission;
                                        @endphp
                                    @endforeach

                                    @foreach($permission_groups as $base_name => $permissions)
                                        <tr>
                                            <td>{{ $base_name }}</td>

                                            <!-- Add permissions -->
                                            <td>
                                                @php $has_add = false; @endphp
                                                @foreach($permissions as $permission)
                                                    @if(str_ends_with($permission->name, '_add'))
                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                        @php $has_add = true; @endphp
                                                    @endif
                                                @endforeach
                                                @if(!$has_add) <span>X</span> @endif
                                            </td>

                                            <!-- View permissions -->
                                            <td>
                                                @php $has_view = false; @endphp
                                                @foreach($permissions as $permission)
                                                    @if(str_ends_with($permission->name, '_view'))
                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                        @php $has_view = true; @endphp
                                                    @endif
                                                @endforeach
                                                @if(!$has_view) <span>X</span> @endif
                                            </td>

                                            <!-- Edit permissions -->
                                            <td>
                                                @php $has_edit = false; @endphp
                                                @foreach($permissions as $permission)
                                                    @if(str_ends_with($permission->name, '_edit'))
                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                        @php $has_edit = true; @endphp
                                                    @endif
                                                @endforeach
                                                @if(!$has_edit) <span>X</span> @endif
                                            </td>

                                            <!-- Delete permissions -->
                                            <td>
                                                @php $has_delete = false; @endphp
                                                @foreach($permissions as $permission)
                                                    @if(str_ends_with($permission->name, '_delete'))
                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                        @php $has_delete = true; @endphp
                                                    @endif
                                                @endforeach
                                                @if(!$has_delete) <span>X</span> @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @error('permissions') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
