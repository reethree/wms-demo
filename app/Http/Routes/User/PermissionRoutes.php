<?php

Route::group(['prefix' => 'permissions'], function(){
    Route::get('/', [
        'as' => 'permission-index',
        'uses' => 'User\PermissionController@index'
    ]);
    Route::get('/view/{id}', [
        'as' => 'permission-view',
        'uses' => 'User\PermissionController@show'
    ]);
    Route::get('/create', [
        'as' => 'permission-create',
        'uses' => 'User\PermissionController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'permission-edit',
        'uses' => 'User\PermissionController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'permission-delete',
        'uses' => 'User\PermissionController@destroy'
    ]);
    
    Route::post('/store', [
        'as' => 'permission-store',
        'uses' => 'User\PermissionController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'permission-update',
        'uses' => 'User\PermissionController@update'
    ]);
});
