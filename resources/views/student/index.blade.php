<!doctype html>
<html lang="en">
<head>
    @extends('layout')
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>students data</title>
</head>
<body>
@include('authentication.layout.header')
@section('title')
    ALL STUDENTS DATA
@endsection
@section('content')

    <table class="table table-striped table-bordered">

        <thead>
        <tr class="table-danger">
            <th>Sr no</th>
            <th>Profile Picture</th>
            <th>Roll Number</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>email</th>
            <th>View</th>
            <th>View Courses</th>

            {{-- <th>Account Creation Date</th>
            <th>City</th>
            <th>Actions</th> --}}
        </tr>
        </thead>
        @foreach ($students as $student)
            <tr>
                <td>{{$student->id}}</td>
                <td>
                    <img
                        src="{{ asset('storage/avatars/' . $student->user->profile_pic)}}" alt="dp" width="40"
                        class=" rounded-5" aria-expanded="false" aria-haspopup="true"></td>
                <td>{{$student->roll_no}}</td>
                <td>{{$student->name}}</td>
                <td>{{$student->father_name}}</td>
                <td>{{$student->user->email}}</td>
                <td><a href="{{route('s-info.show',[$student->id])}}" class="btn btn-primary ">view</a></td>
<td><a href="{{route('showCourse',$student->id)}}" class="btn btn-secondary">View Courses</a></td>

            </tr>
        @endforeach
    <div class="pagination">
        {{ $students->links() }}
    </div>
    </table>
@endsection
</body>
</html>
