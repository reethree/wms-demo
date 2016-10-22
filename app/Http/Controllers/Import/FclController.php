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
    
    public function behandleIndex()
    {
        if ( !$this->access->can('show.fcl.behandle.index') ) {
            return view('errors.no-access');
        }
        
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
        
        $data['page_title'] = "FCL Delivery Fiat Muat";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Delivery Fiat Muat'
            ]
        ];        
        
        return view('import.fcl.index-fiatmuat')->with($data);
    }
    
    public function suratjalanIndex()
    {
        if ( !$this->access->can('show.fcl.suratjalan.index') ) {
            return view('errors.no-access');
        }
        
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
        
        $data['page_title'] = "FCL Delivery Release";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'FCL Delivery Release'
            ]
        ];        
        
        $data['perusahaans'] = DBPerusahaan::select('TPERUSAHAAN_PK as id', 'NAMAPERUSAHAAN as name')->get();
        
        return view('import.fcl.index-release')->with($data);
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
        $regID = str_pad(intval((isset($spk_last_id->id) ? $spk_last_id->id : 0)+1), 4, '0', STR_PAD_LEFT);
        
        $data['spk_number'] = 'PRJP'.$regID.'/'.date('y');
        $data['consolidators'] = DBConsolidator::select('TCONSOLIDATOR_PK as id','NAMACONSOLIDATOR as name')->get();
        $data['countries'] = DBNegara::select('TNEGARA_PK as id','NAMANEGARA as name')->get();
        $data['perusahaans'] = DBPerusahaan::select('TPERUSAHAAN_PK as id','NAMAPERUSAHAAN as name')->get();
        $data['pelabuhans'] = DBPelabuhan::select('TPELABUHAN_PK as id','NAMAPELABUHAN as name','KODEPELABUHAN as code')->get();
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
            'NOMBL' => 'required|unique:tjoborder',
            'TGLMBL' => 'required',
            'TCONSOLIDATOR_FK' => 'required',
            'PARTY' => 'required',
            'TNEGARA_FK' => 'required',
            'TPELABUHAN_FK' => 'required',
            'VESSEL' => 'required',
            'VOY' => 'required',
            'CALLSIGN' => 'required',
            'ETA' => 'required',
            'ETD' => 'required',
            'TLOKASISANDAR_FK' => 'required',
            'KODE_GUDANG' => 'required',
            'GUDANG_TUJUAN' => 'required',
            'JENISKEGIATAN' => 'required',
            'GROSSWEIGHT' => 'required',
//            'JUMLAHHBL' => 'required',
            'MEASUREMENT' => 'required',
            'ISO_CODE' => 'required',
            'PEL_MUAT' => 'required',
            'PEL_TRANSIT' => 'required',
            'PEL_BONGKAR' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data = $request->except(['_token']); 
        $data['TGLENTRY'] = date('Y-m-d');
        $data['TGLMBL'] = date('Y-m-d', strtotime($data['TGLMBL']));
        $data['ETA'] = date('Y-m-d', strtotime($data['ETA']));
        $data['ETD'] = date('Y-m-d', strtotime($data['ETD']));
        $data['TGL_BC11'] = date('Y-m-d', strtotime($data['TGL_BC11']));
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
        $namaconsignee = DBPerusahaan::select('NAMAPERUSAHAAN')->where('TPERUSAHAAN_PK',$data['TPERUSAHAAN_FK'])->first();
        $data['CONSIGNEE'] = $namaconsignee->NAMAPERUSAHAAN;
        $data['UID'] = \Auth::getUser()->name;
        
        $insert_id = DBJoborder::insertGetId($data);
        
        if($insert_id){
            
            return redirect()->route('fcl-register-edit',$insert_id)->with('success', 'FCL Register has been added.');
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
        $data['pelabuhans'] = DBPelabuhan::select('TPELABUHAN_PK as id','NAMAPELABUHAN as name','KODEPELABUHAN as code')->get();
        $data['vessels'] = DBVessel::select('tvessel_pk as id','vesselname as name','vesselcode as code','callsign')->get();
        $data['shippinglines'] = DBShippingline::select('TSHIPPINGLINE_PK as id','SHIPPINGLINE as name')->get();
        $data['lokasisandars'] = DBLokasisandar::select('TLOKASISANDAR_PK as id','NAMALOKASISANDAR as name')->get();
        
//        $jobid = DBContainer::select('TJOBORDER_FK as id')->where('TCONTAINER_PK',$id)->first();
        
        $data['joborder'] = DBJoborder::find($id);
        
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
    //        $data['TLOKASISANDAR_FK'] = $joborder->TLOKASISANDAR_FK;
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
        unset($data['TCONTAINER_PK'], $data['_token']);

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
        $container = DBContainer::find($id);
        $data['container'] = $container;
        return view('print.fcl-behandle', $data);
        $pdf = \PDF::loadView('print.fcl-behandle', $data); 
        return $pdf->stream('FCL-Behandle-'.$container->NOCONTAINER.'-'.date('dmy').'.pdf');
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
}
