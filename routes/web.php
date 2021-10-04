<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('visitor', [AdminController::class, 'getVisitor'])->name('visitor');

    Route::get('visitor/{visitor}', [AdminController::class, 'showVisitor'])->name('visitor-detail');

    Route::delete('visitor/{visitor}', [AdminController::class, 'deleteVisitor'])->name('visitor-delete');

    Route::get('spices', [AdminController::class, 'getSpices'])->name('spices');

    Route::get('spices/{spice}', [AdminController::class, 'showSpice'])->name('spice-detail');

    Route::delete('spices/{spice}', [AdminController::class, 'deleteSpice'])->name('spice-delete');

    Route::get('province/{province}', [AdminController::class, 'showProvince'])->name('province-detail');

});

require __DIR__.'/auth.php';
