<?php

Route::group(['prefix' => 'lcl/realisasi', 'namespace' => 'Import'], function(){
    
    Route::get('/stripping', [
        'as' => 'lcl-realisasi-stripping-index',
        'uses' => 'LclController@strippingIndex'
    ]);
    Route::post('/stripping/edit/{id}', [
        'as' => 'lcl-realisasi-stripping-update',
        'uses' => 'LclController@strippingUpdate'
    ]);
});
