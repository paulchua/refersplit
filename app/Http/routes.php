<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



# ------------------------------------
# User Authentication
# ------------------------------------
# Show login form
Route::get('/login', 'Auth\AuthController@getLogin');

# Process login form
Route::post('/login', 'Auth\AuthController@postLogin');

# Process logout
Route::get('/logout', 'Auth\AuthController@logout');

# Show registration form
Route::get('/register', 'Auth\AuthController@getRegister');

# Process registration form
Route::post('/register', 'Auth\AuthController@postRegister');




# ------------------------------------
# Home Base
# ------------------------------------

Route::get('/books', 'BookController@getIndex');
Route::get('/', 'WelcomeController@getIndex'); # Home



# ------------------------------------
# Listings Routes
# ------------------------------------
Route::get('/', 'WelcomeController@getIndex'); # Home
Route::get('/listings', 'ListingController@getIndex');
Route::group(['middleware' => 'auth'], function() {
    
Route::get('/listing/edit/{id?}', 'ListingController@getEdit');
Route::post('/listing/edit', 'ListingController@postEdit');

Route::get('/listing/create', 'ListingController@getCreate');
Route::post('/listing/create', 'ListingController@postCreate');

Route::get('/listing/confirm-delete/{id?}', 'ListingController@getConfirmDelete');
Route::get('/listing/delete/{id?}', 'ListingController@getDelete');

Route::get('/listing/show/{id?}', 'ListingController@getShow');

Route::get('/listing/search', 'ListingController@getSearch');
Route::post('/listing/search', 'ListingController@postSearch');
});


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
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', 
$e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});
