<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{slug}', 'ContentController@showArticle');

Route::get('/pages/{slug}', 'ContentController@getPage');
Route::get('/download/{article_id}', 'ContentController@download')->name('download');
Route::get('/download_invoice/{invoice_id}', 'ContentController@download_invoice')->name('download_invoice');

Route::get('/category/{category}/{category_id}','ContentController@showArticlesPerCategory')->name('categories');
Route::get('/suche','ContentController@searchByKeyword');

Route::get('/comment', 'CommentController@store');
Route::delete('/comment/{comment}', 'CommentController@destroy');

Route::get('/membership', 'MembershipController@index')->name('membership');
Route::post('/membership', 'MembershipController@checkVoucher')->name('voucher_check');



// for logged-in users
Route::get('/account', 'AccountController@index')->name('account');
Route::post('/account', 'AccountController@update');


Auth::routes();

