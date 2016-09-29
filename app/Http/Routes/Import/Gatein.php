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
