<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('user.home');
// });

Route::get('/', 'App\Http\Controllers\UserController@index');

    Route::prefix('camps')->group(function () {
        Route::get('/', 'App\Http\Controllers\CampController@index');
        Route::post('/gridview', 'App\Http\Controllers\CampController@gridview');
        Route::get('/create', 'App\Http\Controllers\CampController@create');
        Route::post('/store', 'App\Http\Controllers\CampController@store');
        Route::get('/edit/{id}', 'App\Http\Controllers\CampController@edit');
        Route::post('/update/{camp}', 'App\Http\Controllers\CampController@update');
        Route::get('/delete/{id}', 'App\Http\Controllers\CampController@delete');
        Route::post('/delete/{camp}', 'App\Http\Controllers\CampController@destroy');
    });

    Route::prefix('camp_benefits')->group(function () {
        Route::get('/', 'App\Http\Controllers\CampBenefitController@index');
        Route::post('/gridview', 'App\Http\Controllers\CampBenefitController@gridview');
        Route::get('/create', 'App\Http\Controllers\CampBenefitController@form');
        Route::post('/store/{id?}', 'App\Http\Controllers\CampBenefitController@store');
        Route::get('/edit/{id}', 'App\Http\Controllers\CampBenefitController@form');
    });