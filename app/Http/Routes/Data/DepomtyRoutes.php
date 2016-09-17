<?php

Route::group(['prefix' => 'depomty', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'depomty-index',
        'uses' => 'DepomtyController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Depomty()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/view/{id}', [
        'as' => 'depomty-view',
        'uses' => 'DepomtyController@show'
    ]);
    Route::get('/create', [
        'as' => 'depomty-create',
        'uses' => 'DepomtyController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'depomty-edit',
        'uses' => 'DepomtyController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'depomty-delete',
        'uses' => 'DepomtyController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'depomty-store',
        'uses' => 'DepomtyController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'depomty-update',
        'uses' => 'DepomtyController@update'
    ]); 
});




