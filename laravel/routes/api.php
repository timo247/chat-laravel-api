<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MessagesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('ensureCookieAuth')->group(function(){
    Route::get('messages', [MessagesController::class, 'showMessages']);
    Route::get('messages/add', [MessagesController::class, 'addMessage']);
});

Route::get('check-connection', [UsersController::class, 'checkUserConnectionState']);
Route::get('online-users', [UsersController::class, 'getOnlineUsers']);
Route::get('login', [UsersController::class, 'connectUser']);
Route::get('logout', [UsersController::class, 'disconnectUser']);
Route::get('/doc', function(){
    return view('documentation_view');
});





