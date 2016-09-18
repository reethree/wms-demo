<?php

Route::group(['prefix' => 'depomty', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'depomty-index',
        'uses' => 'DepomtyController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Depomty()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentDepomty();

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
        'as' => 'depomty-view',
        'uses' => 'DepomtyController@show'
    ]);
    Route::get('/create', [
        'as' => 'depomty-create',
        'uses' => 'DepomtyController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'depomty-edit',
        'uses' => 'DepomtyController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'depomty-delete',
        'uses' => 'DepomtyController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'depomty-store',
        'uses' => 'DepomtyController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'depomty-update',
        'uses' => 'DepomtyController@update'
    ]); 
});




