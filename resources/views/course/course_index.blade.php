<!doctype html>
<html lang="en">
<head>@extends('layout')
    @section('name')
        All Courses
    @endsection
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@include('authentication.layout.header')
@section('title')
    ALL COURSE DETAILS
@endsection
@section('content')
<div class="d-flex justify-content-between">

    <a href="{{route('c-info.create')}}" class="btn btn-success ms-3 mb-3">Add Course</a>
    <a href="{{route('download_courses')}}" class="btn btn-outline-secondary ms-3 mb-3">Download Details </a>


</div>



    <table class="table table-striped table-bordered">

        <thead>
        <tr class="table-danger">
            <th>Sr no</th>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Credit hours</th>
            <th>Teacher Name</th>
            <th>View Students</th>
            <th>View</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        @foreach ($courses as $course)
            <tr>
                <td>{{$course->id}}</td>
                <td>{{$course->course_name}}</td>
                <td>{{$course->course_code}}</td>
                <td>{{$course->credit_hours}}</td>
                <td>{{$course->teacher->teacher_name}}</td>
                <td><a href="{{route('showStudent',[$course->id])}}" class="btn btn-success">View students</a></td>

                <td><a href="{{route('c-info.show',[$course->id])}}" class="btn btn-primary ">view</a></td>
                <td><a href="{{route('c-info.edit',[$course->id])}}" class="btn btn-warning">update</a></td>
                <td>
                <form action="{{route("c-info.destroy",[$course->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary btn-danger">delete</button>
                </form>
                </td>


            </tr>
        @endforeach
    </table>
@endsection

</body>
</html>
