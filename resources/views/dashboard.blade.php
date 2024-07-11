
<!DOCTYPE html>
<html>
<head>
    <title>ADMIN DASHBOARD</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">  </head>
<body>
@include('authentication.layout.header')

<div class="container mt-5">
    <h1 class="mb-5">{{__('dashboard.welcomeNote')}}</h1>

    <div class="row">
        <div class="col-md-5">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header"><h3>@lang('dashboard.users')</h3></div>
                <div class="card-body">
                    <h4 class="card-title">{{ $totalUsers }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card text-white bg-success mb-3">
                <div class="card-header"><h3>@lang('dashboard.courses')</h3></div>
                <div class="card-body">
                    <h4 class="card-title">{{ $totalCourses }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header"><h3>@lang('dashboard.students')</h3></div>
                <div class="card-body">
                    <h4 class="card-title">{{ $totalStudents }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header"><h3>@lang('dashboard.active')</h3></div>
                <div class="card-body">
                    <h4 class="card-title">{{ $activeTeachers }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-5">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header"><h3>@lang('dashboard.pending')</h3></div>
                <div class="card-body">
                    <h4 class="card-title">{{ $pendingTeachers }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')
 </body>
</html>
