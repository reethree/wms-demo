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

    public function printBarcodePreview($id, $type)
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
            default:
                $model = 'tcontainer';
        }
        
        if(is_array($ids)){
            foreach ($ids as $ref_id):
                // Check data
                $check = \App\Models\Barcode::where(array('ref_id'=>$ref_id, 'ref_type'=>ucwords($type)))->count();               
                if($check > 0){
                    continue;
                }else{
                    $barcode = new \App\Models\Barcode();
                    $barcode->ref_id = $ref_id;
                    $barcode->ref_type = ucwords($type);
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

        //Create Barcode If not exist
        $data_barcode = \App\Models\Barcode::select('*')
                ->join($model, 'barcode_autogate.ref_id', '=', $model.'.TCONTAINER_PK')
                ->whereIn($model.'.TCONTAINER_PK', $ids)
                ->get();
//        return json_encode($data_barcode);
        
        $data['barcodes'] = $data_barcode;
//        $data['ref'] = $ref;
        return view('print.barcode', $data);
//        $pdf = \PDF::loadView('print.barcode', $data); 
//        return $pdf->stream('Delivery-Release-Barcode-'.$mainfest->NOHBL.'-'.date('dmy').'.pdf');
    }
    
    public function autogateNotification(Request $request, $barcode)
    {
        return $barcode;
//        app('App\Http\Controllers\PrintReportController')->getPrintReport();
    }
    
}


