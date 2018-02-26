<?php

Route::group(['prefix' => 'payment', 'namespace' => 'Payment'], function(){
    
    Route::get('/', [
        'as' => 'payment-bni-index',
        'uses' => 'PaymentController@index'
    ]);
    
    Route::get('/edit/{id}', [
        'as' => 'payment-bni-edit',
        'uses' => 'PaymentController@edit'
    ]);
    
    Route::post('/create-billing', [
        'as' => 'payment-bni-create-billing',
        'uses' => 'PaymentController@createBilling'
    ]);
    
    Route::post('/inquiry', [
        'as' => 'payment-bni-inquiry',
        'uses' => 'PaymentController@inquiryBilling'
    ]);
    
    Route::post('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\PaymentTablesRepository(new App\Models\PaymentBni(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });   
    
    Route::post('/bni/notification', [
        'as' => 'payment-bni-notification',
        'uses' => 'PaymentController@bniNotification'
    ]);
    
});