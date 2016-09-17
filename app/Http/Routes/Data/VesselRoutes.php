<?php

Route::group(['prefix' => 'vessel', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'vessel-index',
        'uses' => 'VesselController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Vessel()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/view/{id}', [
        'as' => 'vessel-view',
        'uses' => 'VesselController@show'
    ]);
    Route::get('/create', [
        'as' => 'vessel-create',
        'uses' => 'VesselController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'vessel-edit',
        'uses' => 'VesselController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'vessel-delete',
        'uses' => 'VesselController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'vessel-store',
        'uses' => 'VesselController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'vessel-update',
        'uses' => 'VesselController@update'
    ]); 
});