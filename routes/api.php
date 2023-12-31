<?php

use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\GuildController;
use App\Http\Controllers\API\ServerController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/users', UserController::class);
Route::apiResource('/servers', ServerController::class);
Route::apiResource('/guilds', GuildController::class);
Route::apiResource('/wars', WarController::class);
Route::apiResource('/accounts', AccountController::class)->except(['index']);

Route::fallback(function(){
    return response()->json(['message' => 'Endpoint não encontrado.'], 404);
});
