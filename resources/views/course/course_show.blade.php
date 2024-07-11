@extends('layout')
@include('authentication.layout.header')
@section('name')
    USER DETAILS
@endsection

@section('content')
<div class="container col-5">

    <table class="table table-striped table-bordered">
        <tr>
            <th width="300px" >Course ID :</th>
            <td>{{$courses->id}}</td>
        </tr>
        <tr>
            <th width="300px" >Course Name :</th>
            <td>{{$courses->course_name}}</td>
        </tr>
        <tr>
            <th>Course Code :</th>
            <td>{{$courses->course_code}}</td>
        </tr>
        <tr>
            <th>Credit Hours</th>
            <td>{{$courses->credit_hours}}</td>
        </tr>
        <tr>
            <th>Teacher Name</th>
            <td>{{$courses->teacher->teacher_name}}</td>
        </tr>
    </table>
</div>
@endsection
@section('title')
    Course's details
@endsection


