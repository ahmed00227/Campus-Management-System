<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STUDENT REGISTRATION</title>
    <link href={{ asset('assets/style.css') }} rel="stylesheet">
</head>
<body>
@include('authentication.layout.header');
<header class="text-center mt-2">
    <h2>Registration</h2>
</header>
<div class="container w-50 mt-3 mb-5 border border-black-subtle border-opacity-75">

<form action="{{route('s-create')}}" class="ms-2 mt-3 me-2 mb-5" method="POST" enctype="multipart/form-data">
    @if(session('note'))
        <div class="alert alert-warning  text-center">
            {{session('note')}}
        </div>
    @endif
    @csrf
    <div class="row mb-3">

    <div class="col">
    <label for="name" class="form-label">Student Name: </label>
    <input value="{{old('name')}}" name="name" type="text"
           class="form-control @error('name') is-invalid @enderror" id="name">
    <div  class="form-text text-danger">@error('name') {{ $message }} @enderror</div>

</div>
    <div class="col">
        <label for="father_name" class="form-label">Father Name: </label>
        <input value="{{old('father_name')}}" name="father_name" type="text"
               class="form-control @error('father_name') is-invalid @enderror" id="father_name">
        <div  class="form-text text-danger">@error('father_name') {{ $message }} @enderror</div>

    </div>
    </div>
    <div class="row mb-3">

<div class="col">
    <label for="email" class="form-label">Email address</label>
    <input value="{{old('email')}}" name="email" type="email"
           class="form-control @error('email') is-invalid @enderror" id="email">
    <div  class="form-text text-danger">@error('email') {{ $message }} @enderror</div>
</div>
    <div class="col ">
        <label for="roll_no" class="form-label">Roll Number</label>
        <input value="{{old('roll_no')}}" name="roll_no" type="number"
               class="form-control @error('roll_no') is-invalid @enderror" id="roll_no">
        <div  class="form-text text-danger">@error('roll_no') {{ $message }} @enderror</div>
    </div>
    </div>
    <div class="row mb-3">

<div class="col">
    <label for="password" class="form-label">Password</label>
    <input value="{{old('password')}}" name="password" type="password"
           class="form-control @error('password') is-invalid @enderror" id="password">
    <div  class="form-text text-danger">@error('password') {{ $message }} @enderror</div>

</div>
    <div class="col">
        <label for="confirm-password" class="form-label">Confirm Password</label>
        <input value="{{old('confirm-password')}}" name="confirm-password" type="password"
               class="form-control @error('confirm-password') is-invalid @enderror" id="confirm-password">
        <div  class="form-text text-danger">@error('confirm-password') {{ $message }} @enderror</div>

    </div>
    </div>
    <div class="mb-3">
        <label for="profile_pic" class="form-label">Profile Picture</label>
        <input name="profile_pic" type="file"
               class="form-control @error('profile_pic') is-invalid @enderror">
        <div class="form-text text-danger">@error('profile_pic') {{ $message }} @enderror</div>

    </div>
<button type="submit" class="btn btn-success">Register</button>
    <a href="{{route('t-register')}}" class="btn btn-secondary">Register as teacher</a>
<a  href="{{route('login')}}"><strong>Already registered ?login</strong></a>



</form>
</div>
</body>
</html>
