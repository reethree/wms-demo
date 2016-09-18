<?php

Route::group(['prefix' => 'eseal', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'eseal-index',
        'uses' => 'EsealController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Eseal()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentEseal();

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
        'as' => 'eseal-view',
        'uses' => 'EsealController@show'
    ]);
    Route::get('/create', [
        'as' => 'eseal-create',
        'uses' => 'EsealController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'eseal-edit',
        'uses' => 'EsealController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'eseal-delete',
        'uses' => 'EsealController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'eseal-store',
        'uses' => 'EsealController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'eseal-update',
        'uses' => 'EsealController@update'
    ]); 
});