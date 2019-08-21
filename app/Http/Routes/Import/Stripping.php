<?php

Route::group(['prefix' => 'lcl/realisasi', 'namespace' => 'Import'], function(){
    
    Route::get('/stripping', [
        'as' => 'lcl-realisasi-stripping-index',
        'uses' => 'LclController@strippingIndex'
    ]);
    Route::post('/stripping/edit/{id}', [
        'as' => 'lcl-realisasi-stripping-update',
        'uses' => 'LclController@strippingUpdate'
    ]);
    Route::get('/stripping/update/{id}', [
        'as' => 'lcl-realisasi-stripping-approve',
        'uses' => 'LclController@strippingApprove'
    ]);
    
    Route::get('/stripping/view-photo-bl/{id}', [
        'as' => 'lcl-realisasi-stripping-view-photo-bl',
        'uses' => 'LclController@strippingViewPhotoBl'
    ]);
    
    // UPLOAD PHOTO
    Route::post('/stripping/upload/photo', [
        'as' => 'lcl-stripping-upload-photo',
        'uses' => 'LclController@strippingUploadPhoto'
    ]);
});
