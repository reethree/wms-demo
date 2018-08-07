<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BarcodeController extends Controller
{
    
    public function __construct() {

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
                ->where(array('ref_type' => ucwords($barcode->ref_type), 'ref_action'=>$barcode->ref_action))
                ->where($model.'.TMANIFEST_PK', $barcode->ref_id)
                ->first();
        }else{
            $data_barcode = \App\Models\Barcode::select('*')
                ->join($model, 'barcode_autogate.ref_id', '=', $model.'.TCONTAINER_PK')
                ->where(array('ref_type' => ucwords($barcode->ref_type), 'ref_action'=>$barcode->ref_action))
                ->where($model.'.TCONTAINER_PK', $barcode->ref_id)
                ->first();
        }
        
//        return json_encode($data_barcode);

        $data['barcode'] = $data_barcode;
        
        return view('barcode.view')->with($data);
    }
    
    public function printBarcodePreview($id, $type, $action)
    { 
        $ids = explode(',', $id);
        $model = '';
        
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
                }

                $check = \App\Models\Barcode::where(array('ref_id'=>$ref_id, 'ref_type'=>ucwords($type), 'ref_action'=>$action))->first();               
                if(count($check) > 0){
//                    continue;
                    $barcode = \App\Models\Barcode::find($check->id);
                    $barcode->expired = date('Y-m-d', strtotime('+1 day'));
                    $barcode->status = 'active';
                    $barcode->uid = \Auth::getUser()->name;
                    $barcode->save();
                }else{
                    $barcode = new \App\Models\Barcode();
                    $barcode->ref_id = $ref_id;
                    $barcode->ref_type = ucwords($type);
                    $barcode->ref_action = $action;
                    $barcode->ref_number = $ref_number;
                    $barcode->barcode = str_random(20);
                    $barcode->expired = date('Y-m-d', strtotime('+1 day'));
                    $barcode->status = 'active';
                    $barcode->uid = \Auth::getUser()->name;
                    $barcode->save();
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
    
    public function autogateNotification(Request $request, $barcode)
    {
        
        $data_barcode = \App\Models\Barcode::where('barcode', $barcode)->first();
        
        if($data_barcode){
//            return $barcode;
            switch ($data_barcode->ref_type) {
                case 'Fcl':
                    $model = \App\Models\Containercy::find($data_barcode->ref_id);
                    break;
                case 'Lcl':
                    $model = \App\Models\Container::find($data_barcode->ref_id);
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
                        $model->UIDMASUK = 'Autogate';

                        if($model->save()){
                            return $model->NOCONTAINER.' '.$data_barcode->ref_type.' '.$data_barcode->ref_action.' Updated';
                        }else{
                            return 'Something wrong!!!';
                        }
//                    }else{
//                        return 'Time In is NULL';
//                    }
                }elseif($data_barcode->ref_action = 'release'){
//                    if($data_barcode->time_out != NULL){
                        // RELEASE
                        if($data_barcode->ref_type == 'Manifest'){
                            $model->tglrelease = date('Y-m-d', strtotime($data_barcode->time_out));
                            $model->jamrelease = date('H:i:s', strtotime($data_barcode->time_out));
                            $model->UIDRELEASE = 'Autogate';
                            $model->TGLSURATJALAN = date('Y-m-d', strtotime($data_barcode->time_out));
                            $model->JAMSURATJALAN = date('H:i:s', strtotime($data_barcode->time_out));
                            $model->tglfiat = date('Y-m-d', strtotime($data_barcode->time_out));
                            $model->jamfiat = date('H:i:s', strtotime($data_barcode->time_out));
                            $model->NAMAEMKL = 'Autogate';
                            $model->UIDSURATJALAN = 'Autogate';
                            if($model->save()){
                                return $model->NOHBL.' '.$data_barcode->ref_type.' '.$data_barcode->ref_action.' Updated';
                            }else{
                                return 'Something wrong!!!';
                            }
                        }else{
                            $model->TGLRELEASE = date('Y-m-d', strtotime($data_barcode->time_out));
                            $model->JAMRELEASE = date('H:i:s', strtotime($data_barcode->time_out));
                            $model->UIDKELUAR = 'Autogate';
                            $model->TGLFIAT = date('Y-m-d', strtotime($data_barcode->time_out));
                            $model->JAMFIAT = date('H:i:s', strtotime($data_barcode->time_out));
                            $model->TGLSURATJALAN = date('Y-m-d', strtotime($data_barcode->time_out));
                            $model->JAMSURATJALAN = date('H:i:s', strtotime($data_barcode->time_out));
                            if($model->save()){
                                return $model->NOCONTAINER.' '.$data_barcode->ref_type.' '.$data_barcode->ref_action.' Updated';
                            }else{
                                return 'Something wrong!!!';
                            }
                        }
//                    }else{
//                        return 'Error';
//                    }
                    
                }elseif($data_barcode->ref_action == 'empty'){
//                    if($data_barcode->time_out != NULL){
                        $model->TGLBUANGMTY = date('Y-m-d', strtotime($data_barcode->time_out));
                        $model->JAMBUANGMTY = date('H:i:s', strtotime($data_barcode->time_out));
                        $model->UIDMTY = 'Autogate';
                        if($model->save()){
                            return $model->NOCONTAINER.' '.$data_barcode->ref_type.' '.$data_barcode->ref_action.' Updated';
                        }else{
                            return 'Something wrong!!!';
                        }
//                    }else{
//                        
//                    }
                }
                
//                if($data_barcode->time_in != NULL && $data_barcode->time_out == NULL){
//                    // GATEIN
//                    $model->TGLMASUK = date('Y-m-d', strtotime($data_barcode->time_in));
//                    $model->JAMMASUK = date('H:i:s', strtotime($data_barcode->time_in));
//                    $model->UIDMASUK = 'Autogate';
//                    $model->save();
//                    
//                    return $barcode;
//                }elseif($data_barcode->time_in != NULL && $data_barcode->time_out != NULL){
//                    // GATEOUT
//                    return $barcode; 
//                }else{
//                    return false;
//                }
            }else{
                return 'Something wrong in Model!!!';
            }
        }else{
            return 'Barcode not found!!';
        }
//        return $barcode;
//        app('App\Http\Controllers\PrintReportController')->getPrintReport();
    }
    
    public function uploadTpsOnlineCoariCont()
    {
        
    }
    
    public function uploadTpsOnlineCoariKms()
    {
        
    }
    
    public function uploadTpsOnlineCodecoCont()
    {
        
    }
    
    public function uploadTpsOnlineCodecoKms()
    {
        
    }
    
}


