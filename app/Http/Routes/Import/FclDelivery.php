<?php

Route::group(['prefix' => 'fcl/delivery', 'namespace' => 'Import'], function(){
    
    Route::get('/behandle', [
        'as' => 'fcl-delivery-behandle-index',
        'uses' => 'FclController@behandleIndex'
    ]);
    Route::post('/behandle/edit/{id}', [
        'as' => 'fcl-delivery-behandle-update',
        'uses' => 'FclController@behandleUpdate'
    ]);
    Route::post('/behandle/ready/{id}', [
        'as' => 'fcl-delivery-behandle-ready',
        'uses' => 'FclController@behandleReady'
    ]);
    // PRINT
    Route::get('/behandle/cetak/{id}', [
        'as' => 'fcl-behandle-cetak',
        'uses' => 'FclController@behandleCetak'
    ]);
    
    Route::get('/fiatmuat', [
        'as' => 'fcl-delivery-fiatmuat-index',
        'uses' => 'FclController@fiatmuatIndex'
    ]);
    Route::post('/fiatmuat/edit/{id}', [
        'as' => 'fcl-delivery-fiatmuat-update',
        'uses' => 'FclController@fiatmuatUpdate'
    ]);
    // PRINT
    Route::get('/fiatmuat/cetak/{id}', [
        'as' => 'fcl-delivery-fiatmuat-cetak',
        'uses' => 'FclController@fiatmuatCetak'
    ]);
    
    Route::get('/suratjalan', [
        'as' => 'fcl-delivery-suratjalan-index',
        'uses' => 'FclController@suratjalanIndex'
    ]);
    Route::post('/suratjalan/edit/{id}', [
        'as' => 'fcl-delivery-suratjalan-update',
        'uses' => 'FclController@suratjalanUpdate'
    ]);
    // PRINT
    Route::get('/suratjalan/cetak/{id}', [
        'as' => 'fcl-delivery-suratjalan-cetak',
        'uses' => 'FclController@suratjalanCetak'
    ]);
    
    Route::get('/release', [
        'as' => 'fcl-delivery-release-index',
        'uses' => 'FclController@releaseIndex'
    ]);
    Route::post('/release/edit/{id}', [
        'as' => 'fcl-delivery-release-update',
        'uses' => 'FclController@releaseUpdate'
    ]);
    
    // CREATE INVOICE
    Route::post('/release/invoice', [
        'as' => 'fcl-delivery-release-invoice-nct',
        'uses' => 'FclController@releaseCreateInvoice'
    ]);
    
    // TPS ONLINE UPLOAD
    Route::post('/release/upload', [
        'as' => 'fcl-delivery-release-upload',
        'uses' => 'FclController@releaseUpload'
    ]);
    
    // GET DATA SPPB
    Route::post('/release/getdatasppb', [
        'as' => 'fcl-delivery-release-getdatasppb',
        'uses' => 'FclController@releaseGetDataSppb'
    ]);
    
    // UPLOAD PHOTO
    Route::post('/release/upload/photo', [
        'as' => 'fcl-release-upload-photo',
        'uses' => 'FclController@releaseUploadPhoto'
    ]);
    Route::post('/behandle/upload/photo', [
        'as' => 'fcl-behandle-upload-photo',
        'uses' => 'FclController@behandleUploadPhoto'
    ]);
    
});
