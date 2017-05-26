<?php

Route::group(['prefix' => 'vessel', 'namespace' => 'Data'], function(){
    
    Route::get('/', [
        'as' => 'vessel-index',
        'uses' => 'VesselController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Vessel()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentVessel();

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
        'as' => 'vessel-view',
        'uses' => 'VesselController@show'
    ]);
    Route::get('/create', [
        'as' => 'vessel-create',
        'uses' => 'VesselController@create'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'vessel-edit',
        'uses' => 'VesselController@edit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'vessel-delete',
        'uses' => 'VesselController@destroy'
    ]);
    Route::post('/store', [
        'as' => 'vessel-store',
        'uses' => 'VesselController@store'
    ]);
    Route::post('/update/{id}', [
        'as' => 'vessel-update',
        'uses' => 'VesselController@update'
    ]); 
});