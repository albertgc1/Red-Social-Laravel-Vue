<?php

use Illuminate\Support\Facades\Route;

Route::get('statuses', 'StatusController@index')->name('status.index');
Route::post('statuses', 'StatusController@store')->name('status.store')->middleware('auth');

Route::post('statuses/{status}/likes', 'StatusLikeController@store')->name('statuses.likes.store')->middleware('auth');
Route::delete('statuses/{status}/likes', 'StatusLikeController@destroy')->name('statuses.likes.destroy')->middleware('auth');

Route::post('statuses/{status}/comments', 'StatusCommentController@store')->name('statuses.comments.store')->middleware('auth');

Auth::routes();

Route::view('/', 'welcome');
