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

//Route::get('/test', function () {
//	 $subject = 'Test Subject';
//	 $name = 'Test Name';
//	 $email = 'test Email';
//	 $body = 'test Body';
//
//     return view('emails.contact_response', compact('subject', 'name', 'email', 'body'));
// })->middleware('web');

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/home', 'HomeController@home')->name('home');

Route::get('/about_us', 'HomeController@about_us')->name('about_us');

Route::get('/tramaine/portfolio', 'HomeController@portfolio')->name('portfolio');

Route::get('bank/{bankAccount}/users', 'BankAccountController@bank_accounts');

Route::put('bank/{bankAccount}/users', 'UserAccountController@update');

Route::get('bank/{bankAccount}/remove', 'BankAccountController@bank_remove');

// Route::resource('account', 'UserAccountController');
Route::get('account/{userAccount}/remove', 'UserAccountController@user_account_remove');

Route::get('account/create/{bankAccount}', 'UserAccountController@create');

Route::post('account/{bankAccount}', 'UserAccountController@store');

Route::get('account/{bankAccount}/bank', 'UserAccountController@bank_accounts');

Route::delete('account/{userAccount}', 'UserAccountController@destroy');

Route::put('/home/{user}', 'HomeController@update_image');

Route::delete('transactions', 'TransactionController@destroy');

Route::get('user/{user}/transactions', 'UserAccountController@user_transactions');

Route::post('/send_message', 'HomeController@message')->name('send_message');

Route::resource('users', 'HomeController');

Route::resource('transactions', 'TransactionController');

Route::resource('bank', 'BankAccountController');

Route::resource('documents', 'DocumentController');