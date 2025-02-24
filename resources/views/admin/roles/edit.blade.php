@extends('layouts.admin')

@section('content')
    <h2>Edit Role</h2>
    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
        </div>
        <div class="mb-3">
            <label for="permissions" class="form-label">Assign Permissions</label>
            <select multiple class="form-control" id="permissions" name="permissions[]">
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}" 
                            @if($role->hasPermissionTo($permission->name)) selected @endif>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
@endsection
