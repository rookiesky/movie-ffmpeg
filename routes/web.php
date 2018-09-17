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

Route::get('/','HomeController@index');

Route::get('/sign-up','AuthController@signup')->name('sign-up');
Route::get('/login','AuthController@login')->name('login');
Route::get('/forget','AuthController@forget');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/sort/{id}','SortController@index')->where('id','[0-9]+');

Route::get('/search','SortController@search');

Route::get('/v/{id}','VideoController@index')->where('id','[0-9]+');


Route::group(['middleware'=>'auth'],function (){

    Route::get('/member','MemberController@index');
    Route::get('/member/user-info','MemberController@userInfo');
    Route::get('/member/collects','MemberController@collects');

});


//admin
Route::group(['prefix'=>'setAdmin','namespace'=>'Admin'],function(){
    //admin user view
    Route::get('/login','LoginController@index');
    //admin login logic
    Route::post('/login','LoginController@login');

    Route::group(['middleware'=>'auth:admin'],function (){
        //admin user logout
        Route::get('/logout','LoginController@logout');
        //admin home view
        Route::get('/home','HomeController@index');

        // add video view
        Route::get('/video/create','VideosController@create');
        //create and update video
        Route::post('/video/create','VideosController@store');
        //video edit view
        Route::get('/video/{id}/edit','VideosController@edit');
        //update video
        Route::post('/video/update','VideosController@update');


        // add video sort view
        Route::get('/video/sort/add','SortController@add');
        //video sort add
        Route::post('/video/sort/add','SortController@store');
        //video sort list view
        Route::get('/video/sort','SortController@index');
        //video sort edit view
        Route::get('/video/sort/edit/{id}','SortController@edit');
        //video tag view
        Route::get('/video/tags','VideoTagsController@index');
        //video list view
        Route::get('/video/{status}','VideosController@index')->where('status','[0-9]+');

        Route::get('/video/search','VideosController@search');


        //server list view
        Route::get('/system/server','ServerController@index');
        // server create view
        Route::get('/system/server/create','ServerController@create');
        // create and edit server
        Route::post('/system/server/create','ServerController@store');
        //server edit view
        Route::get('/system/server/{id}/edit','ServerController@edit');
        // system view
        Route::get('/system','SystemController@index');


        //links view
        Route::get('/links','LinksController@index');


        Route::get('/program','ProgramController@index');
        Route::get('/program/create','ProgramController@create');
        Route::post('/program/create','ProgramController@store');
        Route::get('/program/{id}/edit','ProgramController@edit')->where('id','[0-9]+');

        Route::get('/point','PointController@index');
        Route::get('/point/create','PointController@create');
        Route::post('/point/create','PointController@store');
        Route::get('/point/{id}/edit','PointController@edit')->where('id','[0-9]+');


        Route::get('/notices','NoticeController@index');
        Route::get('/notices/create','NoticeController@create');
        Route::post('/notices/create','NoticeController@store');
        Route::get('/notices/{id}/edit','NoticeController@edit');


    });

});

// admin api
Route::group(['namespace'=>'Admin','prefix'=>'api/setAdmin','middleware'=>['auth:admin']],function (){
    //delete video sort
    Route::get('/video/sort/delete/{id}','SortController@destroy');
    //create and update video tag
    Route::post('/video/tags/create','VideoTagsController@store');
    //show video tag
    Route::get('/video/tags/{id}','VideoTagsController@show');
    // destroy video tag
    Route::delete('/video/tags/{id}','VideoTagsController@destroy');
    //update video status
    Route::get('/video/updateStatus/{id}','VideosController@updateStatus');
    //delete video
    Route::delete('/video/{id}','VideosController@destroy');

    //destroy server
    Route::delete('/system/server/{id}','ServerController@destroy');
    //create and update system
    Route::post('/system','SystemController@store');

    // create and update link
    Route::post('/link','LinksController@store');
    // find link
    Route::get('/link/{id}','LinksController@find');
    //destroy link
    Route::delete('/link/{id}','LinksController@destroy');


    Route::delete('/program/{id}','ProgramController@destroy')->where('id','[0-9]+');

    Route::delete('/point/{id}','PointController@destroy')->where('id','[0-9]+');

    Route::delete('/notice/{id}','NoticeController@destroy')->where('id','[0-9]+');



});


