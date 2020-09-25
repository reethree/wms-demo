<?php

Route::group(['prefix' => 'nle/sp2', 'namespace' => 'Tps'], function(){
    
    Route::get('/', [
        'as' => 'nle-sp2-index',
        'uses' => 'NleController@index'
    ]);
    
    Route::post('/create', [
        'as' => 'nle-sp2-create',
        'uses' => 'NleController@create'
    ]);
    
    Route::get('/document', [
        'as' => 'nle-sp2-doc',
        'uses' => 'NleController@document'
    ]);
    
    Route::post('/document/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\NleSp2(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    
    Route::post('/document/subgrid-data', [
        'as' => 'nle-sp2-doc-subgrid',
        'uses' => 'NleController@getDataSubGrid'
    ]);
    
    Route::get('/document/upload/{id}', [
        'as' => 'nle-sp2-doc-upload',
        'uses' => 'NleController@documentUpload'
    ]);
});
