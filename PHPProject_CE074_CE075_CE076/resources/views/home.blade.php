@extends('layouts.master')

@section('nav-left-links')
<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ url('about/') }}">About</a>
</li>
@endsection

@section('nav-right-links')
    <a href="myregister/" class="btn btn-outline-success ms-2">Register</a>
    <a href="mylogin/" class="btn btn-outline-success ms-2">Login</a>
@endsection