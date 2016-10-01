<?php

Route::group(['prefix' => 'lcl/realisasi', 'namespace' => 'Import'], function(){
    
    Route::get('/buangmty', [
        'as' => 'lcl-realisasi-buangmty-index',
        'uses' => 'LclController@buangmtyIndex'
    ]);
    Route::post('/buangmty/edit/{id}', [
        'as' => 'lcl-realisasi-buangmty-update',
        'uses' => 'LclController@buangmtyUpdate'
    ]);
});
