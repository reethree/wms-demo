<?php

Route::group(['prefix' => 'shippingline', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'shippingline-index',
        'uses' => 'ShippinglineController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Shippingline()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentShippingline();

        switch (Illuminate\Support\Facades\Request::get('oper'))
        {
          case 'add':
            return $Eloquent->create(Illuminate\Support\Facades\Request::except('id', 'oper'));
            break;
          case 'edit':
            return $Eloquent->update(Illuminate\Support\Facades\Request::get('id'), Illuminate\Support\Facades\Request::except('id', 'oper'));
            break;
          case 'del':
            return  $Eloquent->delete(Illuminate\Support\Facades\Request::get('id'));
            break;
        }
    });
    Route::get('/view/{id}', [
        'as' => 'shippingline-view',
        'uses' => 'ShippinglineController@show'
    ]);
    Route::get('/create', [
        'as' => 'shippingline-create',
        'uses' => 'ShippinglineController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'shippingline-edit',
        'uses' => 'ShippinglineController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'shippingline-delete',
        'uses' => 'ShippinglineController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'shippingline-store',
        'uses' => 'ShippinglineController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'shippingline-update',
        'uses' => 'ShippinglineController@update'
    ]); 
});