<?php

Route::group(['prefix' => 'tpsonline/pelabuhandn', 'namespace' => 'Tps'], function(){
    
    Route::get('/', [
        'as' => 'pelabuhandn-index',
        'uses' => 'TpsOnlineController@pelabuhandnIndex'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsPelDn(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentTpsPelDn();

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