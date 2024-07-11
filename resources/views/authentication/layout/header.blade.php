@php
    \Illuminate\Support\Facades\App::setLocale(session('language'));
@endphp
<link rel="stylesheet" href="{{asset('assets/style.css')}}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('d28e873c11673cc56138', {
        cluster: 'ap2'
    });

    var channel = pusher.subscribe('notify-channel');
    channel.bind('user-' + {{\Illuminate\Support\Facades\Auth::id()}}, function (data) {
        Swal.fire(data.message);
    });


</script>

<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu {
        transform: translate(-50%, 5px);
        transform-origin: top left;
    }

</style>
<header class="bg-body-secondary bg-success-subtle d-flex p-3 px-5 justify-content-between">
    <div class="logo text-primary-subtle">
        <a href="{{route('home')}}" class="text-decoration-none text-primary-subtle"><h3>Paradox</h3></a>
    </div>
    <nav class="nav">

        <li><a href="{{route('about')}}" class="dropdown-item me-3 mt-2 text-dark"><strong>About</strong></a></li>

        @if(Auth::check())
            @php
                $user = \Illuminate\Support\Facades\Auth::user();
                    if ($user->roles == 1) {
                        $name = 'admin';


                    } elseif ($user->roles == 2) {
                        $name = $user->teacher->teacher_name;
                        $id = $user->teacher->id;


                    } else {
                        $name = $user->student->name;
                        $id = $user->student->id;
                    }
            @endphp

            <div class="dropdown">
                <button class="btn btn-dark-subtle dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>
                        Language
                    </strong>
                </button>

                <ul class="dropdown-menu bg-success-subtle" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="/language/en">English</a></li>
                    <li><a class="dropdown-item" href="/language/ur">Urdu</a></li>
                    <li><a class="dropdown-item" href="/language/hi">Hindi</a></li>
                </ul>
            </div>
            @if($user->email_verified_at==null)
                <div class="alert alert-danger  w-75  text-center">
                    <p>Your Email varification is pending.Verify your email or click resend now if you havn't received
                        an email</p>
                    <a href="{{route('resend',$user->id)}} " class="btn btn-danger btn-sm">Resend Now</a>
                </div>
            @endif
            @if($user->roles==1)

                <li><a href="{{route('dashboard')}}"
                       class="dropdown-item me-3 mt-2 text-dark"><strong>Dashboard</strong></a></li>

                <li><a href="{{route('s-info.index')}}"
                       class="dropdown-item text-dark me-3 mt-2"><strong>Students</strong></a></li>
                <li><a href="{{route('t-info.index')}}"
                       class="dropdown-item text-dark me-3 mt-2"><strong>Teachers</strong></a></li>
                <li><a href="{{route('c-info.index')}}"
                       class="dropdown-item text-dark me-3  mt-2 "><strong>Courses</strong></a></li>
            @endif
            <li class="nav-item dropdown">

                <img
                    src="{{ asset('storage/avatars/' . $user->profile_pic)}}" alt="dp" width="40"
                    class="dropdown-toggle rounded-5" aria-expanded="false" aria-haspopup="true">
                <ul class="dropdown-menu bg-success-subtle">
                    <li><a class="dropdown-item text-dark" href="#">{{$name}}</a></li>

                    @if($user->roles==2)
                        <li>
                            <hr class="dropdown-divider navbar-dark">
                        </li>
                        <li><a href="{{route('t-info.show',$user->teacher->id)}}" class="dropdown-item text-dark">My
                                profile</a></li>
                        <li><a href="{{route('teacherCourse',$user->teacher->id)}}" class="dropdown-item text-dark">My
                                Courses</a></li>

                    @elseif($user->roles==1)
                        <li>
                            <hr class="dropdown-divider navbar-dark">
                        </li>
                        <a href="{{route('changePassword')}}" class="dropdown-item text-dark">Change
                            password</a>
                        <a href="{{route('changeDp')}}" class="dropdown-item text-dark">Change Profile pic</a>

                    @elseif($user->roles==3)
                        <li>
                            <hr class="dropdown-divider navbar-dark">
                        </li>
                        <li><a href="{{route('s-info.show',$user->student->id)}}" class="dropdown-item text-dark">My
                                profile</a></li>
                        <li><a href="{{route('showCourse',$user->student->id)}}" class="dropdown-item text-dark">My
                                Courses</a></li>

                    @endif
                    <li><a href="{{route('ChatPage')}}"
                           class="dropdown-item mt-2 text-dark"><strong>Chat Room</strong></a></li>

                    <li>
                        <hr class="dropdown-divider navbar-dark">
                    </li>
                    <li>
                        <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            logout
                        </button>
                    </li>
                </ul>
            </li>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Logout Confirmation!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-danger">
                            Are you sure that you want to logout of this site!
                        </div>
                        <div class="modal-footer">
                            <a href="{{route('logout')}}" type="button" class="btn btn-danger">Confirm Logout!</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <a href="{{route('login')}}" class="nav-link text-dark"><strong>Login</strong></a>
            <a href="{{ route('s-register') }}" class="nav-link text-dark"><strong>Register</strong></a>

        @endif
    </nav>

</header>

