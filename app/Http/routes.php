<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::group(['middleware' => ['web']], function(){

    Route::group(['middleware' => ['web']], function(){
        
        // EasyGo Routes
        require_once 'Routes/RoutesEasyGo.php';
        
        Route::group(['namespace' => 'Web', 'prefix' => 'website'], function(){
        
            // Website Routes
            require_once 'Routes/RoutesWebsite.php';
        
        });

    });

    Route::group(['middleware' => ['guest'], 'namespace' => 'Auth'], function(){
        
        // Login Routes
        Route::get('/login', [
            'as' => 'login',
            'uses' => 'AuthController@getLogin'
        ]);
        Route::post('/login', [
            'as' => 'login',
            'uses' => 'AuthController@postLogin'
        ]);
        
    });
    
    Route::group(['middleware' => ['auth']/*, 'prefix' => 'wms', 'domain' => 'wms.prjp.co.id'*/], function(){
        
        // Dashboard Routes
        Route::get('/', [
            'as' => 'index',
            'uses' => 'DashboardController@index'
        ]);
        // Logout Routes
        Route::get('/logout', [
            'as' => 'logout',
            'uses' => 'Auth\AuthController@logout'
        ]);
        
        // User Routes
        require_once 'Routes/RoutesUser.php';
        
        // Data Routes
        require_once 'Routes/RoutesData.php';
        
        // Import Routes
        require_once 'Routes/RoutesImport.php';
        
        // TPS Online Routes
        require_once 'Routes/RoutesTpsonline.php';
        
        // Invoice Routes
        require_once 'Routes/RoutesInvoice.php';
        
        
        
        // GLOBAL Routes
        Route::get('/getDataPelabuhan', [
            'as' => 'getDataPelabuhan',
            'uses' => 'Controller@getDataPelabuhan'
        ]);
        Route::get('/getDataCodePelabuhan', [
            'as' => 'getDataCodePelabuhan',
            'uses' => 'Controller@getDataCodePelabuhan'
        ]);
        Route::get('/getDataPerusahaan', [
            'as' => 'getDataPerusahaan',
            'uses' => 'Controller@getDataPerusahaan'
        ]);
        
    });
    
    Route::get('/demo', ['as' => 'demo', 'uses' => 'Tps\SoapController@demo']);
    
//});

// NEXMO
Route::get('/voice/callback', [
    'uses' => 'DefaultController@voiceCallback',
    'as' => 'call-voice-callback'
]);
Route::get('/voice/callback/response/{cid}', [
    'uses' => 'DefaultController@voiceCallbackResponse',
    'as' => 'call-voice-callback-response'
]);

// FlatFIle
Route::get('/flat', [
    'uses' => 'DefaultController@getFlatFile',
    'as' => 'flat-file'
]);