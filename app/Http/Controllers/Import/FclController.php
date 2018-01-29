<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Jobordercy as DBJoborder;
use App\Models\Consolidator as DBConsolidator;
use App\Models\Perusahaan as DBPerusahaan;
use App\Models\Negara as DBNegara;
use App\Models\Pelabuhan as DBPelabuhan;
use App\Models\Vessel as DBVessel;
use App\Models\Shippingline as DBShippingline;
use App\Models\Lokasisandar as DBLokasisandar;
use App\Models\Containercy as DBContainer;
use App\Models\Eseal as DBEseal;
use App\Models\ReportGateoutFcl as DBReportGateoutFcl;

class FclController extends Controller
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

    public function registerIndex()
    {
        if ( !$this->access->can('show.fcl.register.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index FCL Register', 'slug' => 'show.fcl.register.index', 'description' => ''));
        
        $data['page_title'] = "FCL Register";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Register'
            ]
        ];        
        
        return view('import.fcl.index-register')->with($data);
    }
    
    public function gateinIndex()
    {
        if ( !$this->access->can('show.fcl.getin.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index FCL GateIn', 'slug' => 'show.fcl.getin.index', 'description' => ''));
        
        $data['page_title'] = "FCL Realisasi Masuk / Gate In";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Realisasi Masuk / Gate In'
            ]
        ];        
        
        $data['eseals'] = DBEseal::select('eseal_id as id','esealcode as code')->get();
        
        return view('import.fcl.index-gatein')->with($data);
    }
    
    public function behandleIndex()
    {
        if ( !$this->access->can('show.fcl.behandle.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index FCL Behandle', 'slug' => 'show.fcl.behandle.index', 'description' => ''));
        
        $data['page_title'] = "FCL Delivery Behandle";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Delivery Behandle'
            ]
        ];        
        
        return view('import.fcl.index-behandle')->with($data);
    }
    
    public function fiatmuatIndex()
    {
        if ( !$this->access->can('show.fcl.fiatmuat.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index FCL Fiatmuat', 'slug' => 'show.fcl.fiatmuat.index', 'description' => ''));
        
        $data['page_title'] = "FCL Delivery Fiat Muat";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Delivery Fiat Muat'
            ]
        ];        
        
        $data['kode_doks'] = \App\Models\KodeDok::get(); 
        
        return view('import.fcl.index-fiatmuat')->with($data);
    }
    
    public function suratjalanIndex()
    {
        if ( !$this->access->can('show.fcl.suratjalan.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index FCL Surat Jalan', 'slug' => 'show.fcl.suratjalan.index', 'description' => ''));
        
        $data['page_title'] = "FCL Delivery Surat Jalan";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Delivery Surat Jalan'
            ]
        ];        
        
        return view('import.fcl.index-suratjalan')->with($data);
    }
    
    public function releaseIndex()
    {
        if ( !$this->access->can('show.fcl.release.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index FCL Release', 'slug' => 'show.fcl.release.index', 'description' => ''));
        
        $data['page_title'] = "FCL Delivery Release";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Delivery Release'
            ]
        ];        
        
        $data['kode_doks'] = \App\Models\KodeDok::get(); 
        $data['perusahaans'] = DBPerusahaan::select('TPERUSAHAAN_PK as id', 'NAMAPERUSAHAAN as name')->get();
        
        return view('import.fcl.index-release')->with($data);
    }
    
    public function dispatcheIndex()
    {
        if ( !$this->access->can('show.fcl.dispatche.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index FCL Dispatche', 'slug' => 'show.fcl.dispatche.index', 'description' => ''));
        
        $data['page_title'] = "FCL Dispatche E-Seal";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Dispatche E-Seal'
            ]
        ];        
        
        $data['eseals'] = DBEseal::select('eseal_id as id','esealcode as code')->get();
        
        return view('import.fcl.index-dispatche-ob')->with($data);
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
        if ( !$this->access->can('show.fcl.register.create') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Create FCL Register', 'slug' => 'show.fcl.register.create', 'description' => ''));
        
        $data['page_title'] = "Create FCL Register";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('fcl-register-index'),
                'title' => 'FCL Register'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        $spk_last_id = DBJoborder::select('TJOBORDER_PK as id')->orderBy('TJOBORDER_PK', 'DESC')->first(); 
//        $spk_last_id = $this->getSpkNumber();
        $regID = str_pad(intval((isset($spk_last_id->id) ? $spk_last_id->id : 0)+1), 4, '0', STR_PAD_LEFT);
        
        $data['spk_number'] = 'PRJPG'.$regID.'/'.date('y');
        $data['consolidators'] = DBConsolidator::select('TCONSOLIDATOR_PK as id','NAMACONSOLIDATOR as name')->get();
        $data['countries'] = DBNegara::select('TNEGARA_PK as id','NAMANEGARA as name')->get();
        $data['perusahaans'] = DBPerusahaan::select('TPERUSAHAAN_PK as id','NAMAPERUSAHAAN as name')->get();
        $data['pelabuhans'] = array();
//        $data['pelabuhans'] = DBPelabuhan::select('TPELABUHAN_PK as id','NAMAPELABUHAN as name','KODEPELABUHAN as code')->limit(300)->get();
        $data['vessels'] = DBVessel::select('tvessel_pk as id','vesselname as name','vesselcode as code','callsign')->get();
        $data['shippinglines'] = DBShippingline::select('TSHIPPINGLINE_PK as id','SHIPPINGLINE as name')->get();
        $data['lokasisandars'] = DBLokasisandar::select('TLOKASISANDAR_PK as id','NAMALOKASISANDAR as name')->get();
        
        return view('import.fcl.create-register')->with($data);
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
        
        if ( !$this->access->can('store.fcl.register.create') ) {
            return view('errors.no-access');
        }
        
        $validator = \Validator::make($request->all(), [
            'NOJOBORDER' => 'required|unique:tjoborder',
//            'NOMBL' => 'required|unique:tjoborder',
//            'TGLMBL' => 'required',
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
        $data['TGLMBL'] = (!empty($data['TGLMBL'])) ? date('Y-m-d', strtotime($data['TGLMBL'])) : '0000-00-00';
        $data['ETA'] = (!empty($data['ETA'])) ? date('Y-m-d', strtotime($data['ETA'])) : '0000-00-00';
        $data['ETD'] = (!empty($data['ETD'])) ? date('Y-m-d', strtotime($data['ETD'])) : '0000-00-00';
        $data['TGL_BC11'] = (!empty($data['TGL_BC11'])) ? date('Y-m-d', strtotime($data['TGL_BC11'])) : '0000-00-00';
        $data['TTGL_PLP'] = (!empty($data['TTGL_PLP'])) ? date('Y-m-d', strtotime($data['TTGL_PLP'])) : '0000-00-00';
        $namaconsolidator = DBConsolidator::select('NAMACONSOLIDATOR','NPWP')->where('TCONSOLIDATOR_PK',$data['TCONSOLIDATOR_FK'])->first();
        $lokasisandar = DBLokasisandar::where('TLOKASISANDAR_PK',$data['TCONSOLIDATOR_FK'])->first();
        if($namaconsolidator) {
            $data['NAMACONSOLIDATOR'] = $namaconsolidator->NAMACONSOLIDATOR;
            $data['ID_CONSOLIDATOR'] = str_replace(array('.','-'),array('',''),$namaconsolidator->NPWP);
        }elseif($lokasisandar) {
            $data['NAMACONSOLIDATOR'] = $lokasisandar->NAMALOKASISANDAR;
        }       
        $namanegara = DBNegara::select('NAMANEGARA')->where('TNEGARA_PK',$data['TNEGARA_FK'])->first();
        if($namanegara) {
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
        $namaconsignee = DBPerusahaan::select('NAMAPERUSAHAAN','NPWP')->where('TPERUSAHAAN_PK',$data['TCONSIGNEE_FK'])->first();
        if($namaconsignee){
            $data['CONSIGNEE'] = $namaconsignee->NAMAPERUSAHAAN;
            $data['ID_CONSIGNEE'] = str_replace(array('.','-'),array('',''),$namaconsignee->NPWP);
        }
        $data['UID'] = \Auth::getUser()->name;
        
        $insert_id = DBJoborder::insertGetId($data);
        
        if($insert_id){
            
            // COPY JOBORDER
            $joborder = DBJoborder::findOrFail($insert_id);

            $data = array();
            $data['TJOBORDER_FK'] = $joborder->TJOBORDER_PK;
            $data['NoJob'] = $joborder->NOJOBORDER;
            $data['NOMBL'] = $joborder->NOMBL;
            $data['TGLMBL'] = $joborder->TGLMBL;
            $data['NO_BC11'] = $joborder->NO_BC11;
            $data['TGL_BC11'] = $joborder->TGL_BC11;
            $data['NO_POS_BC11'] = $joborder->NO_POS_BC11;
            $data['NO_PLP'] = $joborder->TNO_PLP;
            $data['TGL_PLP'] = $joborder->TTGL_PLP;
            $data['TCONSOLIDATOR_FK'] = $joborder->TCONSOLIDATOR_FK;
            $data['NAMACONSOLIDATOR'] = $joborder->NAMACONSOLIDATOR;
            $data['TCONSIGNEE_FK'] = $joborder->TCONSIGNEE_FK;
            $data['CONSIGNEE'] = $joborder->CONSIGNEE;
            $data['ID_CONSIGNEE'] = $joborder->ID_CONSIGNEE;
    //        $data['TLOKASISANDAR_FK'] = $joborder->TLOKASISANDAR_FK;
            $data['TSHIPPINGLINE_FK'] = $joborder->TSHIPPINGLINE_FK;
            $data['SHIPPINGLINE'] = $joborder->SHIPPINGLINE;
            $data['ETA'] = $joborder->ETA;
            $data['ETD'] = $joborder->ETD;
            $data['VESSEL'] = $joborder->VESSEL;
            $data['VOY'] = $joborder->VOY;
    //        $data['TPELABUHAN_FK'] = $joborder->TPELABUHAN_FK;
    //        $data['NAMAPELABUHAN'] = $joborder->NAMAPELABUHAN;
            $data['PEL_MUAT'] = $joborder->PEL_MUAT;
            $data['PEL_BONGKAR'] = $joborder->PEL_BONGKAR;
            $data['PEL_TRANSIT'] = $joborder->PEL_TRANSIT;
            $data['KD_TPS_ASAL'] = $joborder->KD_TPS_ASAL;
            $data['GUDANG_TUJUAN'] = $joborder->GUDANG_TUJUAN;
            $data['CALLSIGN'] = $joborder->CALLSIGN;
            $data['UID'] = \Auth::getUser()->name;
            
            $container_insert_id = DBContainer::insertGetId($data);
            
            return redirect()->route('fcl-register-edit',$container_insert_id)->with('success', 'FCL Register has been added.');
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
        if ( !$this->access->can('show.fcl.register.edit') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Edit FCL Register', 'slug' => 'show.fcl.register.edit', 'description' => ''));
        
        $data['page_title'] = "Edit FCL Register";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('fcl-register-index'),
                'title' => 'FCL Register'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['consolidators'] = DBConsolidator::select('TCONSOLIDATOR_PK as id','NAMACONSOLIDATOR as name')->get();
        $data['countries'] = DBNegara::select('TNEGARA_PK as id','NAMANEGARA as name')->get();
        $data['perusahaans'] = DBPerusahaan::select('TPERUSAHAAN_PK as id','NAMAPERUSAHAAN as name')->get();
        $data['pelabuhans'] = array();
//        $data['pelabuhans'] = DBPelabuhan::select('TPELABUHAN_PK as id','NAMAPELABUHAN as name','KODEPELABUHAN as code')->limit(300)->get();
        $data['vessels'] = DBVessel::select('tvessel_pk as id','vesselname as name','vesselcode as code','callsign')->get();
        $data['shippinglines'] = DBShippingline::select('TSHIPPINGLINE_PK as id','SHIPPINGLINE as name')->get();
        $data['lokasisandars'] = DBLokasisandar::select('TLOKASISANDAR_PK as id','NAMALOKASISANDAR as name')->get();
        
        $jobid = DBContainer::select('TJOBORDER_FK as id')->where('TCONTAINER_PK',$id)->first();
        
        $data['joborder'] = DBJoborder::find($jobid->id);
        
        return view('import.fcl.edit-register')->with($data);
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
        if ( !$this->access->can('update.fcl.register.edit') ) {
            return view('errors.no-access');
        }
        
        $data = $request->except(['_token']); 
        $data['TGLMBL'] = (!empty($data['TGLMBL'])) ? date('Y-m-d', strtotime($data['TGLMBL'])) : '0000-00-00';
        $data['ETA'] = (!empty($data['ETA'])) ? date('Y-m-d', strtotime($data['ETA'])) : '0000-00-00';
        $data['ETD'] = (!empty($data['ETD'])) ? date('Y-m-d', strtotime($data['ETD'])) : '0000-00-00';
        $data['TGL_BC11'] = (!empty($data['TGL_BC11'])) ? date('Y-m-d', strtotime($data['TGL_BC11'])) : '0000-00-00';
        $data['TTGL_PLP'] = (!empty($data['TTGL_PLP'])) ? date('Y-m-d', strtotime($data['TTGL_PLP'])) : '0000-00-00';
        $namaconsolidator = DBConsolidator::select('NAMACONSOLIDATOR','NPWP')->where('TCONSOLIDATOR_PK',$data['TCONSOLIDATOR_FK'])->first();
        $lokasisandar = DBLokasisandar::where('TLOKASISANDAR_PK',$data['TCONSOLIDATOR_FK'])->first();
        if($namaconsolidator) {
            $data['NAMACONSOLIDATOR'] = $namaconsolidator->NAMACONSOLIDATOR;
            $data['ID_CONSOLIDATOR'] = str_replace(array('.','-'),array('',''),$namaconsolidator->NPWP);
        }elseif($lokasisandar) {
            $data['NAMACONSOLIDATOR'] = $lokasisandar->NAMALOKASISANDAR;
        }       
        $namanegara = DBNegara::select('NAMANEGARA')->where('TNEGARA_PK',$data['TNEGARA_FK'])->first();
        if($namanegara) {
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
        $namaconsignee = DBPerusahaan::select('NAMAPERUSAHAAN','NPWP')->where('TPERUSAHAAN_PK',$data['TCONSIGNEE_FK'])->first();
        if($namaconsignee){
            $data['CONSIGNEE'] = $namaconsignee->NAMAPERUSAHAAN;
            $data['ID_CONSIGNEE'] = str_replace(array('.','-'),array('',''),$namaconsignee->NPWP);
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
            $data['NOMBL'] = $joborder->NOMBL;
            $data['TGLMBL'] = $joborder->TGLMBL;
            $data['NO_BC11'] = $joborder->NO_BC11;
            $data['TGL_BC11'] = $joborder->TGL_BC11;
            $data['NO_POS_BC11'] = $joborder->NO_POS_BC11;
            $data['NO_PLP'] = $joborder->TNO_PLP;
            $data['TGL_PLP'] = $joborder->TTGL_PLP;
            $data['TCONSOLIDATOR_FK'] = $joborder->TCONSOLIDATOR_FK;
            $data['NAMACONSOLIDATOR'] = $joborder->NAMACONSOLIDATOR;
            $data['ID_CONSIGNEE'] = $joborder->ID_CONSIGNEE;
            $data['TCONSIGNEE_FK'] = $joborder->TCONSIGNEE_FK;
            $data['CONSIGNEE'] = $joborder->CONSIGNEE;
            $data['TSHIPPINGLINE_FK'] = $joborder->TSHIPPINGLINE_FK;
            $data['SHIPPINGLINE'] = $joborder->SHIPPINGLINE;
            $data['TLOKASISANDAR_FK'] = $joborder->TLOKASISANDAR_FK;
            $data['ETA'] = $joborder->ETA;
            $data['ETD'] = $joborder->ETD;
            $data['VESSEL'] = $joborder->VESSEL;
            $data['VOY'] = $joborder->VOY;
    //        $data['TPELABUHAN_FK'] = $joborder->TPELABUHAN_FK;
    //        $data['NAMAPELABUHAN'] = $joborder->NAMAPELABUHAN;
            $data['PEL_MUAT'] = $joborder->PEL_MUAT;
            $data['PEL_BONGKAR'] = $joborder->PEL_BONGKAR;
            $data['PEL_TRANSIT'] = $joborder->PEL_TRANSIT;
            $data['KD_TPS_ASAL'] = $joborder->KD_TPS_ASAL;
            $data['GUDANG_TUJUAN'] = $joborder->GUDANG_TUJUAN;
            $data['CALLSIGN'] = $joborder->CALLSIGN;           
            
            $updateContainer = DBContainer::where('TJOBORDER_FK', $id)
                    ->update($data);
            
            if($updateContainer){
                
                return back()->with('success', 'FCL Register has been updated.');                   
            }
            
            return back()->with('success', 'FCL Register has been updated, but container not updated.');
        }
        
        return back()->with('error', 'FCL Register cannot update, please try again.')->withInput();
    }
    
    public function gateinUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TCONTAINER_PK'], $data['_token']);
        
        $teus = DBContainer::select('TEUS')->where('TCONTAINER_PK', $id)->first();

        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($data);
        
        if($update){
            $cont = DBContainer::find($id);
            if($cont->yor_update == 0){
                $yor = $this->updateYor('gatein', $teus->TEUS);
                $cont->yor_update = 1;
                $cont->save();
            }
            
//            $dataManifest['tglmasuk'] = $data['tglmasuk'];
//            $dataManifest['Jammasuk'] = $data['JAMMASUK'];  
//            $dataManifest['NOPOL_MASUK'] = $data['NOPOL']; 
//            
//            $updateManifest = DBManifest::where('TCONTAINER_FK', $id)
//                    ->update($dataManifest);
            
//            if($updateManifest){
                return json_encode(array('success' => true, 'message' => 'Gate IN successfully updated!'));
//            }
            
//            return json_encode(array('success' => true, 'message' => 'Container successfully updated, but Manifest not updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));

    }
    
    public function strippingUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        $dataupdate = array();
//        unset($data['TCONTAINER_PK'], $data['working_hours'], $data['_token']);
        
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
        $date_start_stripping = strtotime($dataupdate['STARTSTRIPPING']);
        $date_end_stripping = strtotime($dataupdate['ENDSTRIPPING']);
        $stripping = abs($date_start_stripping - $date_end_stripping);
        
        $date_start_tunda = strtotime($dataupdate['mulai_tunda']);
        $date_end_tunda = strtotime($dataupdate['selesai_tunda']);
        $tunda = abs($date_start_tunda - $date_end_tunda);
        
        $working_hours = date('H:i', abs($stripping - $tunda));
        $dataupdate['working_hours'] = $working_hours;
        
        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($dataupdate);
        
        if($update){
            
//            $dataManifest['tglstripping'] = $data['ENDSTRIPPING'];
//            $dataManifest['jamstripping'] = $data['JAMENDSTRIPPING'];  
//            $dataManifest['STARTSTRIPPING'] = $data['STARTSTRIPPING'].' '.$data['JAMSTARTSTRIPPING'];
//            $dataManifest['ENDSTRIPPING'] = $data['ENDSTRIPPING'].' '.$data['JAMENDSTRIPPING'];
//            
//            $updateManifest = DBManifest::where('TCONTAINER_FK', $id)
//                    ->update($dataManifest);
            
//            if($updateManifest){
                return json_encode(array('success' => true, 'message' => 'Stripping successfully updated!'));
//            }
            
//            return json_encode(array('success' => true, 'message' => 'Container successfully updated, but Manifest not updated!'));
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
            
//            $dataManifest['tglbuangmty'] = $data['TGLBUANGMTY'];
//            $dataManifest['jambuangmty'] = $data['JAMBUANGMTY'];  
//            $dataManifest['NOPOL_MTY'] = $data['NOPOL_MTY'];
//            
//            $updateManifest = DBManifest::where('TCONTAINER_FK', $id)
//                    ->update($dataManifest);
            
//            if($updateManifest){
                return json_encode(array('success' => true, 'message' => 'Buang MTY successfully updated!'));
//            }
            
//            return json_encode(array('success' => true, 'message' => 'Container successfully updated, but Manifest not updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function behandleUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TCONTAINER_PK'], $data['_token']);
        
        $data['BEHANDLE'] = 'Y';
        
        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Behandle successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function fiatmuatUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TCONTAINER_PK'], $data['_token']);

        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Fiat Muat successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function suratjalanUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TCONTAINER_PK'], $data['TGLFIAT'], $data['_token']);
        
        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Surat Jalan successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function releaseUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TCONTAINER_PK'], $data['_token']);
        
        $teus = DBContainer::select('TEUS')->where('TCONTAINER_PK', $id)->first();
        $kd_dok = \App\Models\KodeDok::find($data['KD_DOK_INOUT']);
        if($kd_dok):
            $data['KODE_DOKUMEN'] = $kd_dok->name;
        endif;
        $data['TGLFIAT'] = $data['TGLRELEASE'];
        $data['JAMFIAT'] = $data['JAMRELEASE'];
        $data['TGLSURATJALAN'] = $data['TGLRELEASE'];
        $data['JAMSURATJALAN'] = $data['JAMRELEASE'];
        $data['NAMAEMKL'] = '';
        $data['NOPOL'] = $data['NOPOL_OUT'];
        
        $update = DBContainer::where('TCONTAINER_PK', $id)
            ->update($data);
        
        if($update){
            $cont = DBContainer::find($id);
            if($cont->yor_update == 1){
                $yor = $this->updateYor('release', $teus->TEUS);
                $cont->yor_update = 2;
                $cont->save();
            }
            
            return json_encode(array('success' => true, 'message' => 'Release successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function dispatcheUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
//        unset($data['TCONTAINER_PK'], $data['_token'], $data['container_type']);
//        
//        $update = DBContainer::where('TCONTAINER_PK', $id)
//            ->update($data);
        
        $insert = new \App\Models\Easygo;
        $insert->ESEALCODE = $data['ESEALCODE'];
	$insert->TGL_PLP = $data['TGL_PLP'];
	$insert->NO_PLP = $data['NO_PLP'];
        $insert->KD_TPS_ASAL = $data['KD_TPS_ASAL'];
        $insert->KD_TPS_TUJUAN = 'PRJP';
        $insert->NOCONTAINER = $data['NO_CONT'];
        $insert->SIZE = $data['UK_CONT'];
        $insert->TYPE = $data['TYPE'];
        $insert->NOPOL = $data['NOPOL'];
        $insert->OB_ID = $id;
        
        if($insert->save()){
            
            $updateOB = \App\Models\TpsOb::where('TPSOBXML_PK', $id)->update(['STATUS_DISPATCHE' => 'S']);
            
            return json_encode(array('success' => true, 'message' => 'Container successfully updated.'));
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
        DBJoborder::destroy($id);
        return back()->with('success', 'FCL Register has been deleted.'); 
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
        $container = DBContainer::find($id);
        $data['container'] = $container;
//        return view('print.fcl-behandle', $data);
        $pdf = \PDF::loadView('print.fcl-behandle', $data); 
        return $pdf->stream('FCL-Behandle-'.$container->NOCONTAINER.'-'.date('dmy').'.pdf');
    }
    
    public function fiatmuatCetak($id)
    {
        $container = DBContainer::find($id);
        $joborder = DBJoborder::where('TJOBORDER_PK', $container->TJOBORDER_FK);
        $data['container'] = $container;
        $data['joborder'] = $joborder;
//        return view('print.fcl-fiatmuat', $data);
        $pdf = \PDF::loadView('print.fcl-fiatmuat', $data); 
        return $pdf->stream('FCL-FiatMuat-'.$container->NOCONTAINER.'-'.date('dmy').'.pdf');
    }
    
    public function suratjalanCetak($id)
    {
        $container = DBContainer::find($id);
        $data['container'] = $container;
        return view('print.fcl-surat-jalan', $data);
        $pdf = \PDF::loadView('print.fcl-surat-jalan', $data); 
        return $pdf->stream('Delivery-SuratJalan-'.$container->NOCONTAINER.'-'.date('dmy').'.pdf');
    }
    
    // REPORT
    public function reportHarian()
    {
        if ( !$this->access->can('show.fcl.report.harian') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Report Harian FCL', 'slug' => 'show.fcl.report.harian', 'description' => ''));
        
        $data['page_title'] = "FCL Report Delivery Harian";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Report Delivery Harian'
            ]
        ];        
        
        return view('import.fcl.report-harian')->with($data);
    }
    
    public function reportRekap(Request $request)
    {
        if ( !$this->access->can('show.fcl.report.rekap') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Report Rekap FCL', 'slug' => 'show.fcl.report.rekap', 'description' => ''));
        
        $data['page_title'] = "FCL Report Container";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Report Container'
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
        $data['countbytps'] = array('JICT' => array($jict, $jictg), 'KOJA' => array($koja, $kojag), 'MAL0' => array($mal, $malg), 'NCT1' => array($nct1, $nct1g), 'PLDC' => array($pldc, $pldcg));
        
//        BY DOKUMEN
        $bc20 = DBContainer::where('KD_DOK_INOUT', 1)->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $bc23 = DBContainer::where('KD_DOK_INOUT', 2)->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $bc12 = DBContainer::where('KD_DOK_INOUT', 4)->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $bc15 = DBContainer::where('KD_DOK_INOUT', 9)->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $bc11 = DBContainer::where('KD_DOK_INOUT', 20)->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $bcf26 = DBContainer::where('KD_DOK_INOUT', 5)->whereRaw('MONTH(TGLMASUK) = '.$month)->whereRaw('YEAR(TGLMASUK) = '.$year)->count();
        $data['countbydoc'] = array('BC 2.0' => $bc20, 'BC 2.3' => $bc23, 'BC 1.2' => $bc12, 'BC 1.5' => $bc15, 'BC 1.1' => $bc11, 'BCF 2.6' => $bcf26);
        
        
        $data['totcounttpsp'] = array_sum(array($jict,$koja,$mal,$nct1,$pldc));
        $data['totcounttpsg'] = array_sum(array($jictg,$kojag,$malg,$nct1g,$pldcg));
//        $fc = DBContainer::whereIn('TCONSOLIDATOR_FK', array(1,4))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
//        $me = DBContainer::whereIn('TCONSOLIDATOR_FK', array(13,16))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
//        $ap = DBContainer::whereIn('TCONSOLIDATOR_FK', array(10,12))->whereRaw('MONTH(TGL_PLP) = '.$month)->whereRaw('YEAR(TGL_PLP) = '.$year)->count();
//        $data['countbyconsolidator'] = array('FBI/CPL' => $fc, 'MKT/ECU' => $me, 'ARJAKA/PELOPOR' => $ap);
        
        $data['month'] = $month;
        $data['year'] = $year;
        
        $data['yor'] = \App\Models\SorYor::where('type', 'yor')->first();
        
        return view('import.fcl.report-rekap')->with($data);
    }
    
    public function reportRekapSend(Request $request)
    {
        $selected_id = $request->get('id');
        $shippingline_id = $request->get('shippingline_id');
        $subject = $request->get('subject');
        $tgl_laporan = $request->get('tgl_laporan');
        
        $shippingline = DBShippingline::find($shippingline_id);
        
        if($shippingline){
            $cont_id = explode(',', $selected_id);
            $containers = DBContainer::whereIn('TCONTAINER_PK',$cont_id)->get();

            $dataGateOut = new DBReportGateoutFcl;
            $dataGateOut->container_id = @serialize($cont_id);
            $dataGateOut->shippingline_id = $shippingline->tshippingline_pk;
            $dataGateOut->shippingline = $shippingline->shippingline;
            $dataGateOut->email = $shippingline->email;
            $dataGateOut->subject = $subject;
            $dataGateOut->tgl_laporan = $tgl_laporan;
            $dataGateOut->uid = \Auth::getUser()->name;
            
//            return \View('emails.report-gateout-fcl', array('containers' => $containers, 'data' => $dataGateOut));
            
            if($dataGateOut->save()){
                $send_email = \Mail::send('emails.report-gateout-fcl', array('containers' => $containers, 'data' => $dataGateOut), function($message) use($subject, $dataGateOut) {
                    $message->from('info@prjp.co.id', 'Primanata Jasa Persada');
                    $message->sender('info@prjp.co.id');
                    $message->subject($subject);
                    $message->to($dataGateOut->email, $dataGateOut->shippingline);
                    $message->cc('busdev@jict.co.id');
                });
                
                if($send_email){
                    return back()->with('success', 'Report has been success sent to '.$dataGateOut->email);
                }else{
                    return back()->with('error', 'Cannot send email, please try again later.');
                }

            }

        }
        
        return back()->with('error', 'Something went wrong, please try again later.');
    }
    
    public function reportStock()
    {
        
    }
    
    public function reportLongstay()
    {
        if ( !$this->access->can('show.fcl.report.longstay') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Report Longstay Stock', 'slug' => 'show.fcl.report.longstay', 'description' => ''));
        
        $data['page_title'] = "FCL Inventory Stock";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Inventory Stock'
            ]
        ]; 
        
        return view('import.fcl.report-longstay')->with($data);
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
                $coaricontdetail->JNS_CONT = 'F';
                $coaricontdetail->NO_BL_AWB = $container->NO_BL_AWB;
                $coaricontdetail->TGL_BL_AWB = (!empty($container->TGL_BL_AWB) ? date('Ymd', strtotime($container->TGL_BL_AWB)) : '');
                $coaricontdetail->NO_MASTER_BL_AWB = $container->NOMBL;
                $coaricontdetail->TGL_MASTER_BL_AWB = (!empty($container->TGL_MASTER_BL) ? date('Ymd', strtotime($container->TGL_MASTER_BL)) : '');
                $coaricontdetail->ID_CONSIGNEE = $container->ID_CONSOLIDATOR;
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
                $coaricontdetail->NO_DAFTAR_PABEAN = $container->NO_DAFTAR_PABEAN;
                $coaricontdetail->TGL_DAFTAR_PABEAN = (!empty($container->TGL_DAFTAR_PABEAN) ? date('Ymd', strtotime($container->TGL_DAFTAR_PABEAN)) : '');
                $coaricontdetail->NO_SEGEL_BC = '';
                $coaricontdetail->TGL_SEGEL_BC = '';
                $coaricontdetail->NO_IJIN_TPS = '';
                $coaricontdetail->TGL_IJIN_TPS = '';
                $coaricontdetail->RESPONSE_IPC = '';
                $coaricontdetail->STATUS_TPS_IPC = '';
                $coaricontdetail->NOPLP = '';
                $coaricontdetail->TGLPLP = '';
                $coaricontdetail->FLAG_REVISI = '';
                $coaricontdetail->TGL_REVISI = '';
                $coaricontdetail->TGL_REVISI_UPDATE = '';
                $coaricontdetail->KD_TPS_ASAL = '';
                $coaricontdetail->FLAG_UPD = '';
                $coaricontdetail->RESPONSE_MAL0 = '';
                $coaricontdetail->STATUS_TPS_MAL0 = '';
                $coaricontdetail->TGL_ENTRY = date('Y-m-d');
                $coaricontdetail->JAM_ENTRY = date('H:i:s');
                
                if($coaricontdetail->save()){
                    
                    $container->REF_NUMBER = $reff_number;
                    $container->save();
                    
                    // Create XML
                    return json_encode(array('insert_id' => $coaricont->TPSCOARICONTXML_PK, 'ref_number' => $reff_number, 'success' => true, 'message' => 'No. Container '.$container->NOCONTAINER.' berhasil di simpan. Reff Number : '.$reff_number));
                }
                
            }
        } else {
            return json_encode(array('success' => false, 'message' => 'Cannot create Reff Number, please try again later.'));
        }
              
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
        
    }
    
    public function releaseUpload(Request $request)
    {
        $container_id = $request->id; 
        $container = DBContainer::where('TCONTAINER_PK', $container_id)->first();
        
        // Check data xml
        $check = \App\Models\TpsCodecoContFclDetail::where(array('NO_CONT' => $container->NOCONTAINER, 'JNS_CONT' => 'F'))->count();
        
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
                $codecocontdetail->CALL_SIGN = (!empty($container->CALLSIGN) ? $container->CALLSIGN : 0);
                $codecocontdetail->TGL_TIBA = (!empty($container->ETA) ? date('Ymd', strtotime($container->ETA)) : '');
                $codecocontdetail->KD_GUDANG = 'PRJP';
                $codecocontdetail->NO_CONT = $container->NOCONTAINER;
                $codecocontdetail->UK_CONT = $container->SIZE;
                $codecocontdetail->NO_SEGEL = $container->NOSEGEL;
                $codecocontdetail->JNS_CONT = 'F';
                $codecocontdetail->NO_BL_AWB = '';
                $codecocontdetail->TGL_BL_AWB = '';
                $codecocontdetail->NO_MASTER_BL_AWB = $container->NOMBL;
                $codecocontdetail->TGL_MASTER_BL_AWB = (!empty($container->TGLMBL) ? date('Ymd', strtotime($container->TGLMBL)) : '');
//                $codecocontdetail->ID_CONSIGNEE = $container->NPWP_IMP;
//                $codecocontdetail->CONSIGNEE = $container->NAMA_IMP;
                $codecocontdetail->ID_CONSIGNEE = $container->ID_CONSIGNEE;
                $codecocontdetail->CONSIGNEE = $container->CONSIGNEE;
                $codecocontdetail->BRUTO = (!empty($container->WEIGHT) ? $container->WEIGHT : 0);
                $codecocontdetail->NO_BC11 = $container->NO_BC11;
                $codecocontdetail->TGL_BC11 = (!empty($container->TGL_BC11) ? date('Ymd', strtotime($container->TGL_BC11)) : '');
                $codecocontdetail->NO_POS_BC11 = $container->NO_POS_BC11;
                $codecocontdetail->KD_TIMBUN = 'LAP';
                $codecocontdetail->KD_DOK_INOUT = (!empty($container->KD_DOK_INOUT) ? $container->KD_DOK_INOUT : 3);
                $codecocontdetail->NO_DOK_INOUT = (!empty($container->NO_SPPB) ? $container->NO_SPPB : '');
                $codecocontdetail->TGL_DOK_INOUT = (!empty($container->TGL_SPPB) ? date('Ymd', strtotime($container->TGL_SPPB)) : '');
                $codecocontdetail->WK_INOUT = date('Ymd', strtotime($container->TGLRELEASE)).date('His', strtotime($container->JAMRELEASE));
                $codecocontdetail->KD_SAR_ANGKUT_INOUT = 1;
                $codecocontdetail->NO_POL = $container->NOPOL_OUT;
                $codecocontdetail->FL_CONT_KOSONG = 2;
                $codecocontdetail->ISO_CODE = '';
                $codecocontdetail->PEL_MUAT = $container->PEL_MUAT;
                $codecocontdetail->PEL_TRANSIT = $container->PEL_TRANSIT;
                $codecocontdetail->PEL_BONGKAR = $container->PEL_BONGKAR;
                $codecocontdetail->GUDANG_TUJUAN = 'PRJP';
                $codecocontdetail->UID = \Auth::getUser()->name;
                $codecocontdetail->NOURUT = 1;
                $codecocontdetail->RESPONSE = '';
                $codecocontdetail->STATUS_TPS = 1;
                $codecocontdetail->KODE_KANTOR = '040300';
                $codecocontdetail->NO_DAFTAR_PABEAN = (!empty($container->NO_PIB) ? $container->NO_PIB : '');
                $codecocontdetail->TGL_DAFTAR_PABEAN = (!empty($container->TGL_PIB) ? date('Ymd', strtotime($container->TGL_PIB)) : '');
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
                $codecocontdetail->KD_TPS_ASAL = '';
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
        $ids = explode(',', $request->id);
        
        $container20 = DBContainer::where('size', 20)->whereIn('TCONTAINER_PK', $ids)->get();
        $container40 = DBContainer::where('size', 40)->whereIn('TCONTAINER_PK', $ids)->get();
        
        if($container20 || $container40) {

            $data = (count($container20) > 0 ? $container20['0'] : $container40['0']);
            $consignee = DBPerusahaan::where('TPERUSAHAAN_PK', $data['TCONSIGNEE_FK'])->first();
            
            // Create Invoice Header
            $invoice_nct = new \App\Models\InvoiceNct;
//            $invoice_nct->container_id
//            $invoice_nct->no_container	
            $invoice_nct->no_invoice = $request->no_invoice;	
            $invoice_nct->no_pajak = $request->no_pajak;	
            $invoice_nct->consignee = $request->consignee;	
            $invoice_nct->npwp = $request->npwp;
            $invoice_nct->alamat = $request->alamat;	
            $invoice_nct->consignee_id = $request->consignee_id;	
            $invoice_nct->vessel = $data['VESSEL'];	
            $invoice_nct->voy = $data['VOY'];	
            $invoice_nct->no_do = $request->no_do;	
            $invoice_nct->no_bl = $request->no_bl;	
            $invoice_nct->eta = $data['ETA'];	
            $invoice_nct->gateout_terminal = $data['TGLMASUK'];	
            $invoice_nct->gateout_tps = $data['TGLRELEASE'];	
            $invoice_nct->uid = \Auth::getUser()->name;	
            
            if($invoice_nct->save()) {
                
                // Insert Invoice Detail
                if(count($container20) > 0) {

                    $tarif20 = \App\Models\InvoiceTarifNct::where('size', 20)->get();
                    
                    foreach ($tarif20 as $t20) :
                        
                        $invoice_penumpukan = new \App\Models\InvoiceNctPenumpukan;                      

                        $invoice_penumpukan->invoice_nct_id = $invoice_nct->id;
                        $invoice_penumpukan->lokasi_sandar = $t20->lokasi_sandar;
                        $invoice_penumpukan->size = 20;
                        $invoice_penumpukan->qty = count($container20);
                        
                        if($t20->lokasi_sandar == 'NCT1') {
                            
                            // GERAKAN
                            $invoice_gerakan = new \App\Models\InvoiceNctGerakan;
                        
                            $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                            $invoice_gerakan->lokasi_sandar = $t20->lokasi_sandar;
                            $invoice_gerakan->size = 20;
                            $invoice_gerakan->qty = count($container20); 
                            $invoice_gerakan->jenis_gerakan = 'Lift On Terminal';
                            $invoice_gerakan->tarif_dasar = $t20->lift_on;
                            $invoice_gerakan->total = $invoice_gerakan->qty * $t20->lift_on;
                            $invoice_gerakan->save();

                            // PENUMPUKAN
                            $date1 = date_create($data['ETA']);
                            $date2 = date_create(date('Y-m-d',strtotime($data['TGLMASUK']. '+1 days')));
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");
                            
                            $invoice_penumpukan->startdate = $data['ETA'];
                            $invoice_penumpukan->enddate = $data['TGLMASUK'];
                            $invoice_penumpukan->lama_timbun = $hari;
                            
                            $invoice_penumpukan->hari_masa1 = ($hari > 0) ? 1 : 0;
                            $invoice_penumpukan->hari_masa2 = ($hari > 1) ? 1 : 0;
                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? 1 : 0;
                            $invoice_penumpukan->hari_masa4 = ($hari > 3) ? $hari - 3 : 0;
                            
                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa2 * $t20->masa1) * count($container20);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t20->masa2 * 3) * count($container20);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t20->masa3 * 6) * count($container20);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t20->masa4 * 9) * count($container20);
                            
                        } else {
                            
                            // GERAKAN
                            if($data['BEHANDLE'] == 'Y') {
                                $jenis = array('Lift On/Off' => $t20->lift_off,'Paket PLP' => $t20->paket_plp,'Behandle' => $t20->behandle);
                            }else{
                                $jenis = array('Lift On/Off' => $t20->lift_off,'Paket PLP' => $t20->paket_plp);
                            }
                            
                            
                            foreach ($jenis as $key=>$value):
                                $invoice_gerakan = new \App\Models\InvoiceNctGerakan;
                        
                                $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                                $invoice_gerakan->lokasi_sandar = $t20->lokasi_sandar;
                                $invoice_gerakan->size = 20;
                                $invoice_gerakan->qty = count($container20); 
                                $invoice_gerakan->jenis_gerakan = $key;
                                $invoice_gerakan->tarif_dasar = $value;
                                $invoice_gerakan->total = $invoice_gerakan->qty * $value;
                                
                                $invoice_gerakan->save();
                            endforeach;
                            
                            // PENUMPUKAN
                            $date1 = date_create($data['TGLMASUK']);
                            $date2 = date_create($data['TGLRELEASE']);
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");
                            
                            $invoice_penumpukan->startdate = $data['TGLMASUK'];
                            $invoice_penumpukan->enddate = $data['TGLRELEASE'];
                            $invoice_penumpukan->lama_timbun = $hari;
                            
                            $invoice_penumpukan->hari_masa1 = ($hari > 0) ? min(array($hari,2)) : 0;
                            $invoice_penumpukan->hari_masa2 = ($hari > 2) ? $hari-2 : 0;
                            $invoice_penumpukan->hari_masa3 = 0;
                            $invoice_penumpukan->hari_masa4 = 0;
                            
                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t20->masa1 * 2) * count($container20);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t20->masa2 * 3) * count($container20);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t20->masa3) * count($container20);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t20->masa4) * count($container20);
                        }
 
                        $invoice_penumpukan->total = array_sum(array($invoice_penumpukan->masa1,$invoice_penumpukan->masa2,$invoice_penumpukan->masa3,$invoice_penumpukan->masa4)); 

                        $invoice_penumpukan->save();
                        
                    endforeach;
                    
                }
                
                if(count($container40) > 0) {

                    $tarif40 = \App\Models\InvoiceTarifNct::where('size', 40)->get();
                    
                    foreach ($tarif40 as $t40) :
                        
                        $invoice_penumpukan = new \App\Models\InvoiceNctPenumpukan;
                        
                        $invoice_penumpukan->invoice_nct_id = $invoice_nct->id;
                        $invoice_penumpukan->lokasi_sandar = $t40->lokasi_sandar;
                        $invoice_penumpukan->size = 40;
                        $invoice_penumpukan->qty = count($container40);
                        
                        if($t40->lokasi_sandar == 'NCT1') {
                            // GERAKAN
                            $invoice_gerakan = new \App\Models\InvoiceNctGerakan;
                        
                            $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                            $invoice_gerakan->lokasi_sandar = $t40->lokasi_sandar;
                            $invoice_gerakan->size = 40;
                            $invoice_gerakan->qty = count($container40); 
                            $invoice_gerakan->jenis_gerakan = 'Lift On Terminal';
                            $invoice_gerakan->tarif_dasar = $t40->lift_on;
                            $invoice_gerakan->total = $invoice_gerakan->qty * $t40->lift_on;
                            $invoice_gerakan->save();

                            // PENUMPUKAN
                            $date1 = date_create($data['ETA']);
                            $date2 = date_create(date('Y-m-d',strtotime($data['TGLMASUK']. '+1 days')));
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");
                            
                            $invoice_penumpukan->startdate = $data['ETA'];
                            $invoice_penumpukan->enddate = $data['TGLMASUK'];
                            $invoice_penumpukan->lama_timbun = $hari;
                            
                            $invoice_penumpukan->hari_masa1 = ($hari > 0) ? 1 : 0;
                            $invoice_penumpukan->hari_masa2 = ($hari > 1) ? 1 : 0;
                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? 1 : 0;
                            $invoice_penumpukan->hari_masa4 = ($hari > 3) ? $hari - 3 : 0;
                            
                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t40->masa1) * count($container40);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t40->masa2 * 3) * count($container40);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t40->masa3 * 6) * count($container40);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t40->masa4 * 9) * count($container40);
                            
                        } else {
                            // GERAKAN
                            if($data['BEHANDLE'] == 'Y') {
                                $jenis = array('Lift On/Off' => $t40->lift_off,'Paket PLP' => $t40->paket_plp,'Behandle' => $t40->behandle);
                            }else{
                                $jenis = array('Lift On/Off' => $t40->lift_off,'Paket PLP' => $t40->paket_plp);
                            }
                            
                            foreach ($jenis as $key=>$value):
                                $invoice_gerakan = new \App\Models\InvoiceNctGerakan;
                        
                                $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                                $invoice_gerakan->lokasi_sandar = $t40->lokasi_sandar;
                                $invoice_gerakan->size = 40;
                                $invoice_gerakan->qty = count($container40); 
                                $invoice_gerakan->jenis_gerakan = $key;
                                $invoice_gerakan->tarif_dasar = $value;
                                $invoice_gerakan->total = $invoice_gerakan->qty * $value;
                                
                                $invoice_gerakan->save();
                            endforeach;
                            
                            // PENUMPUKAN
                            $date1 = date_create($data['TGLMASUK']);
                            $date2 = date_create($data['TGLRELEASE']);
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");
                            
                            $invoice_penumpukan->startdate = $data['TGLMASUK'];
                            $invoice_penumpukan->enddate = $data['TGLRELEASE'];
                            $invoice_penumpukan->lama_timbun = $hari;
                            
                            $invoice_penumpukan->hari_masa1 = ($hari > 0) ? min(array($hari,2)) : 0;
                            $invoice_penumpukan->hari_masa2 = ($hari > 2) ? $hari-2 : 0;
                            $invoice_penumpukan->hari_masa3 = 0;
                            $invoice_penumpukan->hari_masa4 = 0;
                            
                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t40->masa1 * 2) * count($container40);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t40->masa2 * 3) * count($container40);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t40->masa3) * count($container40);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t40->masa4) * count($container40);
                        }

                        $invoice_penumpukan->total = array_sum(array($invoice_penumpukan->masa1,$invoice_penumpukan->masa2,$invoice_penumpukan->masa3,$invoice_penumpukan->masa4)); 
                        
                        $invoice_penumpukan->save();
                        
                    endforeach;
                    
                }
                
            }
            
            $nct_gerakan = array('Pas Truck' => 9100, 'Gate Pass Admin' => 20000, 'Cost Rec/Surcarge' => 75000);
            
            foreach($nct_gerakan as $key=>$value):
                $invoice_gerakan = new \App\Models\InvoiceNctGerakan;
                        
                $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                $invoice_gerakan->lokasi_sandar = 'NCT1';
                $invoice_gerakan->size = 0;
                $invoice_gerakan->qty = count($container20)+count($container40); 
                $invoice_gerakan->jenis_gerakan = $key;
                $invoice_gerakan->tarif_dasar = $value;
                $invoice_gerakan->total = (count($container20)+count($container40)) * $value;

                $invoice_gerakan->save();
            endforeach;
