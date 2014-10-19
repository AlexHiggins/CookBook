<?php

Route::get('/', ['as' => 'home', 'uses' => 'CookBook\Controllers\HomeController@index']);

Route::get('login', ['as' => 'login', 'uses' => 'CookBook\Controllers\Auth\SessionsController@index']);
Route::post('login', ['as' => 'login', 'uses' => 'CookBook\Controllers\Auth\SessionsController@store']);
Route::get('logout', ['as' => 'logout', 'uses' => 'CookBook\Controllers\Auth\SessionsController@destroy']);

Route::get('register', ['as' => 'register', 'uses' => 'CookBook\Controllers\Auth\RegisterController@index']);
Route::post('register', ['as' => 'register', 'uses' => 'CookBook\Controllers\Auth\RegisterController@store']);

Route::resource('recipe', 'CookBook\Controllers\RecipeController', ['except' => ['index', 'destroy']]);

Route::get('tags', ['as' => 'tag', 'uses' => 'CookBook\Controllers\TagController@index']);
Route::get('tags/{slug}', ['as' => 'tag.show', 'uses' => 'CookBook\Controllers\TagController@show']);

Route::get('user/{username}', ['as' => 'user.show', 'uses' => 'CookBook\Controllers\UserController@show']);
