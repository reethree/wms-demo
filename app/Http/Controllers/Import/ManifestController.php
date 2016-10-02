<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Manifest as DBManifest;
use App\Models\Container as DBContainer;
use App\Models\Perusahaan as DBPerusahaan;
use App\Models\Packing as DBPacking;

class ManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( !$this->access->can('show.lcl.manifest.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "LCL Manifest";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'LCL Manifest'
            ]
        ];        
        
        return view('import.lcl.index-manifest')->with($data);
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
        $data = $request->json()->all(); 
        unset($data['id'], $data['_token']);

        $num = 0; 
        $manifestID = DBManifest::select('NOTALLY')->where('TCONTAINER_FK',$data['TCONTAINER_FK'])->orderBy('TMANIFEST_PK', 'DESC')->first();
        if(count($manifestID) > 0){
            $tally = explode('.', $manifestID->NOTALLY);
            $num = intval($tally[1]);    
        }
        $regID = str_pad(intval((isset($num) ? $num : 0)+1), 3, '0', STR_PAD_LEFT);
        
        $container = DBContainer::find($data['TCONTAINER_FK']);  
        $packing = DBPacking::find($data['TPACKING_FK']);
        
        $data['NOTALLY'] = $container->NoJob.'.'.$regID; 
        $data['TJOBORDER_FK'] = $container->TJOBORDER_FK;
        $data['KODE_KEMAS'] = $packing->KODEPACKING;
        $data['NAMAPACKING'] = $packing->NAMAPACKING;
        $data['NOJOBORDER'] = $container->NoJob;
        $data['NOCONTAINER'] = $container->NOCONTAINER;
        $data['TCONSOLIDATOR_FK'] = $container->TCONSOLIDATOR_FK;
        $data['NAMACONSOLIDATOR'] = $container->NAMACONSOLIDATOR;
        $data['TLOKASISANDAR_FK'] = $container->TLOKASISANDAR_FK;
        $data['KD_TPS_ASAL'] = $container->KD_TPS_ASAL;
        $data['KD_TPS_TUJUAN'] = $container->KD_TPS_TUJUAN;
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
        $data['SHIPPER'] = DBPerusahaan::getNameById($data['TSHIPPER_FK']);
        $data['CONSIGNEE'] = DBPerusahaan::getNameById($data['TCONSIGNEE_FK']);
        if(is_numeric($data['TNOTIFYPARTY_FK'])) {
            $data['NOTIFYPARTY'] = DBPerusahaan::getNameById($data['TNOTIFYPARTY_FK']);
        }else{
            $data['NOTIFYPARTY'] = $data['TNOTIFYPARTY_FK'];
            unset($data['TNOTIFYPARTY_FK']);
        }
        
        $data['tglentry'] = date('Y-m-d');
        $data['jamentry'] = date('H:i:s');
        $data['UID'] = $data['UID'] = \Auth::getUser()->name;
        
        $insert_id = DBManifest::insertGetId($data);
        
        if($insert_id){
            return json_encode(array('success' => true, 'message' => 'Manifest successfully saved!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
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
        if ( !$this->access->can('show.lcl.manifest.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit LCL Manifest";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('lcl-manifest-index'),
                'title' => 'LCL Manifest'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
//        $num = 0;
        
//        $manifestID = DBManifest::select('NOTALLY')->orderBy('TMANIFEST_PK', 'DESC')->first();
//        if(count($manifestID) > 0){
//            $tally = explode('.', $manifestID->NOTALLY);
//            $num = intval($tally[1]);    
//        }
//        
//        $regID = str_pad(intval((isset($num) ? $num : 0)+1), 3, '0', STR_PAD_LEFT);
        
        $container = DBContainer::find($id);
        
        $data['container'] = $container;
//        $data['tally_number'] = $container->NoJob.'.'.$regID;
        $data['perusahaans'] = DBPerusahaan::select('TPERUSAHAAN_PK as id', 'NAMAPERUSAHAAN as name')->get();
        $data['packings'] = DBPacking::select('TPACKING_PK as id', 'KODEPACKING as code', 'NAMAPACKING as name')->get();
        
        return view('import.lcl.edit-manifest')->with($data);
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
        $data = $request->json()->all(); 
        unset($data['id'], $data['_token']);
        
        $packing = DBPacking::find($data['TPACKING_FK']);
        $data['KODE_KEMAS'] = $packing->KODEPACKING;
        $data['NAMAPACKING'] = $packing->NAMAPACKING;  
        $data['SHIPPER'] = DBPerusahaan::getNameById($data['TSHIPPER_FK']);
        $data['CONSIGNEE'] = DBPerusahaan::getNameById($data['TCONSIGNEE_FK']);
        if(is_numeric($data['TNOTIFYPARTY_FK'])) {
            $data['NOTIFYPARTY'] = DBPerusahaan::getNameById($data['TNOTIFYPARTY_FK']);
        }else{
            $data['NOTIFYPARTY'] = $data['TNOTIFYPARTY_FK'];
            unset($data['TNOTIFYPARTY_FK']);
        }
        
        $update = DBManifest::where('TMANIFEST_PK', $id)
            ->update($data);
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Manifest successfully saved!'));
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
      try
      {
          DBManifest::destroy($id);
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'Manifest successfully deleted!'));
    }
    
    public function approve($id)
    {
        
        $update = DBManifest::where('TMANIFEST_PK', $id)
            ->update(array('VALIDASI'=>'Y'));
        
        if($update){
            return json_encode(array('success' => true, 'message' => 'Manifest successfully saved!'));
        }
        
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
    }
}
