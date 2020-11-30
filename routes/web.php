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

Route::prefix('user')->group(function () {
    Route::post('/logout', 'Auth\LoginController@userLogout')->name('user.logout');
    Route::get('/profile', 'HomeController@show')->name('user.profile');
});


// Socialite
Route::group(['prefix' => 'login', 'namespace' => 'Auth'], function () {
    //Google login
    Route::get('/google', 'LoginController@redirectToGoogle')->name('login.google');
    Route::get('/google/callback', 'LoginController@handleGoogleCallback');

    //Facebook login
    Route::get('/facebook', 'LoginController@redirectToFacebook')->name('login.facebook');
    Route::get('/facebook/callback', 'LoginController@handleFacebookCallback');

    //Facebook Github
    Route::get('/github', 'LoginController@redirectToGithub')->name('login.github');
    Route::get('/github/callback', 'LoginController@handleGithubCallback');
});



//Admin Routes
Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'auth:admin', 'namespace' => 'Admin'], function () {
        //admin dashboard
        Route::get('/dashboard', 'AdminPagesController@index')->name('admin.dashboard');
        //admin crud
        Route::resource('/users', 'AdminController');
    });

    Route::group(['namespace' => 'Auth'], function () {
        //admin login
        Route::get('/login', 'AdminLoginController@show')->name('admin.login');
        Route::post('/login', 'AdminLoginController@login');

        //admin logout
        Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');
        //admin password reset
        Route::get('/password/reset', 'AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/password/email', 'AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset/{token}', 'AdminResetPasswordController@showResetForm')->name('admin.password.reset');
        Route::post('/password/reset', 'AdminResetPasswordController@reset')->name('admin.password.update');

        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('/setpassword', 'SetPasswordController@create')->name('setpassword');
            Route::post('/setpassword', 'SetPasswordController@store')->name('setpassword.store');
        });
    });
});

//Invitation route
Route::get('/invitation/{user}', 'Admin\AdminController@invitation')->name('invitation');