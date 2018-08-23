<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EasygoController extends Controller
{
    protected $token;
    protected $url;
    protected $url_reply;

    public function __construct() {
        
        $this->url = 'http://vts.easygo-gps.co.id/api/';
        $this->url_reply = route('easygo-inputdo-callback');
        $this->token = '26387DC7E2BD4C3BA';
    }
    
    public function index()
    {
        
    }
    
    public function get_vts_historydata(Request $request)
    {
        $fileurl = 'get_vts_historydata.aspx';
    }
    
    public function get_vts_last_position(Request $request)
    {
        $fileurl = 'get_vts_last_position.aspx';
    }

    public function vts_inputdo(Request $request)
    {
//        $data = $request->all();
        $dispatche = \App\Models\Easygo::where('OB_ID', $request->ob_id)->orderBy('created_at', 'DESC')->first();
        
//        if($data['container_type'] == 'F'){
//            $container = \App\Models\Containercy::find($data['TCONTAINER_PK']);
//        }else{
//            $container = \App\Models\Container::find($data['TCONTAINER_PK']);
//        }
//        
//        $kode_asal = \App\Models\Lokasisandar::find($container->TLOKASISANDAR_FK);
//        
//        if(empty($kode_asal->KD_TPS_ASAL) || !isset($kode_asal->KD_TPS_ASAL))
//        {
//            return json_encode(array('success' => false, 'message' => 'Kode TPS ASAL tidak ada.'));
//        }
        
        $fileurl = 'vts_inputDO.aspx';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url.$fileurl);
        curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
        curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
        // Data to POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(     
            'token' => $this->token, // Token
            'Car_plate' => $dispatche->ESEALCODE,
            'Tgl_DO' => date('Y-m-d H:i:s', strtotime($dispatche->TGL_PLP)), // Tgl.PLP
            'Kode_asal' => $dispatche->KD_TPS_ASAL, 
            'Kode_tujuan' => $dispatche->KD_TPS_TUJUAN,
            'No_do' => $dispatche->NO_PLP, // No.PLP
//            'No_sj' => '', // No.Surat Jalan
            'No_Container' => $dispatche->NOCONTAINER,
//            'Opsi_Complete' => '',
//            'Max_time_delivery' => '',
//            'Allow_over_time' => '',
//            'Idle_time_alert' => '',
//            'Durasi_valid_tujuan' => '',
            'Container_size' => $dispatche->SIZE,
            'Container_type' => $dispatche->TYPE,
            'No_Polisi' => $dispatche->NOPOL,
//            'Telegram1' => '',
//            'Telegram2' => '',
//            'Telegram3' => '',
//            'Telegram4' => '',
//            'Telegram5' => '',
//            'Telegram6' => '',
//            'Email' => '',
            'Url_reply' => $this->url_reply,
        ));

        $dataResults = curl_exec($ch);
        curl_close($ch);
        
        $results = json_decode($dataResults);
        if(count($results) > 0){
            $wkt_dis = date('Y-m-d H:i:s');
    //        if($results->ResponseStatus == 'OK'){        
                $dispatche->STATUS_DISPATCHE = 'Y';
                $dispatche->TGL_DISPATCHE = date('Y-m-d', strtotime($wkt_dis));
                $dispatche->JAM_DISPATCHE = date('H:i:s', strtotime($wkt_dis));
    //        }
            $dispatche->DO_ID = $results->DO_ID;
            $dispatche->RESPONSE_DISPATCHE = $results->ResponseStatus;
            $dispatche->KODE_DISPATCHE = $results->ResponseCode;
            $dispatche->url_reply = $this->url_reply;

            if($dispatche->save()){
                $updateOB = \App\Models\TpsOb::where('TPSOBXML_PK', $request->ob_id)->update(['STATUS_DISPATCHE' => 'Y','DO_ID' => $results->DO_ID,'RESPONSE_DISPATCHE' => $results->ResponseStatus,'KODE_DISPATCHE' => $results->ResponseCode,'WAKTU_DISPATCHE' => $wkt_dis]);

                return json_encode(array('success' => true, 'message' => 'Dispatche successfully updated!'));
            }
        }else{
            return json_encode(array('success' => false, 'message' => 'Response Code : '.$results->ResponseCode));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function vts_close_do(Request $request)
    {
        $fileurl = 'vts_close_do.aspx';
    }
    
    public function vts_inputdo_callback(Request $request)
    {
//        "DO_ID": 103918,
//        "Status_DO": 3,
//        "GPS_TIME" : "2017-11-03 10:20:00",
//        "Address": "Jl. Mangga Dua, RW 12, Mangga Dua Selatan, Sawah Besar, Jakarta Pusat,  Jakarta, 10730",
//        "Lon": 106.82971,
//        "Lat": -6.13537
        
//        $data = $request->all();
        
//        $inset = new \App\Models\Easygo;
//        $inset->DO_ID = $request->DO_ID;
//        $inset->Status_DO = $request->Status_DO;
//        $inset->GPS_TIME = $request->GPS_TIME;
//        $inset->Address = $request->Address;
//        $inset->Lon = $request->Lon;
//        $inset->Lat = $request->Lat;
        
        $insert = \App\Models\Easygo::where('DO_ID', $request->DO_ID)->first();
        $insert->Status_DO = $request->Status_DO;
        $insert->GPS_TIME = $request->GPS_TIME;
        $insert->Address = $request->Address;
        $insert->Lon = $request->Lon;
        $insert->Lat = $request->Lat;
        
        $insert->save();
        
        return;      
    }
    
    public function getDetailDispatche(Request $request, $ob_id)
    {        
        $dispatche = \App\Models\Easygo::where('ob_id', $ob_id)->orderBy('created_at', 'DESC')->first();
        
        if($dispatche){

            return json_encode($dispatche);
        }
        
        return json_encode(array('success' => false, 'message' => 'Not Found.'));

    }

}


