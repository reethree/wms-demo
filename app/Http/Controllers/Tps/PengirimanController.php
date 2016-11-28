<?php

namespace App\Http\Controllers\Tps;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PengirimanController extends Controller
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
        
        return view('tpsonline.edit-coari-Kms')->with($data);
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
    
    public function coariContCreateXml()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><DOCUMENT xmlns:namespace="cococont.xsd"></DOCUMENT>');
        
        $data = $xml->addchild('COCOCONT');
        $header = $data->addchild('HEADER');
        $detail = $data->addchild('DETIL');
        $cont = $detail->addChild('CONT');
        
        $header->addChild('KD_DOK', '');
        $header->addChild('KD_TPS', '');
        $header->addChild('NM_ANGKUT', '');
        $header->addChild('NO_VOY_FLIGHT', '');
        $header->addChild('CALL_SIGN', '');
        $header->addChild('TGL_TIBA', '');
        $header->addChild('KD_GUDANG', '');
        $header->addChild('REF_NUMBER', '');
        
        $cont->addChild('NO_CONT', '');
        $cont->addChild('UK_CONT', '');
        $cont->addChild('NO_SEGEL', '');
        $cont->addChild('JNS_CONT', '');
        $cont->addChild('NO_BL_AWB', '');
        $cont->addChild('TGL_BL_AWB', '');
        $cont->addChild('NO_MASTER_BL_AWB', '');
        $cont->addChild('TGL_MASTER_BL_AWB', '');
        $cont->addChild('ID_CONSIGNEE', '');
        $cont->addChild('CONSIGNEE', '');
        $cont->addChild('BRUTO', '');
        $cont->addChild('NO_BC11', '');
        $cont->addChild('TGL_BC11', '');
        $cont->addChild('NO_POS_BC11', '');
        $cont->addChild('KD_DOK_INOUT', '');
        $cont->addChild('NO_DOK_INOUT', '');
        $cont->addChild('TGL_DOK_INOUT', '');
        $cont->addChild('WK_INOUT', '');
        $cont->addChild('KD_SAR_ANGKUT_INOUT', '');
        $cont->addChild('NO_POL', '');
        $cont->addChild('FL_CONT_KOSONG', '');
        $cont->addChild('ISO_CODE', '');
        $cont->addChild('PEL_MUAT', '');
        $cont->addChild('PEL_TRANSIT', '');
        $cont->addChild('PEL_BONGKAR', '');
        $cont->addChild('GUDANG_TUJUAN', '');
        $cont->addChild('KODE_KANTOR', '');
        $cont->addChild('NO_DAFTAR_PABEAN', '');
        $cont->addChild('NO_SEGEL_BC', '');
        $cont->addChild('TGL_SEGEL_BC', '');
        $cont->addChild('NO_IJIN_TPS', '');
        $cont->addChild('TGL_IJIN_TPS', '');
        
        $xml->saveXML('xml/CoariContainerDemo.xml');

        $response = \Response::make($xml->asXML(), 200);

        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=CoariContainerDemo.xml');
        $response->header('Content-Transfer-Encoding', 'binary');
        $response->header('Content-Type', 'text/xml');

//        return $response;
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
    
}
