<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** Forward the root route to users so we can easily update this in the future **/
Route::get('/', function () {
  if (Auth::check()) {
    return redirect()->route('users');
  }

  return redirect()->route('login');
});
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout');
Route::post('/login', 'AuthController@authenticate')->name('authenticate');
Route::get('/users', 'UsersController@index')->name('users');
Route::get('/get-users', 'UsersController@getUsers')->name('get-users');
