<?php

use Illuminate\Support\Facades\Route;
// use App\Test\TestFacades;

// header('All')
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function(){
    return TestFacades::testingFacades();
});

Route::get('workflow_w',function(){
    // dd('213retgf');
    return view('workflow.index');
});

Route::resource('user', 'SharkController');

Route::get('fetchjson_n_reorder', 'SharkController@fetchjson_n_reorder');

Route::get('downloadtablecsv', 'SharkController@downloadtablecsv');

Route::get('mkTableBackup', 'SharkController@mkTableBackup');

Route::get('callsmsApi',function(){
    return view('formsubmission');
});

Route::get('geochart',function(){
    return view('test_pages.geochart');
});

Route::get('callsmsApi/{smstype}', 'SharkController@callsmsgetApi');

Route::post('callsmspostApi', 'SharkController@callsmspostApi')->name('callsmspostApi');

Route::get('/flash-message', 'FlashMessageController@showMessage');

Route::get('/slack-message', 'SharkController@slackNotificationMessage');

Route::get('/deleteDublicateKeys/{filename}', 'SharkController@deleteDublicateKeys');

Route::get('/read_csvintotable', 'SharkController@read_csvintotable');

Route::post('workflow_sample', 'SharkController@workflow_sample')->name('user');




Route::get('routes', function () {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td><a href='".$value->uri()."'>" . $value->uri() . "</a></td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
});
