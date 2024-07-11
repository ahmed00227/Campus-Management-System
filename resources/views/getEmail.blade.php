<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
</head>
<body>
@include('authentication.layout.header')
<div class="container col-3 text-center border border-black border-opacity-25 mt-5 rounded-5">

    <form action="{{route('checkMail')}}" class="mt-3" method="post">
        @csrf
        <label class="mb-3 mt-3" for="mail">Enter Your Email we will send you a password reset Mail on the provided email You can reset the
            Password from there
        </label>
        <input type="email" name="email" class="mb-2" id="mail">
        <div  class="form-text text-danger mb-2">@error('email') {{ $message }} @enderror</div>

        <input type="submit" class="btn btn-sm btn-outline-success mb-3">
    </form>
</div>
</body>
</html>
