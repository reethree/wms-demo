<?php

Route::group(['prefix' => 'easygo'], function(){
    
    Route::get('/', [
        'as' => 'easygo-index',
        'uses' => 'EasygoController@index'
    ]);
    
    Route::post('/inputdo', [
        'as' => 'easygo-inputdo',
        'uses' => 'EasygoController@vts_inputdo'
    ]);
    
    Route::post('/inputdo/callback', [
        'as' => 'easygo-inputdo-callback',
        'uses' => 'EasygoController@vts_inputdo_callback'
    ]);
    
    Route::get('/dispatche', [
        'as' => 'lcl-dispatche-index',
        'uses' => 'LclController@dispatcheIndex'
    ]);
    
    Route::get('/dispatche/get-detail/{ob_id}', [
        'as' => 'easygo-get-detail',
        'uses' => 'EasygoController@getDetailDispatche'
    ]);

});