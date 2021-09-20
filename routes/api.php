<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SpiceController;
use App\Http\Controllers\SpicePhotoController;
use App\Http\Controllers\VisitorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get("/landing", [LandingController::class, 'index']);

Route::resource('/visitor', VisitorController::class)->only(['index', 'create']);

Route::middleware('auth.api')->group(function () {

    Route::resource('/visitor', VisitorController::class)->except(['index', 'create']);

    Route::resource('/spice', SpiceController::class);

    Route::resource('/spice/photo', SpicePhotoController::class);

    Route::resource('/spice/{spice}/like', LikeController::class);

    Route::resource('/spice/{spice}/comment', CommentController::class);
});
