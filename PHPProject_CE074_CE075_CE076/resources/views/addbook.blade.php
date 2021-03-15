@extends('layouts.master')

@section('nav-right-links')
    <a href="{{ url('mylogin') }}" class="btn btn-outline-success ms-2">Login</a>
@endsection

<title>Register</title>

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