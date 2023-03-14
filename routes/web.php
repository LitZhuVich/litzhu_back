<?php

use Illuminate\Support\Facades\Route;

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
    // return view('welcome');
    return 'index';
});

Route::get('/user',function(){
    return '1';
});

Route::get('/v1/user', [\App\Http\Controllers\Api\ApiUserController::class,'index']);