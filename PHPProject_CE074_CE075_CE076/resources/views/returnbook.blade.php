@extends('layouts.master')

<title>Return Book</title>

@section('nav-right-links')
        <a href="{{ url('/logout') }}" class="btn btn-outline-danger ms-2">Logout</a>      
@endsection

@section('nav-left-links')
  <a href="{{ url('issuebook') }}" class="btn btn-outline-success ms-2">Issue book</a>  
  <a href="{{ url('returnbook') }}" class="btn btn-outline-success ms-2">Return book</a>
@endsection

@section('content')
@if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
@endif
    @if(count($books) > 0)
    <form action="{{ url ('returnbook') }}" method="POST">
      @csrf
      <table class="table">
          <thead>
            <tr>
              <td>Book Name</td>
              <td>Author Name</td>
              <td>Publish Year</td>
              <td>stock</td>
              <td>available</td>
              <td>issued</td>
              <td>Action</td>
            </tr>
          </thead>

          <tbody>
             @foreach($books as $book)
              <tr>
                 <td> {{$book->book_name}} </td> 
                 <td> {{$book->author_name}} </td>
                 <td> {{$book->publish_year}}</td>
                 <td> {{$book->stock}}</td>
                 <td> {{$book->is_available}}</td>
                 <td> {{$book->issued_book}}</td>
                 <td> <button type="submit" name="id" class="btn btn-outline-danger" value="{{ $book->id }}">Return</button> </td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </form>
    @else
    <div class="container">
      <h1>No Issued Books</h1>
    </div>
    @endif
@endsection