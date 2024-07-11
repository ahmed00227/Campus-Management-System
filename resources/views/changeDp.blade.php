<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UPDATING PROFILE PICTURE</title>
</head>
<body>
@include('authentication.layout.header')
<div class="container col-4 ">
<h1 class="text-center">Choose a new Profile Picture</h1>
<form action="{{route('updateDp')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="profile_pic" class="form-label">Profile Picture</label>
        <input name="profile_pic" type="file"
               class="form-control @error('profile_pic') is-invalid @enderror">
        <div class="form-text text-danger">@error('profile_pic') {{ $message }} @enderror</div>

    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
</div>

</body>
</html>
