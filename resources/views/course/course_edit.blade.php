@extends('layout')
@include('authentication.layout.header')
@section('title')
    EDIT COURSE
@endsection

@section('content')
    <div class="container col-5">

    <form action="{{route('c-info.update',$courses->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" class="form-control" name="course_name" value="{{$courses->course_name}}">
        </div>
        <div class="mb-3">
            <label for="course_id" class="form-label">Course Code</label>
            <input type="number" class="form-control" name="course_code" value="{{$courses->course_code}}">
        </div>
        <div class="mb-3">
            <label for="credit_hours" class="form-label">Credit Hours</label>
            <input type="number" class="form-control" name="credit_hours" step="0.1" value="{{$courses->credit_hours}}">
        </div>
        <div class="form-group mb-3">
            <label for="teacher">Select Teacher:</label>
            <select class="form-control" id="teacher" name="teacher_id">
                @foreach($teachers as $teacher)
                    @if($teacher->status==1)

                        <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <input type="submit" value="Save" class="btn btn-success">
        </div>
    </form>
    </div>
@endsection
