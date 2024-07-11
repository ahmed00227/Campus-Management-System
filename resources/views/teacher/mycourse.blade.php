<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DETAILS OF COURSES</title>
</head>
@include('authentication.layout.header')
<body>
<header class="text-center mt-5 mb-5 "><h1>{{$teacher->teacher_name}}'s Courses</h1></header>
<table class="table table-striped table-bordered">

    <thead>
    <tr class="table-danger">
        <th>Sr no</th>
        <th>Course Name</th>
        <th>Course Code</th>
        <th>Credit hours</th>
        <th>View Students</th>
    </tr>
    </thead>
    @foreach ($teacher->course as $course)
        <tr>
            <td>{{$course->id}}</td>
            <td>{{$course->course_name}}</td>
            <td>{{$course->course_code}}</td>
            <td>{{$course->credit_hours}}</td>


            <td><a href="{{route('showStudent',[$course->id])}}" class="btn btn-primary ">View Students</a></td>

        </tr>
    @endforeach
</table>
</body>
</html>
