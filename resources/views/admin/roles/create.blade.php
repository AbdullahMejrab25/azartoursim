@extends('layouts.admin')

@section('content')
    <h2>Create Role</h2>
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="permissions" class="form-label">Assign Permissions</label>
            <select multiple class="form-control" id="permissions" name="permissions[]">
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Role</button>
    </form>
@endsection
