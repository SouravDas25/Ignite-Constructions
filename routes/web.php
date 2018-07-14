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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    $goods = \App\Good::find(2);
    $godown = \App\Godown::find(1);
    
    return $godown->hasGoods($goods);
});

Route::get('/test2', function () {
    $goods = \App\Good::find(2);
    $godown = \App\Godown::find(1);
    return $godown->getTransferableID($goods);
});

Route::get('/test3', function () {
    $goods = \App\Good::find(2);
    $godown = \App\Godown::find(1);
    $site = \App\Site::find(1);
    $labour = \App\Labour::find(1);
    //\App\Site::newTransfer($godown,$goods,$site,$labour,2);
    return "Success";
});


Route::get('/admin/godowns/incoming/{id}','GodownsController@incoming')->name('voyager.godowns.incoming');
Route::get('/admin/godowns/outgoing/{id}','GodownsController@outgoing')->name('voyager.godowns.outgoing');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/site-transfers/complete/{id}', 'SiteTransfersController@complete')->name('voyager.site-transfers.complete');
    Route::get('/site-transfers/confirm/{id}', 'SiteTransfersController@confirm')->name('voyager.site-transfers.confirm');
    Voyager::routes(); 
});

