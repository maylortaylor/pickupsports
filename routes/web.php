<?php

use \App\Sport as Sports;
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

Route::get('/', function () {
    $sports = Sports::all();

    return view('welcome', ['sports' => $sports]);
    // return view('welcome')->with('sports', $sports);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