//            
            $update_nct = \App\Models\InvoiceNct::find($invoice_nct->id);
            
            $total_penumpukan = \App\Models\InvoiceNctPenumpukan::where('invoice_nct_id', $invoice_nct->id)->sum('total');
            $total_gerakan = \App\Models\InvoiceNctGerakan::where('invoice_nct_id', $invoice_nct->id)->sum('total');
            
            $update_nct->administrasi = (count($container20)+count($container40)) * 100000;
            $update_nct->total_non_ppn = $total_penumpukan + $total_gerakan + $update_nct->administrasi;	
            $update_nct->ppn = $update_nct->total_non_ppn * 10/100;	
            if(($update_nct->total_non_ppn+$update_nct->ppn) >= 1000000){ 
                $materai = 6000;
            }elseif(($update_nct->total_non_ppn+$update_nct->ppn) < 300000) {
                $materai = 0;
            }else{
                $materai = 3000;
            }
            $update_nct->materai = $materai;	
            $update_nct->total = $update_nct->total_non_ppn+$update_nct->ppn+$update_nct->materai;	
            
            $update_nct->save();
            
            return back()->with('success', 'Invoice berhasih dibuat.');
//            return json_encode(array('success' => true, 'message' => 'Invoice berhasih dibuat.'));
            
        }
        
//        return $container;
        return back()->with('error', 'Something went wrong, please try again later.');
//        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
}
