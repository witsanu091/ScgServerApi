<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;


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

Route::apiResource('/users', UserController::class);

// Route::get('/user', [UserController::class, 'show'])->name("api::get.user");

// Route::post('/saveUser', [UserController::class, 'store'])->name("api::post.users");

// Route::put('/updateUser', [UserController::class, 'update'])->name("api::put.users");
