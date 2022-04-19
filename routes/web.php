<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('register-two', [CustomRegisterController::class, 'showRegisterTwo']);
Route::get('register-three', [CustomRegisterController::class, 'showRegisterThree']);
Route::get('register-agent', [CustomRegisterController::class, 'showAgentRegister']);
Route::post('custom-email-register', [CustomRegisterController::class, 'store'])->name('custom-email-register');
Route::get('email', [MailController::class, 'email']);

Route::group(['middleware' => 'auth'], function() {

    Route::get('testing', [ChatController::class, 'testing']);
    Route::post('add-user/', [ChatController::class, 'addUser']);

    Route::post('chat/get-agents', [UserController::class, 'getAgentUsers']);

    Route::get('settings', [SettingController::class, 'showEditSettings']);
    Route::post('store-setting', [SettingController::class, 'storeSetting']);
    Route::post('get-setting', [SettingController::class, 'getSetting']);

    Route::post('script-tracking', [SettingController::class, 'getTracking']);

});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'chat'], function() {
    Route::get('{slug}', [ChatController::class, 'showChat']);
});*/

require __DIR__.'/auth.php';
