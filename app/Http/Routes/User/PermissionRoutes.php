<?php

Route::group(['prefix' => 'permissions', 'namespace' => 'User'], function(){
    Route::get('/', [
        'as' => 'permission-index',
        'uses' => 'PermissionController@index'
    ]);
    Route::get('/view/{id}', [
        'as' => 'permission-view',
        'uses' => 'PermissionController@show'
    ]);
    Route::get('/create', [
        'as' => 'permission-create',
        'uses' => 'PermissionController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'permission-edit',
        'uses' => 'PermissionController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'permission-delete',
        'uses' => 'PermissionController@destroy'
    ]);
    
    Route::post('/store', [
        'as' => 'permission-store',
        'uses' => 'PermissionController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'permission-update',
        'uses' => 'PermissionController@update'
    ]);
});
