<?php

namespace App\Http\Controllers;

use App\Models\ContentSetting;
use App\Models\ScriptTracking;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\Message;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Pusher\Pusher;


class ChatController extends Controller
{

    /*private $pusher;

    public function __construct() {
        $config = Config::get('broadcasting.connections.pusher');

        $options = [
            'cluster' => $config['options']['cluster'],
            'encrypted' => true
        ];

        $this->pusher = new Pusher(
            $config['key'],
            $config['secret'],
            $config['app_id'],
            $options
        );
    }



    public function sendMessage(Request $request) {

        $prevURL = $request->session()->get('_previous');
        $requestURL = explode("/", $prevURL['url']);

        //event(new Message($request->input('username'), $request->input('message')));

        $data = $request->json()->all();

        $this->pusher->trigger('chat-' . $requestURL[3], 'send-message', $data);

        return ["Success!"];
    }

    public function showPrivateChat($slug) {


        $page = Page::where('route', $slug)->first();

        return view('chat');
    }*/

    public function testing() {

        //$user = Auth::user();
        $user = User::where('id', 93131205)->first();
       /* $userSettings =  Auth::user()->settings()->first();
        $user = User::where('id', Auth::user()->getAuthIdentifier())->first();*/
        $setting = $user->settings()->pluck('images');
        if (is_array(json_decode($setting[0], true))) {
            dd(json_decode($setting[0]));
        } else {
            dd("not");
        }



    }

    public function addUser(Request $request) {

        $username = $request->userName;

        $user = User::where('name', $username)->get()->toArray();

        return response()->json(['user' => $user]);

    }
}
