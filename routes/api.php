<?php

use Illuminate\Http\Request;


Route::apiResource("/products", "ProductController");
Route::prefix("/products")->group(function (){
    Route::apiResource("/{product}/reviews", "ReviewController");
});

Route::prefix("/oauth")->group(function(){
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::middleware('auth:api')->group(function(){
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
