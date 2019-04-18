<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', [
   'uses' => 'Auth\LoginController@showLoginForm',
   'as' => 'login',
   ]);


Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
    Route::get('bcs/{id}/detail', ['uses' => 'BcsController@detail','as' => 'bcs.detail',]);
    Route::get('bcs/createDetails/{id}', [
        'uses' => 'BcsController@createDetails',
        'as' => 'bcs.createDetails',
        ]);
    Route::post('bcs/storeDetails', [
        'uses' => 'BcsController@storeDetails',
        'as' => 'bcs.storeDetails',
        ]);
    Route::get('bcs/getLieux', [
        'uses' => 'BcsController@getLieux',
        'as' => 'bcs.getLieux',
        ]);
    Route::get('bcs/regionDetails/{id}/{bc_id}', [
        'uses' => 'BcsController@regionDetails',
        'as' => 'bcs.regionDetails',
    ]);
    Route::delete('bcs/destroyDetail/{id}', [
        'uses' => 'BcsController@destroyDetail',
        'as' => 'bcs.destroyDetail',
        ]);

    Route::get('bls/{id}/detail', [
        'uses' => 'BlsController@detail',
        'as' => 'bls.detail',
        ]);
    Route::get('bls/getLieux', [
        'uses' => 'BlsController@getLieux',
        'as' => 'bls.getLieux',
        ]);
    Route::get('bls/getBcs', [
        'uses' => 'BlsController@getBcs',
        'as' => 'bls.getBcs',
        ]);
    Route::get('bls/getBcdetails', [
        'uses' => 'BlsController@getBcdetails',
        'as' => 'bls.getBcdetails',
    ]);
    Route::get('bls/createDetails/{id}', [
        'uses' => 'BlsController@createDetails',
        'as' => 'bls.createDetails',
        ]);
    Route::post('bls/storeDetails', [
        'uses' => 'BlsController@storeDetails',
        'as' => 'bls.storeDetails',
        ]);
    Route::delete('bls/destroyDetail/{id}', [
        'uses' => 'BlsController@destroyDetail',
        'as' => 'bls.destroyDetail',
        ]);

    Route::resource('bcs', 'BcsController');
    Route::resource('bls', 'BlsController');
    Route::resource('factures', 'FacturesController');
    Route::resource('cheques', 'ChequesController');
    Route::resource('produits', 'ProduitsController');
    Route::resource('users', 'UsersController');
    Route::resource('dashboard', 'DashboardController');
});

Route::group(['prefix' => 'admin','namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
    Route::post('password/reset', 'ResetPasswordController@reset');
});
Route::get('/home', 'Admin\DashboardController@index');
