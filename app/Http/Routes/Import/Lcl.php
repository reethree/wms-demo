<?php

Route::group(['prefix' => 'lcl', 'namespace' => 'Import'], function(){
    
    Route::get('/register', [
        'as' => 'lcl-register-index',
        'uses' => 'LclController@registerIndex'
    ]);
    Route::post('/joborder/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Joborder(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/register/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Container(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/register/create', [
        'as' => 'lcl-register-create',
        'uses' => 'LclController@registerCreate'
    ]);
    Route::post('/register/create', [
        'as' => 'lcl-register-store',
        'uses' => 'LclController@registerStore'
    ]);
    Route::get('/register/edit/{id}', [
        'as' => 'lcl-register-edit',
        'uses' => 'LclController@registerEdit'
    ]);
    Route::post('/register/edit/{id}', [
        'as' => 'lcl-register-update',
        'uses' => 'LclController@registerUpdate'
    ]);
    Route::get('/register/delete/{id}', [
        'as' => 'lcl-register-delete',
        'uses' => 'LclController@destroy'
    ]);
    
    Route::post('/register/print-permohonan', [
        'as' => 'lcl-register-print-permohonan',
        'uses' => 'LclController@registerPrintPermohonan'
    ]);
    
    Route::post('/register/upload-file', [
        'as' => 'lcl-register-upload-file',
        'uses' => 'LclController@uploadTxtFile'
    ]); 
    
    Route::post('/register/upload-xls-file', [
        'as' => 'lcl-register-upload-xls-file',
        'uses' => 'LclController@uploadXlsFile'
    ]); 
    
    Route::get('/dispatche', [
        'as' => 'lcl-dispatche-index',
        'uses' => 'LclController@dispatcheIndex'
    ]);
    Route::post('/dispatche/edit/{id}', [
        'as' => 'lcl-dispatche-update',
        'uses' => 'LclController@dispatcheUpdate'
    ]);
    
    // REPORT
    Route::get('/report/inout', [
        'as' => 'lcl-report-inout',
        'uses' => 'LclController@reportInout'
    ]);
    Route::get('/report/inout/view-photo/{id}', [
        'as' => 'lcl-report-inout-view-photo',
        'uses' => 'LclController@reportInoutViewPhoto'
    ]);
    Route::get('/report/container', [
        'as' => 'lcl-report-container',
        'uses' => 'LclController@reportContainer'
    ]);
    Route::get('/report/container/view-photo/{id}', [
        'as' => 'lcl-report-container-view-photo',
        'uses' => 'LclController@reportContainerViewPhoto'
    ]);
    Route::get('/report/harian', [
        'as' => 'lcl-report-harian',
        'uses' => 'LclController@reportHarian'
    ]);
    Route::get('/report/rekap', [
        'as' => 'lcl-report-rekap',
        'uses' => 'LclController@reportRekap'
    ]);
    Route::get('/report/stock', [
        'as' => 'lcl-report-stock',
        'uses' => 'LclController@reportStock'
    ]);
    Route::get('/report/longstay', [
        'as' => 'lcl-report-longstay',
        'uses' => 'LclController@reportLongstay'
    ]);
    Route::get('/report/longstay/view-flag-info/{id}', [
        'as' => 'lcl-view-info-flag',
        'uses' => 'LclController@viewFlagInfo'
    ]);
    Route::get('/report/longstay/change-status/{id}', [
        'as' => 'lcl-change-status',
        'uses' => 'LclController@changeStatusBc'
    ]);
    Route::get('/report/longstay/change-status-flag/{id}', [
        'as' => 'lcl-change-status-flag',
        'uses' => 'LclController@changeStatusFlag'
    ]);
    Route::post('/report/longstay/lock-flag', [
        'as' => 'lcl-lock-flag',
        'uses' => 'LclController@lockFlag'
    ]);
    Route::post('/report/longstay/unlock-flag', [
        'as' => 'lcl-unlock-flag',
        'uses' => 'LclController@unlockFlag'
    ]);
});
