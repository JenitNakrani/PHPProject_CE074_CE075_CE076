@extends('layouts.master')

@section('nav-left-links')
<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ url('about/') }}">About</a>
</li>
@endsection

<title>Home</title>
@section('nav-right-links')

<a href="adminlogin/" class="btn btn-outline-success ms-2">Admin Login</a>
    <a href="myregister/" class="btn btn-outline-success ms-2">User Signup</a>
    <a href="mylogin/" class="btn btn-outline-success ms-2">User Login</a>
@endsection

@section('content')
@if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
@endif
@endsection

@section('mystyle')
<style>
    body{
            margin: 0;
            padding: 0;
            background-image:url('{{ asset('img/2.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
    }
</style>
@endsection
