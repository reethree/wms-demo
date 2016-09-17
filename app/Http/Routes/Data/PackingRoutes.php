<?php

Route::group(['prefix' => 'packing', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'packing-index',
        'uses' => 'PackingController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Packing()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/view/{id}', [
        'as' => 'packing-view',
        'uses' => 'PackingController@show'
    ]);
    Route::get('/create', [
        'as' => 'packing-create',
        'uses' => 'PackingController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'packing-edit',
        'uses' => 'PackingController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'packing-delete',
        'uses' => 'PackingController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'packing-store',
        'uses' => 'PackingController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'packing-update',
        'uses' => 'PackingController@update'
    ]); 
});




