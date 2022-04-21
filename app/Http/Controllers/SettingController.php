<?php

namespace App\Http\Controllers;

use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showEditSettings() {

        return view('user.settings');
    }

    public function storeSetting(Request $request, SettingsService $settingService) {

        $column = $request->get('column');

        $settingService->saveSetting($column, json_encode($request->get($column)));

        return response()->json(['message' => $column . " Saved"]);

    }

    public function getSetting(Request $request, SettingsService $settingService) {

        $column = $request->get('column');
        $userID = $request->get('userID') ?: null;

        $setting = $settingService->getSetting($column, $userID);

        return response()->json([$column => $setting]);
    }

    public function getTracking(Request $request, SettingsService $settingService) {

        $toID = $request->get('to_id');
        $fromID = $request->get('from_id');

        $index = $settingService->getScriptIndex($toID, $fromID);

        return response()->json(['index' => $index]);
    }

    public function storeImage(Request $request, SettingsService $settingService) {

         $settingService->saveImage($request);

        return response()->json(['message' => 'Image(s) Saved']);
    }
}
