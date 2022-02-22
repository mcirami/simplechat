<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TrackingController;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {

        $modelArray = [
            'KerryBella',
            'allparty99',
            'alwazeBbad,',
            'bangnteacher',
            'bbblondie',
            'blndzrule',
            'brainsnboobs',
            'cosplaymate',
            'creamydream',
            'curvalicious',
            'darkdiva',
            'deepthroatr',
            'dwnNdirty',
            'funbags27',
            'kutelilkate',
            'SensualLust',
            'liv2694u',
            'liv2prty',
            'morethanfun21',
            'nkd4u5',
            'plsnyou12',
            'pronhoe0',
            'proprrfkrr',
            'qtcrmpie',
            'rawrach21',
            'retroluv9',
            'ruffstuff14',
            'smileznbooty',
            'sportytits',
            'sxxxy2nite10',
            'tastynwet',
            'touchof22',
        ];

        $index = rand(0, count($modelArray) - 1);
        $addUser = $modelArray[$index];

        $src = $request->query('src') ? $request->query('src') : "";
        $type = $request->query('type') ? $request->query('type') : null;
        return view('auth.register')->with(['addUser' => $addUser, 'src' => $src]);
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
            //'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
        if( $request->add_chat_user && $request->src) {
            $ip = $request->ip();
            $referral = $request->add_chat_user;
            $src = $request->src;

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
