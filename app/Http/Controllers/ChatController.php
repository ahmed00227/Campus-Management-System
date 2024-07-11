<?php

namespace App\Http\Controllers;

use App\Events\Chats;
use App\Events\NotifyUser;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Version\Exception;

class ChatController extends Controller
{
    public function chat_page()
    {
        $user = Auth::user();
        $receivers = Chat::orderBy('sent_at', 'desc')->where('sender_id', $user->id)->distinct('receiver_id')->select('receiver_id')->get();
        $senders = Chat::orderBy('sent_at', 'desc')->where('receiver_id', $user->id)->distinct('sender_id')->select('sender_id')->get();

        $uniqueIds = [];
        $chatname = [];
        $unchatname = [];
        foreach ($receivers as $receiver) {
            $uniqueIds[] = $receiver['receiver_id'];

        }
        foreach ($senders as $sender) {
            if (!in_array($sender['sender_id'], $uniqueIds)) {
                $uniqueIds[] = $sender['sender_id'];
            }
        }

        $unseenCount = [];
        foreach ($uniqueIds as $uniqueId) {
            $person = User::find($uniqueId);
            if ($person->roles == 1) {
                $chatname[] = 'Admin ' . $uniqueId;
            } elseif ($person->roles == 2) {
                $chatname[] = $person->teacher->teacher_name;

            } elseif ($person->roles == 3) {
                $chatname[] = $person->student->name;

            }
            $unseen = Chat::where('seen', false)->where('sender_id', $uniqueId)->where('receiver_id', Auth::id())->pluck('id');
            $unseenCount[] = count($unseen);
        }
        $nonContactedUsers = [];
        $users = User::pluck('id');
        foreach ($users as $user) {
            if (!in_array($user, $uniqueIds)) {
                $person = User::find($user);
                if ($person->roles == 1) {
                    $unchatname[] = 'Admin ' . $user;
                } elseif ($person->roles == 2) {
                    $unchatname[] = $person->teacher->teacher_name;

                } elseif ($person->roles == 3) {
                    $unchatname[] = $person->student->name;

                }
                $nonContactedUsers[] = $user;
            }
        }
        $user = Auth::user();

        return view('chat_page', ['user' => $user, 'uniqueIds' => $uniqueIds, 'nonContactedUsers' => $nonContactedUsers, 'unseen' => $unseenCount,'chatname'=>$chatname,'unchatname'=>$unchatname]);
    }

    public function chat_user($id)
    {
        $user = Auth::user();

        $receivers = Chat::select('receiver_id')->where('sender_id', $user->id)->distinct('receiver_id')->orderBy('sent_at', 'desc')->get();
        $senders = Chat::select('sender_id')->where('receiver_id', $user->id)->distinct('sender_id')->orderBy('sent_at', 'desc')->get();
        $uniqueIds = [];
        $chatname = [];
        $unchatname = [];
        foreach ($senders as $sender) {
            $uniqueIds[] = $sender['sender_id'];
        }
        foreach ($receivers as $receiver) {
            if (!in_array($receiver['receiver_id'], $uniqueIds)) {
                $uniqueIds[] = $receiver['receiver_id'];
            }

        }
        foreach ($uniqueIds as $uniqueId) {
            $person = User::find($uniqueId);
            if ($person->roles == 1) {
                $chatname[] = 'Admin ' . $uniqueId;
            } elseif ($person->roles == 2) {
                $chatname[] = $person->teacher->teacher_name;

            } elseif ($person->roles == 3) {
                $chatname[] = $person->student->name;

            }
        }
        $nonContactedUsers = [];
        $users = User::pluck('id');
        foreach ($users as $user) {
            if (!in_array($user, $uniqueIds)) {
                $person = User::find($user);
                if ($person->roles == 1) {
                    $unchatname[] = 'Admin ' . $user;
                } elseif ($person->roles == 2) {
                    $unchatname[] = $person->teacher->teacher_name;

                } elseif ($person->roles == 3) {
                    $unchatname[] = $person->student->name;

                }
                $nonContactedUsers[] = $user;
            }
        }
        $unseenCount = [];
        foreach ($uniqueIds as $uniqueId) {
            $unseen = Chat::where('seen', false)->where('sender_id', $uniqueId)->where('receiver_id', Auth::id())->pluck('id');
            $unseenCount[] = count($unseen);
        }
        $sender = Auth::user();
        $receiver = User::findorfail($id);
        if($receiver->roles==1)
        {
            $receiver_name='Admin '.$id;
        }
        elseif($receiver->roles==2)
        {
            $receiver_name=$receiver->teacher->teacher_name;
        }
        else{
            $receiver_name=$receiver->student->name;

        }
        $messages1 = Chat::where('receiver_id', $sender->id)->where('sender_id', $receiver->id)->get();
        $messages2 = Chat::where('receiver_id', $receiver->id)->where('sender_id', $sender->id)->get();
        $messages = $messages1->merge($messages2)->sortBy('sent_at');
        Chat::where('seen', false)->where('sender_id', $id)->where('receiver_id', Auth::id())->update(['seen' => true]);


        return view('chat_user', ['sender' => $sender, 'receiver' => $receiver, 'messages' => $messages, 'ids' => $uniqueIds, 'nonContactedUsers' => $nonContactedUsers, 'unseen' => $unseenCount,'chatname'=>$chatname,'unchatname'=>$unchatname,'receiver_name'=>$receiver_name]);

    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $senderId = $request->input('sender_id');
        $receiverId = $request->input('receiver_id');
        event(new NotifyUser($message, 'notify-channel', $receiverId . 'user' . Auth::id()));
        event(new NotifyUser(Auth::id(), 'notify-channel', 'chat-' . $receiverId));
        $chat = new Chat;
        $chat->message = $message;
        $chat->sender_id = $senderId;
        $chat->receiver_id = $receiverId;
        if ($receiverId == $senderId) {
            $chat->seen = true;
        }
        $chat->sent_at = now();
        $chat->save();
        return response()->json(['success' => true, 'message' => 'Form submitted successfully!']);
    }

    public function message_read($id)
    {
        Chat::where('seen', false)->where('sender_id', $id)->where('receiver_id', Auth::id())->update(['seen' => true]);
        return response()->json(['success' => true, 'message' => 'Form submitted successfully!']);
    }
}
