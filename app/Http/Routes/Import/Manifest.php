<?php

Route::group(['prefix' => 'lcl', 'namespace' => 'Import'], function(){
    
    Route::get('/manifest', [
        'as' => 'lcl-manifest-index',
        'uses' => 'ManifestController@Index'
    ]);
    Route::post('/manifest/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Manifest(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/manifest/crud', function()
    {
        $Eloquent = new \App\Models\Eloquent\EloquentManifest();

        switch (Illuminate\Support\Facades\Request::get('oper'))
        {
          case 'edit':
            return $Eloquent->update(Illuminate\Support\Facades\Request::get('id'), Illuminate\Support\Facades\Request::except('id', 'oper'));
            break;
        }
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
    Route::get('/manifest/approve/{id}', [
        'as' => 'lcl-manifest-approve',
        'uses' => 'ManifestController@approve'
    ]);
    Route::get('/manifest/approve-all/{id}', [
        'as' => 'lcl-manifest-approve-all',
        'uses' => 'ManifestController@approveAll'
    ]);
    
    // PRINT
    Route::get('/manifest/cetak/{id}/{type}', [
        'as' => 'lcl-manifest-cetak',
        'uses' => 'ManifestController@cetak'
    ]);
    
    // TPS ONLINE COARI KEMASAN
    Route::post('/manifest/upload', [
        'as' => 'lcl-manifest-upload',
        'uses' => 'ManifestController@upload'
    ]);
    
    // UPLOAD PHOTO
    Route::post('/manifest/upload/photo/{ref}', [
        'as' => 'lcl-manifest-upload-photo',
        'uses' => 'ManifestController@uploadPhoto'
    ]);
});
