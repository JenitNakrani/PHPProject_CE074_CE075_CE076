@extends('layouts.master')

<title>Remove book</title>

@section('nav-right-links')
    <a href="{{ url('addbook') }}" class="btn btn-outline-success ms-2">Add book</a>
    <a href="{{ url('removebook') }}" class="btn btn-outline-success ms-2">Remove book</a>
    <a href="{{ url('/logout') }}" class="btn btn-outline-danger ms-2">Logout</a>
@endsection

@section('content')
@if(session('message'))
    <div class="alert alert-danger">{{session('message')}}</div>
@endif

<div class="container">
        <form action="{{ url ('removebook') }}" method="GET" novalidate="novalidate">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0 mr-3" >
                            <input class="form-control me-2" type="search" name="input_query" placeholder="Search" aria-label="Search" size="100">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0 mr-3">
                            <select class="form-control search-slt" name="option">
                                <option value="all">Choose Search Type</option>
                                <option value="book_name">Book Name</option>
                                <option value="author_name">Author Name</option>
                                <option value="publish_year">Publish Year</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <button type="submit" class="btn btn-primary wrn-btn">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    
    @if(count($books) > 0)
    <form action="{{ url ('removebook') }}" method="POST">
      @csrf
      <table class="table">
          <thead>
            <tr>
              <td>Book Name</td>
              <td>Author Name</td>
              <td>Publish Year</td>
              <td>Book Stock</td>
              <td>Issued Book</td>
              <td>Is Available</td>
              <td>Action</td>
            </tr>
          </thead>

          <tbody>
             @foreach($books as $book)
              <tr>
                 <td> {{$book->book_name}} </td> 
                 <td> {{$book->author_name}} </td>
                 <td> {{$book->publish_year}}</td>
                 <td> {{$book->stock}} </td>
                 <td> {{$book->issued_book}} </td>
                 <td> {{$book->is_available}} </td>
                  
                 <td> <button type="submit" name="id" class="btn btn-outline-danger" value="{{ $book->id }}">Remove</button> </td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </form>
    @else
    <div class="container">
      <h1>No book in library
      </h1>
    </div>
    @endif

@endsection