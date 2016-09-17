<?php

Route::group(['prefix' => 'consolidator', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'consolidator-index',
        'uses' => 'ConsolidatorController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Consolidator()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/view/{id}', [
        'as' => 'consolidator-view',
        'uses' => 'ConsolidatorController@show'
    ]);
    Route::get('/create', [
        'as' => 'consolidator-create',
        'uses' => 'ConsolidatorController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'consolidator-edit',
        'uses' => 'ConsolidatorController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'consolidator-delete',
        'uses' => 'ConsolidatorController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'consolidator-store',
        'uses' => 'ConsolidatorController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'consolidator-update',
        'uses' => 'ConsolidatorController@update'
    ]); 
});




