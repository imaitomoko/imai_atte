<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;

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



Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/attendance/start', [AttendanceController::class, 'attendanceStart']);
    Route::post('attendance/end', [AttendanceController::class, 'attendanceEnd']);
    Route::post('/rest/start', [RestController::class, 'restStart']);
    Route::post('/rest/end', [RestController::class, 'restEnd']);
    Route::get('/attendance', [AttendanceController::class, 'result']);
    Route::get('/attendance/before',[AttendanceController::class, 'getBefore']);
    Route::get('/attendance/after', [AttendanceController::class, 'getAfter']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/user/userpage', [AttendanceController::class, 'userPage']);
});

