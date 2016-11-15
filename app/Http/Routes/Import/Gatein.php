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
});