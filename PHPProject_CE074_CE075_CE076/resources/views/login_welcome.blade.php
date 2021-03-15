@extends('layouts.master')

@section('nav-right-links')
    <a href="" class="btn btn-outline-success ms-2">Add book</a>
    <a href="" class="btn btn-outline-success ms-2">Issue book</a>
    <a href="" class="btn btn-outline-success ms-2">Remove book</a>
    <a href="{{ url('/logout') }}" class="btn btn-outline-danger ms-2">Logout</a>
@endsection