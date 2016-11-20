<?php

Route::group(['prefix' => 'tpsonline/pengiriman', 'namespace' => 'Tps'], function(){
    
    // COARI
    Route::get('/coari-cont', [
        'as' => 'tps-coariCont-index',
        'uses' => 'PengirimanController@coariContIndex'
    ]);
    Route::get('/coari-kms', [
        'as' => 'tps-coariKms-index',
        'uses' => 'PengirimanController@coariKmsIndex'
    ]);
    
    // CODECO
    Route::get('/codeco-cont-fcl', [
        'as' => 'tps-codecoContFcl-index',
        'uses' => 'PengirimanController@codecoContFclIndex'
    ]);
    Route::get('/codeco-cont-buang-mty', [
        'as' => 'tps-codecoContBuangMty-index',
        'uses' => 'PengirimanController@codecoContBuangMtyIndex'
    ]);
    Route::get('/codeco-kms', [
        'as' => 'tps-codecoKms-index',
        'uses' => 'PengirimanController@codecoKmsIndex'
    ]);
    
});

