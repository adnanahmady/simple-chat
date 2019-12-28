<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($userId)
    {
        Message::where(['from' => $userId, 'to' => auth()->id()])->update(['did_read' => true]);
        $messages = Message::
        whereIn('from', [auth()->id(), $userId])
            ->whereIn('to', [auth()->id(), $userId])
            ->get();

        return response()->json($messages, 200);
    }

    public function store()
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to' => request('content_id'),
            'text' => request('text')
        ]);
        broadcast(new NewMessage($message));

        return response()->json($message, 201);
    }
}
