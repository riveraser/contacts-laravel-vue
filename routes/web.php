<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/


Auth::routes();

Route::get('/{any}', 'AppController@index')->where('any', '.*'); //Will match anything and send it to Vue router
