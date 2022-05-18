<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use App\Providers\RouteServiceProvider;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CustomRegisterController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterTwo(Request $request) {

        $addUser = $request->query('add') ? $request->query('add') : null;
        $src = $request->query('src') ? $request->query('src') : null;
        return view('register-custom.register-two')->with(['addUser' => $addUser, 'src' => $src]);
    }

    public function showRegisterThree(Request $request) {

        $images = File::glob(public_path('images/slider-bottom').'/*');
        $imageArray = [];

        foreach ($images as $image) {
            $exploded =  explode('slider-bottom/', $image);
            array_push($imageArray, $exploded[1]);
        }

        $addUser = $request->query('add') ? $request->query('add') : null;
        $src = $request->query('src') ? $request->query('src') : null;
        return view('register-custom.register-three')->with(['addUser' => $addUser, 'src' => $src, 'images' => $imageArray]);
    }

    public function showRegisterFour(Request $request) {

        $addUser = $request->query('add') ? $request->query('add') : null;
        $src = $request->query('src') ? $request->query('src') : null;
        return view('register-custom.register-four')->with(['addUser' => $addUser, 'src' => $src]);
    }

    public function showAgentRegister(Request $request) {

        return view('register-custom.register-agent');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $id = IdGenerator::generate(['table' => 'users', 'length' => 8, 'prefix' => random_int(100000, 999999)]);

        $bytes = random_bytes(4);
        $password = (bin2hex($bytes));

        $name = strstr($request->email, '@', true);

        $user = User::create([
            'id' => $id,
            'name' => $name,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        event(new Registered($user));

        $referral = null;
        if( $request->add_chat_user || $request->src) {
            $ip = $request->ip();
            $referral = $request->add_chat_user ? : "";
            $src = $request->src ? : "";

            (New TrackingController)->store($user, $ip, $referral, $src);
        }

        Auth::login($user);
        $userdata = ([
            'email' =>   $user->email,
            'password' => $password,
        ]);

        $user->notify(new WelcomeNotification($userdata));

        $chatUser = $referral ? "?add_chat_user=" . $referral : "";

        return redirect(RouteServiceProvider::HOME . $chatUser);
    }
}
