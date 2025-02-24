@extends('layouts.admin')

@section('content')
    <h2>Edit User</h2>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="roles" class="form-label">Assign Roles</label>
            <select multiple class="form-control" id="roles" name="roles[]">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" 
                            @if($user->hasRole($role->name)) selected @endif>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
@endsection
