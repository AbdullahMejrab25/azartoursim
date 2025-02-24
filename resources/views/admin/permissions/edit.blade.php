@extends('layouts.admin')

@section('content')
    <h2>Edit Permission</h2>
    <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Permission Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Permission</button>
    </form>
@endsection
