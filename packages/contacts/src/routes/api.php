<?php

use Illuminate\Support\Facades\Route;


use \drafeef\contacts\Http\Controllers\ContactUsController;

Route::controller(ContactUsController::class)->group(function (){

	Route::GET('/index' , 'index')->name('index')->middleware('auth:api');
	Route::POST('/store' , 'store')->name('store')->middleware('auth:api');
	Route::GET('/view' , 'show')->name('show')->middleware('auth:api');
	Route::PUT('/update' , 'update')->name('update')->middleware('auth:api');
	Route::DELETE('/destroy' , 'destroy')->name('destroy')->middleware('auth:api');
});










