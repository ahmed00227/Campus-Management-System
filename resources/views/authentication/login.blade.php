<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN PAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
@include('authentication.layout.header')

<header class="text-center pt-5">
    <h2>Login </h2>
</header>

<div class="container border border-black-subtle border-opacity-75 w-50 mt-5 ">

<form action="{{route('check_login')}}" class="ms-5 mt-5 me-5 mb-5" method="POST">
    @if(session('note'))
        <div class="alert alert-warning  text-center">
            {{session('note')}}
        </div>
    @endif
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input value="{{old('email')}}" type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email">

        <div  class="form-text text-danger">@error('email') {{ $message }} @enderror</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input value="{{old('password')}}" type="password"
               class="form-control @error('password') is-invalid @enderror" id="password" name="password">
        <div  class="form-text text-danger">@error('password') {{ $message }} @enderror</div>
    </div>
        <div>
    <button type="submit" class="btn btn-success mb-3">Login</button>
    <a class="text-primary" href="{{route('s-register')}}"><strong>Don't have an account?</strong></a>
        </div>
        <a href="{{route('getMail')}}" class="text-secondary mt-3">Forgotten Password</a>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        ></script>
</body>
</html>
