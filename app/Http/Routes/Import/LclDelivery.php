<?php

Route::group(['prefix' => 'lcl/delivery', 'namespace' => 'Import'], function(){
    
    Route::get('/behandle', [
        'as' => 'lcl-delivery-behandle-index',
        'uses' => 'LclController@behandleIndex'
    ]);
    
    Route::get('/fiatmuat', [
        'as' => 'lcl-delivery-fiatmuat-index',
        'uses' => 'LclController@fiatmuatIndex'
    ]);
    
    Route::get('/suratjalan', [
        'as' => 'lcl-delivery-suratjalan-index',
        'uses' => 'LclController@suratjalanIndex'
    ]);
    
    Route::get('/release', [
        'as' => 'lcl-delivery-release-index',
        'uses' => 'LclController@releaseIndex'
    ]);
    
});
