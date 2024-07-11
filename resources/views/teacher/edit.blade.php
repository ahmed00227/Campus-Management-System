@extends('layout')
@include('authentication.layout.header')
@section('title')
    PROFILE UPDATE FORM
@endsection

@section('content')
    <div class="container col-6">

    <form action="{{route('t-info.update',$teachers->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="teacher_name" class="form-label">Teacher Name</label>
            <input type="text" class="form-control @error('teacher_name') is-invalid @enderror" name="teacher_name" value="{{$teachers->teacher_name}}">
        </div>
        <div class="form-text text-danger">@error('teacher_name') {{ $message }} @enderror</div>

        <div class="mb-3">
            <label for="salary" class="form-label">Salary</label>
            <input type="number" class="form-control " name="salary"value="{{$teachers->salary}}" readonly>
        </div>

        <div class="mb-3">
            <input type="submit" value="Save" class="btn btn-success">
        </div>
    </form>
    </div>
@endsection
