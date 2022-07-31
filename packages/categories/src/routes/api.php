<?php

use Illuminate\Support\Facades\Route;


use \drafeef\categories\Http\Controllers\CategoryController;
use \drafeef\categories\Http\Controllers\LevelController;
use \drafeef\categories\Http\Controllers\ArticleController;
use \drafeef\categories\Http\Controllers\SectionController;

Route::controller(CategoryController::class)->group(function (){

	Route::POST('/index' , 'index')->name('index');
	Route::POST('/store' , 'store')->name('store')->middleware('auth:api');
	Route::GET('/view' , 'show')->name('show');
	Route::PUT('/update' , 'update')->name('update')->middleware('auth:api');
	Route::DELETE('/destroy' , 'destroy')->name('destroy')->middleware('auth:api');
});

Route::controller(LevelController::class)->prefix('levels')->name('levels')->group(function (){

	Route::GET('/index' , 'index')->name('index');
	Route::POST('/store' , 'store')->name('store')->middleware('auth:api');
	Route::GET('/view' , 'show')->name('show');
	Route::PUT('/update' , 'update')->name('update')->middleware('auth:api');
	Route::DELETE('/destroy' , 'destroy')->name('destroy')->middleware('auth:api');
});

Route::controller(ArticleController::class)->prefix('articles')->name('articles')->group(function (){

	Route::GET('/index' , 'index')->name('index');
	Route::POST('/store' , 'store')->name('store')->middleware('auth:api');
	Route::GET('/view' , 'show')->name('show');
	Route::PUT('/update' , 'update')->name('update')->middleware('auth:api');
	Route::DELETE('/destroy' , 'destroy')->name('destroy')->middleware('auth:api');
});


Route::controller(SectionController::class)->prefix('sections')->name('sections')->group(function (){

	Route::GET('/index' , 'index')->name('index');
	Route::POST('/store' , 'store')->name('store')->middleware('auth:api');
	Route::GET('/view' , 'show')->name('show');
	Route::PUT('/update' , 'update')->name('update')->middleware('auth:api');
	Route::DELETE('/destroy' , 'destroy')->name('destroy')->middleware('auth:api');
});









