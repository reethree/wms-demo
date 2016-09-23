<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Joborder as DBJoborder;
use App\Models\Consolidator as DBConsolidator;
use App\Models\Negara as DBNegara;
use App\Models\Pelabuhan as DBPelabuhan;
use App\Models\Vessel as DBVessel;
use App\Models\Shippingline as DBShippingline;
use App\Models\Lokasisandar as DBLokasisandar;
use App\Models\Container as DBContainer;

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
        
        $data['spk_number'] = 'PNJP'.$regID.'/'.date('y');
        $data['consolidators'] = DBConsolidator::select('TCONSOLIDATOR_PK as id','NAMACONSOLIDATOR as name')->get();
        $data['countries'] = DBNegara::select('TNEGARA_PK as id','NAMANEGARA as name')->get();
        $data['pelabuhans'] = DBPelabuhan::select('TPELABUHAN_PK as id','NAMAPELABUHAN as name','KODEPELABUHAN as code')->get();
//        $data['vessels'] = DBVessel::select('tvessel_pk as id','vesselname as name')->get();
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
            'NOMBL' => 'required',
            'TGL_MASTER_BL' => 'required',
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
            'JUMLAHHBL' => 'required',
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
//        $data['vessels'] = DBVessel::select('tvessel_pk as id','vesselname as name')->get();
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
        if ( !$this->access->can('update.lcl.register.edit') ) {
            return view('errors.no-access');
        }
    }
    
    public function registerUpdate(Request $request, $id)
    {
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
            $joborder = \App\Models\Joborder::findOrFail($id);
            $data = array();
            $data['TJOBORDER_FK'] = $joborder->TJOBORDER_PK;
            $data['NoJob'] = $joborder->NOJOBORDER;
            $data['NO_BC11'] = $joborder->NO_BC11;
            $data['TGL_BC11'] = $joborder->TGL_BC11;
            $data['NO_PLP'] = $joborder->NO_PLP;
            $data['TGL_PLP'] = $joborder->TGL_PLP;
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
                return back()->with('success', 'LCL Register has been updated.');
            }
            
            return back()->with('success', 'LCL Register has been updated, but container not updated.');
        }
        
        return back()->with('error', 'LCL Register cannot update, please try again.')->withInput();
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
    
    public function registerPrintPermohonan(Request $request)
    {
        $data = $request->except(['_token']);
        $container = DBContainer::find($data['container_id']);
        $lokasisandar = DBLokasisandar::find($container->TLOKASISANDAR_FK);
        
        $result['info'] = $data;
        $result['container'] = $container;
        $result['lokasisandar'] = $lokasisandar;
        
        return view('print.permohonan', $result);
    }
}
