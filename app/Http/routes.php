<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::group(['middleware' => ['web']], function(){
    
    Route::group(['middleware' => ['guest'], 'namespace' => 'Auth'], function(){
        
        // Login Routes
        Route::get('/login', [
            'as' => 'login',
            'uses' => 'AuthController@getLogin'
        ]);
        Route::post('/login', [
            'as' => 'login',
            'uses' => 'AuthController@postLogin'
        ]);
        
    });
    
    Route::group(['middleware' => ['auth']], function(){
        
        // Dashboard Routes
        Route::get('/', [
            'as' => 'index',
            'uses' => 'DashboardController@index'
        ]);
        // Logout Routes
        Route::get('/logout', [
            'as' => 'logout',
            'uses' => 'Auth\AuthController@logout'
        ]);
        
        // User Routes
        require_once 'Routes/RoutesUser.php';
        
        // Data Routes
        require_once 'Routes/RoutesData.php';
        
    });
    
    
    
//});
