<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/',function (){
   echo "sumaia";
});
Route::get('category/brands', 'CategoryController@brands')->name('category.brands');
Route::get('category/types', 'CategoryController@types')->name('category.types');
Route::get('category/colors', 'CategoryController@colors')->name('category.colors');
Route::get('category/models', 'CategoryController@models')->name('category.models');


Route::get('service/brands', 'ServiceController@brands')->name('service.brands');
Route::get('service/services', 'ServiceController@services')->name('service.services');
Route::get('service/price', 'ServiceController@price')->name('service.price');

Route::post('register', 'AuthController@register')->name('register');
Route::post('login', 'AuthController@login')->name('login');
Route::post('checkCode', 'AuthController@check_code')->name('checkCode');


Route::group(['prefix' => 'client', 'middleware' => ['client_auth']], function () {
    Route::get('profile', 'Client\ClientController@profile')->name('profile');
    Route::post('profile/edit', 'Client\ClientController@edit')->name('profile.edit');

    Route::resource('address', 'Client\AddressController')->only(['index', 'store', 'destroy']);
    Route::post('address/update/{id}','Client\AddressController@update')->name('address.update');

    Route::resource('contacts', 'Client\ContactController')->only(['index', 'store', 'destroy']);
    Route::post('contacts/update/{id}','Client\ContactController@update')->name('contacts.update');

    Route::get('coupon', 'Client\OrderController@coupon')->name('coupon');
    Route::resource('orders', 'Client\OrderController');
    Route::post('order/rate','Client\OrderController@rate')->name('order.rate');
    Route::post('order/reschedule','Client\OrderController@reschedule_order')->name('order.reschedule');
    Route::post('order/cancel','Client\OrderController@cancel')->name('order.cancel');
});

Route::group(['prefix' => 'engineer', 'middleware' => ['eng_auth']], function () {
    Route::get('profile', 'Engineer\EngController@profile')->name('profile');
    Route::post('profile/edit', 'Engineer\EngController@edit')->name('profile.edit');

    Route::get('store', 'Engineer\StoreController@store')->name('store');
    Route::post('store/edit', 'Engineer\StoreController@edit')->name('store.edit');


    Route::resource('orders', 'Engineer\OrderController')->only(['index','show']);
    Route::post('order/reschedule','Engineer\OrderController@reschedule_order')->name('order.reschedule');
    Route::post('order/status/{id}','Engineer\OrderController@update')->name('order.status');
});


Route::get('temp_order', function () {
    $json['details'][0]['model_id'] = 1;
    $json['details'][0]['color_id'] = 1;
    $json['details'][0]['service_id'] = 1;
    $json['details'][0]['brand_id'] = 6;

    foreach (json_decode(json_encode($json['details']),TRUE) as $index=>$j){
        echo $j['model_id'];
        echo "<br>";
        return;
    };
});
