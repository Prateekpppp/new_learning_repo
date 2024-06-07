<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SharkController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('test', function(){
    return 'wait';
});

// Route::post('workflow_sample', 'App\Http\Controllers\SharkController@workflow_sample');
// Route::get('workflow_sample', 'App\Http\Controllers\SharkController@workflow_sample');
Route::any('workflow_sample', 'App\Http\Controllers\SharkController@workflow_sample');

