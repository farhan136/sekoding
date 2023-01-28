<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\UserController@index')->middleware('isadmin:user');
Route::get('/home', 'App\Http\Controllers\UserController@index')->name('home')->middleware('isadmin:user');

Route::group(['middleware'=>'guest'], function(){ //yang berada didalam group ini hanya untuk yang belum login saja
    Route::get('/login', 'App\Http\Controllers\UserController@login')->name('login'); // view login user

    Route::get('/sign-in-google', 'App\Http\Controllers\UserController@google');

    Route::get('auth/google/callback', 'App\Http\Controllers\UserController@google_callback');

    // -------------------------------------------------------------------------------------------

    Route::get('/loginadmin', 'App\Http\Controllers\GeneralController@login')->name('loginadmin'); // view login admin

    Route::post('/do_login_admin', 'App\Http\Controllers\GeneralController@do_login');
});

    Route::prefix('camps')->group(function () {
        
        Route::group(['middleware'=>'isadmin:admin', 'middleware'=>'auth'], function(){ //untuk role admin dan yang berada didalam group ini hanya untuk yang sudah login
            Route::get('/', 'App\Http\Controllers\CampController@index');
            Route::post('/gridview', 'App\Http\Controllers\CampController@gridview');
            Route::get('/create', 'App\Http\Controllers\CampController@create');
            Route::post('/store', 'App\Http\Controllers\CampController@store');
            Route::get('/edit/{id}', 'App\Http\Controllers\CampController@edit');
            Route::post('/update/{camp}', 'App\Http\Controllers\CampController@update');
            Route::get('/delete/{id}', 'App\Http\Controllers\CampController@delete');
            Route::post('/delete/{camp}', 'App\Http\Controllers\CampController@destroy');
        });      

        Route::group(['middleware'=>'isadmin:user', 'middleware'=>'auth'], function(){ //untuk role user dan yang berada didalam group ini hanya untuk yang sudah login
            Route::get('/checkout/{slug}', 'App\Http\Controllers\CheckoutController@checkout');
            Route::post('/buy/{id}', 'App\Http\Controllers\CheckoutController@buy_camp');
            Route::get('/success_checkout/{id}', 'App\Http\Controllers\CheckoutController@success_checkout');

            Route::get('/my_dashboard', 'App\Http\Controllers\UserController@dashboard');
        });
    });

    Route::prefix('camp_benefits')->group(function () {
        Route::group(['middleware'=>'isadmin:admin', 'middleware'=>'auth'], function(){ //untuk role admin dan yang berada didalam group ini hanya untuk yang sudah login
            Route::get('/', 'App\Http\Controllers\CampBenefitController@index');
            Route::post('/gridview', 'App\Http\Controllers\CampBenefitController@gridview');
            Route::get('/create', 'App\Http\Controllers\CampBenefitController@form');
            Route::post('/store/{id?}', 'App\Http\Controllers\CampBenefitController@store');
            Route::get('/edit/{id}', 'App\Http\Controllers\CampBenefitController@form');
        });
    });

    Route::prefix('checkout')->group(function () {
        Route::group(['middleware'=>'isadmin:admin', 'middleware'=>'auth'], function(){ //untuk role admin dan yang berada didalam group ini hanya untuk yang sudah login
            Route::get('/', 'App\Http\Controllers\CheckoutController@index');
            Route::post('/gridview', 'App\Http\Controllers\CheckoutController@gridview');
        });
    });

    Route::prefix('mentor')->group(function () {
        Route::group(['middleware'=>'isadmin:admin', 'middleware'=>'auth'], function(){ //untuk role admin dan yang berada didalam group ini hanya untuk yang sudah login
            Route::get('/', 'App\Http\Controllers\MentorController@index');
            Route::post('/gridview', 'App\Http\Controllers\MentorController@gridview');
            Route::get('/create', 'App\Http\Controllers\MentorController@form');
            Route::post('/store/{id?}', 'App\Http\Controllers\MentorController@store');
            Route::get('/edit/{id}', 'App\Http\Controllers\MentorController@form');
        });
    });

    Route::get('/logout/{is_admin?}', 'App\Http\Controllers\UserController@logout')->middleware('auth');

    //midtrans route
    Route::get('/payment/success', 'App\Http\Controllers\CheckoutController@midtrans_callback')->middleware('auth');
    Route::post('/payment/success', 'App\Http\Controllers\CheckoutController@midtrans_callback')->middleware('auth');    



    Route::get('/tessaja', 'App\Http\Controllers\GeneralController@tessaja');