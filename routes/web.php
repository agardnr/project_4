<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// index
Route::get('/', 'HomeController@index')->name('home.index');

/* Landing page
Route::get('/home', 'HomeController@landing')->name('home.landing');
*/

// Create new task
Route::get('/create', 'TaskController@create')->name('task.create')->middleware('auth');

// Show list of all tasks
Route::get('/show', 'TaskController@show')->name('task.show')->middleware('auth');

// Add task to all tasks
Route::post('/show', 'TaskController@store')->name('task.store');

// Show list of Incomplete tasks only
Route::get('/show/{completion}', 'TaskController@showIncomplete')->name('task.showIncomplete')->middleware('auth');

// Update task
Route::put('/show/{id}', 'TaskController@update')->name('task.update');

// Update task status
Route::put('/show/{id}/{status}', 'TaskController@update_status')->name('task.update_status');

// Delete task
Route::get('/destroy/{id}', 'TaskController@destroy')->name('task.destroy');

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});

Auth::routes();

Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index');
