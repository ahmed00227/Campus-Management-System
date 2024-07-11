<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chating</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        function ShiftValues(value) {
            var unContacted = document.getElementById('user-' + value);
                unContacted.remove();
            var contacted = $('#list');
            contacted.prepend(unContacted);
        }

        Pusher.logToConsole = true;

        var pusher = new Pusher('d28e873c11673cc56138', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('notify-channel');

        function updateChatWindow(message) {
            var chatWindow = $('.card-body.overflow-auto');
            var messageElement;
            console.log(message.message)
            messageElement = $('<div class=" rounded mb-2 " ><strong> {{$receiver_name}} : </strong>' + message + '</div>');
            chatWindow.append(messageElement);

            chatWindow.scrollTop(chatWindow.prop('scrollHeight'));
        }

@if($receiver->id!=\Illuminate\Support\Facades\Auth::id())
        channel.bind({{\Illuminate\Support\Facades\Auth::id()}} + 'user' + {{$receiver->id}}, function (data) {

            updateChatWindow(data.message);

            $.ajax({
                url: '{{route('readMessage', $receiver->id )}}',
                type: 'POST',
                data: {'receiver_id': {{ $receiver->id }}, '_token': '{{csrf_token()}}'},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                }
            });
        });
        @endif
        function deleteLine() {
            var element = document.getElementById('line');
            element.remove();
        }

        function updateChatUser(message) {
            var chatWindow = $('.card-body.overflow-auto');
            var messageElement;
            console.log(message.message)
            messageElement = $('<div class=" rounded mb-2 " style="text-align: right" >' + message + '<strong>: You</strong></div>');
            // Append the new message to the chat window
            chatWindow.append(messageElement);

            chatWindow.scrollTop(chatWindow.prop('scrollHeight'));
        }

        channel.bind({{$receiver->id}} + 'user' + {{\Illuminate\Support\Facades\Auth::id()}}, function (data) {
            ShiftValues({{$receiver->id}});
            updateChatUser(data.message);
            deleteLine();
        });

        function incrementValue(value) {
            var strongTag = document.getElementById('chat-' + value);
            if (strongTag.textContent.trim() === "0") {
                strongTag.style.display = "inline";
            }
            var currentValue = parseInt(strongTag.textContent);
            currentValue += 1;
            strongTag.textContent = currentValue;
        }

        channel.bind('chat-' + {{\Illuminate\Support\Facades\Auth::id()}}, function (data) {
            ShiftValues(data.message);

            if (!(data.message === {{$receiver->id}})) {

                incrementValue(data.message);

            }
        });

    </script>
</head>
<body>
@include('authentication.layout.header')
<div class="row">
    <div class="col-md-4  border-right">
        <h5 class="p-3">Chats</h5>
        <div >

            <ul class="list-group list-group-flush" id="list">

                @for($i = 0; $i < count($ids); $i++)

                    <li class="list-group-item" id="user-{{$ids[$i]}}">

                        <a href="{{route('ChatUser',$ids[$i])}}"
                           class='text-decoration-none text-black @if($ids[$i]==$receiver->id) bg-success-subtle @endif'>
                            <strong>{{$chatname[$i]}}</strong>
                            <strong class="text-danger" id="chat-{{$ids[$i]}}" style="display: {{ $unseen[$i] === 0 || $receiver->id===$ids[$i] ? 'none' : 'inline' }}">    {{$unseen[$i]}}</strong>
                            @if($ids[$i]===\Illuminate\Support\Facades\Auth::id())
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

                    <li class="list-group-item" id="user-{{$nonContactedUsers[$i]}}">

                        <a href="{{route('ChatUser',$nonContactedUsers[$i])}}"
                           class='text-decoration-none text-black @if($nonContactedUsers[$i]==$receiver->id) bg-success-subtle @endif'>
                            <strong>{{$unchatname[$i]}}</strong>
                            @if($nonContactedUsers[$i]===\Illuminate\Support\Facades\Auth::id())
                                <strong> ( YOU )</strong>
                            @endif

                        </a>
                    </li>

                @endfor
                @if($nonContactedUsers==null)
                    <div class="ms-3 text-warning"><strong>No users to display </strong></div>
                @endif

            </ul>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><img
                    src="{{ asset('storage/avatars/' . $receiver->profile_pic)}}" alt="dp" width="50"
                    class="dropdown-toggle rounded-5" aria-expanded="false" aria-haspopup="true"><strong class="ms-2">{{$receiver_name}}</strong>
            </div>
            <div class="card-body overflow-auto" style="height: 400px;">
                @php $trigger=false @endphp
                @foreach($messages as $msg)
                    @if($msg->seen==false&&$trigger==false&&$msg->sender_id==$receiver->id)
                        <hr class="bg-danger" id="line">
                        @php $trigger=true @endphp

                    @endif
                    @if($msg->sender_id==$sender->id)
                        <div class="list-group-item   mb-2 " style="text-align: right">
                            {{$msg->message}} <strong>: You</strong>
                        </div>
                    @else
                        <div class="list-group-item  mb-2 ">
                            <strong>{{$receiver_name}}:</strong> {{$msg->message}}
                        </div>
                    @endif
                @endforeach

            </div>
            <div id="msg"></div>
            <div class="card-footer">
                <form action="{{route('send.message')}}" method="post" id="messageForm">
                    @csrf
                    <input type="hidden" name="sender_id" value="{{ $sender->id }}">
                    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Type your message" name="message">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#messageForm").submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                dataType: 'json',

                success: function (response) {
                    if (response.success) {
                        $("#messageForm").trigger("reset");
                        $("#message").html(response.message);
                    } else {
                        $("#message").html(response.message);
                    }
                },

                error: function (error) {
                    console.error("Error submitting form:", error);
                    $("#message").html("An error occurred. Please try again later.");
                }
            });
        });
    });
    window.onload = function scroll() {
        var chatWindow = $('.card-body.overflow-auto');
        chatWindow.scrollTop(chatWindow.prop('scrollHeight'));
        var strongTag = document.getElementById('chat-' + {{$receiver->id}});
        strongTag.textContent = 0;

    }
</script>
</body>

</html>
