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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('get-states', 'LocationAPIController@states');

Route::post('get-lga', 'LocationAPIController@lga');
Route::get("allstaff/{id}", "ApiController@getStaffOfficeById");


//getOffences
Route::post('getOffences', 'ApiController@getOffences')->name('getOffences');



Route::post('loadParent', 'ApiController@loadParent')->name('loadParent');
//loadType
