<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
//use Intervention\Image\Image;
//use Intervention\Image\Imagick;
use Imagick;

class ContentServices {

    public function saveContent($images, $username) {

        $user = Auth::user();
        $contentSettings = $user->contentSettings()->first();

        if ($username != null && $username != 'undefined') {

            $user->update([
                'username' => $username,
                'name'     => $username
            ]);
        }

        $array = [];

        if (!empty($images)) {
            foreach ( $images as $key => $image ) {

                $name      = $key . '-' . time() . '.' . explode( '/',
                        explode( ':', substr( $image, 0, strpos( $image, ';' ) ) )[1] )[1];
                $imageFile = Image::make( $image )->orientate();

                //array_push($array, $image);

                Storage::put( '/public/content-images/' . $user->id . "/" . $name, $imageFile );

                $path = '/storage/content-images/' . $user->id . '/' . $name;

                /*if($imageFile->mime() == "image/gif") {
                    $gifImage = new Imagick($image);
                    $gifFile = $gifImage->coalesceImages();
                    do {
                        $gifFile->resizeImage(120, 120, Imagick::FILTER_BOX, 1);
                    } while ($gifFile->nextImage());
                    $gifFile = $gifFile->deconstructImages();
                    $gifFile->writeImages('new_120x120.gif', true);

                    Storage::put( '/public/content-images/' . $user->id . "/" . $name, $gifFile );
                }*/

                if ($contentSettings == null) {
                    $contentSettings = $user->contentSettings()->create([
                        $key => $path
                    ]);
                } else {

                    if ($contentSettings->$key != null) {
                        $deleteImagePath = $contentSettings->$key;
                        $oldPath = explode("/storage", $deleteImagePath);
                        Storage::disk('public')->delete($oldPath[1]);
                    }

                    $contentSettings->update([
                        $key => $path
                    ]);
                }
            }
        }

        return $array;
    }

    public function getContent() {

        $user = Auth::user();

        $content = $user->contentSettings()->first();

        if ($content != null) {
            return $content->toArray();
        }

        return null;

    }

    public function removeImage($request) {

        $user = Auth::user();
        $content = $user->contentSettings()->first();
        $column = $request->get('type');

        $imagePath = $content->$column;
        $path = explode("/storage", $imagePath);

        Storage::disk('public')->delete($path[1]);

        $content->update([
            $column => null
        ]);

    }
}
