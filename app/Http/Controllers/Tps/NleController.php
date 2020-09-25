<?php

namespace App\Http\Controllers\Tps;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NleController extends Controller
{
    protected $prod_url;
    protected $dev_url;
    protected $platform_id;
    protected $key;

    public function __construct() {
        
        parent::__construct();
        
        $this->prod_url = 'https://nlehub.kemenkeu.go.id/V1/NLE/document_sp2';
        $this->dev_url = 'https://esbbcext01.beacukai.go.id:8090/document_sp2/final/';
        $this->platform_id = 'TO011';
        $this->key = '1eb1df99-81c5-44dd-b381-8acfed30f283';
    }

    public function index(Request $request)
    {
        if ( !$this->access->can('show.nle.sp2.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Data Container SP2', 'slug' => 'show.nle.sp2.index', 'description' => ''));
        
        $data['page_title'] = "Data Container SP2";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Data Container SP2'
            ]
        ];        
        
        if($request->date){
            $data['date'] = $request->date;
        }else{
            $data['date'] = date('Y-m-d');
        }
        
        return view('nle.sp2.index')->with($data);
    }
    
    public function create(Request $request)
    {
        $data = $request->all(); 
        $ids = explode(',', $data['id']);        
        $consignee_id = $data['consignee_id'];
        $server = $data['server'];
        
        unset($data['id'], $data['consignee_id'], $data['server'], $data['_token']);
        
        $containers = \App\Models\Containercy::whereIn('TCONTAINER_PK', $ids)->orderBy('TCONTAINER_PK', 'ASC')->get();
        
        if(count($containers) > 0){
        
            $datacont = array();
            foreach ($containers as $cont):
                $contheader = $cont;
                $datacont[] = array(
                    "container_no" => $cont->NOCONTAINER,
                    "container_size" => $cont->SIZE,
                    "container_type" => $cont->jenis_container,
                    "gate_pass" => route('barcode-print-pdf', array('fcl', $cont->TCONTAINER_PK))
                );
            endforeach;

            if(in_array($contheader->KD_DOK_INOUT, array(1,2,41))){
                if($contheader->KD_DOK_INOUT == 41){
                    $kd_doc = 3;
                }else{
                    $kd_doc = $contheader->KD_DOK_INOUT;
                }
            }else{
                return back()->with('error', 'Kode Dokumen Tidak Sesuai.');
            }
            
            //99.999.999.9-999.999
//            $npwp = $data['npwp_cargo_owner'];
//            $split = str_split($npwp);
//            $format = $split[0].$split[1].'.'.$split[2].$split[3].$split[4].'.'.$split[5].$split[6].$split[7].'.'.$split[8].'-'.$split[9].$split[10].$split[11].'.'.$split[12].$split[13].$split[14];
//
//            $data['npwp_cargo_owner'] = $format;
            
            $data['kd_document_type'] = $kd_doc;
            $data['document_no'] = $contheader->NO_DAFTAR_PABEAN;
            $data['document_date'] = $contheader->TGL_DAFTAR_PABEAN;
            $data['no_doc_release'] = $contheader->NO_SPPB;
            $data['date_doc_release'] = $contheader->TGL_SPPB;
            $data['document_status'] = "SPPB";
            $data['bl_no'] = $contheader->NO_BL_AWB;
            $data['bl_date'] = $contheader->TGL_BL_AWB;  
            $data['id_platform'] = $this->platform_id;
            $data['terminal'] = $contheader->KD_TPS_ASAL;
            $data['status'] = "Finish";
            $data['is_finished'] = 1;
            $data['party'] = count($datacont);
            $data['container'] = @serialize($datacont);
            $data['uid'] = \Auth::getUser()->name;

            if($server == 'dev'){
                $url = $this->dev_url;
                $url_name = 'Development';
            }elseif($server == 'prod'){
                $url = $this->prod_url;
                $url_name = 'Production';
            }
            
            $data['url'] = $url;
            $data['url_name'] = $url_name;

            // Insert Data
            $insert = \App\Models\NleSp2::insert($data);

            if($insert){
                return back()->with('success', 'Dokumen SP2 berhasih dibuat.');
            }
        }
        
        return back()->with('error', 'Something went wrong, please try again later.');
    }
    
    public function document()
    {
        if ( !$this->access->can('show.nle.sp2.doc') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'NLE Document SP2', 'slug' => 'show.nle.sp2.doc', 'description' => ''));
        
        $data['page_title'] = "NLE Pengiriman Dokumen SP2";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'NLE Pengiriman Dokumen SP2'
            ]
        ];        
        
        return view('nle.sp2.doc')->with($data);
    }
    
    public function getDataSubGrid(Request $request)
    {
        $doc = \App\Models\NleSp2::find($request->id);
        
        $conts = @unserialize($doc->container);
        
        $data = [];
        $data['total'] = count($conts);
        $data['records'] = count($conts);
        $data['page'] = 1;
        $data['rows'] = $conts;

        return response()->json($data);
    }
    
    public function documentUpload($id)
    {
        $doc = \App\Models\NleSp2::find($id);
        
        $datapost = array(
            "kd_document_type" => $doc->kd_document_type,
            "npwpCargoOwner" => $doc->npwp_cargo_owner,
            "nm_cargoowner" => $doc->nm_cargoowner,
            "document_no" => $doc->document_no,
            "document_date" => $doc->document_date,
            "no_doc_release" => $doc->no_doc_release,
            "date_doc_release" => $doc->date_doc_release,
            "document_status" => $doc->document_status,
            "bl_no" => $doc->bl_no,
            "bl_date" => $doc->bl_date,
            "id_platform" => $doc->id_platform,
            "terminal" => $doc->terminal,
            "paid_thrud_date" => $doc->paid_thrud_date,
            "proforma" => $doc->proforma,
            "proforma_date" => $doc->proforma_date,
            "price" => $doc->price,
            "status" => $doc->status,
            "is_finished" => $doc->is_finished,
            "party" => $doc->party,
            "container" => @unserialize($doc->container)
        );
        
        $payload =  json_encode($datapost);

        $header[] = 'Content-Type: application/json';
        $header[] = 'Access-Control-Allow-Origin: *';
        $header[] = 'Accept: */*';
        $header[] = 'Content-Length: ' . strlen($payload);
        $header[] = "beacukai-api-key: " . $this->key;
	$header[] = "Accept-Encoding: gzip, deflate, br";
//      $header[] = "Content-Encoding: gzip, deflate, br";
//	$header[] = "Accept-Language: en-US,en;q=0.8,id;q=0.6";
//      $header[] = "Cache-Control: max-age=0";
//	$header[] = "Connection: keep-alive";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $doc->url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
                
        $dataResults = curl_exec($ch);
        
        curl_close($ch);
        
        if($dataResults){
            $doc->response = $dataResults;
            $doc->save();
            return back()->with('success', 'Dokumen SP2 berhasih dikirim.');
        }
        
        return back()->with('error', 'Something went wrong, please try again later.');

    }
}