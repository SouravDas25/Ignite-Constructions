<?php

use Illuminate\Http\Request;

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

Route::post('/updateLocation', 'TrackingController@updateLocation')->name('api.updateLocation');
Route::get('/getTransferDetails', 'ApiController@getTransferDetails')->name('api.getTransferDetails');
Route::post('/verifyUser', 'ApiController@verifyUser')->name('api.verifyUser');
Route::get('/getTransferJob', 'ApiController@getTransferJob')->name('api.getTransferJob');
Route::post('/confirmTransferJob', 'ApiController@confirmTransferJob')->name('api.confirmTransferJob');
Route::post('/completeTransferJob', 'ApiController@completeTransferJob')->name('api.completeTransferJob');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
