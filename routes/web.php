<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::group(['middleware' => 'auth'],function(){
    route::resource('photos',PhotoController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
