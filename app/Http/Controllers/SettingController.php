<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Image;

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
        $value = json_encode($request->get($column));

        $settingService->saveSetting($column, $value);

        if($column == 'active') {
            //$status = $value == 0 ? "Manual Mode" : "Bot Mode";
            $message = $value == 0 ? "Manual Mode" : "Bot Mode";
        } else {
            $message = $column . " Saved";
        }

        return response()->json(['message' => $message]);

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

    public function storeImage(ImageUploadRequest $request, SettingsService $settingService) {

        $settingService->saveImage($request);

        return response()->json(['message' => 'Image(s) Saved']);
    }

    public function removeImage(Request $request, SettingsService $settingService) {

        $picNumber = $request->get('picNumber');

        $userImages = $settingService->deleteImage($picNumber);

        return response()->json(['images' => $userImages]);
    }
}
