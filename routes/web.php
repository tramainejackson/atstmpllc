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

Route::get('/test', function () {
    return view('test');
})->middleware('web');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('bank', 'BankAccountController');

Route::resource('documents', 'DocumentController');

Route::get('bank/{bankAccount}/users', 'BankAccountController@bank_accounts');

Route::get('bank/{bankAccount}/remove', 'BankAccountController@bank_remove');

// Route::resource('account', 'UserAccountController');
Route::get('account/{userAccount}/remove', 'UserAccountController@user_account_remove');

Route::get('account/create/{bankAccount}', 'UserAccountController@create');

Route::put('bank/{bankAccount}/users', 'UserAccountController@update');

Route::post('account/{bankAccount}', 'UserAccountController@store');

Route::get('account/{bankAccount}/bank', 'UserAccountController@bank_accounts');

Route::delete('account/{userAccount}', 'UserAccountController@destroy');

Route::resource('users', 'HomeController');

Route::put('/home/{user}', 'HomeController@update_image');

Route::resource('transactions', 'TransactionController');

Route::delete('transactions', 'TransactionController@destroy');

Route::get('user/{user}/transactions', 'UserAccountController@user_transactions');

Route::get('/home', 'HomeController@home')->name('home');
