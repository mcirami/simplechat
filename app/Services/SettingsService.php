<?php


namespace App\Services;


use App\Models\ScriptTracking;
use App\Models\Setting;
use App\Models\User;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SettingsService {

    private $user;

    /**
     * @param $user
     */
    public function __construct() {
        $this->user = Auth::user();

        return $this->user;
    }

    public function saveSetting($column, $value) {

        $userSettings = $this->user->settings()->first();

        if($userSettings == null) {
            $this->user->settings()->create([
                $column => $value
            ]);
        } else {
            $userSettings->update([$column => $value]);
        }
    }

    public function getSetting( $column, $userID ) {

        $setting = null;
        if ($userID != null) {
            if (Setting::where('user_id', $userID )->exists()) {
               $user = User::where('id', $userID)->first();
               $setting = $user->settings()->pluck($column);
              // $setting = Setting::where('user_id', $userID)->pluck('script');
            }
        } else {

            $userID = $this->user->getAuthIdentifier();
            if (Setting::where('user_id',  $userID )->exists()) {
                //$setting = $this->user->settings()->pluck($column);
                $setting = Setting::where('user_id', $userID)->pluck($column);
            }
        }

        if ($setting != null) {
            return json_decode($setting[0]);
        }

       return $setting;
    }

    public function getScriptIndex ($toID, $fromID) {

        $tracking = ScriptTracking::where('to_id', $toID)->where('from_id', $fromID)->first();

        if ($tracking == null) {
            ScriptTracking::create([
                'to_id' => $toID,
                'from_id' => $fromID,
                'script_index' => 0
            ]);
            $newIndex = 0;
        } else {

            $script = $this->getSetting('script', $fromID);

            $newIndex = $tracking->script_index + 1;

            if ($newIndex > count($script) - 1) {
                $newIndex = 999;
            }

            $tracking->update([
                'script_index' => $newIndex
            ]);
        }

        return $newIndex;
    }

    public function saveImage($request) {

        $imageObjects = $request->get('files');
        $picNameObjects = [];

        foreach($imageObjects as $key => $image) {

            $name = $key . '-' . time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

            $imageFile = Image::make($image)->orientate();
            //$thumbnailPath = storage_path() . '/public/agent-images/' . $request->user()->id . '/thumbnail/';

            //$originalPath = storage_path() . '/app/public/agent-images/' . $request->user()->id . '/';
            //$imageFile->save($originalPath . $name);
            //$imageFile->orientate();

            /*$diff = $imageFile->width() - $imageFile->height();
            if ($imageFile->width() > $imageFile->height() && $diff > 300) {
                $imageFile->rotate(270);
            }*/
            //$imageFile->save($originalPath . $name);

            Storage::put('/public/agent-images/' . $request->user()->id . "/" . $name, $imageFile);

            $path = '/storage/agent-images/' . $request->user()->id . '/' . $name;

            $newObject = [
                $key => $path
            ];

            array_push($picNameObjects, $newObject);
        }

        $userSettings = $this->user->settings()->first();

        if($userSettings == null) {
            $this->user->settings()->create([
                'images '=> json_encode($picNameObjects)
            ]);
        } else {
            $currentImages = json_decode($userSettings->images);

            if ($currentImages) {

                foreach ($picNameObjects as $path) {
                    $found = false;

                    foreach ($currentImages as $innerIndex => $innerName) {

                        $key = key($innerName);

                        if ($key === key($path)) {
                            $oldImage = $currentImages[$innerIndex]->$key;
                            $oldPath = explode("/storage", $oldImage);
                            Storage::disk('public')->delete($oldPath[1]);

                            $currentImages[$innerIndex] = $path;

                            $found = true;
                        }
                    }

                    if ($found == false) {
                        array_push($currentImages, $path);
                    }
                }

                $userSettings->update(['images' => json_encode($currentImages)]);
            } else {
                $userSettings->update(['images' => json_encode($picNameObjects)]);
            }
        }
    }

    public function deleteImage($picNumber) {

        $userSettings = $this->user->settings()->first();
        $userImages = json_decode($userSettings->images);

        $imageKey = "image_" . $picNumber;

        foreach($userImages as $index => $image) {
            $key = key($image);

            if ($key == $imageKey) {
                $path = explode("/storage", $userImages[$index]->$key);
                Storage::disk('public')->delete($path[1]);
                unset($userImages[$index]);
                break;
            }
        }

        $updatedImages = count($userImages) > 0 ? json_encode(array_values($userImages)) : null;
        $userSettings->update(['images'=> $updatedImages]);

        return $userImages;

    }
}
