<!doctype html>
<html lang="en">
<head>
    @extends('layout')
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COURSE STUDENTS DATA</title>
</head>
@include('authentication.layout.header')
<body>
@section('title')
    Students of {{$course->course_name}}
@endsection
@section('content')

    <a href="{{route('addStudent',$course->id)}}" class="btn btn-success mb-3 ms-3 ">Add New Student</a>

    <table class="table table-striped table-bordered text-center">

        <thead>
        <tr class="table-success">
            <th >Sr no</th>
            <th>Profile Picture</th>
            <th>Roll Number</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>View</th>

            <th>Delete</th>

        </tr>
        </thead>
        @foreach ($course->student as $student)
            <tr>
                <td >{{$student->id}}</td>
                <td>
                    <img
                        src="{{ asset('storage/avatars/' . $student->user->profile_pic)}}" alt="dp" width="40"
                        class=" rounded-5" aria-expanded="false" aria-haspopup="true"></td>
                <td>{{$student->roll_no}}</td>
                <td>{{$student->name}}</td>
                <td>{{$student->father_name}}</td>

                <td><a href="{{route('s-info.show',[$student->id])}}" class="btn btn-primary ">view</a></td>
                <td>
                    <form action="{{route("delStudent",[$course->id,$student->id])}}" method="post">
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
