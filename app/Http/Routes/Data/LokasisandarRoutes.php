<?php

Route::group(['prefix' => 'lokasisandar', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'lokasisandar-index',
        'uses' => 'LokasisandarController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Lokasisandar()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/view/{id}', [
        'as' => 'lokasisandar-view',
        'uses' => 'LokasisandarController@show'
    ]);
    Route::get('/create', [
        'as' => 'lokasisandar-create',
        'uses' => 'LokasisandarController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'lokasisandar-edit',
        'uses' => 'LokasisandarController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'lokasisandar-delete',
        'uses' => 'LokasisandarController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'lokasisandar-store',
        'uses' => 'LokasisandarController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'lokasisandar-update',
        'uses' => 'LokasisandarController@update'
    ]); 
});




