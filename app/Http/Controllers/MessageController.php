<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use Musonza\Chat\Chat;

class MessageController extends Controller
{
    private $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function inbox($thread = null)
    {
        $threads = $this->chat->conversations()
            ->setPaginationParams(['sorting' => 'desc'])
            ->setParticipant(auth()->user())
            ->get();

        $threads = $threads->map(function ($t){
            $user = $t->conversation->participants->where('messageable_id','!=',auth()->id())->first()->messageable;
            return [
                'id' => $t->id,
                'name' => $user->name,
                'email' => $user->email
            ];
        });

        $messages = null;

        if($thread){
            $conv = $this->chat->conversations()->getById($thread);
            $messages = $this->chat->conversation($conv)->setParticipant(auth()->user())->getMessages()->sortBy('created_at');

        }

        return view('admin.inbox',compact('threads','messages','thread'));
    }

    public function createThread(User $user)
    {
        // Change data as your need
        $meta = ['title' => $user->name, 'email' => $user->email];
        $this->chat->createConversation([$user])
            ->makePrivate()
            ->update(['data' => $meta]);

        return redirect()->route('inbox');
    }

    public function submitMessage(Request $request)
    {
        if($request->message){
            // save message
            $thread = $this->chat->conversations()->getById($request->thread_id);
            $this->chat->message($request->get('message'))
               ->from(auth()->user())
               ->to($thread)
                ->send();
        }

        return redirect()->back();

    }
}
