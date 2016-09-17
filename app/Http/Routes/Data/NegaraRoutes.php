<?php

Route::group(['prefix' => 'negara', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'negara-index',
        'uses' => 'NegaraController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Negara()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/view/{id}', [
        'as' => 'negara-view',
        'uses' => 'NegaraController@show'
    ]);
    Route::get('/create', [
        'as' => 'negara-create',
        'uses' => 'NegaraController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'negara-edit',
        'uses' => 'NegaraController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'negara-delete',
        'uses' => 'NegaraController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'negara-store',
        'uses' => 'NegaraController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'negara-update',
        'uses' => 'NegaraController@update'
    ]); 
});




