<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function getAgentUsers() {

        $agents = User::where('role', 'agent')->get()->toArray();

        return Response::json(['agents' => $agents]);

    }
}
