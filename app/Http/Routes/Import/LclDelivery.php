<?php

Route::group(['prefix' => 'lcl/delivery', 'namespace' => 'Import'], function(){
    
    Route::get('/behandle', [
        'as' => 'lcl-delivery-behandle-index',
        'uses' => 'LclController@behandleIndex'
    ]);
    Route::post('/behandle/edit/{id}', [
        'as' => 'lcl-delivery-behandle-update',
        'uses' => 'LclController@behandleUpdate'
    ]);
    // PRINT
    Route::get('/behandle/cetak/{id}', [
        'as' => 'lcl-behandle-cetak',
        'uses' => 'LclController@behandleCetak'
    ]);
    
    Route::get('/fiatmuat', [
        'as' => 'lcl-delivery-fiatmuat-index',
        'uses' => 'LclController@fiatmuatIndex'
    ]);
    Route::post('/fiatmuat/edit/{id}', [
        'as' => 'lcl-delivery-fiatmuat-update',
        'uses' => 'LclController@fiatmuatUpdate'
    ]);
    // PRINT
    Route::get('/fiatmuat/cetak/{id}', [
        'as' => 'lcl-delivery-fiatmuat-cetak',
        'uses' => 'LclController@fiatmuatCetak'
    ]);
    
    Route::get('/suratjalan', [
        'as' => 'lcl-delivery-suratjalan-index',
        'uses' => 'LclController@suratjalanIndex'
    ]);
    Route::post('/suratjalan/edit/{id}', [
        'as' => 'lcl-delivery-suratjalan-update',
        'uses' => 'LclController@suratjalanUpdate'
    ]);
    // PRINT
    Route::get('/suratjalan/cetak/{id}', [
        'as' => 'lcl-delivery-suratjalan-cetak',
        'uses' => 'LclController@suratjalanCetak'
    ]);
    
    Route::get('/release', [
        'as' => 'lcl-delivery-release-index',
        'uses' => 'LclController@releaseIndex'
    ]);
    Route::post('/release/edit/{id}', [
        'as' => 'lcl-delivery-release-update',
        'uses' => 'LclController@releaseUpdate'
    ]);
    
    // CREATE INVOICE
    Route::post('/release/invoice', [
        'as' => 'lcl-delivery-release-invoice',
        'uses' => 'LclController@releaseCreateInvoice'
    ]);
    
    // TPS ONLINE UPLOAD
    Route::post('/release/upload', [
        'as' => 'lcl-delivery-release-upload',
        'uses' => 'LclController@releaseUpload'
    ]);
    
});
