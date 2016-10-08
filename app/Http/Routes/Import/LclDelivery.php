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
    
    Route::get('/fiatmuat', [
        'as' => 'lcl-delivery-fiatmuat-index',
        'uses' => 'LclController@fiatmuatIndex'
    ]);
    Route::post('/fiatmuat/edit/{id}', [
        'as' => 'lcl-delivery-fiatmuat-update',
        'uses' => 'LclController@fiatmuatUpdate'
    ]);
    
    Route::get('/suratjalan', [
        'as' => 'lcl-delivery-suratjalan-index',
        'uses' => 'LclController@suratjalanIndex'
    ]);
    Route::post('/suratjalan/edit/{id}', [
        'as' => 'lcl-delivery-suratjalan-update',
        'uses' => 'LclController@suratjalanUpdate'
    ]);
    
    Route::get('/release', [
        'as' => 'lcl-delivery-release-index',
        'uses' => 'LclController@releaseIndex'
    ]);
    Route::post('/release/edit/{id}', [
        'as' => 'lcl-delivery-release-update',
        'uses' => 'LclController@releaseUpdate'
    ]);
    
});
