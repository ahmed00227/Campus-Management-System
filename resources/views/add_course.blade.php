<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADD COURSE</title>
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <style>
        :root {
            --blue: #0255f0;
            --lt-gray: #cccccc;
            --dk-gray: #767676;
        }
        * {
            box-sizing: border-box;
            font-family: Tahoma;
            font-size: 0.875rem;
        }
        fieldset {
            border: none;
        }
        fieldset > label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
            vertical-align: top;
            font-size: 1rem;
            line-height: 28px;
        }
        fieldset > label::after {
            content: ":";
        }
        select,
        details {
            display: inline-block;
            width: 250px;
            background-color: white;
            cursor: pointer;
        }
        select,
        summary {
            border: 1px solid var(--lt-gray);
            border-collapse: collapse;
            border-radius: 4px;
            padding: 4px;
            width: 250px;
            background-color: white;
            cursor: pointer;
        }
        details[open] > summary::marker {
            color: var(--blue);
        }
        select:focus,
        summary:focus,
        summary:active {
            box-shadow: 0 0 5px 1px var(--blue);
        }

        ul {
            list-style: none;
            margin: 0px;
            padding: 0px;
            margin-top: 2px;
            border: 1px solid var(--dk-gray);
            box-shadow: 0 0 5px 1px var(--lt-gray);
        }
        li {
            margin: 0px;
            padding: 0px;
        }
        li > label {
            cursor: pointer;
            display: inline-block;
            width: 100%;
        }
        li > label:hover,
        li > label:has(input:checked) {
            background-color: var(--dk-gray);
            color: white;
        }
    </style>
</head>
@include('authentication.layout.header')
<body>
<div class="container mt-5 col-4">
    <h1 class="text-center mb-5">Add Student to Course</h1>
    <form action="{{ route('saveCourse', $students->id) }}" method="POST">
        @csrf
        <input type="hidden" name="student_id" value="{{ $students->id }}">

        <div class="form-group">
            <label for="name"><h5 class="mt-2">Student Name:</h5></label>
            <input type="text" class="form-control" id="name" value="{{ $students->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="father_name"><h5 class="mt-2">Father Name:</h5></label>
            <input type="text" class="form-control" id="father_name" value="{{ $students->father_name }}" readonly>
        </div>
        <div class="form-group">
            <label for="roll_no"><h5 class="mt-2">Roll Number:</h5></label>
            <input type="number" class="form-control" id="roll_no" value="{{ $students->roll_no }}" readonly>
        </div>


        <div class="form-group">

            <fieldset>
                <br>
                <label>Select Courses</label>
                <details>
                    <summary>Select Courses to enroll</summary>
                    <ul id="student-list">
                        @foreach($courses as $course)
                            <li>
                                <label><input type="checkbox" name="course_id[]" value="{{ $course->id }}" @if ($students->course->contains($course->id)) checked @endif>{{ $course->course_name }} - {{ $course->course_code }}</label>
                            </li>
                        @endforeach
                    </ul>
                </details>
            </fieldset>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

</body>
</html>
