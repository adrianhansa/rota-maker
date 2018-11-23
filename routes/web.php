<?php
// Route::view('/', 'home');
Route::view('/', 'home')->name('home');
Route::get('{path}','HomeController@index')->where('path','([A-z\d/_.]+)?');

Route::post('register','Auth\RegisterController@register');
Route::post('login','Auth\LoginController@login');
Route::post('logout','Auth\LoginController@logout');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset','Auth\ForgotPasswordController@reset');
