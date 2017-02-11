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
        
        return view('import.lcl.index-buangmty')->with($data);
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
        $data['NAMANEGARA'] = $namanegara->NAMANEGARA;
        $namapelabuhan = DBPelabuhan::select('NAMAPELABUHAN')->where('TPELABUHAN_PK',$data['TPELABUHAN_FK'])->first();
        $data['NAMAPELABUHAN'] = $namapelabuhan->NAMAPELABUHAN;
        $namalokasisandar = DBLokasisandar::select('NAMALOKASISANDAR')->where('TLOKASISANDAR_PK',$data['TLOKASISANDAR_FK'])->first();
        $data['NAMALOKASISANDAR'] = $namalokasisandar->NAMALOKASISANDAR;
        if($data['TSHIPPINGLINE_FK']){
            $namashippingline = DBShippingline::select('SHIPPINGLINE')->where('TSHIPPINGLINE_PK',$data['TSHIPPINGLINE_FK'])->first();
            $data['SHIPPINGLINE'] = $namashippingline->SHIPPINGLINE;
        }
        $data['UID'] = \Auth::getUser()->name;
        
        $insert_id = DBJoborder::insertGetId($data);
        
        if($insert_id){
            
            return redirect()->route('lcl-register-edit',$insert_id)->with('success', 'LCL Register has been added.');
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
        
//        $jobid = DBContainer::select('TJOBORDER_FK as id')->where('TCONTAINER_PK',$id)->first();
        
        $data['joborder'] = DBJoborder::find($id);
        
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
        $namanegara = DBNegara::select('NAMANEGARA')->where('TNEGARA_PK',$data['TNEGARA_FK'])->first();
        $data['NAMANEGARA'] = $namanegara->NAMANEGARA;
        $namapelabuhan = DBPelabuhan::select('NAMAPELABUHAN')->where('TPELABUHAN_PK',$data['TPELABUHAN_FK'])->first();
        $data['NAMAPELABUHAN'] = $namapelabuhan->NAMAPELABUHAN;
        $namalokasisandar = DBLokasisandar::select('NAMALOKASISANDAR')->where('TLOKASISANDAR_PK',$data['TLOKASISANDAR_FK'])->first();
        $data['NAMALOKASISANDAR'] = $namalokasisandar->NAMALOKASISANDAR;
        $namashippingline = DBShippingline::select('SHIPPINGLINE')->where('TSHIPPINGLINE_PK',$data['TSHIPPINGLINE_FK'])->first();
        $data['SHIPPINGLINE'] = $namashippingline->SHIPPINGLINE;
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
        unset($data['TCONTAINER_PK'], $data['_token']);
        
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
//        return $data;
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
        unset($data['TMANIFEST_PK'], $data['_token']);
        
        $data['BEHANDLE'] = 'Y';
        
        $update = DBManifest::where('TMANIFEST_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Behandle successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function fiatmuatUpdate(Request $request, $id)
    {
        $data = $request->json()->all(); 
        unset($data['TMANIFEST_PK'], $data['_token']);

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
        unset($data['TMANIFEST_PK'], $data['_token']);
        
        $update = DBManifest::where('TMANIFEST_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Release successfully updated!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
    
    public function dispatcheUpdate(Request $request, $id)
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
        DBJoborder::destroy($id);
        return back()->with('success', 'LCL Register has been deleted.'); 
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
//        return view('print.delivery-surat-jalan', $data);
        $pdf = \PDF::loadView('print.delivery-surat-jalan', $data); 
        return $pdf->stream('Delivery-SuratJalan-'.$mainfest->NOHBL.'-'.date('dmy').'.pdf');
    }
    
    // REPORT
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
    
    // TPS ONLINE    
    public function gateinUpload(Request $request)
    {
        $container_id = $request->id; 
        $container = DBContainer::where('TCONTAINER_PK', $container_id)->first();
        
        // Check data xml
        $check = \App\Models\TpsCoariContDetail::where('NO_CONT', $container->NOCONTAINER)->count();
        
        if($check > 0){
            return json_encode(array('success' => false, 'message' => 'No. Container '.$container->NOCONTAINER.' sudah di upload.'));
        }
        
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
                $coaricontdetail->CALL_SIGN = (!empty($container->CALL_SIGN) ? $container->CALL_SIGN : 0);;
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
                $coaricontdetail->ID_CONSIGNEE = str_replace(array('.','-'), array(''),$container->ID_CONSOLIDATOR);
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
                $coaricontdetail->STATUS_TPS = '';
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
                $coaricontdetail->TGLPLP = (!empty($container->TGL_PLP) ? date('Ymd', strtotime($container->TGL_PLP)) : '');;
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
                    
                    $container->REF_NUMBER_IN = $reff_number;
                    $container->save();
                    
                    return json_encode(array('success' => true, 'message' => 'No. Container '.$container->NOCONTAINER.' berhasil di upload. Reff Number : '.$reff_number));
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
        
        if($check > 0){
            return json_encode(array('success' => false, 'message' => 'No. Container '.$container->NOCONTAINER.' sudah di upload.'));
        }
        
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
                $codecocontdetail->CALL_SIGN = (!empty($container->CALL_SIGN) ? $container->CALL_SIGN : 0);;
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
                $codecocontdetail->KD_TPS_ASAL = '';
                $codecocontdetail->RESPONSE_MAL0 = '';
                $codecocontdetail->STATUS_TPS_MAL0 = '';
                $codecocontdetail->TGL_ENTRY = date('Y-m-d');
                $codecocontdetail->JAM_ENTRY = date('H:i:s');
                
                if($codecocontdetail->save()){
                    
                    return json_encode(array('success' => true, 'message' => 'No. Container '.$container->NOCONTAINER.' berhasil di upload. Reff Number : '.$reff_number));
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
        
        $tarif = DBConsolidatorTarif::where('TCONSOLIDATOR_FK', $manifest->TCONSOLIDATOR_FK)->first();
        
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
            $date1 = date_create($manifest->tglstripping);
            $date2 = date_create(date('Y-m-d',strtotime($manifest->tglrelease. '+1 days')));
            $diff = date_diff($date1, $date2);
            $hari = $diff->format("%a");
            
            // Perhitungan CBM
            $weight = $manifest->WEIGHT / 1000;
            $meas = $manifest->MEAS / 1000;
            $cbm = array($weight,$meas);
            $maxcbm = ceil(max($cbm) * 2) / 2;
//            $maxcbm = ceil(max($cbm));
            if($maxcbm < 2){ $maxcbm = 2; }
            
            // Sub Total (CBM*Hari*harga)
            if($tarif->storage > 0){
                $sub_masa = $hari * $tarif->storage;
                $tot_masa = $maxcbm * $sub_masa;
            }else{
                // Masa I
//                if($hari <> 3) {
                $hari_masa1 = 1;
                $sub_masa1 = $hari_masa1 * $tarif->storage_masa1;
                $tot_masa1 = $maxcbm * $sub_masa1;
//                }
                // Masa II
                if($hari > 3 ) {
                    $hari_masa2 = $hari - 3;
                    if($hari_masa2 > 2) { $hari_masa2 = 2; }
                    $sub_masa2 = $hari_masa2 * $tarif->storage_masa2;
                    $tot_masa2 = $maxcbm * $sub_masa2;
                }
                // Masa III
                if($hari > 5) {
                    $hari_masa3 = $hari - 5;
                    $sub_masa3 = $hari_masa3 * $tarif->storage_masa2;
                    $tot_masa3 = $maxcbm * $sub_masa3;
                }
            }
            
            $invoice_import = new \App\Models\Invoice;
            $invoice_import->manifest_id = $manifest_id;
            $invoice_import->no_invoice = 'INV-'.date('Ymd').str_pad($manifest_id, 5, '0', STR_PAD_LEFT);
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
            $invoice_import->behandle = ($manifest->BEHANDLE == 'Y') ? 1 : 0;
            $invoice_import->harga_behandle = ($manifest->BEHANDLE == 'Y') ? $tarif->behandle : 0;
            $invoice_import->adm = $tarif->adm;
            $invoice_import->weight_surcharge = $tarif->weight_surcharge;

            $array_total = array(
                $invoice_import->rdm,
                $invoice_import->storage,
                $invoice_import->storage_masa1,
                $invoice_import->storage_masa2,
                $invoice_import->storage_masa3,
                $invoice_import->harga_behandle,
                $invoice_import->adm,
                $invoice_import->dg_surcharge,
                $invoice_import->weight_surcharge
            );
            $sub_total = array_sum($array_total);
            
            $invoice_import->dg_surcharge = ($tarif->dg_surcharge * $sub_total) / 100;
            $invoice_import->sub_total = $sub_total;
            $invoice_import->materai = ($sub_total >= 1000000) ? 6000 : 3000;
            $invoice_import->uid = \Auth::getUser()->name;
                    
            if($invoice_import->save()){
                return json_encode(array('success' => true, 'message' => 'No. Tally '.$manifest->NOTALLY.', invoice berhasih dibuat.'));
            }else{
                return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
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
        
        if($check > 0){
            return json_encode(array('success' => false, 'message' => 'No. Tally '.$manifest->NOTALLY.' sudah di upload.'));
        }
        
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
                $codecokmsdetail->KD_KEMAS = $manifest->KODE_KEMAS;;
                $codecokmsdetail->JML_KEMAS = (!empty($manifest->QUANTITY) ? $manifest->QUANTITY : 0);
                $codecokmsdetail->KD_TIMBUN = 'GD';
                $codecokmsdetail->KD_DOK_INOUT = $manifest->KD_DOK_INOUT;
                $codecokmsdetail->NO_DOK_INOUT = (!empty($manifest->NO_SPPB) ? $manifest->NO_SPPB : '');
                $codecokmsdetail->TGL_DOK_INOUT = (!empty($manifest->TGL_SPPB) ? date('Ymd', strtotime($manifest->TGL_SPPB)) : '');
                $codecokmsdetail->WK_INOUT = date('Ymd', strtotime($manifest->tglrelease)).date('His', strtotime($manifest->jamrelease));;
                $codecokmsdetail->KD_SAR_ANGKUT_INOUT = 1;
                $codecokmsdetail->NO_POL = $manifest->NOPOL_MASUK;
                $codecokmsdetail->PEL_MUAT = $manifest->PEL_MUAT;
                $codecokmsdetail->PEL_TRANSIT = $manifest->PEL_TRANSIT;
                $codecokmsdetail->PEL_BONGKAR = $manifest->PEL_BONGKAR;
                $codecokmsdetail->GUDANG_TUJUAN = 'PRJP';
                $codecokmsdetail->UID = \Auth::getUser()->name;
                $codecokmsdetail->RESPONSE = '';
                $codecokmsdetail->STATUS_TPS = '';
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
                    
                    return json_encode(array('success' => true, 'message' => 'No. Tally '.$manifest->NOTALLY.' berhasil di upload. Reff Number : '.$reff_number));
                }
            }
        }else {
            return json_encode(array('success' => false, 'message' => 'Cannot create Reff Number, please try again later.'));
        }
              
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));

    }
    
}
