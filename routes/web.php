<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('bank', 'BankAccountController');

Route::get('bank/{bankAccount}/users', 'BankAccountController@bank_accounts');

// Route::resource('account', 'UserAccountController');

Route::get('account/create/{bankAccount}', 'UserAccountController@create');

Route::post('account/{bankAccount}', 'UserAccountController@store');

Route::get('account/{bankAccount}/bank', 'UserAccountController@bank_accounts');

Route::resource('users', 'HomeController');

Route::resource('transactions', 'TransactionController');

Route::get('/home', 'HomeController@home')->name('home');
