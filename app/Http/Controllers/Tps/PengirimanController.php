<?php

namespace App\Http\Controllers\Tps;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

class PengirimanController extends Controller
{
    protected $wsdl;
    protected $user;
    protected $password;
    protected $kode;
    protected $response;

    public function __construct() {
        
        parent::__construct();
        
        $this->wsdl = 'https://tpsonline.beacukai.go.id/tps/service.asmx?WSDL';
        $this->user = 'PRJP';
        $this->password = 'PRIMANATA';
        $this->kode = 'PRJP';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
   
    public function coariContIndex()
    {
        if ( !$this->access->can('show.tps.coariCont.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Coari Container";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Coari Container'
            ]
        ];        
        
        return view('tpsonline.index-coari-cont')->with($data);
    }
    
    public function coariKmsIndex()
    {
        if ( !$this->access->can('show.tps.coariKms.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Coari Kemasan";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Coari Kemasan'
            ]
        ];        
        
        return view('tpsonline.index-coari-kms')->with($data);
    }

    public function codecoContFclIndex()
    {
        if ( !$this->access->can('show.tps.codecoContFcl.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Codeco Cont FCL";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Codeco Cont FCL'
            ]
        ];        
        
        return view('tpsonline.index-codeco-cont-fcl')->with($data);
    }
    
    public function codecoContBuangMtyIndex()
    {
        if ( !$this->access->can('show.tps.codecoContBuangMty.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Codeco Cont Buang MTY";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Codeco Cont Buang MTY'
            ]
        ];        
        
        return view('tpsonline.index-codeco-cont-buangmty')->with($data);
    }
    
    public function codecoKmsIndex()
    {
        if ( !$this->access->can('show.tps.codecoKms.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Codeco Kemasan";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Codeco Kemasan'
            ]
        ];        
        
        return view('tpsonline.index-codeco-kms')->with($data);
    }
    
    public function realisasiBongkarMuatIndex()
    {
        if ( !$this->access->can('show.tps.realisasiBongkarMuat.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Total Realisasi Bongkar Muat";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Realisasi Bongkar Muat'
            ]
        ];        
        
        return view('tpsonline.index-realisasi-bongkar-muat')->with($data);
    }
    
    public function laporanYorIndex()
    {
        if ( !$this->access->can('show.tps.laporanYor.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Laporan YOR";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Laporan YOR'
            ]
        ];        
        
        return view('tpsonline.index-laporan-yor')->with($data);
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

    public function laporanYorStore(Request $request)
    {
        $lapYor = new \App\Models\TpsLaporanYor;
        
        $reff_number = $this->getReffNumber();
        
        $lapYor->REF_NUMBER = $reff_number;
        $lapYor->KD_TPS = 'PRJP';
        $lapYor->KD_GUDANG = 'PRJP';
        $lapYor->TGL_LAPORAN = date('Ymd', strtotime($request->TGL_LAPORAN));
        $lapYor->RESPONSE = 'Belum Upload';
        $lapYor->uid = \Auth::getUser()->name;
        
        if($lapYor->save()){
            $lapYorDetail = new \App\Models\TpsLaporanYorDetail;
            
            $lapYorDetail->tpslaporanyor_id = $lapYor->id;
            $lapYorDetail->TYPE = 'IMPOR';
            $lapYorDetail->YOR = $request->YOR ;
            $lapYorDetail->KAPASITAS_LAPANGAN = $request->KAPASITAS_LAPANGAN;
            $lapYorDetail->KAPASITAS_GUDANG = $request->KAPASITAS_GUDANG;
            $lapYorDetail->TOTAL_CONT = $request->TOTAL_CONT;
            $lapYorDetail->TOTAL_KMS = $request->TOTAL_KMS;
            $lapYorDetail->JML_CONT20F = $request->JML_CONT20F;
            $lapYorDetail->JML_CONT40F = $request->JML_CONT40F;
            $lapYorDetail->JML_CONT45F = $request->JML_CONT45F;
            
            if($lapYorDetail->save()){
                return back()->with('success', 'Laporan YOR Refnumber '.$reff_number.', invoice berhasih dibuat.');
            }  
        }
        
        return back()->with('error', 'Something went wrong, please try again later.');
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
    
    public function coariContEdit($id)
    {
        if ( !$this->access->can('show.tps.coariCont.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit TPS COARI CONT";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-coariCont-index'),
                'title' => 'TPS COARI CONT'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['header'] = \App\Models\TpsCoariCont::find($id);
        $data['detail'] = \App\Models\TpsCoariContDetail::where('TPSCOARICONTXML_FK', $id)->first();
        
        return view('tpsonline.edit-coari-cont')->with($data);
    }
    
    public function coariKmsEdit($id)
    {
        if ( !$this->access->can('show.tps.coariKms.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit TPS COARI Kemasan";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-coariKms-index'),
                'title' => 'TPS COARI Kemasan'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['header'] = \App\Models\TpsCoariKms::find($id);
//        $data['detail'] = \App\Models\TpsCoariKmsDetail::where('TPSCOARIKMSXML_FK', $id)->first();
        
        return view('tpsonline.edit-coari-kms')->with($data);
    }
    
    public function codecoContFclEdit($id)
    {
        if ( !$this->access->can('show.tps.codecoCont.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit TPS CODECO CONT";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-codecoContFcl-index'),
                'title' => 'TPS CODECO CONT'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['header'] = \App\Models\TpsCodecoContFcl::find($id);
        $data['detail'] = \App\Models\TpsCodecoContFclDetail::where('TPSCODECOCONTXML_FK', $id)->first();
        
        return view('tpsonline.edit-codeco-cont')->with($data);
    }
    
    public function codecoContBuangMtyEdit($id)
    {
        if ( !$this->access->can('show.tps.codecoContBuangMty.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit TPS CODECO Buang MTY";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-codecoContBuangMty-index'),
                'title' => 'TPS CODECO Buang MTY'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['header'] = \App\Models\TpsCodecoContFcl::find($id);
        $data['detail'] = \App\Models\TpsCodecoContFclDetail::where('TPSCODECOCONTXML_FK', $id)->first();
        
        return view('tpsonline.edit-codeco-buang-mty')->with($data);
    }
    
    public function codecoKmsEdit($id)
    {
        if ( !$this->access->can('show.tps.codecoKms.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit TPS CODECO Kemasan";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-codecoKms-index'),
                'title' => 'TPS CODECO Kemasan'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['header'] = \App\Models\TpsCodecoKms::find($id);
//        $data['detail'] = \App\Models\TpsCoariKmsDetail::where('TPSCOARIKMSXML_FK', $id)->first();
        
        return view('tpsonline.edit-codeco-kms')->with($data);
    }
    
    public function laporanYorEdit($id)
    {
        if ( !$this->access->can('show.tps.laporanYor.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit TPS Laporan Yor";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-laporanYor-index'),
                'title' => 'TPS Laporan YOR'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['header'] = \App\Models\TpsLaporanYor::find($id);
        $data['details'] = \App\Models\TpsLaporanYorDetail::where('tpslaporanyor_id', $id)->get();

        return view('tpsonline.edit-laporan-yor')->with($data);
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
    
    public function coariContUpdate(Request $request, $id)
    {
        $data = $request->all();

        $detail_id = $data['TPSCOARICONTDETAILXML_PK'];
        unset($data['TPSCOARICONTDETAILXML_PK'], $data['_token']);
        
        $update = \App\Models\TpsCoariContDetail::where('TPSCOARICONTDETAILXML_PK', $detail_id)
            ->update($data);
        
        if($update){
            return back()->with('success', 'COARI Container Detail successfully updated!');
        }
        
        return back()->with('error', 'Something went wrong, please try again later.')->withInput();
    }
    
    public function codecoContUpdate(Request $request, $id)
    {
        $data = $request->json()->all();
    }

    public function coariKmsDetailUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TPSCOARIKMSDETAILXML_PK'], $data['_token']);
        
        $update = \App\Models\TpsCoariKmsDetail::where('TPSCOARIKMSDETAILXML_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'COARI Kemasan Detail successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function codecoKmsDetailUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TPSCODECOKMSDETAILXML_PK'], $data['_token']);
        
        $update = \App\Models\TpsCodecoKmsDetail::where('TPSCODECOKMSDETAILXML_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'CODECO Kemasan Detail successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
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
    
    public function coariContCreateXml($id)
    {
        
        if(!$id){ return false; }
        
        $dataHeader = \App\Models\TpsCoariCont::find($id);
        $dataDetail = \App\Models\TpsCoariContDetail::where('TPSCOARICONTXML_FK', $dataHeader->TPSCOARICONTXML_PK)->first();
        
        if($dataDetail->STATUS_TPS == 2){
            $reff_number = $this->getReffNumber();
            $dataDetail->REF_NUMBER = $reff_number;
            $dataDetail->FLAG_REVISI = (empty($dataDetail->FLAG_REVISI) ? 0 : $dataDetail->FLAG_REVISI) + 1;
            $dataDetail->TGL_REVISI = date('Y-m-d H:i:s');
            $dataDetail->STATUS_TPS = 1;
            
            $dataDetail->save();
        }
        
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><DOCUMENT></DOCUMENT>');
        
        $xmldata = $xml->addAttribute('xmlns', 'cococont.xsd');
        $xmldata = $xml->addchild('COCOCONT');
        $header = $xmldata->addchild('HEADER');
        $detail = $xmldata->addchild('DETIL');
        $cont = $detail->addChild('CONT');
        
        $header->addChild('KD_DOK', ($dataDetail->KD_DOK != '') ? $dataDetail->KD_DOK : '');
        $header->addChild('KD_TPS', ($dataDetail->KD_TPS != '') ? $dataDetail->KD_TPS : '');
        $header->addChild('NM_ANGKUT', ($dataDetail->NM_ANGKUT != '') ? $dataDetail->NM_ANGKUT : '');
        $header->addChild('NO_VOY_FLIGHT', ($dataDetail->NO_VOY_FLIGHT != '') ? $dataDetail->NO_VOY_FLIGHT : '');
        $header->addChild('CALL_SIGN', ($dataDetail->CALL_SIGN != '') ? $dataDetail->CALL_SIGN : '');
        $header->addChild('TGL_TIBA', ($dataDetail->TGL_TIBA != '') ? $dataDetail->TGL_TIBA : '');
        $header->addChild('KD_GUDANG', ($dataDetail->KD_GUDANG != '') ? $dataDetail->KD_GUDANG : '');
        $header->addChild('REF_NUMBER', ($dataHeader->REF_NUMBER != '') ? $dataDetail->REF_NUMBER : '');
        
        $cont->addChild('NO_CONT', ($dataDetail->NO_CONT != '') ? $dataDetail->NO_CONT : '');
        $cont->addChild('UK_CONT', ($dataDetail->UK_CONT != '') ? $dataDetail->UK_CONT : '');
        $cont->addChild('NO_SEGEL', ($dataDetail->NO_SEGEL != '') ? $dataDetail->NO_SEGEL : '');
        $cont->addChild('JNS_CONT', ($dataDetail->JNS_CONT != '') ? $dataDetail->JNS_CONT : '');
        $cont->addChild('NO_BL_AWB', ($dataDetail->NO_BL_AWB != '') ? $dataDetail->NO_BL_AWB : '');
        $cont->addChild('TGL_BL_AWB', ($dataDetail->TGL_BL_AWB != '') ? $dataDetail->TGL_BL_AWB : '');
        $cont->addChild('NO_MASTER_BL_AWB', ($dataDetail->NO_MASTER_BL_AWB != '') ? $dataDetail->NO_MASTER_BL_AWB : '');
        $cont->addChild('TGL_MASTER_BL_AWB', ($dataDetail->TGL_MASTER_BL_AWB != '') ? $dataDetail->TGL_MASTER_BL_AWB : '');
        $cont->addChild('ID_CONSIGNEE', ($dataDetail->ID_CONSIGNEE != 000000000000000) ? $dataDetail->ID_CONSIGNEE : '');
        $cont->addChild('CONSIGNEE', ($dataDetail->CONSIGNEE != '') ? $dataDetail->CONSIGNEE : '');
        $cont->addChild('BRUTO', ($dataDetail->BRUTO != '') ? $dataDetail->BRUTO : '');
        $cont->addChild('NO_BC11', ($dataDetail->NO_BC11 != '') ? $dataDetail->NO_BC11 : '');
        $cont->addChild('TGL_BC11', ($dataDetail->TGL_BC11 != '') ? $dataDetail->TGL_BC11 : '');        
        $cont->addChild('NO_POS_BC11', ($dataDetail->NO_POS_BC11 != '') ? $dataDetail->NO_POS_BC11 : '');
        $cont->addChild('KD_TIMBUN', ($dataDetail->KD_TIMBUN != '') ? $dataDetail->KD_TIMBUN : '');
        $cont->addChild('KD_DOK_INOUT', ($dataDetail->KD_DOK_INOUT != '') ? $dataDetail->KD_DOK_INOUT : '');
        $cont->addChild('NO_DOK_INOUT', ($dataDetail->NO_DOK_INOUT != '') ? $dataDetail->NO_DOK_INOUT : '');
        $cont->addChild('TGL_DOK_INOUT', ($dataDetail->TGL_DOK_INOUT != '') ? $dataDetail->TGL_DOK_INOUT : '');
        $cont->addChild('WK_INOUT', ($dataDetail->WK_INOUT != '') ? $dataDetail->WK_INOUT : '');
        $cont->addChild('KD_SAR_ANGKUT_INOUT', ($dataDetail->KD_SAR_ANGKUT_INOUT != '') ? $dataDetail->KD_SAR_ANGKUT_INOUT : '');
        $cont->addChild('NO_POL', ($dataDetail->NO_POL != '') ? $dataDetail->NO_POL : '');
        $cont->addChild('FL_CONT_KOSONG', ($dataDetail->FL_CONT_KOSONG != '') ? $dataDetail->FL_CONT_KOSONG : '');
        $cont->addChild('ISO_CODE', ($dataDetail->ISO_CODE != '') ? $dataDetail->ISO_CODE : '');
        $cont->addChild('PEL_MUAT', ($dataDetail->PEL_MUAT != '') ? $dataDetail->PEL_MUAT : '');
        $cont->addChild('PEL_TRANSIT', ($dataDetail->PEL_TRANSIT != '') ? $dataDetail->PEL_TRANSIT : '');
        $cont->addChild('PEL_BONGKAR', ($dataDetail->PEL_BONGKAR != '') ? $dataDetail->PEL_BONGKAR : '');
        $cont->addChild('GUDANG_TUJUAN', ($dataDetail->GUDANG_TUJUAN != '') ? $dataDetail->GUDANG_TUJUAN : '');
        $cont->addChild('KODE_KANTOR', ($dataDetail->KODE_KANTOR != '') ? $dataDetail->KODE_KANTOR : '');
        $cont->addChild('NO_DAFTAR_PABEAN', ($dataDetail->NO_DAFTAR_PABEAN != '') ? $dataDetail->NO_DAFTAR_PABEAN : '');
        $cont->addChild('TGL_DAFTAR_PABEAN', ($dataDetail->TGL_DAFTAR_PABEAN != '') ? $dataDetail->TGL_DAFTAR_PABEAN : '');
        $cont->addChild('NO_SEGEL_BC', ($dataDetail->NO_SEGEL_BC != '') ? $dataDetail->NO_SEGEL_BC : '');
        $cont->addChild('TGL_SEGEL_BC', ($dataDetail->TGL_SEGEL_BC != '') ? $dataDetail->TGL_SEGEL_BC : '');
        $cont->addChild('NO_IJIN_TPS', ($dataDetail->NO_IJIN_TPS != '') ? $dataDetail->NO_IJIN_TPS : '');
        $cont->addChild('TGL_IJIN_TPS', ($dataDetail->TGL_IJIN_TPS != '') ? $dataDetail->TGL_IJIN_TPS : '');
        
//        $xml->saveXML('xml/CoariContainer'. date('Ymd'). $dataDetail->NO_DOK_INOUT .'.xml');
//
//        $response = \Response::make($xml->asXML(), 200);
//
//        $response->header('Cache-Control', 'public');
//        $response->header('Content-Description', 'File Transfer');
//        $response->header('Content-Disposition', 'attachment; filename=xml/CoariContainer'. date('ymd'). $dataDetail->NO_DOK_INOUT .'.xml');
//        $response->header('Content-Transfer-Encoding', 'binary');
//        $response->header('Content-Type', 'text/xml');

//        return $xml->asXML();
        
        // SEND
        \SoapWrapper::add(function ($service) {
            $service
//                ->name('CoCoCont_Tes')
                ->name('CoarriCodeco_Container')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'stream_context' => stream_context_create([
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    ])
                ]);                                                      
        });
        
        $datas = [
            'Username' => $this->user, 
            'Password' => $this->password,
            'fStream' => $xml->asXML()
        ];
        
        // Using the added service
        \SoapWrapper::service('CoarriCodeco_Container', function ($service) use ($datas) {        
            $this->response = $service->call('CoarriCodeco_Container', [$datas])->CoarriCodeco_ContainerResult;      
        });
        
        $dataDetail->STATUS_TPS = 2;
        $dataDetail->RESPONSE = $this->response;
        
        if ($dataDetail->save()){
            return back()->with('success', 'Coari Container XML REF Number: '.$dataHeader->REF_NUMBER.' berhasil dikirim.');
        }
        
        var_dump($this->response);
        
    }
    
    public function coariKmsCreateXml($id)
    {
        if(!$id){ return false; }
        
        $dataHeader = \App\Models\TpsCoariKms::find($id);
        $dataDetail = \App\Models\TpsCoariKmsDetail::where('TPSCOARIKMSXML_FK', $dataHeader->TPSCOARIKMSXML_PK)->first();
        $dataDetails = \App\Models\TpsCoariKmsDetail::where('TPSCOARIKMSXML_FK', $dataHeader->TPSCOARIKMSXML_PK)->get();
        
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><DOCUMENT></DOCUMENT>');       
        
        $xmldata = $xml->addAttribute('xmlns', 'cocokms.xsd');
        $xmldata = $xml->addchild('COCOKMS');
        $header = $xmldata->addchild('HEADER');
        $detail = $xmldata->addchild('DETIL');
        
        $header->addChild('KD_DOK', $dataDetail->KD_DOK);
        $header->addChild('KD_TPS', $dataDetail->KD_TPS);
        $header->addChild('NM_ANGKUT', $dataDetail->NM_ANGKUT);
        $header->addChild('NO_VOY_FLIGHT', $dataDetail->NO_VOY_FLIGHT);
        $header->addChild('CALL_SIGN', $dataDetail->CALL_SIGN);
        $header->addChild('TGL_TIBA', $dataDetail->TGL_TIBA);
        $header->addChild('KD_GUDANG', $dataDetail->KD_GUDANG);
        $header->addChild('REF_NUMBER', $dataHeader->REF_NUMBER);
        
        foreach ($dataDetails as $dataDetailkms):
            $kms = $detail->addChild('KMS');
        
            $kms->addChild('NO_BL_AWB', $dataDetailkms->NO_BL_AWB);
            $kms->addChild('TGL_BL_AWB', $dataDetailkms->TGL_BL_AWB); 
            $kms->addChild('NO_MASTER_BL_AWB', $dataDetailkms->NO_MASTER_BL_AWB); 
            $kms->addChild('TGL_MASTER_BL_AWB', $dataDetailkms->TGL_MASTER_BL_AWB); 
            $kms->addChild('ID_CONSIGNEE', ($dataDetailkms->ID_CONSIGNEE != 000000000000000) ? $dataDetailkms->ID_CONSIGNEE : '');
            $kms->addChild('CONSIGNEE', htmlspecialchars($dataDetailkms->CONSIGNEE));
            $kms->addChild('BRUTO', $dataDetailkms->BRUTO);
            $kms->addChild('NO_BC11', $dataDetailkms->NO_BC11);
            $kms->addChild('TGL_BC11', $dataDetailkms->TGL_BC11 );
            $kms->addChild('NO_POS_BC11', $dataDetailkms->NO_POS_BC11 );
            $kms->addChild('CONT_ASAL', $dataDetailkms->CONT_ASAL );
            $kms->addChild('SERI_KEMAS', $dataDetailkms->SERI_KEMAS );
            $kms->addChild('KD_KEMAS', $dataDetailkms->KD_KEMAS );
            $kms->addChild('JML_KEMAS', $dataDetailkms->JML_KEMAS );
            $kms->addChild('KD_TIMBUN', $dataDetailkms->KD_TIMBUN );
            $kms->addChild('KD_DOK_INOUT', $dataDetailkms->KD_DOK_INOUT );
            $kms->addChild('NO_DOK_INOUT', $dataDetailkms->NO_DOK_INOUT );
            $kms->addChild('TGL_DOK_INOUT', $dataDetailkms->TGL_DOK_INOUT );
            $kms->addChild('WK_INOUT', $dataDetailkms->WK_INOUT );
            $kms->addChild('KD_SAR_ANGKUT_INOUT', $dataDetailkms->KD_SAR_ANGKUT_INOUT );
            $kms->addChild('NO_POL', $dataDetailkms->NO_POL);
            $kms->addChild('PEL_MUAT', $dataDetailkms->PEL_MUAT );
            $kms->addChild('PEL_TRANSIT', $dataDetailkms->PEL_TRANSIT );
            $kms->addChild('PEL_BONGKAR', $dataDetailkms->PEL_BONGKAR );
            $kms->addChild('GUDANG_TUJUAN', $dataDetailkms->GUDANG_TUJUAN );
            $kms->addChild('KODE_KANTOR', $dataDetailkms->KODE_KANTOR );
            $kms->addChild('NO_DAFTAR_PABEAN', $dataDetailkms->NO_DAFTAR_PABEAN );
            $kms->addChild('TGL_DAFTAR_PABEAN', $dataDetailkms->TGL_DAFTAR_PABEAN );
            $kms->addChild('NO_SEGEL_BC', $dataDetailkms->NO_SEGEL_BC);
            $kms->addChild('TGL_SEGEL_BC', $dataDetailkms->TGL_SEGEL_BC );
            $kms->addChild('NO_IJIN_TPS', $dataDetailkms->NO_IJIN_TPS );
            $kms->addChild('TGL_IJIN_TPS', $dataDetailkms->TGL_IJIN_TPS);
            
        endforeach;
        
//        $xml->saveXML('xml/CoariKMS'. date('Ymd'). $dataDetail->NO_DOK_INOUT .'.xml');
//
//        $response = \Response::make($xml->asXML(), 200);
//
//        $response->header('Cache-Control', 'public');
//        $response->header('Content-Description', 'File Transfer');
//        $response->header('Content-Disposition', 'attachment; filename=xml/CoariKemasan'. date('ymd'). $dataDetail->NO_DOK_INOUT .'.xml');
//        $response->header('Content-Transfer-Encoding', 'binary');
//        $response->header('Content-Type', 'text/xml');
        
        \SoapWrapper::add(function ($service) {
            $service
//                ->name('CoCoKms_Tes')
                ->name('CoarriCodeco_Kemasan')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'stream_context' => stream_context_create([
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    ])
                ]);                                                  
        });
        
        $data = [
            'Username' => $this->user, 
            'Password' => $this->password,
            'fStream' => $xml->asXML()
        ];
        
        // Using the added service
        \SoapWrapper::service('CoarriCodeco_Kemasan', function ($service) use ($data) {        
            $this->response = $service->call('CoarriCodeco_Kemasan', [$data])->CoarriCodeco_KemasanResult;      
        });
        
        $update = \App\Models\TpsCoariKmsDetail::where('TPSCOARIKMSXML_FK', $dataHeader->TPSCOARIKMSXML_PK)->update(['STATUS_TPS' => 2, 'RESPONSE' => $this->response]);       
        
        if ($update){
            return back()->with('success', 'Coari Kemasan XML REF Number: '.$dataHeader->REF_NUMBER.' berhasil dikirim.');
        }
        
        var_dump($this->response);
    }
    
    public function codecoContCreateXml($id)
    {
        if(!$id){ return false; }
        
        $dataHeader = \App\Models\TpsCodecoContFcl::find($id);
        $dataDetail = \App\Models\TpsCodecoContFclDetail::where('TPSCODECOCONTXML_FK', $dataHeader->TPSCODECOCONTXML_PK)->first();
        
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><DOCUMENT></DOCUMENT>');
        
        $xmldata = $xml->addAttribute('xmlns', 'cococont.xsd');
        $xmldata = $xml->addchild('COCOCONT');
        $header = $xmldata->addchild('HEADER');
        $detail = $xmldata->addchild('DETIL');
        $cont = $detail->addChild('CONT');
        
        $header->addChild('KD_DOK', ($dataDetail->KD_DOK != '') ? $dataDetail->KD_DOK : '');
        $header->addChild('KD_TPS', ($dataDetail->KD_TPS != '') ? $dataDetail->KD_TPS : '');
        $header->addChild('NM_ANGKUT', ($dataDetail->NM_ANGKUT != '') ? $dataDetail->NM_ANGKUT : '');
        $header->addChild('NO_VOY_FLIGHT', ($dataDetail->NO_VOY_FLIGHT != '') ? $dataDetail->NO_VOY_FLIGHT : '');
        $header->addChild('CALL_SIGN', ($dataDetail->CALL_SIGN != '') ? $dataDetail->CALL_SIGN : '');
        $header->addChild('TGL_TIBA', ($dataDetail->TGL_TIBA != '') ? $dataDetail->TGL_TIBA : '');
        $header->addChild('KD_GUDANG', ($dataDetail->KD_GUDANG != '') ? $dataDetail->KD_GUDANG : '');
        $header->addChild('REF_NUMBER', ($dataHeader->REF_NUMBER != '') ? $dataDetail->REF_NUMBER : '');
        
        $cont->addChild('NO_CONT', ($dataDetail->NO_CONT != '') ? $dataDetail->NO_CONT : '');
        $cont->addChild('UK_CONT', ($dataDetail->UK_CONT != '') ? $dataDetail->UK_CONT : '');
        $cont->addChild('NO_SEGEL', ($dataDetail->NO_SEGEL != '') ? $dataDetail->NO_SEGEL : '');
        $cont->addChild('JNS_CONT', ($dataDetail->JNS_CONT != '') ? $dataDetail->JNS_CONT : '');
        $cont->addChild('NO_BL_AWB', ($dataDetail->NO_BL_AWB != '') ? $dataDetail->NO_BL_AWB : '');
        $cont->addChild('TGL_BL_AWB', ($dataDetail->TGL_BL_AWB != '') ? $dataDetail->TGL_BL_AWB : '');
        $cont->addChild('NO_MASTER_BL_AWB', ($dataDetail->NO_MASTER_BL_AWB != '') ? $dataDetail->NO_MASTER_BL_AWB : '');
        $cont->addChild('TGL_MASTER_BL_AWB', ($dataDetail->TGL_MASTER_BL_AWB != '') ? $dataDetail->TGL_MASTER_BL_AWB : '');
        $cont->addChild('ID_CONSIGNEE', ($dataDetail->ID_CONSIGNEE != 000000000000000) ? $dataDetail->ID_CONSIGNEE : '');
        $cont->addChild('CONSIGNEE', ($dataDetail->CONSIGNEE != '') ? htmlspecialchars($dataDetail->CONSIGNEE) : '');
        $cont->addChild('BRUTO', ($dataDetail->BRUTO != '') ? $dataDetail->BRUTO : '');
        $cont->addChild('NO_BC11', ($dataDetail->NO_BC11 != '') ? $dataDetail->NO_BC11 : '');
        $cont->addChild('TGL_BC11', ($dataDetail->TGL_BC11 != '') ? $dataDetail->TGL_BC11 : '');        
        $cont->addChild('NO_POS_BC11', ($dataDetail->NO_POS_BC11 != '') ? $dataDetail->NO_POS_BC11 : '');
        $cont->addChild('KD_TIMBUN', ($dataDetail->KD_TIMBUN != '') ? $dataDetail->KD_TIMBUN : '');
        $cont->addChild('KD_DOK_INOUT', ($dataDetail->KD_DOK_INOUT != '') ? $dataDetail->KD_DOK_INOUT : '');
        $cont->addChild('NO_DOK_INOUT', ($dataDetail->NO_DOK_INOUT != '') ? $dataDetail->NO_DOK_INOUT : '');
        $cont->addChild('TGL_DOK_INOUT', ($dataDetail->TGL_DOK_INOUT != '') ? $dataDetail->TGL_DOK_INOUT : '');
        $cont->addChild('WK_INOUT', ($dataDetail->WK_INOUT != '') ? $dataDetail->WK_INOUT : '');
        $cont->addChild('KD_SAR_ANGKUT_INOUT', ($dataDetail->KD_SAR_ANGKUT_INOUT != '') ? $dataDetail->KD_SAR_ANGKUT_INOUT : '');
        $cont->addChild('NO_POL', ($dataDetail->NO_POL != '') ? $dataDetail->NO_POL : '');
        $cont->addChild('FL_CONT_KOSONG', ($dataDetail->FL_CONT_KOSONG != '') ? $dataDetail->FL_CONT_KOSONG : '');
        $cont->addChild('ISO_CODE', ($dataDetail->ISO_CODE != '') ? $dataDetail->ISO_CODE : '');
        $cont->addChild('PEL_MUAT', ($dataDetail->PEL_MUAT != '') ? $dataDetail->PEL_MUAT : '');
        $cont->addChild('PEL_TRANSIT', ($dataDetail->PEL_TRANSIT != '') ? $dataDetail->PEL_TRANSIT : '');
        $cont->addChild('PEL_BONGKAR', ($dataDetail->PEL_BONGKAR != '') ? $dataDetail->PEL_BONGKAR : '');
        $cont->addChild('GUDANG_TUJUAN', ($dataDetail->GUDANG_TUJUAN != '') ? $dataDetail->GUDANG_TUJUAN : '');
        $cont->addChild('KODE_KANTOR', ($dataDetail->KODE_KANTOR != '') ? $dataDetail->KODE_KANTOR : '');
        $cont->addChild('NO_DAFTAR_PABEAN', ($dataDetail->NO_DAFTAR_PABEAN != '') ? $dataDetail->NO_DAFTAR_PABEAN : '');
        $cont->addChild('TGL_DAFTAR_PABEAN', ($dataDetail->TGL_DAFTAR_PABEAN != '') ? $dataDetail->TGL_DAFTAR_PABEAN : '');
        $cont->addChild('NO_SEGEL_BC', ($dataDetail->NO_SEGEL_BC != '') ? $dataDetail->NO_SEGEL_BC : '');
        $cont->addChild('TGL_SEGEL_BC', ($dataDetail->TGL_SEGEL_BC != '') ? $dataDetail->TGL_SEGEL_BC : '');
        $cont->addChild('NO_IJIN_TPS', ($dataDetail->NO_IJIN_TPS != '') ? $dataDetail->NO_IJIN_TPS : '');
        $cont->addChild('TGL_IJIN_TPS', ($dataDetail->TGL_IJIN_TPS != '') ? $dataDetail->TGL_IJIN_TPS : '');
        
//        $xml->saveXML('xml/CodecoContainer'. date('Ymd'). $dataDetail->NO_DOK_INOUT .'.xml');
//
//        $response = \Response::make($xml->asXML(), 200);
//
//        $response->header('Cache-Control', 'public');
//        $response->header('Content-Description', 'File Transfer');
//        $response->header('Content-Disposition', 'attachment; filename=xml/CoariContainer'. date('ymd'). $dataDetail->NO_DOK_INOUT .'.xml');
//        $response->header('Content-Transfer-Encoding', 'binary');
//        $response->header('Content-Type', 'text/xml');
        
        // SEND
        \SoapWrapper::add(function ($service) {
            $service
//                ->name('CoCoCont_Tes')
                ->name('CoarriCodeco_Container')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'stream_context' => stream_context_create([
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    ])
                ]);                                                 
        });
        
        $datas = [
            'Username' => $this->user, 
            'Password' => $this->password,
            'fStream' => $xml->asXML()
        ];
        
        // Using the added service
        \SoapWrapper::service('CoarriCodeco_Container', function ($service) use ($datas) {        
            $this->response = $service->call('CoarriCodeco_Container', [$datas])->CoarriCodeco_ContainerResult;      
        });
        
        $dataDetail->STATUS_TPS = 2;
        $dataDetail->RESPONSE = $this->response;
        
        if ($dataDetail->save()){
            return back()->with('success', 'Codeco Container XML REF Number: '.$dataHeader->REF_NUMBER.' berhasil dikirim.');
        }
        
        var_dump($this->response);
    }
    
    public function codecoKmsCreateXml($id)
    {
        if(!$id){ return false; }
        
        $dataHeader = \App\Models\TpsCodecoKms::find($id);
        $dataDetail = \App\Models\TpsCodecoKmsDetail::where('TPSCODECOKMSXML_FK', $dataHeader->TPSCODECOKMSXML_PK)->first();
        $dataDetails = \App\Models\TpsCodecoKmsDetail::where('TPSCODECOKMSXML_FK', $dataHeader->TPSCODECOKMSXML_PK)->get();
        
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><DOCUMENT></DOCUMENT>');       
        
        $xmldata = $xml->addAttribute('xmlns', 'cocokms.xsd');
        $xmldata = $xml->addchild('COCOKMS');
        $header = $xmldata->addchild('HEADER');
        $detail = $xmldata->addchild('DETIL');
        
        $header->addChild('KD_DOK', $dataDetail->KD_DOK);
        $header->addChild('KD_TPS', $dataDetail->KD_TPS);
        $header->addChild('NM_ANGKUT', $dataDetail->NM_ANGKUT);
        $header->addChild('NO_VOY_FLIGHT', $dataDetail->NO_VOY_FLIGHT);
        $header->addChild('CALL_SIGN', $dataDetail->CALL_SIGN);
        $header->addChild('TGL_TIBA', $dataDetail->TGL_TIBA);
        $header->addChild('KD_GUDANG', $dataDetail->KD_GUDANG);
        $header->addChild('REF_NUMBER', $dataHeader->REF_NUMBER);
        
        foreach ($dataDetails as $dataDetailkms):
            $kms = $detail->addChild('KMS');
        
            $kms->addChild('NO_BL_AWB', $dataDetailkms->NO_BL_AWB);
            $kms->addChild('TGL_BL_AWB', $dataDetailkms->TGL_BL_AWB); 
            $kms->addChild('NO_MASTER_BL_AWB', $dataDetailkms->NO_MASTER_BL_AWB); 
            $kms->addChild('TGL_MASTER_BL_AWB', $dataDetailkms->TGL_MASTER_BL_AWB); 
            $kms->addChild('ID_CONSIGNEE', ($dataDetailkms->ID_CONSIGNEE != 000000000000000) ? $dataDetailkms->ID_CONSIGNEE : '');
            $kms->addChild('CONSIGNEE', htmlspecialchars($dataDetailkms->CONSIGNEE));
            $kms->addChild('BRUTO', $dataDetailkms->BRUTO);
            $kms->addChild('NO_BC11', $dataDetailkms->NO_BC11);
            $kms->addChild('TGL_BC11', $dataDetailkms->TGL_BC11 );
            $kms->addChild('NO_POS_BC11', $dataDetailkms->NO_POS_BC11 );
            $kms->addChild('CONT_ASAL', $dataDetailkms->CONT_ASAL );
            $kms->addChild('SERI_KEMAS', $dataDetailkms->SERI_KEMAS );
            $kms->addChild('KD_KEMAS', $dataDetailkms->KD_KEMAS );
            $kms->addChild('JML_KEMAS', $dataDetailkms->JML_KEMAS );
            $kms->addChild('KD_TIMBUN', $dataDetailkms->KD_TIMBUN );
            $kms->addChild('KD_DOK_INOUT', $dataDetailkms->KD_DOK_INOUT );
            $kms->addChild('NO_DOK_INOUT', $dataDetailkms->NO_DOK_INOUT );
            $kms->addChild('TGL_DOK_INOUT', $dataDetailkms->TGL_DOK_INOUT );
            $kms->addChild('WK_INOUT', $dataDetailkms->WK_INOUT );
            $kms->addChild('KD_SAR_ANGKUT_INOUT', $dataDetailkms->KD_SAR_ANGKUT_INOUT );
            $kms->addChild('NO_POL', $dataDetailkms->NO_POL);
            $kms->addChild('PEL_MUAT', $dataDetailkms->PEL_MUAT );
            $kms->addChild('PEL_TRANSIT', $dataDetailkms->PEL_TRANSIT );
            $kms->addChild('PEL_BONGKAR', $dataDetailkms->PEL_BONGKAR );
            $kms->addChild('GUDANG_TUJUAN', $dataDetailkms->GUDANG_TUJUAN );
            $kms->addChild('KODE_KANTOR', $dataDetailkms->KODE_KANTOR );
            $kms->addChild('NO_DAFTAR_PABEAN', $dataDetailkms->NO_DAFTAR_PABEAN );
            $kms->addChild('TGL_DAFTAR_PABEAN', $dataDetailkms->TGL_DAFTAR_PABEAN );
            $kms->addChild('NO_SEGEL_BC', $dataDetailkms->NO_SEGEL_BC);
            $kms->addChild('TGL_SEGEL_BC', $dataDetailkms->TGL_SEGEL_BC );
            $kms->addChild('NO_IJIN_TPS', $dataDetailkms->NO_IJIN_TPS );
            $kms->addChild('TGL_IJIN_TPS', $dataDetailkms->TGL_IJIN_TPS);
            
        endforeach;
        
//        $xml->saveXML('xml/CodecoKMS'. date('Ymd'). $dataDetail->NO_DOK_INOUT .'.xml');
//
        $response = \Response::make($xml->asXML(), 200);

        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=xml/CodecoKemasan'. date('ymd'). $dataDetail->NO_DOK_INOUT .'.xml');
        $response->header('Content-Transfer-Encoding', 'binary');
        $response->header('Content-Type', 'text/xml');
//        
//        return $response;
//        return back()->with('success', 'Codeco Kemasan XML REF Number: '.$dataHeader->REF_NUMBER.' berhasil dikirim.');
//        
        
        \SoapWrapper::add(function ($service) {
            $service
//                ->name('CoCoKms_Tes')
                ->name('CoarriCodeco_Kemasan')
                ->wsdl($this->wsdl)
                ->trace(true)                                                                                                  
//                ->certificate()                                                 
                ->cache(WSDL_CACHE_NONE)                                        
                ->options([
                    'stream_context' => stream_context_create([
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    ])
                ]);                                                    
        });
        
        $data = [
            'Username' => $this->user, 
            'Password' => $this->password,
            'fStream' => $xml->asXML()
        ];
        
//        var_dump($this->response);
//        return;
        
        // Using the added service
        \SoapWrapper::service('CoarriCodeco_Kemasan', function ($service) use ($data) {        
            $this->response = $service->call('CoarriCodeco_Kemasan', [$data])->CoarriCodeco_KemasanResult;      
        });
        
        $update = \App\Models\TpsCodecoKmsDetail::where('TPSCODECOKMSXML_FK', $dataHeader->TPSCODECOKMSXML_PK)->update(['STATUS_TPS' => 2, 'RESPONSE' => $this->response]);       
        
        if ($update){
//            return $response;
            return back()->with('success', 'Codeco Kemasan XML REF Number: '.$dataHeader->REF_NUMBER.' berhasil dikirim.');
        }
        
        var_dump($this->response);
    }
    
    public function laporanYorCreateXml($id)
    {
        if(!$id){ return false; }
        
        $dataHeader = \App\Models\TpsLaporanYor::find($id);
        $dataDetailImport = \App\Models\TpsLaporanYorDetail::where(array('tpslaporanyor_id' => $id, 'TYPE' => 'IMPOR'))->first();
        $dataDetailExport = \App\Models\TpsLaporanYorDetail::where(array('tpslaporanyor_id' => $id, 'TYPE' => 'EKSPOR'))->first();
        
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><DOCUMENT></DOCUMENT>');       
        
        $xmldata = $xml->addAttribute('xmlns', 'laporanyor.xsd');
        $xmldata = $xml->addchild('LAPORAN');
        
        $xmldata->addChild('REF_NUMBER', $dataHeader->REF_NUMBER);
        $xmldata->addChild('KD_TPS', $dataHeader->KD_TPS);
        $xmldata->addChild('KD_GUDANG', $dataHeader->KD_GUDANG);
        $xmldata->addChild('TGL_LAPORAN', $dataHeader->TGL_LAPORAN);
        
        if($dataDetailImport){
        
            $import = $xmldata->addChild('IMPOR');
            $import->addChild('YOR', $dataDetailImport->YOR);
            $import->addChild('KAPASITAS_LAPANGAN', $dataDetailImport->KAPASITAS_LAPANGAN);
            $import->addChild('KAPASITAS_GUDANG', $dataDetailImport->KAPASITAS_GUDANG);
            $import->addChild('TOTAL_CONT', $dataDetailImport->TOTAL_CONT);
            $import->addChild('TOTAL_KMS', $dataDetailImport->TOTAL_KMS);
            $import->addChild('JML_CONT20F', $dataDetailImport->JML_CONT20F);
            $import->addChild('JML_CONT40F', $dataDetailImport->JML_CONT40F);
            $import->addChild('JML_CONT45F', $dataDetailImport->JML_CONT45F);
        
        }
        
        if($dataDetailExport){
            
            $export = $xmldata->addChild('EKSPOR');
            $export->addChild('YOR', $dataDetailExport->YOR);
            $export->addChild('KAPASITAS_LAPANGAN', $dataDetailExport->KAPASITAS_LAPANGAN);
            $export->addChild('KAPASITAS_GUDANG', $dataDetailExport->KAPASITAS_GUDANG);
            $export->addChild('TOTAL_CONT', $dataDetailExport->TOTAL_CONT);
            $export->addChild('TOTAL_KMS', $dataDetailExport->TOTAL_KMS);
            $export->addChild('JML_CONT20F', $dataDetailExport->JML_CONT20F);
            $export->addChild('JML_CONT40F', $dataDetailExport->JML_CONT40F);
            $export->addChild('JML_CONT45F', $dataDetailExport->JML_CONT45F);

        }
        
        $response = \Response::make($xml->asXML(), 200);
        
//        return $response;
        
        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=xml/LaporanYor'. date('ymd'). $dataHeader->REF_NUMBER .'.xml');
        $response->header('Content-Transfer-Encoding', 'binary');
        $response->header('Content-Type', 'text/xml');
        
        \SoapWrapper::add(function ($service) {
            $service
                ->name('TpsOnline_LaporanYor')
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
                    ])
                ]); 
        });
        
        $data = [
            'Username' => $this->user, 
            'Password' => $this->password,
            'fStream' => $xml->asXML()
        ];
        
//        var_dump($this->response);
//        return;
        
        // Using the added service
        \SoapWrapper::service('TpsOnline_LaporanYor', function ($service) use ($data) {        
            $this->response = $service->call('KirimLaporanYor', [$data])->KirimLaporanYorResult;      
        });
        
        $update = \App\Models\TpsLaporanYor::where('id', $dataHeader->id)->update(['RESPONSE' => $this->response]);       
        
        if ($update){
//            return $response;
            return back()->with('success', 'Laporan YOR XML REF Number: '.$dataHeader->REF_NUMBER.' berhasil dikirim.');
        }
        
        var_dump($this->response);
        
    }
    
    public function totalRealiasiBongkarMuat()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><DOCUMENT></DOCUMENT>');       
        
        $xml->addAttribute('xmlns', 'realisasibongkarmuat.xsd');
        
        $data = $xml->addchild('REALISASI');
        $data->addchild('REF_NUMBER', '');
        $data->addchild('KD_TPS', '');
        $data->addchild('KD_GUDANG', '');
        $data->addchild('TGL_TIBA', '');
        $data->addchild('NM_ANGKUT', '');
        $data->addchild('NO_VOY_FLIGHT', '');
        $data->addchild('CALL_SIGN', '');
        $data->addchild('NO_BC11', '');
        $data->addchild('TGL_BC11', '');
        $data->addchild('JML_BONGKAR_CONTAINER', '');
        $data->addchild('JML_BONGKAR_KEMASAN', '');
        $data->addchild('JML_MUAT_CONTAINER', '');
        $data->addchild('JML_MUAT_KEMASAN', '');
        $data->addchild('WK_AKTUAL_KEDATANGAN', '');
        $data->addchild('WK_AKTUAL_KEBERANGKATAN', '');
        $data->addchild('FL_BATAL', '');
        
        $response = \Response::make($xml->asXML(), 200);

        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=xml/CodecoKemasan'. date('ymd'). $dataDetail->NO_DOK_INOUT .'.xml');
        $response->header('Content-Transfer-Encoding', 'binary');
        $response->header('Content-Type', 'text/xml');
        
        \SoapWrapper::add(function ($service) {
            $service
                ->name('TpsOnline_TotalRealiasiBongkarMuat')
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
                    ])
                ]); 
        });
        
        $options = [
            'Username' => $this->user, 
            'Password' => $this->password,
            'fStream' => $xml->asXML()
        ];
        
