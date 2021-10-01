<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\LeaveController;

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

Route::post('/get-otp', [AuthController::class, 'getOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group( function () {
    //Route::post('blogs', '[BlogController::class, 'store']');

    // Route::post('apply', 'App\Http\Controllers\Api\LeaveController@apply')->name('apply');
    Route::post('leaves', 'App\Http\Controllers\Api\LeaveController@leaves')->name('leaves');
    Route::post('apply-leave', 'App\Http\Controllers\Api\LeaveController@apply')->name('apply-leave');
    Route::post('leave-history', 'App\Http\Controllers\Api\LeaveController@leaveHistory')->name('leave-history');
    
    Route::post('jobs', 'App\Http\Controllers\Api\JobController@getJobs')->name('jobs');

    //Route::post('/leaves',LeaveController::class, 'leaves')->name('leaves');
    //Route::resource('', LeaveController::class);
});
