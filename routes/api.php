<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\dummyController;
use App\http\Controllers\ResponceController;
use App\http\Controllers\SuccessController;
use App\http\Controllers\LoginController;

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

Route::post('list', [dummyController::class, 'list']); //Route - controller - function name
Route::post('listData', [dummyController::class, 'listData']);
Route::post('data/{prn}', [ResponceController::class, 'getData']);
Route::post('successdata/{prn}', [SuccessController::class, 'successdata']);
// Route::post('login-user', [LoginController::class, 'loginUser'])->name('login-user');
Route::post('SSOResponse', [LoginController::class, 'SSOResponse']);
// API for department matadata
Route::get('Dept-Meta-Data', [dummyController::class, 'mataData']);
Route::get('scheme-data', [dummyController::class, 'SchemeData']);
Route::get('dept-data', [dummyController::class, 'DeptData']);
