<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use App\Providers\RouteServiceProvider;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomRegisterController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request) {

        $modelArray = [
            'alwazeBbad,',
            'bangnteacher',
            'brainsnboobs',
            'cosplaymate',
            'rawrach21',
            'foxxamilie23',
            'itssophia',
            'krystalmadisson',
            'mariahnichols28',
            'nianxandruh',
            'valentinawinter28',
        ];

        $index = rand(0, count($modelArray) - 1);
        $addUser = $modelArray[$index];

        $src = $request->query('src') ? $request->query('src') : null;
        return view('register-custom.register-chat')->with(['addUser' => $addUser, 'src' => $src]);
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
