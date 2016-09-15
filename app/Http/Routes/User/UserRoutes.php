<?php

Route::group(['prefix' => 'users'], function(){
    Route::get('/', [
        'as' => 'user-index',
        'uses' => 'User\UserController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TabelsRepository(new App\User()), Illuminate\Support\Facades\Request::all());
    });
    Route::get('/view/{id}', [
        'as' => 'user-view',
        'uses' => 'User\UserController@show'
    ]);
    Route::get('/create', [
        'as' => 'user-create',
        'uses' => 'User\UserController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'user-edit',
        'uses' => 'User\UserController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'user-delete',
        'uses' => 'User\UserController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'user-store',
        'uses' => 'User\UserController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'user-update',
        'uses' => 'User\UserController@update'
    ]);   
    Route::get('/profile', [
        'as' => 'user-profile',
        'uses' => 'User\UserController@profile'
    ]);
    Route::post('/profile/updated', [
        'as' => 'user-profile-updated',
        'uses' => 'User\UserController@profileUpdated'
    ]);
});

