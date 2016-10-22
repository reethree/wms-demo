<?php
Route::group(['prefix' => 'fcl', 'namespace' => 'Import'], function(){
    
    Route::get('/register', [
        'as' => 'fcl-register-index',
        'uses' => 'FclController@registerIndex'
    ]);
    Route::get('/joborder/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Jobordercy(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/register/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Containercy(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/register/create', [
        'as' => 'fcl-register-create',
        'uses' => 'FclController@registerCreate'
    ]);
    Route::post('/register/create', [
        'as' => 'fcl-register-store',
        'uses' => 'FclController@registerStore'
    ]);
    Route::get('/register/edit/{id}', [
        'as' => 'fcl-register-edit',
        'uses' => 'FclController@registerEdit'
    ]);
    Route::post('/register/edit/{id}', [
        'as' => 'fcl-register-update',
        'uses' => 'FclController@registerUpdate'
    ]);
    Route::get('/register/delete/{id}', [
        'as' => 'fcl-register-delete',
        'uses' => 'FclControllerController@destroy'
    ]);
    
});

