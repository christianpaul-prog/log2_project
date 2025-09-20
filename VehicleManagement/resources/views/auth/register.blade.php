@extends('layouts.Auth')
@section('title', 'registration')
@section('content')

<div class="registration-form slide-up">
    <h2>Register</h2>

    <form action="{{ route('auth.register.post') }}" method="POST">
        @csrf

        {{-- Custom error (like failed registration) --}}
        @if (session()->has('error'))
            <div class="alert alert-danger w-100 text-center">
                <strong>Oops!</strong> {{ session('error') }}
            </div>
        @endif

        {{-- Success message --}}
        @if (session()->has('success'))
            <div class="alert alert-success w-100 text-center">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger w-100">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Terms and Conditions -->
        <div class="form-group form-check mt-3">
            <input type="checkbox" class="form-check-input" name="terms" id="terms" required>
            <label class="form-check-label" for="terms">
                I agree to the <a href="{{ route('auth.terms') }}" target="_blank">Terms and Conditions</a>
            </label>
            @error('terms')
                <br><small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('auth.login') }}">Already have an account? Login</a>
    </div>
</div>

@endsection
