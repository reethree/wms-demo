<?php

Route::group(['prefix' => 'tpsonline/pelabuhanln', 'namespace' => 'Tps'], function(){
    
    Route::get('/', [
        'as' => 'pelabuhanln-index',
        'uses' => 'TpsOnlineController@pelabuhanlnIndex'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsPelLn(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentTpsPelLn();

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
});