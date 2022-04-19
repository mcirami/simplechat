<?php


namespace App\Services;


use App\Models\ScriptTracking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        if ($userID != null) {
            $user = User::where('id', $userID)->first();
            $setting = $user->settings()->first()->pluck($column);
        } else {
            $setting = $this->user->settings()->first()->pluck($column);
        }

        return json_decode($setting[0]);
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
}
