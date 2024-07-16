<?php

use Illuminate\Support\Facades\Route;

Route::post('login', ['uses' => 'App\Http\Controllers\Auth\AuthController@login'])->name('api-login');
Route::post('register', ['uses' => 'App\Http\Controllers\Auth\AuthController@register'])->name('api-register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('me', ['uses' => 'App\Http\Controllers\Auth\AuthController@userProfile']);
    Route::post('logout', ['uses' => 'App\Http\Controllers\Auth\AuthController@logout']);
    Route::post('refresh', ['uses' => 'App\Http\Controllers\Auth\AuthController@refresh']);

    Route::post('quotation', ['uses' => 'App\Http\Controllers\QuotationController@getQuotation']);
});
