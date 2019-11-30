<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Group as Group;
use App\User as User;
use App\Message as Message;
use App\Invite as Invite;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $messages = Auth::user()->receivedmessages()->get();
        dd($messages);
    }

}
