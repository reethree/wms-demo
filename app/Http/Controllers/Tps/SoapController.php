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
        
//        \SoapWrapper::add(function ($service) {
//            $service
//                ->name('TpsOnlineSoap')
//                ->wsdl('https://tpsonline.beacukai.go.id/tps/service.asmx?WSDL')
//                ->trace(true)                                                                                                                                                  
//                ->cache(WSDL_CACHE_NONE);                                                    
//        });
    }
    
    public function getXmlDemo()
    {
        /* Initialize webservice with your WSDL */
        $client = new \SoapClient("http://currencyconverter.kowabunga.net/converter.asmx?WSDL");

        /* Set your parameters for the request */
        $params = [
            'CurrencyFrom' => 'USD',
            'CurrencyTo'   => 'EUR',
            'RateDate'     => '2017-06-05',
            'Amount'       => '1000'
        ];

        /* Invoke webservice method with your parameters, in this case: Function1 */
        $response = $client->__soapCall("GetConversionAmount", array($params));

        /* Print webservice response */
        var_dump($response);
    }
    
    public function demo()
    {
        
        // Add a new service to the wrapper
        \SoapWrapper::add(function ($service) {
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
        
//        return json_encode($data);
        
        // Using the added service
        \SoapWrapper::service('currency', function ($service) use ($data) {
//            var_dump($service->getFunctions());
            $this->response = $service->call('GetConversionAmount', [$data])->GetConversionAmountResult;
        });
        
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->response);
        if(!$xml  || !$xml->children()){
           return back()->with('error', $this->response);
        }
        
        return back()->with('success', $this->response);
        
    }
    
    public function GetResponPLP()
    {
        \SoapWrapper::add(function ($service) {
            $service
                ->name('GetResponPLP')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'UserName' => $this->user, 
                    'Password' => $this->password,
                    'Kd_asp' => $this->kode
                ]);                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_asp' => $this->kode
        ];
        
        // Using the added service
        \SoapWrapper::service('TpsOnlineSoap', function ($service) use ($data) {        
            $this->response = $service->call('GetResponPLP', [$data])->GetResponPLPResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function GetResponPLP_Tujuan()
    {

        \SoapWrapper::add(function ($service) {
            $service
                ->name('TpsOnlineSoap')
                ->wsdl($this->wsdl)
                ->trace(true)   
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)  
                ->options([
                    'soap_version' => SOAP_1_2,
                    'ssl'           => array(
                        'ciphers'=> "SHA1",
                        'verify_peer' => false, 
                        'allow_self_signed' => true
                    ),
                    'https' => array(
                        'curl_verify_ssl_peer'  => false,
                        'curl_verify_ssl_host'  => false
                    ),
                    'exceptions' => 0
                ]);                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_asp' => $this->kode
        ];
        
        try{
            \SoapWrapper::service('TpsOnlineSoap', function ($service) use ($data) {        
                $this->response = $service->call('GetResponPLP_Tujuan', [$data])->GetResponPLP_TujuanResult;      
            });
        }catch (\SoapFault $exception){
            var_dump($exception);
        }
        
        // Using the added service

        
//        $client = new \SoapClient($this->wsdl, array('soap_version' => SOAP_1_2));
//
//        /* Set your parameters for the request */
//        $params = [
//            'UserName' => $this->user, 
//            'Password' => $this->password,
//            'Kd_asp' => $this->kode
//        ];
//
//        $response = $client->__soapCall("GetResponPLP_Tujuan", array($params));

//        var_dump($response);
        
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->response);
        if(!$xml  || !$xml->children()){
           return back()->with('error', $this->response);
        }
        
        $header = array();
        $details = [];
        foreach($xml->children() as $child) {
            foreach($child as $key => $value) {
                if($key == 'header' || $key == 'HEADER'){
                    $header[] = $value;
                }else{
                    foreach ($value as $detail):
                        $details[] = $detail;
                    endforeach;
                }
            }
        }
        
        // INSERT DATA
        $respon = new \App\Models\TpsResponPlp;
        foreach ($header[0] as $key=>$value):
            $respon->$key = $value;
        endforeach;
        $respon->TGL_UPLOAD = date('Y-m-d H:i:s');
        $respon->save();
        
        $plp_id = $respon->tps_responplptujuanxml_pk;

        foreach ($details as $detail):     
            $respon_detail = new \App\Models\TpsResponPlpDetail;
            $respon_detail->tps_responplptujuanxml_fk = $plp_id;
            foreach($detail as $key=>$value):
                $respon_detail->$key = $value;
            endforeach;
            $respon_detail->save();
        endforeach;
        
        return back()->with('success', 'Get Respon PLP has been success.');
        
    }
    
    public function GetOB()
    {
        \SoapWrapper::add(function ($service) {
            $service
                ->name('TpsOnline')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'UserName' => $this->user, 
                    'Password' => $this->password,
                    'Kd_ASP' => $this->kode
                ]);                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_ASP' => $this->kode
        ];
        
        
        try{
            \SoapWrapper::service('TpsOnline', function ($service) use ($data) {        
                $this->response = $service->call('GetDataOB', [$data])->GetDataOBResult;      
            });
        }catch (\SoapFault $exception){
            var_dump($exception);
        }
        
//        var_dump($this->response);
//        
//        return false;
        
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->response);
        if(!$xml || !$xml->children()){
           return back()->with('error', $this->response);
        }
        
        $ob = array();
        foreach($xml->children() as $child) {
            $ob[] = $child;
        }
        
        // INSERT DATA       
        foreach ($ob as $data):
            $obinsert = new \App\Models\TpsOb;
            foreach ($data as $key=>$value):
                if($key == 'KODE_KANTOR' || $key == 'kode_kantor'){ $key='KD_KANTOR'; }
                $obinsert->$key = $value;
            endforeach;
            $obinsert->save();
        endforeach;
        
        return back()->with('success', 'Get OB has been success.');
        
    }
    
    public function GetSPJM()
    {
        \SoapWrapper::add(function ($service) {
            $service
                ->name('TpsOnline')
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
        \SoapWrapper::service('TpsOnline', function ($service) use ($data) {        
            $this->response = $service->call('GetSPJM', [$data])->GetSPJMResult;      
        });
        
//        var_dump($this->response);
        
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->response);
        if(!$xml || !$xml->children()){
           return back()->with('error', $this->response);
        }
        
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
        \SoapWrapper::add(function ($service) {
            $service
                ->name('TpsOnline')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'UserName' => $this->user, 
                    'Password' => $this->password,
                    'Kd_Gudang' => $this->kode
                ]);                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_Gudang' => $this->kode
        ];
        
        // Using the added service
        \SoapWrapper::service('TpsOnline', function ($service) use ($data) {        
            $this->response = $service->call('GetImporPermit', [$data])->GetImporPermitResult;      
        });
        
//        var_dump($this->response);
        
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->response);
        if(!$xml || !$xml->children()){
           return back()->with('error', $this->response);
        }
        
        foreach ($xml->children() as $data):  
            foreach ($data as $key=>$value):
                if($key == 'HEADER' || $key == 'header'){           
                    $sppb = new \App\Models\TpsSppbPib;
                    foreach ($value as $keyh=>$valueh):
                        if($keyh == 'TG_BL_AWB' || $keyh == 'tg_bl_awb'){ $keyh='TGL_BL_AWB'; }
                        elseif($keyh == 'TG_MASTER_BL_AWB' || $keyh == 'tg_master_bl_awb'){ $keyh='TGL_MASTER_BL_AWB'; }
                        $sppb->$keyh = $valueh;
                    endforeach;
                    $sppb->save();
                    $sppb_id = $sppb->TPS_SPPBXML_PK;
                }elseif($key == 'DETIL' || $key == 'detil'){
                    foreach ($value as $key1=>$value1):
                        if($key1 == 'KMS' || $key1 == 'kms'){
                            $kms = new \App\Models\TpsSppbPibKms;
                            foreach ($value1 as $keyk=>$valuek):
                                $kms->$keyk = $valuek;
                            endforeach;
                            $kms->TPS_SPPBXML_FK = $sppb_id;
                            $kms->save();
                        }elseif($key1 == 'CONT' || $key1 == 'cont'){
                            $cont = new \App\Models\TpsSppbPibCont;
                            foreach ($value1 as $keyc=>$valuec):
                                $cont->$keyc = $valuec;
                            endforeach;
                            $cont->TPS_SPPBXML_FK = $sppb_id;
                            $cont->save();
                        }
                    endforeach;  
                }
            endforeach;
        endforeach;
        
        return back()->with('success', 'Get SPPB PIB has been success.');
        
    }
    
    public function GetImpor_SPPB(Request $request)
    {
//        return $request->all();
        \SoapWrapper::add(function ($service) {
            $service
                ->name('TpsOnline')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
//                ->options([
//                    'UserName' => $this->user, 
//                    'Password' => $this->password,
//                    'Kd_Gudang' => $this->kode
//                ])
                ;                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'No_Sppb' => $request->no_sppb.'/KPU.01/'.$request->thn_sppb, //063484/KPU.01/2017
            'Tgl_Sppb' => $request->tgl_sppb, //09022017
            'NPWP_Imp' => $request->npwp_imp //033153321035000
        ];
        
        // Using the added service
        \SoapWrapper::service('TpsOnline', function ($service) use ($data) {        
            $this->response = $service->call('GetImpor_Sppb', [$data])->GetImpor_SppbResult;      
        });
        
//        var_dump($this->response);
        
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->response);
        if(!$xml || !$xml->children()){
           return back()->with('error', $this->response);
        }
        
        foreach ($xml->children() as $data):  
            foreach ($data as $key=>$value):
                if($key == 'HEADER' || $key == 'header'){           
                    $sppb = new \App\Models\TpsSppbPib;
                    foreach ($value as $keyh=>$valueh):
                        if($keyh == 'TG_BL_AWB' || $keyh == 'tg_bl_awb'){ $keyh='TGL_BL_AWB'; }
                        elseif($keyh == 'TG_MASTER_BL_AWB' || $keyh == 'tg_master_bl_awb'){ $keyh='TGL_MASTER_BL_AWB'; }
                        $sppb->$keyh = $valueh;
                    endforeach;
                    $sppb->save();
                    $sppb_id = $sppb->TPS_SPPBXML_PK;
                }elseif($key == 'DETIL' || $key == 'detil'){
                    foreach ($value as $key1=>$value1):
                        if($key1 == 'KMS' || $key1 == 'kms'){
                            $kms = new \App\Models\TpsSppbPibKms;
                            foreach ($value1 as $keyk=>$valuek):
                                $kms->$keyk = $valuek;
                            endforeach;
                            $kms->TPS_SPPBXML_FK = $sppb_id;
                            $kms->save();
                        }elseif($key1 == 'CONT' || $key1 == 'cont'){
                            $cont = new \App\Models\TpsSppbPibCont;
                            foreach ($value1 as $keyc=>$valuec):
                                $cont->$keyc = $valuec;
                            endforeach;
                            $cont->TPS_SPPBXML_FK = $sppb_id;
                            $cont->save();
                        }
                    endforeach;  
                }
            endforeach;
        endforeach;
        
        return back()->with('success', 'Upload SPPB PIB has been success.');
    }
    
    public function GetBC23Permit()
    {
        \SoapWrapper::add(function ($service) {
            $service
                ->name('TpsOnline')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'UserName' => $this->user, 
                    'Password' => $this->password,
                    'Kd_Gudang' => $this->kode
                ]);                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Kd_Gudang' => $this->kode
        ];
        
        // Using the added service
        \SoapWrapper::service('TpsOnline', function ($service) use ($data) {        
            $this->response = $service->call('GetBC23Permit', [$data])->GetBC23PermitResult;      
        });
        
