<?php

Route::group(['prefix' => 'packing', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'packing-index',
        'uses' => 'PackingController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Packing()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentPacking();

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
        'as' => 'packing-view',
        'uses' => 'PackingController@show'
    ]);
    Route::get('/create', [
        'as' => 'packing-create',
        'uses' => 'PackingController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'packing-edit',
        'uses' => 'PackingController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'packing-delete',
        'uses' => 'PackingController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'packing-store',
        'uses' => 'PackingController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'packing-update',
        'uses' => 'PackingController@update'
    ]); 
});




