<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



//Normal User Routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');


// Socialite
Route::prefix('login')->group(function () {
    //Google login
    Route::get('/google', 'Auth\LoginController@redirectToGoogle')->name('login.google');
    Route::get('/google/callback', 'Auth\LoginController@handleGoogleCallback');

    //Facebook login
    Route::get('/facebook', 'Auth\LoginController@redirectToFacebook')->name('login.facebook');
    Route::get('/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

    //Facebook Github
    Route::get('/github', 'Auth\LoginController@redirectToGithub')->name('login.github');
    Route::get('/github/callback', 'Auth\LoginController@handleGithubCallback');
});

//Admin Routes
Route::prefix('admin')->group(function () {
    //admin dashboard
    Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');

    //admin login
    Route::get('/login', 'Auth\AdminLoginController@show')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login');

    //admin logout
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    //admin register
    Route::get('/register', 'Auth\AdminRegisterController@show')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register');

    //admin password reset
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
});