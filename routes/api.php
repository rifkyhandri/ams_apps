<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('get_asset_tagnumber/{tagnumber}', 'API\AssetController@get_asset_tagnumber');
    Route::get('get_asset','API\AssetController@get_asset');
    Route::post('post_asset','API\AssetController@store');
    Route::post('update_asset/{tangnumber}/update','API\AssetController@update');

    // Relocation 
    
});

