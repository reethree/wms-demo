<?php

Route::group(['prefix' => 'roles'], function(){
    Route::get('/', [
        'as' => 'role-index',
        'uses' => 'User\RolesController@index'
    ]);
    Route::get('/view/{id}', [
        'as' => 'role-view',
        'uses' => 'User\RolesController@show'
    ]);
    Route::get('/create', [
        'as' => 'role-create',
        'uses' => 'User\RolesController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'role-edit',
        'uses' => 'User\RolesController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'role-delete',
        'uses' => 'User\RolesController@destroy'
    ]);
    
    Route::post('/store', [
        'as' => 'role-store',
        'uses' => 'User\RolesController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'role-update',
        'uses' => 'User\RolesController@update'
    ]);
    Route::post('/update/permission/{id}', [
        'as' => 'role-permission-update',
        'uses' => 'User\RolesController@updatePermission'
    ]);  
});

