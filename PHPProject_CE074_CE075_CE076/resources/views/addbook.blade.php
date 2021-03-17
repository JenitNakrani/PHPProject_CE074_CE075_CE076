@extends('layouts.master')

<title>Register</title>
@section('nav-right-links')
    <a href="{{ url('addbook') }}" class="btn btn-outline-success ms-2">Add book</a>
    <a href="{{ url('removebook') }}" class="btn btn-outline-success ms-2">Remove book</a>
    <a href="{{ url('/logout') }}" class="btn btn-outline-danger ms-2">Logout</a>
@endsection

@section('content')
@if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
@endif
    <form class="mt-5" action="{{ url('addbook') }}" method="POST" style="width: 300px;">
    @csrf
    <div class="mb-3">
        <label class="form-label">Book Name</label>
        <input type="text" class="form-control" name="book_name">
    </div>
    <div class="mb-3">
        <label class="form-label">Author Name</label>
        <input type="text" class="form-control" name="author_name">
    </div>
    <div class="mb-3">
        <label class="form-label">Publish Year</label>
        <input type="number" class="form-control" name="publish_year">
    </div>
    <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
@endsection