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
//        if ( !$this->access->can('show.tps.coariCont.index') ) {
//            return view('errors.no-access');
//        }
        
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
//        if ( !$this->access->can('show.tps.coariKms.index') ) {
//            return view('errors.no-access');
//        }
        
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
//        if ( !$this->access->can('show.tps.codecoContFcl.index') ) {
//            return view('errors.no-access');
//        }
        
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
//        if ( !$this->access->can('show.tps.codecoContBuangMty.index') ) {
//            return view('errors.no-access');
//        }
        
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
//        if ( !$this->access->can('show.tps.codecoKms.index') ) {
//            return view('errors.no-access');
//        }
        
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
    
    public function coariContEdit($id)
    {
//        if ( !$this->access->can('show.tps.coariCont.edit') ) {
//            return view('errors.no-access');
//        }
        
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
//        if ( !$this->access->can('show.tps.coariKms.edit') ) {
//            return view('errors.no-access');
//        }
        
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
//        if ( !$this->access->can('show.tps.codecoCont.edit') ) {
//            return view('errors.no-access');
//        }
        
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
//        if ( !$this->access->can('show.tps.codecoContBuangMty.edit') ) {
//            return view('errors.no-access');
//        }
        
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
//        if ( !$this->access->can('show.tps.codecoKms.edit') ) {
//            return view('errors.no-access');
//        }
        
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
//                ->options([
//                    'Username' => $this->user, 
//                    'Password' => $this->password,
//                    'fStream' => $xml->asXML()
//                ])
                ;                                                    
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
//                ->options([
//                    'Username' => $this->user, 
//                    'Password' => $this->password,
//                    'fStream' => ''
//                ])
                    ;                                                    
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
//                ->options([
//                    'ssl' => [
//                        // set some SSL/TLS specific options
//                        'verify_peer' => false,
//                        'verify_peer_name' => false,
//                        'allow_self_signed' => true
//                    ]
////                    'Username' => $this->user, 
////                    'Password' => $this->password,
////                    'fStream' => $xml->asXML()
//                ])
                ;                                                    
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
//                ->options([
//                    'Username' => $this->user, 
//                    'Password' => $this->password,
//                    'fStream' => ''
//                ])
                    ;                                                    
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
