<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use App\Events\MessageSend;
use App\Models\ChatMessage;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexChatboot(){
        if(Auth::check()){
            return view('analytics.chatboot.chatboot');
        }else{
            return view('analytics.login');
        }
    }
    
}

