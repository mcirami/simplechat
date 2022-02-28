<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TrackingController;
use App\Models\User;
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

        $addUser = $request->query('add') ? $request->query('add') : "";
        $src = $request->query('src') ? $request->query('src') : "";
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $id = IdGenerator::generate(['table' => 'users', 'length' => 8, 'prefix' => random_int(100000, 999999)]);

        $user = User::create([
            'id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $referral = null;
        if( $request->add_chat_user && $request->src) {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipOriginal = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (strpos($ipOriginal, ',') !== false) {
                    $ip = substr($ipOriginal, 0, strpos($ipOriginal, ","));
                } else {
                    $ip = $ipOriginal;
                }
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            /*$ip = $request->ip();*/
            $referral = $request->add_chat_user;
            $src = $request->src;

            (New TrackingController)->store($user, $ip, $referral, $src);
        }

        Auth::login($user);
        $chatUser = $referral ? "?add_chat_user=" . $referral : "";

        return redirect(RouteServiceProvider::HOME . $chatUser);
    }
}
