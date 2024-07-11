
    @extends('layout')


@include('authentication.layout.header')
@section('title')
    ALL TEACHERS DATA
@endsection
@section('content')
    <table class="table table-striped table-bordered">

        <thead>
        <tr class="table-danger">
            <th>Sr no</th>
            <th>Profile Picture</th>
            <th>Teacher Name</th>
            <th>Salary</th>

            <th>Email</th>
            <th>Account status</th>
            <th>View Profile</th>
            <th>view courses</th>
            <th>Approve</th>
        </tr>
        </thead>
        @foreach ($teachers as $teacher)
            <tr>
                <td>{{$teacher->id}}</td>
<td>
    <img
        src="{{ asset('storage/avatars/' . $teacher->user->profile_pic)}}" alt="dp" width="40"
        class=" rounded-5" aria-expanded="false" aria-haspopup="true"></td>
                <td>{{$teacher->teacher_name}}</td>
                <td>{{$teacher->salary}}</td>
                <td>{{$teacher->user->email}}</td>
                <td>@if($teacher->status==0)Inactive @else Active @endif</td>
                <td><a href="{{route('t-info.show',[$teacher->id])}}" class="btn btn-primary ">View Profile</a></td>
                <td><a href="{{route('teacherCourse',[$teacher->id])}}" class="btn btn-secondary ">View Courses</a></td>

                <td>@if($teacher->status==1) @else <a href="{{route('t-info.approve',$teacher->id)}}" class="btn btn-success">Approve</a>@endif</td>


            </tr>
        @endforeach
    </table>
    <div class="pagination">
        {{ $teachers->links() }}
    </div>

@endsection

