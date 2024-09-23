<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListenseKeyController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::middleware('auth')->group(function () {
    Route::get('/', [ListenseKeyController::class, 'index'])->name('home');
    Route::post('listense-key', [ListenseKeyController::class, 'store'])->name('listense-key.store');
    Route::get('listense-key/{id}', [ListenseKeyController::class, 'edit'])->name('listense-key.edit');
    Route::put('listense-key/{id}', [ListenseKeyController::class, 'update'])->name('listense-key.update');
    Route::delete('listense-key/{id}', [ListenseKeyController::class, 'destroy'])->name('listense-key.destroy');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate']);
});
