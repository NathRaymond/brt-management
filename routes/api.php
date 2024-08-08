<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::middleware('auth:api')->group(function () {
    Route::post('brts', 'BRTController@store');
    Route::get('brts', 'BRTController@index');
    Route::get('brts/{id}', 'BRTController@show');
    Route::put('brts/{id}', 'BRTController@update');
    Route::delete('brts/{id}', 'BRTController@destroy');
});