<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOME PAGE</title>
</head>
<body>
@include('authentication.layout.header')
@if(session('note'))
    <div class="alert alert-warning  w-25  text-center">
        {{session('note')}}
    </div>
@endif
hello welcome to home



@include('authentication.footer');
</body>
</html>
