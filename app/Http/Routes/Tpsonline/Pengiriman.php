<?php

Route::group(['prefix' => 'tpsonline/pengiriman', 'namespace' => 'Tps'], function(){
    
    // COARI CONT
    Route::get('/coari-cont', [
        'as' => 'tps-coariCont-index',
        'uses' => 'PengirimanController@coariContIndex'
    ]);
    Route::get('/coari-cont/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsCoariCont(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/coari-cont/edit/{id}', [
        'as' => 'tps-coariCont-edit',
        'uses' => 'PengirimanController@coariContEdit'
    ]);
    Route::post('/coari-cont/edit/{id}', [
        'as' => 'tps-coariCont-update',
        'uses' => 'PengirimanController@coariContUpdate'
    ]);
    
    // COARI KMS
    Route::get('/coari-kms', [
        'as' => 'tps-coariKms-index',
        'uses' => 'PengirimanController@coariKmsIndex'
    ]);
    Route::get('/coari-kms/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsCoariKms(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/coari-kms/edit/{id}', [
        'as' => 'tps-coariKms-edit',
        'uses' => 'PengirimanController@coariKmsEdit'
    ]);
    Route::post('/coari-kms/edit/{id}', [
        'as' => 'tps-coariKms-update',
        'uses' => 'PengirimanController@coariKmsUpdate'
    ]);
    
    // CODECO FCL
    Route::get('/codeco-cont-fcl', [
        'as' => 'tps-codecoContFcl-index',
        'uses' => 'PengirimanController@codecoContFclIndex'
    ]);
    Route::get('/codeco-cont-fcl/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsCodecoContFcl(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/codeco-cont-fcl/edit/{id}', [
        'as' => 'tps-codecoContFcl-edit',
        'uses' => 'PengirimanController@codecoContFclEdit'
    ]);
    Route::post('/codeco-cont-fcl/edit/{id}', [
        'as' => 'tps-codecoContFcl-update',
        'uses' => 'PengirimanController@codecoContFclUpdate'
    ]);
    
    // CODECO Buang MTY
    Route::get('/codeco-cont-buang-mty', [
        'as' => 'tps-codecoContBuangMty-index',
        'uses' => 'PengirimanController@codecoContBuangMtyIndex'
    ]);
    Route::get('/codeco-cont-buang-mty/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsCodecoContBuangMty(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/codeco-cont-buang-mty/edit/{id}', [
        'as' => 'tps-codecoContBuangMty-edit',
        'uses' => 'PengirimanController@codecoContBuangMtyEdit'
    ]);
    Route::post('/codeco-cont-buang-mty/edit/{id}', [
        'as' => 'tps-codecoContBuangMty-update',
        'uses' => 'PengirimanController@codecoContBuangMtyUpdate'
    ]);
    
    // CODECO KMS
    Route::get('/codeco-kms', [
        'as' => 'tps-codecoKms-index',
        'uses' => 'PengirimanController@codecoKmsIndex'
    ]);
        Route::get('/codeco-kms/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsCodecoKms(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/codeco-kms/edit/{id}', [
        'as' => 'tps-codecoKms-edit',
        'uses' => 'PengirimanController@codecoKmsEdit'
    ]);
    Route::post('/codeco-kms/edit/{id}', [
        'as' => 'tps-codecoKms-update',
        'uses' => 'PengirimanController@codecoKmsUpdate'
    ]);
    
});

