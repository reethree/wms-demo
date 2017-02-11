<?php

namespace App\Http\Controllers\Tps;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
   
    
    public function responPlpIndex()
    {
        if ( !$this->access->can('show.tps.responPlp.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index TPS Respon PLP', 'slug' => 'show.tps.responPlp.index', 'description' => ''));
        
        $data['page_title'] = "TPS Respon PLP";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Respon PLP'
            ]
        ];        
        
        return view('tpsonline.index-respon-plp')->with($data);
    }
    
    public function responBatalPlpIndex()
    {
        if ( !$this->access->can('show.tps.responBatalPlp.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index TPS Respon Batal PLP', 'slug' => 'show.tps.responBatalPlp.index', 'description' => ''));
        
        $data['page_title'] = "TPS Respon Batal PLP";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Respon Batal PLP'
            ]
        ];        
        
        return view('tpsonline.index-respon-batal-plp')->with($data);
    }
    
    public function obLclIndex()
    {
        if ( !$this->access->can('show.tps.obLcl.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index TPS OB LCL', 'slug' => 'show.tps.obLcl.index', 'description' => ''));
        
        $data['page_title'] = "TPS OB LCL";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS OB LCL'
            ]
        ];        
        
        return view('tpsonline.index-ob-lcl')->with($data);
    }
    
    public function obFclIndex()
    {
        if ( !$this->access->can('show.tps.obFcl.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index TPS OB FCL', 'slug' => 'show.tps.obFcl.index', 'description' => ''));
        
        $data['page_title'] = "TPS OB FCL";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS OB FCL'
            ]
        ];        
        
        return view('tpsonline.index-ob-fcl')->with($data);
    }
    
    public function spjmIndex()
    {
        if ( !$this->access->can('show.tps.spjm.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index TPS SPJM', 'slug' => 'show.tps.spjm.index', 'description' => ''));
        
        $data['page_title'] = "TPS SPJM";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS SPJM'
            ]
        ];        
        
        return view('tpsonline.index-spjm')->with($data);
    }
    
    public function dokManualIndex()
    {
        if ( !$this->access->can('show.tps.dokManual.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index TPS Dok Manual', 'slug' => 'show.tps.dokManual.index', 'description' => ''));
        
        $data['page_title'] = "TPS Dokumen Manual";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Dokumen Manual'
            ]
        ];        
        
        return view('tpsonline.index-dok-manual')->with($data);
    }
    
    public function sppbPibIndex()
    {
        if ( !$this->access->can('show.tps.sppbPib.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index TPS SPPB PIB', 'slug' => 'show.tps.sppbPib.index', 'description' => ''));
        
        $data['page_title'] = "TPS SPPB PIB";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS SPPB PIB'
            ]
        ];        
        
        return view('tpsonline.index-sppb-pib')->with($data);
    }
    
    public function sppbBcIndex()
    {
        if ( !$this->access->can('show.tps.sppbBc.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index TPS SPPB BC', 'slug' => 'show.tps.sppbBc.index', 'description' => ''));
        
        $data['page_title'] = "TPS SPPB BC23";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS SPPB BC23'
            ]
        ];        
        
        return view('tpsonline.index-sppb-bc')->with($data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function responPlpEdit($id)
    {
        if ( !$this->access->can('show.tps.responPlp.edit') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Edit TPS Respon PLP', 'slug' => 'show.tps.responPlp.edit', 'description' => ''));
        
        $data['page_title'] = "Edit TPS Respon PLP";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-responPlp-index'),
                'title' => 'Edit TPS Respon PLP'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['respon'] = \App\Models\TpsResponPlp::find($id);
        
        return view('tpsonline.edit-respon-plp')->with($data);
    }
    
    public function obEdit($id)
    {
        if ( !$this->access->can('show.tps.ob.edit') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Edit TPS OB', 'slug' => 'show.tps.ob.edit', 'description' => ''));
        
        $data['page_title'] = "Edit OB";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Edit OB'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['ob'] = \App\Models\TpsOb::find($id);
        
        return view('tpsonline.edit-ob')->with($data);
    }
    
    public function sppbPibEdit($id)
    {
        if ( !$this->access->can('show.tps.sppbPib.edit') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Edit TPS SPPB PIB', 'slug' => 'show.tps.sppbPib.edit', 'description' => ''));
        
        $data['page_title'] = "Edit SPPB PIB";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-sppbPib-index'),
                'title' => 'TPS SPPB PIB'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['sppb'] = \App\Models\TpsSppbPib::find($id);
        
        return view('tpsonline.edit-sppb-pib')->with($data);
    }
    
    public function sppbBcEdit($id)
    {
        if ( !$this->access->can('show.tps.sppbBc.edit') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Edit TPS SPPB BC', 'slug' => 'show.tps.sppbBc.edit', 'description' => ''));
        
        $data['page_title'] = "Edit SPPB BC23";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-sppbBc-index'),
                'title' => 'TPS SPPB BC23'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['sppb'] = \App\Models\TpsSppbBc::find($id);
        
        return view('tpsonline.edit-sppb-bc')->with($data);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    public function responPlpUpdate(Request $request, $id)
    {
        
    }
    
    public function sppbPibUpdate(Request $request, $id)
    {
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }    
    
    public function responPlpGetXml()
    {
        $xml = simplexml_load_file(url('xml/GetImpPLPCONT20161108011403.xml'));
        $header = array();
        $details = [];
        foreach($xml->children() as $child) {
            foreach($child as $key => $value) {
                if($key == 'HEADER'){
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
        
    }
    
    public function responBatalPlpGetXml()
    {
        
    }
    
    public function obGetXml()
    {
        $xml = simplexml_load_file(url('xml/GetImpOB20161108012409.xml'));
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
        
    }
    
    public function spjmGetXml()
    {
        $xml = simplexml_load_file(url('xml/GetSpjm26012017.xml'));
        
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
//                $check = \App\Models\TpsSpjm::where('CAR', $spjm->car)->count();
//                if($check > 0) { continue; }

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
        
        return back()->with('success', 'Success.');
    }
    
    public function sppbPibGetXml()
    {     
        $xml = simplexml_load_file(url('xml/GetImpPermit20161107071906.xml'));

        foreach ($xml->children() as $data):  
            foreach ($data as $key=>$value):
                if($key == 'HEADER'){           
                    $sppb = new \App\Models\TpsSppbPib;
                    foreach ($value as $keyh=>$valueh):
                        if($keyh == 'TG_BL_AWB'){ $keyh='TGL_BL_AWB'; }
                        elseif($keyh == 'TG_MASTER_BL_AWB'){ $keyh='TGL_MASTER_BL_AWB'; }
                        $sppb->$keyh = $valueh;
                    endforeach;
                    $sppb->save();
                    $sppb_id = $sppb->TPS_SPPBXML_PK;
                }elseif($key == 'DETIL'){
                    foreach ($value as $key1=>$value1):
                        if($key1 == 'KMS'){
                            $kms = new \App\Models\TpsSppbPibKms;
                            foreach ($value1 as $keyk=>$valuek):
                                $kms->$keyk = $valuek;
                            endforeach;
                            $kms->TPS_SPPBXML_FK = $sppb_id;
                            $kms->save();
                        }elseif($key1 == 'CONT'){
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
        
    }
    
    public function sppbBcGetXml()
    {     
        $xml = simplexml_load_file(url('xml/GetImpPermitBC2320161111091704.xml'));

        foreach ($xml->children() as $data):  
            foreach ($data as $key=>$value):
                if($key == 'HEADER'){           
                    $sppb = new \App\Models\TpsSppbBc;
                    foreach ($value as $keyh=>$valueh):
                        if($keyh == 'TG_BL_AWB'){ $keyh='TGL_BL_AWB'; }
                        elseif($keyh == 'TG_MASTER_BL_AWB'){ $keyh='TGL_MASTER_BL_AWB'; }
                        elseif($keyh == 'BRUTTO'){ $keyh='BRUTO'; }
                        $sppb->$keyh = $valueh;
                    endforeach;
                    $sppb->save();
                    $sppb_id = $sppb->TPS_SPPBXML_PK;
                }elseif($key == 'DETIL'){
                    foreach ($value as $key1=>$value1):
                        if($key1 == 'KMS'){
                            $kms = new \App\Models\TpsSppbBcKms;
                            foreach ($value1 as $keyk=>$valuek):
                                $kms->$keyk = $valuek;
                            endforeach;
                            $kms->TPS_SPPBXML_FK = $sppb_id;
                            $kms->save();
                        }elseif($key1 == 'CONT'){
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
        
    }
}
