<?php

Route::group(['prefix' => 'lokasisandar', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'lokasisandar-index',
        'uses' => 'LokasisandarController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Lokasisandar()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $EloquentLokasisandar = new \App\Models\Eloquent\EloquentLokasisandar();

        switch (Illuminate\Support\Facades\Request::get('oper'))
        {
          case 'add':
            return $EloquentLokasisandar->create(Illuminate\Support\Facades\Request::except('id', 'oper'));
            break;
          case 'edit':
            return $EloquentLokasisandar->update(Illuminate\Support\Facades\Request::get('id'), Illuminate\Support\Facades\Request::except('id', 'oper'));
            break;
          case 'del':
            return  $EloquentLokasisandar->delete(Illuminate\Support\Facades\Request::get('id'));
            break;
        }
    });
    Route::get('/view/{id}', [
        'as' => 'lokasisandar-view',
        'uses' => 'LokasisandarController@show'
    ]);
    Route::get('/create', [
        'as' => 'lokasisandar-create',
        'uses' => 'LokasisandarController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'lokasisandar-edit',
        'uses' => 'LokasisandarController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'lokasisandar-delete',
        'uses' => 'LokasisandarController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'lokasisandar-store',
        'uses' => 'LokasisandarController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'lokasisandar-update',
        'uses' => 'LokasisandarController@update'
    ]); 
});




