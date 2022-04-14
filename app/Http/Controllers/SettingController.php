<?php

namespace App\Http\Controllers;

use App\Services\SettingsService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
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

        $setting = $settingService->getSetting($column);

        return response()->json([$column => $setting]);
    }

}
