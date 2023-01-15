<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', 'App\Http\Controllers\UserController@index');

Route::get('/', 'App\Http\Controllers\UserController@login');

Route::get('/home', 'App\Http\Controllers\UserController@index');



Route::group(['middleware'=>'guest'], function(){ //yang berada didalam group ini hanya untuk yang belum login saja
    Route::get('/login', 'App\Http\Controllers\UserController@login');

    Route::get('/sign-in-google', 'App\Http\Controllers\UserController@google');

    Route::get('auth/google/callback', 'App\Http\Controllers\UserController@google_callback');

});

Route::group(['middleware'=>'auth'], function(){ //yang berada didalam group ini hanya untuk yang sudah login

    Route::prefix('camps')->group(function () {
        Route::get('/', 'App\Http\Controllers\CampController@index');
        Route::post('/gridview', 'App\Http\Controllers\CampController@gridview');
        Route::get('/create', 'App\Http\Controllers\CampController@create');
        Route::post('/store', 'App\Http\Controllers\CampController@store');
        Route::get('/edit/{id}', 'App\Http\Controllers\CampController@edit');
        Route::post('/update/{camp}', 'App\Http\Controllers\CampController@update');
        Route::get('/delete/{id}', 'App\Http\Controllers\CampController@delete');
        Route::post('/delete/{camp}', 'App\Http\Controllers\CampController@destroy');

        Route::get('/checkout/{slug}', 'App\Http\Controllers\UserController@checkout');

        Route::post('/buy/{id}', 'App\Http\Controllers\UserController@buy_camp');

        Route::get('/success_checkout/{id}', 'App\Http\Controllers\UserController@success_checkout');
    });

    Route::prefix('camp_benefits')->group(function () {
        Route::get('/', 'App\Http\Controllers\CampBenefitController@index');
        Route::post('/gridview', 'App\Http\Controllers\CampBenefitController@gridview');
        Route::get('/create', 'App\Http\Controllers\CampBenefitController@form');
        Route::post('/store/{id?}', 'App\Http\Controllers\CampBenefitController@store');
        Route::get('/edit/{id}', 'App\Http\Controllers\CampBenefitController@form');
    });

    Route::get('/logout', 'App\Http\Controllers\UserController@logout');

});