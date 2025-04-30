<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureAuthenticated;



Route::middleware([EnsureAuthenticated::class])->group(function () {

    Route::get('/', [VehicleController::class, 'index']);
    Route::get('/dashboard/{data}', [VehicleController::class, 'index']);
    Route::post('/vehicle/submit', [VehicleController::class, 'create']);


    Route::get('/about', function () {
        $user = Auth::user()->toArray();
        return inertia('About', compact('user'));
    });
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login/submit', [LoginController::class, 'login']);



Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
});