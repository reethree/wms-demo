<?php

Route::group(['prefix' => 'lcl/realisasi', 'namespace' => 'Import'], function(){
    
    Route::get('/buangmty', [
        'as' => 'lcl-realisasi-buangmty-index',
        'uses' => 'LclController@buangmtyIndex'
    ]);

});
