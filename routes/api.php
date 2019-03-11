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
        // Admin routes
        Route::group([ 'prefix' => 'auth/admin' ],
        function ()
        {
            Route::post('login',                        'AdminController@login');
            Route::post('logout',                       'AdminController@logout');
            Route::post('refresh',                      'AdminController@refresh');
            Route::post('me',                           'AdminController@me');
        });
        Route::group([ 'prefix' => 'admin' ],
        function ()
        {
            Route::get('all',                           'AdminController@index');
            Route::post('/create',                      'AdminController@store');
            Route::get('/profile/{code}',               'AdminController@show');
            Route::put('/update/{code}',                'AdminController@update');
            Route::delete('/delete/{code}',             'AdminController@destroy');

            // On School model
            Route::get('schools',                       'AdminController@schools');

            // On SchoolAdmin model
            Route::get('school/admins',                 'AdminController@schoolAdmin');

            // On Student model
            Route::get('students',                      'AdminController@students');

            // On Student model
            Route::get('transactions',                  'AdminController@getAll');
        });

        // School routes
        Route::group([ 'prefix' => 'school' ],
        function ()
        {
            Route::post('/signup',                      'SchoolController@store');
            Route::get('/show/{code}',                  'SchoolController@show');
            Route::put('/update/{code}',                'SchoolController@update');
            Route::delete('/delete/{code}',             'SchoolController@destroy');
        });

        // School admin routes
        Route::group([ 'prefix' => 'auth/school/admin' ],
        function ()
        {
            Route::post('login',                        'SchoolAdminController@login');
            Route::post('logout',                       'SchoolAdminController@logout');
            Route::post('refresh',                      'SchoolAdminController@refresh');
            Route::post('me',                           'SchoolAdminController@me');
        });
        Route::group([ 'prefix' => 'school/admin' ],
        function ()
        {
            Route::post('/create',                      'SchoolAdminController@store');
            Route::get('/profile/{admin_code}',         'SchoolAdminController@show');
            Route::put('/update/{code}',                'SchoolAdminController@update');
            Route::delete('/delete/{code}',             'SchoolAdminController@destroy');
        });

        // Student routes
        Route::group([ 'prefix' => 'auth/student' ],
        function ()
        {
            Route::post('login',                        'StudentController@login');
            Route::post('logout',                       'StudentController@logout');
            Route::post('refresh',                      'StudentController@refresh');
            Route::post('me',                           'StudentController@me');
        });
        Route::group([ 'prefix' => 'student' ],
        function ()
        {
            Route::post('/register',                    'StudentController@store');
            Route::get('/show/{student_code}',          'StudentController@show');
            Route::put('/update/{student_code}',        'StudentController@update');
            Route::delete('/delete/{student_code}',     'StudentController@destroy');

            // Student transactions routes
            Route::post('/wallet/add',                  'StudentController@storeWallet');
            Route::get('/transactions/{student_code}',  'StudentController@transactions');

            // Student transactions routes
            Route::post('/transaction',                 'StudentController@storeTransaction');
            Route::get('/transactions/{student_code}',  'StudentController@transactions');
        });




//        Route::group([],
//        function ()
//        {
//            Route::post('transaction',                       'TransactionController@store');
//        });
    }
);