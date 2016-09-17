<?php

Route::group(['prefix' => 'users', 'namespace' => 'User'], function(){
    Route::get('/', [
        'as' => 'user-index',
        'uses' => 'UserController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new \App\User()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/view/{id}', [
        'as' => 'user-view',
        'uses' => 'UserController@show'
    ]);
    Route::get('/create', [
        'as' => 'user-create',
        'uses' => 'UserController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'user-edit',
        'uses' => 'UserController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'user-delete',
        'uses' => 'UserController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'user-store',
        'uses' => 'UserController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'user-update',
        'uses' => 'UserController@update'
    ]);   
    Route::get('/profile', [
        'as' => 'user-profile',
        'uses' => 'UserController@profile'
    ]);
    Route::post('/profile/updated', [
        'as' => 'user-profile-updated',
        'uses' => 'UserController@profileUpdated'
    ]);
});

