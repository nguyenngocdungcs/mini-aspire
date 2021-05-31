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

Route::group(['prefix' => 'v1', 'middleware' => ['log']], function () {
    Route::resource('users', 'UserController', ['only' => ['show', 'index', 'store']]);
    Route::resource('loans', 'LoanController', ['only' => ['show', 'index', 'store']]);
    Route::get('loans/{loan}/next-repayment', 'LoanController@nextRepayment');

    Route::resource('repayments', 'RepaymentController', ['only' => ['show']]);
    Route::post('repayments/{repayment}/pay', 'RepaymentController@pay');
});