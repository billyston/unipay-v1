<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group
(
    [ 'prefix' => 'unipay-v1' ],

    function ()
    {
        Route::group([ 'prefix' => 'auth/admin' ],
        function ()
        {
            Route::post('login',        'AdminController@login');
            Route::post('logout',       'AdminController@logout');
            Route::post('refresh',      'AdminController@refresh');
            Route::post('me',           'AdminController@me');
        });

        Route::group([ 'prefix' => 'admin' ],
        function ()
        {
            Route::get('all',                   'AdminController@index');
            Route::post('/create',              'AdminController@store');
            Route::get('/show/{code}',          'AdminController@show');
            Route::put('/update/{code}',        'AdminController@update');
            Route::delete('/delete/{code}',     'AdminController@update');
        });
    }
);