<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();   
    }
    
    public function index()
    {        
        $data['page_title'] = "Welcome to Dashboard";
        $data['page_description'] = "WMS PRIMANATA JASA PERSADA";
        
        // FCL       
        $jict = \App\Models\Containercy::where('KD_TPS_ASAL', 'JICT')->whereRaw('MONTH(TGL_PLP) = '.date('m'))->whereRaw('YEAR(TGL_PLP) = '.date('Y'))->count();
        $koja = \App\Models\Containercy::where('KD_TPS_ASAL', 'KOJA')->whereRaw('MONTH(TGL_PLP) = '.date('m'))->whereRaw('YEAR(TGL_PLP) = '.date('Y'))->count();
        $mal = \App\Models\Containercy::where('KD_TPS_ASAL', 'MAL0')->whereRaw('MONTH(TGL_PLP) = '.date('m'))->whereRaw('YEAR(TGL_PLP) = '.date('Y'))->count();
        $nct1 = \App\Models\Containercy::where('KD_TPS_ASAL', 'NCT1')->whereRaw('MONTH(TGL_PLP) = '.date('m'))->whereRaw('YEAR(TGL_PLP) = '.date('Y'))->count();
        $pldc = \App\Models\Containercy::where('KD_TPS_ASAL', 'PLDC')->whereRaw('MONTH(TGL_PLP) = '.date('m'))->whereRaw('YEAR(TGL_PLP) = '.date('Y'))->count();
        
        $jictg = \App\Models\Containercy::where('KD_TPS_ASAL', 'JICT')->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
        $kojag = \App\Models\Containercy::where('KD_TPS_ASAL', 'KOJA')->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
        $malg = \App\Models\Containercy::where('KD_TPS_ASAL', 'MAL0')->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
        $nct1g = \App\Models\Containercy::where('KD_TPS_ASAL', 'NCT1')->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
        $pldcg = \App\Models\Containercy::where('KD_TPS_ASAL', 'PLDC')->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
        $data['countbytps'] = array('JICT' => array($jict, $jictg), 'KOJA' => array($koja, $kojag), 'MAL0' => array($mal, $malg), 'NCT1' => array($nct1, $nct1g), 'PLDC' => array($pldc, $pldcg));
        
        // BY DOKUMEN
        $bc20 = \App\Models\Containercy::where('KD_DOK_INOUT', 1)->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
        $bc23 = \App\Models\Containercy::where('KD_DOK_INOUT', 2)->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
        $bc12 = \App\Models\Containercy::where('KD_DOK_INOUT', 4)->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
        $bc15 = \App\Models\Containercy::where('KD_DOK_INOUT', 9)->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
        $bc11 = \App\Models\Containercy::where('KD_DOK_INOUT', 20)->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
        $bcf26 = \App\Models\Containercy::where('KD_DOK_INOUT', 5)->whereRaw('MONTH(TGLMASUK) = '.date('m'))->whereRaw('YEAR(TGLMASUK) = '.date('Y'))->count();
//        $data['countbydoc'] = array('BC 2.0' => $bc20, 'BC 2.3' => $bc23, 'BC 1.2' => $bc12, 'BC 1.5' => $bc15, 'BC 1.1' => $bc11, 'BCF 2.6' => $bcf26);
        $data['countbydoc'] = array('BC 2.0' => $bc20, 'BC 2.3' => $bc23, 'Lain-lain' => $bc12+$bc15+$bc11+$bcf26);
        
        $data['totcounttpsp'] = array_sum(array($jict,$koja,$mal,$nct1,$pldc));
        $data['totcounttpsg'] = array_sum(array($jictg,$kojag,$malg,$nct1g,$pldcg));
        
        $data['countfclcont'] = \App\Models\Containercy::whereNotNull('TGLMASUK')->whereNull('TGLRELEASE')->count();
        
        $data['key_graph'] = json_encode(array('JICT', 'KOJA', 'MAL0', 'NCT1', 'PLDC'));
        $data['val_graph'] = json_encode(array($jict, $koja, $mal, $nct1, $pldc));
        
        $data['sor'] = \App\Models\SorYor::where('type', 'sor')->first();
        $data['yor'] = \App\Models\SorYor::where('type', 'yor')->first();
        
        return view('welcome')->with($data);
    }
}
