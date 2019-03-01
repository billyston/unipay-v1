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
    [ 'middleware' => 'api', 'prefix' => 'unipay-v1' ],

    function ()
    {
        Route::group([ 'prefix' => 'auth/admin' ],
        function ()
        {
            Route::post('login',                'AdminController@login');
            Route::post('logout',               'AdminController@logout');
            Route::post('refresh',              'AdminController@refresh');
            Route::post('me',                   'AdminController@me');
        });
        Route::group([ 'prefix' => 'admin' ],
        function ()
        {
            Route::get('all',                   'AdminController@index');
            Route::post('/create',              'AdminController@createAdmin');
            Route::get('/show/{code}',          'AdminController@show');
            Route::put('/update/{code}',        'AdminController@update');
            Route::delete('/delete/{code}',     'AdminController@destroy');
        });

        Route::group([ 'prefix' => 'auth/school/admin' ],
        function ()
        {
            Route::post('login',                'SchoolAdminController@login');
            Route::post('logout',               'SchoolAdminController@logout');
            Route::post('refresh',              'SchoolAdminController@refresh');
            Route::post('me',                   'SchoolAdminController@me');
        });
        Route::group([ 'prefix' => 'school/admin' ],
        function ()
        {
            Route::get('all',                   'SchoolAdminController@index');
            Route::post('/create',              'SchoolAdminController@store');
            Route::get('/show/{code}',          'SchoolAdminController@show');
            Route::put('/update/{code}',        'SchoolAdminController@update');
            Route::delete('/delete/{code}',     'SchoolAdminController@destroy');
        });

        Route::group([ 'prefix' => 'auth/student' ],
        function ()
        {
            Route::post('login',                'StudentController@login');
            Route::post('logout',               'StudentController@logout');
            Route::post('refresh',              'StudentController@refresh');
            Route::post('me',                   'StudentController@me');
        });
        Route::group([ 'prefix' => 'student' ],
        function ()
        {
            Route::get('all',                   'StudentController@index');
            Route::post('/create',              'StudentController@store');
            Route::get('/show/{code}',          'StudentController@show');
            Route::put('/update/{code}',        'StudentController@update');
            Route::delete('/delete/{code}',     'StudentController@destroy');
        });
    }
);