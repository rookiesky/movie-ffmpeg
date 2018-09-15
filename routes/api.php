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

    Route::get('/tags','TagsApi@tags');

    Route::get('/video/list','VideoApi@sortList');

    Route::get('/video/{id}','VideoApi@find');

    Route::get('/program','ProgramApi@get');

    Route::get('/random','VideoApi@randomVideo');

});

Route::group(['middleware'=>['auth'],'namespace'=>'Api'],function (){

    Route::get('/collect/set/{id}','CollectApi@set');

    Route::get('/reflect/set/{id}','ReflectApi@set');

    Route::get('/notice/find/{id}','NoticesApi@find');

    Route::put('/member/user-info/edit','MemberApi@editUsername');

    Route::put('/member/password/edit','MemberApi@editPassword');

    Route::delete('/member/collect/{id}','CollectApi@destroy')->where('id','[0-9]+');

});

