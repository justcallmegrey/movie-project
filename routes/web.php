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
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/movie', 'MovieController@index')->name('movie');
Route::get('/movie/datatable', 'MovieController@datatable')->name('movie.datatable');
Route::post('/movie/store', 'MovieController@store')->name('movie.store');
Route::get('/movie/edit/{id}', 'MovieController@edit')->name('movie.edit');
Route::put('/movie/update/{id}', 'MovieController@update')->name('movie.update');
Route::delete('/movie/delete/{id}', 'MovieController@destroy')->name('movie.delete');

Route::get('/member', 'MemberController@index')->name('member');
Route::get('/member/datatable', 'MemberController@datatable')->name('member.datatable');
Route::post('/member/store', 'MemberController@store')->name('member.store');
Route::get('/member/edit/{id}', 'MemberController@edit')->name('member.edit');
Route::put('/member/update/{id}', 'MemberController@update')->name('member.update');
Route::delete('/member/delete/{id}', 'MemberController@destroy')->name('member.delete');