<?php

Route::group(['prefix' => 'lcl', 'namespace' => 'Import'], function(){
    
    Route::get('/manifest', [
        'as' => 'lcl-manifest-index',
        'uses' => 'ManifestController@Index'
    ]);
    Route::get('/manifest/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Manifest(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::get('/manifest/create', [
        'as' => 'lcl-manifest-create',
        'uses' => 'ManifestController@Create'
    ]);
    Route::post('/manifest/create', [
        'as' => 'lcl-manifest-store',
        'uses' => 'ManifestController@Store'
    ]);
    Route::get('/manifest/edit/{id}', [
        'as' => 'lcl-manifest-edit',
        'uses' => 'ManifestController@Edit'
    ]);
    Route::post('/manifest/edit/{id}', [
        'as' => 'lcl-manifest-update',
        'uses' => 'ManifestController@Update'
    ]);
    Route::get('/manifest/delete/{id}', [
        'as' => 'lcl-manifest-delete',
        'uses' => 'ManifestController@destroy'
    ]);
});
