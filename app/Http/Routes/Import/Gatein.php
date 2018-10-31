<?php

Route::group(['prefix' => 'lcl/realisasi', 'namespace' => 'Import'], function(){
    
    Route::get('/gatein', [
        'as' => 'lcl-realisasi-gatein-index',
        'uses' => 'LclController@gateinIndex'
    ]);
    Route::post('/gatein/edit/{id}', [
        'as' => 'lcl-realisasi-gatein-update',
        'uses' => 'LclController@gateinUpdate'
    ]);
    
    // TPS ONLINE UPLOAD
    Route::post('/gatein/upload', [
        'as' => 'lcl-realisasi-gatein-upload',
        'uses' => 'LclController@gateinUpload'
    ]);
    
    // UPLOAD PHOTO
    Route::post('/gatein/upload/photo', [
        'as' => 'lcl-gatein-upload-photo',
        'uses' => 'LclController@gateinUploadPhoto'
    ]);
    
});

Route::group(['prefix' => 'fcl/realisasi', 'namespace' => 'Import'], function(){
    
    Route::get('/gatein', [
        'as' => 'fcl-realisasi-gatein-index',
        'uses' => 'FclController@gateinIndex'
    ]);
    Route::post('/gatein/edit/{id}', [
        'as' => 'fcl-realisasi-gatein-update',
        'uses' => 'FclController@gateinUpdate'
    ]);
    
    // TPS ONLINE UPLOAD
    Route::post('/gatein/upload', [
        'as' => 'fcl-realisasi-gatein-upload',
        'uses' => 'FclController@gateinUpload'
    ]);
    
        // UPLOAD PHOTO
    Route::post('/gatein/upload/photo', [
        'as' => 'fcl-gatein-upload-photo',
        'uses' => 'FclController@gateinUploadPhoto'
    ]);
    
});