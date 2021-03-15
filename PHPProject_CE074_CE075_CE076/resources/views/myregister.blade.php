@extends('layouts.master')

@section('nav-right-links')
    <a href="{{ url('mylogin') }}" class="btn btn-outline-success ms-2">Login</a>
@endsection

<title>Register</title>

@section('content')
@if(session('message'))
    <div class="alert alert-danger">{{session('message')}}</div>
@endif
    <form class="mt-5" action="{{ url('register') }}" method="POST" style="width: 300px;">
    @csrf
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="mb-3">
        <label class="form-label">First name</label>
        <input type="text" class="form-control" name="firstname">
    </div>
    <div class="mb-3">
        <label class="form-label">Last name</label>
        <input type="text" class="form-control" name="lastname">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="mb-3">
        <label class="form-label">Re-enter Password</label>
        <input type="password" class="form-control" name="repassword">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection