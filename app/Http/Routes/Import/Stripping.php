<?php

Route::group(['prefix' => 'lcl/realisasi', 'namespace' => 'Import'], function(){
    
    Route::get('/stripping', [
        'as' => 'lcl-realisasi-stripping-index',
        'uses' => 'LclController@strippingIndex'
    ]);

});
