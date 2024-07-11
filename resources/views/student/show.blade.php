@extends('layout')
@include('authentication.layout.header')
@section('content')

    <div class="container col-6 align-content-center mt-5">

        <table class="table table-striped table-bordered">
            <tr>

                <th>Profile Picture</th>
                <td>
                    <div class="d-flex justify-content-between align-items-center">

                        <img
                                src="{{ asset('storage/avatars/' . $students->user->profile_pic)}}" alt="dp" width="100"
                                class=" rounded-4 " aria-expanded="false" aria-haspopup="true">
                        @if($students->user->id==\Illuminate\Support\Facades\Auth::user()->id)
                            <a href="{{route('changeDp')}}" class="btn btn-secondary ">Change dp</a>
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <th width="300px">Student id :</th>
                <td>{{$students->id}}</td>
            </tr>
            <tr>
                <th width="300px">User Name :</th>
                <td>{{$students->name}}</td>
            </tr>
            <tr>
                <th>Father Name :</th>
                <td>{{$students->father_name}}</td>
            </tr>
            <tr>
                <th>Roll No :</th>
                <td>{{$students->roll_no}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$students->user->email}}</td>
            </tr>
        </table>
        @php
            $user=\Illuminate\Support\Facades\Auth::user();
        @endphp
        @if($students->user->id==\Illuminate\Support\Facades\Auth::user()->id)

            <a href="{{route('s-info.edit',$students->id)}}" class="btn btn-danger">Edit Profile</a>
            <a href="{{route('changePassword')}}" class="btn btn-secondary">Change password</a>
        @endif
    </div>

@endsection
@section('title')
    PROFILE DETAILS
@endsection

