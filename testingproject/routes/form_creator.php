<?php

use Illuminate\Support\Facades\Route;


Route::group([
  'prefix' => 'add_client',
  'namespace' => '\App\Http\Controllers\ClientProfile'
],function(){

    Route::resource('client', 'DynamicFormController');

    Route::get('add_client_user_page/{client_id}','DynamicFormController@add_client_user_page');

    Route::post('add_client_user/{client_id}','DynamicFormController@add_client_user');

    Route::get('get_client_user/{client_id}/{field}/{field_value}/','DynamicFormController@get_client_user');
});
