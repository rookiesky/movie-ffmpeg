<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace'=>'Auth'],function (){

    Route::post('/sign-up','RegisterController@register');
    Route::post('/login','LoginController@login');
    Route::post('/forget','ForgotPasswordController@sendResetLinkEmail');

});




Route::group(['namespace'=>'Api'],function (){
    //video sort list
    Route::get('/sort/list','SortApi@list');
    //home banner
    Route::get('/banner','VideoApi@homeBanner');
    //home video list
    Route::get('/sort/video','SortApi@video');
    // get links list
    Route::get('/links','LinksApi@index');

});

