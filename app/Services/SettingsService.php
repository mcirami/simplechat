<?php


namespace App\Services;


use App\Models\ScriptTracking;
use App\Models\Setting;
use App\Models\User;
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
                $setting = $user->settings->first()->pluck($column);
            }
        } else {

            if (Setting::where('user_id', $this->user->id )->exists()) {
                $setting = $this->user->settings()->first()->pluck($column);
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
            $imageFile = Image::make($image)->encode('jpg',80);

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
                        if (key($innerName) === key($path)) {
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
}
