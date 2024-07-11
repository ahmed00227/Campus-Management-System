@extends('layout')
@include('authentication.layout.header')

@section('title')
    UPDATE STUDENT
@endsection

@section('content')
<div class="container col-5">
    <form action="{{route('s-info.update',$students->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="roll_no" class="form-label">Roll Number</label>
            <input type="number" class="form-control @error('roll_no') is-invalid @enderror" name="roll_no" value="{{$students->roll_no}}">
        </div>
        <div class="form-text text-danger">@error('roll_no') {{ $message }} @enderror</div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$students->name}}">
        </div>
        <div class="form-text text-danger">@error('name') {{ $message }} @enderror</div>

        <div class="mb-3">
            <label for="father_name" class="form-label">Father's Name</label>
            <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{$students->father_name}}">
        </div>
        <div class="form-text text-danger">@error('father_name') {{ $message }} @enderror</div>

        <div class="mb-3">
            <input type="submit" value="Save" class="btn btn-success">
        </div>
    </form>
</div>
@endsection
