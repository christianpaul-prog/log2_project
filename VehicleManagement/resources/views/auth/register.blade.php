@extends('layouts.Auth')
@section('title','registration')
@section('content')

  <div class="message-wrapper mt-5">
    @if($errors->any())
      <div class="col-22">
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
        @endforeach
      </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
     
        @if(session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
  </div>
 <div class="registration-form slide-up">
  <h2>Register</h2>
  <form action="{{route('auth.register.post')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Full Name</label>
      <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
    </div>
    <div class="form-group">
   <label for="city">Role Positon:</label>

<select id="count" name="city">
  <option value="manila">User</option>
  <option value="cebu">Admin</option>
  <option value="davao">Manager</option>
</select>
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
<!--
    <div class="form-group">
      <label for="confirm-password">Confirm Password</label>
      <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" required>
    </div>
    -->
    <button type="submit" class="btn btn-primary btn-block">Register</button>
  </form>
  <div class="text-center mt-3">
    <a href="{{route('auth.login')}}">Already have an account? Login</a>
  </div>
</div>


@endsection