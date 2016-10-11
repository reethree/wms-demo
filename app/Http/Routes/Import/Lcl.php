<?php

Route::group(['prefix' => 'lcl', 'namespace' => 'Import'], function(){
    
    Route::get('/register', [
        'as' => 'lcl-register-index',
        'uses' => 'LclController@registerIndex'
    ]);
    Route::get('/joborder/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Joborder(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/register/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Container(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/register/create', [
        'as' => 'lcl-register-create',
        'uses' => 'LclController@registerCreate'
    ]);
    Route::post('/register/create', [
        'as' => 'lcl-register-store',
        'uses' => 'LclController@registerStore'
    ]);
    Route::get('/register/edit/{id}', [
        'as' => 'lcl-register-edit',
        'uses' => 'LclController@registerEdit'
    ]);
    Route::post('/register/edit/{id}', [
        'as' => 'lcl-register-update',
        'uses' => 'LclController@registerUpdate'
    ]);
    Route::get('/register/delete/{id}', [
        'as' => 'lcl-register-delete',
        'uses' => 'LclControllerController@destroy'
    ]);
    
    Route::post('/register/print-permohonan', [
        'as' => 'lcl-register-print-permohonan',
        'uses' => 'LclController@registerPrintPermohonan'
    ]);
});
