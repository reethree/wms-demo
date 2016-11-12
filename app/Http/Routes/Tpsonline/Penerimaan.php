<?php

Route::group(['prefix' => 'tpsonline/penerimaan', 'namespace' => 'Tps'], function(){
    
    // RESPON PLP
    Route::get('/respon-plp', [
        'as' => 'tps-responPlp-index',
        'uses' => 'PenerimaanController@responPlpIndex'
    ]);
    Route::get('/respon-plp/edit/{id}', [
        'as' => 'tps-responPlp-edit',
        'uses' => 'PenerimaanController@responPlpEdit'
    ]);
    Route::post('/respon-plp/edit/{id}', [
        'as' => 'tps-responPlp-update',
        'uses' => 'PenerimaanController@responPlpUpdate'
    ]);
    Route::get('/respon-plp/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsResponPlp(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/respon-plp-detail/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsResponPlpDetail(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    
    // Respon Batal PLP
    Route::get('/respon-batal-plp', [
        'as' => 'tps-responBatalPlp-index',
        'uses' => 'PenerimaanController@responBatalPlpIndex'
    ]);
    Route::get('/respon-batal-plp/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsResponBatalPlp(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
       
    // OB LCL
    Route::get('/ob-lcl', [
        'as' => 'tps-obLcl-index',
        'uses' => 'PenerimaanController@obLclIndex'
    ]);
    Route::get('/ob-lcl/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsOb(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/ob-lcl/edit/{id}', [
        'as' => 'tps-obLcl-edit',
        'uses' => 'PenerimaanController@obEdit'
    ]);
    
    // OB FCL
    Route::get('/ob-fcl', [
        'as' => 'tps-obFcl-index',
        'uses' => 'PenerimaanController@obFclIndex'
    ]);
    Route::get('/ob-fcl/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsOb(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/ob-fcl/edit/{id}', [
        'as' => 'tps-obFcl-edit',
        'uses' => 'PenerimaanController@obEdit'
    ]);
    
    // SPJM
    Route::get('/spjm', [
        'as' => 'tps-spjm-index',
        'uses' => 'PenerimaanController@spjmIndex'
    ]);
    Route::get('/spjm/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsSpjm(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    
    //Dok Manual
    Route::get('/dok-manual', [
        'as' => 'tps-dokManual-index',
        'uses' => 'PenerimaanController@dokManualIndex'
    ]);
    Route::get('/dok-manual/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsDokManual(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    
    //SPPB PIB
    Route::get('/sppb-pib', [
        'as' => 'tps-sppbPib-index',
        'uses' => 'PenerimaanController@sppbPibIndex'
    ]);
    Route::get('/sppb-pib/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsSppbPib(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/sppb-pib/edit/{id}', [
        'as' => 'tps-sppbPib-edit',
        'uses' => 'PenerimaanController@sppbPibEdit'
    ]);
    Route::post('/sppb-pib/edit/{id}', [
        'as' => 'tps-sppbPib-update',
        'uses' => 'PenerimaanController@sppbPibUpdate'
    ]);
    
    //SPPB BEA CUKAI
    Route::get('/sppb-bc', [
        'as' => 'tps-sppBc-index',
        'uses' => 'PenerimaanController@sppbBcIndex'
    ]);
    Route::get('/sppb-bc/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TpsTablesRepository(new App\Models\TpsSppbBc(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/sppb-bc/edit/{id}', [
        'as' => 'tps-sppbBc-edit',
        'uses' => 'PenerimaanController@sppbBcEdit'
    ]);
    Route::post('/sppb-bc/edit/{id}', [
        'as' => 'tps-sppbBc-update',
        'uses' => 'PenerimaanController@sppbBcUpdate'
    ]);
});