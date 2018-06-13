<?php

Route::group(['prefix' => 'barcode'], function(){
    
    Route::get('/', [
        'as' => 'barcode-index',
        'uses' => 'BarcodeController@index'
    ]);
    
    Route::post('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Barcode(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });   
    
    Route::get('/print/{id}/{type}', [
        'as' => 'cetak-barcode',
        'uses' => 'BarcodeController@printBarcodePreview'
    ]);
    
});