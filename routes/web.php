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
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    echo 'storage-link complete';
});
Route::get('/update-app', function () {
    Artisan::call('dump-autoload');
    echo 'dump-autoload complete';
});

Route::get('/clear-cache', function () {
Artisan::call('config:clear');

Artisan::call('cache:clear');
echo 'cache-clear';
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::group(['middleware' => ['guest','auth']], function(){
    Route::get('/', function () {
        if(Auth::user()->role->role_id == '1'){
            return redirect('/admin-panel');
        }else{
            return view('auth.login');
        }
    }); 
});  
Route::group(['prefix'=> 'admin-panel', 'as'=> 'admin-panel' . '.', 'middleware' => ['admin']], function(){
    Route::get('/get-pelaksana/{kotakab_id}', 'HomeController@ajaxGetPelaksana');
    Route::post('/filter', 'HomeController@postFilter')->name('filter');
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::put('/verifikasi', 'HomeController@verifikasi')->name('verifikasi');
    Route::get('/laporan-harian/{lokasi_id}/{dtarray}', 'HomeController@LaporanHarian')->name('laporan-harian');
    Route::get('/laporan-kumulatif', 'HomeController@LaporanKumulatif')->name('laporan-kumulatif');
    Route::get('/laporan-kumulatif/{kotakab_id}', 'HomeController@LaporanKumulatifDetail')->name('laporan-kumulatif-detail');
});