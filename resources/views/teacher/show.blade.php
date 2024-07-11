@extends('layout')
@include('authentication.layout.header')
@section('content')
    @php
        $user=\Illuminate\Support\Facades\Auth::user();
    @endphp
<div class="container align-content-center mt-5 w-50">

    <table class="table table-striped table-bordered align-content-center">
        <tr>

            <th>Profile Picture</th>

            <td class="align-content-center">
            <div class="d-flex justify-content-between align-items-center">

                <img
                src="{{ asset('storage/avatars/' . $teachers->user->profile_pic)}}" alt="dp" width="100"
                class=" rounded-4 " aria-expanded="false" aria-haspopup="true">
                @if($teachers->user->id==$user->id)

                <a href="{{route('changeDp')}}" class="btn btn-secondary ">Change dp</a>
                @endif

            </div></td>

        </tr>
        <tr class="col-6">
            <th width="300px" >Teacher ID :</th>
            <td>{{$teachers->id}}</td>
        </tr>
        <tr class="col-6">
            <th width="300px" >User Name :</th>
            <td>{{$teachers->teacher_name}}</td>
        </tr>
        <tr>
            <th>Email :</th>
            <td>{{$teachers->user->email}}</td>
        </tr>
        <tr>
        <th>Salary :</th>
        <td>{{$teachers->salary}}</td>
        </tr>
        <tr>
            <th>Account status :</th>
            <td>@if($teachers->status==0)Inactive @else Active @endif</td>
        </tr>
    </table>

    @if($teachers->user->id==$user->id)

<a href="{{route('t-info.edit',$teachers->id)}}" class="btn btn-danger">Edit Profile</a>
        <a href="{{route('changePassword')}}" class="btn btn-secondary">Change password</a>

    @endif
</div>
@endsection
@section('title')
    Profile Details
@endsection
