<?php

namespace App\Http\Controllers;
use App\Models\Tracking;

use Illuminate\Http\Request;

class TrackingController extends Controller
{

    /**
     * @param $user
     * @param $ip
     * @param $referral
     * @param $src
     */
    public function store($user, $ip, $referral, $src) {

        Tracking::create([
            'user_id' => $user->id,
            'user_ip' => $ip,
            'referral' => $referral,
            'src' => $src
        ]);
    }
}
