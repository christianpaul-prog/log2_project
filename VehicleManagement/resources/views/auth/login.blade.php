
@extends('layouts.Auth')
@section('title','login')

@section('content')



  <div class="message-wrapper mt-5">
    @if($errors->any())
      <div class="col-22">
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
        @endforeach
      </div>
        @endif
        @if(session()->has('errors'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
      
        @if(session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
  </div>

<div class="login-container slide-up ">

    <h2 class="login-title">Login</h2>
    <form action="{{route('auth.login.post')}}" method="POST"> 
          @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your Email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary1 btn-block">Login</button>
    </form>
    <div class="text-center mt-3">
        <a href="#">Forgot Password?</a>
        <a href="{{route('auth.register')}}">Register</a>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
@endsection