//        var_dump($this->response);
        
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->response);
        if(!$xml || !$xml->children()){
           return back()->with('error', $this->response);
        }
        
        foreach ($xml->children() as $data):  
            foreach ($data as $key=>$value):
                if($key == 'HEADER' || $key == 'header'){           
                    $sppb = new \App\Models\TpsSppbBc;
                    foreach ($value as $keyh=>$valueh):
                        if($keyh == 'TG_BL_AWB' || $keyh == 'tg_bl_awb'){ $keyh='TGL_BL_AWB'; }
                        elseif($keyh == 'TG_MASTER_BL_AWB' || $keyh == 'tg_master_bl_awb'){ $keyh='TGL_MASTER_BL_AWB'; }
                        elseif($keyh == 'BRUTTO' || $keyh == 'brutto'){ $keyh='BRUTO'; }
                        $sppb->$keyh = $valueh;
                    endforeach;
                    $sppb->save();
                    $sppb_id = $sppb->TPS_SPPBXML_PK;
                }elseif($key == 'DETIL' || $key == 'detil'){
                    foreach ($value as $key1=>$value1):
                        if($key1 == 'KMS' || $key == 'kms'){
                            $kms = new \App\Models\TpsSppbBcKms;
                            foreach ($value1 as $keyk=>$valuek):
                                $kms->$keyk = $valuek;
                            endforeach;
                            $kms->TPS_SPPBXML_FK = $sppb_id;
                            $kms->save();
                        }elseif($key1 == 'CONT' || $key == 'cont'){
                            $cont = new \App\Models\TpsSppbBcCont;
                            foreach ($value1 as $keyc=>$valuec):
                                $cont->$keyc = $valuec;
                            endforeach;
                            $cont->TPS_SPPBXML_FK = $sppb_id;
                            $cont->save();
                        }
                    endforeach;  
                }
            endforeach;
        endforeach;
        
        return back()->with('success', 'Get SPPB BC23 has been success.');
        
    }

    public function GetDokumenManual()
    {
        \SoapWrapper::add(function ($service) {
            $service
                ->name('TpsOnline')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
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
        \SoapWrapper::service('TpsOnline', function ($service) use ($data) {        
            $this->response = $service->call('GetDokumenManual', [$data])->GetDokumenManualResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function GetRejectData()
    {
        \SoapWrapper::add(function ($service) {
            $service
                ->name('GetRejectData')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
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
        \SoapWrapper::service('GetRejectData', function ($service) use ($data) {        
            $this->response = $service->call('GetRejectData', [$data])->GetRejectDataResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function CekDataGagalKirim(Request $request)
    {
        \SoapWrapper::add(function ($service) {
            $service
                ->name('CekDataGagalKirim')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'UserName' => $this->user, 
                    'Password' => $this->password,
                    'Tgl_Awal' => date('d-m-Y', strtotime($request->tgl_awal)),
                    'Tgl_Akhir' => date('d-m-Y', strtotime($request->tgl_akhir))
                ]);                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Tgl_Awal' => date('d-m-Y', strtotime($request->tgl_awal)),
            'Tgl_Akhir' => date('d-m-Y', strtotime($request->tgl_akhir))
        ];
        
        // Using the added service
        \SoapWrapper::service('CekDataGagalKirim', function ($service) use ($data) {        
            $this->response = $service->call('CekDataGagalKirim', [$data])->CekDataGagalKirimResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function CekDataTerkirim(Request $request)
    {
        \SoapWrapper::add(function ($service) {
            $service
                ->name('CekDataTerkirim')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'UserName' => $this->user, 
                    'Password' => $this->password,
                    'Tgl_Awal' => date('d-m-Y', strtotime($request->tgl_awal)),
                    'Tgl_Akhir' => date('d-m-Y', strtotime($request->tgl_akhir))
                ]);                                                    
        });
        
        $data = [
            'UserName' => $this->user, 
            'Password' => $this->password,
            'Tgl_Awal' => date('d-m-Y', strtotime($request->tgl_awal)),
            'Tgl_Akhir' => date('d-m-Y', strtotime($request->tgl_akhir))
        ];
        
        // Using the added service
        \SoapWrapper::service('CekDataTerkirim', function ($service) use ($data) {        
            $this->response = $service->call('CekDataTerkirim', [$data])->CekDataTerkirimResult;      
        });
        
        var_dump($this->response);
        
    }
    
    public function postCoCoCont_Tes()
    {
        \SoapWrapper::add(function ($service) {
            $service
                ->name('CoCoCont_Tes')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'Username' => $this->user, 
                    'Password' => $this->password,
                    'fStream' => ''
                ]);                                                    
        });
        
        $data = [
            'Username' => $this->user, 
            'Password' => $this->password,
            'fStream' => ''
        ];
        
        // Using the added service
        \SoapWrapper::service('CoCoCont_Tes', function ($service) use ($data) {        
            $this->response = $service->call('CoCoCont_Tes', [$data])->CoCoCont_TesResult;      
        });
        
        var_dump($this->response);
    }
    
    public function postCoCoKms_Tes()
    {
        \SoapWrapper::add(function ($service) {
            $service
                ->name('CoCoKms_Tes')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'Username' => $this->user, 
                    'Password' => $this->password,
                    'fStream' => ''
                ]);                                                    
        });
        
        $data = [
            'Username' => $this->user, 
            'Password' => $this->password,
            'fStream' => ''
        ];
        
        // Using the added service
        \SoapWrapper::service('CoCoKms_Tes', function ($service) use ($data) {        
            $this->response = $service->call('CoCoKms_Tes', [$data])->CoCoKms_TesResult;      
        });
        
        var_dump($this->response);
    }
    
    public function postCoarriCodeco_Container()
    {
        
    }
    
    public function postCoarriCodeco_Kemasan()
    {
        
    }
    
}