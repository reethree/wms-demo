<?php

Route::group(['prefix' => 'tpsonline/report', 'namespace' => 'Tps'], function(){
    
    Route::get('/demo/get-xml', [
        'as' => 'tps-demo-get',
        'uses' => 'SoapController@getXmlDemo'
    ]);
    Route::get('/reject', [
        'as' => 'tps-reject-index',
        'uses' => 'TpsOnlineController@rejectIndex'
    ]);
    Route::get('/reject/get-xml', [
        'as' => 'tps-reject-get',
        'uses' => 'SoapController@GetRejectData'
    ]);
    Route::get('/terkirim', [
        'as' => 'tps-terkirim-index',
        'uses' => 'TpsOnlineController@terkirimIndex'
    ]);
    Route::get('/terkirim/get-xml', [
        'as' => 'tps-terkirim-get',
        'uses' => 'SoapController@CekDataTerkirim'
    ]);
    Route::get('/gagal', [
        'as' => 'tps-gagal-index',
        'uses' => 'TpsOnlineController@gagalIndex'
    ]);
    Route::get('/gagal/get-xml', [
        'as' => 'tps-gagal-get',
        'uses' => 'SoapController@CekDataGagalKirim'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsDataKirim(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentTpsGudang();

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