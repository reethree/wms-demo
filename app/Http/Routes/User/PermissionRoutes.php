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
      $EloquentBook = new \App\Models\EloquentPermissions();

      switch (Illuminate\Support\Facades\Request::get('oper'))
      {
        case 'add':
          return $EloquentBook->create(Illuminate\Support\Facades\Request::except('id', 'oper'));
          break;
        case 'edit':
          return $EloquentBook->update(Illuminate\Support\Facades\Request::get('id'), Illuminate\Support\Facades\Request::except('id', 'oper'));
          break;
        case 'del':
          return  $EloquentBook->delete(Illuminate\Support\Facades\Request::get('id'));
          break;
      }
    });
});
