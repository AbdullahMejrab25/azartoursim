@extends('layouts.admin')

@section('content')
    <h2>Permissions</h2>
    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">Add Permission</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" style="display:inline;">
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
