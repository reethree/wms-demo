<?php

Route::group(['prefix' => 'permissions', 'namespace' => 'User'], function(){
    Route::get('/', [
        'as' => 'permission-index',
        'uses' => 'PermissionController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new \App\Models\Permission()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
      $Eloquent = new \App\Models\Eloquent\EloquentPermissions();

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
