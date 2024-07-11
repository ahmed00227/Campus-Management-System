<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
@include('authentication.layout.header')
<div class="container mt-5 text-center col-4">
    <h1 class="mt-4 mb-3">Password Reset Form</h1>
    <form action="{{route('savePassword',$user->id)}}" class="mt-4 ms-4 me-4 border  border-black border-opacity-25 rounded-5" method="post">
        @csrf
        <div class="mb-3">
        <label for="pass">Enter the New Password</label>
            <input type="password" class="form-control @error('confirm') is-invalid @enderror" id="pass" name="password">
        </div>
        <div  class="form-text text-danger">@error('password') {{ $message }} @enderror</div>

        <div class="mb-3">
            <label for="confirm">Confirm the New Password</label>
            <input type="password" class="form-control @error('confirm') is-invalid @enderror" id="confirm" name="confirm">
        </div>
        <div  class="form-text text-danger">@error('confirm') {{ $message }} @enderror</div>

        <div class="mb-3">
            <input type="submit" class="btn btn-success btn-sm"  value="Confirm">
        </div>
    </form>
</div>
</body>
</html>
