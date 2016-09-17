<?php

Route::group(['prefix' => 'roles', 'namespace' => 'User'], function(){
    Route::get('/', [
        'as' => 'role-index',
        'uses' => 'RolesController@index'
    ]);
    Route::get('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new \App\Models\Roles()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud', function()
    {
      $EloquentBook = new \App\Models\EloquentRoles();

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
    Route::get('/edit/{id}', [
        'as' => 'role-edit',
        'uses' => 'RolesController@edit'
    ]);
    Route::post('/update/permission/{id}', [
        'as' => 'role-permission-update',
        'uses' => 'RolesController@updatePermission'
    ]);  
});

