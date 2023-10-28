<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;

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

Route::middleware('verified')->group(function () {
    Route::get('/', [UserController::class, 'stamp']);
});
Route::post('/wstart', [AttendanceController::class, 'wstart']);
Route::post('/wend', [AttendanceController::class, 'wend']);
Route::post('/bstart', [AttendanceController::class, 'bstart']);
Route::post('/bend', [AttendanceController::class, 'bend']);
Route::get('/date', [AttendanceController::class, 'date'])->name('date');
Route::get('/menber', [AttendanceController::class, 'menber']);
Route::post('/list', [AttendanceController::class, 'list']);
Auth::routes(['verify' => true]);
