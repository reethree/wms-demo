<?php

namespace App\Http\Controllers\Tps;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

class NpctController extends Controller
{
    protected $wsdl;
    protected $user;
    protected $password;
    protected $kode;
    protected $response;

    public function __construct() {
        
        parent::__construct();

//        $this->wsdl = 'https://api.npct1.co.id/services/index.php/line2dev?wsdl';
        $this->wsdl = 'https://api.npct1.co.id/services/index.php/Line2?wsdl';
        $this->user = 'lini2';
        $this->password = 'lini2@2018';
        $this->kode = 'PRJP';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function yorIndex()
    {
        $data['page_title'] = "Laporan Data YOR";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Laporan Data YOR'
            ]
        ];        
        
        return view('npct.index-yor')->with($data);
    }
    
    public function MovementIndex()
    {
        $data['page_title'] = "Laporan Data Movement";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Laporan Data Movement'
            ]
        ];        
        
        return view('npct.index-movement')->with($data);
    }
    
    public function trackingIndex()
    {
        $data['page_title'] = "Data Tracking Container";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Data Tracking Container'
            ]
        ];        
        
        return view('npct.index-tracking')->with($data);
    }
    
    public function MovementContainerIndex()
    {
        $data['page_title'] = "Data Container Release";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Data Container Release'
            ]
        ];        
        
        return view('npct.index-movement-container')->with($data);
    }
    
    public function MovementContainerCreate(Request $request)
    {
        $cont_id = explode(',', $request->container_id);
        $containers = \App\Models\Containercy::whereIn('TCONTAINER_PK',$cont_id)->get();
        
        foreach ($containers as $container):
            // OUT1
//            $data[] = array(
//                'request_no' => $container->NO_PLP,
//                'request_date' => date('Ymd', strtotime($container->TGL_PLP)),
//                'warehouse_code' => $container->GUDANG_TUJUAN,
//                'container_id' => $container->TCONTAINER_PK,
//                'container_no' => $container->NOCONTAINER,
//                'message_type' => 'OUT1',
//                'action_time' => date('YmdHis', strtotime($container->TGLKELUAR_TPK.' '.$container->JAMKELUAR_TPK)),
//                'uid' => \Auth::getUser()->name
//            );
            // IN2
            $data[] = array(
                'request_no' => $container->NO_PLP,
                'request_date' => date('Ymd', strtotime($container->TGL_PLP)),
                'warehouse_code' => $container->GUDANG_TUJUAN,
                'container_id' => $container->TCONTAINER_PK,
                'container_no' => $container->NOCONTAINER,
                'message_type' => 'IN2',
                'action_time' => date('YmdHis', strtotime($container->TGLMASUK.' '.$container->JAMMASUK)),
                'uid' => \Auth::getUser()->name
            );
            // OUT2
            $data[] = array(
                'request_no' => $container->NO_PLP,
                'request_date' => date('Ymd', strtotime($container->TGL_PLP)),
                'warehouse_code' => $container->GUDANG_TUJUAN,
                'container_id' => $container->TCONTAINER_PK,
                'container_no' => $container->NOCONTAINER,
                'message_type' => 'OUT2',
                'action_time' => date('YmdHis', strtotime($container->TGLRELEASE.' '.$container->JAMRELEASE)),
                'uid' => \Auth::getUser()->name
            );
            
            \App\Models\NpctMovement::insert($data);   
            
            $data = array();
        endforeach;
        
//        return $data;
        
        return json_encode(array('success' => true, 'message' => 'Movement has been created.'));
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
        
    }
    
    public function movementUpdate(Request $request)
    {
        $action_time = date('YmdHis', strtotime($request->tgl_movement.' '.$request->jam_movement));
        $update = \App\Models\NpctMovement::where('id', $request->movement_id)->update(['action_time' => $action_time]);       
        
        if ($update){
            return back()->with('success', 'Movement data has been updated.');
        }
        
        return back()->with('error', 'Something went wrong, please try again later.');
    }

    public function movementUpload(Request $request)
    {
        $movement_id = $request->movement_id;
        $action = $request->action;
        $move_id = explode(',', $movement_id);
        
        $movements = \App\Models\NpctMovement::whereIn('id',$move_id)->get();
        
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><movement></movement>');       
        
        foreach ($movements as $move):
        
            $data = $xml->addchild('loop');
            $data->addchild('action', $action);
            $data->addchild('request_no', $move->request_no);
            $data->addchild('request_date', $move->request_date);
            $data->addchild('warehouse_code', $move->warehouse_code);
            $data->addchild('container_no', $move->container_no);
            $data->addchild('message_type', $move->message_type);
            $data->addchild('action_time', $move->action_time);
            
        endforeach;
        
//        $response = \Response::make($xml->asXML(), 200);
        
//        return $response;
        
        \SoapWrapper::add(function ($service) {
            $service
                ->name('movementRequest')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'stream_context' => stream_context_create([
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    ]),
                    'soap_version' => SOAP_1_1
                ]);                                                    
        });
        
        $reqData = [
            'username' => $this->user, 
            'Password' => $this->password,
            'data' => $xml->asXML()
        ];
        
        // Using the added service
        try {      
            \SoapWrapper::service('movementRequest', function ($service) use ($reqData) {    
    //            var_dump($service->getFunctions());
//                var_dump($service->call('movement', $reqData));
                $this->response = $service->call('movement', $reqData);      
            });
        } catch (SoapFault $exception) {
            echo $exception;      
        }
        
        $update = \App\Models\NpctMovement::whereIn('id', $move_id)->update(['action' => $action,'response' => $this->response]);       
        
        if ($update){
//            return back()->with('success', 'Laporan Movement berhasil dikirim.');
            return json_encode(array('success' => true, 'message' => 'Laporan Movement berhasil dikirim.'));
        }
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
        var_dump($this->response);
    }
    
    public function yorCreateReport(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'warehouse_code' => 'required',
            'yor' => 'required',
            'capacity' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data = $request->except(['_token']); 
        $data['status'] = 0;
        $data['uid'] = \Auth::getUser()->name;
        
        $insert_id = \App\Models\NpctYor::insertGetId($data);
        
        if($insert_id){
            return back()->with('success', 'YOR Report has been created.');
        }
        
        return back()->withInput();
    }
    
    public function yorUpload($id)
    {
        if(!$id){ return false; }
        
        $data = \App\Models\NpctYor::find($id);

        \SoapWrapper::add(function ($service) {
            $service
                ->name('yorRequestNpct')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'stream_context' => stream_context_create([
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    ]),
                    'soap_version' => SOAP_1_1
                ]);                                                    
        });
        
        $reqData = [
            'username' => $this->user, 
            'Password' => $this->password,
            'warehouse_type' => $data->warehouse_type,
            'warehouse_code' => $data->warehouse_code,
            'yor' => $data->yor,
            'capacity' => $data->capacity
        ];
