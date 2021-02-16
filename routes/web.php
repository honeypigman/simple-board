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
use App\Http\Middleware\AuthCheck;

Route::get('/', 'AuthController@index');

// Login
Route::prefix('auth')->group(function () {
    Route::post('signin', 'AuthController@signin');
    Route::get('signout', 'AuthController@signout');
});

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@main')->middleware(AuthCheck::class);
    
    Route::get('board', function(){
        return view('admin.board');
    })->middleware(AuthCheck::class);
    Route::post('board/action', 'BoardController@action')->middleware(AuthCheck::class);

    Route::get('users', 'AdminController@users')->middleware(AuthCheck::class);
    Route::get('access', 'AdminController@accessLog')->middleware(AuthCheck::class);

    Route::get('setting', function(){
        return view('admin/setting');
    })->middleware(AuthCheck::class);
});

//Common
Route::prefix('cmm')->group(function(){
    //Route::get('page', 'CommonController@getPage');
});