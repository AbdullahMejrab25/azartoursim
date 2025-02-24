@extends('layouts.admin')

@section('content')
    <h2>Create Permission</h2>
    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Permission Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Permission</button>
    </form>
@endsection
