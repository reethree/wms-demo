<?php

namespace App\Http\Controllers\Tps;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\DefaultController;

use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

class SoapController extends DefaultController {
    
    protected $wsdl;
    protected $user;
    protected $password;
    protected $kode;
    protected $response;

    public function __construct() {
        
        $this->wsdl = 'https://tpsonline.beacukai.go.id/tps/service.asmx?WSDL';
        $this->user = 'prjp.tps';
        $this->password = '123pjp';
        $this->kode = 'PRJP';
    }
    
    public function demo()
    {
        
        // Add a new service to the wrapper
        SoapWrapper::add(function ($service) {
            $service
                ->name('currency')
                ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL')
                ->trace(true)                                                   // Optional: (parameter: true/false)
//                ->header()                                                      // Optional: (parameters: $namespace,$name,$data,$mustunderstand,$actor)
//                ->customHeader($customHeader)                                   // Optional: (parameters: $customerHeader) Use this to add a custom SoapHeader or extended class                
//                ->cookie()                                                      // Optional: (parameters: $name,$value)
//                ->location()                                                    // Optional: (parameter: $location)
//                ->certificate()                                                 // Optional: (parameter: $certLocation)
                ->cache(WSDL_CACHE_NONE)                                        // Optional: Set the WSDL cache
                ->options(['login' => 'username', 'password' => 'password']);   // Optional: Set some extra options
        });

        $data = [
            'CurrencyFrom' => 'USD',
            'CurrencyTo'   => 'EUR',
            'RateDate'     => '2014-06-05',
            'Amount'       => '1000'
        ];

        // Using the added service
        \SoapWrapper::service('currency', function ($service) use ($data) {
//            var_dump($service->getFunctions());
            var_dump($service->call('GetConversionAmount', [$data])->GetConversionAmountResult);
        });
        
    }
    
    public function GetResponPLP()
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('GetResponPLP')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_asp' => 'PRJP'
        ];
        
        // Using the added service
        SoapWrapper::service('GetResponPLP', function ($service) use ($data) {        
            $this->response = $service->call('GetResponPLP', [$data])->GetResponPLPResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function GetResponPLP_Tujuan()
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('GetResponPLP_Tujuan')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_asp' => 'PRJP'
        ];
        
        // Using the added service
        SoapWrapper::service('GetResponPLP_Tujuan', function ($service) use ($data) {        
            $this->response = $service->call('GetResponPLP_Tujuan', [$data])->GetResponPLP_TujuanResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function GetOB()
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('GetDataOB')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_asp' => 'PRJP'
        ];
        
        // Using the added service
        SoapWrapper::service('GetDataOB', function ($service) use ($data) {        
            $this->response = $service->call('GetDataOB', [$data])->GetDataOBResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function GetSPJM()
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('GetSPJM')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_asp' => 'PRJP'
        ];
        
        // Using the added service
        SoapWrapper::service('GetSPJM', function ($service) use ($data) {        
            $this->response = $service->call('GetSPJM', [$data])->GetSPJMResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function GetImporPermit()
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('GetImporPermit')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_Gudang' => 'PRJP'
        ];
        
        // Using the added service
        SoapWrapper::service('GetImporPermit', function ($service) use ($data) {        
            $this->response = $service->call('GetImporPermit', [$data])->GetImporPermitResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function GetBC23Permit()
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('GetBC23Permit')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_Gudang' => 'PRJP'
        ];
        
        // Using the added service
        SoapWrapper::service('GetBC23Permit', function ($service) use ($data) {        
            $this->response = $service->call('GetBC23Permit', [$data])->GetBC23PermitResult;      
        });
        
        var_dump($this->response);
        
    }

    public function GetDokumenManual()
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('GetDokumenManual')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_Tps' => 'PRJP'
        ];
        
        // Using the added service
        SoapWrapper::service('GetDokumenManual', function ($service) use ($data) {        
            $this->response = $service->call('GetDokumenManual', [$data])->GetDokumenManualResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function GetRejectData()
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('GetRejectData')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_Tps' => 'PRJP'
        ];
        
        // Using the added service
        SoapWrapper::service('GetRejectData', function ($service) use ($data) {        
            $this->response = $service->call('GetRejectData', [$data])->GetRejectDataResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function CekDataGagalKirim(Request $request)
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('CekDataGagalKirim')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Tgl_Awal' => date('d-m-Y', strtotime($request->tgl_awal)),
            'Tgl_Akhir' => date('d-m-Y', strtotime($request->tgl_akhir))
        ];
        
        // Using the added service
        SoapWrapper::service('CekDataGagalKirim', function ($service) use ($data) {        
            $this->response = $service->call('CekDataGagalKirim', [$data])->CekDataGagalKirimResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function CekDataTerkirim(Request $request)
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('CekDataTerkirim')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Tgl_Awal' => date('d-m-Y', strtotime($request->tgl_awal)),
            'Tgl_Akhir' => date('d-m-Y', strtotime($request->tgl_akhir))
        ];
        
        // Using the added service
        SoapWrapper::service('CekDataTerkirim', function ($service) use ($data) {        
            $this->response = $service->call('CekDataTerkirim', [$data])->CekDataTerkirimResult;      
        });
        
        var_dump($this->response);
        
    }
    
}
