<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('name')</title>
    <link href={{ asset('assets/style.css') }} rel="stylesheet">

</head>

<body>

<div class="container-fluid">
    <div class="align-content-md-start ">
        <h2 class="text-center mt-5 mb-3">
            @yield('title')
        </h2>
<div class="container ms-auto me-auto col-6">

        @if(session('note'))
            <div class="alert alert-success text-center w-50 ">

           {{session('note')}}
            </div>
        @endif
</div>
        @yield('content')
    </div>

</div>
</body>
</html>
