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
    return 'test';
});


Route::post('/register', 'Api\AuthController@register');
Route::get('/kota-kabupaten', 'Api\LocationController@GetKotaKab');
Route::get('/kecamatan/{kotakab_id}', 'Api\LocationController@GetKecamatan');
Route::get('/desa/{kecamatan_id}', 'Api\LocationController@GetDesa');

