@extends('layouts.auth')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-sm p-4" style="width: 400px;">
        <h2 class="text-center mb-3">Login</h2>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" class="form-control" required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
            </div>

            <!-- Login Button -->
            <div class="d-flex justify-content-between align-items-center">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none">{{ __('Forgot your password?') }}</a>
                @endif
                <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
