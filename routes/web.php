<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\CriminalPerpetratorController;
use App\Http\Controllers\Web\CriteriaController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'admin-panel'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin-panel.dashboard');

        Route::get('/user/{id}/activity', [UserController::class, 'userActivity'])->name('admin-panel.user.activity');
        Route::resource('user', UserController::class, ['as' => 'admin-panel']);

        Route::resource('criminal', CriminalPerpetratorController::class, ['as' => 'admin-panel']);

        Route::resource('criteria', CriteriaController::class, ['as' => 'admin-panel']);
    });
});

require __DIR__.'/auth.php';
