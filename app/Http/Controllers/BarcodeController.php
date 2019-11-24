<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BarcodeController extends Controller
{
    public function __construct() {
        // CHECK STATUS BEHANDLE
        $lcl_sb = \App\Models\Manifest::whereIn('status_behandle',array('Ready','Siap Periksa'))->count();
        $fcl_sb = \App\Models\Containercy::whereIn('status_behandle',array('Ready','Siap Periksa'))->count();
        
        View::share('notif_behandle', array('lcl' => $lcl_sb, 'fcl' => $fcl_sb, 'total' => $lcl_sb+$fcl_sb));
    }
    
    public function index()
    {
        $data['page_title'] = "QR Code (Auto Gate)";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'QR Code (Auto Gate)'
            ]
        ];        
        
        return view('barcode.index')->with($data);
    }

    public function view($id)
    {
        $data['page_title'] = "View Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('barcode-index'),
                'title' => 'QR Code (Auto Gate)'
            ],
            [
                'action' => '',
                'title' => 'View'
            ]
        ];        
        
        $barcode = \App\Models\Barcode::find($id);
        $model = '';
        
        switch ($barcode->ref_type) {
            case 'Fcl':
                $model = 'tcontainercy';
                break;
            case 'Lcl':
                $model = 'tcontainer';
                break;
            case 'Manifest':
                $model = 'tmanifest';
                break;
        }
        
        if($barcode->ref_type == 'Manifest'){
            $data_barcode = \App\Models\Barcode::select('*')
                ->join($model, 'barcode_autogate.ref_id', '=', $model.'.TMANIFEST_PK')
                ->where(array('barcode_autogate.ref_type' => ucwords($barcode->ref_type), 'barcode_autogate.ref_action'=>$barcode->ref_action))
                ->where($model.'.TMANIFEST_PK', $barcode->ref_id)
                ->first();
        }else{
            $data_barcode = \App\Models\Barcode::select('*')
                ->join($model, 'barcode_autogate.ref_id', '=', $model.'.TCONTAINER_PK')
                ->where(array('barcode_autogate.ref_type' => ucwords($barcode->ref_type), 'barcode_autogate.ref_action'=>$barcode->ref_action))
                ->where($model.'.TCONTAINER_PK', $barcode->ref_id)
                ->first();
        }
        
