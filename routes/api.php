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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return 'test';
});
 */

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::get('/kota-kabupaten', 'Api\LocationController@GetKotaKab');
Route::get('/kecamatan/{kotakab_id}', 'Api\LocationController@GetKecamatan');
Route::get('/desa/{kecamatan_id}', 'Api\LocationController@GetDesa');


Route::middleware('auth:api')->group(function () {
    Route::get('/get-location', 'Api\LocationController@GetLocation');
    Route::post('/add-new-location', 'Api\LocationController@AddNewLocation');
    Route::get('/report', 'Api\ReportController@GetReport');
    Route::post('/report', 'Api\ReportController@PostReport');
    Route::get('/single-report/{id}', 'Api\ReportController@GetSingleReport');
    Route::post('/single-report/{id}', 'Api\ReportController@PostSingleReport');
});