//        var_dump($this->response);
//        return;
        
        // Using the added service
        \SoapWrapper::service('TotalRealiasiBongkarMuat', function ($service) use ($options) {        
            $this->response = $service->call('TotalRealiasiBongkarMuat', [$options])->TotalRealiasiBongkarMuatResult;      
        });
        
//        $update = \App\Models\TpsCodecoKmsDetail::where('TPSCODECOKMSXML_FK', $dataHeader->TPSCODECOKMSXML_PK)->update(['STATUS_TPS' => 2, 'RESPONSE' => $this->response]);       
        
        libxml_use_internal_errors(true);
        $xmlres = simplexml_load_string($this->response);
        if(!$xmlres || !$xmlres->children()){
           return back()->with('error', $this->response);
        }
        
        foreach ($xmlres->children() as $data):  
            foreach ($data as $key=>$value):          
                $info = new \App\Models\TpsTotalRealisasiBongkarMuat;
                foreach ($value as $keyk=>$valuek):
                    $info->$keyk = $valuek;
                endforeach;
                $info->save();
            endforeach;
        endforeach;
        
        return back()->with('success', 'Total Realisasi Bongkar Muat berhasil dikirim.');
        
//        var_dump($this->response);

    }
    
    public function coariContGetXml()
    {     
        $xml = simplexml_load_file(url('xml/CoariContainer20161108015043.xml'));

        foreach ($xml->children() as $data):  
            foreach ($data as $key=>$value):
                if($key == 'HEADER'){           
                    $coaricont = new \App\Models\TpsCoariCont;
                    $cont = new \App\Models\TpsCoariContDetail;
                    foreach ($value as $keyh=>$valueh):
                        if($keyh != 'KD_DOK' 
                                && $keyh != 'KD_TPS' 
                                && $keyh != 'KD_GUDANG' 
                                && $keyh != 'NM_ANGKUT'
                                && $keyh != 'NO_VOY_FLIGHT'
                                && $keyh != 'CALL_SIGN'
                                && $keyh != 'TGL_TIBA'){
                            $coaricont->$keyh = $valueh;
                        }
                        $cont->$keyh = $valueh;
                    endforeach;
                    $coaricont->save();
                    $coaricont_id = $coaricont->TPSCOARICONTXML_PK;                      
                }elseif($key == 'DETIL'){
                    foreach ($value as $key1=>$value1):
                        if($key1 == 'CONT'){                
                            foreach ($value1 as $keyc=>$valuec):
                                $cont->$keyc = $valuec;
                            endforeach;
                            $cont->TPSCOARICONTXML_FK = $coaricont_id;
                            $cont->save();
                        }
                    endforeach; 
                }
            endforeach;
        endforeach;
        
    }
    
    public function coariKmsGetXml()
    {     
        $xml = simplexml_load_file(url('xml/CoariKMS20161108010100.xml'));

        foreach ($xml->children() as $data):  
            foreach ($data as $key=>$value):
                if($key == 'HEADER'){           
                    $coaricont = new \App\Models\TpsCoariKms;             
                    foreach ($value as $keyh=>$valueh):
                        if($keyh != 'KD_DOK' 
                                && $keyh != 'KD_TPS' 
                                && $keyh != 'KD_GUDANG' 
                                && $keyh != 'NM_ANGKUT'
                                && $keyh != 'NO_VOY_FLIGHT'
                                && $keyh != 'CALL_SIGN'
                                && $keyh != 'TGL_TIBA'){
                            $coaricont->$keyh = $valueh;
                        }
                        $datah[$keyh] = $valueh;
                    endforeach;
                    $coaricont->save();
                    $coaricont_id = $coaricont->TPSCOARIKMSXML_PK;                      
                }elseif($key == 'DETIL'){
                    foreach ($value as $key1=>$value1):
                        $cont = new \App\Models\TpsCoariKmsDetail;
                        if($key1 == 'KMS'){    
                            foreach ($datah as $keyd=>$valued):
                                $cont->$keyd = $valued;
                            endforeach;
                            foreach ($value1 as $keyc=>$valuec):
                                $cont->$keyc = $valuec;
                            endforeach;
                            $cont->TPSCOARIKMSXML_FK = $coaricont_id;
                            $cont->save();
                        }
                    endforeach; 
                }
            endforeach;
        endforeach;
        
    }
    
    public function codecoContFclGetXml()
    {     
        $xml = simplexml_load_file(url('xml/CodecoContainer20161108011928.xml'));

        foreach ($xml->children() as $data):  
            foreach ($data as $key=>$value):
                if($key == 'HEADER'){           
                    $coaricont = new \App\Models\TpsCodecoContFcl;
                    $cont = new \App\Models\TpsCodecoContFclDetail;
                    foreach ($value as $keyh=>$valueh):
                        if($keyh != 'KD_DOK' 
                                && $keyh != 'KD_TPS' 
                                && $keyh != 'KD_GUDANG' 
                                && $keyh != 'NM_ANGKUT'
                                && $keyh != 'NO_VOY_FLIGHT'
                                && $keyh != 'CALL_SIGN'
                                && $keyh != 'TGL_TIBA'){
                            $coaricont->$keyh = $valueh;
                        }
                        $cont->$keyh = $valueh;
                    endforeach;
                    $coaricont->save();
                    $coaricont_id = $coaricont->TPSCODECOCONTXML_PK;                      
                }elseif($key == 'DETIL'){
                    foreach ($value as $key1=>$value1):
                        if($key1 == 'CONT'){                
                            foreach ($value1 as $keyc=>$valuec):
                                $cont->$keyc = $valuec;
                            endforeach;
                            $cont->TPSCODECOCONTXML_FK = $coaricont_id;
                            $cont->save();
                        }
                    endforeach; 
                }
            endforeach;
        endforeach;
        
    }
    
    public function codecoKmsGetXml()
    {     
        $xml = simplexml_load_file(url('xml/CodecoKMS20161108010548.xml'));

        foreach ($xml->children() as $data):  
            foreach ($data as $key=>$value):
                if($key == 'HEADER'){           
                    $coaricont = new \App\Models\TpsCodecoKms;             
                    foreach ($value as $keyh=>$valueh):
                        if($keyh != 'KD_DOK' 
                                && $keyh != 'KD_TPS' 
                                && $keyh != 'KD_GUDANG' 
                                && $keyh != 'NM_ANGKUT'
                                && $keyh != 'NO_VOY_FLIGHT'
                                && $keyh != 'CALL_SIGN'
                                && $keyh != 'TGL_TIBA'){
                            $coaricont->$keyh = $valueh;
                        }
                        $datah[$keyh] = $valueh;
                    endforeach;
                    $coaricont->save();
                    $coaricont_id = $coaricont->TPSCODECOKMSXML_PK;                      
                }elseif($key == 'DETIL'){
                    foreach ($value as $key1=>$value1):
                        $cont = new \App\Models\TpsCodecoKmsDetail;
                        if($key1 == 'KMS'){    
                            foreach ($datah as $keyd=>$valued):
                                $cont->$keyd = $valued;
                            endforeach;
                            foreach ($value1 as $keyc=>$valuec):
                                $cont->$keyc = $valuec;
                            endforeach;
                            $cont->TPSCODECOKMSXML_FK = $coaricont_id;
                            $cont->save();
                        }
                    endforeach; 
                }
            endforeach;
        endforeach;
        
    }
    
}
