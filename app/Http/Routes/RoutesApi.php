<?php

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function(){
    Route::get('/getSppbOnline', [
        'as' => 'nle-get-sppb',
        'uses' => 'NleController@getSppbOnline'
    ]);
    Route::post('/requestInvoice', [
        'as' => 'nle-request-invoice',
        'uses' => 'NleController@requestInvoiceForPlatform'
    ]);
    Route::post('/requestSppb', [
        'as' => 'nle-request-sppb',
        'uses' => 'NleController@requestSppb'
    ]);
});