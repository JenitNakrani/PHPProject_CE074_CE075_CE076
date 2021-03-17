@extends('layouts.master')

<title>Welcome</title>

@section('nav-left-links')
    <a href="{{ url('addbook') }}" class="btn btn-outline-success ms-2">Add book</a>
    <a href="{{ url('removebook') }}" class="btn btn-outline-success ms-2">Remove book</a>

@endsection

@section('nav-right-links')
<a href="{{ url('logout')}}" class="btn btn-outline-danger ms-2">Logout</a>
@endsection

@section('content')
	<h2>Welcome,
	@if(session()->has('aname'))
	    {{session()->get('aname')}}
	@endif
	To our Library System....
	</h2>
@endsection