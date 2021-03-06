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
Route::post('/upload', 'QiniuController@upload');
Route::get('/allcase', 'VideoController@allCase');
Route::post('/addcase','VideoController@addCase');
Route::post('/addvideo','VideoController@addVideo');
Route::get('/allvideo/{id}', 'VideoController@allVideo');
Route::post('/getvideo','QiniuController@getVideo');
Route::post('/addsmallvideo','VideoController@addSmallvidedo');
Route::get('/allsmallvideo/{id}', 'VideoController@allSmallvideo');
Route::get('/lockvideo/{id}', 'VideoController@lockVideo');
Route::get('/finishvideo/{id}', 'VideoController@finishVideo');
