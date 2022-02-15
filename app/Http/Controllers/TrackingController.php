<?php

namespace App\Http\Controllers;
use App\Models\Tracking;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function store($user, $ip, $referral) {

        Tracking::create([
            'user_id' => $user->id,
            'user_ip' => $ip,
            'referral' => $referral
        ]);
    }
}