//        return $reqData;
        // Using the added service
        try {      
            \SoapWrapper::service('yorRequestNpct', function ($service) use ($reqData) {    
    //            var_dump($service->getFunctions());
//                var_dump($service->call('yor', $reqData));
                $this->response = $service->call('yor', $reqData);      
            });
        } catch (\SoapFault $exception) {
            var_dump($exception);     
        }        
        
//        libxml_use_internal_errors(true);
//        $xml = simplexml_load_string($this->response);
//        if(!$xml  || !$xml->children()){
//           return back()->with('error', $this->response);
//        }
        
        $update = \App\Models\NpctYor::where('id', $id)->update(['status' => 1, 'response' => $this->response]);       
        
        if ($update){
            return back()->with('success', 'Laporan YOR berhasil dikirim.');
        }
        
        var_dump($this->response);
    }
    
    public function getdataTracking(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'container' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        \SoapWrapper::add(function ($service) {
            $service
                ->name('trackingRequest')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'stream_context' => stream_context_create([
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    ]),
                    'soap_version' => SOAP_1_1
                ]);                                                    
        });
        
        $reqData = [
            'username' => $this->user, 
            'Password' => $this->password,
            'direction' => $request->direction,
            'container' => $request->container,
        ];
        
        try {      
            \SoapWrapper::service('trackingRequest', function ($service) use ($reqData) {    
                $this->response = $service->call('tracking', $reqData);      
            });
        } catch (\SoapFault $exception) {
            var_dump($exception);     
            return false;
        } 
        
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->response);       
        
        if(!$xml || !$xml->children()){
           return back()->with('error', $this->response);
        }
        
        $data = array();
        foreach($xml->children() as $child) {      
            foreach($child as $key=>$value) {
                $data[$key]=$value;
            }
        }
        
        $respon = new \App\Models\NpctTracking;
        foreach ($data as $dkey=>$dval):
            $respon->$dkey = $dval[0];
        endforeach;
        
        if($respon->save()){
            return back()->with('success', 'Get Data Tracking has been success.');
        }
        
        var_dump($this->response);

    }
    
//    public function yorUpload1($id)
//    {
//        $data = \App\Models\NpctYor::find($id);
//        
//        $arrContextOptions = array("ssl"=>array( "verify_peer"=>false, "verify_peer_name"=>false,'allow_self_signed' => true));
//        
//        $options = array(
//            'exceptions'=>true,
//            'trace'=>1,
//            'cache_wsdl'=>WSDL_CACHE_NONE,
//            "soap_version" => SOAP_1_1,
//            'style'=> SOAP_DOCUMENT,
//            'use'=> SOAP_LITERAL, 
//            'stream_context' => stream_context_create($arrContextOptions)
//        );
//        
//        $client = new \SoapClient($this->wsdl, $options); 
//        
//        $params = array(
//            'username' => $this->user, 
//            'Password' => $this->password,
//            'warehouse_code' => $data->warehouse_code,
//            'yor' => 10000,
//            'capacity' => 20000
//        );
//        
//        try {
//            
//            $versionResponse = $client->yor();
////            var_dump($client);
//            print_r($versionResponse);
////            var_dump($client->__getFunctions());
////            $result = $client->__soapCall("yor",$params);        
////            var_dump($result);
//        } catch (SoapFault $exception) {
//            echo $exception;      
//        } 
//        
////        var_dump($client->__getFunctions());
//        
//        
//    }
    
}
