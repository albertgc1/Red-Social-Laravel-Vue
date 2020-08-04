<?php

use Illuminate\Support\Facades\Route;

Route::get('statuses', 'StatusController@index')->name('status.index');
Route::post('statuses', 'StatusController@store')->name('status.store')->middleware('auth');

Route::post('statuses/{status}/likes', 'StatusLikeController@store')->name('statuses.likes.store')->middleware('auth');

Auth::routes();

Route::view('/', 'welcome');
