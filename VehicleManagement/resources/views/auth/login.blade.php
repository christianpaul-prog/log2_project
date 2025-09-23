@extends('layouts.Auth')
@section('title','login')

@section('content')

<div class="login-container slide-up ">
    <h2 class="login-title">Login</h2>

    <form action="{{route('auth.login.post')}}" method="POST"> 
        @csrf

        {{-- Custom error (like wrong login) --}}
        @if(session()->has('error'))
            <div class="alert alert-danger w-100 text-center">{{ session('error') }}</div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="alert alert-danger w-100 text-center">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your Email" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>

    <div class="text-center mt-3">
        <a href="#">Forgot Password?</a>
        <a href="{{route('auth.register')}}">Register</a>
    </div>
</div>

@endsection
