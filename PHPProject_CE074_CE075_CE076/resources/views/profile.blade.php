@extends('layouts.master')

<title>Welcome</title>

@section('nav-left-links')
    <a href="{{ url('issuebook')}}" class="btn btn-outline-success ms-2">Issue book</a>  
    <a href="{{ url('returnbook')}}" class="btn btn-outline-success ms-2">Return book</a>
    <a href="{{ url('payfine')}}" class="btn btn-outline-success ms-2">Pay Fine</a>
@endsection

@section('nav-right-links')
<a href="{{ url('logout')}}" class="btn btn-outline-danger ms-2">Logout</a>
@endsection

@section('content')
	<form action="" method="POST">
		<h1>Profile</h1>
<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Username</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{session()->get('uname')}}" readonly>
                                
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">First name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" id="firstname" name="firstname" value="{{$user[0]->firstname}}" pattern="[A-Za-z]+" required readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Last name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{$user[0]->lastname}}" pattern="[A-Za-z]+" required readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="email" class="form-control" id="email" name="email" value="{{$user[0]->email}}" required readonly>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@section('mystyle')
<style>
    body {
        color: #797979;
        background: #f1f2f7;
        font-family: 'Open Sans', sans-serif;
        padding: 0px !important;
        margin: 0px !important;
        font-size: 13px;
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
        -moz-font-smoothing: antialiased;
    }
    .main-body {
        padding: 15px;
    }

    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }

    .h-100 {
        height: 100% !important;
    }

    .shadow-none {
        box-shadow: none !important;
    }
    input[type=text]
    {
        border: 0;
    }
    input[type=email]
    {
        border: 0;
    }
</style>
@endsection