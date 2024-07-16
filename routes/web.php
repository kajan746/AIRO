<?php

use App\Http\Middleware\BaseMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', ['uses' => 'App\Http\Controllers\Auth\AuthController@getRegistrationPage'])->name('register');
Route::get('login', ['uses' => 'App\Http\Controllers\Auth\AuthController@getLoginPage'])->name('login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('quotation', ['uses' => 'App\Http\Controllers\QuotationController@getQuotationPage'])->name('get-quotation');
});