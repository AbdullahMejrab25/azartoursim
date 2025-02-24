@extends('layouts.admin')

@section('content')
    <h2>Roles</h2>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Add Role</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->permissions->pluck('name')->join(', ') }}</td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
