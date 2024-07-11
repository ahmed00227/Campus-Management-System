<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UPDATE PASSWORD FORM</title>
</head>
<body>
@php
$user=\Illuminate\Support\Facades\Auth::user();
 @endphp
@include('authentication.layout.header')
<div class="container col-5  mt-5 ">
    <h1 class="text-center mt-5 mb-5"> Password Update Form</h1>
<form action="{{route('updatePassword')}}" method="post">
    @csrf
   <div class="mb-3">
       <label for="old">Enter Previous Password</label>
       <input value="{{old('password')}}" name="password" type="password"
              class="form-control @error('password') is-invalid @enderror" id="old">
       <div  class="form-text text-danger">@error('password') {{ $message }} @enderror</div>
   </div>
    <div class="mb-3">
        <label for="new">Enter New Password</label>
        <input value="{{old('password')}}" name="newPassword" type="password"
               class="form-control @error('newPassword') is-invalid @enderror" id="new">
        <div  class="form-text text-danger">@error('newPassword') {{ $message }} @enderror</div>
    </div>
    <div class="mb-3">
        <label for="confirm">Confirm New Password</label>
        <input value="{{old('password')}}" name="confirmPassword" type="password"
               class="form-control @error('confirmPassword') is-invalid @enderror" id="confirm">
        <div  class="form-text text-danger">@error('confirmPassword') {{ $message }} @enderror</div>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>

</form>
</div>
</body>
</html>
