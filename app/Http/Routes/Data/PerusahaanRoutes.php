<?php

Route::group(['prefix' => 'perusahaan', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'perusahaan-index',
        'uses' => 'PerusahaanController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Perusahaan()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/view/{id}', [
        'as' => 'perusahaan-view',
        'uses' => 'PerusahaanController@show'
    ]);
    Route::get('/create', [
        'as' => 'perusahaan-create',
        'uses' => 'PerusahaanController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'perusahaan-edit',
        'uses' => 'PerusahaanController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'perusahaan-delete',
        'uses' => 'PerusahaanController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'perusahaan-store',
        'uses' => 'PerusahaanController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'perusahaan-update',
        'uses' => 'PerusahaanController@update'
    ]); 
});