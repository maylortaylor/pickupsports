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
| contains the "web" middleware group. Now creater something great!
|
*/

Route::get('/', function () {
    $sports = Sports::all();

    return view('home', ['sports' => $sports]);
    // return view('home')->with('sports', $sports);
});

Route::get('/submitTeam', function () {
    return view('submitTeam');
});

Route::post('/submitTeam', function (Request $request) {

    // $imageGuid = Guid::create();

    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'max:255',
        'zipcode' => 'required|max:20',
        'image' => 'required|image'
    ]);

    if( $request->hasFile('image'))
    {
        $request->image->store('public/team-images');
        $file = Input::file('image')->getClientOriginalName();

        $justFilename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        $filename = 'team-image-' . kebab_case($justFilename) . '-' . time() . '.' . $extension;
        $filesize = $request->image->getClientSize();
        $request->image = $request->image->storeAs('public/team-images',$filename);

        $data['image'] = $filename;
    }

    $team = tap(new App\Team($data))->save();

    return redirect('/');
});

Route::get('/submitSport', function (){
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
