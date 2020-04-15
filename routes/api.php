<?php

use Illuminate\Http\Request;

/**
 * Customer routes
 */
Route::prefix('/oauth/customer')->group(function(){
    Route::post('login', 'CustomerController@login');
    Route::post('register', 'CustomerController@register');
});


/**
 * Store routes
 */
Route::prefix("/oauth/store")->group(function(){
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::middleware('auth:api', 'web')->group(function(){
        Route::get('logout', 'AuthController@logout');
        Route::post('create_user', 'StoreController@create_user')->middleware('is_admin');
    });
});

Route::middleware("auth:api", "web")->group(function (){
    Route::get('oauth/proceed_store/{app_code}', 'AuthController@proceed_store');
});


Route::middleware('auth:api', 'profile.owner', 'web')->prefix("/store/{vendor:app_code}")->group(function (){
    Route::get('user_info/{user}', 'AuthController@get_user');
    Route::put('user_info/{user}', 'AuthController@update_user');
});
