<?php

Route::group(['prefix' => 'lcl', 'namespace' => 'Import'], function(){
    
    Route::get('/register', [
        'as' => 'lcl-register-index',
        'uses' => 'LclController@registerIndex'
    ]);
    Route::get('/register/create', [
        'as' => 'lcl-register-create',
        'uses' => 'LclController@registerCreate'
    ]);
    Route::post('/register/create', [
        'as' => 'lcl-register-store',
        'uses' => 'LclController@registerStore'
    ]);
    Route::get('/register/edit/{id}', [
        'as' => 'lcl-register-edit',
        'uses' => 'LclController@registerEdit'
    ]);
    Route::post('/register/edit/{id}', [
        'as' => 'lcl-register-update',
        'uses' => 'LclController@registerUpdate'
    ]);
});
