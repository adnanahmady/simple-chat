<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }
}
