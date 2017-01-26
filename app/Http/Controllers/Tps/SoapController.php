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
        $this->user = 'PRJP';
        $this->password = 'PRIMANATA';
        $this->kode = 'PRJP';
    }
    
//    public function demo()
//    {
//        
//        // Add a new service to the wrapper
//        SoapWrapper::add(function ($service) {
//            $service
//                ->name('currency')
//                ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL')
//                ->trace(true)                                                   // Optional: (parameter: true/false)
////                ->header()                                                      // Optional: (parameters: $namespace,$name,$data,$mustunderstand,$actor)
////                ->customHeader($customHeader)                                   // Optional: (parameters: $customerHeader) Use this to add a custom SoapHeader or extended class                
////                ->cookie()                                                      // Optional: (parameters: $name,$value)
////                ->location()                                                    // Optional: (parameter: $location)
////                ->certificate()                                                 // Optional: (parameter: $certLocation)
//                ->cache(WSDL_CACHE_NONE)                                        // Optional: Set the WSDL cache
//                ->options(['login' => 'username', 'password' => 'password']);   // Optional: Set some extra options
//        });
//
//        $data = [
//            'CurrencyFrom' => 'USD',
//            'CurrencyTo'   => 'EUR',
//            'RateDate'     => '2014-06-05',
//            'Amount'       => '1000'
//        ];
//
//        // Using the added service
//        \SoapWrapper::service('currency', function ($service) use ($data) {
////            var_dump($service->getFunctions());
//            var_dump($service->call('GetConversionAmount', [$data])->GetConversionAmountResult);
//        });
//        
//    }
    
    public function GetResponPLP()
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('GetResponPLP')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options();                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_asp' => $this->kode
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
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
//                ->options()
                ;                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_asp' => $this->kode
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
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
//                ->options()
                    ;                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_ASP' => $this->kode
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
//                ->certificate(url('cert/cacert.pem'))                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
//                    'ssl' => [
//                        'ciphers'=>'RC4-SHA', 
//                        'verify_peer'=>false, 
//                        'verify_peer_name'=>false
//                    ],
                    'UserName' => $this->user, 
                    'Password' => $this->password,
                    'Kd_Tps' => $this->kode
                ]);                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_Tps' => $this->kode
        ];
        
        // Using the added service
        SoapWrapper::service('GetSPJM', function ($service) use ($data) {        
            $this->response = $service->call('GetSPJM', [$data])->GetSPJMResult;      
        });
        
//        var_dump($this->response);
        
        $xml = simplexml_load_string($this->response);
        
        foreach($xml->children() as $child) {
            $header = array();
            $kms = [];
            $dok = [];
            $cont = [];
            foreach($child as $key => $value) {
                if($key == 'header' || $key == 'HEADER'){
                    $header[] = $value;
                }else{
                    foreach ($value as $key => $value):
                        if($key == 'kms' || $key == 'KMS'):
                            $kms[] = $value;
                        elseif($key == 'dok' || $key == 'DOC'):
                            $dok[] = $value;
                        elseif($key == 'cont' || $key == 'CONT'):
                            $cont[] = $value;
                        endif;
                    endforeach;
                }
            }
            
            if(count($header) > 0){
                // INSERT DATA
                $spjm = new \App\Models\TpsSpjm;
                foreach ($header[0] as $key=>$value):
                    if($key == 'tgl_pib' || $key == 'tgl_bc11'){
                        $split_val = explode('/', $value);
                        $value = $split_val[2].'-'.$split_val[1].'-'.$split_val[0];
                    }
                    $spjm->$key = $value;
                endforeach;  
                $spjm->TGL_UPLOAD = date('Y-m-d');
                $spjm->JAM_UPLOAD = date('H:i:s');
                
                // CHECK DATA
                $check = \App\Models\TpsSpjm::where('CAR', $spjm->car)->count();
                if($check > 0) { continue; }

                $spjm->save();   

                $spjm_id = $spjm->TPS_SPJMXML_PK;

                if(count($kms) > 0){
                    $datakms = array();
                    foreach ($kms[0] as $key=>$value):
                        $datakms[$key] = $value;
                    endforeach;
                    $datakms['TPS_SPJMXML_FK'] = $spjm_id;
                    \DB::table('tps_spjmkmsxml')->insert($datakms);
                }
                if(count($dok) > 0){
                    $datadok = array();
                    foreach ($dok[0] as $key=>$value):
                        $datadok[$key] = $value;
                    endforeach;
                    $datadok['TPS_SPJMXML_FK'] = $spjm_id;
                    \DB::table('tps_spjmdokxml')->insert($datadok);
                }
                if(count($cont) > 0){
                    $datacont = array();
                    foreach ($cont[0] as $key=>$value):
                        $datacont[$key] = $value;
                    endforeach;
                    $datacont['TPS_SPJMXML_FK'] = $spjm_id;
                    \DB::table('tps_spjmcontxml')->insert($datacont);
                }
            }
        }
        
        return back()->with('success', 'Get SPJM has been success.');
        
    }
    
    public function GetImporPermit()
    {
        SoapWrapper::add(function ($service) {
            $service
                ->name('GetImporPermit')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
//                ->options()
                    ;                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_Gudang' => $this->kode
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
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
//                ->options()
                    ;                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_Gudang' => $this->kode
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
            'Kd_Tps' => $this->kode
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
            'Kd_Tps' => $this->kode
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
