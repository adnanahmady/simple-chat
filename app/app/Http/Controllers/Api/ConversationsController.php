<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Massege;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($userId)
    {
        $send = Massege::
            where('from', auth()->id())
            ->where('to', $userId)
            ->get()->toArray();
        $receive = Massege::
            where('from', $userId)
            ->where('to', auth()->id())
            ->get()->toArray();
        $messages = $send + $receive;

        return response()->json($messages, 200);
    }

    public function store()
    {
        $message = Massege::create([
            'from' => auth()->id(),
            'to' => request('content_id'),
            'text' => request('text')
        ]);

        return response()->json($message, 201);
    }
}
