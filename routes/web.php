<?php

use Illuminate\Support\Facades\Route;

Route::post('statuses', 'StatusController@store')->name('status.store')->middleware('auth');

Auth::routes();

Route::view('/', 'welcome');
