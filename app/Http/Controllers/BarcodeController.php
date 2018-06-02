<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BarcodeController extends Controller
{
    
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

}


