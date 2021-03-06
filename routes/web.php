<?php

use Illuminate\Support\Facades\Route;

Route::get('statuses', 'StatusController@index')->name('status.index');
Route::post('statuses', 'StatusController@store')->name('status.store')->middleware('auth');

Route::post('statuses/{status}/likes', 'StatusLikeController@store')->name('statuses.likes.store')->middleware('auth');
Route::delete('statuses/{status}/likes', 'StatusLikeController@destroy')->name('statuses.likes.destroy')->middleware('auth');

Route::post('statuses/{status}/comments', 'StatusCommentController@store')->name('statuses.comments.store')->middleware('auth');

Route::post('comments/{comment}/likes', 'CommentLikeController@store')->name('comments.likes.store')->middleware('auth');
Route::delete('comments/{comment}/likes', 'CommentLikeController@destroy')->name('comments.likes.destroy')->middleware('auth');

Route::get('@{user}', 'UsersController@show')->name('users.show');

Route::get('users/{user}/statuses', 'UserStatusController@index')->name('users.statuses.index');

Route::get('friendships', 'FriendshipController@index')->name('friendships.index')->middleware('auth');
Route::post('friendships/{recipient}', 'FriendshipController@store')->name('friendships.store')->middleware('auth');
Route::put('friendships/{sender}/{denied?}', 'FriendshipController@update')->name('friendships.update')->middleware('auth');
Route::delete('friendships/{recipient}', 'FriendshipController@destroy')->name('friendships.destroy')->middleware('auth');

Auth::routes();

Route::view('/', 'welcome');
