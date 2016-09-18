<?php

Route::group(['prefix' => 'pelabuhan', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'pelabuhan-index',
        'uses' => 'PelabuhanController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Pelabuhan()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentPelabuhan();

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
        'as' => 'pelabuhan-view',
        'uses' => 'PelabuhanController@show'
    ]);
    Route::get('/create', [
        'as' => 'pelabuhan-create',
        'uses' => 'PelabuhanController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'pelabuhan-edit',
        'uses' => 'PelabuhanController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'pelabuhan-delete',
        'uses' => 'PelabuhanController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'pelabuhan-store',
        'uses' => 'PelabuhanController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'pelabuhan-update',
        'uses' => 'PelabuhanController@update'
    ]); 
});




