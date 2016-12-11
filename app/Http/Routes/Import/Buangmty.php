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
    
    // PRINT
    Route::get('/buangmty/cetak/{id}/{type}', [
        'as' => 'lcl-buangmty-cetak',
        'uses' => 'LclController@buangmtyCetak'
    ]);
    
    // TPS ONLINE UPLOAD
    Route::post('/buangmty/upload', [
        'as' => 'lcl-buangmty-upload',
        'uses' => 'LclController@buangmtyUpload'
    ]);
});
