<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/


Auth::routes();

Route::get('/logout-manual', function(){
    request()->session()->invalidate();
});

Route::get('/{any}', 'AppController@index')->where('any', '.*'); //Will match anything and send it to Vue router
