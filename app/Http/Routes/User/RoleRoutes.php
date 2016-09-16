<?php

Route::group(['prefix' => 'roles', 'namespace' => 'User'], function(){
    Route::get('/', [
        'as' => 'role-index',
        'uses' => 'RolesController@index'
    ]);
    Route::get('/view/{id}', [
        'as' => 'role-view',
        'uses' => 'RolesController@show'
    ]);
    Route::get('/create', [
        'as' => 'role-create',
        'uses' => 'RolesController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'role-edit',
        'uses' => 'RolesController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'role-delete',
        'uses' => 'RolesController@destroy'
    ]);
    
    Route::post('/store', [
        'as' => 'role-store',
        'uses' => 'RolesController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'role-update',
        'uses' => 'RolesController@update'
    ]);
    Route::post('/update/permission/{id}', [
        'as' => 'role-permission-update',
        'uses' => 'RolesController@updatePermission'
    ]);  
});

