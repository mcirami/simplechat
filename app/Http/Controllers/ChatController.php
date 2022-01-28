<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Message;
use App\Models\Page;

class ChatController extends Controller
{

    public function  show() {
        return view('chat');
    }

    public function message(Request $request) {

        event(new Message($request->input('username'), $request->input('message')));

        return [];
    }

    public function showPrivateChat($slug) {


        //$page = Page::where('route', $slug)->first();

        return view('chat');
    }
}
