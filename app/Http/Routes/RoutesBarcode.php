<?php

Route::group(['prefix' => 'barcode'], function(){
    
    Route::get('/', [
        'as' => 'barcode-index',
        'uses' => 'BarcodeController@index'
    ]);
    
    Route::get('/view/{id}', [
        'as' => 'barcode-view',
        'uses' => 'BarcodeController@view'
    ]);
    
    Route::post('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Barcode(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });   
    
    Route::get('/print/{id}/{type}/{action}', [
        'as' => 'cetak-barcode',
        'uses' => 'BarcodeController@printBarcodePreview'
    ]);
    
});