@extends('layouts.master')

@section('nav-right-links')
    <a href="{{ url('myregister') }}" class="btn btn-outline-success ms-2">Register</a>
@endsection

<title>Login</title>

@section('content')
@if(session('message'))
    <div class="alert alert-danger">{{session('message')}}</div>
@endif

<form class="mt-5" action="{{ url('userlogin') }}" method="POST" style="width: 300px;">
@csrf
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <!-- <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" value="superuser" name="checkbox">
        <label class="form-check-label">Superuser</label>
    </div> -->
    <button type="submit" class="btn btn-primary">Login</button>
</form>
@endsection