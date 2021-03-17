@extends('layouts.master')

<title>Welcome</title>

@section('nav-right-links')
@if(session()->has('superuser'))
    <a href="{{ url('addbook') }}" class="btn btn-outline-success ms-2">Add book</a>
    <a href="{{ url('removebook') }}" class="btn btn-outline-success ms-2">Remove book</a>
@else
    <a href="{{ url('issuebook')}}" class="btn btn-outline-success ms-2">Issue book</a>  
    <a href="{{ url('returnbook')}}" class="btn btn-outline-success ms-2">Return book</a>
@endif
    <a href="{{ url('/logout') }}" class="btn btn-outline-danger ms-2">Logout</a>
@endsection

@section('content')
	<h2>Welcome,
	@if(session()->has('uname'))
	    {{session()->get('uname')}}
	@endif
	To our Library System....
	</h2>
@endsection