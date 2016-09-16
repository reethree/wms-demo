<?php

Route::group(['middleware' => ['auth']], function(){
    
    Route::get('/', [
        'as' => 'index',
        'uses' => 'DashboardController@index'
    ]);

    // Logout Routes
    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'Auth\AuthController@logout'
    ]);
    
    // Consolidator Routes
    require_once 'Data/ConsolidatorRoutes.php';
    
    // User Routes
    require_once 'User/UserRoutes.php';

    // Role Routes
    require_once 'User/RoleRoutes.php';

    // Permission Routes
    require_once 'User/PermissionRoutes.php';
    
});