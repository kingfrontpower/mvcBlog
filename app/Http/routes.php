<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('contact',  ['as'=>'contact','uses'=>'PagesController@getContact']);

Route::get('about',  ['as'=>'about','uses'=>'PagesController@getAbout']);

Route::get('/',  ['as'=>'home','uses'=>'PagesController@getIndex']);


//沒有會員的訂購單, 顯示flash提示, 重整後消失

Route::get('orderIndexNoLogin', ['as'=>'orderIndexNoLogin','uses'=>'OrderController@orderIndexNoLogin']);



//Authentication Routes
Route::get('auth/login', ['as'=>'login','uses'=>'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['uses'=>'Auth\AuthController@getLogout','as'=>'logout']);

//Registration Routes
Route::get('auth/register',['as'=>'register','uses'=>'Auth\AuthController@getRegister'] );
Route::post('auth/register', 'Auth\AuthController@postRegister');

// ResetPassWord Routes
Route::get('password/reset/{token?}','Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset','Auth\PasswordController@reset');


//Route也可用regular express檢查
Route::get('blog/{slug}',['uses' =>'BlogController@getSingle','as' =>'blog.single'])->where('slug','[\w\d\-\_]+');

Route::get('blog',['uses'=>'BlogController@getIndex','as'=>'blog.index']);

Route::get('service_orders',['uses'=>'OrderController@service_orders','as'=>'service_orders']);
Route::get('service_items',['uses'=>'OrderController@service_items','as'=>'service_items']);


Route::resource('posts','PostController');
Route::resource('orders','OrderController');



