<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Joborder as DBJoborder;
use App\Models\Consolidator as DBConsolidator;
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
        $regID = str_pad(intval((isset($spk_last_id->id) ? $spk_last_id->id : 0)+1), 4, '0', STR_PAD_LEFT);
        
        $data['spk_number'] = 'PRJP'.$regID.'/'.date('y');
        $data['consolidators'] = DBConsolidator::select('TCONSOLIDATOR_PK as id','NAMACONSOLIDATOR as name')->get();
        $data['countries'] = DBNegara::select('TNEGARA_PK as id','NAMANEGARA as name')->get();
        $data['pelabuhans'] = DBPelabuhan::select('TPELABUHAN_PK as id','NAMAPELABUHAN as name','KODEPELABUHAN as code')->get();
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
        $data['TGL_MASTER_BL'] = date('Y-m-d', strtotime($data['TGL_MASTER_BL']));
        $data['ETA'] = date('Y-m-d', strtotime($data['ETA']));
        $data['ETD'] = date('Y-m-d', strtotime($data['ETD']));
        $data['TTGL_BC11'] = date('Y-m-d', strtotime($data['TTGL_BC11']));
        $data['TTGL_PLP'] = date('Y-m-d', strtotime($data['TTGL_PLP']));
        $namaconsolidator = DBConsolidator::select('NAMACONSOLIDATOR')->where('TCONSOLIDATOR_PK',$data['TCONSOLIDATOR_FK'])->first();
        $data['NAMACONSOLIDATOR'] = $namaconsolidator->NAMACONSOLIDATOR;
        $namanegara = DBNegara::select('NAMANEGARA')->where('TNEGARA_PK',$data['TNEGARA_FK'])->first();
        $data['NAMANEGARA'] = $namanegara->NAMANEGARA;
        $namapelabuhan = DBPelabuhan::select('NAMAPELABUHAN')->where('TPELABUHAN_PK',$data['TPELABUHAN_FK'])->first();
        $data['NAMAPELABUHAN'] = $namapelabuhan->NAMAPELABUHAN;
        $namalokasisandar = DBLokasisandar::select('NAMALOKASISANDAR')->where('TLOKASISANDAR_PK',$data['TLOKASISANDAR_FK'])->first();
        $data['NAMALOKASISANDAR'] = $namalokasisandar->NAMALOKASISANDAR;
        $namashippingline = DBShippingline::select('SHIPPINGLINE')->where('TSHIPPINGLINE_PK',$data['TSHIPPINGLINE_FK'])->first();
        $data['SHIPPINGLINE'] = $namashippingline->SHIPPINGLINE;
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
//        $data['pelabuhans'] = [];
        $data['pelabuhans'] = DBPelabuhan::select('TPELABUHAN_PK as id','NAMAPELABUHAN as name','KODEPELABUHAN as code')->get();
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
        $data['TGL_MASTER_BL'] = date('Y-m-d', strtotime($data['TGL_MASTER_BL']));
        $data['ETA'] = date('Y-m-d', strtotime($data['ETA']));
        $data['ETD'] = date('Y-m-d', strtotime($data['ETD']));
        $data['TTGL_BC11'] = date('Y-m-d', strtotime($data['TTGL_BC11']));
        $data['TTGL_PLP'] = date('Y-m-d', strtotime($data['TTGL_PLP']));
        $namaconsolidator = DBConsolidator::select('NAMACONSOLIDATOR')->where('TCONSOLIDATOR_PK',$data['TCONSOLIDATOR_FK'])->first();
        $data['NAMACONSOLIDATOR'] = $namaconsolidator->NAMACONSOLIDATOR;
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
//                return json_encode(array('success' => true, 'message' => 'Gate IN successfully updated!'));
            }
            
//            return json_encode(array('success' => true, 'message' => 'Container successfully updated, but Manifest not updated!'));
        }
        
//        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
        return $data;
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
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
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
    
}
