@extends('layouts.master')

@section('nav-right-links')
    <a href="{{ url('myregister') }}" class="btn btn-outline-success ms-2">Register</a>
@endsection

<title>Login</title>

@section('content')
@if(session('message'))
    <div class="alert alert-danger">{{session('message')}}</div>
@endif

<form class="mt-5" action="{{ url('adminlogin') }}" method="POST" style="width: 300px;">
@csrf
    <div class="mb-3">
        <label class="form-label">Admin Username</label>
        <input type="text" class="form-control" name="aname">
    </div>
    <div class="mb-3">
        <label class="form-label">Admin Password</label>
        <input type="password" class="form-control" name="apassword">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection