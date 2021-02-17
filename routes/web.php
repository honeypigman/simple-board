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
use Board;

/**
 * Index
 */
Route::get('/', 'AuthController@index');

/**
 *  Login  
 */ 
Route::prefix('auth')->group(function () {
    // Sign In
    Route::post('signin', 'AuthController@signin');

    // Sign Out
    Route::get('signout', 'AuthController@signout');
});

/**
 * Admin
 */
Route::prefix('admin')->group(function () {
    // Admin Index
    Route::get('/', 'AdminController@main')->middleware(AuthCheck::class);
    
    /////////////////////////////////////////////////////////////////////////////
    // Board Format - Action 
    Route::post('board/action/{tbl}', function($tbl){
        return Board::action($tbl);
    })->middleware(AuthCheck::class);

    // Board Format - Define
    //  - Route Set Table Name 
    Route::get('board', function(){
        $tbl = 'brdsim';
        return view('admin.board')->with('set', Board::template($tbl));
    })->middleware(AuthCheck::class);

    Route::get('access', function(){
        $tbl = 'acclog';
        return view('admin.board')->with('set', Board::template($tbl));
    })->middleware(AuthCheck::class);

    Route::get('users', function(){
        $tbl = 'usrlst';
        return view('admin.board')->with('set', Board::template($tbl));
    })->middleware(AuthCheck::class);

    /////////////////////////////////////////////////////////////////////////////

    Route::get('setting', function(){
        return view('admin/setting');
    })->middleware(AuthCheck::class);
});

/**
 * Common
 */
Route::prefix('cmm')->group(function(){
    //Route::get('page', 'CommonController@getPage');
});