//        return json_encode($data_barcode);

        $data['barcode'] = $data_barcode;
        
        return view('barcode.view')->with($data);
    }
    
    public function delete($id)
    {
        \App\Models\Barcode::where('id', $id)->delete();
        return back()->with('success', 'QR Code has been deleted.'); 
    }
    
    public function printBarcodePreview($id, $type, $action, $car = null)
    { 
        $ids = explode(',', $id);
        $model = '';
        $expired = date('Y-m-d', strtotime('+1 day'));
        
        switch ($type) {
            case 'fcl':
                $model = 'tcontainercy';
                break;
            case 'lcl':
                $model = 'tcontainer';
                break;
            case 'manifest':
                $model = 'tmanifest';
                break;
        }
        //Create Barcode If not exist
        if(is_array($ids)){
            foreach ($ids as $ref_id):
                // Check data
                $ref_number = '';
                if($type == 'manifest'){
                    $refdata = \App\Models\Manifest::find($ref_id);
                    $ref_number = $refdata->NOHBL;
                }elseif($type == 'lcl'){
                    $refdata = \App\Models\Container::find($ref_id);
                    $ref_number = $refdata->NOCONTAINER;
                }elseif($type == 'fcl'){
                    $refdata = \App\Models\Containercy::find($ref_id);
                    $ref_number = $refdata->NOCONTAINER;
                    if($action == 'get'){
                        $expired = date('Y-m-d', strtotime('+3 day'));
                    }
                }

                if($car && $car > 0){
                    for ($i = 0; $i < $car; $i++) { 
                        $barcode = new \App\Models\Barcode();
                        $barcode->ref_id = $ref_id;
                        $barcode->ref_type = ucwords($type);
                        $barcode->ref_action = $action;
                        $barcode->ref_number = $ref_number;
                        $barcode->barcode = str_random(20);
                        $barcode->expired = $expired;
                        $barcode->status = 'active';
                        $barcode->uid = \Auth::getUser()->name;
                        $barcode->save();
                    }   
                }else{
                $check = \App\Models\Barcode::where(array('ref_id'=>$ref_id, 'ref_type'=>ucwords($type), 'ref_action'=>$action))->first();               
                if(count($check) > 0){
//                    continue;
                    $barcode = \App\Models\Barcode::find($check->id);
                    $barcode->expired = $expired;
                    $barcode->status = 'active';
                    $barcode->uid = \Auth::getUser()->name;
                    $barcode->save();
                }else{
                    $barcode = new \App\Models\Barcode();
                    $barcode->ref_id = $ref_id;
                    $barcode->ref_type = ucwords($type);
                    $barcode->ref_action = $action;
                    $barcode->ref_number = $ref_number;
                    
//                    if($refdata->KD_TPS_ASAL == 'MAL0'){
//                        if($type == 'manifest'){
//                            $barcode->barcode = $refdata->NOHBL;
//                        }else{
//                            $barcode->barcode = $refdata->NOCONTAINER;
//                        } 
//                    }else{
                        $barcode->barcode = str_random(20);
//                    }
                    
                    $barcode->expired = $expired;
                    $barcode->status = 'active';
                    $barcode->uid = \Auth::getUser()->name;
                    $barcode->save();
                }  
                }
  
            endforeach;
        }else{
            return $ids;
        }
        
        if($type == 'manifest'){
            $data_barcode = \App\Models\Barcode::select('*')
                ->join($model, 'barcode_autogate.ref_id', '=', $model.'.TMANIFEST_PK')
                ->where(array('ref_type' => ucwords($type), 'ref_action'=>$action))
                ->whereIn($model.'.TMANIFEST_PK', $ids)
                ->get();
        }else{
            $data_barcode = \App\Models\Barcode::select('*')
                ->join($model, 'barcode_autogate.ref_id', '=', $model.'.TCONTAINER_PK')
                ->where(array('ref_type' => ucwords($type), 'ref_action'=>$action))
                ->whereIn($model.'.TCONTAINER_PK', $ids)
                ->get();
        }
        
//        return json_encode($data_barcode);

        $data['barcodes'] = $data_barcode;
//        $data['ref'] = $ref;
        return view('print.barcode', $data);
//        $pdf = \PDF::loadView('print.barcode', $data); 
//        return $pdf->stream('Delivery-Release-Barcode-'.$mainfest->NOHBL.'-'.date('dmy').'.pdf');
    }
    
    public function autogateNotification(Request $request)
    {
        $barcode = $request->barcode;
//        return $request->all();
        $tipe = $request->tipe;
        
        $data_barcode = \App\Models\Barcode::where('barcode', $barcode)->first();
        
        $filename = '';
        if ($request->hasFile('fileKamera')) {
            
            $file = $request->file('fileKamera');
            
//            return $file->getClientOriginalName();
            
            $destinationPath = base_path() . '/public/uploads/photos/autogate';
//            $i = 1;
//            foreach($files as $file){
                $filename = ucwords($data_barcode->ref_type).'_'.ucwords($data_barcode->ref_action).'_'.ucwords($tipe).'_'.$file->getClientOriginalName();
//                $extension = $file->getClientOriginalExtension();
                
//                $filename = date('dmyHis').'_'.$barcode.'_'.ucwords($data_barcode->ref_type).'_'.ucwords($data_barcode->ref_action).'_'.ucwords($tipe).'.'.$extension;
//                $picture[] = $filename;
                $store = $file->move($destinationPath, $filename);
//                $i++;
//            }
                
                if($store){
                if($tipe == 'in'){
                    $data_barcode->photo_in = $filename;
                }else{
                    $data_barcode->photo_out = $filename;
                }
                
                $data_barcode->save();
                }else{
                    
        }
        }
        
        if($data_barcode){
//            return $data_barcode;
            switch ($data_barcode->ref_type) {
                case 'Fcl':
                    $model = \App\Models\Containercy::find($data_barcode->ref_id);
                    $ref_number = $model->REF_NUMBER;
                    break;
                case 'Lcl':
                    $model = \App\Models\Container::find($data_barcode->ref_id);
                    $ref_number = $model->REF_NUMBER_IN;
                    break;
                case 'Manifest':
                    $model = \App\Models\Manifest::find($data_barcode->ref_id);
                    break;
            }
            
            if($model){
                
                if($data_barcode->ref_action == 'get'){
//                    if($data_barcode->time_in != NULL){
                        // GATEIN
                        $model->TGLMASUK = date('Y-m-d', strtotime($data_barcode->time_in));
                        $model->JAMMASUK = date('H:i:s', strtotime($data_barcode->time_in));
                        if($tipe == 'in'){
                            $model->photo_get_in = $filename;
                        }else{
                            $model->photo_get_out = $filename;
                        }
                        $model->UIDMASUK = 'Autogate';

                        if($model->save()){
                            // Update Manifest If LCL
                            if($data_barcode->ref_type == 'Lcl'){
                                \App\Models\Manifest::where('TCONTAINER_FK', $model->TCONTAINER_PK)->update(array('tglmasuk' => $model->TGLMASUK, 'jammasuk' => $model->JAMMASUK));
                            }
                            
                            // Upload Coari Container TPS Online
                            // Check Coari Exist
//                            if($ref_number){
                                return $model->NOCONTAINER.' '.$data_barcode->ref_type.' '.$data_barcode->ref_action.' Updated';
//                            }else{
//                                    $coari_id = $this->uploadTpsOnlineCoariCont($data_barcode->ref_type,$data_barcode->ref_id);
//                                    return redirect()->route('tps-coariCont-upload', $coari_id);
//                            }
  
                        }else{
                            return 'Something wrong!!! Cannot store to database';
                        }
//                    }else{
//                        return 'Time In is NULL';
//                    }
                }elseif($data_barcode->ref_action == 'release'){
//                    if($data_barcode->time_out != NULL){
                        // RELEASE
                    if($model->status_bc == 'HOLD' || $model->flag_bc == 'Y'):
                        return 'Status BC is HOLD or FLAGING, please unlock!!!';
                    endif;
                    
                        if($data_barcode->ref_type == 'Manifest'){
                            if($data_barcode->time_out){
                                $model->tglrelease = date('Y-m-d', strtotime($data_barcode->time_out));
                                $model->jamrelease = date('H:i:s', strtotime($data_barcode->time_out));
                                $model->UIDRELEASE = 'Autogate';
                                $model->TGLSURATJALAN = date('Y-m-d', strtotime($data_barcode->time_out));
                                $model->JAMSURATJALAN = date('H:i:s', strtotime($data_barcode->time_out));
                                $model->tglfiat = date('Y-m-d', strtotime($data_barcode->time_out));
                                $model->jamfiat = date('H:i:s', strtotime($data_barcode->time_out));
                                $model->NAMAEMKL = 'Autogate';
                                $model->UIDSURATJALAN = 'Autogate';
                            }
                            if($tipe == 'in'){
                                $model->photo_release_in = $filename;
                            }else{
                                $model->photo_release_out = $filename;
                            }

                            if($model->save()){
                                return $model->NOHBL.' '.$data_barcode->ref_type.' '.$data_barcode->ref_action.' Updated';
                            }else{
                                return 'Something wrong!!! Cannot store to database';
                            }
                        }else{
                            if($data_barcode->time_out){
                                $model->TGLRELEASE = date('Y-m-d', strtotime($data_barcode->time_out));
                                $model->JAMRELEASE = date('H:i:s', strtotime($data_barcode->time_out));
                                $model->UIDKELUAR = 'Autogate';
                                $model->TGLFIAT = date('Y-m-d', strtotime($data_barcode->time_out));
                                $model->JAMFIAT = date('H:i:s', strtotime($data_barcode->time_out));
                                $model->TGLSURATJALAN = date('Y-m-d', strtotime($data_barcode->time_out));
                                $model->JAMSURATJALAN = date('H:i:s', strtotime($data_barcode->time_out));
                            }
                            if($tipe == 'in'){
                                $model->photo_release_in = $filename;
                            }else{
                                $model->photo_release_out = $filename;
                            }
                            if($model->save()){
                                // Check Coari Exist
//                                if($ref_number){
                                    return $model->NOCONTAINER.' '.$data_barcode->ref_type.' '.$data_barcode->ref_action.' Updated';
//                                }else{
//                                    $codeco_id = $this->uploadTpsOnlineCodecoCont($data_barcode->ref_type,$data_barcode->ref_id);
//                                    return redirect()->route('tps-codecoCont-upload', $codeco_id);
//                                }
                            }else{
                                return 'Something wrong!!! Cannot store to database';
                            }
                        }
//                    }else{
//                        return 'Error';
//                    }
                    
                }elseif($data_barcode->ref_action == 'empty'){
//                    if($data_barcode->time_out != NULL){
                        if($data_barcode->time_out){
                            $model->TGLBUANGMTY = date('Y-m-d', strtotime($data_barcode->time_out));
                            $model->JAMBUANGMTY = date('H:i:s', strtotime($data_barcode->time_out));
                            $model->UIDMTY = 'Autogate';
                        }
                        if($tipe == 'in'){
                            $model->photo_empty_in = $filename;
                        }else{
                            $model->photo_empty_out = $filename;
                        }
                        if($model->save()){
                            // Check Coari Exist
//                            if($ref_number){
                                return $model->NOCONTAINER.' '.$data_barcode->ref_type.' '.$data_barcode->ref_action.' Updated';
//                            }else{
//                                $codeco_id = $this->uploadTpsOnlineCodecoCont($data_barcode->ref_type,$data_barcode->ref_id);
//                                return redirect()->route('tps-codecoCont-upload', $codeco_id);
//                            }
                        }else{
                            return 'Something wrong!!! Cannot store to database';
                        }
//                    }else{
//                        
//                    }
                }
                
            }else{
                return 'Something wrong in Model!!!';
            }
        }else{
            return 'Barcode not found!!';
        }
//        return $barcode;
//        app('App\Http\Controllers\PrintReportController')->getPrintReport();
    }
    
    public function uploadTpsOnlineCoariCont($type, $id)
    {
        $container_id = $id; 
        
        // Reff Number
        $reff_number = $this->getReffNumber('Autogate'); 
        
        if($type == 'Fcl'){
            $container = \App\Models\Containercy::where('TCONTAINER_PK', $container_id)->first();
            
            if($reff_number){
                $coaricont = new \App\Models\TpsCoariCont;
                $coaricont->REF_NUMBER = $reff_number;
                $coaricont->TGL_ENTRY = date('Y-m-d');
                $coaricont->JAM_ENTRY = date('H:i:s');
                $coaricont->UID = 'Autogate';

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
                    $coaricontdetail->UID = 'Autogate';
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
                    $coaricontdetail->KD_TPS_ASAL = $container->KD_TPS_ASAL;
                    $coaricontdetail->FLAG_UPD = '';
                    $coaricontdetail->RESPONSE_MAL0 = '';
                    $coaricontdetail->STATUS_TPS_MAL0 = '';
                    $coaricontdetail->TGL_ENTRY = date('Y-m-d');
                    $coaricontdetail->JAM_ENTRY = date('H:i:s');

                    if($coaricontdetail->save()){

                        $container->REF_NUMBER = $reff_number;
                        $container->save();

                        // Create XML & Send Tps Online
                        return $coaricont->TPSCOARICONTXML_PK;
//                        return redirect()->route('tps-coariCont-upload', $coaricont->TPSCOARICONTXML_PK);
//                        return json_encode(array('insert_id' => $coaricont->TPSCOARICONTXML_PK, 'ref_number' => $reff_number, 'success' => true, 'message' => 'No. Container '.$container->NOCONTAINER.' berhasil di simpan. Reff Number : '.$reff_number));
                    }

                }
            } else {
                return json_encode(array('success' => false, 'message' => 'Cannot create Reff Number, please try again later.'));
            }
        }elseif($type == 'Lcl'){
            $container = \App\Models\Container::where('TCONTAINER_PK', $container_id)->first();
            
            if($reff_number){
                $coaricont = new \App\Models\TpsCoariCont;
                $coaricont->REF_NUMBER = $reff_number;
                $coaricont->TGL_ENTRY = date('Y-m-d');
                $coaricont->JAM_ENTRY = date('H:i:s');
                $coaricont->UID = 'Autogate';

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
                    $coaricontdetail->UID = 'Autogate';
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
                        
                        // Create XML & Send Tps Online
                        return $coaricont->TPSCOARICONTXML_PK;
//                        return redirect()->route('tps-coariCont-upload', $coaricont->TPSCOARICONTXML_PK);
//                        return json_encode(array('insert_id' => $coaricont->TPSCOARICONTXML_PK, 'ref_number' => $reff_number, 'success' => true, 'message' => 'No. Container '.$container->NOCONTAINER.' berhasil di simpan. Reff Number : '.$reff_number));
                    }

                }

            } else {
                return json_encode(array('success' => false, 'message' => 'Cannot create Reff Number, please try again later.'));
            }
        }else{
            return 'Something wrong, type not found!';
        }
        
    }
    
    public function uploadTpsOnlineCoariKms($id)
    {
        
    }
    
    public function uploadTpsOnlineCodecoCont($type, $id)
    {
        $container_id = $id;
        if($type == 'Fcl'){
            $container = \App\Models\Containercy::where('TCONTAINER_PK', $container_id)->first();
            // Reff Number
            $reff_number = $this->getReffNumber('Autogate');   
            if($reff_number){

                $codecocont = new \App\Models\TpsCodecoContFcl();
                $codecocont->NOJOBORDER = $container->NoJob;
                $codecocont->REF_NUMBER = $reff_number;
                $codecocont->TGL_ENTRY = date('Y-m-d');
                $codecocont->JAM_ENTRY = date('H:i:s');
                $codecocont->UID = 'Autogate';

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
                    $codecocontdetail->UID = 'Autogate';
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
                        
                        return $codecocont->TPSCODECOCONTXML_PK;
                        
//                        return json_encode(array('insert_id' => $codecocont->TPSCODECOCONTXML_PK, 'ref_number' => $reff_number, 'success' => true, 'message' => 'No. Container '.$container->NOCONTAINER.' berhasil di simpan. Reff Number : '.$reff_number));
                    }
                }

            } else {
                return json_encode(array('success' => false, 'message' => 'Cannot create Reff Number, please try again later.'));
            }
        }elseif($type == 'Lcl'){
            $container = \App\Models\Container::where('TCONTAINER_PK', $container_id)->first();
            // Reff Number
            $reff_number = $this->getReffNumber('Autogate');   
            if($reff_number){

                $codecocont = new \App\Models\TpsCodecoContFcl();
                $codecocont->NOJOBORDER = $container->NoJob;
                $codecocont->REF_NUMBER = $reff_number;
                $codecocont->TGL_ENTRY = date('Y-m-d');
                $codecocont->JAM_ENTRY = date('H:i:s');
                $codecocont->UID = 'Autogate';

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
                    $codecocontdetail->UID = 'Autogate';
                    $codecocontdetail->NOURUT = 1;
                    $codecocontdetail->RESPONSE = '';
                    $codecocontdetail->STATUS_TPS = 1;
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
                        
                        $container->REF_NUMBER_OUT = $reff_number;
                        $container->save();
                        
                        return $codecocont->TPSCODECOCONTXML_PK;
//                        return json_encode(array('insert_id' => $codecocont->TPSCODECOCONTXML_PK, 'ref_number' => $reff_number, 'success' => true, 'message' => 'No. Container '.$container->NOCONTAINER.' berhasil di simpan. Reff Number : '.$reff_number));
                    }
                }

            } else {
                return json_encode(array('success' => false, 'message' => 'Cannot create Reff Number, please try again later.'));
            }
        }else{
            return 'Something wrong, type not found!';
        }
        
        
    }
    
    public function uploadTpsOnlineCodecoKms()
    {
        
    }
    
}


