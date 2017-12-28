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

Route::resource('account', 'UserAccountController');

Route::resource('users', 'HomeController');

Route::resource('transactions', 'TransactionController');

Route::get('/home', 'HomeController@index')->name('home');
