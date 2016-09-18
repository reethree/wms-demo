<?php

Route::group(['prefix' => 'tpp', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'tpp-index',
        'uses' => 'TppController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Tpp()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentTpp();

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
        'as' => 'tpp-view',
        'uses' => 'TppController@show'
    ]);
    Route::get('/create', [
        'as' => 'tpp-create',
        'uses' => 'TppController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'tpp-edit',
        'uses' => 'TppController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'tpp-delete',
        'uses' => 'TppController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'tpp-store',
        'uses' => 'TppController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'tpp-update',
        'uses' => 'TppController@update'
    ]); 
});