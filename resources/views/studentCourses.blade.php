<!doctype html>
<html lang="en">
<head>@extends('layout')
    @section('name')
        ALL COURSES OF STUDENT
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
    Courses of {{$student->name}}
@endsection
@section('content')
<div class="container col-7">

    <a href="{{route('addCourse',$student->id)}}" class="btn btn-success ms-3 mb-3">Add Course</a>



    <table class="table table-striped table-bordered ">

        <thead>
        <tr class="table-danger">
            <th>Sr no</th>
            <th>Course Name</th>
            <th>Course Id</th>
            <th>Credit hours</th>
            <th>Teacher Name</th>
            <th>Delete</th>
            {{-- <th>Account Creation Date</th>
            <th>City</th>
            <th>Actions</th> --}}
        </tr>
        </thead>
        @foreach ($student->course as $course)
            <tr>
                <td>{{$course->id}}</td>
                <td>{{$course->course_name}}</td>
                <td>{{$course->course_code}}</td>
                <td>{{$course->credit_hours}}</td>
                <td>{{$course->teacher->teacher_name}}</td>

                <td>
                    <form action="{{route("delCourse",[$student->id,$course->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary btn-danger">delete</button>
                    </form>
                </td>


            </tr>
        @endforeach
    </table>
</div>
@endsection

</body>
</html>
