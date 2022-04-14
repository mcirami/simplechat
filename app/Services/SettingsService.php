<?php


namespace App\Services;


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

    public function getSetting( $column ) {

        $setting = $this->user->settings()->first()->pluck($column);

        return json_decode($setting[0]);
    }

    public function saveScript($script) {

        $userSettings = $this->user->settings()->first();

        if($userSettings == null) {
            $this->user->settings()->create([
                'script' => $script
            ]);
        } else {
            $userSettings->update(['script' => $script]);
        }
    }

    public function getScript() {

        $scripts = $this->user->settings()->first()->pluck('script');

        return json_decode($scripts[0]);
    }

    public function saveKeywords($keywords) {

        $userSettings = $this->user->settings()->first();

        if($userSettings == null) {
            $this->user->settings()->create([
                'keywords' => $keywords
            ]);
        } else {
            $userSettings->update(['keywords' => $keywords]);
        }
    }

    public function getKeywords() {

        $keywords = $this->user->settings()->first()->pluck('keywords');

        return json_decode($keywords[0]);
    }

    public function saveLinks($links) {

        $userSettings = $this->user->settings()->first();

        if($userSettings == null) {
            $this->user->settings()->create([
                'links' => $links
            ]);
        } else {
            $userSettings->update(['links' => $links]);
        }
    }
}
