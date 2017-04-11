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
        return $request->json()->all();
        $fileurl = 'vts_inputDO.aspx';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url.$fileurl);
        curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
        curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
        // Data to POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(     
            'token' => $this->token, // Token
            'Car_plate' => $request->NOPOL,
            'Tgl_DO' => $request->TGL_PLP, // Tgl.PLP
            'Kode_asal' => 'PRJP', 
            'Kode_tujuan' => 'PRJP',
            'No_do' => $request->NO_PLP, // No.PLP
            'No_sj' => '', // No.Surat Jalan
            'No_Container' => $request->NOCONTAINER,
            'Opsi_Complete' => '',
            'Max_time_delivery' => '',
            'Allow_over_time' => '',
            'Idle_time_alert' => '',
            'Durasi_valid_tujuan' => '',
            'Container_size' => '',
            'Container_type' => '',
            'No_Polisi' => '',
            'Telegram1' => '',
            'Telegram2' => '',
            'Telegram3' => '',
            'Telegram4' => '',
            'Telegram5' => '',
            'Telegram6' => '',
            'Email' => '',
            'Url_reply' => $this->url_reply,
        ));

        $data = curl_exec($ch);
        curl_close($ch);
        
        return $data;
        
        $results = json_decode($data);
    }
    
    public function vts_close_do(Request $request)
    {
        $fileurl = 'vts_close_do.aspx';
    }

}


