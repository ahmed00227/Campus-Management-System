<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADD STUDENT</title>
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
    <form id="addStudentForm" action="{{ route('saveStudent', $courses->id) }}" method="POST">
        @csrf
        <input type="hidden" name="course_id" value="{{ $courses->id }}">

        <div class="form-group">
            <label for="course_name"><h5>Course Name:</h5></label>
            <input type="text" class="form-control" id="course_name" value="{{ $courses->course_name }}" readonly>
        </div>
        <div class="form-group">
            <label for="course_code"><h5>Course Code:</h5></label>
            <input type="text" class="form-control" id="course_code" value="{{ $courses->course_code }}" readonly>
        </div>
        <div class="form-group">
            <label for="credit_hours"><h5>Credit Hours:</h5></label>
            <input type="text" class="form-control" id="credit_hours" value="{{ $courses->credit_hours }}" readonly>
        </div>
        <div class="form-group">

            <fieldset>
                <br>
                <label>Select Students</label>
                <details>
                    <summary>Select the students to enroll</summary>
                    <ul id="student-list">
                        @foreach($students as $student)
                            <li>
                                <label><input type="checkbox" name="student_id[]" value="{{ $student->id }}" @if ($courses->student->contains($student->id)) checked @endif>{{ $student->name }} - {{ $student->roll_no }}</label>
                            </li>
                        @endforeach
                    </ul>
                </details>
            </fieldset>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@include('footer')
</body>
</html>
