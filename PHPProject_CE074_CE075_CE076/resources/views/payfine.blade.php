@extends('layouts.master')

<title>Return Book</title>

@section('nav-right-links')
        <a href="{{ url('/logout') }}" class="btn btn-outline-danger ms-2">Logout</a>    
@endsection

@section('nav-left-links')
  <a href="{{ url('issuebook') }}" class="btn btn-outline-success ms-2">Issue book</a>  
  <a href="{{ url('returnbook') }}" class="btn btn-outline-success ms-2">Return book</a>
  <a href="{{ url('payfine')}}" class="btn btn-outline-success ms-2">Pay Fine</a>
@endsection

@section('content')
@if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
@endif
<form>
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="p-3 bg-white rounded">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-uppercase">Library</h1>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Name:</span><span class="ml-1">   
                        @if(session()->has('uname'))
                            {{session()->get('uname')}}
                        @endif</span></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Date:</span><span class="ml-1">{{date('d-m-Y')}}</span></div>

                    </div>  
                    <div class="col-md-6 text-right mt-3">
                        <h4 class="text-danger mb-0">Library Mangement</h4><span>library.com</span>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Book ID</th>
                                    <th>Book Name</th>
                                    <th>Late Days</th>
                                    <th>Fine</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @php
                                    $total=0
                                @endphp
                                @foreach($books as $book)
                                     @php
                                       $fine=0
                                     @endphp                                    
                                    @if(round((time() - strtotime($book['issued_date'])) / (3600*24))<=0)
                                    	<tr>
    										<td> {{$book['book_id']}} </td> 
    										<td> {{$book['book']->book_name}} </td>
    										<td> Not Late </td>
                                            <td>{{$fine}}<td>
                                            @php
                                                $total+=$fine
                                            @endphp
    									</tr>
    								@else
    									<tr>
    										<td> {{$book['book_id']}} </td> 
    										<td> {{$book['book']->book_name}} </td>
    										<td> {{round((time() - strtotime($book['issued_date'])) / (3600*24)) }}</td>
    										<td>10</td>
                                             @php
                                                $total+=10
                                            @endphp
    									</tr>
                                    @endif
                                @endforeach
                              <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td>{{$total}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
