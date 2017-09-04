<?php

Route::get('/', [
    'as' => 'web-index',
    'uses' => 'IndexController@index'
]);

Route::get('/{page}', [
    'as' => 'web-pages',
    'uses' => 'IndexController@pages'
]);

Route::get('/our-story', [
    'as' => 'web-our-story',
    'uses' => 'IndexController@ourStory'
]);

Route::get('/our-value', [
    'as' => 'web-our-value',
    'uses' => 'IndexController@ourValue'
]);

Route::get('/our-legal', [
    'as' => 'web-our-legal',
    'uses' => 'IndexController@ourLegal'
]);

Route::get('/warehouse-management', [
    'as' => 'web-warehouse-management',
    'uses' => 'IndexController@warehouseManagement'
]);

Route::get('/multimodal-transportation', [
    'as' => 'web-multimodal',
    'uses' => 'IndexController@multimodal'
]);

Route::get('/tracking', [
    'as' => 'web-track-trace',
    'uses' => 'IndexController@tracking'
]);

Route::get('/operasionalisasi-gudang', [
    'as' => 'web-operasional-gudang',
    'uses' => 'IndexController@operasionalGudang'
]);

Route::get('/operasionalisasi-lapangan', [
    'as' => 'web-operasional-lapangan',
    'uses' => 'IndexController@operasionalLapangan'
]);

Route::get('/fasilitas-gudang', [
    'as' => 'web-fasilitas-gudang',
    'uses' => 'IndexController@fasilitasGudang'
]);

Route::get('/fasilitas-lapangan', [
    'as' => 'web-fasilitas-lapangan',
    'uses' => 'IndexController@fasilitasLapangan'
]);

Route::get('/fasilitas-alat', [
    'as' => 'web-fasilitas-alat',
    'uses' => 'IndexController@fasilitasAlat'
]);

Route::get('/contact-us', [
    'as' => 'web-contact-us',
    'uses' => 'IndexController@contactUs'
]);
