<?php

use Illuminate\Http\Request;

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

Route::get('/submit', function (){
    return view('submitSport');
});

Route::post('/submitSport', function(Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'max:255'
    ]);
    
    // this is also valid
    // $link = new \App\Link($data);
    // $link->save();

    // but in Laravel 5.5 "tap" is a better looking way to create the object
    $sport = tap(new App\Sport($data))->save();

    return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
