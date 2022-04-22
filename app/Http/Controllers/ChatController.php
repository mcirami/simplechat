<?php

namespace App\Http\Controllers;

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


        $user = User::where('id', 36327401)->first();
        $settings = Setting::where('user_id', 36327401)->pluck('images');
        $images = json_decode($settings[0], true);
        $tracking = ScriptTracking::where('from_id', 36327401)->where('to_id', 79191805)->first();
        $index = $tracking->image_index;

        $imageKey = "";
        if ($index == null) {
            foreach ($images as $index => $path) {
                $key = key($path);
                if ($key == "image_1") {
                    $imageKey = "image_1";
                    $imagePath = str_replace("/storage", "", $images[$index][$key]);
                    break;
                }
            }
        }

        $tracking->update(['image_index' => $imageKey]);

        dd($imagePath);
        $file = Storage::disk('public')->get($imagePath);
        //$path = Storage::url('agent-images/36327401/image_5-1650575969.jpeg');
        //$file = File::isFile($path);
        $attachment = Str::uuid() . ".jpg";
        $image = Image::make($file)->encode('jpg',80);
        Storage::disk('public')->put(config('chatify.attachments.folder') . "/" . $attachment, $image);
        //dd($image);

    }

    public function addUser(Request $request) {

        $username = $request->userName;

        $user = User::where('name', $username)->get()->toArray();

        return response()->json(['user' => $user]);

    }
}
