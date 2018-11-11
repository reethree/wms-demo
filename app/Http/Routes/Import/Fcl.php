<?php
Route::group(['prefix' => 'fcl', 'namespace' => 'Import'], function(){
    
    Route::get('/register', [
        'as' => 'fcl-register-index',
        'uses' => 'FclController@registerIndex'
    ]);
    Route::post('/joborder/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Jobordercy(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/register/grid-data', function()
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
        'uses' => 'FclController@destroy'
    ]);
    
    Route::get('/dispatche', [
        'as' => 'fcl-dispatche-index',
        'uses' => 'FclController@dispatcheIndex'
    ]);
    Route::post('/dispatche/edit/{id}', [
        'as' => 'fcl-dispatche-update',
        'uses' => 'FclController@dispatcheUpdate'
    ]);
    
    // REPORT
    Route::get('/report/harian', [
        'as' => 'fcl-report-harian',
        'uses' => 'FclController@reportHarian'
    ]);
    Route::get('/report/rekap', [
        'as' => 'fcl-report-rekap',
        'uses' => 'FclController@reportRekap'
    ]);
    Route::get('/report/rekap/view-photo/{id}', [
        'as' => 'fcl-report-rekap-view-photo',
        'uses' => 'FclController@reportRekapViewPhoto'
    ]);
    Route::get('/report/stock', [
        'as' => 'fcl-report-stock',
        'uses' => 'FclController@reportStock'
    ]);
    Route::get('/report/longstay', [
        'as' => 'fcl-report-longstay',
        'uses' => 'FclController@reportLongstay'
    ]);
    Route::post('/report/rekap/sendemail', [
        'as' => 'fcl-report-rekap-sendemail',
        'uses' => 'FclController@reportRekapSend'
    ]);
    Route::post('/report/rekap/sendebilling', [
        'as' => 'fcl-report-rekap-sendbilling',
        'uses' => 'FclController@reportRekapSendBilling'
    ]);
    Route::get('/report/longstay/change-status/{id}', [
        'as' => 'fcl-change-status',
        'uses' => 'FclController@changeStatusBc'
    ]);
    Route::get('/report/longstay/change-status-flag/{id}', [
        'as' => 'fcl-change-status-flag',
        'uses' => 'FclController@changeStatusFlag'
    ]);
    Route::post('/report/longstay/lock-flag', [
        'as' => 'fcl-lock-flag',
        'uses' => 'FclController@lockFlag'
    ]);
    Route::post('/report/longstay/unlock-flag', [
        'as' => 'fcl-unlock-flag',
        'uses' => 'FclController@unlockFlag'
    ]);
});

