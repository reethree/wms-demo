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
                if($key == 'KODE_KANTOR'){ $key='KD_KANTOR'; }
                $obinsert->$key = $value;
            endforeach;
            $obinsert->save();
        endforeach;
        
    }
    
    public function spjmGetXml()
    {
        $xml = simplexml_load_file(url('xml/GetSPJM20160509073625.xml'));
        $header = array();
        $kms = [];
        $dok = [];
        $cont = [];
        foreach($xml->children() as $child) {
            foreach($child as $key => $value) {
                if($key == 'HEADER'){
                    $header[] = $value;
                }else{
                    foreach ($value as $key => $value):
                        if($key == 'KMS'):
                            $kms[] = $value;
                        elseif($key == 'DOK'):
                            $dok[] = $value;
                        elseif($key == 'CONT'):
                            $cont[] = $value;
                        endif;
                    endforeach;
                }
            }
        }
        
        // INSERT DATA
        $spjm = new \App\Models\TpsSpjm;
        foreach ($header[0] as $key=>$value):
            $spjm->$key = $value;
        endforeach;  
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
    
    public function sppbPibGetXml()
    {     
        $xml = simplexml_load_file(url('xml/GetImpPermit20161107071906.xml'));
        
        foreach ($xml as $data):            
            foreach ($data as $key=>$value):
                if($key == 'HEADER'){
                    $header[] = $value;
                }else{
                    
                }
            endforeach;
        endforeach;
        
        return $header;
//<DOCUMENT>
//  <SPPB>
//    <HEADER>
//      <CAR>00000000560320161107000743</CAR>
//      <NO_SPPB>468313/KPU.01/2016</NO_SPPB>
//      <TGL_SPPB>11/7/2016</TGL_SPPB>
//      <KD_KPBC>040300</KD_KPBC>
//      <NO_PIB>469318</NO_PIB>
//      <TGL_PIB>11/7/2016</TGL_PIB>
//      <NPWP_IMP>010001188092000</NPWP_IMP>
//      <NAMA_IMP>PT. BRIDGESTONE TIRE INDONESIA</NAMA_IMP>
//      <ALAMAT_IMP>THE MANOR BUILDING LT.7&amp;8 SURYA CIPTA SQUARE JL.SURYA UTAMA, KARAWANG</ALAMAT_IMP>
//      <NPWP_PPJK>
//      </NPWP_PPJK>
//      <NAMA_PPJK>
//      </NAMA_PPJK>
//      <ALAMAT_PPJK>
//      </ALAMAT_PPJK>
//      <NM_ANGKUT>NYK DANIELLA</NM_ANGKUT>
//      <NO_VOY_FLIGHT>017S</NO_VOY_FLIGHT>
//      <BRUTO>5419</BRUTO>
//      <NETTO>5089</NETTO>
//      <GUDANG>RAYA</GUDANG>
//      <STATUS_JALUR>H</STATUS_JALUR>
//      <JML_CONT>
//      </JML_CONT>
//      <NO_BC11>004544</NO_BC11>
//      <TGL_BC11>11/4/2016</TGL_BC11>
//      <NO_POS_BC11>0252</NO_POS_BC11>
//      <NO_BL_AWB>L41-6A020601</NO_BL_AWB>
//      <TG_BL_AWB>10/31/2016</TG_BL_AWB>
//      <NO_MASTER_BL_AWB>
//      </NO_MASTER_BL_AWB>
//      <TG_MASTER_BL_AWB>
//      </TG_MASTER_BL_AWB>
//    </HEADER>
//    <DETIL>
//      <KMS>
//        <CAR>00000000560320161107000743</CAR>
//        <JNS_KMS>SI</JNS_KMS>
//        <MERK_KMS>SESUAI INVOICE</MERK_KMS>
//        <JML_KMS>14</JML_KMS>
//      </KMS>
//    </DETIL>
//  </SPPB>
//  <SPPB>
//    <HEADER>
//      <CAR>00000000560320161107000744</CAR>
//      <NO_SPPB>468315/KPU.01/2016</NO_SPPB>
//      <TGL_SPPB>11/7/2016</TGL_SPPB>
//      <KD_KPBC>040300</KD_KPBC>
//      <NO_PIB>469320</NO_PIB>
//      <TGL_PIB>11/7/2016</TGL_PIB>
//      <NPWP_IMP>010001188092000</NPWP_IMP>
//      <NAMA_IMP>PT. BRIDGESTONE TIRE INDONESIA</NAMA_IMP>
//      <ALAMAT_IMP>THE MANOR BUILDING LT.7&amp;8 SURYA CIPTA SQUARE JL.SURYA UTAMA, KARAWANG</ALAMAT_IMP>
//      <NPWP_PPJK>
//      </NPWP_PPJK>
//      <NAMA_PPJK>
//      </NAMA_PPJK>
//      <ALAMAT_PPJK>
//      </ALAMAT_PPJK>
//      <NM_ANGKUT>NYK DANIELLA</NM_ANGKUT>
//      <NO_VOY_FLIGHT>017S</NO_VOY_FLIGHT>
//      <BRUTO>1512</BRUTO>
//      <NETTO>1377</NETTO>
//      <GUDANG>RAYA</GUDANG>
//      <STATUS_JALUR>H</STATUS_JALUR>
//      <JML_CONT>
//      </JML_CONT>
//      <NO_BC11>004544</NO_BC11>
//      <TGL_BC11>11/4/2016</TGL_BC11>
//      <NO_POS_BC11>0251</NO_POS_BC11>
//      <NO_BL_AWB>L41-6A020501</NO_BL_AWB>
//      <TG_BL_AWB>10/31/2016</TG_BL_AWB>
//      <NO_MASTER_BL_AWB>
//      </NO_MASTER_BL_AWB>
//      <TG_MASTER_BL_AWB>
//      </TG_MASTER_BL_AWB>
//    </HEADER>
//    <DETIL>
//      <KMS>
//        <CAR>00000000560320161107000744</CAR>
//        <JNS_KMS>SI</JNS_KMS>
//        <MERK_KMS>SESUAI  INVOICE</MERK_KMS>
//        <JML_KMS>6</JML_KMS>
//      </KMS>
//    </DETIL>
//  </SPPB>
//</DOCUMENT>
    }
}
