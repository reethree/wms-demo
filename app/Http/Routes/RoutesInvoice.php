<?php

Route::group(['prefix' => 'invoice', 'namespace' => 'Invoice'], function(){
    
    Route::get('/', [
        'as' => 'invoice-index',
        'uses' => 'InvoiceController@invoiceIndex'
    ]);
    Route::post('/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\InvoiceTablesRepository('invoice_import',Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });   
    Route::get('/edit/{id}', [
        'as' => 'invoice-edit',
        'uses' => 'InvoiceController@invoiceEdit'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'invoice-delete',
        'uses' => 'InvoiceController@invoiceDestroy'
    ]);
    Route::get('/print/{id}', [
        'as' => 'invoice-print',
        'uses' => 'InvoiceController@invoicePrint'
    ]);
    Route::post('/print/rekap', [
       'as' => 'invoice-print-rekap',
        'uses' => 'InvoiceController@invoicePrintRekap'
    ]);
    
    // RELEASE INVOICE
    Route::get('/release', [
        'as' => 'invoice-release-index',
        'uses' => 'InvoiceController@releaseIndex'
    ]);
    
    // TARIF
    Route::get('/tarif', [
        'as' => 'invoice-tarif-index',
        'uses' => 'InvoiceController@tarifIndex'
    ]);
    Route::get('/tarif/create', [
        'as' => 'invoice-tarif-create',
        'uses' => 'InvoiceController@tarifCreate'
    ]);
    Route::post('/tarif/create', [
        'as' => 'invoice-tarif-store',
        'uses' => 'InvoiceController@tarifStore'
    ]);
    Route::get('/tarif/view/{id}', [
        'as' => 'invoice-tarif-view',
        'uses' => 'InvoiceController@tarifView'
    ]);
    Route::get('/tarif/edit/{id}', [
        'as' => 'invoice-tarif-edit',
        'uses' => 'InvoiceController@tarifEdit'
    ]);
    Route::post('/tarif/edit/{id}', [
        'as' => 'invoice-tarif-update',
        'uses' => 'InvoiceController@tarifUpdate'
    ]);
    Route::get('/tarif/delete/{id}', [
       'as' => 'invoice-tarif-delete',
        'uses' => 'InvoiceController@tarifDestroy'
    ]);
    Route::get('/tarif/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\InvoiceTablesRepository('invoice_tarif_consolidator',Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    
    Route::get('/tarif/item', [
        'as' => 'invoice-tarif-item-index',
        'uses' => 'InvoiceController@tarifItemIndex'
    ]);
    Route::get('/tarif/item/edit/{id}', [
        'as' => 'invoice-tarif-item-edit',
        'uses' => 'InvoiceController@tarifItemEdit'
    ]);
    Route::post('/tarif/item/edit/{id}', [
        'as' => 'invoice-tarif-item-update',
        'uses' => 'InvoiceController@tarifItemUpdate'
    ]);
    Route::get('/tarif/item/grid-data', function()
    {
        GridEncoder::encodeRequestedData(new \App\Models\InvoiceTablesRepository('invoice_tarif_item',Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
    });
    
    // FCL NCT1
    Route::group(['prefix' => 'fcl'], function(){
        
        Route::get('/', [
            'as' => 'invoice-nct-index',
            'uses' => 'InvoiceController@invoiceNctIndex'
        ]);
        
        Route::post('/grid-data', function()
        {
            GridEncoder::encodeRequestedData(new \App\Models\InvoiceTablesRepository('invoice_nct',Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
        }); 
        
        Route::get('/edit/{id}', [
            'as' => 'invoice-nct-edit',
            'uses' => 'InvoiceController@invoiceNctEdit'
        ]);
        
        Route::get('/delete/{id}', [
            'as' => 'invoice-nct-delete',
            'uses' => 'InvoiceController@invoiceNctDestroy'
        ]);
        
        Route::get('/print/{id}', [
        'as' => 'invoice-nct-print',
        'uses' => 'InvoiceController@invoiceNctPrint'
    ]);
        
        // TARIF
        Route::get('/tarif', [
            'as' => 'invoice-tarif-nct-index',
            'uses' => 'InvoiceController@tarifNctIndex'
        ]);
        
        Route::get('/tarif/grid-data', function()
        {
            GridEncoder::encodeRequestedData(new \App\Models\InvoiceTablesRepository('invoice_tarif_nct',Illuminate\Support\Facades\Request::all()) ,Illuminate\Support\Facades\Request::all());
        });
        
        // RELEASE INVOICE
        Route::get('/release', [
            'as' => 'invoice-release-nct-index',
            'uses' => 'InvoiceController@releaseNctIndex'
        ]);

    });
    
    
});