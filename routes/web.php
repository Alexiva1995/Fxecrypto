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
Route::get('tree', function(){
    	return view('tree');
    });
Route::group(['middleware' => 'https'], function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');
    
    Auth::routes();

    Route::get('save-session/{wallet}', 'CheckController@save_session');
    Route::get('check-session', 'CheckController@check_session');
    Route::get('delete-session', 'CheckController@delete_session')->name('logout');
    
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('dashboard', function(){
        return view('dashboard');
    });

    Route::get('dashboard/smart-business-3/{level}', 'CheckController@smart_business_3_details')->name('smart-business-3-details');
    Route::get('dashboard/smart-business-6/{level}', 'CheckController@smart_business_6_details')->name('smart-business-6-details');
});


Route::get('tron', function(){
    return view('tron');
});