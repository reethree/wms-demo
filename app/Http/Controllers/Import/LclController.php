<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Joborder as DBJoborder;
use App\Models\Consolidator as DBConsolidator;
use App\Models\ConsolidatorTarif as DBConsolidatorTarif;
use App\Models\Perusahaan as DBPerusahaan;
use App\Models\Negara as DBNegara;
use App\Models\Pelabuhan as DBPelabuhan;
use App\Models\Vessel as DBVessel;
use App\Models\Shippingline as DBShippingline;
use App\Models\Lokasisandar as DBLokasisandar;
use App\Models\Container as DBContainer;
use App\Models\Eseal as DBEseal;
use App\Models\Depomty as DBDepomty;
use App\Models\Manifest as DBManifest;

class LclController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    
    public function registerIndex()
    {
        if ( !$this->access->can('show.lcl.register.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index LCL Register', 'slug' => 'show.lcl.register.index', 'description' => ''));
        
        $data['page_title'] = "LCL Register";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Register'
            ]
        ];        
        
        return view('import.lcl.index-register')->with($data);
    }
    
    public function gateinIndex()
    {
        if ( !$this->access->can('show.lcl.getin.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index LCL GateIn', 'slug' => 'show.lcl.getin.index', 'description' => ''));
        
        $data['page_title'] = "LCL Realisasi Masuk / Gate In";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Realisasi Masuk / Gate In'
            ]
        ];        
        
        $data['eseals'] = DBEseal::select('eseal_id as id','esealcode as code')->get();
        
        return view('import.lcl.index-gatein')->with($data);
    }
    
    public function strippingIndex()
    {
        if ( !$this->access->can('show.lcl.stripping.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index LCL Stripping', 'slug' => 'show.lcl.stripping.index', 'description' => ''));
        
        $data['page_title'] = "LCL Realisasi Stripping";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Realisasi Stripping'
            ]
        ];        
        
        return view('import.lcl.index-stripping')->with($data);
    }

    public function buangmtyIndex()
    {
        if ( !$this->access->can('show.lcl.buangmty.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index LCL Buang MTY', 'slug' => 'show.lcl.buangmty.index', 'description' => ''));
        
        $data['page_title'] = "LCL Realisasi Buang MTY";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Realisasi Buang MTY'
            ]
        ];        
        
        $data['depomty'] = DBDepomty::get();
        
        return view('import.lcl.index-buangmty')->with($data);
    }
    
    public function statusBehandleIndex()
    {
        $data['page_title'] = "LCL Status Behandle";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Status Behandle'
            ]
        ];        
        
        return view('import.lcl.index-status-behandle')->with($data);
    }
    
    public function statusBehandleFinish()
    {
        $data['page_title'] = "LCL Status Behandle Finish";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Status Behandle Finish'
            ]
        ];        
        
        return view('import.lcl.finish-status-behandle')->with($data);
    }
    
    public function behandleIndex()
    {
        if ( !$this->access->can('show.lcl.behandle.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index LCL Behandle', 'slug' => 'show.lcl.behandle.index', 'description' => ''));
        
        $data['page_title'] = "LCL Delivery Behandle";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Delivery Behandle'
            ]
        ];        
        
        return view('import.lcl.index-behandle')->with($data);
    }
    
    public function fiatmuatIndex()
    {
        if ( !$this->access->can('show.lcl.fiatmuat.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index LCL Fiatmuat', 'slug' => 'show.lcl.fiatmuat.index', 'description' => ''));
        
        $data['page_title'] = "LCL Delivery Fiat Muat";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Delivery Fiat Muat'
            ]
        ];        
        
        $data['kode_doks'] = \App\Models\KodeDok::get(); 
        
        return view('import.lcl.index-fiatmuat')->with($data);
    }
    
    public function suratjalanIndex()
    {
        if ( !$this->access->can('show.lcl.suratjalan.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index LCL Surat Jalan', 'slug' => 'show.lcl.suratjalan.index', 'description' => ''));
        
        $data['page_title'] = "LCL Delivery Surat Jalan";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Delivery Surat Jalan'
            ]
        ];        
        
        return view('import.lcl.index-suratjalan')->with($data);
    }
    
    public function releaseIndex()
    {
        if ( !$this->access->can('show.lcl.release.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index LCL Release', 'slug' => 'show.lcl.release.index', 'description' => ''));
        
        $data['page_title'] = "LCL Delivery Release";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Delivery Release'
            ]
        ];        
        
        $data['kode_doks'] = \App\Models\KodeDok::get(); 
        $data['perusahaans'] = DBPerusahaan::select('TPERUSAHAAN_PK as id', 'NAMAPERUSAHAAN as name')->get();
        
        return view('import.lcl.index-release')->with($data);
    }
    
    public function dispatcheIndex()
    {
        if ( !$this->access->can('show.lcl.dispatche.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index LCL Dispatche', 'slug' => 'show.lcl.dispatche.index', 'description' => ''));
        
        $data['page_title'] = "LCL Dispatche E-Seal";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Dispatche E-Seal'
            ]
        ];        
        
        $data['eseals'] = DBEseal::select('eseal_id as id','esealcode as code')->get();
        
        return view('import.lcl.index-dispatche')->with($data);
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
    
    public function registerCreate()
    {
        if ( !$this->access->can('show.lcl.register.create') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Create LCL Register', 'slug' => 'show.lcl.register.create', 'description' => ''));
        
        $data['page_title'] = "Create LCL Register";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('lcl-register-index'),
                'title' => 'LCL Register'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        $spk_last_id = DBJoborder::select('TJOBORDER_PK as id')->orderBy('TJOBORDER_PK', 'DESC')->first();  
//        $spk_last_id = $this->getSpkNumber();
        $regID = str_pad(intval((isset($spk_last_id->id) ? $spk_last_id->id : 0)+1), 4, '0', STR_PAD_LEFT);
        
        $data['spk_number'] = 'PRJPL'.$regID.'/'.date('y');
        $data['consolidators'] = DBConsolidator::select('TCONSOLIDATOR_PK as id','NAMACONSOLIDATOR as name')->get();
        $data['countries'] = DBNegara::select('TNEGARA_PK as id','NAMANEGARA as name')->get();
        $data['pelabuhans'] = array();
//        $data['pelabuhans'] = DBPelabuhan::select('TPELABUHAN_PK as id','NAMAPELABUHAN as name','KODEPELABUHAN as code')->limit(300)->get();
        $data['vessels'] = DBVessel::select('tvessel_pk as id','vesselname as name','vesselcode as code','callsign')->get();
        $data['shippinglines'] = DBShippingline::select('TSHIPPINGLINE_PK as id','SHIPPINGLINE as name')->get();
        $data['lokasisandars'] = DBLokasisandar::select('TLOKASISANDAR_PK as id','NAMALOKASISANDAR as name')->get();
        
        return view('import.lcl.create-register')->with($data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
    }
    
    public function registerStore(Request $request)
    {
        
        if ( !$this->access->can('store.lcl.register.create') ) {
            return view('errors.no-access');
        }
        
        $validator = \Validator::make($request->all(), [
            'NOJOBORDER' => 'required|unique:tjoborder',
            'NOMBL' => 'required|unique:tjoborder',
            'TGL_MASTER_BL' => 'required',
//            'TCONSOLIDATOR_FK' => 'required',
//            'PARTY' => 'required',
//            'TNEGARA_FK' => 'required',
//            'TPELABUHAN_FK' => 'required',
//            'VESSEL' => 'required',
//            'VOY' => 'required',
//            'CALLSIGN' => 'required',
//            'ETA' => 'required',
//            'ETD' => 'required',
//            'TLOKASISANDAR_FK' => 'required',
//            'KODE_GUDANG' => 'required',
//            'GUDANG_TUJUAN' => 'required',
//            'JENISKEGIATAN' => 'required',
//            'GROSSWEIGHT' => 'required',
//            'JUMLAHHBL' => 'required',
//            'MEASUREMENT' => 'required',
//            'ISO_CODE' => 'required',
//            'PEL_MUAT' => 'required',
//            'PEL_TRANSIT' => 'required',
//            'PEL_BONGKAR' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data = $request->except(['_token']); 
        $data['TGLENTRY'] = date('Y-m-d');
        $data['TGL_MASTER_BL'] = (!empty($data['TGL_MASTER_BL']) ? date('Y-m-d', strtotime($data['TGL_MASTER_BL'])) : null);
        $data['ETA'] = (!empty($data['ETA']) ? date('Y-m-d', strtotime($data['ETA'])) : null );
        $data['ETD'] = (!empty($data['ETD']) ? date('Y-m-d', strtotime($data['ETD'])) : null );
        $data['TTGL_BC11'] = (!empty($data['TTGL_BC11']) ? date('Y-m-d', strtotime($data['TTGL_BC11'])) : null );
        $data['TTGL_PLP'] = (!empty($data['TTGL_PLP']) ? date('Y-m-d', strtotime($data['TTGL_PLP'])) : null );
        $namaconsolidator = DBConsolidator::select('NAMACONSOLIDATOR','NPWP')->where('TCONSOLIDATOR_PK',$data['TCONSOLIDATOR_FK'])->first();
        $data['NAMACONSOLIDATOR'] = $namaconsolidator->NAMACONSOLIDATOR;
        $data['ID_CONSOLIDATOR'] = str_replace(array('.','-'),array('',''),$namaconsolidator->NPWP);
        $namanegara = DBNegara::select('NAMANEGARA')->where('TNEGARA_PK',$data['TNEGARA_FK'])->first();
        if($namanegara){
            $data['NAMANEGARA'] = $namanegara->NAMANEGARA;
        }
        $namapelabuhan = DBPelabuhan::select('NAMAPELABUHAN')->where('TPELABUHAN_PK',$data['TPELABUHAN_FK'])->first();
        if($namapelabuhan){
            $data['NAMAPELABUHAN'] = $namapelabuhan->NAMAPELABUHAN;
        } 
        $namalokasisandar = DBLokasisandar::select('NAMALOKASISANDAR','KD_TPS_ASAL')->where('TLOKASISANDAR_PK',$data['TLOKASISANDAR_FK'])->first();
        if($namalokasisandar){
            $data['NAMALOKASISANDAR'] = $namalokasisandar->NAMALOKASISANDAR;
            $data['KD_TPS_ASAL'] = $namalokasisandar->KD_TPS_ASAL;
        }
        if($data['TSHIPPINGLINE_FK']){
            $namashippingline = DBShippingline::select('SHIPPINGLINE')->where('TSHIPPINGLINE_PK',$data['TSHIPPINGLINE_FK'])->first();
            $data['SHIPPINGLINE'] = $namashippingline->SHIPPINGLINE;
        }
        $data['UID'] = \Auth::getUser()->name;
        
        $insert_id = DBJoborder::insertGetId($data);
        
        if($insert_id){
            
            // COPY JOBORDER
            $joborder = DBJoborder::findOrFail($insert_id);
            
            $data = array();
            
            $data['TJOBORDER_FK'] = $joborder->TJOBORDER_PK;
            $data['NoJob'] = $joborder->NOJOBORDER;
            $data['NO_BC11'] = $joborder->TNO_BC11;
            $data['TGL_BC11'] = $joborder->TTGL_BC11;
            $data['NO_PLP'] = $joborder->TNO_PLP;
            $data['TGL_PLP'] = $joborder->TTGL_PLP;
            $data['TCONSOLIDATOR_FK'] = $joborder->TCONSOLIDATOR_FK;
            $data['NAMACONSOLIDATOR'] = $joborder->NAMACONSOLIDATOR;
            $data['TLOKASISANDAR_FK'] = $joborder->TLOKASISANDAR_FK;
            $data['ETA'] = $joborder->ETA;
            $data['ETD'] = $joborder->ETD;
            $data['VESSEL'] = $joborder->VESSEL;
            $data['VOY'] = $joborder->VOY;
            $data['TPELABUHAN_FK'] = $joborder->TPELABUHAN_FK;
            $data['NAMAPELABUHAN'] = $joborder->NAMAPELABUHAN;
            $data['PEL_MUAT'] = $joborder->PEL_MUAT;
            $data['PEL_BONGKAR'] = $joborder->PEL_BONGKAR;
            $data['PEL_TRANSIT'] = $joborder->PEL_TRANSIT;
            $data['NOMBL'] = $joborder->NOMBL;
            $data['TGL_MASTER_BL'] = $joborder->TGL_MASTER_BL;
            $data['KD_TPS_ASAL'] = $joborder->KD_TPS_ASAL;
            $data['KD_TPS_TUJUAN'] = $joborder->GUDANG_TUJUAN;
            $data['CALL_SIGN'] = $joborder->CALLSIGN;

            $container_insert_id = DBContainer::insertGetId($data);
            
            return redirect()->route('lcl-register-edit', $container_insert_id)->with('success', 'LCL Register has been added.');
        }
        
        return back()->withInput();
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
    
    public function registerEdit($id)
    {
        if ( !$this->access->can('show.lcl.register.edit') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Edit LCL Register', 'slug' => 'show.lcl.register.edit', 'description' => ''));
        
        $data['page_title'] = "Edit LCL Register";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('lcl-register-index'),
                'title' => 'LCL Register'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['consolidators'] = DBConsolidator::select('TCONSOLIDATOR_PK as id','NAMACONSOLIDATOR as name')->get();
        $data['countries'] = DBNegara::select('TNEGARA_PK as id','NAMANEGARA as name')->get();
        $data['pelabuhans'] = array();
//        $data['pelabuhans'] = DBPelabuhan::select('TPELABUHAN_PK as id','NAMAPELABUHAN as name','KODEPELABUHAN as code')->limit(300)->get();
        $data['vessels'] = DBVessel::select('tvessel_pk as id','vesselname as name','vesselcode as code','callsign')->get();
        $data['shippinglines'] = DBShippingline::select('TSHIPPINGLINE_PK as id','SHIPPINGLINE as name')->get();
        $data['lokasisandars'] = DBLokasisandar::select('TLOKASISANDAR_PK as id','NAMALOKASISANDAR as name')->get();
        
        $jobid = DBContainer::select('TJOBORDER_FK as id')->where('TCONTAINER_PK',$id)->first();
        
        $data['joborder'] = DBJoborder::find($jobid->id);
        
        return view('import.lcl.edit-register')->with($data);
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
        
    }
    
    public function registerUpdate(Request $request, $id)
    {
        if ( !$this->access->can('update.lcl.register.edit') ) {
            return view('errors.no-access');
        }
        
        $data = $request->except(['_token']); 
        $data['TGLENTRY'] = date('Y-m-d');
        $data['TGL_MASTER_BL'] = (!empty($data['TGL_MASTER_BL']) ? date('Y-m-d', strtotime($data['TGL_MASTER_BL'])) : null);
        $data['ETA'] = (!empty($data['ETA']) ? date('Y-m-d', strtotime($data['ETA'])) : null );
        $data['ETD'] = (!empty($data['ETD']) ? date('Y-m-d', strtotime($data['ETD'])) : null );
        $data['TTGL_BC11'] = (!empty($data['TTGL_BC11']) ? date('Y-m-d', strtotime($data['TTGL_BC11'])) : null );
        $data['TTGL_PLP'] = (!empty($data['TTGL_PLP']) ? date('Y-m-d', strtotime($data['TTGL_PLP'])) : null );
        $namaconsolidator = DBConsolidator::select('NAMACONSOLIDATOR','NPWP')->where('TCONSOLIDATOR_PK',$data['TCONSOLIDATOR_FK'])->first();
        $data['NAMACONSOLIDATOR'] = $namaconsolidator->NAMACONSOLIDATOR;
        $data['ID_CONSOLIDATOR'] = str_replace(array('.','-'),array('',''),$namaconsolidator->NPWP);
//        $namanegara = DBNegara::select('NAMANEGARA')->where('TNEGARA_PK',$data['TNEGARA_FK'])->first();
//        $data['NAMANEGARA'] = $namanegara->NAMANEGARA;
//        $namapelabuhan = DBPelabuhan::select('NAMAPELABUHAN')->where('TPELABUHAN_PK',$data['TPELABUHAN_FK'])->first();
//        $data['NAMAPELABUHAN'] = $namapelabuhan->NAMAPELABUHAN;
//        $namalokasisandar = DBLokasisandar::select('NAMALOKASISANDAR')->where('TLOKASISANDAR_PK',$data['TLOKASISANDAR_FK'])->first();
//        $data['NAMALOKASISANDAR'] = $namalokasisandar->NAMALOKASISANDAR;
//        $data['KD_TPS_ASAL'] = $namalokasisandar->KD_TPS_ASAL;
//        $namashippingline = DBShippingline::select('SHIPPINGLINE')->where('TSHIPPINGLINE_PK',$data['TSHIPPINGLINE_FK'])->first();
//        $data['SHIPPINGLINE'] = $namashippingline->SHIPPINGLINE;
        $namanegara = DBNegara::select('NAMANEGARA')->where('TNEGARA_PK',$data['TNEGARA_FK'])->first();
        if($namanegara){
            $data['NAMANEGARA'] = $namanegara->NAMANEGARA;
        }
        $namapelabuhan = DBPelabuhan::select('NAMAPELABUHAN')->where('TPELABUHAN_PK',$data['TPELABUHAN_FK'])->first();
        if($namapelabuhan){
            $data['NAMAPELABUHAN'] = $namapelabuhan->NAMAPELABUHAN;
        } 
        $namalokasisandar = DBLokasisandar::select('NAMALOKASISANDAR','KD_TPS_ASAL')->where('TLOKASISANDAR_PK',$data['TLOKASISANDAR_FK'])->first();
        if($namalokasisandar){
            $data['NAMALOKASISANDAR'] = $namalokasisandar->NAMALOKASISANDAR;
            $data['KD_TPS_ASAL'] = $namalokasisandar->KD_TPS_ASAL;
        }
        if($data['TSHIPPINGLINE_FK']){
            $namashippingline = DBShippingline::select('SHIPPINGLINE')->where('TSHIPPINGLINE_PK',$data['TSHIPPINGLINE_FK'])->first();
            $data['SHIPPINGLINE'] = $namashippingline->SHIPPINGLINE;
        }
        $data['UID'] = \Auth::getUser()->name;
        
        $update = DBJoborder::where('TJOBORDER_PK', $id)
            ->update($data);

        if($update){
            
            //UPDATE CONTAINER
            $joborder = DBJoborder::findOrFail($id);
            $data = array();
            $data['TJOBORDER_FK'] = $joborder->TJOBORDER_PK;
            $data['NoJob'] = $joborder->NOJOBORDER;
            $data['NO_BC11'] = $joborder->TNO_BC11;
            $data['TGL_BC11'] = $joborder->TTGL_BC11;
            $data['NO_PLP'] = $joborder->TNO_PLP;
            $data['TGL_PLP'] = $joborder->TTGL_PLP;
            $data['TCONSOLIDATOR_FK'] = $joborder->TCONSOLIDATOR_FK;
            $data['NAMACONSOLIDATOR'] = $joborder->NAMACONSOLIDATOR;
            $data['ID_CONSOLIDATOR'] = $joborder->ID_CONSOLIDATOR;
            $data['TLOKASISANDAR_FK'] = $joborder->TLOKASISANDAR_FK;
            $data['ETA'] = $joborder->ETA;
            $data['ETD'] = $joborder->ETD;
            $data['VESSEL'] = $joborder->VESSEL;
            $data['VOY'] = $joborder->VOY;
            $data['TPELABUHAN_FK'] = $joborder->TPELABUHAN_FK;
            $data['NAMAPELABUHAN'] = $joborder->NAMAPELABUHAN;
            $data['PEL_MUAT'] = $joborder->PEL_MUAT;
            $data['PEL_BONGKAR'] = $joborder->PEL_BONGKAR;
            $data['PEL_TRANSIT'] = $joborder->PEL_TRANSIT;
            $data['NOMBL'] = $joborder->NOMBL;
            $data['TGL_MASTER_BL'] = $joborder->TGL_MASTER_BL;
            $data['KD_TPS_ASAL'] = $joborder->KD_TPS_ASAL;
            $data['KD_TPS_TUJUAN'] = $joborder->GUDANG_TUJUAN;
            $data['CALL_SIGN'] = $joborder->CALLSIGN;
            
            $updateContainer = DBContainer::where('TJOBORDER_FK', $id)
                    ->update($data);
            
            if($updateContainer){
                
                //UPDATE MANIFEST
                $data = array();
                $data['TCONSOLIDATOR_FK'] = $joborder->TCONSOLIDATOR_FK;
                $data['NAMACONSOLIDATOR'] = $joborder->NAMACONSOLIDATOR;
                $data['TLOKASISANDAR_FK'] = $joborder->TLOKASISANDAR_FK;
                $data['KD_TPS_ASAL'] = $joborder->KD_TPS_ASAL;
                $data['ETA'] = $joborder->ETA;
                $data['ETD'] = $joborder->ETD;
                $data['VESSEL'] = $joborder->VESSEL;
                $data['VOY'] = $joborder->VOY;
                $data['TPELABUHAN_FK'] = $joborder->TPELABUHAN_FK;
                $data['NAMAPELABUHAN'] = $joborder->NAMAPELABUHAN;
                $data['PEL_MUAT'] = $joborder->PEL_MUAT;
                $data['PEL_BONGKAR'] = $joborder->PEL_BONGKAR;
                $data['PEL_TRANSIT'] = $joborder->PEL_TRANSIT;

                $data['NO_BC11'] = $joborder->TNO_BC11;
                $data['TGL_BC11'] = $joborder->TTGL_BC11;
                $data['NO_PLP'] = $joborder->TNO_PLP;
                $data['TGL_PLP'] = $joborder->TTGL_PLP;
                
                $updateManifest = DBManifest::where('TJOBORDER_FK', $id)
                    ->update($data);
               
                if($updateManifest){
                    
                    return back()->with('success', 'LCL Register has been updated.');                   
                }
                
                return back()->with('success', 'LCL Register & Container has been updated, but manifest not updated.');
            }
            
            return back()->with('success', 'LCL Register has been updated, but container not updated.');
        }
        
        return back()->with('error', 'LCL Register cannot update, please try again.')->withInput();
    }
    
    public function gateinUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        $delete_photo = $data['delete_photo'];
        unset($data['TCONTAINER_PK'], $data['delete_photo'], $data['_token']);
        
        if(empty($data['TGLMASUK']) || $data['TGLMASUK'] == '0000-00-00'){
            $data['TGLMASUK'] = NULL;
            $data['JAMMASUK'] = NULL;
        }
        
        if($delete_photo == 'Y'){
            $data['photo_gatein_extra'] = '';
        }
        
        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($data);
        
        if($update){
            
            $dataManifest['tglmasuk'] = $data['TGLMASUK'];
            $dataManifest['Jammasuk'] = $data['JAMMASUK'];  
            $dataManifest['NOPOL_MASUK'] = $data['NOPOL']; 

            $updateManifest = DBManifest::where('TCONTAINER_FK', $id)
                    ->update($dataManifest);
            
            if($updateManifest){
                return json_encode(array('success' => true, 'message' => 'Gate IN successfully updated!'));
            }
            
            return json_encode(array('success' => true, 'message' => 'Container successfully updated, but Manifest not updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));

    }
    
    public function strippingUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        $dataupdate = array();
//        unset($data['TCONTAINER_PK'], $data['working_hours'], $data['_token']);
        
        $delete_photo = $data['delete_photo'];
        
        if($delete_photo == 'Y'){
            $dataupdate['photo_stripping'] = '';
        }
               
        $dataupdate['STARTSTRIPPING'] = $data['STARTSTRIPPING'].' '.$data['JAMSTARTSTRIPPING'];
        $dataupdate['ENDSTRIPPING'] = $data['ENDSTRIPPING'].' '.$data['JAMENDSTRIPPING'];
        $dataupdate['TGLSTRIPPING'] = $data['ENDSTRIPPING'];
        $dataupdate['JAMSTRIPPING'] = $data['JAMENDSTRIPPING'];
        $dataupdate['UIDSTRIPPING'] = $data['UIDSTRIPPING'];
        $dataupdate['coordinator_stripping'] = $data['coordinator_stripping'];
        $dataupdate['keterangan'] = $data['keterangan'];
        $dataupdate['mulai_tunda'] = $data['mulai_tunda'];
        $dataupdate['selesai_tunda'] = $data['selesai_tunda'];
        $dataupdate['operator_forklif'] = $data['operator_forklif'];
        
        // Calculate Working Hours
//        $date_start_stripping = strtotime($dataupdate['STARTSTRIPPING']);
//        $date_end_stripping = strtotime($dataupdate['ENDSTRIPPING']);
//        $stripping = abs($date_start_stripping - $date_end_stripping);
        
        $s_time1 = new \DateTime($dataupdate['STARTSTRIPPING']);
        $s_time2 = new \DateTime($dataupdate['ENDSTRIPPING']);

        $s_interval =  $s_time2->diff($s_time1);
        
//        $s_hours = $stripping / ( 60 * 60 );
        
//        $date_start_tunda = strtotime($dataupdate['mulai_tunda']);
//        $date_end_tunda = strtotime($dataupdate['selesai_tunda']);
//        $tunda = abs($date_start_tunda - $date_end_tunda);
        
        $t_time1 = new \DateTime($dataupdate['mulai_tunda']);
        $t_time2 = new \DateTime($dataupdate['selesai_tunda']);

        $t_interval =  $t_time2->diff($t_time1);
        
        $time1 = new \DateTime($s_interval->format("%H:%i:%s"));
        $time2 = new \DateTime($t_interval->format("%H:%i:%s"));
        
        $interval = $time2->diff($time1);
        
        $working_hours = $interval->format("%H:%i");
        $dataupdate['working_hours'] = $working_hours;
        
        if(empty($data['STARTSTRIPPING']) || $data['ENDSTRIPPING'] == '0000-00-00'){
            $dataupdate['STARTSTRIPPING'] = NULL;
            $dataupdate['ENDSTRIPPING'] = NULL;
            $dataupdate['TGLSTRIPPING'] = NULL;
            $dataupdate['JAMSTRIPPING'] = NULL;
        }
        
        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($dataupdate);
        
        if($update){
            
            $dataManifest['tglstripping'] = $data['ENDSTRIPPING'];
            $dataManifest['jamstripping'] = $data['JAMENDSTRIPPING'];  
            $dataManifest['STARTSTRIPPING'] = $data['STARTSTRIPPING'].' '.$data['JAMSTARTSTRIPPING'];
            $dataManifest['ENDSTRIPPING'] = $data['ENDSTRIPPING'].' '.$data['JAMENDSTRIPPING'];
            
            $updateManifest = DBManifest::where('TCONTAINER_FK', $id)
                    ->update($dataManifest);
            
            if($updateManifest){
                return json_encode(array('success' => true, 'message' => 'Stripping successfully updated!'));
            }
            
            return json_encode(array('success' => true, 'message' => 'Container successfully updated, but Manifest not updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
        
    }
    
    public function strippingApprove($id)
    {
        $dataupdate = array();
               
        $dataupdate['STARTSTRIPPING'] = date('Y-m-d H:i:s');
        $dataupdate['ENDSTRIPPING'] = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $dataupdate['TGLSTRIPPING'] = date('Y-m-d');
        $dataupdate['JAMSTRIPPING'] = date('H:i:s', strtotime('+1 hour'));
        $dataupdate['UIDSTRIPPING'] = \Auth::getUser()->name;
        $dataupdate['mulai_tunda'] = '00:00';
        $dataupdate['selesai_tunda'] = '00:00';
        
        // Calculate Working Hours
//        $date_start_stripping = strtotime($dataupdate['STARTSTRIPPING']);
//        $date_end_stripping = strtotime($dataupdate['ENDSTRIPPING']);
//        $stripping = abs($date_start_stripping - $date_end_stripping);
        
        $s_time1 = new \DateTime($dataupdate['STARTSTRIPPING']);
        $s_time2 = new \DateTime($dataupdate['ENDSTRIPPING']);

        $s_interval =  $s_time2->diff($s_time1);
        
//        $s_hours = $stripping / ( 60 * 60 );
        
//        $date_start_tunda = strtotime($dataupdate['mulai_tunda']);
//        $date_end_tunda = strtotime($dataupdate['selesai_tunda']);
//        $tunda = abs($date_start_tunda - $date_end_tunda);
        
        $t_time1 = new \DateTime($dataupdate['mulai_tunda']);
        $t_time2 = new \DateTime($dataupdate['selesai_tunda']);

        $t_interval =  $t_time2->diff($t_time1);
        
        $time1 = new \DateTime($s_interval->format("%H:%i:%s"));
        $time2 = new \DateTime($t_interval->format("%H:%i:%s"));
        
        $interval = $time2->diff($time1);
        
        $working_hours = $interval->format("%H:%i");
        $dataupdate['working_hours'] = $working_hours;
        
        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($dataupdate);
        
        if($update){
            
            $dataManifest['tglstripping'] = $dataupdate['TGLSTRIPPING'];
            $dataManifest['jamstripping'] = $dataupdate['JAMSTRIPPING'];  
            $dataManifest['STARTSTRIPPING'] = $dataupdate['STARTSTRIPPING'];
            $dataManifest['ENDSTRIPPING'] = $dataupdate['ENDSTRIPPING'];
            
            $updateManifest = DBManifest::where('TCONTAINER_FK', $id)
                    ->update($dataManifest);
            
            if($updateManifest){
                return json_encode(array('success' => true, 'message' => 'Stripping successfully updated!'));
            }
            
            return json_encode(array('success' => true, 'message' => 'Container successfully updated, but Manifest not updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function buangmtyUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TCONTAINER_PK'], $data['_token']);
        
        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($data);
        
        if($update){
            
            $dataManifest['tglbuangmty'] = $data['TGLBUANGMTY'];
            $dataManifest['jambuangmty'] = $data['JAMBUANGMTY'];  
            $dataManifest['NOPOL_MTY'] = $data['NOPOL_MTY'];
            
            $updateManifest = DBManifest::where('TCONTAINER_FK', $id)
                    ->update($dataManifest);
            
            if($updateManifest){
                return json_encode(array('success' => true, 'message' => 'Buang MTY successfully updated!'));
            }
            
            return json_encode(array('success' => true, 'message' => 'Container successfully updated, but Manifest not updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function behandleUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        $delete_photo = $data['delete_photo'];
        unset($data['TMANIFEST_PK'], $data['delete_photo'], $data['_token']);
        
        $data['BEHANDLE'] = 'Y';
//        $data['date_ready_behandle'] = date('Y-m-d H:i:s');
        
        if($delete_photo == 'Y'){
            $data['photo_behandle'] = '';
        }
        
        $update = DBManifest::where('TMANIFEST_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Behandle successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function behandleReady(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['_token']);

        $data['date_ready_behandle'] = date('Y-m-d H:i:s');  
        $data['status_behandle'] = 'Siap Periksa';
        
        $update = DBManifest::where('TMANIFEST_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Behandle successfully updated to Ready!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function fiatmuatUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TMANIFEST_PK'], $data['_token']);
        
        $data['TGLSURATJALAN'] = $data['tglfiat'];
        $data['JAMSURATJALAN'] = $data['jamfiat'];
        $data['tglrelease'] = $data['tglfiat'];
        $data['jamrelease'] = $data['jamfiat'];
        $data['NOPOL_RELEASE'] = $data['NOPOL'];
        
        $update = DBManifest::where('TMANIFEST_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Fiat Muat successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function suratjalanUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TMANIFEST_PK'], $data['_token']);
        
        $update = DBManifest::where('TMANIFEST_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Surat Jalan successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function releaseUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        $delete_photo = $data['delete_photo'];
        unset($data['TMANIFEST_PK'], $data['delete_photo'], $data['_token']);
        
        $manifest = DBManifest::find($id);
        
        if(empty($data['NOTALLY'])) {
            $manifestID = DBManifest::select('NOTALLY')->where('NOTALLY', NULL)->count();
            $regID = str_pad(intval(($manifestID > 0 ? $manifestID : 0)+1), 3, '0', STR_PAD_LEFT);

            $data['NOTALLY'] = 'PRJPL0000/17.'.$regID;
        }
        
        $kode_dok = \App\Models\KodeDok::find($data['KD_DOK_INOUT']);
        if($kode_dok){
            $data['KODE_DOKUMEN'] = $kode_dok->name;
        }
        
        if(empty($data['tglrelease']) || $data['tglrelease'] == '0000-00-00'){
            $data['tglrelease'] = NULL;
            $data['jamrelease'] = NULL;
        }
        
        if($manifest->release_bc == 'Y'){
            $data['status_bc'] = 'RELEASE';
            $this->changeBarcodeStatus($manifest->TMANIFEST_PK, $manifest->NOHBL, 'Manifest', 'active');
        }else{
            if($data['KD_DOK_INOUT'] > 1){
                $data['status_bc'] = 'HOLD';
                $data['tglrelease'] = NULL;
                $data['jamrelease'] = NULL;
                $this->changeBarcodeStatus($manifest->TMANIFEST_PK, $manifest->NOHBL, 'Manifest', 'hold');
            }else{
                if($manifest->flag_bc == 'Y'){
                    $data['status_bc'] = 'HOLD';
                    $data['tglrelease'] = NULL;
                    $data['jamrelease'] = NULL;
                    $this->changeBarcodeStatus($manifest->TMANIFEST_PK, $manifest->NOHBL, 'Manifest', 'hold');
                }else{
                    $data['status_bc'] = 'RELEASE';
                    $this->changeBarcodeStatus($manifest->TMANIFEST_PK, $manifest->NOHBL, 'Manifest', 'active');
                }
            }
        }
        
        $data['TGLSURATJALAN'] = $data['tglrelease'];
        $data['JAMSURATJALAN'] = $data['jamrelease'];
        $data['tglfiat'] = $data['tglrelease'];
        $data['jamfiat'] = $data['jamrelease'];
        $data['NAMAEMKL'] = $data['UIDRELEASE'];
        $data['UIDSURATJALAN'] = $data['UIDRELEASE'];
        $data['NOPOL'] = $data['NOPOL_RELEASE'];
         
        if($data['tglrelease'] != NULL && $manifest->BEHANDLE == 'Y'){
            $data['status_behandle'] = 'Delivery';
        }
        
        if($delete_photo == 'Y'){
            $data['photo_release'] = '';
        }
        
        $update = DBManifest::where('TMANIFEST_PK', $id)
            ->update($data);
        
        if($update){
//            $sor = $this->updateSor('release', $meas->MEAS);

            return json_encode(array('success' => true, 'message' => 'Release successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function dispatcheUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
//        return $data;
        unset($data['TCONTAINER_PK'], $data['_token'], $data['container_type']);
        
        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Container successfully updated.'));
        }
        
//        $insert = new \App\Models\Easygo;
//        $insert->ESEALCODE = $data['ESEALCODE'];
//	$insert->TGL_PLP = $data['TGL_PLP'];
//	$insert->NO_PLP = $data['NO_PLP'];
//        $insert->KD_TPS_ASAL = $data['KD_TPS_ASAL'];
//        $insert->KD_TPS_TUJUAN = 'PRJP';
//        $insert->NOCONTAINER = $data['NO_CONT'];
//        $insert->SIZE = $data['UK_CONT'];
//        $insert->TYPE = $data['container_type'];
//        $insert->NOPOL = $data['NOPOL'];
//        $insert->OB_ID = $id;
//        
//        if($insert->save()){
//            
//            $updateOB = \App\Models\TpsOb::where('TPSOBXML_PK', $id)->update(['STATUS_DISPATCHE' => 'S']);
//            
//            // Update Container
//            $container = DBContainer::where(array('NOCONTAINER' => $data['NOCONTAINER'], 'NO_PLP' => $data['NO_PLP']))->first(); 
//            if($container){
//                $container->NOPOL = $data['NOPOL'];
//                $container->ESEALCODE = $data['ESEALCODE'];
//                $container->save();
//            }
//            
//            return json_encode(array('success' => true, 'message' => 'Container successfully updated.'));
//        }
        
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
        $container = DBContainer::find($id);
        if($container){
            // Delete Manifest
            DBManifest::where('TJOBORDER_FK', $container->TJOBORDER_FK)->delete();
            // Delete Container
            DBContainer::where('TJOBORDER_FK', $container->TJOBORDER_FK)->delete();
            // Delete Joborder
            DBJoborder::where('TJOBORDER_PK', $container->TJOBORDER_FK)->delete();
            
            return back()->with('success', 'LCL Register has been deleted.'); 
        }
        
        return back()->with('error', 'Error delete LCL register, please try again.'); 
    }
    
    public function registerPrintPermohonan(Request $request)
    {
        $data = $request->except(['_token']);
        $container = DBContainer::find($data['container_id']);
        $lokasisandar = DBLokasisandar::find($container->TLOKASISANDAR_FK);
        
        $result['info'] = $data;
        $result['container'] = $container;
        $result['lokasisandar'] = $lokasisandar;
        
        $pdf = \PDF::loadView('print.permohonan', $result);
        return $pdf->download('Permohonan-'.$container->NOCONTAINER.'-'.date('dmy').'.pdf');
        
//        return view('print.permohonan', $result);
    }
    
    public function buangmtyCetak($id, $type)
    {
        $container = DBContainer::find($id);
        $data['container'] = $container;
//        return view('print.bon-muat', $container);
        
        switch ($type){
            case 'bon-muat':
                $pdf = \PDF::loadView('print.bon-muat', $data);        
                break;
            case 'surat-jalan':
                $pdf = \PDF::loadView('print.surat-jalan', $data);
                break;
        }
        
        return $pdf->stream(ucfirst($type).'-'.$container->NOCONTAINER.'-'.date('dmy').'.pdf');
    }
    
    public function behandleCetak($id)
    {
        $mainfest = DBManifest::find($id);
        $data['manifest'] = $mainfest;
//        return view('print.wo-behandle', $mainfest);
        $pdf = \PDF::loadView('print.wo-behandle', $data); 
        return $pdf->stream('WO-Behandle-'.$mainfest->NOHBL.'-'.date('dmy').'.pdf');
    }
    
    public function fiatmuatCetak($id)
    {
        $mainfest = DBManifest::find($id);
        $data['manifest'] = $mainfest;
//        return view('print.wo-fiatmuat', $data);
        $pdf = \PDF::loadView('print.wo-fiatmuat', $data); 
        return $pdf->stream('WO-FiatMuat-'.$mainfest->NOHBL.'-'.date('dmy').'.pdf');
    }
    
    public function suratjalanCetak($id)
    {
        $mainfest = DBManifest::find($id);
        $data['manifest'] = $mainfest;
        $data['consignee'] = DBPerusahaan::find($mainfest->TCONSIGNEE_FK);
        return view('print.lcl-surat-jalan', $data);
//        return view('print.delivery-surat-jalan', $data);
//        $pdf = \PDF::loadView('print.delivery-surat-jalan', $data); 
//        return $pdf->stream('Delivery-SuratJalan-'.$mainfest->NOHBL.'-'.date('dmy').'.pdf');
    }
    
    // REPORT
    public function reportInout(Request $request)
    {
        if ( !$this->access->can('show.lcl.report.stock') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Report Stock LCL', 'slug' => 'show.lcl.report.stock', 'description' => ''));
        
        $data['page_title'] = "LCL Report Stock";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Report Stock'
            ]
        ];        
        
        if($request->month && $request->year) {
            $month = $request->month;
            $year = $request->year;
        } else {
            $month = date('m');
            $year = date('Y');
        }
        
        $bc20 = DBManifest::where('KD_DOK_INOUT', 1)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $bc23 = DBManifest::where('KD_DOK_INOUT', 2)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $bc12 = DBManifest::where('KD_DOK_INOUT', 4)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $bc15 = DBManifest::where('KD_DOK_INOUT', 9)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $bc11 = DBManifest::where('KD_DOK_INOUT', 20)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $bcf26 = DBManifest::where('KD_DOK_INOUT', 5)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $data['countbydoc'] = array('BC 2.0' => $bc20, 'BC 2.3' => $bc23, 'BC 1.2' => $bc12, 'BC 1.5' => $bc15, 'BC 1.1' => $bc11, 'BCF 2.6' => $bcf26);
        
        $data['month'] = $month;
        $data['year'] = $year;
        
        $meas_count = DBManifest::whereNotNull('tglmasuk')
                                ->whereNotNull('tglstripping')
                                ->whereNull('tglrelease')                                
                                ->sum('MEAS');
        $data['meas'] = $meas_count;
        $this->updateSorByMeas();
        $data['sor'] = \App\Models\SorYor::where('type', 'sor')->first();
        
        return view('import.lcl.report-inout')->with($data);
    }
    
    public function reportInoutViewPhoto($manifestID)
    {
        $manifest = DBManifest::find($manifestID);
        $container = DBContainer::find($manifest->TCONTAINER_FK);
        
        $manifest->photo_get_in = $container->photo_get_in;
        $manifest->photo_get_out = $container->photo_get_out;
        $manifest->photo_gatein_extra = $container->photo_gatein_extra;
        $manifest->photo_hasil_stripping = $container->photo_stripping;
        
        return json_encode(array('success' => true, 'data' => $manifest));
    }
    
    public function reportContainer(Request $request)
    {
        if ( !$this->access->can('show.lcl.report.container') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Report Container LCL', 'slug' => 'show.lcl.report.container', 'description' => ''));
        
        $data['page_title'] = "LCL Report Container";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Report Container'
            ]
        ];        
        
        if($request->month && $request->year) {
            $month = $request->month;
            $year = $request->year;
        } else {
            $month = date('m');
            $year = date('Y');
        }
        
//        BY PLP
        $twenty = DBContainer::where('SIZE', 20)->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $fourty = DBContainer::where('SIZE', 40)->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $teus = ($twenty*1)+($fourty*2);
        $data['countbysize'] = array('twenty' => $twenty, 'fourty' => $fourty, 'total' => $twenty+$fourty, 'teus' => $teus);
        
        $jict = DBContainer::where('KD_TPS_ASAL', 'JICT')->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $koja = DBContainer::where('KD_TPS_ASAL', 'KOJA')->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $mal = DBContainer::where('KD_TPS_ASAL', 'MAL0')->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $nct1 = DBContainer::where('KD_TPS_ASAL', 'NCT1')->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $pldc = DBContainer::where('KD_TPS_ASAL', 'PLDC')->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        
        $fc = DBContainer::whereIn('TCONSOLIDATOR_FK', array(1,4))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $me = DBContainer::whereIn('TCONSOLIDATOR_FK', array(13,16))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $ap = DBContainer::whereIn('TCONSOLIDATOR_FK', array(10,12))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $da = DBContainer::whereIn('TCONSOLIDATOR_FK', array(24))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        
//        BY GATEIN
        $twentyg = DBContainer::where('SIZE', 20)->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $fourtyg = DBContainer::where('SIZE', 40)->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $teusg = ($twentyg*1)+($fourtyg*2);
        $data['countbysizegatein'] = array('twenty' => $twentyg, 'fourty' => $fourtyg, 'total' => $twentyg+$fourtyg, 'teus' => $teusg);
        
        $jictg = DBContainer::where('KD_TPS_ASAL', 'JICT')->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $kojag = DBContainer::where('KD_TPS_ASAL', 'KOJA')->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $malg = DBContainer::where('KD_TPS_ASAL', 'MAL0')->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $nct1g = DBContainer::where('KD_TPS_ASAL', 'NCT1')->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $pldcg = DBContainer::where('KD_TPS_ASAL', 'PLDC')->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        
        $fcg = DBContainer::whereIn('TCONSOLIDATOR_FK', array(1,4))->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $meg = DBContainer::whereIn('TCONSOLIDATOR_FK', array(13,16))->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $apg = DBContainer::whereIn('TCONSOLIDATOR_FK', array(10,12))->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $dae = DBContainer::whereIn('TCONSOLIDATOR_FK', array(24))->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        
        $data['countbytps'] = array('JICT' => array($jict, $jictg), 'KOJA' => array($koja, $kojag), 'MAL0' => array($mal, $malg), 'NCT1' => array($nct1, $nct1g), 'PLDC' => array($pldc, $pldcg));
        $data['countbyconsolidator'] = array('FBI/CPL' => array($fc, $fcg), 'MKT/ECU' => array($me, $meg), 'ARJAKA/PELOPOR' => array($ap, $apg), 'DAEHAN' => array($da, $dae));
        
        $data['totcounttpsp'] = array_sum(array($jict,$koja,$mal,$nct1,$pldc));
        $data['totcounttpsg'] = array_sum(array($jictg,$kojag,$malg,$nct1g,$pldcg));
        
        $data['totcountconsolidatorp'] = array_sum(array($fc,$me,$ap,$da));
        $data['totcountconsolidatorg'] = array_sum(array($fcg,$meg,$apg,$dae));
        
        $data['month'] = $month;
        $data['year'] = $year;
        
        return view('import.lcl.report-container')->with($data);
    }
    
    public function reportContainerViewPhoto($containerID)
    {
        $container = DBContainer::find($containerID);
        
        return json_encode(array('success' => true, 'data' => $container));
    }
    
    public function reportHarian()
    {
        if ( !$this->access->can('show.lcl.report.harian') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Report Harian LCL', 'slug' => 'show.lcl.report.harian', 'description' => ''));
        
        $data['page_title'] = "LCL Report Delivery Harian";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Report Delivery Harian'
            ]
        ];        
        
        return view('import.lcl.report-harian')->with($data);
    }
    
    public function reportRekap()
    {
        if ( !$this->access->can('show.lcl.report.rekap') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Report Rekap LCL', 'slug' => 'show.lcl.report.rekap', 'description' => ''));
        
        $data['page_title'] = "LCL Rekap Import";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Rekap Import'
            ]
        ];        
        
        return view('import.lcl.report-rekap')->with($data);
    }
    
    public function reportStock()
    {
        
    }
    
    public function reportLongstay()
    {
        if ( !$this->access->can('show.lcl.report.longstay') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Report Longstay Stock', 'slug' => 'show.lcl.report.longstay', 'description' => ''));
        
        $data['page_title'] = "LCL Inventory Stock";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Inventory Stock'
            ]
        ];  
        
        return view('import.lcl.report-longstay')->with($data);
    }

    // TPS ONLINE    
    public function gateinUpload(Request $request)
    {
        $container_id = $request->id; 
        $container = DBContainer::where('TCONTAINER_PK', $container_id)->first();
        
        // Check data xml
        $check = \App\Models\TpsCoariContDetail::where('NO_CONT', $container->NOCONTAINER)->count();
        
//        if($check > 0){
//            return json_encode(array('success' => false, 'message' => 'No. Container '.$container->NOCONTAINER.' sudah di upload.'));
//        }
        
        // Reff Number
        $reff_number = $this->getReffNumber();   
        if($reff_number){
            $coaricont = new \App\Models\TpsCoariCont;
            $coaricont->REF_NUMBER = $reff_number;
            $coaricont->TGL_ENTRY = date('Y-m-d');
            $coaricont->JAM_ENTRY = date('H:i:s');
            $coaricont->UID = \Auth::getUser()->name;
            
            if($coaricont->save()){
                $coaricontdetail = new \App\Models\TpsCoariContDetail;
                $coaricontdetail->TPSCOARICONTXML_FK = $coaricont->TPSCOARICONTXML_PK;
                $coaricontdetail->REF_NUMBER = $reff_number;
                $coaricontdetail->KD_DOK = 5;
                $coaricontdetail->KD_TPS = 'PRJP';
                $coaricontdetail->NM_ANGKUT = (!empty($container->VESSEL) ? $container->VESSEL : 0);
                $coaricontdetail->NO_VOY_FLIGHT = (!empty($container->VOY) ? $container->VOY : 0);
                $coaricontdetail->CALL_SIGN = (!empty($container->CALL_SIGN) ? $container->CALL_SIGN : 0);
                $coaricontdetail->TGL_TIBA = (!empty($container->ETA) ? date('Ymd', strtotime($container->ETA)) : '');
                $coaricontdetail->KD_GUDANG = 'PRJP';
                $coaricontdetail->NO_CONT = $container->NOCONTAINER;
                $coaricontdetail->UK_CONT = $container->SIZE;
                $coaricontdetail->NO_SEGEL = $container->NO_SEAL;
                $coaricontdetail->JNS_CONT = 'L';
                $coaricontdetail->NO_BL_AWB = '';
                $coaricontdetail->TGL_BL_AWB = '';
                $coaricontdetail->NO_MASTER_BL_AWB = $container->NOMBL;
                $coaricontdetail->TGL_MASTER_BL_AWB = (!empty($container->TGL_MASTER_BL) ? date('Ymd', strtotime($container->TGL_MASTER_BL)) : '');
                $coaricontdetail->ID_CONSIGNEE = str_replace(array('.','-'), array(''), $container->ID_CONSOLIDATOR);
                $coaricontdetail->CONSIGNEE = $container->NAMACONSOLIDATOR;
                $coaricontdetail->BRUTO = (!empty($container->WEIGHT) ? $container->WEIGHT : 0);
                $coaricontdetail->NO_BC11 = $container->NO_BC11;
                $coaricontdetail->TGL_BC11 = (!empty($container->TGL_BC11) ? date('Ymd', strtotime($container->TGL_BC11)) : '');
                $coaricontdetail->NO_POS_BC11 = '';
                $coaricontdetail->KD_TIMBUN = 'GD';
                $coaricontdetail->KD_DOK_INOUT = 3;
                $coaricontdetail->NO_DOK_INOUT = (!empty($container->NO_PLP) ? $container->NO_PLP : '');
                $coaricontdetail->TGL_DOK_INOUT = (!empty($container->TGL_PLP) ? date('Ymd', strtotime($container->TGL_PLP)) : '');
                $coaricontdetail->WK_INOUT = date('Ymd', strtotime($container->TGLMASUK)).date('His', strtotime($container->JAMMASUK));
                $coaricontdetail->KD_SAR_ANGKUT_INOUT = 1;
                $coaricontdetail->NO_POL = $container->NOPOL;
                $coaricontdetail->FL_CONT_KOSONG = 2;
                $coaricontdetail->ISO_CODE = '';
                $coaricontdetail->PEL_MUAT = $container->PEL_MUAT;
                $coaricontdetail->PEL_TRANSIT = $container->PEL_TRANSIT;
                $coaricontdetail->PEL_BONGKAR = $container->PEL_BONGKAR;
                $coaricontdetail->GUDANG_TUJUAN = 'PRJP';
                $coaricontdetail->UID = \Auth::getUser()->name;
                $coaricontdetail->NOURUT = 1;
                $coaricontdetail->RESPONSE = '';
                $coaricontdetail->STATUS_TPS = 1;
                $coaricontdetail->KODE_KANTOR = '040300';
                $coaricontdetail->NO_DAFTAR_PABEAN = '';
                $coaricontdetail->TGL_DAFTAR_PABEAN = '';
                $coaricontdetail->NO_SEGEL_BC = '';
                $coaricontdetail->TGL_SEGEL_BC = '';
                $coaricontdetail->NO_IJIN_TPS = '';
                $coaricontdetail->TGL_IJIN_TPS = '';
                $coaricontdetail->RESPONSE_IPC = '';
                $coaricontdetail->STATUS_TPS_IPC = '';
                $coaricontdetail->NOPLP = $container->NO_PLP;
                $coaricontdetail->TGLPLP = (!empty($container->TGL_PLP) ? date('Ymd', strtotime($container->TGL_PLP)) : '');
                $coaricontdetail->FLAG_REVISI = '';
                $coaricontdetail->TGL_REVISI = '';
                $coaricontdetail->TGL_REVISI_UPDATE = '';
                $coaricontdetail->KD_TPS_ASAL = $container->KD_TPS_ASAL;
                $coaricontdetail->FLAG_UPD = '';
                $coaricontdetail->RESPONSE_MAL0 = '';
                $coaricontdetail->STATUS_TPS_MAL0 = '';
                $coaricontdetail->TGL_ENTRY = date('Y-m-d');
                $coaricontdetail->JAM_ENTRY = date('H:i:s');
                
                if($coaricontdetail->save()){
                    
                    $container->REF_NUMBER_IN = $reff_number;
                    $container->save();                    
                    
                    return json_encode(array('insert_id' => $coaricont->TPSCOARICONTXML_PK, 'ref_number' => $reff_number, 'success' => true, 'message' => 'No. Container '.$container->NOCONTAINER.' berhasil di simpan. Reff Number : '.$reff_number));
                }
                
            }
            
        } else {
            return json_encode(array('success' => false, 'message' => 'Cannot create Reff Number, please try again later.'));
        }
              
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
        
    }
    
    public function buangmtyUpload(Request $request)
    {
        $container_id = $request->id; 
        $container = DBContainer::where('TCONTAINER_PK', $container_id)->first();
        
        // Check data xml
        $check = \App\Models\TpsCodecoContFclDetail::where('NO_CONT', $container->NOCONTAINER)->count();
        
//        if($check > 0){
//            return json_encode(array('success' => false, 'message' => 'No. Container '.$container->NOCONTAINER.' sudah di upload.'));
//        }
        
        // Reff Number
        $reff_number = $this->getReffNumber();   
        if($reff_number){
            
            $codecocont = new \App\Models\TpsCodecoContFcl();
            $codecocont->NOJOBORDER = $container->NoJob;
            $codecocont->REF_NUMBER = $reff_number;
            $codecocont->TGL_ENTRY = date('Y-m-d');
            $codecocont->JAM_ENTRY = date('H:i:s');
            $codecocont->UID = \Auth::getUser()->name;
            
            if($codecocont->save()){
                $codecocontdetail = new \App\Models\TpsCodecoContFclDetail;
                $codecocontdetail->TPSCODECOCONTXML_FK = $codecocont->TPSCODECOCONTXML_PK;
                $codecocontdetail->REF_NUMBER = $reff_number;
                $codecocontdetail->NOJOBORDER = $container->NoJob;
                $codecocontdetail->KD_DOK = 6;
                $codecocontdetail->KD_TPS = 'PRJP';
                $codecocontdetail->NM_ANGKUT = (!empty($container->VESSEL) ? $container->VESSEL : 0);
                $codecocontdetail->NO_VOY_FLIGHT = (!empty($container->VOY) ? $container->VOY : 0);
                $codecocontdetail->CALL_SIGN = (!empty($container->CALL_SIGN) ? $container->CALL_SIGN : 0);
                $codecocontdetail->TGL_TIBA = (!empty($container->ETA) ? date('Ymd', strtotime($container->ETA)) : '');
                $codecocontdetail->KD_GUDANG = 'PRJP';
                $codecocontdetail->NO_CONT = $container->NOCONTAINER;
                $codecocontdetail->UK_CONT = $container->SIZE;
                $codecocontdetail->NO_SEGEL = $container->NO_SEAL;
                $codecocontdetail->JNS_CONT = 'L';
                $codecocontdetail->NO_BL_AWB = '';
                $codecocontdetail->TGL_BL_AWB = '';
                $codecocontdetail->NO_MASTER_BL_AWB = $container->NOMBL;
                $codecocontdetail->TGL_MASTER_BL_AWB = (!empty($container->TGL_MASTER_BL) ? date('Ymd', strtotime($container->TGL_MASTER_BL)) : '');
                $codecocontdetail->ID_CONSIGNEE = str_replace(array('.','-'), array(''),$container->ID_CONSOLIDATOR);
                $codecocontdetail->CONSIGNEE = $container->NAMACONSOLIDATOR;
                $codecocontdetail->BRUTO = (!empty($container->WEIGHT) ? $container->WEIGHT : 0);
                $codecocontdetail->NO_BC11 = $container->NO_BC11;
                $codecocontdetail->TGL_BC11 = (!empty($container->TGL_BC11) ? date('Ymd', strtotime($container->TGL_BC11)) : '');
                $codecocontdetail->NO_POS_BC11 = '';
                $codecocontdetail->KD_TIMBUN = 'GD';
                $codecocontdetail->KD_DOK_INOUT = 40;
                $codecocontdetail->NO_DOK_INOUT = (!empty($container->NO_PLP) ? $container->NO_PLP : '');
                $codecocontdetail->TGL_DOK_INOUT = (!empty($container->TGL_PLP) ? date('Ymd', strtotime($container->TGL_PLP)) : '');
                $codecocontdetail->WK_INOUT = date('Ymd', strtotime($container->TGLBUANGMTY)).date('His', strtotime($container->JAMBUANGMTY));
                $codecocontdetail->KD_SAR_ANGKUT_INOUT = 1;
                $codecocontdetail->NO_POL = $container->NOPOL_MTY;
                $codecocontdetail->FL_CONT_KOSONG = 1;
                $codecocontdetail->ISO_CODE = '';
                $codecocontdetail->PEL_MUAT = $container->PEL_MUAT;
                $codecocontdetail->PEL_TRANSIT = $container->PEL_TRANSIT;
                $codecocontdetail->PEL_BONGKAR = $container->PEL_BONGKAR;
                $codecocontdetail->GUDANG_TUJUAN = 'PRJP';
                $codecocontdetail->UID = \Auth::getUser()->name;
                $codecocontdetail->NOURUT = 1;
                $codecocontdetail->RESPONSE = '';
                $codecocontdetail->STATUS_TPS = '';
                $codecocontdetail->KODE_KANTOR = '040300';
                $codecocontdetail->NO_DAFTAR_PABEAN = '';
                $codecocontdetail->TGL_DAFTAR_PABEAN = '';
                $codecocontdetail->NO_SEGEL_BC = '';
                $codecocontdetail->TGL_SEGEL_BC = '';
                $codecocontdetail->NO_IJIN_TPS = '';
                $codecocontdetail->TGL_IJIN_TPS = '';
                $codecocontdetail->RESPONSE_IPC = '';
                $codecocontdetail->STATUS_TPS_IPC = '';
                $codecocontdetail->NOSPPB = '';
                $codecocontdetail->TGLSPPB = '';
                $codecocontdetail->FLAG_REVISI = '';
                $codecocontdetail->TGL_REVISI = '';
                $codecocontdetail->TGL_REVISI_UPDATE = '';
                $codecocontdetail->KD_TPS_ASAL = $container->KD_TPS_ASAL;
                $codecocontdetail->RESPONSE_MAL0 = '';
                $codecocontdetail->STATUS_TPS_MAL0 = '';
                $codecocontdetail->TGL_ENTRY = date('Y-m-d');
                $codecocontdetail->JAM_ENTRY = date('H:i:s');
                
                if($codecocontdetail->save()){
                    
                    $container->REF_NUMBER_OUT = $reff_number;
                    $container->save();
                    
                    return json_encode(array('insert_id' => $codecocont->TPSCODECOCONTXML_PK, 'ref_number' => $reff_number, 'success' => true, 'message' => 'No. Container '.$container->NOCONTAINER.' berhasil di simpan. Reff Number : '.$reff_number));
                }
            }
            
        } else {
            return json_encode(array('success' => false, 'message' => 'Cannot create Reff Number, please try again later.'));
        }
              
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
 
    }
    
    public function releaseCreateInvoice(Request $request)
    {
        $manifest_id = $request->id; 
        $manifest = DBManifest::where('TMANIFEST_PK', $manifest_id)->first();        

        $tarif = \App\Models\InvoiceTarif::where(array('consolidator_id' => $manifest->TCONSOLIDATOR_FK, 'type' => $manifest->INVOICE))->first();
        
//        $invoice = new \App\Models\Invoice;
//        $invoice->manifest_id = $manifest_id;
//        $invoice->no_reg = date('Ymd').'.'.str_pad(intval($manifest->TMANIFEST_PK), 4, '0', STR_PAD_LEFT);
//        $invoice->no_invoice = 'I-'.str_pad(intval(rand()), 7, '0', STR_PAD_LEFT).'/LCL/'.date('Y');
//        $invoice->tgl_cetak = '';
//        $invoice->sub_total = '';
//        $invoice->add_cost = '';
//        $invoice->materai = '';
//        $invoice->grand_total = '';
//        $invoice->uid = \Auth::getUser()->name;
//        
//        if($invoice->save()){
//        
            
            // Perhitungan Hari
            // Tgl masuk container
//            $date1 = date_create($manifest->tglstripping);
            $date1 = date_create($manifest->tglmasuk);
            $date2 = date_create(date('Y-m-d',strtotime($manifest->tglrelease. '+1 days')));
            $diff = date_diff($date1, $date2);
            $hari = $diff->format("%a");
            
            // Perhitungan CBM
            $weight = $manifest->WEIGHT / 1000;
            $meas = $manifest->MEAS;
            $cbm = array($weight, $meas);
            
            if($tarif->pembulatan){            
                $maxcbm = ceil(max($cbm) * 2) / 2;
    //            $maxcbm = ceil(max($cbm));               
            }else{
                $maxcbm = max($cbm);
            }
            
            if($maxcbm < 2){ $maxcbm = 2; }
            
            // Sub Total (CBM*harga*Hari)
            if($tarif->storage > 0){
                $sub_masa = $maxcbm * $tarif->storage;
                $tot_masa = $sub_masa * $hari;
            }else{
                // Masa I
//                if($hari <> 3) {
                $hari_masa1 = 1;
                $sub_masa1 = $maxcbm * $tarif->storage_masa1;
                $tot_masa1 = $hari_masa1 * $sub_masa1;
//                }
                // Masa II
                if($hari > 3 ) {
                    $hari_masa2 = $hari - 3;
                    if($tarif->storage_masa3 > 0){                        
                        if($hari_masa2 > 2) { $hari_masa2 = 2; } 
                    }
                    $sub_masa2 = $maxcbm * $tarif->storage_masa2;
                    $tot_masa2 = $hari_masa2 * $sub_masa2;
                }
                // Masa III
                if($tarif->storage_masa3 > 0){ 
                    if($hari > 5) {
                        $hari_masa3 = $hari - 5;
                        $sub_masa3 = $maxcbm * $tarif->storage_masa3;
                        $tot_masa3 = $hari_masa3 * $sub_masa3;
                    }
                }                
            }
            
            $invoice_import = new \App\Models\Invoice;
            $invoice_import->manifest_id = $manifest_id;
            $invoice_import->cbm = $maxcbm;
            $invoice_import->rdm = $tarif->rdm * $maxcbm;
            $invoice_import->storage = (isset($tot_masa)) ? $tot_masa : 0 ;
            $invoice_import->storage_masa1 = (isset($tot_masa1)) ? $tot_masa1 : 0 ;
            $invoice_import->storage_masa2 = (isset($tot_masa2)) ? $tot_masa2 : 0 ;
            $invoice_import->storage_masa3 = (isset($tot_masa3)) ? $tot_masa3 : 0 ;
            $invoice_import->hari = $hari;
            $invoice_import->hari_masa1 = (isset($hari_masa1)) ? $hari_masa1 : 0 ;
            $invoice_import->hari_masa2 = (isset($hari_masa2)) ? $hari_masa2 : 0 ;
            $invoice_import->hari_masa3 = (isset($hari_masa3)) ? $hari_masa3 : 0 ;

            if(isset($request->behandle)){
                if($tarif->cbm){
                    $harga_behandle = $tarif->behandle * $maxcbm;
                    $invoice_import->behandle = $maxcbm;
                }else{
                    $harga_behandle = $tarif->behandle;
                    $invoice_import->behandle = 1;
                }
                $invoice_import->harga_behandle = $harga_behandle;
            }else{
                $invoice_import->behandle = 0;
                $invoice_import->harga_behandle = 0;
            }           
            
            $invoice_import->adm = $tarif->adm;

            $array_total = array(
                $invoice_import->rdm,
                $invoice_import->storage,
                $invoice_import->storage_masa1,
                $invoice_import->storage_masa2,
                $invoice_import->storage_masa3,
                $invoice_import->harga_behandle,
                $invoice_import->adm,
                $invoice_import->dg_surcharge
//                $invoice_import->weight_surcharge
            );
            $sub_total = array_sum($array_total);
            
            if(in_array($tarif->consolidator_id, array(24,29)) && $manifest->INVOICE == 'BB'):
                $sub_total = $sub_total+300000;
            endif;
            
            if(isset($request->free_surcharge)):
                $invoice_import->weight_surcharge = 0;
            else:           
                if($tarif->surcharge){
                    if($maxcbm*1000 >= 2500){
                        if($tarif->surcharge_price > 100){
                            $invoice_import->weight_surcharge = $tarif->surcharge_price;
                        }else{
                            $invoice_import->weight_surcharge = ceil(($tarif->surcharge_price * $sub_total) / 100);
                        }                     
                    }
                }else{
                    if($tarif->surcharge_price > 100){
                        $invoice_import->weight_surcharge = $tarif->surcharge_price;
                    }else{
                        $invoice_import->weight_surcharge = ceil(($tarif->surcharge_price * $sub_total) / 100);
                    }  
                }
            endif;
            
//            $invoice_import->dg_surcharge = ceil(($tarif->dg_surcharge * $sub_total) / 100);
            $invoice_import->sub_total = $sub_total+$invoice_import->weight_surcharge;
//            $invoice_import->ppn = ceil(($tarif->ppn * $sub_total) / 100);
//            $invoice_import->materai = ($sub_total >= 1000000) ? 6000 : 3000;
            $invoice_import->uid = \Auth::getUser()->name;
            $invoice_import->tgl_cetak = $request->tgl_cetak;
            $invoice_import->no_invoice = $request->no_invoice;
//            return $invoice_import;
            
            if($invoice_import->save()){
                
                // Update Invoice Number
//                $array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
//                $bulan = $array_bulan[date('n')];
//                $no_invoice = $request->no_invoice;
//                $no_invoice = $request->no_invoice.'/Gud/'.$bulan.'/'.date('Y').'-PJP';
//                $no_invoice = str_pad($invoice_import->id, 4, '0', STR_PAD_LEFT).'/Gud/'.$bulan.'/'.date('Y').'-PJP';
//                \App\Models\Invoice::where('id', $invoice_import->id)->update(['no_invoice' => $no_invoice]);
                
                return back()->with('success', 'No. HBL '.$manifest->NOHBL.', invoice berhasih dibuat.');
//                return json_encode(array('success' => true, 'message' => 'No. HBL '.$manifest->NOHBL.', invoice berhasih dibuat.'));
            }else{
                return back()->with('error', 'Something went wrong, please try again later.');
//                return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
            }
//            return json_encode(array('hari' => $hari, 'weight' => $weight, 'meas' => $meas, 'cbm' => $maxcbm));
//            return json_encode(array('success' => true, 'message' => 'No. Tally '.$manifest->NOTALLY.', invoice berhasih dibuat.'));
//        }
        
//        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
        
    }
    
    public function releaseUpload(Request $request)
    {
        $manifest_id = $request->id; 
        $manifest = DBManifest::where('TMANIFEST_PK', $manifest_id)->first();
        
        // Check data xml
        $check = \App\Models\TpsCodecoKmsDetail::where('NOTALLY', $manifest->NOTALLY)->count();
        
//        if($check > 0){
//            return json_encode(array('success' => false, 'message' => 'No. Tally '.$manifest->NOTALLY.' sudah di upload.'));
//        }
        
        // Reff Number
        $reff_number = $this->getReffNumber();   
        if($reff_number){
            $codecokms = new \App\Models\TpsCodecoKms;
            $codecokms->NOJOBORDER = $manifest->NOJOBORDER;
            $codecokms->REF_NUMBER = $reff_number;
            $codecokms->TGL_ENTRY = date('Y-m-d');
            $codecokms->JAM_ENTRY = date('H:i:s');
            $codecokms->UID = \Auth::getUser()->name;
            
            if($codecokms->save()){
                $codecokmsdetail = new \App\Models\TpsCodecoKmsDetail;
                $codecokmsdetail->TPSCODECOKMSXML_FK = $codecokms->TPSCODECOKMSXML_PK;
                $codecokmsdetail->REF_NUMBER = $reff_number;
                $codecokmsdetail->NOTALLY = $manifest->NOTALLY;
                $codecokmsdetail->KD_DOK = 6;
                $codecokmsdetail->KD_TPS = 'PRJP';
                $codecokmsdetail->NM_ANGKUT = $manifest->VESSEL;
                $codecokmsdetail->NO_VOY_FLIGHT = $manifest->VOY;
                $codecokmsdetail->CALL_SIGN = $manifest->CALL_SIGN;
                $codecokmsdetail->TGL_TIBA = (!empty($manifest->ETA) ? date('Ymd', strtotime($manifest->ETA)) : '');
                $codecokmsdetail->KD_GUDANG = 'PRJP';
                $codecokmsdetail->NO_BL_AWB = $manifest->NOHBL;
                $codecokmsdetail->TGL_BL_AWB = (!empty($manifest->TGL_HBL) ? date('Ymd', strtotime($manifest->TGL_HBL)) : '');
                $codecokmsdetail->NO_MASTER_BL_AWB = $manifest->NOMBL;
                $codecokmsdetail->TGL_MASTER_BL_AWB = (!empty($manifest->TGL_MASTER_BL) ? date('Ymd', strtotime($manifest->TGL_MASTER_BL)) : '');
                $codecokmsdetail->ID_CONSIGNEE = str_replace(array('.','-'), array(''),$manifest->ID_CONSIGNEE);
                $codecokmsdetail->CONSIGNEE = $manifest->CONSIGNEE;
                $codecokmsdetail->BRUTO = $manifest->WEIGHT;
                $codecokmsdetail->NO_BC11 = $manifest->NO_BC11;
                $codecokmsdetail->TGL_BC11 = (!empty($manifest->TGL_BC11) ? date('Ymd', strtotime($manifest->TGL_BC11)) : '');
                $codecokmsdetail->NO_POS_BC11 = $manifest->NO_POS_BC11;
                $codecokmsdetail->CONT_ASAL = $manifest->NOCONTAINER;
                $codecokmsdetail->SERI_KEMAS = 1;
                $codecokmsdetail->KD_KEMAS = $manifest->KODE_KEMAS;
                $codecokmsdetail->JML_KEMAS = (!empty($manifest->QUANTITY) ? $manifest->QUANTITY : 0);
                $codecokmsdetail->KD_TIMBUN = 'GD';
                $codecokmsdetail->KD_DOK_INOUT = $manifest->KD_DOK_INOUT;
                $codecokmsdetail->NO_DOK_INOUT = (!empty($manifest->NO_SPPB) ? $manifest->NO_SPPB : '');
                $codecokmsdetail->TGL_DOK_INOUT = (!empty($manifest->TGL_SPPB) ? date('Ymd', strtotime($manifest->TGL_SPPB)) : '');
                $codecokmsdetail->WK_INOUT = date('Ymd', strtotime($manifest->tglrelease)).date('His', strtotime($manifest->jamrelease));
                $codecokmsdetail->KD_SAR_ANGKUT_INOUT = 1;
                $codecokmsdetail->NO_POL = $manifest->NOPOL_RELEASE;
                $codecokmsdetail->PEL_MUAT = $manifest->PEL_MUAT;
                $codecokmsdetail->PEL_TRANSIT = $manifest->PEL_TRANSIT;
                $codecokmsdetail->PEL_BONGKAR = $manifest->PEL_BONGKAR;
                $codecokmsdetail->GUDANG_TUJUAN = 'PRJP';
                $codecokmsdetail->UID = \Auth::getUser()->name;
                $codecokmsdetail->RESPONSE = '';
                $codecokmsdetail->STATUS_TPS = 1;
                $codecokmsdetail->NOURUT = 1;
                $codecokmsdetail->KODE_KANTOR = '040300';
                $codecokmsdetail->NO_DAFTAR_PABEAN = '';
                $codecokmsdetail->TGL_DAFTAR_PABEAN = '';
                $codecokmsdetail->NO_SEGEL_BC = '';
                $codecokmsdetail->TGL_SEGEL_BC = '';
                $codecokmsdetail->NO_IJIN_TPS = '';
                $codecokmsdetail->TGL_IJIN_TPS = '';
                $codecokmsdetail->RESPONSE_IPC = '';
                $codecokmsdetail->STATUS_TPS_IPC = '';
                $codecokmsdetail->KD_TPS_ASAL = '';
                $codecokmsdetail->TGL_ENTRY = date('Y-m-d');
                $codecokmsdetail->JAM_ENTRY = date('H:i:s');
                
                if($codecokmsdetail->save()){
                        
                    DBManifest::where('TMANIFEST_PK', $manifest->TMANIFEST_PK)->update(['REF_NUMBER_OUT' => $reff_number]);
                    
                    return json_encode(array('insert_id' => $codecokms->TPSCODECOKMSXML_PK, 'ref_number' => $reff_number, 'success' => true, 'message' => 'No. Tally '.$manifest->NOTALLY.' berhasil di simpan. Reff Number : '.$reff_number));
                }
            }
        }else {
            return json_encode(array('success' => false, 'message' => 'Cannot create Reff Number, please try again later.'));
        }
              
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));

    }
    
    public function releaseGetDataSppb(Request $request)
    {
        $manifest_id = $request->id;   
        $kd_dok = $request->kd_dok;
        $manifest = DBManifest::find($manifest_id);
   
        $sppb = '';
        
        if($kd_dok == 1){
            $sppb = \App\Models\TpsSppbPib::where(array('NO_BL_AWB' => $manifest->NOHBL))->first();
        }else{
            $sppb = \App\Models\TpsSppbBc::where(array('NO_BL_AWB' => $manifest->NOHBL))->first();
        }
        
        if($sppb){
            $arraysppb = explode('/', $sppb->NO_SPPB);
            $datasppb = array(
                'NO_SPPB' => $arraysppb[0],
                'TGL_SPPB' => date('Y-m-d', strtotime($sppb->TGL_SPPB)),
                'NPWP' => $sppb->NPWP_IMP
            );
            return json_encode(array('success' => true, 'message' => 'Get Data SPPB has been success.', 'data' => $datasppb));
        }else{
            return json_encode(array('success' => false, 'message' => 'Data SPPB Tidak ditemukan.'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function uploadTxtFile(Request $request)
    {
        if ($request->hasFile('filetxt')) {
            $extension = $request->filetxt->extension();
            if($extension == 'txt'){
                
                $jobid = $request->jobid;             
                
                $sparator_header = array(
                    'HDR0111IS', 
                );

                $sparator_detail = array(
                    'DTL02SNM01', //Shipper Name
                    'DTL02SNA01', //Shipper Address,
                    'DTL02CNM01', //Consignee Name,
                    'DTL02CNA01', //Consignee Address
                    'DTL02NNM01', //Notify Name,
                    'DTL02NNA01', //Notify Address,
                    'DTL02SMR01', //Marking.....
                    'DTL02HSC01', //
                    'DTL02DES00', //Uraian
                    'DTL02DES01', //Uraian1
                    'DTL02DES02', //Uraian2
                    'DTL02DES03', //Uraian3
                    'DTL02DES04', //Uraian4
                    'DTL02DES05', //Uraian5
                    'DTL02DES06', //Uraian6
                    'CNT010000', //No.Container,
        //            'DTL0101I', //No.POS
                );

                $resplace_detail = array(
                    '|SHIPPER^', //Shipper Name
                    '|SHIPPER_ADDRESS^', //Shipper Address,
                    '|CONSIGNEE^', //Consignee Name,
                    '|CONSIGNEE_ADDRESS^', //Consignee Address
                    '|NOTIFYPARTY^', //Notify Name,
                    '|NOTIFYPARTY_ADDRESS^', //Notify Address,
                    '|MARKING^', //Marking.....
                    '|DTL02HSC01^', //
                    '|DESCOFGOODS^', //Uraian
                    '|DESCOFGOODS^', //Uraian1
                    '|DESCOFGOODS^', //Uraian2
                    '|DESCOFGOODS^', //Uraian3
                    '|DESCOFGOODS^', //Uraian4
                    '|DESCOFGOODS^', //Uraian5
                    '|DESCOFGOODS^', //Uraian6
                    '|NOCONTAINER^', // No.Container,
        //            '|NO_POS^', //No.POS
                );
                
                array(
                    1 => '10',
                    'weight(KGM)' => '4-21',
                    'meas(m3)' => '5-17 / 5-16',
                    'qty' => '1-1 / 2-2',
                    5 => '26',
                    'packing' => '2-2'
                );
                
                $flat = \File::get($request->filetxt);
                $datas = explode('DTL0101I', $flat);
                
                $results = array();
                $dataFinals = array();

                $i = 0;

                foreach ($datas as $data):
                    if($i == 0){
                        $data = str_replace($sparator_header, '|^', $data); 
                    }else{
                        $data = str_replace($sparator_detail, $resplace_detail, $data); 
                        $dataExplode = explode('|',$data);   

                        $results[] = $dataExplode;
                    }
                    $i++;
                endforeach;

                foreach($results as $value):  
                    $desc = '';
                    $container = '';
                    foreach ($value as $v):
                        $val = explode('^', $v); 
                        if(is_array($val) && count($val) > 1):
                            if($val[0] == 'DESCOFGOODS'){
                                $desc .= $val[1];
                                $dataval[$val[0]] = trim($desc);
                            }else{
                                $dataval[$val[0]] = trim($val[1]);
                            }

                        else:
                            $dataval['HEADER'] = trim($val[0]);
                            $ex_header = explode(" ", $this->removeSpace($val[0]));
//                            $dataval['EX_HEADER'] = $ex_header;
//                            return count($ex_header);
                            if(count($ex_header) == 7):
                                $ex_header_nohbl = isset($ex_header[2]) ? $ex_header[2] : null;
                                $ex_header_tglhbl = isset($ex_header[4]) ? $ex_header[4] : null;
                                $ex_header_berat = isset($ex_header[5]) ? $ex_header[5] : null;
                            elseif(count($ex_header) == 8):
                                $ex_header_nohbl = isset($ex_header[3]) ? $ex_header[3] : null;
                                $ex_header_tglhbl = isset($ex_header[5]) ? $ex_header[5] : null;
                                $ex_header_berat = isset($ex_header[6]) ? $ex_header[6] : null;
                            elseif(count($ex_header) == 9):
                                $ex_header_nohbl = isset($ex_header[4]) ? $ex_header[4] : null;
                                $ex_header_tglhbl = isset($ex_header[6]) ? $ex_header[6] : null;
                                $ex_header_berat = isset($ex_header[7]) ? $ex_header[7] : null;
                            elseif(count($ex_header) == 10):
                                $ex_header_nohbl = isset($ex_header[5]) ? $ex_header[5] : null;
                                $ex_header_tglhbl = isset($ex_header[7]) ? $ex_header[7] : null;
                                $ex_header_berat = isset($ex_header[8]) ? $ex_header[8] : null;
                            elseif(count($ex_header) == 11):
                                $ex_header_nohbl = isset($ex_header[6]) ? $ex_header[6] : null;
                                $ex_header_tglhbl = isset($ex_header[8]) ? $ex_header[8] : null;
                                $ex_header_berat = isset($ex_header[9]) ? $ex_header[9] : null;
                            elseif(count($ex_header) == 12):
                                $ex_header_nohbl = isset($ex_header[7]) ? $ex_header[7] : null;
                                $ex_header_tglhbl = isset($ex_header[9]) ? $ex_header[9] : null;
                                $ex_header_berat = isset($ex_header[10]) ? $ex_header[10] : null;
                            elseif(count($ex_header) == 13):
                                $ex_header_nohbl = isset($ex_header[8]) ? $ex_header[8] : null;
                                $ex_header_tglhbl = isset($ex_header[10]) ? $ex_header[10] : null;
                                $ex_header_berat = isset($ex_header[11]) ? $ex_header[11] : null;
                            else:
//                                return count($ex_header);
//                                return $ex_header[4];
                                return back()->with('error', 'Cannot upload TXT file, new flat file detected.')->withInput();
                            endif;
                            
                            $dataval['NOHBL'] = $ex_header_nohbl;
                            $dataval['TGL_HBL'] = $ex_header_tglhbl;   
                            $dataval['weight'] = substr($ex_header_berat, 10, 8)/10000;
                            $dataval['meas'] = (substr($ex_header_berat, 30, 5)/1000);
                            $dataval['qty'] = substr($ex_header_berat, 46, 3);
                            $dataval['pack'] = substr($ex_header_berat, 75, 2);
                        endif;

                    endforeach;

                    $dataFinals[] = $dataval;              
                endforeach;
                
//                return json_encode($dataFinals);
                
                // INSERT FILE TO DATABASE
                foreach ($dataFinals as $df):
                    // Insert Container
                    $ex_cont = explode(" ", $this->removeSpace($df['NOCONTAINER']));
                    $no_cont = $ex_cont[0];
                    $size_cont = str_replace("L", "", $ex_cont[1]);
                    $noseal = $ex_cont[2];

                    // Get Container
                    $container = DBContainer::insertOrGet($no_cont, $size_cont, $noseal, $jobid);

                    if($container){
                        
                        // Check Manifest
                        $checkAvail = DBManifest::where(array('NOHBL'=>$df['NOHBL'],'TGL_HBL'=>$df['TGL_HBL']))->count();
                        
                        if($checkAvail > 0){
                            continue;
                        }else{

                            $data = array();
                            $manifestID = DBManifest::select('NOTALLY')->where('TJOBORDER_FK',$container->TJOBORDER_FK)->count();

                            $regID = str_pad(intval(($manifestID > 0 ? $manifestID : 0)+1), 3, '0', STR_PAD_LEFT);

                            // Copy Container
                            $data['NOTALLY'] = $container->NoJob.'.'.$regID; 
                            $data['TJOBORDER_FK'] = $container->TJOBORDER_FK;
                            $data['NOJOBORDER'] = $container->NoJob;
                            $data['TCONTAINER_FK'] = $container->TCONTAINER_PK;
                            $data['NOCONTAINER'] = $container->NOCONTAINER;
                            $data['TCONSOLIDATOR_FK'] = $container->TCONSOLIDATOR_FK;
                            $data['NAMACONSOLIDATOR'] = $container->NAMACONSOLIDATOR;
                            $data['TLOKASISANDAR_FK'] = $container->TLOKASISANDAR_FK;
                            $data['KD_TPS_ASAL'] = $container->KD_TPS_ASAL;
                            $data['KD_TPS_TUJUAN'] = $container->KD_TPS_TUJUAN;
                            $data['SIZE'] = $container->SIZE;
                            $data['ETA'] = $container->ETA;
                            $data['ETD'] = $container->ETD;
                            $data['VESSEL'] = $container->VESSEL;
                            $data['VOY'] = $container->VOY;
                            $data['CALL_SIGN'] = $container->CALL_SIGN;
                            $data['TPELABUHAN_FK'] = $container->TPELABUHAN_FK;     
                            $data['NAMAPELABUHAN'] = $container->NAMAPELABUHAN;
                            $data['PEL_MUAT'] = $container->PEL_MUAT;
                            $data['PEL_BONGKAR'] = $container->PEL_BONGKAR;
                            $data['PEL_TRANSIT'] = $container->PEL_TRANSIT;
                            $data['NOMBL'] = $container->NOMBL;  
                            $data['TGL_MASTER_BL'] = $container->TGL_MASTER_BL;
                            $data['LOKASI_GUDANG'] = $container->LOKASI_GUDANG;
                            $data['NO_BC11'] = $container->NO_BC11;
                            $data['TGL_BC11'] = $container->TGL_BC11;
                            $data['NO_PLP'] = $container->NO_PLP;
                            $data['TGL_PLP'] = $container->TGL_PLP;
                            $data['VALIDASI'] = 'N';

                            // Get Perusahaan
                            $notifyparty = DBPerusahaan::insertOrGet($df['NOTIFYPARTY'], $df['NOTIFYPARTY_ADDRESS']);
                            $shipper = DBPerusahaan::insertOrGet($df['SHIPPER'], $df['SHIPPER_ADDRESS']);
                            $consignee = DBPerusahaan::insertOrGet($df['CONSIGNEE'], $df['CONSIGNEE_ADDRESS']);

                            $data['TNOTIFYPARTY_FK'] = $notifyparty['TPERUSAHAAN_PK'];
                            $data['NOTIFYPARTY'] = $notifyparty['NAMAPERUSAHAAN'];
                            $data['TSHIPPER_FK'] = $shipper['TPERUSAHAAN_PK'];
                            $data['SHIPPER'] = $shipper['NAMAPERUSAHAAN'];
                            $data['TCONSIGNEE_FK'] = $consignee['TPERUSAHAAN_PK'];
                            $data['CONSIGNEE'] = $consignee['NAMAPERUSAHAAN'];
                            $data['ID_CONSIGNEE'] = $consignee['NPWP'];

                            if(isset($df['MARKING'])){
                                $data['MARKING'] = $df['MARKING'];
                            }
                            if(isset($df['DESCOFGOODS'])){
                                $data['DESCOFGOODS'] = $df['DESCOFGOODS'];
                            }
                            $data['NOHBL'] = $df['NOHBL'];
                            $data['TGL_HBL'] = $df['TGL_HBL'];
                            $data['WEIGHT'] = $df['weight'];
                            $data['MEAS'] = $df['meas'];
                            $data['QUANTITY'] = $df['qty'];
                            $data['final_qty'] = $df['qty'];

                            // Get Packing
                            if($df['pack']) {
                                $packing = \App\Models\Packing::where('KODEPACKING', $df['pack'])->first();
                                if($packing){
                                    $data['TPACKING_FK'] = $packing->TPACKING_PK;
                                    $data['NAMAPACKING'] = $packing->NAMAPACKING;
                                    $data['KODE_KEMAS'] = $packing->KODEPACKING;
                                    $data['packing_tally'] = $packing->NAMAPACKING;
                                }
                            }

                            $data['tglmasuk'] = $container->TGL_PLP;
                            $data['jammasuk'] = $container->JAMMASUK;

                            $data['tglentry'] = date('Y-m-d');
                            $data['jamentry'] = date('H:i:s');
                            $data['UID'] = \Auth::getUser()->name;

                            $insert_id = DBManifest::insertGetId($data);

                            if($insert_id){
                                // Update Jumlah BL
                                $countbl = DBManifest::where('TCONTAINER_FK', $data['TCONTAINER_FK'])->count();

                                // Update Meas Wight           
                                $sum_weight_manifest = DBManifest::select('WEIGHT')->where('TCONTAINER_FK', $data['TCONTAINER_FK'])->sum('WEIGHT');
                                $sum_meas_marnifest = DBManifest::select('MEAS')->where('TCONTAINER_FK', $data['TCONTAINER_FK'])->sum('MEAS');         
                                $container->MEAS = $sum_meas_marnifest;
                                $container->WEIGHT = $sum_weight_manifest;
                                $container->jumlah_bl = $countbl;
                                $container->UID = \Auth::getUser()->name;

                                if($container->save()){

                                    $sum_weight = DBContainer::select('WEIGHT')->where('TJOBORDER_FK', $container->TJOBORDER_FK)->sum('WEIGHT');
                                    $sum_meas = DBContainer::select('MEAS')->where('TJOBORDER_FK', $container->TJOBORDER_FK)->sum('MEAS');         
                                    \App\Models\Joborder::where('TJOBORDER_PK', $container->TJOBORDER_FK)
                                            ->update(['MEASUREMENT' => $sum_meas, 'GROSSWEIGHT' => $sum_weight]);

                                }

                            }
                        }
                    }
                endforeach;
                       
                return back()->with('success', 'LCL Register has been update.')->withInput();
//                return json_encode($dataFinals);
             
            }
            return back()->with('error', 'Please upload TXT file format.')->withInput();
            
        }
        
        return back()->with('error', 'Cannot upload TXT file, please try again.')->withInput();   
    }
    
    public function uploadXlsFile(Request $request)
    { 
        // CLEAR DATABASE
        \DB::table('temporary_manifest')->truncate();
        \DB::table('temporary_container')->truncate();
        \DB::table('temporary_barang')->truncate();

        if ($request->hasFile('filexls')) {
            
            $jobid = $request->jobid;
            
            \Excel::selectSheets(['Detil', 'Barang', 'Kontainer'])->load($request->file('filexls'), function($reader) {
                $reader->each(function($sheet) {
                    if($sheet->getTitle() == 'Detil'){
                        $sheet->each(function($row) {                            
                            \DB::table('temporary_manifest')->insert($row->all());
                        });
                    }elseif($sheet->getTitle() == 'Barang'){
                        $sheet->each(function($row) {                            
                            \DB::table('temporary_barang')->insert($row->all());
                        });
                    }elseif($sheet->getTitle() == 'Kontainer'){
                        $sheet->each(function($row) {      
                            \DB::table('temporary_container')->insert($row->all());
                        });
                    }

                    
                });
            });
            
            // INSERT TO DATABASE
            $details = \DB::table('temporary_manifest')->get();
            
            foreach ($details as $detail):

                $cont = \DB::table('temporary_container')->where('id_detil', $detail->id_detil)->first();
                $barang = \DB::table('temporary_barang')->where('id_detil', $detail->id_detil)->get();
                $descofgods = '';
                
                if(count($barang) > 0){
                    foreach ($barang as $b):
                        $descofgods .= $b->uraian_barang;
                    endforeach;
                }
                
                // Get Container
                $container = DBContainer::insertOrGet($cont->nomor_kontainer, $cont->ukuran_kontainer, $cont->nomor_segel, $jobid);
                
                if($container){
                    // Check Manifest
                    $checkAvail = DBManifest::where(array('NOHBL'=>$detail->no_host_blawb,'TGL_HBL'=> date('Y-m-d', strtotime($detail->tgl_host_blawb))))->count();

                    if($checkAvail > 0){
                        continue;
                    }else{
                        $data = array();
                        $manifestID = DBManifest::select('NOTALLY')->where('TJOBORDER_FK',$container->TJOBORDER_FK)->count();

                        $regID = str_pad(intval(($manifestID > 0 ? $manifestID : 0)+1), 3, '0', STR_PAD_LEFT);

                        // Copy Container
                        $data['NOTALLY'] = $container->NoJob.'.'.$regID; 
                        $data['TJOBORDER_FK'] = $container->TJOBORDER_FK;
                        $data['NOJOBORDER'] = $container->NoJob;
                        $data['TCONTAINER_FK'] = $container->TCONTAINER_PK;
                        $data['NOCONTAINER'] = $container->NOCONTAINER;
                        $data['TCONSOLIDATOR_FK'] = $container->TCONSOLIDATOR_FK;
                        $data['NAMACONSOLIDATOR'] = $container->NAMACONSOLIDATOR;
                        $data['TLOKASISANDAR_FK'] = $container->TLOKASISANDAR_FK;
                        $data['KD_TPS_ASAL'] = $container->KD_TPS_ASAL;
                        $data['KD_TPS_TUJUAN'] = $container->KD_TPS_TUJUAN;
                        $data['SIZE'] = $container->SIZE;
                        $data['ETA'] = $container->ETA;
                        $data['ETD'] = $container->ETD;
                        $data['VESSEL'] = $container->VESSEL;
                        $data['VOY'] = $container->VOY;
                        $data['CALL_SIGN'] = $container->CALL_SIGN;
                        $data['TPELABUHAN_FK'] = $container->TPELABUHAN_FK;     
                        $data['NAMAPELABUHAN'] = $container->NAMAPELABUHAN;
                        $data['PEL_MUAT'] = $container->PEL_MUAT;
                        $data['PEL_BONGKAR'] = $container->PEL_BONGKAR;
                        $data['PEL_TRANSIT'] = $container->PEL_TRANSIT;
                        $data['NOMBL'] = $container->NOMBL;  
                        $data['TGL_MASTER_BL'] = $container->TGL_MASTER_BL;
                        $data['LOKASI_GUDANG'] = $container->LOKASI_GUDANG;
                        $data['NO_BC11'] = $container->NO_BC11;
                        $data['TGL_BC11'] = $container->TGL_BC11;
                        $data['NO_PLP'] = $container->NO_PLP;
                        $data['TGL_PLP'] = $container->TGL_PLP;
                        $data['VALIDASI'] = 'N';

                        // Get Perusahaan
                        $notifyparty = DBPerusahaan::insertOrGet($detail->nama_notify, $detail->almt_notify);
                        $shipper = DBPerusahaan::insertOrGet($detail->nama_shipper, $detail->almt_shipper);
                        $consignee = DBPerusahaan::insertOrGet($detail->nama_consignee, $detail->almt_consignee);

                        $data['TNOTIFYPARTY_FK'] = $notifyparty['TPERUSAHAAN_PK'];
                        $data['NOTIFYPARTY'] = $notifyparty['NAMAPERUSAHAAN'];
                        $data['TSHIPPER_FK'] = $shipper['TPERUSAHAAN_PK'];
                        $data['SHIPPER'] = $shipper['NAMAPERUSAHAAN'];
                        $data['TCONSIGNEE_FK'] = $consignee['TPERUSAHAAN_PK'];
                        $data['CONSIGNEE'] = $consignee['NAMAPERUSAHAAN'];
                        $data['ID_CONSIGNEE'] = $consignee['NPWP'];

                        if(isset($detail->merk_kemasan)){
                            $data['MARKING'] = $detail->merk_kemasan;
                        }
                        if($descofgods){
                            $data['DESCOFGOODS'] = $descofgods;
                        }
                        $data['NOHBL'] = $detail->no_host_blawb;
                        $data['TGL_HBL'] = date('Y-m-d', strtotime($detail->tgl_host_blawb));
                        $data['WEIGHT'] = $detail->bruto;
                        $data['MEAS'] = $detail->volume;
                        $data['QUANTITY'] = $detail->jumlah_kemasan;
                        $data['final_qty'] = $detail->jumlah_kemasan;

                        // Get Packing
                        if($detail->jenis_kemasan) {
                            $packing = \App\Models\Packing::where('KODEPACKING', $detail->jenis_kemasan)->first();
                            if($packing){
                                $data['TPACKING_FK'] = $packing->TPACKING_PK;
                                $data['NAMAPACKING'] = $packing->NAMAPACKING;
                                $data['KODE_KEMAS'] = $packing->KODEPACKING;
                                $data['packing_tally'] = $packing->NAMAPACKING;
                            }
                        }

                        $data['tglmasuk'] = $container->TGL_PLP;
                        $data['jammasuk'] = $container->JAMMASUK;

                        $data['tglentry'] = date('Y-m-d');
                        $data['jamentry'] = date('H:i:s');
                        $data['UID'] = \Auth::getUser()->name;

                        $insert_id = DBManifest::insertGetId($data);

                        if($insert_id){
                            // Update Jumlah BL
                            $countbl = DBManifest::where('TCONTAINER_FK', $data['TCONTAINER_FK'])->count();

                            // Update Meas Wight           
                            $sum_weight_manifest = DBManifest::select('WEIGHT')->where('TCONTAINER_FK', $data['TCONTAINER_FK'])->sum('WEIGHT');
                            $sum_meas_marnifest = DBManifest::select('MEAS')->where('TCONTAINER_FK', $data['TCONTAINER_FK'])->sum('MEAS');         
                            $container->MEAS = $sum_meas_marnifest;
                            $container->WEIGHT = $sum_weight_manifest;
                            $container->jumlah_bl = $countbl;
                            $container->UID = \Auth::getUser()->name;

                            if($container->save()){

                                $sum_weight = DBContainer::select('WEIGHT')->where('TJOBORDER_FK', $container->TJOBORDER_FK)->sum('WEIGHT');
                                $sum_meas = DBContainer::select('MEAS')->where('TJOBORDER_FK', $container->TJOBORDER_FK)->sum('MEAS');         
                                \App\Models\Joborder::where('TJOBORDER_PK', $container->TJOBORDER_FK)
                                        ->update(['MEASUREMENT' => $sum_meas, 'GROSSWEIGHT' => $sum_weight]);

                            }
                        }
                    }
                }
                
            endforeach;
            
            return back()->with('success', 'LCL Register has been update.')->withInput();
        }
        
        return back()->with('error', 'Please upload EXCEL file format.')->withInput();
    }
    
    public function gateinUploadPhoto(Request $request)
    {
        $picture = array();
        if ($request->hasFile('photos')) {
            $files = $request->file('photos');
            $destinationPath = base_path() . '/public/uploads/photos/container/lcl/'.$request->no_cont;
            $i = 1;
            foreach($files as $file){
//                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                $filename = date('dmyHis').'_'.str_slug($request->no_cont).'_'.$i.'.'.$extension;
                $picture[] = $filename;
                $file->move($destinationPath, $filename);
                $i++;
            }
            // update to Database
            $container = DBContainer::find($request->id_cont);
            $oldJson = json_decode($container->photo_gatein_extra);
            $newJson = array_collapse([$oldJson,$picture]);
            $container->photo_gatein_extra = json_encode($newJson);
            if($container->save()){
                return back()->with('success', 'Photo for Container '. $request->no_cont .' has been uploaded.');
            }else{
                return back()->with('error', 'Photo uploaded, but not save in Database.');
            }
            
        } else {
            return back()->with('error', 'Something wrong!!! Can\'t upload photo, please try again.');
        }
    }
    
    public function strippingUploadPhoto(Request $request)
    {
        $picture = array();
        if ($request->hasFile('photos')) {
            $files = $request->file('photos');
            $destinationPath = base_path() . '/public/uploads/photos/container/lcl/'.$request->no_cont;
            $i = 1;
            foreach($files as $file){
//                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                $filename = date('dmyHis').'_'.str_slug($request->no_cont).'_'.$i.'.'.$extension;
                $picture[] = $filename;
                $file->move($destinationPath, $filename);
                $i++;
            }
            // update to Database
            $container = DBContainer::find($request->id_cont);
            $oldJson = json_decode($container->photo_stripping);
            $newJson = array_collapse([$oldJson,$picture]);
            $container->photo_stripping = json_encode($newJson);
            if($container->save()){
                return back()->with('success', 'Photo for Container '. $request->no_cont .' has been uploaded.');
            }else{
                return back()->with('error', 'Photo uploaded, but not save in Database.');
            }
            
        } else {
            return back()->with('error', 'Something wrong!!! Can\'t upload photo, please try again.');
        }
    }
    
    public function changeStatusBc($id)
    {
        $manifest = DBManifest::find($id);
        $manifest->status_bc = 'RELEASE';
        $manifest->release_bc = 'Y';
        $manifest->release_bc_date = date('Y-m-d H:i:s');
//        $manifest->release_bc_uid = \Auth::getUser()->name;
        
        if($manifest->save()){
            $this->changeBarcodeStatus($manifest->TMANIFEST_PK, $manifest->NOHBL, 'Manifest', 'active');
            return json_encode(array('success' => true, 'message' => 'Status has been Change!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function changeStatusFlag($id)
    {
        $manifest = DBManifest::find($id);
        $manifest->flag_bc = 'N';
        
        if($manifest->save()){

            return json_encode(array('success' => true, 'message' => 'Status has been Change!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function lockFlag(Request $request)
    {
        $manifest_id = $request->id;
        $alasan = $request->alasan_segel;
//        $lainnya = $request->alasan_lainnya;
        
//        return $request->all();
        
        $picture = array();
        if ($request->hasFile('photos_flag')) {
            $files = $request->file('photos_flag');
            $destinationPath = base_path() . '/public/uploads/photos/flag/lcl';
            $i = 1;
            foreach($files as $file){
//                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                $filename = date('dmyHis').'_'.str_slug($request->no_flag_bc).'_'.$i.'.'.$extension;
                $picture[] = $filename;
                $file->move($destinationPath, $filename);
                $i++;
            } 
        }
        
        $manifest = DBManifest::find($manifest_id);
        $manifest->flag_bc = 'Y';
        $manifest->status_bc = 'SEGEL';
        $manifest->no_flag_bc = $request->no_flag_bc;
        $manifest->description_flag_bc = $request->description_flag_bc;
//        if($alasan == 'Lainnya' && !empty($lainnya)){
//            $manifest->alasan_segel = $lainnya;
//        }else{
            $manifest->alasan_segel = $alasan;
//        }
        $manifest->photo_lock = json_encode($picture);
            
        if($alasan == 'IKP / Temuan Lapangan'){
            $manifest->BEHANDLE = 'Y';
            $manifest->status_behandle = 'Belum Siap';
        }
        
        if($manifest->save()){
            // Save to log
            $datalog = array(
                'ref_id' => $manifest_id,
                'ref_type' => 'lcl',
                'no_segel'=> $manifest->no_flag_bc,
                'alasan' => $manifest->alasan_segel,
                'keterangan' => $manifest->description_flag_bc,
                'photo' => $manifest->photo_lock,
                'action' => 'lock',
                'uid' => \Auth::getUser()->name
            );
            $this->addLogSegel($datalog);
            
            $this->changeBarcodeStatus($manifest->TMANIFEST_PK, $manifest->NOHBL, 'Manifest', 'hold');
            
            return back()->with('success', 'Flag has been locked.')->withInput();
        }
        
        return back()->with('error', 'Something wrong, please try again.')->withInput();
    }
    
    public function unlockFlag(Request $request)
    {
        $manifest_id = $request->id;
        $alasan = $request->alasan_lepas_segel;
        
        $picture = array();
        if ($request->hasFile('photos_unflag')) {
            $files = $request->file('photos_unflag');
            $destinationPath = base_path() . '/public/uploads/photos/unflag/lcl';
            $i = 1;
            foreach($files as $file){
//                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                $filename = date('dmyHis').'_'.str_slug($request->no_unflag_bc).'_'.$i.'.'.$extension;
                $picture[] = $filename;
                $file->move($destinationPath, $filename);
                $i++;
            } 
        }
        
        $manifest = DBManifest::find($manifest_id);
        $manifest->flag_bc = 'N';
        
        if($manifest->release_bc == 'Y'){
            $manifest->status_bc = 'RELEASE';
            $this->changeBarcodeStatus($manifest->TMANIFEST_PK, $manifest->NOHBL, 'Manifest', 'active');
        }else{
            if($manifest->KD_DOK_INOUT > 1){
                $manifest->status_bc = 'HOLD';
                $manifest->tglrelease = NULL;
                $manifest->jamrelease = NULL;
                $this->changeBarcodeStatus($manifest->TMANIFEST_PK, $manifest->NOHBL, 'Manifest', 'hold');
            }else{
                $manifest->status_bc = 'RELEASE';
                $this->changeBarcodeStatus($manifest->TMANIFEST_PK, $manifest->NOHBL, 'Manifest', 'active');
            }
        }

        $manifest->no_unflag_bc = $request->no_unflag_bc;
        $manifest->description_unflag_bc = $request->description_unflag_bc;
        $manifest->alasan_lepas_segel = $alasan;
        $manifest->photo_unlock = json_encode($picture);
        
        if($manifest->save()){
            // Save to log
            $datalog = array(
                'ref_id' => $manifest_id,
                'ref_type' => 'lcl',
                'no_segel'=> $manifest->no_unflag_bc,
                'alasan' => $manifest->alasan_lepas_segel,
                'keterangan' => $manifest->description_unflag_bc,
                'photo' => $manifest->photo_unlock,
                'action' => 'unlock',
                'uid' => \Auth::getUser()->name
            );
            $this->addLogSegel($datalog);
            
            return back()->with('success', 'Flag has been unlocked.')->withInput();
        }
        
        return back()->with('error', 'Something wrong, please try again.')->withInput();
    }
    
    public function viewFlagInfo($manifest_id)
    {
        $manifest = DBManifest::find($manifest_id);
        $data = \DB::table('log_segel')->where(array('ref_id' => $manifest_id,'ref_type' => 'lcl'))->get();
        return json_encode(array('success' => true, 'data' => $data, 'NOHBL' => $manifest->NOHBL, 'manifest' => $manifest));
    }
    
    public function changeStatusBehandle(Request $request)
    {
        $manifest_id = $request->id;
        $desc = $request->desc;
        $status = $request->status_behandle;
        
        $manifest = DBManifest::find($manifest_id);
        $manifest->status_behandle = $status;
        if($status == 'Sedang Periksa'){
            $manifest->date_check_behandle = date('Y-m-d H:i:s');
            $manifest->desc_check_behandle = $desc;
        }else{
            $manifest->date_finish_behandle = date('Y-m-d H:i:s');
            $manifest->desc_finish_behandle = $desc;
            $manifest->tglbehandle = date('Y-m-d');
            $manifest->jambehandle = date('H:i:s');
        }

        if($manifest->save()){
            return back()->with('success', 'Status Behandle has been change.')->withInput();
        }
        
        return back()->with('error', 'Something wrong, please try again.')->withInput();

    }
    
    public function holdIndex()
    {
        $data['page_title'] = "LCL Dokumen HOLD";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Dokumen HOLD'
            ]
        ];        
        
        return view('import.lcl.bc-hold')->with($data);
    }
    
    public function segelIndex()
    {
        $data['page_title'] = "LCL Segel Merah";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Segel Merah'
            ]
        ];        
        
        $data['segel'] = \DB::table('alasan_segel')->get();
        
        return view('import.lcl.bc-segel')->with($data);
    }
    
    public function segelReport()
    {
        $data['page_title'] = "LCL Report Segel Merah";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Report Segel Merah'
            ]
        ];        
        
        return view('import.lcl.bc-segel-report')->with($data);
    }
    
    public function reportContainerIndex(Request $request)
    {
        $data['page_title'] = "LCL Report Container";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Report Container'
            ]
        ];      
        
        if($request->month && $request->year) {
            $month = $request->month;
            $year = $request->year;
        } else {
            $month = date('m');
            $year = date('Y');
        }
        
//        BY PLP
        $twenty = DBContainer::where('SIZE', 20)->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $fourty = DBContainer::where('SIZE', 40)->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $teus = ($twenty*1)+($fourty*2);
        $data['countbysize'] = array('twenty' => $twenty, 'fourty' => $fourty, 'total' => $twenty+$fourty, 'teus' => $teus);
        
        $jict = DBContainer::where('KD_TPS_ASAL', 'JICT')->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $koja = DBContainer::where('KD_TPS_ASAL', 'KOJA')->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $mal = DBContainer::where('KD_TPS_ASAL', 'MAL0')->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $nct1 = DBContainer::where('KD_TPS_ASAL', 'NCT1')->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $pldc = DBContainer::where('KD_TPS_ASAL', 'PLDC')->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        
        $fc = DBContainer::whereIn('TCONSOLIDATOR_FK', array(1,4))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $me = DBContainer::whereIn('TCONSOLIDATOR_FK', array(13,16))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $ap = DBContainer::whereIn('TCONSOLIDATOR_FK', array(10,12))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        $da = DBContainer::whereIn('TCONSOLIDATOR_FK', array(24))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
        
//        BY GATEIN
        $twentyg = DBContainer::where('SIZE', 20)->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $fourtyg = DBContainer::where('SIZE', 40)->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $teusg = ($twentyg*1)+($fourtyg*2);
        $data['countbysizegatein'] = array('twenty' => $twentyg, 'fourty' => $fourtyg, 'total' => $twentyg+$fourtyg, 'teus' => $teusg);
        
        $jictg = DBContainer::where('KD_TPS_ASAL', 'JICT')->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $kojag = DBContainer::where('KD_TPS_ASAL', 'KOJA')->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $malg = DBContainer::where('KD_TPS_ASAL', 'MAL0')->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $nct1g = DBContainer::where('KD_TPS_ASAL', 'NCT1')->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $pldcg = DBContainer::where('KD_TPS_ASAL', 'PLDC')->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        
        $fcg = DBContainer::whereIn('TCONSOLIDATOR_FK', array(1,4))->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $meg = DBContainer::whereIn('TCONSOLIDATOR_FK', array(13,16))->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $apg = DBContainer::whereIn('TCONSOLIDATOR_FK', array(10,12))->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $dae = DBContainer::whereIn('TCONSOLIDATOR_FK', array(24))->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        
        $data['countbytps'] = array('JICT' => array($jict, $jictg), 'KOJA' => array($koja, $kojag), 'MAL0' => array($mal, $malg), 'NCT1' => array($nct1, $nct1g), 'PLDC' => array($pldc, $pldcg));
        $data['countbyconsolidator'] = array('FBI/CPL' => array($fc, $fcg), 'MKT/ECU' => array($me, $meg), 'ARJAKA/PELOPOR' => array($ap, $apg), 'DAEHAN' => array($da, $dae));
        
        $data['totcounttpsp'] = array_sum(array($jict,$koja,$mal,$nct1,$pldc));
        $data['totcounttpsg'] = array_sum(array($jictg,$kojag,$malg,$nct1g,$pldcg));
        
        $data['totcountconsolidatorp'] = array_sum(array($fc,$me,$ap,$da));
        $data['totcountconsolidatorg'] = array_sum(array($fcg,$meg,$apg,$dae));
        
        $data['month'] = $month;
        $data['year'] = $year;
        
        return view('import.lcl.bc-report-container')->with($data);
    }
    
    public function reportStockIndex(Request $request)
    {
        $data['page_title'] = "LCL Report Stock";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Report Stock'
            ]
        ];        
        
        if($request->month && $request->year) {
            $month = $request->month;
            $year = $request->year;
        } else {
            $month = date('m');
            $year = date('Y');
        }
        
        $bc20 = DBManifest::where('KD_DOK_INOUT', 1)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $bc23 = DBManifest::where('KD_DOK_INOUT', 2)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $bc12 = DBManifest::where('KD_DOK_INOUT', 4)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $bc15 = DBManifest::where('KD_DOK_INOUT', 9)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $bc11 = DBManifest::where('KD_DOK_INOUT', 20)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $bcf26 = DBManifest::where('KD_DOK_INOUT', 5)->whereRaw('MONTH(tglmasuk) = '.$month)->whereRaw('YEAR(tglmasuk) = '.$year)->count();
        $data['countbydoc'] = array('BC 2.0' => $bc20, 'BC 2.3' => $bc23, 'BC 1.2' => $bc12, 'BC 1.5' => $bc15, 'BC 1.1' => $bc11, 'BCF 2.6' => $bcf26);
        
        $data['month'] = $month;
        $data['year'] = $year;
        
        $meas_count = DBManifest::whereNotNull('tglmasuk')
                                ->whereNotNull('tglstripping')
                                ->whereNull('tglrelease')                                
                                ->sum('MEAS');
        $data['meas'] = $meas_count;
        $this->updateSorByMeas();
        $data['sor'] = \App\Models\SorYor::where('type', 'sor')->first();
        
        return view('import.lcl.bc-report-stock')->with($data);
    }
    
    public function reportInventoryIndex()
    {
        $data['page_title'] = "LCL Inventory";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Inventory'
            ]
        ];        
        
        return view('import.lcl.bc-inventory')->with($data);
    }
    
    public function strippingViewPhotoBl($cont_id)
    {
        $data['page_title'] = "View Photo B/L by Container";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'View Photo B/L by Container'
            ]
        ];  
        
        $manifests = DBManifest::select('NOCONTAINER','NOHBL','photo_stripping')->where('TCONTAINER_FK', $cont_id)->get();
        $data['manifests'] = $manifests;
        
        return view('import.lcl.view-photo-bl')->with($data);
    }
    
    public function releaseHold(Request $request)
    {
        $manifest = DBManifest::find($request->id_hold);
        
        $manifest->status_bc = 'INSPECT';
//        $container->TGLRELEASE = NULL;
//        $container->JAMRELEASE = NULL;
        $manifest->inspect_desc = $request->inspect_desc;
        
        if($manifest->save()){
            $this->changeBarcodeStatus($manifest->TMANIFEST_PK, $manifest->NOHBL, 'Manifest', 'hold');
            return back()->with('success', 'HBL No. '.$manifest->NOHBL.' Status is Inspection.');
        }
        return back()->with('error', 'Something wrong!!! please try again.');
    }
    
    public function releaseUnhold(Request $request)
    {
        $manifest = DBManifest::find($request->id);
        
        $manifest->status_bc = 'RELEASE';
        
        if($manifest->save()){
            return json_encode(array('success' => true, 'message' => 'HBL No. '.$manifest->NOHBL.' Status is Release.'));
        }else{
            return json_encode(array('success' => false, 'message' => 'Something wrong!!! please try again.'));
        } 
    }
    
    public function percepatanBehandle(Request $request)
    {
        $manifest_id = $request->id;
        $wkt_percepatan = $request->tgl_percepatan_behandle.' '.$request->jam_percepatan_behandle;
        
        $manifest = DBManifest::find($manifest_id);
        
        $picture = array();
        if ($request->hasFile('dokumen_percepatan_behandle')) {
            $files = $request->file('dokumen_percepatan_behandle');
            $destinationPath = base_path() . '/public/uploads/behandle/lcl';
            $i = 1;
            foreach($files as $file){
//                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                $filename = date('dmyHis').'_'.str_slug($manifest->NOHBL).'_'.$i.'.'.$extension;
                $picture[] = $filename;
                $file->move($destinationPath, $filename);
                $i++;
            } 
        }

        $manifest->percepatan = 'Y';
        $manifest->BEHANDLE = 'Y';
        $manifest->status_behandle = 'Siap Periksa';
        $manifest->date_ready_behandle = date('Y-m-d H:i:s'); 
        $manifest->waktu_percepatan = $wkt_percepatan;
        $manifest->dokumen_percepatan = json_encode($picture);
        
        if($manifest->save()){                       
            return back()->with('success', 'Percepatan behandle berhasil.')->withInput();
        }
        
        return back()->with('error', 'Something wrong, please try again.')->withInput();
    }
}
