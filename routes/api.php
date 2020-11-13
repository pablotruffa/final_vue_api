<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::options('/{cualquiercosa}', function() {})->where('cualquiercosa', '.*');

Route::post('admin-login','AuthAdminController@login');

Route::post('client-login','AuthClientController@login'); 
//Route::get('clients','ClientController@all')->middleware('auth');
Route::post('admin-logout','AuthAdminController@logout');

#Testing ----------------------------------------

Route::get('testing','TestingController@test');

#Client routes --------------------------------------------
Route::middleware(['auth:api-client'])->group(function(){
    Route::get('client-products','ProductController@all');
    Route::get('client-product-categories','ProductCategoryController@all');
    Route::post('client-order','RsOrderController@create');
    Route::get('client-orders/{id}','RsOrderController@clientOrders');
    Route::get('client-logout','AuthClientController@logout');
    Route::get('client-picture/{id}','ProductController@getPicture');

});




#Admin routes --------------------------------------------
Route::middleware(['auth'])->group(function(){
    Route::get('products','ProductController@all');
    Route::get('clients','ClientController@all');
    Route::get('product-categories','ProductCategoryController@all');
    
    Route::get('user-levels','LevelController@all');
    
    
    Route::post('client','ClientController@create');
    Route::put('client/{id}','ClientController@edit');
    Route::delete('client/{id}','ClientController@delete');
    Route::delete('client-kill/{id}','ClientController@kill');
    Route::patch('client/{id}','ClientController@restore');
    
    Route::post('product','ProductController@create');
    Route::put('product/{id}','ProductController@edit');
    Route::delete('product/{id}','ProductController@delete');
    
    Route::get('order-status','OrderStatusController@all');
    Route::put('order/{id}','RsOrderController@update');
    Route::put('remove-order/{id}','RsOrderController@remove');
    
    Route::get('orders','RsOrderController@all');
    
    Route::get('picture/{id}','ProductController@getPicture');

    

    
    
});









