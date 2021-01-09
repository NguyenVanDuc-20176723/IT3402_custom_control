<?php

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

Route::get('index',['as'=>'trang-chu', 'uses'=>'MyController@getIndex']);

Route::get('loai-san-pham/{type}',['as'=>'loaisanpham', 'uses'=>'MyController@getProductType']);

Route::get('chi-tiet-loai-san-pham/{id}',['as'=>'chitietloaisanpham', 'uses'=>'MyController@getProduct']);

Route::get('lien-he',['as'=>'lienhe', 'uses'=>'MyController@getContact']);

Route::get('add-to-cart/{id}',['as'=>'themgiohang','uses'=>'MyController@getCart']);

Route::post('add-to-multi-cart/{id}',['as'=>'themgiohang1','uses'=>'MyController@postMultiCart']);

Route::get('move-to-cart/{id}',['as'=>'xoagiohang','uses'=>'MyController@moveCart']);

Route::get('dat-hang',['as'=>'dathang','uses'=>'MyController@getCheckout']);

Route::post('dat-hang',['as'=>'dathang','uses'=>'MyController@postCheckout']);

Route::get('login',['as'=>'dangnhap','uses'=>'MyController@getLogin']);

Route::post('login',['as'=>'dangnhap','uses'=>'MyController@postLogin']);

Route::get('signin',['as'=>'dangky','uses'=>'MyController@getSignin']);

Route::post('signin',['as'=>'dangky','uses'=>'MyController@postSignin']);

Route::get('logout',['as'=>'dangxuat','uses'=>'MyController@logOut']);

Route::get('search',['as'=>'timkiem','uses'=>'MyController@Search']);

//--------------
Route::get('server','Server@getDatHang');
Route::get('reset_session',['as'=>'reset_session','uses'=>'Server@resetSession']);


