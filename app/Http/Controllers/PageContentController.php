<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Services\ContentServices;
use Illuminate\Http\Request;
use App\Models\ContentSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PageContentController extends Controller
{

    public function storeContent(Request $request, ContentServices $service) {


        /*$request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users']
        ]);*/

        $username = $request->get('username');
        $images = $request->get('imageArray');

        //$imageValidator = new ImageUploadRequest($images);

        /*
                if($usernameValidator->fails()) {
                    return response()->json([
                        'errors' => $usernameValidator->errors()->first()
                    ], 422);
                }


                if($imageValidator->fails()) {
                    return response()->json([
                        'errors' => $imageValidator->errors()->first()
                    ], 422);
                }*/

        $data = $service->saveContent($images, $username);

        return response()->json(['message' => "Profile Content Saved", "data" => $data]);

    }

    public function getContent(ContentServices $service) {

        $content = $service->getContent();

        return response()->json(['data' => $content]);
    }

    public function removeContentImage(Request $request, ContentServices $service) {

        $service->removeImage($request);

    }

    public function getUsername() {

        $username = Auth::user()->username;

        return response()->json(['username' => $username]);

    }

    public function getAllUserNames() {

        $userNames = User::all()->pluck('name')->toArray();

        return response()->json(['data' => $userNames]);
    }
}
