<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TrackingController;
use App\Models\ContentSetting;
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

        $addUser = $request->query('add') ? $request->query('add') : null;
        $src = $request->query('src') ? $request->query('src') : null;

        $content = null;
        if ($addUser != null) {

            $userID = User::where('username', $addUser)->pluck('id')->first();
            if ($userID != null) {
                $content = ContentSetting::where('user_id', $userID)->first();
            }
        }


        return view('auth.register')->with([
            'addUser' => $addUser,
            'src' => $src,
            'background' => $content !== null ? $content->background : null,
        ]);
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

        $role = $request->role ?: "member";

        $user = User::create([
            'id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role
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
        $chatUser = $referral ? "?add_chat_user=" . $referral : "";

        return redirect(RouteServiceProvider::HOME . $chatUser);
    }
}
