<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Page</title>
</head>
<body>
@include('authentication.layout.header')
<div class="row">
    <div class="col-md-4 border-right">
        <h5 class="p-3">Chats</h5>
        <div >

            <ul class="list-group list-group-flush" id="list">

                @for($i = 0; $i < count($uniqueIds); $i++)
                    <li class="list-group-item ms-2" id="user-{{$uniqueIds[$i]}}">
                        <a href="{{route('ChatUser',['id'=>$uniqueIds[$i]])}}" class='text-decoration-none text-black'>
                            <strong id="name">{{$chatname[$i]}}</strong>
                            <strong class="text-danger " id="chat-{{$uniqueIds[$i]}}" style="display: {{ $unseen[$i] === 0  ? 'none' : 'inline' }}">{{$unseen[$i]}}</strong>
                            @if($uniqueIds[$i]===\Illuminate\Support\Facades\Auth::id())
                                <strong> ( YOU )</strong>
                            @endif

                        </a>
                    </li>
                @endfor
            </ul>
        </div>
        <div>

            <h5 class="p-3">Other Users</h5>
            <ul class="list-group list-group-flush">

                @for($i = 0; $i < count($nonContactedUsers); $i++)

                    <li class="list-group-item ms-2" id="user-{{$nonContactedUsers[$i]}}">

                        <a href="{{route('ChatUser',$nonContactedUsers[$i])}}"
                           class='text-decoration-none text-black '>
                            <strong id="name">{{$unchatname[$i]}}</strong>
                            <strong class="text-danger " id="chat-{{$nonContactedUsers[$i]}}" style="display: none">0</strong>

                        @if($nonContactedUsers[$i]===\Illuminate\Support\Facades\Auth::id())
                                <strong> ( YOU )</strong>
                            @endif

                        </a>
                    </li>

                @endfor
                @if($nonContactedUsers==null)
                    <div><strong class="text-warning ms-3">No users available</strong></div>
                @endif
            </ul>
        </div>

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <img
                    src="{{ asset('storage/avatars/' . $user->profile_pic)}}" alt="dp" width="40"
                    class="dropdown-toggle rounded-5" aria-expanded="false" aria-haspopup="true"> Welcome User
            </div>
            <div class="card-body overflow-auto" style="height: 400px;">
                <p>Select a Person to Start Chatting</p>
            </div>

        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>

    var pusher = new Pusher('d28e873c11673cc56138', {
        cluster: 'ap2'
    });

    var channel = pusher.subscribe('notify-channel');

    function incrementValue(value) {
        var strongTag = document.getElementById('chat-' + value);
        if (strongTag.textContent.trim() === "0") {
            strongTag.style.display = "inline";
        }
        var currentValue = parseInt(strongTag.textContent);
        currentValue += 1;
        strongTag.textContent = currentValue;
    }

    function ShiftValues(value) {
        var unContacted = document.getElementById('user-' + value);
        unContacted.remove();
        var contacted = $('#list');
        contacted.prepend(unContacted); // Use jQuery append method
    }


    channel.bind('chat-' + {{\Illuminate\Support\Facades\Auth::id()}}, function (data) {
        ShiftValues(data.message);
        incrementValue(data.message);

    });
</script>
</html>
