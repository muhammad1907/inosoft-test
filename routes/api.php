<?php

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

Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('register', 'App\Http\Controllers\AuthController@register');



Route::group(['middleware' => ['jwt.verify']], function () {
    
    Route::get('/kendaraan', 'App\Http\Controllers\KendaraanController@index');
    Route::get('/kendaraan/{id}', 'App\Http\Controllers\KendaraanController@show');
    Route::post('/kendaraan', 'App\Http\Controllers\KendaraanController@store');
    Route::put('/kendaraan/{id}', 'App\Http\Controllers\KendaraanController@update');
    Route::delete('/kendaraan/{id}', 'App\Http\Controllers\KendaraanController@destroy');

    Route::get('/mobil', 'App\Http\Controllers\MobilController@index');
    Route::get('/mobil/{id}', 'App\Http\Controllers\MobilController@show');
    Route::post('/mobil', 'App\Http\Controllers\MobilController@store');
    Route::put('/mobil/{id}', 'App\Http\Controllers\MobilController@update');
    Route::delete('/mobil/{id}', 'App\Http\Controllers\MobilController@destroy');

    Route::get('/motor', 'App\Http\Controllers\MotorController@index');
    Route::get('/motor/{id}', 'App\Http\Controllers\MotorController@show');
    Route::post('/motor', 'App\Http\Controllers\MotorController@store');
    Route::put('/motor/{id}', 'App\Http\Controllers\MotorController@update');
    Route::delete('/motor/{id}', 'App\Http\Controllers\MotorController@destroy');

    Route::get('/penjualan', 'App\Http\Controllers\PenjualanController@index');
    Route::get('/penjualan/{id}', 'App\Http\Controllers\PenjualanController@show');
    Route::post('/penjualan', 'App\Http\Controllers\PenjualanController@store');
});



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
