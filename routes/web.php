<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\MailController;

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
Route::get('register-two', [CustomRegisterController::class, 'show']);
Route::post('register-two-store', [CustomRegisterController::class, 'store'])->name('register-two-store');
Route::get('email', [MailController::class, 'email']);

Route::group(['middleware' => 'auth'], function() {

    Route::get('testing', [ChatController::class, 'testing']);
    Route::post('add-user/', [ChatController::class, 'addUser']);

});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'chat'], function() {
    Route::get('{slug}', [ChatController::class, 'showChat']);
});*/

require __DIR__.'/auth.php';
