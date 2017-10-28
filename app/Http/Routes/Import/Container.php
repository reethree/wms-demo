<?php

Route::group(['prefix' => 'container', 'namespace' => 'Import'], function(){
    
    Route::post('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Container(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    Route::post('/crud/{id}', function($joborder_id)
    {
        $Eloquent = new \App\Models\Eloquent\EloquentContainer();

        switch (Illuminate\Support\Facades\Request::get('oper'))
        {
          case 'add':
            return $Eloquent->create(Illuminate\Support\Facades\Request::except('id', 'oper'), $joborder_id);
            break;
          case 'edit':
            return $Eloquent->update(Illuminate\Support\Facades\Request::get('id'), Illuminate\Support\Facades\Request::except('id', 'oper'), $joborder_id);
            break;
          case 'del':
            return  $Eloquent->delete(Illuminate\Support\Facades\Request::get('id'));
            break;
        }
    });
    
    Route::post('/grid-data-cy', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\TablesRepository(new App\Models\Containercy(),Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    
    Route::post('/crud-cy/{id}', function($joborder_id)
    {
        $Eloquent = new \App\Models\Eloquent\EloquentContainercy();

        switch (Illuminate\Support\Facades\Request::get('oper'))
        {
          case 'add':
            return $Eloquent->create(Illuminate\Support\Facades\Request::except('id', 'oper'), $joborder_id);
            break;
          case 'edit':
            return $Eloquent->update(Illuminate\Support\Facades\Request::get('id'), Illuminate\Support\Facades\Request::except('id', 'oper'), $joborder_id);
            break;
          case 'del':
            return  $Eloquent->delete(Illuminate\Support\Facades\Request::get('id'));
            break;
        }
    });
    
});
