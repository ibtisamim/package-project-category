<?php

use Illuminate\Support\Facades\Route;

use drafeef\base\Http\Controllers\IndexController;

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

Route::controller(IndexController::class)->group(function (){

    Route::post('/upload_photo' , 'uploadPhoto')->name('index');

});


