@extends('layout')
@include('authentication.layout.header')
@section('title')
    NEW COURSE
@endsection

@section('content')
    <div class="container col-6">

    <form action="{{route('c-info.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="course_name" class="form-label @error('course_name') is-invalid @enderror">Course Name</label>
            <input type="text" class="form-control" name="course_name" value="{{old('course_name')}}" id="course_name">
        </div>
        <div class="form-text text-danger mb-3">@error('course_name') {{ $message }} @enderror</div>

        <div class="mb-3">
            <label for="course_code" class="form-label @error('course_code') is-invalid @enderror">Course Code</label>
            <input type="number" class="form-control" name="course_code" value="{{old('course_code')}}" id="course_code">
        </div>
        <div class="form-text text-danger mb-3">@error('course_code') {{ $message }} @enderror</div>

        <div class="mb-3">
            <label for="credit_hours" class="form-label">Credit Hours</label>
            <input type="number" class="form-control @error('credit_hours') is-invalid @enderror" name="credit_hours" step="0.1" id="credit_hours">
        </div>
        <div class="form-text text-danger mb-3">@error('credit_hours') {{ $message }} @enderror</div>

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
