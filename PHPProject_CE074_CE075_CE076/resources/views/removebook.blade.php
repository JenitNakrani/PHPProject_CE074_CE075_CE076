@extends('layouts.master')

@section('nav-right-links')
    <a href="{{ url('mylogin') }}" class="btn btn-outline-success ms-2">Login</a>
@endsection

<title>Register</title>

@section('content')
@if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
@endif
    
    
    @if(count($books) > 0)
    <form action="{{ url ('removebook') }}" method="POST">
      @csrf
      <table class="table">
          <thead>
            <tr>
              <td>Book Name</td>
              <td>Author Name</td>
              <td>Publish Year</td>
              <td>Action</td>
            </tr>
          </thead>

          <tbody>
             @foreach($books as $book)
              <tr>
                 <td> {{$book->book_name}} </td> 
                 <td> {{$book->author_name}} </td>
                 <td> {{$book->publish_year}}</td>
                 <td> <button type="submit" name="id" class="btn btn-outline-danger" value="{{ $book->id }}">Remove</button> </td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </form>
    @else
    <div class="container">
      <h1>No Books available Please Add Here</h1>
      <a href="{{ url('addbook') }}" class="btn btn-outline-success">Add Book</a>
    </div>
    @endif

@endsection