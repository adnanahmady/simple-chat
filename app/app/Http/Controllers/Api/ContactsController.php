<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = User::where('id', '!=', auth()->id())->get();
        $unreadCounts = Message::select(
            \DB::raw('"from" as sender_id, count("from") as messages_count')
        )
            ->where('to', auth()->id())
            ->where('did_read', false)
            ->groupBy('from')
            ->get();

        $contacts = $contacts->map(function ($contact) use ($unreadCounts) {
            $unreads = $unreadCounts->where('sender_id', $contact->id)->first();
            $contact->unread_count = $unreads ? $unreads->messages_count : 0;

            return $contact;
        });

        return response()->json($contacts, 200);
    }
}
