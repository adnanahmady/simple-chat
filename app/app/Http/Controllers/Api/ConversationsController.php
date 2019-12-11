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
        $messages = Massege::where('from', $userId)->orWhere('to', $userId)->get();

        return response()->json($messages, 200);
    }
}
