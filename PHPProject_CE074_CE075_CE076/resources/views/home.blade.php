<!-- app/views/user/show.blade.php -->
@extends('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><label>View User</label>
        <a class ='pull-right' href="{{ Request::header('referer') }}">
            <i class="glyphicon glyphicon-circle-arrow-left"></i> Go Back
        </a>
    </div>